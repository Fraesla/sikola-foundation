<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistrasi;
use App\Models\User;
use App\Services\PoinService;
use App\KategoriPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    protected PoinService $poinService;

    public function __construct(PoinService $poinService)
    {
        $this->poinService = $poinService;
    }
    public function index(Request $request)
    {
        $query = Event::with('creator');

        // Search
        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Sort
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $events = $query->paginate(5);

        $totalEvent = Event::count();

        $upcomingEvent = Event::where('status', 'terbuka')->count();

        $draftEvent = Event::where('status', 'draft')->count();

        $selesaiEvent = Event::where('status', 'selesai')->count();

        return view(
            'admin.event.kategori.index',
            compact(
                'events',
                'totalEvent',
                'upcomingEvent',
                'draftEvent',
                'selesaiEvent'
            )
        );
    }

    public function show()
    {
        return view('admin.event.dashboard', [

            // EVENT
            'totalEvent' => Event::count(),

            'eventAktif' => Event::where('status','terbuka')->count(),

            'totalKuota' => Event::sum('kuota'),

            // PESERTA
            'totalPeserta' => EventRegistrasi::count(),

            'pendingPeserta' => EventRegistrasi::where('status','mendaftar')->count(),

            'hadirPeserta' => EventRegistrasi::where('status','hadir')->count(),

        ]);
    } 

    public function create()
    {
        return view('admin.event.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'gambar' => 'nullable|image|max:2048',
            'tanggal_mulai' => 'required',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar')
                        ->store('events', 'public');
        }

        Event::create([
            'judul' => $request->judul,
            'slug' => \Str::slug($request->judul),
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kuota' => $request->kuota,
            'poin_reward' => config('poin.event.default_reward'),
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan');
    }

    public function edit(Event $event)
    {
        return view('admin.event.kategori.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $gambar = $event->gambar;

        if ($request->hasFile('gambar')) {

            if ($gambar) {
                Storage::disk('public')->delete($gambar);
            }

            $gambar = $request->file('gambar')
                        ->store('events', 'public');
        }

        $event->update([
            'judul' => $request->judul,
            'slug' => \Str::slug($request->judul),
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kuota' => $request->kuota,
            'poin_reward' => $request->poin_reward,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil diupdate');
    }

    public function destroy(Event $event)
    {
        if ($event->gambar) {
            Storage::disk('public')
                ->delete($event->gambar);
        }

        $event->delete();

        return back()
            ->with('success', 'Event berhasil dihapus');
    }
    public function konfirmasiHadir(Event $event, EventRegistrasi $registrasi)
    {
        if ($registrasi->status != 'dikonfirmasi') {

            return back()->with(
                'error',
                'Peserta belum dikonfirmasi.'
            );

        }

        if ($registrasi->status == 'hadir') {

            return back()->with(
                'error',
                'Peserta sudah hadir.'
            );

        }

        DB::transaction(function () use ($event, $registrasi) {

            /*
            |--------------------------------------------------------------------------
            | Ambil reward event
            |--------------------------------------------------------------------------
            */

            $reward = $event->poin_reward
                ?? config('poin.event.default_reward');

            /*
            |--------------------------------------------------------------------------
            | Update registrasi
            |--------------------------------------------------------------------------
            */

            $registrasi->update([

                'status' => 'hadir',

                'poin_diberikan' => $reward,

            ]);

            /*
            |--------------------------------------------------------------------------
            | Tambahkan poin melalui service
            |--------------------------------------------------------------------------
            */

            app(PoinService::class)->tambahPoin(

                $registrasi->user,

                $reward,

                KategoriPoin::EVENT,

                $registrasi,

                "Mengikuti event {$event->judul}"

            );

        });

        return back()->with(

            'success',

            "Peserta berhasil dihadirkan poin."

        );
    }
    public function konfirmasiAlfa(Event $event, EventRegistrasi $registrasi)
    {
        if ($registrasi->status != 'dikonfirmasi') {

            return back()->with(
                'error',
                'Peserta belum dikonfirmasi.'
            );

        }

        $registrasi->update([
            'status' => 'tidak_hadir'
        ]);

        return back()->with(
            'success',
            'Peserta ditandai tidak hadir.'
        );
    }
}
