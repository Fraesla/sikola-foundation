<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Order;
use App\Models\EventRegistrasi;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // Total donasi berhasil
        $totalDonasi = Donasi::where('status', 'dikonfirmasi')
            ->sum('jumlah');

        // Total penjualan merchandise
        $totalMerchandise = Order::where('status', 'selesai')
            ->sum('total_harga');

        // Total peserta hadir
        $totalRelawan = EventRegistrasi::where('status', 'hadir')
            ->count();

        // Grafik Donasi Bulanan
        $donasiBulanan = Donasi::selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('total','bulan');

        $labels = [];
        $data = [];

        for($i=1;$i<=12;$i++){

            $labels[] = date('M', mktime(0,0,0,$i,1));

            $data[] = $donasiBulanan[$i] ?? 0;
        }

        return view('admin.laporan.index', compact(
            'totalDonasi',
            'totalMerchandise',
            'totalRelawan',
            'labels',
            'data'
        ));
    }
    public function exportExcel()
    {
        return Excel::download(
            new LaporanExport,
            'laporan-donasi.xlsx'
        );
    }
    public function exportPdf()
    {
        $donasi = Donasi::with('user')
                ->latest()
                ->get();

        $pdf = Pdf::loadView(
            'admin.laporan.pdf',
            compact('donasi')
        );

        return $pdf->download('laporan-donasi.pdf');
    }
}
