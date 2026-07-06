<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCategory;
use App\Models\Donasi;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DonationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DonationCategory::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%'.$request->search.'%');
        }

        if ($request->status != '') {
            $query->where('is_aktif', $request->status);
        }

        $kategori = $query
                        ->latest()
                        ->paginate(5)
                        ->withQueryString();

        return view(
            'admin.donasi.kategori.index',
            compact('kategori')
        );
    }

    public function kategori(Request $request)
    {
        // ==========================
        // KATEGORI DONASI
        // ==========================

        $totalKategori = DonationCategory::count();

        $kategoriAktif = DonationCategory::where('is_aktif', 1)->count();

        $totalLokasi = DonationCategory::whereNotNull('lokasi')
                        ->distinct('lokasi')
                        ->count('lokasi');

        // ==========================
        // DONATUR
        // ==========================

        $totalDonatur = User::whereHas('donasis')->count();

        $donasiPending = Donasi::where('status', 'menunggu')->count();

        $donasiSelesai = Donasi::where('status', 'dikonfirmasi')->count();

        return view('admin.donasi.index', compact(
            'totalKategori',
            'kategoriAktif',
            'totalLokasi',
            'totalDonatur',
            'donasiPending',
            'donasiSelesai'
        ));
    }

    public function donasi()
    {        
        $bannerDonasi = Banner::where('urutan', 4)
                    ->where('is_aktif', 1)
                    ->orderBy('created_at')
                    ->get();

        $totalKategori = DonationCategory::count();
        $kategoriAktif = DonationCategory::where('is_aktif',1)->count();

         $kategoriDonasi = DonationCategory::where('is_aktif',1)
                            ->latest()
                            ->get();


        return view('frontend.donasi', compact(
            'totalKategori',
            'kategoriAktif',
            'bannerDonasi',
            'kategoriDonasi'
        ));
    }

    public function donasiShow($slug)
    {
        $kategori = DonationCategory::where('slug',$slug)
                        ->firstOrFail();

        $terkumpul = Donasi::where(
            'donation_category_id',
            $kategori->id
        )
        ->where('status','dikonfirmasi')
        ->sum('jumlah');

        $jumlahDonatur = Donasi::where(
            'donation_category_id',
            $kategori->id
        )->count();

        $donasiTerbaru = Donasi::where(
            'donation_category_id',
            $kategori->id
        )
        ->latest()
        ->take(10)
        ->get();

        return view(
            'frontend.donasi-detail',
            compact(
                'kategori',
                'terkumpul',
                'jumlahDonatur',
                'donasiTerbaru'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.donasi.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {

            $gambar = $request
                        ->file('gambar')
                        ->store('donasiKategori', 'public');
        }

        DonationCategory::create([
            'nama'              => $request->nama,
            'slug'              => Str::slug($request->nama),
            'deskripsi'         => $request->deskripsi,
            'icon'              => $request->icon,
            'gambar'            => $gambar,
            'minimal_donasi'    => $request->minimal_donasi,
            'maksimal_donasi'   => $request->maksimal_donasi,
            'target_default'    => $request->target_default ?? 0,
            'lokasi'            => $request->lokasi,
            'is_aktif'          => $request->has('is_aktif'),
            'created_by'        => Auth::id(),
        ]);

        return redirect()
                ->route('admin.donasiKategori.index')
                ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonationCategory $donasiKategori)
    {
        return view(
            'admin.donasi.kategori.edit',
            compact('donasiKategori')
        );
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(
        Request $request,
        DonationCategory $donasiKategori
    )
    {
        $request->validate([
            'nama' => 'required|max:255',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $gambar = $donasiKategori->gambar;

        if ($request->hasFile('gambar')) {

            if ($gambar) {
                Storage::disk('public')->delete($gambar);
            }

            $gambar = $request
                        ->file('gambar')
                        ->store('donasiKategori', 'public');
        }

        $donasiKategori->update([
            'nama'              => $request->nama,
            'slug'              => Str::slug($request->nama),
            'deskripsi'         => $request->deskripsi,
            'icon'              => $request->icon,
            'gambar'            => $gambar,
            'minimal_donasi'    => $request->minimal_donasi,
            'maksimal_donasi'   => $request->maksimal_donasi,
            'target_default'    => $request->target_default ?? 0,
            'lokasi'            => $request->lokasi,
            'is_aktif'          => $request->has('is_aktif'),
        ]);

        return redirect()
                ->route('admin.donasiKategori.index')
                ->with('success', 'Kategori berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonationCategory $donasiKategori)
    {
        if ($donasiKategori->gambar) {
            Storage::disk('public')
                ->delete($donasiKategori->gambar);
        }

        $donasiKategori->delete();

        return back()
                ->with('success', 'Kategori berhasil dihapus');
    }
}