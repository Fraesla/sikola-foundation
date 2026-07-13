<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\PoinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class MerchandisePublicController extends Controller
{
    protected PoinService $poinService;

    public function __construct(PoinService $poinService)
    {
        $this->poinService = $poinService;
    }

    private function roleView($view)
    {
        $role = auth()->user()->role;

        return match ($role) {
            'donatur' => "donatur.$view",
            'relawan' => "relawan.$view",
            default   => "pembeli.$view",
        };
    }
    private function roleRoute($route)
    {
        $role = auth()->user()->role;

        return match($role){
            'donatur' => "donatur.$route",
            'relawan' => "relawan.$route",
            default   => "pembeli.$route",
        };
    }
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view(
            $this->roleView('order'),
            compact('orders')
        );
    }

    public function checkoutLangsung(Request $request)
    {
        $request->validate([
            'merchandise_id' => 'required|exists:merchandises,id',
            'qty'            => 'required|integer|min:1',
        ]);

        $product = Merchandise::findOrFail($request->merchandise_id);

        if ($request->qty > $product->stok) {
            return back()->with(
                'error',
                'Jumlah melebihi stok.'
            );
        }

        $cartItems = collect([
            (object) [
                'id'      => null,
                'product' => $product,
                'qty'     => $request->qty,
            ]
        ]);

        session([
            'checkout_type' => 'direct',

            'checkout_product' => [
                'merchandise_id' => $product->id,
                'qty'            => $request->qty,
            ]
        ]);

        return view(
            $this->roleView('checkout'),
            compact('cartItems')
        );
    }

    public function create(Request $request)
    {
        $ids = $request->cart_ids;

        if (empty($ids)) {

            return redirect()
                ->route($this->roleRoute('keranjang.index'))
                ->with(
                    'error',
                    'Pilih minimal satu barang.'
                );
        }

        $cartItems = Cart::where('user_id', auth()->id())
            ->whereIn('id', $ids)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {

            return redirect()
                ->route($this->roleRoute('keranjang.index'))
                ->with(
                    'error',
                    'Barang tidak ditemukan.'
                );
        }

        session([
            'checkout_type'     => 'cart',
            'checkout_cart_ids' => $ids,
        ]);

        return view(
            $this->roleView('checkout'),
            compact('cartItems')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required',
            'telp_penerima' => 'required',
            'alamat'        => 'required',
            'kota'          => 'required',
        ]);

        DB::beginTransaction();

        try {

            $checkoutType = session('checkout_type');

            /*
            |--------------------------------------------------------------------------
            | Ambil Barang
            |--------------------------------------------------------------------------
            */

            if ($checkoutType == 'cart') {

                $ids = session('checkout_cart_ids');

                $cartItems = Cart::where('user_id', auth()->id())
                    ->whereIn('id', $ids)
                    ->with('product')
                    ->get();

            } else {

                $checkout = session('checkout_product');

                $product = Merchandise::findOrFail(
                    $checkout['merchandise_id']
                );

                $cartItems = collect([
                    (object) [
                        'product' => $product,
                        'qty'     => $checkout['qty'],
                    ]
                ]);

            }

            if ($cartItems->isEmpty()) {

                throw new \Exception(
                    'Barang checkout tidak ditemukan.'
                );

            }

            /*
            |--------------------------------------------------------------------------
            | Validasi Stok
            |--------------------------------------------------------------------------
            */

            foreach ($cartItems as $item) {

                if ($item->qty > $item->product->stok) {

                    throw new \Exception(
                        "{$item->product->nama} stok tidak mencukupi."
                    );

                }

            }

            /*
            |--------------------------------------------------------------------------
            | Hitung Total
            |--------------------------------------------------------------------------
            */

            $total = 0;

            foreach ($cartItems as $item) {

                $total +=
                    $item->qty *
                    $item->product->harga;

            }

            /*
            |--------------------------------------------------------------------------
            | Ongkir
            |--------------------------------------------------------------------------
            */

            $ongkir = match ($request->provinsi) {

                'Sumatera Barat' => 15000,
                'Riau'           => 20000,
                'Jambi'          => 20000,
                'DKI Jakarta'    => 25000,
                'Jawa Barat'     => 25000,
                'Jawa Tengah'    => 30000,
                'Jawa Timur'     => 30000,
                'Kalimantan'     => 40000,
                'Papua'          => 60000,

                default => 20000,

            };

            $grandTotal = $total + $ongkir;

            /*
            |--------------------------------------------------------------------------
            | Buat Order
            |--------------------------------------------------------------------------
            */

            $order = Order::create([

                'user_id'           => auth()->id(),
                'kode_order'        => 'ORD-' . now()->format('YmdHis'),
                'nama_penerima'     => $request->nama_penerima,
                'no_telp_penerima'  => $request->telp_penerima,
                'alamat_pengiriman' => $request->alamat,
                'kota'              => $request->kota,
                'provinsi'          => $request->provinsi,
                'kode_pos'          => $request->kode_pos,
                'ongkos_kirim'      => $ongkir,
                'total_harga'       => $grandTotal,
                'status'            => 'menunggu_pembayaran',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Detail Order + Kurangi Stok
            |--------------------------------------------------------------------------
            */

            foreach ($cartItems as $item) {

                OrderItem::create([

                    'order_id'       => $order->id,
                    'merchandise_id' => $item->product->id,
                    'nama_produk'    => $item->product->nama,
                    'harga_satuan'   => $item->product->harga,
                    'kuantitas'      => $item->qty,
                    'subtotal'       => $item->qty * $item->product->harga,

                ]);

                $item->product->decrement(
                    'stok',
                    $item->qty
                );

            }

            /*
            |--------------------------------------------------------------------------
            | Jika checkout dari cart
            |--------------------------------------------------------------------------
            */

            if ($checkoutType == 'cart') {

                Cart::where('user_id', auth()->id())
                    ->whereIn('id', session('checkout_cart_ids'))
                    ->delete();

            }

            /*
            |--------------------------------------------------------------------------
            | Hapus Session
            |--------------------------------------------------------------------------
            */

            session()->forget([
                'checkout_type',
                'checkout_cart_ids',
                'checkout_product',
            ]);

            DB::commit();

            return redirect()
                ->route(
                    $this->roleRoute('orders.show'),
                    $order
                )
                ->with(
                    'success',
                    'Checkout berhasil.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
    public function show($id)
    {
        $order = Order::with('items.merchandise')
                    ->where('user_id', auth()->id())
                    ->findOrFail($id);

        return view(
            $this->roleView('orderDetail'),
            compact('order')
        );
    }

    public function bayar(Order $order)
    {
        abort_if(
            $order->user_id != auth()->id(),
            403
        );

        return view(
            $this->roleView('bayar'),
            compact('order')
        );
    }

    public function uploadBukti(Request $request,Order $order)
    {
        abort_if(
            $order->user_id != auth()->id(),
            403
        );

        $request->validate([
            'bukti_pembayaran' =>
                'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($order->bukti_pembayaran){

            Storage::disk('public')->delete(
                $order->bukti_pembayaran
            );
        }

        $path = $request
                    ->file('bukti_pembayaran')
                    ->store(
                        'bukti-pembayaran',
                        'public'
                    );

        $order->update([
            'bukti_pembayaran' => $path,
            'status' => 'menunggu_konfirmasi'
        ]);

        return redirect()
                ->route(
                    $this->roleRoute('orders.index'),
                    $order->id
                )
                ->with(
                    'success',
                    'Bukti pembayaran berhasil diupload'
                );
    }
    public function selesai(Order $order)
    {
        if ($order->status != 'dikirim') {
            return back();
        }

        $totalBelanja = $order->total_harga;

        // 1 poin setiap Rp20.000
        $poin = $this->poinService->hitungPoin($totalBelanja, 'order');

        app(PoinService::class)->tambahPoin(

            $order->user,
            $poin,
            'merchandise',
            $order,
            "Belanja Order #{$order->kode_order}"

        );

        $order->update([

            'status' => 'selesai',
            'tanggal_selesai' => now(),
            'poin_diberikan' => $poin

        ]);

        return back()->with(
            'success',
            "Pesanan berhasil diselesaikan. +{$poin} poin."
        );
    } 
    public function batal(Request $request, Order $order)
    {
        if($order->status == 'selesai')
        {
            return back()->with(
                'error',
                'Pesanan yang sudah selesai tidak dapat dibatalkan.'
            );
        }

        $request->validate([
            'alasan_batal' => 'required|string|max:500'
        ]);

        $order->update([
            'status' => 'dibatalkan',
            'alasan_batal' => $request->alasan_batal
        ]);

        return back()->with(
            'success',
            'Pesanan berhasil dibatalkan.'
        );
    }
   
}