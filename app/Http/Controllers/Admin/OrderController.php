<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('kode_order', 'like', '%'.$request->search.'%')
                  ->orWhere('nama_penerima', 'like', '%'.$request->search.'%');
            });
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Sorting
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $orders = Order::with('items.merchandise')
                ->latest()
                ->paginate(5);

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

            'orderSelesai' => Order::where(
                'status',
                'dikirim'
            )->orWhere(
                'status',
                'selesai'
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

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'ekspedisi'=>'required',
            'no_resi'=>'required'
        ]);

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
}
