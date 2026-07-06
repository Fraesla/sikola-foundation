<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Banner;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
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

    private function roleRoute($route)
    {
        $role = auth()->user()->role;

        return match($role){
            'donatur' => "donatur.$route",
            'relawan' => "relawan.$route",
            default   => "pembeli.$route",
        };
    }

     public function index()
    {
        $cartItems = Cart::where('user_id',auth()->id())
                        ->with('product')
                        ->get();

        return view(
            $this->roleView('keranjang'),
            compact('cartItems')
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       $query = Merchandise::where('is_aktif', true);

        // Filter kategori
        if ($request->filled('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        $merchandises = $query
                        ->latest()
                        ->paginate(8)
                        ->withQueryString();

        $categories = Merchandise::where('is_aktif', true)
                        ->select('kategori')
                        ->distinct()
                        ->pluck('kategori');
        
        $bannerMerchandise = Banner::where('urutan', 7)
                        ->where('is_aktif', true)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view(
            'frontend.merchandise',
            compact('merchandises', 'categories','bannerMerchandise')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->merchandise_id;
        $produk = Merchandise::findOrFail($id);

        $cart = Cart::where('user_id',auth()->id())
                    ->where('merchandise_id',$id)
                    ->first();

        if($cart){

            $cart->increment('qty');

        }else{

            Cart::create([
                'user_id'=>auth()->id(),
                'merchandise_id'=>$id,
                'qty'=>1
            ]);
        }

        return redirect()
        ->route($this->roleRoute('keranjang.index'))
        ->with(
            'success',
            'Produk berhasil ditambahkan ke keranjang'
        );
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

        $cart->delete();

        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang'
        );
    }
}