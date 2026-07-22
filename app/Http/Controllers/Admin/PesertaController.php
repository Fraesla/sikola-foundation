<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Relawan;
use App\Models\EventRegistrasi;
use App\Models\Peserta;
use App\Models\User;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Services\EventAttendanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    /**
     * Daftar peserta.
     */
    public function index(Request $request)
    {
        $query = Peserta::with(['user','event','registrasi']);
        if ($request->filled('event')) {
            $query->where('event_id', $request->event);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {

            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });

        }
        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalPeserta = Peserta::count();
        $pesertaAktif = Peserta::where('status', 'aktif')->count();
        $pesertaLulus = Peserta::where('status', 'lulus')->count();
        $pesertaTidakLulus = Peserta::where('status', 'tidak_lulus')->count();
        $pesertas = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $events = Event::orderBy('judul')->get();
        return view('admin.event.peserta.index', compact(
            'pesertas',
            'events',
            'totalPeserta',
            'pesertaAktif',
            'pesertaLulus',
            'pesertaTidakLulus'
        ));
    }

    public function finalisasi(Event $event,EventAttendanceService $attendanceService)
    {
        if ($event->status == 'selesai') {

            return back()->with(
                'error',
                'Event sudah selesai.'
            );

        }

        DB::transaction(function () use ($event, $attendanceService) {

            // Generate seluruh peserta
            $attendanceService->finalisasi($event);

            // Tutup event
            $event->update([

                'status' => 'selesai',

            ]);

        });

        return back()->with(
            'success',
            'Event berhasil diselesaikan.'
        );
    }

    /**
     * Detail peserta.
     */
    public function show(Peserta $peserta)
    {
        $peserta->load([
            'user',
            'event',
            'event.creator',
            'relawan',
            'registrasi',
            'absensi.details'
        ]);

        return view(
            'admin.event.peserta.show',
            compact('peserta')
        );
    }

    /**
     * Konfirmasi registrasi menjadi peserta.
     */
    public function konfirmasi(EventRegistrasi $registrasi)
    {
        if ($registrasi->status == 'dikonfirmasi') {

            return back()->with(
                'warning',
                'Registrasi sudah dikonfirmasi.'
            );

        }

        DB::beginTransaction();

        try {

            $registrasi->update([
                'status' => 'dikonfirmasi'
            ]);

            Peserta::firstOrCreate(
                [
                    'event_id'=>$registrasi->event_id,
                    'user_id'=>$registrasi->user_id,
                ],

                [

                    'event_registrasi_id'=>$registrasi->id,

                    'status'=>'aktif',

                    'total_scan'=>0,

                    'total_hadir'=>0,

                    'total_tidak_hadir'=>0,

                    'persentase_hadir'=>0,

                    'poin'=>0,

                    'created_by'=>Auth::id()

                ]

            );

            DB::commit();

            return back()->with(
                'success',
                'Peserta berhasil dikonfirmasi.'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    /**
     * Hapus peserta.
     */
    public function destroy(Peserta $peserta)
    {
        DB::beginTransaction();

        try {

            if ($peserta->poin > 0) {

                $user = User::find($peserta->user_id);

                if ($user) {

                    $user->decrement(
                        'total_poin',
                        $peserta->poin
                    );

                }

            }

           $peserta->absensis()->delete();

           $peserta->delete();

            DB::commit();

            return back()->with(
                'success',
                'Peserta berhasil dihapus.'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }
    /**
     * Update data peserta.
     */
    public function update(Request $request, Peserta $peserta)
    {
        $request->validate([
            'catatan' => 'nullable|string',
        ]);

        $peserta->update([
            'catatan' => $request->catatan,
        ]);

        return back()->with(
            'success',
            'Data peserta berhasil diperbarui.'
        );
    }

    /**
     * Update status peserta.
     */
    public function updateStatus(Request $request, Peserta $peserta)
    {
        $request->validate([
            'status' => 'required|in:aktif,lulus,tidak_lulus,noaktif',
        ]);

        $peserta->update([
            'status' => $request->status,
        ]);

        return back()->with(
            'success',
            'Status peserta berhasil diperbarui.'
        );
    }

    /**
     * Update poin peserta.
     */
    public function updatePoin(Request $request, Peserta $peserta)
    {
        $request->validate([
            'poin' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();

        try {

            $user = User::find($peserta->user_id);

            $poinLama = $peserta->poin;
            $poinBaru = $request->poin;

            $selisih = $poinBaru - $poinLama;

            $peserta->update([

                'poin'=>$poinBaru,

                'updated_by'=>Auth::id()

            ]);
            if ($user) {

                $user->increment('total_poin', $selisih);

            }

            DB::commit();

            return back()->with(
                'success',
                'Poin peserta berhasil diperbarui.'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    /**
     * Upload sertifikat peserta.
     */
    public function uploadSertifikat(Request $request, Peserta $peserta)
    {
        $request->validate([
            'sertifikat' => 'required|mimes:pdf|max:4096',
        ]);

        DB::beginTransaction();

        try {

            if ($peserta->sertifikat) {

                Storage::disk('public')
                    ->delete($peserta->sertifikat);

            }

            $path = $request->file('sertifikat')
                ->store('sertifikat/event', 'public');

            $peserta->update([
                'sertifikat' => $path,
                'sertifikat_diterbitkan' => now(),
                'updated_by'=>Auth::id()
            ]);

            DB::commit();

            return back()->with(
                'success',
                'Sertifikat berhasil diupload.'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    /**
     * Download sertifikat.
     */
    public function downloadSertifikat(Peserta $peserta)
    {
        if (!$peserta->sertifikat) {

            return back()->with(
                'error',
                'Sertifikat belum tersedia.'
            );

        }

        return Storage::disk('public')
            ->download($peserta->sertifikat);
    }

    /**
     * Riwayat event yang pernah diikuti user.
     */
    public function riwayat(User $user)
    {
        $pesertas = Peserta::with([
            'event',
            'absensi.details'

        ])
        ->where('user_id', $user->id)
        ->latest()
        ->paginate(10);

        return view(
            'admin.event.peserta.riwayat',
            compact(
                'user',
                'pesertas'
            )
        );
    }
    /**
     * Detail absensi peserta.
     */
    public function detailAbsensi(Peserta $peserta)
    {
        $absensis = Absensi::with('details')
                ->where('event_peserta_id',$peserta->id)
                ->orderBy('hari_ke')
                ->get();

        $event = $peserta->event;

        $totalHari = Carbon::parse($event->tanggal_mulai)
            ->diffInDays(
                Carbon::parse($event->tanggal_selesai)
            ) + 1;

        $totalScan = $peserta->total_scan;

        $totalHadir = $peserta->total_hadir;

        $totalTidakHadir = $peserta->total_tidak_hadir;

        $persentase = $peserta->persentase_kehadiran;

        return view(
            'admin.event.peserta.absensi',
            compact(
                'peserta',
                'absensis',
                'totalHari',
                'totalScan',
                'totalHadir',
                'totalTidakHadir',
                'persentase'
            )
        );
    }
    /**
     * Hitung persentase kehadiran.
     */
    // private function hitungPersentase(Peserta $peserta)
    // {
    //     $event = $peserta->event;

    //     $totalHari = Carbon::parse($event->tanggal_mulai)
    //         ->diffInDays(
    //             Carbon::parse($event->tanggal_selesai)
    //         ) + 1;

    //     $hadir = EventAbsensi::where(
    //             'event_peserta_id',
    //             $peserta->id
    //         )
    //         ->where('status','hadir')
    //         ->count();

    //     if ($totalHari == 0) {
    //         return 0;
    //     }

    //     return round(($hadir / $totalHari) * 100,2);
    // }
}
