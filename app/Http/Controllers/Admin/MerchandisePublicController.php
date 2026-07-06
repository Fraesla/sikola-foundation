<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class MerchandisePublicController extends Controller
{

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

    public function create()
    {
        $cartItems = Cart::where('user_id',auth()->id())
                        ->with('product')
                        ->get();

        if($cartItems->count() == 0){
            return redirect()
                    ->route('pembeli.keranjang.index');
        }

        return view(
            $this->roleView('checkout'),
            compact('cartItems')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima'=>'required',
            'telp_penerima'=>'required',
            'alamat'=>'required',
            'kota'=>'required'
        ]);

        DB::beginTransaction();

        try{

            $cartItems = Cart::where('user_id',auth()->id())
                            ->with('product')
                            ->get();

            $total = 0;

            foreach($cartItems as $cart){
                $total +=
                    $cart->qty *
                    $cart->product->harga;
            }

            $grandTotal = $total + $ongkir;

            $ongkir = match($request->provinsi) {

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

            $order = Order::create([
                'user_id'             => auth()->id(),
                'kode_order'          => 'ORD-'.date('YmdHis'),
                'nama_penerima'       => $request->nama_penerima,
                'no_telp_penerima'    => $request->telp_penerima,
                'alamat_pengiriman'   => $request->alamat,
                'kota'                => $request->kota,
                'provinsi'            => $request->provinsi,
                'kode_pos'            => $request->kode_pos,
                'ongkos_kirim'        => $ongkir,
                'total_harga'         => $total,
                'status'              => 'menunggu_pembayaran'
            ]);

            foreach($cartItems as $cart){

                OrderItem::create([
                    'order_id'        => $order->id,
                    'merchandise_id'  => $cart->merchandise_id,
                    'nama_produk'     => $cart->product->nama,
                    'harga_satuan'    => $cart->product->harga,
                    'kuantitas'       => $cart->qty,
                    'subtotal'        => $cart->qty * $cart->product->harga
                ]);
            }

            Cart::where(
                'user_id',
                auth()->id()
            )->delete();

            DB::commit();

            return redirect()
                    ->route(
                        $this->roleRoute('orders.show'),
                        $order->id
                    )
                    ->with(
                        'success',
                        'Checkout berhasil'
                    );

        }catch(\Exception $e){

            DB::rollback();

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
                    'pembeli.orders.index',
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

        $totalPoin = $order->items->sum(function ($item) {

            return ($item->merchandise->poin_reward ?? 0)
                    * $item->kuantitas;
        });

        $order->update([
            'status' => 'selesai',
            'tanggal_selesai' => now(),
            'poin_diberikan' => $totalPoin
        ]);

        auth()->user()->increment('total_poin', $totalPoin);

        return back()->with(
            'success',
            "Pesanan berhasil diselesaikan. +{$totalPoin} poin"
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