<?php

namespace App\Services;

use App\Models\Donasi;
use App\Models\RiwayatLanggananPembayaran;
use Illuminate\Support\Facades\DB;

class DonasiService
{
    /*
    |--------------------------------------------------------------------------
    | Total dana semua kategori
    |--------------------------------------------------------------------------
    */

    public function totalDana()
    {
        $sekali = Donasi::where('tipe', 'sekali')
            ->where('status', 'dikonfirmasi')
            ->sum('jumlah');

        $bulanan = RiwayatLanggananPembayaran::where('status', 'dikonfirmasi')
            ->sum('jumlah');

        return $sekali + $bulanan;
    }

    /*
    |--------------------------------------------------------------------------
    | Total dana per kategori
    |--------------------------------------------------------------------------
    */

    public function totalDanaKategori($kategoriId)
    {
        $sekali = Donasi::where('donation_category_id', $kategoriId)
            ->where('tipe', 'sekali')
            ->where('status', 'dikonfirmasi')
            ->sum('jumlah');

        $bulanan = RiwayatLanggananPembayaran::where('status', 'dikonfirmasi')
            ->whereHas('donasi', function ($q) use ($kategoriId) {
                $q->where('donation_category_id', $kategoriId);
            })
            ->sum('jumlah');

        return $sekali + $bulanan;
    }

    /*
    |--------------------------------------------------------------------------
    | Jumlah donatur
    |--------------------------------------------------------------------------
    */

    public function totalDonaturKategori($kategoriId)
    {
        $sekali = Donasi::where('donation_category_id', $kategoriId)
            ->where('tipe', 'sekali')
            ->where('status', 'dikonfirmasi')
            ->distinct('user_id')
            ->count('user_id');

        $bulanan = Donasi::where('donation_category_id', $kategoriId)
            ->where('tipe', 'bulanan')
            ->whereHas('langganan.riwayat', function ($q) {
                $q->where('status', 'dikonfirmasi');
            })
            ->distinct('user_id')
            ->count('user_id');

        return $sekali + $bulanan;
    }

    /*
    |--------------------------------------------------------------------------
    | Grafik dashboard
    |--------------------------------------------------------------------------
    */

    public function chartTahunan($tahun = null)
    {
        $tahun ??= now()->year;

        $sekali = Donasi::selectRaw("
                MONTH(created_at) as bulan,
                SUM(jumlah) as total
            ")
            ->where('status', 'dikonfirmasi')
            ->where('tipe', 'sekali')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $bulanan = RiwayatLanggananPembayaran::selectRaw("
                MONTH(created_at) as bulan,
                SUM(jumlah) as total
            ")
            ->where('status', 'dikonfirmasi')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $labels = [];
        $data = [];

        for ($i = 1; $i <= 12; $i++) {

            $labels[] = date('M', mktime(0, 0, 0, $i, 1));

            $data[] =
                ($sekali[$i] ?? 0)
                +
                ($bulanan[$i] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Donatur terbaru
    |--------------------------------------------------------------------------
    */

    public function donaturTerbaru($kategoriId, $limit = 10)
    {
        $sekali = Donasi::select(
                'user_id',
                'jumlah',
                'created_at',
                DB::raw("'sekali' as tipe")
            )
            ->where('donation_category_id', $kategoriId)
            ->where('tipe', 'sekali')
            ->where('status', 'dikonfirmasi');

        $bulanan = RiwayatLanggananPembayaran::select(
                'donasis.user_id',
                'riwayat_langganan_pembayaran.jumlah',
                'riwayat_langganan_pembayaran.created_at',
                DB::raw("'bulanan' as tipe")
            )
            ->join('donasis', 'donasis.id', '=', 'riwayat_langganan_pembayaran.donasi_id')
            ->where('donasis.donation_category_id', $kategoriId)
            ->where('riwayat_langganan_pembayaran.status', 'dikonfirmasi');

        return $sekali
            ->unionAll($bulanan)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }
}