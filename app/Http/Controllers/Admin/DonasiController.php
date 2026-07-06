<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonationCategory;
use App\Models\Donasi;
use App\Models\DonasiLangganan;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Notifications\DonasiBaruNotification;

class DonasiController extends Controller
{
    public function index(Request $request)
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
        $totalDonasi = Donasi::where('status', 'dikonfirmasi')->sum('jumlah');

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
    public function konfirmasi(Donasi $donasi)
    {
        DB::transaction(function () use ($donasi) {

            // Hindari double verifikasi
            if ($donasi->status == 'dikonfirmasi') {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Hitung poin
            | 1 poin = Rp 10.000
            |--------------------------------------------------------------------------
            */

            $poin = floor($donasi->jumlah / 10000);

            /*
            |--------------------------------------------------------------------------
            | Update donasi
            |--------------------------------------------------------------------------
            */

            $donasi->update([
                'status'              => 'dikonfirmasi',
                'poin_diberikan'      => $poin,
                'dikonfirmasi_oleh'   => auth()->id(),
                'dikonfirmasi_at'     => now(),
                'alasan_tolak'        => null
            ]);

            /*
            |--------------------------------------------------------------------------
            | Tambahkan poin user
            |--------------------------------------------------------------------------
            */

            $user = $donasi->user;

            $user->increment('total_poin', $poin);

            /*
            |--------------------------------------------------------------------------
            | Jika ada service tier
            |--------------------------------------------------------------------------
            */

            // app(TierService::class)->recalculate($user);

            /*
            |--------------------------------------------------------------------------
            | Kirim notifikasi
            |--------------------------------------------------------------------------
            */

            // $user->notify(new DonasiBerhasilNotification($donasi));

        });

        return back()->with(
            'success',
            'Donasi berhasil dikonfirmasi'
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
