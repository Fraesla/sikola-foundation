<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MerchandisePublicController extends Controller
{
    public function index()
    {
        return view('admin.merchandise.dashboard',[
            'totalProduk' => Merchandise::count(),
            'totalStok' => Merchandise::sum('stok'),
            'produkAktif' => Merchandise::where('is_aktif',1)->count(),

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
                'selesai'
            )->count()
        ]);
    }
}
