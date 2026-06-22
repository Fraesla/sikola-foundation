<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostinganController extends Controller
{
    public function index(Request $request)
    {
        $query = Postingan::with('creator');

        // Search
        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Sort
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $postingans = $query->paginate(5);

        // Statistik
        $statistik = Postingan::selectRaw("
            COUNT(*) as total,
            SUM(status='publikasi') as publikasi,
            SUM(status='draft') as draft,
            SUM(status='arsip') as arsip
        ")->first();

        return view(
            'admin.postingan.index',
            compact(
                'postingans',
                'statistik'
            )
        );
    }

    public function create()
    {
        return view('admin.postingan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required|max:255',
            'konten'=>'required',
            'gambar_cover'=>'nullable|image|max:2048',
            'kategori'=>'nullable|max:100',
            'status'=>'required',
            'published_at'=>'nullable'
        ]);

        $gambar = null;

        if($request->hasFile('gambar_cover')){
            $gambar = $request
                ->file('gambar_cover')
                ->store('postingan','public');
        }

        Postingan::create([
            'judul'=>$request->judul,
            'slug'=>Str::slug($request->judul),
            'konten'=>$request->konten,
            'gambar_cover'=>$gambar,
            'kategori'=>$request->kategori,
            'status'=>$request->status,
            'published_at'=>$request->published_at,
            'created_by'=>Auth::id()
        ]);

        return redirect()
            ->route('admin.postingans.index')
            ->with('success','Postingan berhasil ditambahkan');
    }

    public function edit(Postingan $postingan)
    {
        return view(
            'admin.postingan.edit',
            compact('postingan')
        );
    }

    public function update(Request $request, Postingan $postingan)
    {
        $request->validate([
            'judul'=>'required|max:255',
            'konten'=>'required',
            'gambar_cover'=>'nullable|image|max:2048'
        ]);

        $gambar = $postingan->gambar_cover;

        if($request->hasFile('gambar_cover')){

            if($gambar){
                Storage::disk('public')->delete($gambar);
            }

            $gambar = $request
                ->file('gambar_cover')
                ->store('postingan','public');
        }

        $postingan->update([
            'judul'=>$request->judul,
            'slug'=>Str::slug($request->judul),
            'konten'=>$request->konten,
            'gambar_cover'=>$gambar,
            'kategori'=>$request->kategori,
            'status'=>$request->status,
            'published_at'=>$request->published_at
        ]);

        return redirect()
            ->route('admin.postingans.index')
            ->with('success','Postingan berhasil diupdate');
    }

    public function destroy(Postingan $postingan)
    {
        if($postingan->gambar_cover){
            Storage::disk('public')
                ->delete($postingan->gambar_cover);
        }

        $postingan->delete();

        return back()
            ->with('success','Postingan berhasil dihapus');
    }
}
