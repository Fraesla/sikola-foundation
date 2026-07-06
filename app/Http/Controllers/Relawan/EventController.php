<?php

namespace App\Http\Controllers\Relawan;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | EVENT SAYA
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = EventRegistrasi::with('event')
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL EVENT
    |--------------------------------------------------------------------------
    */

    public function show(Event $event)
    {
         $event->load('registrasi');
          $jumlahPeserta = $event->registrasi()->count();

        return view('relawan.event-detail', compact('event','jumlahPeserta'));
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
