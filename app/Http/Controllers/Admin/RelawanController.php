<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Relawan;
use App\Models\Event;
use App\Models\EventRegistrasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelawanController extends Controller
{
    public function form()
    {
        $bannerRelawan = Banner::where('urutan', 5)
                            ->where('is_aktif', true)
                            ->orderBy('id')
                            ->get();

        return view('frontend.relawan', compact('bannerRelawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits_between:16,20',
            'foto_ktp' => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $foto = null;

        if ($request->hasFile('foto_ktp')) {

            $foto = $request
                ->file('foto_ktp')
                ->store('relawan/ktp', 'private');

        }

        Relawan::create([
            'user_id' => auth()->id(),
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan' => $request->pendidikan,
            'motivasi' => $request->motivasi,
            'keahlian' => $request->keahlian,
            'pengalaman_organisasi' => $request->pengalaman_organisasi,
            'foto_ktp' => $foto,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Pendaftaran relawan berhasil dikirim.');
    }

    public function daftarEvent(Event $event)
    {
        // event harus terbuka
        if ($event->status != 'terbuka') {

            return back()->with(
                'error',
                'Pendaftaran event telah ditutup.'
            );
        }

        // sudah pernah daftar?
        $cek = EventRegistrasi::where('event_id', $event->id)
                ->where('user_id', Auth::id())
                ->first();

        if ($cek) {

            return back()->with(
                'error',
                'Anda sudah terdaftar pada event ini.'
            );
        }

        // cek kuota
        if ($event->kuota) {

            $jumlahPeserta = EventRegistrasi::where('event_id',$event->id)
                                ->whereIn('status',[
                                    'mendaftar',
                                    'dikonfirmasi'
                                ])
                                ->count();

            if ($jumlahPeserta >= $event->kuota){

                return back()->with(
                    'error',
                    'Kuota event sudah penuh.'
                );
            }

        }

        EventRegistrasi::create([

            'event_id' => $event->id,

            'user_id' => Auth::id(),

            'status' => 'mendaftar',

            'created_at' => now()

        ]);

        return redirect()
                ->route(
                    'relawan.events.index'
                )
                ->with(
                    'success',
                    'Pendaftaran berhasil dikirim. Silakan tunggu verifikasi admin.'
                );

    }

}
