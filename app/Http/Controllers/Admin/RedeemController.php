<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RewardRedeem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RedeemController extends Controller
{
    /**
     * Dashboard Redeem
     */
    public function dashboard()
    {
        return view('admin.reward.penukaran.dashboard', [

            'totalRedeem' => RewardRedeem::count(),

            'menunggu' => RewardRedeem::where('status', 'menunggu')->count(),

            'diproses' => RewardRedeem::where('status', 'diproses')->count(),

            'selesai' => RewardRedeem::where('status', 'selesai')->count(),

        ]);
    }

    /**
     * Daftar Redeem
     */
    public function index(Request $request)
    {
        $redeem = RewardRedeem::with([
                'user',
                'reward'
            ])

            ->when($request->search, function ($q) use ($request) {

                $q->where('kode', 'like', '%' . $request->search . '%')

                  ->orWhereHas('user', function ($user) use ($request) {

                        $user->where(
                            'name',
                            'like',
                            '%' . $request->search . '%'
                        );

                  });

            })

            ->when($request->status, function ($q) use ($request) {

                $q->where('status', $request->status);

            })

            ->latest()

            ->paginate(5)

            ->withQueryString();

        return view(
            'admin.reward.penukaran.index',
            compact('redeem')
        );
    }

    /**
     * Detail Redeem
     */
    public function show(RewardRedeem $redeem)
    {
        $redeem->load([
            'user',
            'reward',
            'processor'
        ]);

        return view(
            'admin.reward.penukaran.show',
            compact('redeem')
        );
    }
    public function proses(RewardRedeem $redeem)
    {
        abort_if($redeem->status != 'menunggu',404);

        $redeem->load([
            'reward',
            'user'
        ]);

        return view(
            'admin.reward.penukaran.proses',
            compact('redeem')
        );
    }
    /**
     * Proses Redeem
     */

    public function kirim(Request $request, RewardRedeem $redeem)
    {
        abort_if($redeem->status != 'menunggu',404);

        $reward = $redeem->reward;

        if($reward->kategori == 'Saldo')
        {
            $request->validate([

                'bukti_penyerahan'=>'required|image|max:2048',

                'catatan_admin'=>'nullable|string'

            ]);

            $bukti = $request
                ->file('bukti_penyerahan')
                ->store('reward-penyerahan','public');

            $redeem->update([

                'status'=>'diproses',

                'bukti_penyerahan'=>$bukti,

                'catatan_admin'=>$request->catatan_admin,

                'diproses_oleh'=>auth()->id(),

                'diproses_at'=>now(),

            ]);
        }
        else
        {
            $request->validate([

                'ekspedisi'=>'required|max:100',

                'nomor_resi'=>'required|max:100',

                'catatan_admin'=>'nullable|string'

            ]);

            $redeem->update([

                'status'=>'diproses',

                'ekspedisi'=>$request->ekspedisi,

                'nomor_resi'=>$request->nomor_resi,

                'catatan_admin'=>$request->catatan_admin,

                'diproses_oleh'=>auth()->id(),

                'diproses_at'=>now(),

            ]);
        }

        return redirect()
            ->route('admin.redeem.index')
            ->with(
                'success',
                'Reward berhasil diproses.'
            );
    }
    public function batalkan(Request $request, RewardRedeem $redeem)
    {
        abort_if(
            !in_array($redeem->status, ['menunggu', 'diproses']),
            404
        );

        if ($redeem->nomor_resi || $redeem->bukti_penyerahan) {

            return back()->with(
                'error',
                'Reward sedang dalam proses pengiriman dan tidak dapat dibatalkan.'
            );

        }

        $request->validate([
            'catatan_admin' => 'required|string|max:1000',
        ]);

        $redeem->update([

            'status' => 'dibatalkan',

            'catatan_admin' => $request->catatan_admin,

            'diproses_oleh' => auth()->id(),

            'dibatalkan_at' => now(),

            'dibatalkan_oleh' => auth()->id(),

            'dibatalkan_sebagai' => 'admin',

        ]);

        return redirect()
            ->route('admin.redeem.index')
            ->with(
                'success',
                'Redeem berhasil dibatalkan.'
            );
    }
}
