<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Reward;
use App\Models\RewardRedeem;

class RewardController extends Controller
{
    public function dashboard()
    {
        return view('admin.reward.index',[

            'totalReward' => Reward::count(),

            'rewardAktif' => Reward::where('is_aktif',true)->count(),

            'totalStok' => Reward::sum('stok'),

            'pending' => RewardRedeem::where('status','menunggu')->count(),

            'diproses' => RewardRedeem::where('status','diproses')->count(),

            'selesai' => RewardRedeem::where('status','selesai')->count(),

        ]);
    }

    public function index(Request $request)
    {
        $reward = Reward::with('creator')
            ->when($request->search, function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            })
            ->when($request->kategori, function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            })
            ->when($request->status !== null && $request->status !== '', function ($q) use ($request) {
                $q->where('is_aktif', $request->status);
            })
            ->orderBy('urutan')
            ->paginate(5)
            ->withQueryString();

        return view('admin.reward.kategori.index',compact('reward'));
    }

     public function create()
    {
        return view('admin.reward.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'nama'      => 'required|max:255',

            'kategori'  => 'required|max:100',

            'poin'      => 'required|integer|min:1',

            'stok'      => 'required|integer|min:0',

            'urutan'    => 'nullable|integer|min:1',

            'deskripsi' => 'nullable',

            'gambar'    => 'nullable|image|max:2048',

        ]);

        $gambar=null;

        if($request->hasFile('gambar')){

            $gambar=$request
                ->file('gambar')
                ->store('reward','public');

        }

        Reward::create([

            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'poin' => $request->poin,
            'urutan' => $request->urutan ?? 1,
            'is_aktif' => $request->boolean('is_aktif'),
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.rewards.index')
            ->with('success','Reward berhasil ditambahkan.');
    }

    public function edit(Reward $reward)
    {
        return view('admin.reward.kategori.edit',compact('reward'));
    }

    public function update(Request $request,Reward $reward)
    {
        $request->validate([

            'nama'      => 'required|max:255',

            'kategori'  => 'required|max:100',

            'poin'      => 'required|integer|min:1',

            'stok'      => 'required|integer|min:0',

            'urutan'    => 'nullable|integer|min:1',

            'deskripsi' => 'nullable',

            'gambar'    => 'nullable|image|max:2048',

        ]);

        $data = [

            'nama' => $request->nama,

            'slug' => Str::slug($request->nama),

            'deskripsi' => $request->deskripsi,

            'kategori' => $request->kategori,

            'stok' => $request->stok,

            'poin' => $request->poin,

            'urutan' => $request->urutan,

            'is_aktif' => $request->boolean('is_aktif'),

        ];

        $data=$request->except('gambar');

        if($request->hasFile('gambar')){

            if($reward->gambar){

                Storage::disk('public')->delete($reward->gambar);

            }

            $data['gambar']=$request
                ->file('gambar')
                ->store('reward','public');

        }

        $reward->update($data);

        return redirect()
            ->route('admin.rewards.index')
            ->with('success','Reward berhasil diupdate.');
    }

    public function show(Reward $reward)
    {
        $reward->load([

            'creator',

            'redemptions.user',

            'redemptions.processor',

        ]);

        $totalRedeem = $reward->redemptions()->count();

        $pendingRedeem = $reward->redemptions()
            ->where('status','menunggu')
            ->count();

        $diprosesRedeem = $reward->redemptions()
            ->where('status','diproses')
            ->count();

        $selesaiRedeem = $reward->redemptions()
            ->where('status','selesai')
            ->count();

        $dibatalkanRedeem = $reward->redemptions()
            ->where('status','dibatalkan')
            ->count();

        $totalPoinDitukar = $reward->redemptions()
            ->sum('total_poin');

        return view(
            'admin.reward.kategori.show',
            compact(
                'reward',
                'totalRedeem',
                'pendingRedeem',
                'diprosesRedeem',
                'selesaiRedeem',
                'dibatalkanRedeem',
                'totalPoinDitukar'
            )
        );
    }

    public function destroy(Reward $reward)
    {
        if($reward->gambar){

            Storage::disk('public')->delete($reward->gambar);

        }

        $reward->delete();

        return back()->with('success','Reward berhasil dihapus.');
    }
}
