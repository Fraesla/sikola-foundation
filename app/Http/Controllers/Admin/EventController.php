<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistrasi;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Peserta;
use App\Services\PoinService;
use App\KategoriPoin;
use Illuminate\Http\Request;
use App\Services\EventAttendanceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventController extends Controller
{
    protected PoinService $poinService;

    public function __construct(PoinService $poinService)
    {
        $this->poinService = $poinService;
    }
    public function index(Request $request)
    {
        $query = Event::query()
            ->with('creator')
            ->withCount([
                'pesertas',
                'absensis'
            ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        $request->sort == 'oldest'
            ? $query->oldest()
            : $query->latest();

        /*
        |--------------------------------------------------------------------------
        | Data Event
        |--------------------------------------------------------------------------
        */

        $events = $query
            ->paginate(6)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalEvent = Event::count();

        $upcomingEvent = Event::where('status', 'terbuka')->count();

        $selesaiEvent = Event::where('status', 'selesai')->count();

        $totalPeserta = Peserta::count();

        return view(
            'admin.event.kategori.index',
            compact(
                'events',
                'totalEvent',
                'upcomingEvent',
                'selesaiEvent',
                'totalPeserta'
            )
        );
    }

    public function show()
    {
        return view('admin.event.dashboard', [

            /*
            |--------------------------------------------------------------------------
            | EVENT
            |--------------------------------------------------------------------------
            */
            'totalEvent' => Event::count(),

            'eventAktif' => Event::whereDate('tanggal_mulai', '<=', now())
                ->whereDate('tanggal_selesai', '>=', now())
                ->count(),

            'totalKuota' => Event::sum('kuota'),

            /*
            |--------------------------------------------------------------------------
            | REGISTRASI
            |--------------------------------------------------------------------------
            | sementara registrasi memakai tabel peserta
            */

            'totalRegistrasi' => EventRegistrasi::count(),

            'registrasiPending' => EventRegistrasi::where('status', 'mendaftar')->count(),

            'registrasiDiterima' => EventRegistrasi::where('status', 'dikonfirmasi')->count(),

            /*
            |--------------------------------------------------------------------------
            | PESERTA
            |--------------------------------------------------------------------------
            */

            'totalPeserta' => Peserta::count(),

            'pesertaLulus' => Peserta::where('status', 'lulus')->count(),

            'pesertaTidakLulus' => Peserta::where('status', 'tidak_lulus')->count(),

            /*
            |--------------------------------------------------------------------------
            | ABSENSI
            |--------------------------------------------------------------------------
            */

            'totalScan' => Absensi::sum('total_scan'),

            'totalHadir' => Absensi::sum('hadir'),

            'totalRekap' => Absensi::count(),

        ]);
    }

    public function create()
    {
        return view(
            'admin.event.kategori.create',
            [
                'event' => new Event()
            ]
        );
    }

    public function finalisasi(Event $event,EventAttendanceService $attendanceService)
    {

        if($event->status=='selesai'){
            return back()->with(
                'error',
                'Event sudah selesai.'
            );
        }

        if($event->pesertas()->count()==0){
            return back()->with(
                'error',
                'Belum ada peserta.'
            );
        }

        DB::transaction(function() use($event,$attendanceService){

            $attendanceService->finalisasi($event);

            $event->update([
                'status'=>'selesai'
            ]);

        });

        return back()->with(
            'success',
            'Event berhasil difinalisasi.'
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            $this->rules()
        );

        DB::transaction(function () use ($request, $data) {

            $this->saveEvent(
                $data,
                $request
            );

        });

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Event berhasil ditambahkan.'
            );
    }

    public function edit(Event $event)
    {
        return view(
            'admin.event.kategori.edit',
            compact('event')
        );
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate(
            $this->rules()
        );

        DB::transaction(function () use (
            $event,
            $request,
            $data
        ) {

            $this->saveEvent(
                $data,
                $request,
                $event
            );

        });

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Event berhasil diperbarui.'
            );
    }

    public function destroy(Event $event)
    {
        DB::transaction(function () use ($event) {

            $this->deleteBanner($event);

            $event->delete();

        });

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Event berhasil dihapus.'
            );
    }
    private function rules(): array
    {
        return [

            'judul' => [
                'required',
                'string',
                'max:255'
            ],

            'deskripsi' => [
                'nullable',
                'string'
            ],

            'gambar' => [
                'nullable',
                'image',
                'max:2048'
            ],

            'lokasi' => [
                'required',
                'string',
                'max:255'
            ],

            'tanggal_mulai' => [
                'required',
                'date'
            ],

            'tanggal_selesai' => [
                'required',
                'date',
                'after:tanggal_mulai'
            ],

            'kuota' => [
                'nullable',
                'integer',
                'min:1'
            ],

            'poin_reward' => [
                'required',
                'integer',
                'min:0'
            ],

            'poin_penalty' => [
                'required',
                'integer',
                'min:0'
            ],

            'interval_scan' => [
                'required',
                'integer',
                'min:1'
            ],

            'toleransi_scan' => [
                'required',
                'integer',
                'min:0'
            ],

            'status' => [
                'required',
                'string'
            ],

        ];
    }
    private function saveEvent(array $data, Request $request, ?Event $event = null): Event 
    {

        $isCreate = is_null($event);

        if ($isCreate) {

            $event = new Event();

            $event->created_by = auth()->id();

        }

        /*
        |--------------------------------------------------------------------------
        | Upload Banner
        |--------------------------------------------------------------------------
        */

        $data['gambar'] = $this->uploadBanner(
            $request,
            $event
        );

        /*
        |--------------------------------------------------------------------------
        | Generate Slug
        |--------------------------------------------------------------------------
        */

        $data['slug'] = Str::slug($data['judul']);

        /*
        |--------------------------------------------------------------------------
        | Fill Data
        |--------------------------------------------------------------------------
        */

        $event->fill($data);

        $event->save();

        return $event;
    }
    private function uploadBanner(Request $request,Event $event): ?string 
    {

        // Jika tidak upload file baru,
        // gunakan gambar lama.
        if (! $request->hasFile('gambar')) {
            return $event->gambar;
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus banner lama
        |--------------------------------------------------------------------------
        */

        if (
            $event->exists &&
            $event->gambar &&
            Storage::disk('public')->exists($event->gambar)
        ) {
            Storage::disk('public')->delete($event->gambar);
        }

        /*
        |--------------------------------------------------------------------------
        | Upload banner baru
        |--------------------------------------------------------------------------
        */

        return $request
            ->file('gambar')
            ->store('events', 'public');
    }
    private function deleteBanner(Event $event): void
    {
        if (
            ! empty($event->gambar) &&
            Storage::disk('public')->exists($event->gambar)
        ) {
            Storage::disk('public')->delete($event->gambar);
        }
    }

    // public function konfirmasiHadir(Event $event, EventRegistrasi $registrasi)
    // {
    //     if ($registrasi->status != 'dikonfirmasi') {

    //         return back()->with(
    //             'error',
    //             'Peserta belum dikonfirmasi.'
    //         );

    //     }

    //     if ($registrasi->status == 'hadir') {

    //         return back()->with(
    //             'error',
    //             'Peserta sudah hadir.'
    //         );

    //     }

    //     DB::transaction(function () use ($event, $registrasi) {

    //         /*
    //         |--------------------------------------------------------------------------
    //         | Ambil reward event
    //         |--------------------------------------------------------------------------
    //         */

    //         $reward = $event->poin_reward
    //             ?? config('poin.event.default_reward');

    //         /*
    //         |--------------------------------------------------------------------------
    //         | Update registrasi
    //         |--------------------------------------------------------------------------
    //         */

    //         $registrasi->update([

    //             'status' => 'hadir',

    //             'poin_diberikan' => $reward,

    //         ]);

    //         /*
    //         |--------------------------------------------------------------------------
    //         | Tambahkan poin melalui service
    //         |--------------------------------------------------------------------------
    //         */

    //         app(PoinService::class)->tambahPoin(

    //             $registrasi->user,

    //             $reward,

    //             KategoriPoin::EVENT,

    //             $registrasi,

    //             "Mengikuti event {$event->judul}"

    //         );

    //     });

    //     return back()->with(

    //         'success',

    //         "Peserta berhasil dihadirkan poin."

    //     );
    // }
    // public function konfirmasiAlfa(Event $event, EventRegistrasi $registrasi)
    // {
    //     if ($registrasi->status != 'dikonfirmasi') {

    //         return back()->with(
    //             'error',
    //             'Peserta belum dikonfirmasi.'
    //         );

    //     }

    //     $registrasi->update([
    //         'status' => 'tidak_hadir'
    //     ]);

    //     return back()->with(
    //         'success',
    //         'Peserta ditandai tidak hadir.'
    //     );
    // }
}