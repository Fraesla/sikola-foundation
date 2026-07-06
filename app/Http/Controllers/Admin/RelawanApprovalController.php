<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelawanApprovalController extends Controller
{
    public function index()
    {
        $relawans = Relawan::with('user')
                        ->latest()
                        ->get();

        $totalPendaftar = Relawan::count();

        $menunggu = Relawan::where('status','menunggu')
                        ->count();

        $aktif = Relawan::where('status','disetujui')
                        ->count();

        return view(
            'admin.relawan.index',
            compact(
                'relawans',
                'totalPendaftar',
                'menunggu',
                'aktif'
            )
        );
    }
    public function show(Relawan $relawan)
    {
        return view(
            'admin.relawan.detail',
            compact('relawan')
        );
    }

    public function setujui(Relawan $relawan)
    {
        if ($relawan->status == 'disetujui') {

            return back()->with(
                'warning',
                'Relawan sudah pernah disetujui.'
            );

        }

        DB::transaction(function () use ($relawan) {

            $relawan->update([
                'status'         => 'disetujui',
                'disetujui_oleh' => auth()->id(),
                'disetujui_at'   => now(),
            ]);

            $relawan->user->update([
                'role' => 'relawan'
            ]);

        });

        return back()->with(
            'success',
            'Relawan berhasil disetujui.'
        );
    }

    public function tolak(Relawan $relawan)
    {
        $relawan->update([
            'status' => 'ditolak'
        ]);

        return back()->with(
            'success',
            'Relawan berhasil ditolak.'
        );
    }

}
