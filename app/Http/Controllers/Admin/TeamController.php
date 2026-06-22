<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $query = TeamMember::query();

        
        // Search nama/jabatan
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->status != '') {
            $query->where('is_aktif', $request->status);
        }

        // Sorting
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $teams = $query->paginate(5);

        $totalTeam = TeamMember::count();
        $teamAktif = TeamMember::where('is_aktif', 1)->count();
        $teamNonaktif = TeamMember::where('is_aktif', 0)->count();

        return view(
            'admin.team.index',
            compact(
                'teams',
                'totalTeam',
                'teamAktif',
                'teamNonaktif'
            )
        );

    }
    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama'=>'required',
        'jabatan'=>'required',
        'foto'=>'nullable|image|max:2048'
        ]);

        $foto = null;

        if($request->hasFile('foto')){
            $foto = $request
                    ->file('foto')
                    ->store('team','public');
        }

        TeamMember::create([
            'nama'=>$request->nama,
            'jabatan'=>$request->jabatan,
            'bio'=>$request->bio,
            'foto'=>$foto,
            'urutan'=>$request->urutan,
            'is_aktif'=>$request->is_aktif,

            'sosial_media'=>[
                'instagram' => $request->instagram,
                'facebook'  => $request->facebook,
                'tiktok'    => $request->tiktok,
                'twitter'   => $request->twitter,
                'linkedin'  => $request->linkedin,
                'youtube'   => $request->youtube,
                'website'   => $request->website,
            ]
        ]);

        return redirect()
                ->route('admin.team.index')
                ->with('success','Team berhasil ditambahkan');

    }

    public function edit(TeamMember $team)
    {
        return view(
            'admin.team.edit',
            compact('team')
        );
    }

    public function update(Request $request, TeamMember $team)
    {
        $foto = $team->foto;

        
        if($request->hasFile('foto')){

            if($foto){
                Storage::disk('public')->delete($foto);
            }

            $foto = $request
                        ->file('foto')
                        ->store('team','public');
        }

        $team->update([
            'nama'=>$request->nama,
            'jabatan'=>$request->jabatan,
            'bio'=>$request->bio,
            'foto'=>$foto,
            'urutan'=>$request->urutan,
            'is_aktif'=>$request->is_aktif,

            'sosial_media'=>[
                'instagram' => $request->instagram,
                'facebook'  => $request->facebook,
                'tiktok'    => $request->tiktok,
                'twitter'   => $request->twitter,
                'linkedin'  => $request->linkedin,
                'youtube'   => $request->youtube,
                'website'   => $request->website,
            ]
        ]);

        return redirect()
                ->route('admin.team.index');
        

    }

    public function destroy(TeamMember $team)
    {
        if($team->foto){
        Storage::disk('public')->delete($team->foto);
        }

        
        $team->delete();

        return back()->with(
            'success',
            'Team berhasil dihapus'
        );
        

    }

}