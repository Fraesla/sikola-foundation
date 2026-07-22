<?php

namespace App\Http\Controllers\Relawan;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Absensi;
use App\Models\Peserta;
use Carbon\Carbon;
use App\Models\EventRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | EVENT SAYA
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        // Tambahkan withCount('absensis') agar jumlah absensi bisa terbaca
        $query = EventRegistrasi::with(['event' => function($q) {
                $q->withCount('absensis');
            }])
            ->where('user_id', Auth::id());

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $query->whereHas('event', function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $registrasi = $query
            ->latest()
            ->paginate(6)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | TRANSFORMASI STATUS ABSENSI PADA EVENT DI DALAM REGISTRASI
        |--------------------------------------------------------------------------
        */
        $registrasi->getCollection()->transform(function ($reg) {
            if ($reg->event) {
                // Cek apakah absensis_count bernilai 0 atau null
                if (($reg->event->absensis_count ?? 0) == 0) {
                    $reg->event->status_absensi = 'belum_generate';
                } elseif ($reg->event->status == 'selesai') {
                    $reg->event->status_absensi = 'selesai';
                } else {
                    $reg->event->status_absensi = 'siap_absensi';
                }
            }
            return $reg;
        });

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */
        $totalEvent = Event::where('status', 'terbuka')->count();
        $terdaftar = EventRegistrasi::where('user_id', Auth::id())->count();
        $akanDatang = EventRegistrasi::where('user_id', Auth::id())
            ->whereHas('event', function ($q) {
                $q->whereDate('tanggal_mulai', '>=', now());
            })->count();

        $selesai = EventRegistrasi::where('user_id', Auth::id())
            ->whereHas('event', function ($q) {
                $q->where('status', 'selesai');
            })->count();

        return view('relawan.event', compact(
            'registrasi',
            'totalEvent',
            'terdaftar',
            'akanDatang',
            'selesai'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | SEMUA EVENT
    |--------------------------------------------------------------------------
    */

    public function available(Request $request)
    {
        $query = Event::query();

        $query->where('status', 'terbuka');

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->search . '%');

            });

        }

        /*
        |--------------------------------------------------------------------------
        | FILTER LOKASI
        |--------------------------------------------------------------------------
        */

        if ($request->filled('lokasi')) {

            $query->where('lokasi', $request->lokasi);

        }

        $events = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $lokasis = Event::select('lokasi')
            ->distinct()
            ->orderBy('lokasi')
            ->pluck('lokasi');

        return view('frontend.event', compact(

            'events',
            'lokasis'

        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Event $event)
    {
        // Pastikan menggunakan startOfDay() agar perhitungan selisih hari akurat
        $mulai = Carbon::parse($event->tanggal_mulai)->startOfDay();
        $selesai = Carbon::parse($event->tanggal_selesai)->startOfDay();
        $hariIni = today(); // Otomatis startOfDay()

        $totalHari = $mulai->diffInDays($selesai) + 1;

        /*
        |--------------------------------------------------------------------------
        | TENTUKAN HARI DEFAULT OTOMATIS
        |--------------------------------------------------------------------------
        | Jika belum mulai = Hari 1
        | Jika sudah selesai = Hari Terakhir
        | Jika sedang berjalan = Hitung selisih hari ini dengan hari pertama
        */
        if ($hariIni->lt($mulai)) {
            $defaultHari = 1;
        } elseif ($hariIni->gt($selesai)) {
            $defaultHari = $totalHari;
        } else {
            $defaultHari = $mulai->diffInDays($hariIni) + 1; // Akan menghasilkan angka 4 untuk tanggal 22 Juli
        }

        // Ambil parameter dari URL (?hari_ke=...), jika kosong gunakan $defaultHari
        $hariKe = (int) $request->get('hari_ke', $defaultHari);
        $hariKe = max(1, min($hariKe, $totalHari));

        $tanggal = $mulai->copy()->addDays($hariKe - 1);

        /*
        |--------------------------------------------------------------------------
        | MODE ABSENSI
        |--------------------------------------------------------------------------
        */
        if ($tanggal->lt(today())) {
            $mode = 'history';
        } elseif ($tanggal->isToday()) {
            $mode = 'input';
        } else {
            $mode = 'future';
        }

        // Ambil Data Peserta (Relawan yang Login)
        $peserta = Peserta::with([
            'user',
            'absensi'
        ])
        ->where('event_id', $event->id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

        // Ambil Data Absensi Berdasarkan Hari yang Dipilih/Aktif
        $absensi = Absensi::where('event_id', $event->id)
            ->where('event_peserta_id', $peserta->id)
            ->where('hari_ke', $hariKe)
            ->first();

        return view(
            'relawan.event-absensi',
            compact(
                'event',
                'peserta',
                'absensi',
                'hariKe',
                'tanggal',
                'mode',
                'totalHari'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        // 1. Validasi disesuaikan menjadi string (bukan array)
        $request->validate([
            'hari_ke'  => 'required|integer|min:1',
            'status'   => 'required|in:hadir,tidak_hadir',
            'catatan'  => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // 2. Cari ID Peserta berdasarkan User yang sedang login
            $peserta = Peserta::where('event_id', $event->id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            // 3. Cari record Absensi khusus untuk user ini di hari yang dipilih
            $absensi = Absensi::where('event_id', $event->id)
                ->where('event_peserta_id', $peserta->id)
                ->where('hari_ke', $request->hari_ke)
                ->firstOrFail();

            $hadir = ($request->status == 'hadir');

            // 4. Update data absensi
            $absensi->update([
                'status'        => $request->status,
                'hadir'         => $hadir ? 1 : 0,
                'tidak_hadir'   => $hadir ? 0 : 1,
                'persentase'    => $hadir ? 100 : 0,
                'selesai'       => true,
                'selesai_pada'  => now(),
                'catatan'       => $request->catatan, 
            ]);

            $totalHari = Carbon::parse($event->tanggal_mulai)->diffInDays($event->tanggal_selesai) + 1;;

            $poin = $peserta->event->poin_reward;

            $hadir = $peserta->absensi
                ->where('status', 'hadir')
                ->count();

            $tidakHadir = $peserta->absensi
                ->where('status', 'tidak_hadir')
                ->count();
            $poin = $peserta->event->poin_reward;
            $persentase = $totalHari > 0
                ? round(($hadir / $totalHari) * 100, 2)
                : 0;

             $peserta->update([

                'poin'                  => $poin,

                'total_hadir'           => $hadir,

                'total_tidak_hadir'     => $tidakHadir,

                'persentase_kehadiran'  => $persentase,

            ]);

            DB::commit();

            // 5. Kembali ke halaman relawan dengan pesan sukses
            return back()->with('success', 'Absensi berhasil disimpan.');

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL EVENT
    |--------------------------------------------------------------------------
    */

   public function show(Event $event)
    {
        // Load relasi registrasi dan peserta beserta absensinya khusus user yang login
        $event->load('registrasis');
        $jumlahPeserta = $event->registrasis()->count();

        $peserta = Peserta::with('absensi')
            ->where('event_id', $event->id)
            ->where('user_id', auth()->id())
            ->first();

        return view('relawan.event-detail', compact('event', 'jumlahPeserta', 'peserta'));
    }

    public function batal(EventRegistrasi $registrasi)
    {
        if ($registrasi->user_id != Auth::id()) {

            abort(403);

        }

        if ($registrasi->status != 'pending') {

            return back()->with(

                'error',

                'Pendaftaran tidak dapat dibatalkan.'

            );

        }

        $registrasi->delete();

        return back()->with(

            'success',

            'Pendaftaran berhasil dibatalkan.'

        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
