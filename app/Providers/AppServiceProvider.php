<?php

namespace App\Providers;

use App\Models\Donasi;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\EventRegistrasi;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         View::composer('layouts.admin', function ($view) {

            $pendingDonasi = Donasi::where('status','menunggu')->count();

            $pendingOrder = Order::where('status','menunggu_konfirmasi')->count();

            $pendingRegistrasi = EventRegistrasi::where('status','mendaftar')->count();

            $totalNotif =
                $pendingDonasi +
                $pendingOrder +
                $pendingRegistrasi;

            $view->with(compact(
                'pendingDonasi',
                'pendingOrder',
                'pendingRegistrasi',
                'totalNotif'
            ));

        });
        View::composer('layouts.pembeli', function ($view) {

            $notifications = collect();

            if (Auth::check()) {

                $user = Auth::user();

                /*
                |--------------------------------------------------------------------------
                | Keranjang
                |--------------------------------------------------------------------------
                */

                Cart::with('product')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->take(3)
                    ->get()
                    ->each(function ($cart) use ($notifications) {

                        $notifications->push([

                            'icon'   => '🛒',

                            'title'  => 'Produk masuk keranjang',

                            'desc'   => optional($cart->product)->nama ?? 'Produk',

                            'status' => 'Keranjang',

                            'color'  => 'yellow',

                            'date' => Carbon::parse($cart->created_at),

                        ]);

                    });

                /*
                |--------------------------------------------------------------------------
                | Order
                |--------------------------------------------------------------------------
                */

                Order::where('user_id', $user->id)
                    ->latest()
                    ->take(3)
                    ->get()
                    ->each(function ($order) use ($notifications) {

                        $notifications->push([

                            'icon'   => '📦',

                            'title'  => 'Order #'.$order->kode_order,

                            'desc'   => ucfirst($order->status),

                            'status' => ucfirst($order->status),

                            'color'  => match ($order->status) {

                                'selesai'  => 'green',
                                'diproses' => 'blue',
                                default    => 'yellow',

                            },

                            'date' => Carbon::parse($order->created_at),

                        ]);

                    });

                /*
                |--------------------------------------------------------------------------
                | Checkout
                |--------------------------------------------------------------------------
                */

                OrderItem::whereHas('order', function ($q) use ($user) {

                        $q->where('user_id', $user->id);

                    })
                    ->with('merchandise')
                    ->latest()
                    ->take(3)
                    ->get()
                    ->each(function ($item) use ($notifications) {

                        $notifications->push([

                            'icon'   => '💳',

                            'title'  => 'Checkout Berhasil',

                            'desc'   => $item->nama_produk,

                            'status' => 'Checkout',

                            'color'  => 'green',

                            'date' => Carbon::parse($item->created_at),

                        ]);

                    });

            }

            $notifications = $notifications
                                ->sortByDesc('date')
                                ->take(6)
                                ->values();

            $view->with([

                'notifications' => $notifications,

                'totalNotif'    => $notifications->count(),

            ]);

        });

        View::composer('layouts.donatur', function ($view) {

            $notifications = collect();

            if (Auth::check()) {

                $user = Auth::user();

                /*
                |--------------------------------------------------------------------------
                | Donasi
                |--------------------------------------------------------------------------
                */

                $user->donasis()
                    ->with('kategori')
                    ->latest()
                    ->take(5)
                    ->get()
                    ->each(function ($donasi) use ($notifications) {

                        $notifications->push([

                            'icon'   => '❤️',

                            'title'  => 'Donasi Rp '.number_format($donasi->jumlah,0,',','.'),

                            'status' => ucfirst($donasi->status),

                            'color'  => $donasi->status == 'dikonfirmasi'
                                            ? 'green'
                                            : 'yellow',

                            'date'   => Carbon::parse($donasi->created_at),

                        ]);

                    });

                /*
                |--------------------------------------------------------------------------
                | Order
                |--------------------------------------------------------------------------
                */

                $user->orders()
                    ->latest()
                    ->take(5)
                    ->get()
                    ->each(function ($order) use ($notifications) {

                        $notifications->push([

                            'icon'   => '📦',

                            'title'  => 'Order #'.($order->kode_order ?? $order->id),

                            'status' => ucfirst($order->status),

                            'color'  => match ($order->status) {

                                'selesai'  => 'green',
                                'diproses' => 'blue',
                                default    => 'yellow',

                            },

                            'date' => Carbon::parse($order->created_at),

                        ]);

                    });

                /*
                |--------------------------------------------------------------------------
                | Keranjang
                |--------------------------------------------------------------------------
                */

                Cart::with('product')
                    ->where('user_id',$user->id)
                    ->latest()
                    ->take(5)
                    ->get()
                    ->each(function ($cart) use ($notifications) {

                        $notifications->push([

                            'icon'   => '🛒',

                            'title'  => 'Produk masuk keranjang',

                            'status' => optional($cart->product)->nama ?? 'Produk',

                            'color'  => 'yellow',

                            'date'   => Carbon::parse($cart->created_at),

                        ]);

                    });

                /*
                |--------------------------------------------------------------------------
                | Checkout
                |--------------------------------------------------------------------------
                */

                OrderItem::whereHas('order', function ($q) use ($user) {

                        $q->where('user_id', $user->id);

                    })
                    ->latest()
                    ->take(5)
                    ->get()
                    ->each(function ($item) use ($notifications) {

                        $notifications->push([

                            'icon'   => '💳',

                            'title'  => 'Checkout '.$item->nama_produk,

                            'status' => 'Selesai',

                            'color'  => 'green',

                            'date'   => Carbon::parse($item->created_at),

                        ]);

                    });

            }

            $notifications = $notifications
                                ->sortByDesc('date')
                                ->take(8)
                                ->values();

            $view->with([

                'notifications' => $notifications,

                'totalNotif'    => $notifications->count(),

            ]);

        });

        View::composer('layouts.relawan', function ($view) {

            $notifications = collect();

            if (Auth::check()) {

                $user = Auth::user();

                /*
                |--------------------------------------------------------------------------
                | Event yang diikuti
                |--------------------------------------------------------------------------
                */

                EventRegistrasi::with('event')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get()
                    ->each(function ($registrasi) use ($notifications) {

                        $notifications->push([

                            'icon' => '📅',

                            'title' => optional($registrasi->event)->judul ?? 'Event',

                            'status' => ucfirst($registrasi->status),

                            'color' => match ($registrasi->status) {

                                'hadir'      => 'green',
                                'mendaftar'  => 'blue',
                                'ditolak'    => 'red',
                                default      => 'yellow',

                            },

                            'date' => Carbon::parse($registrasi->created_at),

                        ]);

                    });

                /*
                |--------------------------------------------------------------------------
                | Donasi
                |--------------------------------------------------------------------------
                */

                $user->donasis()
                    ->latest()
                    ->take(5)
                    ->get()
                    ->each(function ($donasi) use ($notifications) {

                        $notifications->push([

                            'icon' => '❤️',

                            'title' => 'Donasi Rp '.number_format($donasi->jumlah,0,',','.'),

                            'status' => ucfirst($donasi->status),

                            'color' => $donasi->status == 'dikonfirmasi'
                                        ? 'green'
                                        : 'yellow',

                            'date' => Carbon::parse($donasi->created_at),

                        ]);

                    });

                /*
                |--------------------------------------------------------------------------
                | Order Merchandise
                |--------------------------------------------------------------------------
                */

                $user->orders()
                    ->latest()
                    ->take(5)
                    ->get()
                    ->each(function ($order) use ($notifications) {

                        $notifications->push([

                            'icon' => '📦',

                            'title' => 'Order #'.($order->kode_order ?? $order->id),

                            'status' => ucfirst($order->status),

                            'color' => match ($order->status) {

                                'selesai'  => 'green',
                                'diproses' => 'blue',
                                'dikirim'  => 'purple',
                                default    => 'yellow',

                            },

                            'date' => Carbon::parse($order->created_at),

                        ]);

                    });

                /*
                |--------------------------------------------------------------------------
                | Keranjang
                |--------------------------------------------------------------------------
                */

                Cart::with('product')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get()
                    ->each(function ($cart) use ($notifications) {

                        $notifications->push([

                            'icon' => '🛒',

                            'title' => optional($cart->product)->nama ?? 'Produk',

                            'status' => 'Keranjang',

                            'color' => 'yellow',

                            'date' => Carbon::parse($cart->created_at),

                        ]);

                    });

            }

            $notifications = $notifications
                ->sortByDesc('date')
                ->take(8)
                ->values();

            $view->with([

                'notifications' => $notifications,

                'totalNotif' => $notifications->count(),

            ]);

        });

        Carbon::setLocale('id');
    }
}