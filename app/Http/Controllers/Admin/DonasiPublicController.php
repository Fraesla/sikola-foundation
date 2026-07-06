<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DonasiPublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DonationCategory::latest()->paginate(5);

        return view(
            'admin.donation-category.index',
            compact('categories')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.donation-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonationCategory $donationCategory)
    {
        return view(
            'admin.donation-category.edit',
            compact('donationCategory')
        );
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(
        Request $request,
        DonationCategory $donationCategory
    )
    {
        $request->validate([
            'nama' => 'required|max:255',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $gambar = $donationCategory->gambar;

        if ($request->hasFile('gambar')) {

            if ($gambar) {
                Storage::disk('public')->delete($gambar);
            }

            $gambar = $request
                        ->file('gambar')
                        ->store('donation-category', 'public');
        }

        $donationCategory->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon,
            'gambar' => $gambar,
            'target_default' => $request->target_default ?? 0,
            'is_aktif' => $request->has('is_aktif'),
        ]);

        return redirect()
                ->route('admin.donation-categories.index')
                ->with('success', 'Kategori berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonationCategory $donationCategory)
    {
        if ($donationCategory->gambar) {
            Storage::disk('public')
                ->delete($donationCategory->gambar);
        }

        $donationCategory->delete();

        return back()
                ->with('success', 'Kategori berhasil dihapus');
    }
}
