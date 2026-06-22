<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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

        $orders = $query->paginate(10)->withQueryString();

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
        return view(
            'admin.orders.show',
            compact('order')
        );
    }

    public function update(Request $request, Order $order)
    {
        $order->update([
            'status'=>$request->status,
            'no_resi'=>$request->no_resi,
            'catatan'=>$request->catatan,
            'dikonfirmasi_oleh'=>auth()->id(),
            'dikonfirmasi_at'=>now()
        ]);

        return back()->with(
            'success',
            'Order berhasil diperbarui'
        );
    }
}
