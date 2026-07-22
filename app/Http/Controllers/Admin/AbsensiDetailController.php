<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Peserta;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Services\EventAttendanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiDetailController extends Controller
{
    protected EventAttendanceService $attendanceService;

    public function __construct(EventAttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }
    /**
     * Daftar event.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');

            });

        }

        $events = $query
            ->latest('tanggal_mulai')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.absensi-detail.index',
            compact('events')
        );
    }

    /**
     * Daftar peserta event.
     */
    public function peserta(Event $event)
    {
        $pesertas = Peserta::with([
            'user',
            'absensi'
        ])
        ->where('event_id', $event->id)
        ->where('status', 'aktif')
        ->orderBy('id')
        ->paginate(15);

        return view(
            'admin.absensi-detail.peserta',
            compact(
                'event',
                'pesertas'
            )
        );
    }

    /**
     * Form input absensi.
     */
    public function create(Event $event)
    {
        $pesertas = Peserta::with([
            'user',
            'absensiDetails'
        ])
        ->where('event_id',$event->id)
        ->where('status','aktif')
        ->orderBy('id')
        ->get();

        return view(
            'admin.absensi-detail.create',
            compact(
                'event',
                'pesertas'
            )
        );
    }
    /**
     * Simpan absensi detail.
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([

            'event_peserta_id'=>'required|exists:pesertas,id',

            'tipe'=>'required|in:masuk,keluar',

            'status'=>'required|in:hadir,tidak_hadir',

            'catatan'=>'nullable|string'

        ]);

        DB::transaction(function() use($request,$event){

            $absensi = Absensi::firstOrCreate(

                [

                    'event_id'=>$event->id,

                    'event_peserta_id'=>$request->event_peserta_id,

                ]

            );

            AbsensiDetail::create([

                'event_id'=>$event->id,

                'absensi_id'=>$absensi->id,

                'event_peserta_id'=>$request->event_peserta_id,

                'tipe'=>$request->tipe,

                'status'=>$request->status,

                'scan_at'=>now(),

                'valid'=>true,

                'catatan'=>$request->catatan,

            ]);

        });

        return back()->with(
            'success',
            'Scan berhasil disimpan.'
        );
    }

    /**
     * Form edit absensi detail.
     */
    public function edit(AbsensiDetail $detail)
    {
        $detail->load([

            'event',

            'peserta.user',

        ]);

        return view(
            'admin.absensi-detail.edit',
            compact('detail')
        );
    }

    /**
     * Update absensi detail.
     */
    public function update(Request $request, AbsensiDetail $detail)
    {
        $request->validate([

            'tipe'=>'required|in:masuk,keluar',

            'status'=>'required|in:hadir,tidak_hadir',

            'valid'=>'required|boolean',

            'catatan'=>'nullable|string',

        ]);

        $detail->update([

            'tipe'=>$request->tipe,

            'status'=>$request->status,

            'valid'=>$request->valid,

            'catatan'=>$request->catatan,

        ]);

        return back()->with(
            'success',
            'Data scan berhasil diperbarui.'
        );
    }
        /**
     * Hapus absensi detail.
     */
    public function destroy(AbsensiDetail $detail)
    {
        $detail->delete();

        return back()->with(
            'success',
            'Absensi detail berhasil dihapus.'
        );
    }

    /**
     * Riwayat scan peserta.
     */
    public function riwayat(Peserta $peserta)
    {
        $details = AbsensiDetail::where(
            'event_peserta_id',
            $peserta->id
        )
        ->orderBy('scan_at')
        ->paginate(20);

        return view(
            'admin.absensi-detail.riwayat',
            compact(
                'peserta',
                'details'
            )
        );
    }

    /**
     * Rekap seluruh scan event.
     */
    public function rekap(Event $event)
    {
        $pesertas = Peserta::with([
            'user',
            'absensi',
        ])
        ->where('event_id', $event->id)
        ->orderBy('id')
        ->get();

        return view(
            'admin.absensi-detail.rekap',
            compact(
                'event',
                'pesertas'
            )
        );
    }

    /**
     * Generate rekap absensi.
     */
    public function generateRekap(Event $event)
    {
        $this->attendanceService->generate($event);

        return back()->with(
            'success',
            'Rekap berhasil dibuat.'
        );
    }
    // public function generateRekap(Event $event)
    // {
    //     DB::beginTransaction();

    //     try {

    //         $pesertas = Peserta::where(
    //                 'event_id',
    //                 $event->id
    //             )
    //             ->get();

    //         foreach ($pesertas as $peserta) {

    //             /*
    //             |--------------------------------------------------------------------------
    //             | Hitung seluruh scan
    //             |--------------------------------------------------------------------------
    //             */

    //             $totalScan = AbsensiDetail::where(
    //                     'event_peserta_id',
    //                     $peserta->id
    //                 )
    //                 ->count();

    //             /*
    //             |--------------------------------------------------------------------------
    //             | Hitung hadir
    //             |--------------------------------------------------------------------------
    //             */

    //             $totalHadir = AbsensiDetail::where(
    //                     'event_peserta_id',
    //                     $peserta->id
    //                 )
    //                 ->where('status', 'hadir')
    //                 ->count();

    //             /*
    //             |--------------------------------------------------------------------------
    //             | Hitung tidak hadir
    //             |--------------------------------------------------------------------------
    //             */

    //             $totalTidakHadir = AbsensiDetail::where(
    //                     'event_peserta_id',
    //                     $peserta->id
    //                 )
    //                 ->where('status', 'tidak_hadir')
    //                 ->count();

    //             /*
    //             |--------------------------------------------------------------------------
    //             | Persentase
    //             |--------------------------------------------------------------------------
    //             */

    //             $persentase = $totalScan > 0
    //                 ? round(($totalHadir / $totalScan) * 100, 2)
    //                 : 0;

    //             /*
    //             |--------------------------------------------------------------------------
    //             | Status kelulusan
    //             |--------------------------------------------------------------------------
    //             */

    //             $status = $totalHadir > $totalTidakHadir
    //                 ? 'lulus'
    //                 : 'tidak_lulus';

    //             /*
    //             |--------------------------------------------------------------------------
    //             | Poin
    //             |--------------------------------------------------------------------------
    //             */

    //             $point = $status == 'lulus'
    //                 ? $event->poin_reward
    //                 : 0;

    //             /*
    //             |--------------------------------------------------------------------------
    //             | Simpan ke tabel absensis
    //             |--------------------------------------------------------------------------
    //             */

    //             Absensi::updateOrCreate(

    //                 [

    //                     'event_id' => $event->id,

    //                     'event_peserta_id' => $peserta->id,

    //                 ],

    //                 [

    //                     'total_scan' => $totalScan,

    //                     'total_hadir' => $totalHadir,

    //                     'total_tidak_hadir' => $totalTidakHadir,

    //                     'persentase_hadir' => $persentase,

    //                     'status_kelulusan' => $status,

    //                     'point_diberikan' => $point,

    //                     'direkap_pada' => now(),

    //                 ]

    //             );

    //         }

    //         DB::commit();

    //         return back()->with(
    //             'success',
    //             'Rekap absensi berhasil dibuat.'
    //         );

    //     } catch (\Exception $e) {

    //         DB::rollBack();

    //         return back()->with(
    //             'error',
    //             $e->getMessage()
    //         );

    //     }
    // }
}
