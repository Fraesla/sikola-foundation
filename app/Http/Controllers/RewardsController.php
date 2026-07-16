<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\RewardRedeem;
use App\Services\PoinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RewardsController extends Controller
{
    /**
     * Daftar Reward
     */
    private function roleView($view)
    {
        $role = auth()->user()->role;

        return match ($role) {
            'donatur' => "donatur.$view",
            'relawan' => "relawan.$view",
            default   => "pembeli.$view",
        };
    }

    // private function roleRoute($route)
    // {
    //     $role = auth()->user()->role;

    //     return match($role){
    //         'donatur' => "donatur.$route",
    //         'relawan' => "relawan.$route",
    //         default   => "pembeli.$route",
    //     };
    // }

    public function index(Request $request)
    {
        $reward = Reward::query()
            ->where('is_aktif', true)
            ->where('stok', '>', 0)

            ->when($request->search, function ($q) use ($request) {

                $q->where(function ($query) use ($request) {

                    $query->where('nama', 'like', '%' . $request->search . '%')
                          ->orWhere('kategori', 'like', '%' . $request->search . '%');

                });

            })

            ->when($request->kategori, function ($q) use ($request) {

                $q->where('kategori', $request->kategori);

            })

            ->orderBy('nama')
            ->paginate(6)
            ->withQueryString();

        $kategori = Reward::where('is_aktif', true)
            ->select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return view($this->roleView('reward'), compact(
            'reward',
            'kategori'
        ));
    }

    /**
     * Detail Reward
     */
    public function show(RewardRedeem $redeem)
    {
        abort_if($redeem->user_id != auth()->id(), 403);

        $redeem->load([
            'reward',
            'user',
            'processor'
        ]);

        return view($this->roleView('reward-detail'), compact('redeem'));
    }

    // public function showRedeem(RewardRedeem $redeem)
    // {
    //     abort_if($redeem->user_id != auth()->id(), 403);

    //     $redeem->load([
    //         'reward',
    //         'user',
    //         'processor'
    //     ]);

    //     return view('pembeli.reward-detail', compact('redeem'));
    // }

    /**
     * Tukarkan Reward
     */
    public function store(Request $request)
    {
        $request->validate([

            'reward_id' => 'required|exists:rewards,id',
            'catatan' => 'nullable|string|max:1000',

        ]);

        $reward = Reward::findOrFail($request->reward_id);

        $user = auth()->user();

        if (!$reward->is_aktif) {

            return back()->with(
                'error',
                'Reward tidak tersedia.'
            );

        }

        if ($reward->stok <= 0) {

            return back()->with(
                'error',
                'Stok reward habis.'
            );

        }

        if ($user->total_poin < $reward->poin) {

            return back()->with(
                'error',
                'Poin Anda tidak mencukupi.'
            );

        }

        DB::transaction(function () use ($user, $reward, $request) {

            // $user->decrement('total_poin', $reward->poin);

            // $reward->decrement('stok');

            RewardRedeem::create([

                'kode' => 'RDM-' . strtoupper(Str::random(8)),

                'user_id' => $user->id,

                'reward_id' => $reward->id,

                'qty' => $request->qty,

                'poin' => $reward->poin,

                'total_poin' => $reward->poin,

                'catatan_user' => $request->catatan,

                'status' => 'menunggu',

            ]);

        });

        return redirect()
            ->route($user->role . '.reward.riwayat')
            ->with(
                'success',
                'Permintaan penukaran reward berhasil dikirim.'
            );
    }

     /**
     * Selesaikan Redeem
     */
    public function selesai(RewardRedeem $redeem,PoinService $pointService)
    {
        abort_if(
            $redeem->user_id != auth()->id(),
            403
        );

        abort_if(
            $redeem->status != 'diproses',
            404
        );

        DB::transaction(function () use ($redeem,$pointService) 
        {

            $reward = $redeem->reward;
            $user   = $redeem->user;

            /*
            |--------------------------------------------------------------------------
            | Validasi poin
            |--------------------------------------------------------------------------
            */

            if ($user->total_poin < $redeem->total_poin) {

                throw new \Exception(
                    'Poin tidak mencukupi.'
                );

            }

            /*
            |--------------------------------------------------------------------------
            | Validasi stok
            |--------------------------------------------------------------------------
            */

            if ($reward->stok < $redeem->qty) {

                throw new \Exception(
                    'Stok reward sudah habis.'
                );

            }

            /*
            |--------------------------------------------------------------------------
            | Potong poin menggunakan PointService
            |--------------------------------------------------------------------------
            */

            $pointService->kurangiPoin(
                user: $user,
                poin: $redeem->total_poin,
                kategori: 'reward',
                referensi: $redeem,
                keterangan: 'Redeem Reward'
            );

            /*
            |--------------------------------------------------------------------------
            | Kurangi stok reward
            |--------------------------------------------------------------------------
            */

            $reward->decrement(
                'stok',
                $redeem->qty
            );

            /*
            |--------------------------------------------------------------------------
            | Update status redeem
            |--------------------------------------------------------------------------
            */

            $redeem->update([

                'status' => 'selesai',

                'selesai_at' => now(),

            ]);

        });

        return back()->with(
            'success',
            'Terima kasih. Reward telah diterima.'
        );
    }
    public function batalkan(Request $request, RewardRedeem $redeem)
    {
        abort_if(
            $redeem->user_id != auth()->id(),
            403
        );

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

            'catatan_user' => 'nullable|string|max:1000',

        ]);

        $redeem->update([

            'status' => 'dibatalkan',

            'catatan_user' => $request->catatan_user,

            'dibatalkan_at' => now(),

            'dibatalkan_oleh' => auth()->id(),

            'dibatalkan_sebagai' => 'user',

        ]);

        return redirect()
            ->route(auth()->user()->role . '.reward.riwayat')
            ->with(
                'success',
                'Penukaran reward berhasil dibatalkan.'
            );
    }

    /**
     * Riwayat Reward
     */
    public function riwayat(Request $request)
    {
        $redeem = RewardRedeem::with('reward')

            ->where('user_id', auth()->id())

            ->latest()

            ->paginate(10);

        return view($this->roleView('riwayat-reward'), [

            'redeem' => $redeem

        ]);
    }
}