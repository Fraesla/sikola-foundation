<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Donasi;
use App\Models\DonationCategory;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DonaturDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        // total order user
        $totalOrder = Order::where('user_id', $user->id)->count();

        // total item keranjang user
        $totalKeranjang = Cart::where('user_id', $user->id)
                                ->sum('qty');

        // total belanja yang sudah dibayar
        $totalBelanja = Order::where('user_id', $user->id)
                            ->whereIn('status', [
                                'diproses',
                                'dikirim',
                                'selesai'
                            ])
        ->sum('total_harga');

        $totalDonasi = Donasi::where('user_id', auth()->id())
                ->where('status','dikonfirmasi')
                ->sum('jumlah');
        $products = Merchandise::latest()
                    ->where('is_aktif',1)
                    ->take(4)
                    ->get();
        $achievement = $this->getAchievements($user);

        return view('donatur.dashboard', [

            'totalOrder'      => $totalOrder,
            'totalKeranjang'  => $totalKeranjang,
            'totalBelanja'    => $totalBelanja,
            'totalDonasi'    => $totalDonasi,
            'totalDonasis'    => $achievement['totalDonasis'],
            'totalRelawan'=>$achievement['totalRelawan'],
            'products'    => $products,
            'membership'      => $this->getMembership($user),
            'activities'      => $this->getActivities($user),
            'donasiSummary' => $this->getDonasiSummary($user),
            'programs'=>$this->getPrograms(),
            'recentDonations' => $this->getRecentDonations($user),
            'impact' => $this->getImpact($user),
            'challenge'=>$this->getMonthlyChallenge($user),
            'leaderboard' => $this->getLeaderboard($user),
            'donationChart'=>$this->getDonationChart($user),
            'stories' => $this->getStories(),
            'achievement' => $this->getAchievement($user),
        ]);
    }

    private function getAchievement($user)
    {
        $donasiCount = $user->donasis()
            ->where('status', 'dikonfirmasi')
            ->count();

        $totalDonasi = $user->donasis()
            ->where('status', 'dikonfirmasi')
            ->sum('jumlah');

        $badges = collect();

        $badges->push([
            'icon' => '🎉',
            'title' => 'Donasi Pertama',
            'desc' => 'Melakukan donasi pertama.',
            'unlock' => $donasiCount >= 1,
        ]);

        $badges->push([
            'icon' => '🥉',
            'title' => 'Donatur Perunggu',
            'desc' => 'Total donasi minimal Rp500.000',
            'unlock' => $totalDonasi >= 500000,
        ]);

        $badges->push([
            'icon' => '🥈',
            'title' => 'Donatur Perak',
            'desc' => 'Total donasi minimal Rp2.000.000',
            'unlock' => $totalDonasi >= 2000000,
        ]);

        $badges->push([
            'icon' => '🥇',
            'title' => 'Donatur Emas',
            'desc' => 'Total donasi minimal Rp5.000.000',
            'unlock' => $totalDonasi >= 5000000,
        ]);

        $badges->push([
            'icon' => '💎',
            'title' => 'Diamond Donor',
            'desc' => 'Total donasi minimal Rp10.000.000',
            'unlock' => $totalDonasi >= 10000000,
        ]);

        $badges->push([
            'icon' => '❤️',
            'title' => 'Peduli Pendidikan',
            'desc' => 'Melakukan 10 kali donasi.',
            'unlock' => $donasiCount >= 10,
        ]);

        return $badges;
    }

    private function getStories()
    {
        // return \App\Models\Content::where('kategori','story')

        //     ->latest()

        //     ->take(3)

        //     ->get();

        
        return collect([

            (object)[
                'judul'=>'Beasiswa untuk Aisyah',
                'gambar'=>'story1.jpg',
                'deskripsi'=>'Berkat bantuan para donatur, Aisyah kini dapat kembali bersekolah.'
            ],

            (object)[
                'judul'=>'Perpustakaan Desa',
                'gambar'=>'story2.jpg',
                'deskripsi'=>'Lebih dari 500 buku telah disalurkan kepada anak-anak.'
            ],

            (object)[
                'judul'=>'Renovasi Sekolah',
                'gambar'=>'story3.jpg',
                'deskripsi'=>'Sekolah kini memiliki ruang kelas yang layak digunakan.'
            ]

        ]);
        
    }

    private function getDonationChart($user)
    {
        $rows = $user->donasis()

            ->selectRaw('MONTH(created_at) bulan, SUM(jumlah) total')

            ->where('status','dikonfirmasi')

            ->whereYear('created_at', now()->year)

            ->groupBy('bulan')

            ->pluck('total','bulan');

        $labels = [];

        $values = [];

        for($i=1;$i<=12;$i++){

            $labels[] = date('M', mktime(0,0,0,$i,1));

            $values[] = $rows[$i] ?? 0;

        }

        return [

            'labels'=>$labels,

            'values'=>$values

        ];
    }

    private function getLeaderboard($user)
    {
        $leaderboard = \App\Models\User::where('role', 'donatur')

            ->withSum([
                'donasis as total_donasi' => function ($q) {

                    $q->where('status', 'dikonfirmasi');

                }

            ], 'jumlah')

            ->orderByDesc('total_donasi')

            ->take(10)

            ->get();

        $ranking = \App\Models\User::where('role','donatur')

            ->withSum([
                'donasis as total_donasi' => function($q){

                    $q->where('status','dikonfirmasi');

                }

            ],'jumlah')

            ->orderByDesc('total_donasi')

            ->pluck('id')

            ->search($user->id);

        return [

            'list'=>$leaderboard,

            'ranking'=>$ranking === false ? '-' : $ranking+1

        ];
    }

    private function getMonthlyChallenge($user)
    {
        $current = $user->donasis()

            ->where('status','dikonfirmasi')

            ->whereMonth('created_at',now()->month)

            ->whereYear('created_at',now()->year)

            ->sum('jumlah');


        $target = 500000;
        $progress = $target > 0
            ? min(100, ($current/$target)*100)
            : 0;

        return [

            'current'=>$current,

            'target'=>$target,

            'progress'=>min(
                100,
                ($current/$target)*100
            )

        ];
    }
    private function getAchievements($user)
    {
        return [

            'totalDonasis' => $user->donasis()
                ->where('status','dikonfirmasi')
                ->count(),

            'totalRelawan' => $user->eventRegistrasi()
                ->where('status','hadir')
                ->count(),

        ];
    }

    private function getImpact($user)
    {
        $totalDonasi = $user->donasis()
            ->where('status','dikonfirmasi')
            ->count();

        $nominal = $user->donasis()
            ->where('status','dikonfirmasi')
            ->sum('jumlah');

        /*
        |-------------------------------------------------------
        | Simulasi Dampak
        |-------------------------------------------------------
        */

        $anak = floor($nominal / 100000);

        $program = $user->donasis()
            ->where('status','dikonfirmasi')
            ->distinct('donation_category_id')
            ->count();

        /*
        |-------------------------------------------------------
        | Ranking Donatur
        |-------------------------------------------------------
        */

        $ranking = \App\Models\User::where('role','donatur')

            ->withSum([
                'donasis as total_donasi' => function($q){

                    $q->where('status','dikonfirmasi');

                }

            ],'jumlah')

            ->orderByDesc('total_donasi')

            ->pluck('id')

            ->search($user->id);

        return [

            'totalDonasi'=>$totalDonasi,

            'anak'=>$anak,

            'program'=>$program,

            'ranking'=>$ranking === false ? '-' : $ranking + 1

        ];
    }

    private function getRecentDonations($user)
    {
        return $user->donasis()

            ->with('kategori')

            ->latest()

            ->take(5)

            ->get();
    }

    private function getDonasiSummary($user)
    {
        $donasi = $user->donasis()
                        ->where('status','dikonfirmasi');

        $total = $donasi->sum('jumlah');

        $jumlah = $donasi->count();

        $bulanIni = $user->donasis()
                        ->where('status','dikonfirmasi')
                        ->whereMonth('created_at',now()->month)
                        ->sum('jumlah');

        $target = 5000000;

        return [

            'total'=>$total,

            'jumlah'=>$jumlah,

            'bulanIni'=>$bulanIni,

            'progress'=>min(
                100,
                ($bulanIni/$target)*100
            )

        ];
    }

    private function getPrograms()
    {
        return DonationCategory::latest()
            ->take(3)
            ->get()
            ->map(function ($item) {

                $item->terkumpul = $item->donasis()
                    ->where('status', 'dikonfirmasi')
                    ->sum('jumlah');

                $item->target = $item->target_default;

                $item->persen = $item->target > 0
                    ? min(100, ($item->terkumpul / $item->target) * 100)
                    : 0;

                return $item;
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

    private function getActivities($user)
    {
        $activities = collect();

        $this->cartActivities($user,$activities);

        $this->checkoutActivities($user,$activities);

        $this->orderActivities($user,$activities);

        $this->donasiActivities($user,$activities);

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

                    'icon' => '🛒',

                    'title' => 'Menambahkan Produk',

                    'description' => $cart->product->nama,

                    'status' => 'Masuk Keranjang',

                    'color' => 'blue',

                    'date' => $cart->created_at

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
                        'icon' => '📦',
                        'title' => 'Checkout Berhasil',
                        'description' => 'Order #'.$order->kode_order,
                        'status' => ucfirst($order->status),
                        'color' => match($order->status){
                            'selesai' => 'green',
                            'diproses' => 'blue',
                            default => 'yellow',
                        },
                        'date' => $order->created_at

                    ]);

                }

            });
    }

    /*
    |--------------------------------------------------------------------------
    | Donasi
    |--------------------------------------------------------------------------
    */

    private function donasiActivities($user,$activities)
    {
        $user->donasis()

            ->latest()

            ->take(5)

            ->get()

            ->each(function($donasi) use($activities){

                $activities->push([

                    'icon' => '❤️',

                    'title' => 'Donasi',

                    'description' => 'Donasi sebesar Rp '.number_format($donasi->jumlah,0,',','.'),

                    'status' => ucfirst($donasi->status),

                    'color' => $donasi->status=='dikonfirmasi'
                                ? 'green'
                                : 'yellow',

                    'date' => $donasi->created_at

                ]);

            });
    }

    public function profile()
    {
         $user = Auth::user();

        return view('donatur.profile',[

            'user'=>$user,

            'totalDonasi'=>Donasi::where('user_id',$user->id)
                ->where('status','dikonfirmasi')
                ->sum('jumlah'),

            'jumlahDonasi'=>Donasi::where('user_id',$user->id)->count(),

            'jumlahOrder'=>Order::where('user_id',$user->id)->count(),

            'jumlahKeranjang'=>Cart::where('user_id',$user->id)->sum('qty'),

        ]);
    }

     /*
    |--------------------------------------------------------------------------
    | Update Profil
    |--------------------------------------------------------------------------
    */

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([

            'name'=>'required|max:255',

            'email'=>'required|email|unique:users,email,'.$user->id,

            'avatar'=>'nullable|image|max:2048',

        ]);

        if($request->hasFile('avatar')){

            if($user->avatar &&
                !str_contains($user->avatar,'googleusercontent')){

                Storage::disk('public')->delete($user->avatar);

            }

            $user->avatar = $request
                ->file('avatar')
                ->store('profile','public');

        }

        $user->update([

            'name'=>$request->name,

            'email'=>$request->email,

            'avatar'=>$user->avatar

        ]);

        return redirect()->route('donatur.dashboard')->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
