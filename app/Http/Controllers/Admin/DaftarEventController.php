<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\EventRegistrasi;
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

                        $user->where('name','like','%'.$request->search.'%')
                             ->orWhere('email','like','%'.$request->search.'%');

                    });

                    $query->orWhereHas('event', function ($event) use ($request) {

                        $event->where('judul','like','%'.$request->search.'%');

                    });

                });

            })

            ->when($request->filled('status'), function ($q) use ($request){

                $q->where('status',$request->status);

            })

            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'admin.event.daftar.peserta',
            compact('registrasi')
        );
    }
    public function show($id)
    {
        $registrasi = EventRegistrasi::with(['user','event'])->findOrFail($id);

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

        DB::transaction(function () use ($registrasi) {

            // Ambil event
            $event = Event::findOrFail($registrasi->event_id);

            // Cek kuota
            if ($event->kuota <= 0) {
                throw new \Exception('Kuota event sudah habis.');
            }

            // Ubah status registrasi
            $registrasi->update([
                'status' => 'dikonfirmasi'
            ]);

            // Kurangi kuota
            $event->decrement('kuota', 1);

        });

        return back()->with(
            'success',
            'Pendaftaran berhasil dikonfirmasi dan kuota event dikurangi.'
        );
    }
    public function tolak(EventRegistrasi $registrasi)
    {
        if(in_array($registrasi->status,['dikonfirmasi','hadir'])){

            DB::transaction(function() use ($registrasi){

                $registrasi->update([
                    'status'=>'tidak'
                ]);

                Event::where('id',$registrasi->event_id)
                    ->increment('kuota',1);

            });

        }else{

            $registrasi->update([
                'status'=>'tidak'
            ]);

        }

        return back()->with('success','Peserta ditolak.');
    }
}