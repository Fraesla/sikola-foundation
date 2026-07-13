<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\DonationCategory;
use App\Models\Donasi;
use App\Models\DonasiLangganan;
use App\Services\DonasiService;
use App\Models\RiwayatLanggananPembayaran;
use App\Models\User;
use App\Services\PoinService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\KategoriPoin;
use App\Notifications\DonasiBaruNotification;

class DonasiController extends Controller
{
    protected PoinService $poinService;

    public function __construct(PoinService $poinService)
    {
        $this->poinService = $poinService;
    }
    public function index(Request $request, DonasiService $donasiService)
    {
        $query = Donasi::with(['user','kategori','langganan']);

        // SEARCH
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('id', $request->search)

                    ->orWhereHas('user', function ($u) use ($request) {
                        $u->where(
                            'name',
                            'like',
                            '%' . $request->search . '%'
                        );
                    })

                    ->orWhereHas('kategori', function ($k) use ($request) {
                        $k->where(
                            'nama',
                            'like',
                            '%' . $request->search . '%'
                        );
                    });
            });
        }

        // FILTER STATUS
        if ($request->filled('status')) {

            switch ($request->status) {

                case 'menunggu_pembayaran':
                    $query->where('status', 'menunggu')
                        ->whereNull('bukti_transfer');
                    break;

                case 'menunggu_verifikasi':
                    $query->where('status', 'menunggu')
                        ->whereNotNull('bukti_transfer');
                    break;

                case 'dikonfirmasi':
                    $query->where('status', 'dikonfirmasi');
                    break;

                case 'ditolak':
                    $query->where('status', 'ditolak');
                    break;
            }
        }

        $donasis = $query->latest()->paginate(5)->withQueryString();

        // Statistik
        $totalDonasi = $donasiService->totalDana();

        $pending = Donasi::where('status', 'menunggu')->count();

        $donaturAktif = User::has('donasis')->count();

        $langgananAktif = DonasiLangganan::where('is_aktif',1)->count();

        // $admins = User::where('role','admin')->get();

        // foreach($admins as $admin){

        //     $admin->notify(

        //         new DonasiBaruNotification($donasi)

        //     );

        // }

        return view(
            'admin.donasi.donatur.index',
            compact(
                'donasis',
                'totalDonasi',
                'pending',
                'donaturAktif',
                'langgananAktif'
            )
        );
    }
    public function show(Donasi $donasi)
    {
        $donasi->load([
            'user',
            'kategori'
        ]);

        return view(
            'admin.donasi.donatur.show',
            compact('donasi')
        );
    }

    public function detail(Donasi $donasi)
    {
        $donasi->load([
            'user',
            'kategori'
        ]);

        return view(
            'admin.donasi.donatur.detail',
            compact('donasi')
        );
    }

    public function langganan(Request $request, Donasi $donasi)
    {
        $donasi->load([
            'user',
            'kategori',
            'langganan'
        ]);

        $riwayat = RiwayatLanggananPembayaran::with([
                'donasi.user',
                'langganan'
            ])
            ->where('langganan_id', $donasi->langganan->id)
            ->when($request->search, function ($q) use ($request) {

                $q->whereHas('donasi.user', function ($qq) use ($request) {

                    $qq->where(
                        'name',
                        'like',
                        '%'.$request->search.'%'
                    );

                });

            })
            ->when($request->status, function ($q) use ($request) {

                $q->where('status', $request->status);

            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        // ===============================
        // RINGKASAN
        // ===============================

        $target = $donasi->langganan->jumlah_bulanan;

        $riwayatSemua = RiwayatLanggananPembayaran::where(
            'langganan_id',
            $donasi->langganan->id
        )->get();

        $totalDonasi = $riwayatSemua
            ->where('status', 'dikonfirmasi')
            ->sum('jumlah');

        $totalPoin = $riwayatSemua
            ->where('status', 'dikonfirmasi')
            ->sum('poin');

        $totalBonus = $riwayatSemua
            ->where('status', 'dikonfirmasi')
            ->sum('bonus');

        $progress = $target > 0
            ? min(($totalDonasi / $target) * 100, 100)
            : 0;

        return view(
            'admin.donasi.donatur.langganan',
            compact(
                'donasi',
                'riwayat',
                'target',
                'totalDonasi',
                'totalPoin',
                'totalBonus',
                'progress'
            )
        );
    }

    public function langgananKonfirmasi(RiwayatLanggananPembayaran $riwayat)
    {
        if ($riwayat->status == 'dikonfirmasi') {

            return back()->with(
                'warning',
                'Pembayaran sudah dikonfirmasi.'
            );

        }

        DB::transaction(function () use ($riwayat) {

            $langganan = $riwayat->langganan;
            $donasi    = $riwayat->donasi;
            $user      = $donasi->user;

            /*
            |--------------------------------------------------------------------------
            | Hitung poin dari config
            |--------------------------------------------------------------------------
            */

            $poin = app(PoinService::class)
                ->hitungPoinLangganan($riwayat);

            /*
            |--------------------------------------------------------------------------
            | Update pembayaran
            |--------------------------------------------------------------------------
            */

            $riwayat->update([

                'status'            => 'dikonfirmasi',

                'poin'              => $poin,

                'bonus'             => 0,

                'dikonfirmasi_oleh' => auth()->id(),

                'dikonfirmasi_at'   => now(),

            ]);

            /*
            |--------------------------------------------------------------------------
            | Hitung total donasi periode
            |--------------------------------------------------------------------------
            */

            $totalDonasi = RiwayatLanggananPembayaran::where(
                    'langganan_id',
                    $langganan->id
                )
                ->where('periode', $riwayat->periode)
                ->where('status', 'dikonfirmasi')
                ->sum('jumlah');

            /*
            |--------------------------------------------------------------------------
            | Bonus hanya sekali jika target tercapai
            |--------------------------------------------------------------------------
            */

            $bonusSudahAda = RiwayatLanggananPembayaran::where(
                    'langganan_id',
                    $langganan->id
                )
                ->where('periode', $riwayat->periode)
                ->where('bonus', '>', 0)
                ->exists();

            if (
                !$bonusSudahAda &&
                $totalDonasi >= $langganan->jumlah_bulanan
            ) {

                $riwayat->update([

                    'bonus' => config('poin.donasi_bulanan.bonus', 10),

                    'bonus_periode' => $riwayat->periode,

                ]);

            }

            /*
            |--------------------------------------------------------------------------
            | Berikan poin yang belum pernah diberikan
            |--------------------------------------------------------------------------
            */

            $rewardBelum = RiwayatLanggananPembayaran::where(
                    'langganan_id',
                    $langganan->id
                )
                ->where('periode', $riwayat->periode)
                ->where('status', 'dikonfirmasi')
                ->whereNull('rewarded_at')
                ->get();

            foreach ($rewardBelum as $item) {

                $reward = $item->poin + $item->bonus;

                app(PoinService::class)->tambahPoin(

                    $user,

                    $reward,

                    KategoriPoin::DONASI_BULANAN,

                    $item,

                    "Pembayaran langganan {$item->periode}"

                );

                $item->update([

                    'rewarded_at' => now()

                ]);

            }

        });

        return back()->with(
            'success',
            'Pembayaran berhasil dikonfirmasi.'
        );
    }
    public function langgananTolak(Request $request,RiwayatLanggananPembayaran $riwayat)
    {

        $request->validate([

            'alasan_tolak'=>'required'

        ]);

        $riwayat->update([

            'status'=>'ditolak',

            'alasan_tolak'=>$request->alasan_tolak,

            'dikonfirmasi_oleh'=>auth()->id(),

            'dikonfirmasi_at'=>now(),

        ]);

        return back()->with(

            'success',

            'Pembayaran ditolak.'

        );

    }
    public function konfirmasi(Donasi $donasi)
    {
        DB::transaction(function () use ($donasi) {

            // Hindari double konfirmasi
            if ($donasi->status == 'dikonfirmasi') {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Hitung poin dari config
            |--------------------------------------------------------------------------
            */

           $poin = app(PoinService::class)->hitungPoinDonasi($donasi);

            /*
            |--------------------------------------------------------------------------
            | Jika donasi bulanan
            |--------------------------------------------------------------------------
            */

            if (
                $donasi->tipe == 'bulanan'
                && $donasi->tanggal_akhir
            ) {

                $donasi->tanggal_akhir = Carbon::parse(
                    $donasi->tanggal_akhir
                )->addMonth();

            }

            /*
            |--------------------------------------------------------------------------
            | Update donasi
            |--------------------------------------------------------------------------
            */

            $donasi->update([

                'status'            => 'dikonfirmasi',

                'poin_diberikan'    => $poin,

                'dikonfirmasi_oleh' => auth()->id(),

                'dikonfirmasi_at'   => now(),

                'alasan_tolak'      => null,

            ]);

            /*
            |--------------------------------------------------------------------------
            | Tambah poin user
            |--------------------------------------------------------------------------
            */

            $kategori = $donasi->tipe == 'bulanan'
                        ? KategoriPoin::DONASI_BULANAN
                        : KategoriPoin::DONASI_SEKALI;


            app(PoinService::class)->tambahPoin(

                $donasi->user,

                $poin,

                $kategori,

                $donasi,

                "Donasi {$donasi->kode}"

            );

        });

        return back()->with(
            'success',
            'Donasi berhasil dikonfirmasi.'
        );
    } 
    public function tolak(Request $request, Donasi $donasi)
    {
        $request->validate([
            'alasan_tolak' => 'required|string|max:500'
        ]);

        $donasi->update([
            'status' => 'ditolak',
            'alasan_tolak' => $request->alasan_tolak,
            'dikonfirmasi_oleh' => auth()->id(),
            'dikonfirmasi_at' => now()
        ]);

        return back()->with(
            'success',
            'Donasi berhasil ditolak'
        );
    }
}
