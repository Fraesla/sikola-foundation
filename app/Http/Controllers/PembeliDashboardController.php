<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;

class PembeliDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = Merchandise::latest()->where('is_aktif', 1)->take(4)->get();
        return view('pembeli.dashboard', [

            'totalOrder'      => $this->getTotalOrder($user),
            'totalKeranjang'  => $this->getTotalKeranjang($user),
            'totalBelanja'    => $this->getTotalBelanja($user),
            'activities'      => $this->getActivities($user),
            'membership'      => $this->getMembership($user),
            'products'       => $products,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Total Order
    |--------------------------------------------------------------------------
    */

    private function getTotalOrder($user)
    {
        return $user->orders()->count();
    }

    /*
    |--------------------------------------------------------------------------
    | Total Keranjang
    |--------------------------------------------------------------------------
    */

    private function getTotalKeranjang($user)
    {
        return Cart::where('user_id', $user->id)
            ->sum('qty');
    }

    /*
    |--------------------------------------------------------------------------
    | Total Belanja
    |--------------------------------------------------------------------------
    */

    private function getTotalBelanja($user)
    {
        return $user->orders()

            ->whereIn('status',[
                'diproses',
                'dikirim',
                'selesai'
            ])

            ->sum('total_harga');
    }

    /*
    |--------------------------------------------------------------------------
    | Timeline Aktivitas
    |--------------------------------------------------------------------------
    */

    private function getActivities($user)
    {
        $activities = collect();

        $this->cartActivities($user,$activities);

        $this->checkoutActivities($user,$activities);

        $this->orderActivities($user,$activities);

        return $activities
            ->sortByDesc('date')
            ->take(8)
            ->values();
    }

    /*
    |--------------------------------------------------------------------------
    | Order
    |--------------------------------------------------------------------------
    */

    private function orderActivities($user,$activities)
    {
        $user->orders()

            ->latest()

            ->take(5)

            ->get()

            ->each(function($order) use($activities){

                $activities->push([

                    'icon'   => '📦',

                    'title'  => 'Order #'.($order->kode_order ?? $order->id),

                    'subtitle'=> 'Total Rp '.number_format($order->total_harga,0,',','.'),

                    'status' => ucfirst($order->status),

                    'color'  => match($order->status){

                        'selesai'  => 'green',

                        'dikirim'  => 'blue',

                        'diproses' => 'yellow',

                        default    => 'gray',

                    },

                    'date'   => $order->created_at

                ]);

            });
    }

    /*
    |--------------------------------------------------------------------------
    | Keranjang
    |--------------------------------------------------------------------------
    */

    private function cartActivities($user,$activities)
    {
        $user->carts()

            ->with('product')

            ->latest()

            ->take(5)

            ->get()

            ->each(function($cart) use($activities){

                $activities->push([

                    'icon'   => '🛒',

                    'title'  => 'Tambah ke Keranjang',

                    'subtitle'=> $cart->product->nama ?? 'Produk',

                    'status' => $cart->qty.' Item',

                    'color'  => 'blue',

                    'date'   => $cart->created_at

                ]);

            });
    }

    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */

    private function checkoutActivities($user, $activities)
    {
        $user->orders()
            ->with('items')
            ->latest()
            ->take(5)
            ->get()
            ->each(function ($order) use ($activities) {

                foreach ($order->items as $item) {

                    $activities->push([
                        'icon'   => '💳',
                        'title'  => 'Checkout '.$item->nama_produk,
                        'status' => ucfirst($order->status),
                        'color'  => match ($order->status) {
                            'selesai'  => 'green',
                            'diproses' => 'blue',
                            default    => 'yellow',
                        },
                        'date' => $order->created_at,
                    ]);

                }

            });
    }

    private function getMembership($user)
    {
        $tier = $user->tier;

        if (!$tier) {

            return null;

        }

        $nextTier = \App\Models\Tier::where(
            'minimal_poin',
            '>',
            $tier->minimal_poin
        )

        ->orderBy('minimal_poin')

        ->first();

        $progress = 100;

        $remaining = 0;

        if ($nextTier) {

            $current = $tier->minimal_poin;

            $next = $nextTier->minimal_poin;

            $point = $user->total_poin;

            $progress = min(
                100,
                (($point-$current)/($next-$current))*100
            );

            $remaining = max(
                0,
                $next-$point
            );
        }

        return [

            'tier'=>$tier,

            'nextTier'=>$nextTier,

            'progress'=>$progress,

            'remaining'=>$remaining,

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Upgrade menjadi Donatur
    |--------------------------------------------------------------------------
    */

    public function daftar()
    {
        $user = auth()->user();

        if($user->role!='pembeli'){

            return back()->with(
                'error',
                'Anda bukan pembeli.'
            );

        }

        $user->update([

            'role'=>'donatur'

        ]);

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()

            ->route('login')

            ->with(
                'success',
                'Selamat! Anda telah menjadi Donatur. Silakan login kembali.'
            );
    }

    public function profile()
    {
         return view('pembeli.profile', [
            'user' => Auth::user()
        ]);
    }

     /*
    |--------------------------------------------------------------------------
    | Update Profil
    |--------------------------------------------------------------------------
    */

    public function updateProfile(ProfileRequest $request)
    {
        $user = auth()->user();

        $data = $request->validated();

        if($request->hasFile('avatar')){

            if($user->avatar &&
               !str_contains($user->avatar,'googleusercontent')){

                Storage::disk('public')->delete($user->avatar);

            }

            $data['avatar']=$request
                    ->file('avatar')
                    ->store('profile','public');

        }

        $user->update($data);

        return redirect()->route('pembeli.dashboard')->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }
}
