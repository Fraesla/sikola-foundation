<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\RewardVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RewardVoucherController extends Controller
{
    public function index(Request $request)
    {
        $voucher = RewardVoucher::with([
                'reward',
                'user',
                'order'
            ])
            ->when($request->search,function($q) use ($request){

                $q->where('kode','like','%'.$request->search.'%')
                  ->orWhereHas('reward',function($qq) use($request){

                        $qq->where('nama','like','%'.$request->search.'%');

                  });

            })

            ->when($request->reward_id,function($q) use($request){

                $q->where('reward_id',$request->reward_id);

            })

            ->when($request->status,function($q) use($request){

                $q->where('status',$request->status);

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view('admin.reward.voucher.index',[

            'voucher'=>$voucher,

            'reward'=>Reward::orderBy('nama')->get(),

            'activePage'=>'reward'

        ]);
    }

    /**
     * Create
     */
    public function create()
    {
        return view('admin.reward.voucher.create',[

            'reward'=>Reward::where('is_aktif',1)
                        ->orderBy('nama')
                        ->get(),

            'activePage'=>'reward'

        ]);
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([

            'reward_id'=>'required|exists:reward,id',

            'kode'=>'nullable|unique:reward_vouchers,kode',

            'nominal'=>'nullable|numeric|min:0',

            'status'=>'required|in:aktif,digunakan,expired,dibatalkan',

            'berlaku_mulai'=>'nullable|date',

            'berlaku_sampai'=>'nullable|date|after_or_equal:berlaku_mulai',

        ]);

        RewardVoucher::create([

            'reward_id'=>$request->reward_id,

            'kode'=>$request->kode
                    ?: 'RV-'.strtoupper(Str::random(10)),

            'nominal'=>$request->nominal,

            'status'=>$request->status,

            'berlaku_mulai'=>$request->berlaku_mulai,

            'berlaku_sampai'=>$request->berlaku_sampai,

        ]);

        return redirect()

            ->route('admin.voucher.index')

            ->with('success','Voucher berhasil dibuat.');

    }

    /**
     * Show
     */
    public function show(RewardVoucher $rewardVoucher)
    {
        $rewardVoucher->load([

            'reward',

            'user',

            'order'

        ]);

        return view('admin.reward.voucher.show',[

            'voucher'=>$rewardVoucher,

            'activePage'=>'reward'

        ]);
    }

    /**
     * Edit
     */
    public function edit(RewardVoucher $rewardVoucher)
    {
        return view('admin.reward.voucher.edit',[

            'voucher'=>$rewardVoucher,

            'reward'=>Reward::where('is_aktif',1)
                        ->orderBy('nama')
                        ->get(),

            'activePage'=>'reward'

        ]);
    }

    /**
     * Update
     */
    public function update(Request $request, RewardVoucher $rewardVoucher)
    {
        $request->validate([

            'reward_id'=>'required|exists:reward,id',

            'kode'=>'required|unique:reward_vouchers,kode,'.$rewardVoucher->id,

            'nominal'=>'nullable|numeric|min:0',

            'status'=>'required|in:aktif,digunakan,expired,dibatalkan',

            'berlaku_mulai'=>'nullable|date',

            'berlaku_sampai'=>'nullable|date|after_or_equal:berlaku_mulai',

        ]);

        $rewardVoucher->update([

            'reward_id'=>$request->reward_id,

            'kode'=>strtoupper($request->kode),

            'nominal'=>$request->nominal,

            'status'=>$request->status,

            'berlaku_mulai'=>$request->berlaku_mulai,

            'berlaku_sampai'=>$request->berlaku_sampai,

        ]);

        return redirect()

            ->route('admin.voucher.index')

            ->with('success','Voucher berhasil diperbarui.');

    }

    /**
     * Delete
     */
    public function destroy(RewardVoucher $rewardVoucher)
    {
        $rewardVoucher->delete();

        return back()->with(

            'success',

            'Voucher berhasil dihapus.'

        );
    }
}