<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $query = Banner::with('creator');

        // SEARCH
        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // FILTER STATUS
        if ($request->status != '') {
            $query->where('is_aktif', $request->status);
        }

        // SORT
        if ($request->sort == 'oldest') {
            $query->orderBy('urutan', 'asc');
        } else {
            $query->orderBy('urutan', 'desc');
        }

        $banners = $query->paginate(5)->withQueryString();

        return view('admin.banner.index', [
            'banners'       => $banners,
            'totalBanner'   => Banner::count(),
            'bannerAktif'   => Banner::where('is_aktif', 1)->count(),
            'bannerNonaktif'=> Banner::where('is_aktif', 0)->count(),
            'urutanMax'     => Banner::max('urutan'),
        ]);
    }
    public function create()
    {
        return view('admin.banner.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambar = $request->file('gambar')
            ->store('banner','public');

        Banner::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'url_tautan' => $request->url_tautan,
            'urutan' => $request->urutan,
            'is_aktif' => $request->has('is_aktif'),
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.banners.index')
            ->with('success','Banner berhasil ditambahkan');
    }
    public function edit(Banner $banner)
    {
        return view(
            'admin.banner.edit',
            compact('banner')
        );
    }
    public function update(Request $request,Banner $banner)
    {
        $request->validate([
            'judul' => 'required|max:255',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'url_tautan' => $request->url_tautan,
            'urutan' => $request->urutan,
            'is_aktif' => $request->has('is_aktif'),
        ];

        if ($request->hasFile('gambar')) 
        {
            if ($banner->gambar && Storage::disk('public')->exists($banner->gambar)) 
            {
                Storage::disk('public')->delete($banner->gambar);
            }

            $data['gambar'] = $request
                ->file('gambar')
                ->store('banner', 'public');
        }

        $banner->update($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success','Banner berhasil diupdate');
    } 
    public function destroy(Banner $banner)
    {
        Storage::disk('public')
            ->delete($banner->gambar);

        $banner->delete();

        return back()
            ->with('success','Banner berhasil dihapus');
    }
}