<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\EventRegistrasi;
use App\Models\Event;
use App\Models\Donasi;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RelawanDashboardController extends Controller
{
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

        $totalEventKatergori = Event::count();
        $totalEvent = EventRegistrasi::count();

        $totalHadir = EventRegistrasi::where('status','hadir')
                        ->count();

        $totalJam = 48;

        $levelRelawan = 'Relawan Aktif';

        $nextLevel = 'Koordinator';

        $jamPengabdian = 74;

        $targetJam = 100;

        $sisaJam = max(0, $targetJam - $jamPengabdian);

        $progressRelawan = round(($jamPengabdian / $targetJam) * 100);

        $totalPoinRelawan = auth()->user()->total_poin ?? 0;

        $badgeRelawan = 'Silver Volunteer';

        $upcomingEvents = Event::whereDate('tanggal_mulai', '>=', today())
                            ->withCount('registrasis')
                            ->orderBy('tanggal_mulai')
                            ->take(3)
                            ->get();
        $upcomingEvents->map(function($event){

            $event->isRegistered = EventRegistrasi::where('event_id',$event->id)
                ->where('user_id',auth()->id())
                ->exists();

            return $event;

        });

        $aktivitas = collect();

        EventRegistrasi::with('event')
        ->where('user_id',$user->id)
        ->latest()
        ->take(5)
        ->get()
        ->each(function($item) use ($aktivitas){

            $aktivitas->push([

                'icon' => '🎯',

                'bg' => 'rgba(34,197,94,.15)',

                'title' => 'Mengikuti Event',

                'desc' => optional($item->event)->judul,

                'time' => Carbon::parse($item->created_at)
                            ->diffForHumans()

            ]);

        });

         Donasi::with('kategori')

            ->latest()

            ->take(5)

            ->get()

            ->each(function($item) use($aktivitas){

                $aktivitas->push([

                    'icon' => '❤️',

                    'bg' => 'rgba(34,197,94,.15)',

                    'title' => 'Donasi',

                    'desc' => 'Donasi sebesar Rp '.number_format($item->jumlah,0,',','.'),

                    'status' => ucfirst($item->status),

                    'color' => $item->status=='dikonfirmasi'
                                ? 'green'
                                : 'yellow',

                    'time' => Carbon::parse($item->created_at)
                            ->diffForHumans()

                ]);

            });

        Order::where('user_id',$user->id)
        ->latest()
        ->take(5)
        ->get()
        ->each(function($item) use ($aktivitas){

            $aktivitas->push([

                'icon' => '📦',

                'bg' => 'rgba(59,130,246,.15)',

                'title' => 'Pesanan Dibuat',

                'desc' => 'Order #'.$item->kode_order,

                'time' => Carbon::parse($item->created_at)
                            ->diffForHumans()

            ]);

        });

        Cart::where('user_id',$user->id)
        ->latest()
        ->take(5)
        ->get()
        ->each(function($item) use ($aktivitas){

            $aktivitas->push([

                'icon' => '🛒',

                'bg' => 'rgba(245,158,11,.15)',

                'title' => 'Menambahkan Produk',

                'desc' => 'Produk ditambahkan ke keranjang',

                'time' => Carbon::parse($item->created_at)
                            ->diffForHumans()

            ]);

        });

        $aktivitas = $aktivitas->sortByDesc('time')->take(10);

        $badges = [

            [
                'icon'   => '🥇',
                'title'  => 'Volunteer Baru',
                'desc'   => 'Mengikuti event pertama.',
                'active' => true,
            ],

            [
                'icon'   => '🤝',
                'title'  => 'Aktif Membantu',
                'desc'   => 'Mengikuti minimal 5 kegiatan.',
                'active' => false,
            ],

            [
                'icon'   => '⭐',
                'title'  => 'Inspiratif',
                'desc'   => 'Mengumpulkan 500 poin.',
                'active' => false,
            ],

            [
                'icon'   => '👑',
                'title'  => 'Koordinator',
                'desc'   => 'Menjadi ketua relawan.',
                'active' => false,
            ],

        ];

        $programRelawan = Event::withCount('registrasis')
        ->latest()
        ->take(3)
        ->get();

        $leaderboard = User::where('role', 'relawan')
        ->where('is_active', 1)
        ->orderByDesc('total_poin')
        ->take(5)
        ->get();

        $totalPengabdian = EventRegistrasi::where('user_id',$user->id)
                    ->where('status','hadir')
                    ->count();

        $totalPoin = auth()->user()->total_poin ?? 0;

        $totalJamPengabdian = $jamPengabdian;

        $kontribusiBulanIni = EventRegistrasi::where('user_id',$user->id)
                                ->whereMonth('created_at',now()->month)
                                ->count();

        $peringkatRelawan = \App\Models\User::where('role','relawan')
                            ->where('total_poin','>', $totalPoin)
                            ->count()+1;

        $riwayatPengabdian = EventRegistrasi::with('event')
                            ->where('user_id', $user->id)
                            ->latest()
                            ->take(6)
                            ->get();

        return view('relawan.dashboard', compact(
            'totalOrder',
            'totalKeranjang',
            'totalBelanja',
            'totalEvent',
            'totalHadir',
            'totalEventKatergori',
            'levelRelawan',
            'nextLevel',
            'jamPengabdian',
            'targetJam',
            'progressRelawan',
            'totalPoinRelawan',
            'badgeRelawan',
            'upcomingEvents',
            'aktivitas',
            'badges',
            'sisaJam',
            'programRelawan',
            'leaderboard',
            'totalPengabdian',
            'totalPoin',
            'totalJamPengabdian',
            'kontribusiBulanIni',
            'peringkatRelawan',
            'riwayatPengabdian',
        ));

    }
    public function profile()
    {
         $user = Auth::user();

         // total item keranjang user
        $totalKeranjang = Cart::where('user_id', $user->id)
                                ->sum('qty');

        $totalEvent = EventRegistrasi::where('user_id',$user->id)->count();

        $totalHadir = EventRegistrasi::where('user_id',$user->id)
                        ->where('status','hadir')
                        ->count();

        $totalDonasi = Donasi::where('user_id',$user->id)->sum('jumlah');

        $totalOrder = Order::where('user_id',$user->id)->count();

        $totalPoin = $user->total_poin ?? 0;

        $riwayat = collect()

            ->merge(
                EventRegistrasi::with('event')
                    ->where('user_id',$user->id)
                    ->latest()
                    ->take(5)
                    ->get()
            );

        return view(
            'relawan.profile',
            compact(
                'user',
                'totalEvent',
                'totalKeranjang',
                'totalHadir',
                'totalDonasi',
                'totalOrder',
                'totalPoin',
                'riwayat'
            )
        );
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

        return redirect()->route('relawan.dashboard')->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }
}
