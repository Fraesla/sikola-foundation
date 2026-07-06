<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tier;
use Illuminate\Support\Facades\Hash;


class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userQuery = User::where('role', '!=', 'admin');

        $users = $userQuery->clone()
                    ->with('tier')
                    ->latest()
                    ->get();

        return view('admin.pengguna.index', [
            'users'           => $users,
            'totalUser'       => $userQuery->clone()->count(),
            'totalRelawan'    => User::where('role', 'relawan')->count(),
            'totalDonatur'    => User::where('role', 'donatur')->count(),
            'totalPembeli'    => User::where('role', 'pembeli')->count(),
            'totalMember'     => $userQuery->clone()->whereNotNull('tier_id')->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiers = Tier::all();

        return view(
            'admin.pengguna.create',
            compact('tiers')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'role'=>'required',
            'tier_id'=>'nullable|exists:tiers,id'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'tier_id'=>$request->tier_id,
            'total_poin'=>0,
            'is_active'=>true
        ]);

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success','Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $pengguna)
    {
        $pengguna->load([
            'tier',
            'eventRegistrasi',
            'donasis',
        ]);

        return view('admin.pengguna.show', [
            'user' => $pengguna
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pengguna)
    {
        $tiers = Tier::all();

        return view(
            'admin.pengguna.edit',
            [
                'user'=>$pengguna,
                'tiers'=>$tiers
            ]
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pengguna)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$pengguna->id,
            'role'=>'required'
        ]);

        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->role = $request->role;
        $pengguna->tier_id = $request->tier_id;

        if($request->filled('password')){
            $pengguna->password = Hash::make($request->password);
        }

        $pengguna->save();

        return redirect()
            ->route('admin.pengguna.index')
            ->with('success','Data berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengguna)
    {
        $pengguna->delete();

        return back()->with(
            'success',
            'Pengguna berhasil dihapus.'
        );
    }

    public function nonaktif($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_active' => false
        ]);

        return back()->with('success', 'User berhasil dinonaktifkan');
    }

    public function aktif($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_active' => true
        ]);

        return back()->with('success', 'User berhasil diaktifkan');
    }
}
