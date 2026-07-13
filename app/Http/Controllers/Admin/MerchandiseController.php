<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MerchandiseController extends Controller
{

    public function index(Request $request)
    {
        $query = Merchandise::query();

        // Search
        if ($request->search) {
            $query->where('nama', 'like', '%'.$request->search.'%');
        }

        // Filter kategori
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
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

        $products = $query->paginate(5)
            ->withQueryString();

        return view(
            'admin.merchandise.index',
            [
                'products'      => $products,
                'totalProduk'   => Merchandise::count(),
                'totalStok'     => Merchandise::sum('stok'),
                'produkAktif'   => Merchandise::where('is_aktif',1)->count(),
                'produkNonaktif'=> Merchandise::where('is_aktif',0)->count(),
            ]
        );
    }

    public function produk()
    {
        return view('admin.merchandise.dashboard',[
            'totalProduk' => Merchandise::count(),
            'totalStok' => Merchandise::sum('stok'),
            'produkAktif' => Merchandise::where('is_aktif',1)->count(),

            'orderBaru' => Order::where(
                'status',
                'menunggu_konfirmasi'
            )->count(),

            'orderDiproses' => Order::where(
                'status',
                'diproses'
            )->count(),

            'orderSelesai' => Order::where(
                'status',
                'selesai'
            )->count()
        ]);
    }

    public function create()
    {
        return view('admin.merchandise.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'harga'=>'required',
            'stok'=>'required'
        ]);

        $gambar=[];

        if($request->hasFile('gambar')){

            foreach($request->file('gambar') as $file){

                $gambar[] = $file
                    ->store('merchandise','public');
            }
        }

        Merchandise::create([
            'nama'=>$request->nama,
            'slug'=>Str::slug($request->nama),
            'deskripsi'=>$request->deskripsi,
            'harga'=>$request->harga,
            'stok'=>$request->stok,
            'gambar'=>$gambar,
            'kategori'=>$request->kategori,
            'berat_gram'=>$request->berat_gram,
            'poin_reward'=>$request->poin_reward,
            'is_aktif'=>$request->is_aktif,
            'created_by'=>auth()->id()
        ]);

        return redirect()
            ->route('admin.merchandise.index')
            ->with('success','Produk berhasil ditambahkan');
    }

    public function edit(Merchandise $merchandise)
    {
        return view(
            'admin.merchandise.edit',
            compact('merchandise')
        );
    }

    public function update(Request $request, Merchandise $merchandise)
    {
        $gambar = $merchandise->gambar;

        if($request->hasFile('gambar')){

            foreach($gambar ?? [] as $img){
                Storage::disk('public')->delete($img);
            }

            $gambar=[];

            foreach($request->file('gambar') as $file){
                $gambar[] = $file->store('merchandise','public');
            }
        }

        $merchandise->update([
            'nama'=>$request->nama,
            'slug'=>Str::slug($request->nama),
            'deskripsi'=>$request->deskripsi,
            'harga'=>$request->harga,
            'stok'=>$request->stok,
            'gambar'=>$gambar,
            'kategori'=>$request->kategori,
            'berat_gram'=>$request->berat_gram,
            'poin_reward'=>$request->poin_reward,
            'is_aktif'=>$request->is_aktif,
        ]);

         return redirect()
            ->route('admin.merchandise.index')
            ->with('success','Produk berhasil diperbarui');

    }

    public function destroy(Merchandise $merchandise)
    {
        foreach($merchandise->gambar ?? [] as $img){
            Storage::disk('public')->delete($img);
        }

        $merchandise->delete();

        return back()->with(
            'success',
            'Produk berhasil dihapus'
        );
    }
}