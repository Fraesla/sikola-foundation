<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\EventRegistrasi;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DaftarEventController extends Controller
{
    public function index(Request $request)
    {
        $registrasi = EventRegistrasi::with([
            'user',
            'event'
        ])

        ->when($request->filled('search'), function ($q) use ($request) {

            $q->where(function ($query) use ($request) {

                $query->whereHas('user', function ($user) use ($request) {

                    $user->where('name', 'like', "%{$request->search}%")
                         ->orWhere('email', 'like', "%{$request->search}%");

                });

                $query->orWhereHas('event', function ($event) use ($request) {

                    $event->where('judul', 'like', "%{$request->search}%");

                });

            });

        })

        ->when($request->filled('status'), function ($q) use ($request) {

            $q->where('status', $request->status);

        })

        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view(
            'admin.event.daftar.peserta',
            compact('registrasi')
        );
    }
    public function show($id)
    {
        $registrasi = EventRegistrasi::with([
            'user',
            'event'
        ])->findOrFail($id);

        return view(
            'admin.event.daftar.show',
            compact('registrasi')
        );
    }
    public function konfirmasi(EventRegistrasi $registrasi)
    {
        if ($registrasi->status != 'mendaftar') {
            return back()->with(
                'error',
                'Peserta sudah dikonfirmasi.'
            );
        }

        try {
            DB::transaction(function () use ($registrasi) {
                $event = Event::findOrFail($registrasi->event_id);

                /*
                |--------------------------------------------------------------------------
                | Cek kuota
                |--------------------------------------------------------------------------
                */
                $jumlahPeserta = Peserta::where(
                    'event_id',
                    $event->id
                )->count();

                // Cek jika kuota event dibatasi dan sudah habis
                if ($event->kuota !== null && $event->kuota <= 0) {
                    throw new \Exception('Kuota event sudah penuh.');
                }

                /*
                |--------------------------------------------------------------------------
                | Update registrasi & Kurangi Kuota Event
                |--------------------------------------------------------------------------
                */
                $registrasi->update([
                    'status' => 'dikonfirmasi'
                ]);

                // Mengurangi kuota pada tabel events
                if ($event->kuota !== null) {
                    $event->decrement('kuota');
                }

                /*
                |--------------------------------------------------------------------------
                | Masukkan ke tabel peserta
                |--------------------------------------------------------------------------
                */
                Peserta::create([
                    'event_id'             => $event->id,
                    'event_registrasi_id'  => $registrasi->id,
                    'user_id'              => $registrasi->user_id,
                    'status'               => 'aktif',
                    'total_scan'           => 0,
                    'total_hadir'          => 0,
                    'total_tidak_hadir'    => 0,
                    'persentase_hadir'     => 0,
                    'poin'                 => 0,
                    'sertifikat'           => null,
                    'sertifikat_diterbitkan' => null,
                    'catatan'              => null,
                    'poin_berikan'         => null,
                    'created_by'           => Auth::id(),
                    'updated_by'           => null,
                ]);
            });

            return back()->with(
                'success',
                'Peserta berhasil dikonfirmasi dan kuota event telah dikurangi.'
            );

        } catch (\Throwable $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
    public function tolak(EventRegistrasi $registrasi)
    {
        DB::transaction(function () use ($registrasi) {

            Peserta::where(
                'event_registrasi_id',
                $registrasi->id
            )->delete();

            $registrasi->update([
                'status' => 'ditolak'
            ]);

        });

        return back()->with(
            'success',
            'Registrasi berhasil ditolak.'
        );
    }
}