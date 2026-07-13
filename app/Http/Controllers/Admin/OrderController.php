<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with([
            'user',
            'items.merchandise'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('kode_order', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_penerima', 'like', '%' . $request->search . '%');

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        if ($request->sort == 'oldest') {

            $query->oldest();

        } else {

            $query->latest();

        }

        /*
        |--------------------------------------------------------------------------
        | Execute Query
        |--------------------------------------------------------------------------
        */

        $orders = $query->paginate(5)->withQueryString();

        return view('admin.orders.index', [

            'orders' => $orders,

            'totalOrder' => Order::count(),

            'orderBaru' => Order::where(
                'status',
                'menunggu_konfirmasi'
            )->count(),

            'orderDiproses' => Order::where(
                'status',
                'diproses'
            )->count(),

            'orderSelesai' => Order::whereIn(
                'status',
                ['dikirim', 'selesai']
            )->count(),

        ]);
    }


    public function show(Order $order)
    {
        $order->load('items.merchandise');

        return view(
            'admin.orders.detail    ',
            compact('order')
        );
    }

    public function edit(Order $order)
    {
        return view(
            'admin.orders.edit',
            compact('order')
        );
    }

    public function refund(Order $order)
    {
        return view(
            'admin.orders.refund',
            compact('order')
        );
    }

    public function refundProcess(Request $request, Order $order)
    {
        $request->validate([
            'bukti_refund' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Upload Bukti Refund
            |--------------------------------------------------------------------------
            */

            $file = $request->file('bukti_refund');

            $namaFile = $file->store(
                'bukti-refund',
                'public'
            );

            /*
            |--------------------------------------------------------------------------
            | Barang pernah dikirim?
            |--------------------------------------------------------------------------
            */

            if ($order->no_resi && $order->ekspedisi) {

                foreach ($order->items as $item) {

                    $item->merchandise->increment(
                        'stok',
                        $item->kuantitas
                    );

                }

            }

            /*
            |--------------------------------------------------------------------------
            | Update Order
            |--------------------------------------------------------------------------
            */

            $order->update([

                'bukti_refund' => $namaFile,

                'status' => 'selesai',

                'dikonfirmasi_oleh' => auth()->id(),

                'dikonfirmasi_at' => now()

            ]);

            DB::commit();

            return redirect()
                    ->route('admin.orders.index')
                    ->with(
                        'success',
                        'Refund berhasil diproses.'
                    );

        } catch (\Exception $e) {

            DB::rollback();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }
    public function selesai(Order $order)
    {

        $order->update([

            'status' => 'selesai'

        ]);

        return redirect()
                ->route(
                    'admin.orders.index',
                    $order->id
                )
                ->with(
                    'success',
                    'Pesanan berhasil diselesaikan.'
                );
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'ekspedisi'=>'required',
            'no_resi'=>'required'
        ]);

        foreach($order->items as $item){

            $produk = Merchandise::find($item->merchandise_id);

            if($produk){

                $produk->decrement(
                    'stok',
                    (int) $item->kuantitas
                );

            }
        }

        $order->update([
            'ekspedisi'=>$request->ekspedisi,
            'no_resi'=>$request->no_resi,
            'catatan'=>$request->catatan,
            'status'=>'dikirim'
        ]);

        return redirect()
                ->route('admin.orders.index')
                ->with(
                    'success',
                    'Pesanan berhasil dikirim'
                );

    }

    public function konfirmasi(Order $order)
    {
        $order->update([
            'status'=>'dikonfirmasi',
            'dikonfirmasi_oleh'=>auth()->id(),
            'dikonfirmasi_at'=>now()
        ]);

        return back()->with(
            'success',
            'Pembayaran berhasil dikonfirmasi'
        );
    }

    public function proses(Order $order)
    {
        $order->update([
            'status' => 'diproses'
        ]);

        return back()->with(
            'success',
            'Pesanan sedang diproses'
        );
    }
    public function tolak(Request $request, Order $order)
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
            'alasan_batal' => $request->alasan_batal,
            'dikonfirmasi_oleh' => auth()->id(),
            'dikonfirmasi_at' => now()

        ]);

        return back()->with(
            'success',
            'Pesanan berhasil dibatalkan.'
        );
    }
}
