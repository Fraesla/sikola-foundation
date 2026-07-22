<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Peserta;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Daftar event yang dapat dilakukan absensi.
     */
    public function index(Request $request)
    {
        $events = Event::query()
            ->withCount([
                'pesertas',
                'absensis',
            ])
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('judul', 'like', '%' . $request->search . '%')
                        ->orWhere('lokasi', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->latest('tanggal_mulai')
            ->paginate(10)
            ->withQueryString();

        // ==========================================
        // Status Absensi & Pengecekan Tanggal
        // ==========================================
        $events->getCollection()->transform(function ($event) {
            $today = now()->startOfDay();
            $mulai = \Carbon\Carbon::parse($event->tanggal_mulai)->startOfDay();
            $selesai = \Carbon\Carbon::parse($event->tanggal_selesai)->startOfDay();

            if ($event->absensis_count == 0) {
                // Cek apakah sudah masuk masa mulai event atau belum
                if ($today->lt($mulai)) {
                    $event->status_absensi = 'belum_mulai'; // Belum waktunya generate
                } else {
                    $event->status_absensi = 'belum_generate'; // Sudah bisa digenerate
                }
            } elseif ($event->status == 'selesai' || $today->gt($selesai)) {
                $event->status_absensi = 'selesai';
            } else {
                $event->status_absensi = 'siap_absensi';
            }

            return $event;
        });

        return view(
            'admin.event.absensi.index',
            compact('events')
        );
    }

    private function generateJadwal(Event $event)
    {
        $pesertas = Peserta::where('event_id', $event->id)
            ->where('status', 'aktif')
            ->get();

        if ($pesertas->isEmpty()) {

            throw new \Exception(
                'Belum ada peserta aktif.'
            );

        }

        $tanggal = Carbon::parse($event->tanggal_mulai);

        $hariKe = 1;

        while ($tanggal->lte($event->tanggal_selesai)) {

            foreach ($pesertas as $peserta) {

                Absensi::firstOrCreate(

                    [

                        'event_id' => $event->id,

                        'event_peserta_id' => $peserta->id,

                        'hari_ke' => $hariKe,

                    ],

                    [

                        'tanggal' => $tanggal->toDateString(),

                        'status' => 'belum_absen',

                        'target_scan' => 1,

                        'total_scan' => 0,

                        'hadir' => 0,

                        'tidak_hadir' => 0,

                        'persentase' => 0,

                        'dibuat_otomatis' => true,

                    ]

                );

            }

            $tanggal->addDay();

            $hariKe++;

        }
    }
    private function sinkronkanAbsensi(Event $event)
    {
        Absensi::where('event_id', $event->id)

            ->where('status', 'belum_absen')

            ->whereDate('tanggal', '<', now())

            ->update([

                'status' => 'tidak_hadir',

                'tidak_hadir' => 1,

                'hadir' => 0,

                'persentase' => 0,

                'selesai' => true,

                'selesai_pada' => now(),

            ]);
    }
    /**
     * Generate jadwal absensi event.
     */
    public function generate(Event $event)
    {
        DB::beginTransaction();

        try {

            $this->generateJadwal($event);

            $this->sinkronkanAbsensi($event);

            DB::commit();

            return back()->with(
                'success',
                'Jadwal absensi berhasil dibuat.'
            );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    /**
     * Daftar peserta suatu event.
     */
    public function peserta(Event $event)
    {
        $pesertas = Peserta::with([
            'user',
            'absensi'
        ])
        ->withCount([
            'absensi as total_hadir' => function ($q) {
                $q->where('status', 'hadir');
            },
            'absensi as total_belum_absen' => function ($q) {
                $q->where('status', 'belum_absen');
            }
        ])
        ->where('event_id', $event->id)
        ->where('status', 'aktif')
        ->paginate(15);

        return view(
            'admin.event.absensi.peserta',
            compact(
                'event',
                'pesertas'
            )
        );
    }

    /**
     * Form absensi berdasarkan tanggal.
     */
    public function create(Request $request, Event $event)
    {
        $this->sinkronkanAbsensi($event);

        $mulai = Carbon::parse($event->tanggal_mulai);
        $selesai = Carbon::parse($event->tanggal_selesai);

        $totalHari = $mulai->diffInDays($selesai) + 1;

        $hariKe = (int) $request->get('hari_ke', 1);

        $hariKe = max(1, min($hariKe, $totalHari));

        $tanggal = $mulai->copy()->addDays($hariKe - 1);

        

        /*
        |--------------------------------------------------------------------------
        | MODE
        |--------------------------------------------------------------------------
        | history = hari sudah lewat (masih boleh edit)
        | input   = hari ini
        | future  = belum boleh input
        |--------------------------------------------------------------------------
        */

        if ($tanggal->lt(today())) {

            $mode = 'history';

        } elseif ($tanggal->isToday()) {

            $mode = 'input';

        } else {

            $mode = 'future';

        }

        $absensis = Absensi::with([
                'peserta.user'
            ])
            ->where('event_id', $event->id)
            ->where('hari_ke', $hariKe)
            ->orderBy('event_peserta_id')
            ->get();

        return view(
            'admin.event.absensi.create',
            compact(
                'event',
                'absensis',
                'tanggal',
                'hariKe',
                'mode',
                'totalHari'
            )
        );
    }
    /**
     * Simpan absensi harian.
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([

            'hari_ke'  => 'required|integer|min:1',

            'status'   => 'required|array',

            'catatan'  => 'nullable|array',

        ]);

        DB::beginTransaction();

        try {

            foreach ($request->status as $id => $status) {

                $absensi = Absensi::where('event_id', $event->id)
                    ->findOrFail($id);

                $hadir = $status == 'hadir';

                $absensi->update([

                    'status'        => $status,

                    'hadir'         => $hadir ? 1 : 0,

                    'tidak_hadir'   => $hadir ? 0 : 1,

                    'persentase'    => $hadir ? 100 : 0,

                    'selesai'       => true,

                    'selesai_pada'  => now(),

                    'catatan'       => $request->catatan[$id] ?? null,

                ]);

            }

            DB::commit();

            return redirect()
                ->route('admin.absensi.create', [
                    'event' => $event->id,
                    'hari_ke' => $request->hari_ke
                ])
                ->with(
                    'success',
                    'Absensi berhasil disimpan.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }
    /**
     * Edit absensi peserta.
     */
    public function edit(Absensi $absensi)
    {
        $absensi->load([

            'event',

            'peserta.user',

        ]);

        return view(
            'admin.event.absensi.edit',
            compact('absensi')
        );
    }
    /**
     * Update absensi.
     */
    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([

            'status' => 'required|in:hadir,tidak_hadir',

            'catatan' => 'nullable|string|max:1000',

        ]);

        $hadir = $request->status == 'hadir';

        $absensi->update([

            'status' => $request->status,

            'hadir' => $hadir ? 1 : 0,

            'tidak_hadir' => $hadir ? 0 : 1,

            'persentase' => $hadir ? 100 : 0,

            'selesai' => true,

            'selesai_pada' => now(),

            'catatan' => $request->catatan,

        ]);

        return redirect()

            ->route(
                'admin.absensi.create',
                [
                    'event' => $absensi->event_id,
                    'tanggal' => $absensi->tanggal,
                ]
            )

            ->with(
                'success',
                'Absensi berhasil diperbarui.'
            );
    }

    /**
     * Rekap absensi event.
     */
    public function rekap(Event $event)
    {
        $pesertas = Peserta::with([
            'user',
            'absensi'
        ])
        ->where('event_id', $event->id)
        ->get();

        foreach ($pesertas as $peserta) {

            $totalHari = Carbon::parse($event->tanggal_mulai)->diffInDays($event->tanggal_selesai) + 1;;
            $poin = $peserta->event->poin_reward;

            $hadir = $peserta->absensi
                ->where('status', 'hadir')
                ->count();

            $tidakHadir = $peserta->absensi
                ->where('status', 'tidak_hadir')
                ->count();

            $scan = $peserta->absensi
                ->sum('total_scan');

            $persentase = $totalHari > 0
                ? round(($hadir / $totalHari) * 100, 2)
                : 0;

            $peserta->update([

                'poin'                  => $poin,
                'total_scan'            => $scan,

                'total_hadir'           => $hadir,

                'total_tidak_hadir'     => $tidakHadir,

                'persentase_kehadiran'  => $persentase,

            ]);

        }

        $pesertas->load([
            'user',
            'absensi'
        ]);

        return view(
            'admin.event.absensi.rekap',
            compact(
                'event',
                'pesertas'
            )
        );
    }
    /**
     * Hapus absensi.
     */
    // public function destroy(Absensi $absensi)
    // {
    //     $absensi->delete();

    //     return back()->with(
    //         'success',
    //         'Absensi berhasil dihapus.'
    //     );
    // } 
    
    /**
     * Hitung persentase kehadiran peserta.
     */
    // private function hitungPersentase(Peserta $peserta)
    // {
    //     $event = $peserta->event;

    //     $totalHari = Carbon::parse($event->tanggal_mulai)
    //         ->diffInDays(
    //             Carbon::parse($event->tanggal_selesai)
    //         ) + 1;

    //     $hadir = Absensi::where('event_id',$peserta->event_id)
    //             ->where('event_peserta_id',$peserta->id)
    //             ->where('status','hadir')
    //             ->count();

    //     if ($totalHari == 0) {
    //         return 0;
    //     }

    //     return round(($hadir / $totalHari) * 100, 2);
    // }

    // private function totalHadir(Peserta $peserta)
    // {
    //     return Absensi::where('event_id',$peserta->event_id)
    //             ->where('event_peserta_id',$peserta->id)
    //             ->where('status','hadir')
    //             ->count();
    // }

    // private function totalBelumAbsen(Peserta $peserta)
    // {
    //     return Absensi::where('event_id', $peserta->event_id)
    //         ->where('event_peserta_id', $peserta->id)
    //         ->where('status', 'belum_absen')
    //         ->count();
    // }

    // private function totalTidakHadir(Peserta $peserta)
    // {
    //     return Absensi::where('event_id', $peserta->event_id)
    //         ->where('event_peserta_id', $peserta->id)
    //         ->where('status', 'tidak_hadir')
    //         ->count();
    // }

    // private function totalBelumDiisi(Event $event)
    // {
    //     return Absensi::where('event_id', $event->id)
    //         ->where('dibuat_otomatis', true)
    //         ->count();
    // }
}
