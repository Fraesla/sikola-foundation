@extends('layouts.donatur',[
    'activePage' => 'dashboard'
])

@section('content')

{{-- ===================================================== --}}
{{-- HERO PREMIUM DONATUR --}}
{{-- ===================================================== --}}

<div
    class="relative overflow-hidden rounded-[34px] mb-10">

    {{-- Background --}}
    <div
        class="absolute inset-0"

        style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
        ">
    </div>

    {{-- Bubble Background --}}
    <div
        class="absolute -top-24 -right-24
               w-80 h-80 rounded-full
               bg-white/10">
    </div>

    <div
        class="absolute top-16 right-32
               w-44 h-44 rounded-full
               border-[8px]
               border-white/20">
    </div>

    <div
        class="absolute -bottom-20 left-1/2
               w-60 h-60 rounded-full
               bg-white/10">
    </div>

    {{-- Content --}}
    <div
        class="relative z-10
               p-10 lg:p-12">

        <div
            class="flex flex-col
                   lg:flex-row
                   justify-between
                   items-center">

            {{-- Left --}}
            <div class="text-white">

                <span
                    class="uppercase
                           tracking-[6px]
                           text-xs
                           font-semibold
                           opacity-80">

                    Dashboard Donatur

                </span>

                <h1
                    class="text-5xl
                           font-bold
                           mt-4
                           leading-tight">

                    Halo,
                    {{ auth()->user()->name }}

                    ❤️

                </h1>

                <p
                    class="mt-6
                           max-w-2xl
                           text-lg
                           leading-relaxed
                           opacity-90">

                    Terima kasih telah menjadi bagian dari
                    <b>Sikola Foundation.</b>

                    Donasi Anda telah membantu mendukung
                    pendidikan, kegiatan sosial,
                    serta masa depan anak-anak Indonesia.

                </p>

                {{-- BUTTON --}}
                <div
                    class="flex flex-wrap gap-4 mt-8">

                    <a

                        href="{{ route('donatur.donasi.index') }}"

                        class="px-8 py-3
                               rounded-2xl
                               font-semibold
                               transition
                               hover:scale-105"

                        style="
                            background:white;
                            color:var(--color-merah);
                        ">

                        ❤️ Donasi Lagi

                    </a>

                    <a

                        href="{{ route('merchandise') }}"

                        class="px-8 py-3
                               rounded-2xl
                               border
                               border-white
                               text-white
                               font-semibold
                               transition
                               hover:bg-white
                               hover:text-red-700">

                        🛍 Merchandise

                    </a>

                </div>

            </div>

            {{-- Avatar --}}
            <div
                class="mt-10 lg:mt-0">

                @php

                    $avatar = auth()->user()->avatar;

                @endphp

                @if($avatar)

                    @if(Str::startsWith($avatar,'http'))

                        <img

                            src="{{ $avatar }}"

                            class="w-44 h-44
                                   rounded-full
                                   object-cover
                                   border-[8px]
                                   shadow-2xl"

                            style="
                                border-color:
                                rgba(255,255,255,.25);
                            ">

                    @else

                        <img

                            src="{{ asset('storage/'.$avatar) }}"

                            class="w-44 h-44
                                   rounded-full
                                   object-cover
                                   border-[8px]
                                   shadow-2xl"

                            style="
                                border-color:
                                rgba(255,255,255,.25);
                            ">

                    @endif

                @else

                    <img

                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=CC2222&color=fff"

                        class="w-44 h-44
                               rounded-full
                               border-[8px]
                               shadow-2xl"

                        style="
                            border-color:
                            rgba(255,255,255,.25);
                        ">

                @endif

            </div>

        </div>

        {{-- Bottom Info --}}
        <div
            class="grid grid-cols-3
                   gap-6
                   mt-12">

            <div
                class="bg-white/10
                       rounded-2xl
                       p-5
                       backdrop-blur-sm">

                <div class="text-3xl">

                    ❤️

                </div>

                <div class="mt-2 text-sm opacity-80 text-white">

                    Total Donasi

                </div>

                <div class="text-2xl font-bold text-white">

                    {{ number_format($totalDonasi ?? 0) }}

                </div>

            </div>

            <div
                class="bg-white/10
                       rounded-2xl
                       p-5
                       backdrop-blur-sm">

                <div class="text-3xl">

                    ⭐

                </div>

                <div class="mt-2 text-sm opacity-80 text-white">

                    Total Poin

                </div>

                <div class="text-2xl font-bold text-white">

                    {{ auth()->user()->total_poin }}

                </div>

            </div>

            <div
                class="bg-white/10
                       rounded-2xl
                       p-5
                       backdrop-blur-sm">

                <div class="text-3xl">

                    🏅

                </div>

                <div class="mt-2 text-sm opacity-80 text-white">

                    Membership

                </div>

                <div class="text-2xl font-bold text-white">

                    {{ auth()->user()->tier->nama ?? 'Member' }}

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ===================================================== --}}
{{-- PREMIUM STATISTIC --}}
{{-- ===================================================== --}}

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-7 mb-12">

    {{-- Total Donasi --}}
    <div
        class="stat-card group relative overflow-hidden rounded-[28px] p-7 transition duration-300 hover:-translate-y-2 hover:shadow-2xl"

        style="
            background:white;
            box-shadow:0 20px 40px rgba(0,0,0,.06);
        ">

        <div
            class="absolute -right-8 -top-8 w-32 h-32 rounded-full opacity-10"

            style="background:var(--color-merah)">
        </div>

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

            style="
                background:rgba(204,34,34,.12);
            ">

            ❤️

        </div>

        <div class="mt-6">

            <p
                class="text-sm"

                style="color:var(--color-coklat);">

                Total Donasi

            </p>

            <h2
                class="text-4xl font-bold mt-2">

                Rp {{ number_format($totalDonasi,0,',','.') }}

            </h2>

            <span
                class="text-sm mt-3 inline-block"

                style="color:#22c55e;">

                + Terus Berdonasi

            </span>

        </div>

    </div>

    {{-- Total Order --}}
    <div
        class="stat-card group relative overflow-hidden rounded-[28px] p-7 transition duration-300 hover:-translate-y-2 hover:shadow-2xl"

        style="
            background:white;
            box-shadow:0 20px 40px rgba(0,0,0,.06);
        ">

        <div
            class="absolute -right-8 -top-8 w-32 h-32 rounded-full opacity-10"

            style="background:var(--color-kuning)">
        </div>

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

            style="
                background:rgba(212,160,23,.12);
            ">

            📦

        </div>

        <div class="mt-6">

            <p
                class="text-sm"

                style="color:var(--color-coklat);">

                Total Order

            </p>

            <h2
                class="text-4xl font-bold mt-2">

                {{ $totalOrder }}

            </h2>

            <span
                class="text-sm mt-3 inline-block"

                style="color:var(--color-merah);">

                Merchandise Dibeli

            </span>

        </div>

    </div>

    {{-- Keranjang --}}
    <div
        class="stat-card group relative overflow-hidden rounded-[28px] p-7 transition duration-300 hover:-translate-y-2 hover:shadow-2xl"

        style="
            background:white;
            box-shadow:0 20px 40px rgba(0,0,0,.06);
        ">

        <div
            class="absolute -right-8 -top-8 w-32 h-32 rounded-full opacity-10"

            style="background:#3b82f6">
        </div>

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

            style="
                background:rgba(59,130,246,.10);
            ">

            🛒

        </div>

        <div class="mt-6">

            <p
                class="text-sm"

                style="color:var(--color-coklat);">

                Keranjang

            </p>

            <h2
                class="text-4xl font-bold mt-2">

                {{ $totalKeranjang }}

            </h2>

            <span
                class="text-sm mt-3 inline-block"

                style="color:#2563eb;">

                Item Menunggu Checkout

            </span>

        </div>

    </div>

    {{-- Total Belanja --}}
    <div
        class="stat-card group relative overflow-hidden rounded-[28px] p-7 transition duration-300 hover:-translate-y-2 hover:shadow-2xl"

        style="
            background:white;
            box-shadow:0 20px 40px rgba(0,0,0,.06);
        ">

        <div
            class="absolute -right-8 -top-8 w-32 h-32 rounded-full opacity-10"

            style="background:#22c55e">
        </div>

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

            style="
                background:rgba(34,197,94,.10);
            ">

            💰

        </div>

        <div class="mt-6">

            <p
                class="text-sm"

                style="color:var(--color-coklat);">

                Total Belanja

            </p>

            <h2
                class="text-3xl font-bold mt-2">

                Rp {{ number_format($totalBelanja,0,',','.') }}

            </h2>

            <span
                class="text-sm mt-3 inline-block"

                style="color:#16a34a;">

                Semua Transaksi

            </span>

        </div>

    </div>

</div>
{{-- ===================================================== --}}
{{-- MEMBERSHIP PREMIUM --}}
{{-- ===================================================== --}}

@if($membership)

<div
    class="relative overflow-hidden
           rounded-[34px]
           p-10
           mb-12"

    style="
        background:white;
        box-shadow:0 18px 45px rgba(0,0,0,.07);
    ">

    {{-- dekorasi --}}
    <div
        class="absolute
               -right-20
               -top-20
               w-72
               h-72
               rounded-full
               opacity-10"

        style="background:var(--color-kuning)">
    </div>

    <div
        class="absolute
               bottom-0
               right-20
               w-36
               h-36
               rounded-full
               opacity-10"

        style="background:var(--color-merah)">
    </div>

    <div
        class="relative z-10
               flex flex-col
               lg:flex-row
               justify-between
               gap-10">

        {{-- kiri --}}
        <div class="flex-1">

            <span
                class="uppercase
                       tracking-[5px]
                       text-xs
                       font-semibold"

                style="color:var(--color-coklat);">

                Membership Donatur

            </span>

            <h2
                class="text-4xl
                       font-bold
                       mt-3">

                {{ $membership['tier']->nama }}

            </h2>

            <p
                class="mt-4
                       text-slate-500
                       max-w-xl">

                Semakin banyak kontribusi dan aktivitas Anda,
                semakin tinggi level membership yang akan diperoleh.

            </p>

            {{-- Progress --}}

            <div class="mt-8">

                <div
                    class="flex
                           justify-between
                           text-sm
                           mb-3">

                    <span>

                        {{ auth()->user()->total_poin }}
                        Poin

                    </span>

                    <span>

                        @if($membership['nextTier'])

                            {{ $membership['nextTier']->minimal_poin }}
                            Poin

                        @else

                            MAX LEVEL

                        @endif

                    </span>

                </div>

                <div
                    class="h-4
                           rounded-full
                           overflow-hidden"

                    style="
                        background:#ececec;
                    ">

                    <div

                        class="h-full
                               rounded-full
                               transition-all
                               duration-1000"

                        style="
                            width:{{ $membership['progress'] }}%;
                            background:
                            linear-gradient(
                                90deg,
                                var(--color-merah),
                                var(--color-kuning)
                            );
                        ">

                    </div>

                </div>

            </div>

            @if($membership['nextTier'])

            <div
                class="mt-6
                       inline-flex
                       items-center
                       gap-2
                       rounded-full
                       px-5
                       py-2"

                style="
                    background:
                    rgba(212,160,23,.12);
                    color:var(--color-coklat);
                ">

                ⭐

                {{ $membership['remaining'] }}

                poin lagi menuju

                <b>

                    {{ $membership['nextTier']->nama }}

                </b>

            </div>

            @else

            <div
                class="mt-6
                       inline-flex
                       items-center
                       gap-2
                       rounded-full
                       px-5
                       py-2"

                style="
                    background:
                    rgba(34,197,94,.12);
                    color:#16a34a;
                ">

                👑

                Selamat!

                Anda berada di Membership tertinggi.

            </div>

            @endif

        </div>

        {{-- kanan --}}
        <div
            class="lg:w-72">

            <div
                class="rounded-[30px]
                       p-8
                       text-center"

                style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

                <div
                    class="w-28
                           h-28
                           rounded-full
                           bg-white
                           mx-auto
                           flex
                           items-center
                           justify-center
                           text-5xl">

                    🏆

                </div>

                <h3
                    class="text-white
                           text-2xl
                           font-bold
                           mt-6">

                    {{ $membership['tier']->nama }}

                </h3>

                <p
                    class="text-white/80
                           mt-2">

                    Membership Aktif

                </p>

                <div
                    class="mt-8
                           rounded-2xl
                           bg-white/10
                           p-4">

                    <div
                        class="text-white/80
                               text-sm">

                        Total Poin

                    </div>

                    <div
                        class="text-white
                               text-3xl
                               font-bold">

                        {{ auth()->user()->total_poin }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endif
{{-- ===================================================== --}}
{{-- QUICK ACTION PREMIUM --}}
{{-- ===================================================== --}}

<div class="mb-12">

    <div class="flex items-center justify-between mb-7">

        <div>

            <h2 class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                ⚡ Quick Actions

            </h2>

            <p class="mt-2"
               style="color:var(--color-coklat);">

                Akses cepat seluruh layanan Sikola Foundation.

            </p>

        </div>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        {{-- DONASI --}}
        <a href="{{ route('donatur.donasi.create') }}"
           class="group">

            <div
                class="rounded-[28px]
                       bg-white
                       p-7
                       text-center
                       transition
                       duration-300
                       hover:-translate-y-2
                       hover:shadow-xl">

                <div
                    class="w-16
                           h-16
                           mx-auto
                           rounded-2xl
                           flex
                           items-center
                           justify-center
                           text-3xl"

                    style="
                        background:
                        rgba(204,34,34,.12);
                    ">

                    ❤️

                </div>

                <h4 class="font-bold mt-5">

                    Donasi

                </h4>

                <p class="text-sm text-slate-500 mt-2">

                    Salurkan bantuan

                </p>

            </div>

        </a>

        {{-- ORDER --}}
        <a href="{{ route('donatur.orders.index') }}"
           class="group">

            <div
                class="rounded-[28px]
                       bg-white
                       p-7
                       text-center
                       transition
                       duration-300
                       hover:-translate-y-2
                       hover:shadow-xl">

                <div
                    class="w-16 h-16
                           mx-auto
                           rounded-2xl
                           flex
                           items-center
                           justify-center
                           text-3xl"

                    style="
                        background:
                        rgba(212,160,23,.15);
                    ">

                    📦

                </div>

                <h4 class="font-bold mt-5">

                    Order

                </h4>

                <p class="text-sm text-slate-500 mt-2">

                    Riwayat pesanan

                </p>

            </div>

        </a>

        {{-- KERANJANG --}}
        <a href="{{ route('donatur.keranjang.index') }}"
           class="group">

            <div
                class="rounded-[28px]
                       bg-white
                       p-7
                       text-center
                       transition
                       duration-300
                       hover:-translate-y-2
                       hover:shadow-xl">

                <div
                    class="w-16
                           h-16
                           mx-auto
                           rounded-2xl
                           flex
                           items-center
                           justify-center
                           text-3xl"

                    style="
                        background:
                        rgba(139,94,42,.12);
                    ">

                    🛒

                </div>

                <h4 class="font-bold mt-5">

                    Keranjang

                </h4>

                <p class="text-sm text-slate-500 mt-2">

                    Produk pilihan

                </p>

            </div>

        </a>

        {{-- RELAWAN --}}
        <a href="{{ route('donatur.relawan.daftar') }}"
           class="group">

            <div
                class="rounded-[28px]
                       bg-white
                       p-7
                       text-center
                       transition
                       duration-300
                       hover:-translate-y-2
                       hover:shadow-xl">

                <div
                    class="w-16
                           h-16
                           mx-auto
                           rounded-2xl
                           flex
                           items-center
                           justify-center
                           text-3xl"

                    style="
                        background:
                        rgba(34,197,94,.12);
                    ">

                    🤝

                </div>

                <h4 class="font-bold mt-5">

                    Relawan

                </h4>

                <p class="text-sm text-slate-500 mt-2">

                    Ikut kegiatan sosial

                </p>

            </div>

        </a>

        {{-- PROFILE --}}
        <a href="{{ route('donatur.profile') }}"
           class="group">

            <div
                class="rounded-[28px]
                       bg-white
                       p-7
                       text-center
                       transition
                       duration-300
                       hover:-translate-y-2
                       hover:shadow-xl">

                <div
                    class="w-16
                           h-16
                           mx-auto
                           rounded-2xl
                           flex
                           items-center
                           justify-center
                           text-3xl"

                    style="
                        background:
                        rgba(59,130,246,.12);
                    ">

                    👤

                </div>

                <h4 class="font-bold mt-5">

                    Profil

                </h4>

                <p class="text-sm text-slate-500 mt-2">

                    Kelola akun

                </p>

            </div>

        </a>

        {{-- MEMBERSHIP --}}
        <a href="#membership"
           class="group">

            <div
                class="rounded-[28px]
                       bg-white
                       p-7
                       text-center
                       transition
                       duration-300
                       hover:-translate-y-2
                       hover:shadow-xl">

                <div
                    class="w-16
                           h-16
                           mx-auto
                           rounded-2xl
                           flex
                           items-center
                           justify-center
                           text-3xl"

                    style="
                        background:
                        rgba(251,191,36,.15);
                    ">

                    🏆

                </div>

                <h4 class="font-bold mt-5">

                    Membership

                </h4>

                <p class="text-sm text-slate-500 mt-2">

                    Lihat progress

                </p>

            </div>

        </a>

        {{-- RIWAYAT DONASI --}}
        <a href="{{ route('donatur.donasi.index') }}"
           class="group">

            <div
                class="rounded-[28px]
                       bg-white
                       p-7
                       text-center
                       transition
                       duration-300
                       hover:-translate-y-2
                       hover:shadow-xl">

                <div
                    class="w-16
                           h-16
                           mx-auto
                           rounded-2xl
                           flex
                           items-center
                           justify-center
                           text-3xl"

                    style="
                        background:
                        rgba(236,72,153,.10);
                    ">

                    📜

                </div>

                <h4 class="font-bold mt-5">

                    Riwayat

                </h4>

                <p class="text-sm text-slate-500 mt-2">

                    Semua donasi

                </p>

            </div>

        </a>

        {{-- BANTUAN --}}
        <a href="{{ route('kontak') }}"
           class="group">

            <div
                class="rounded-[28px]
                       bg-white
                       p-7
                       text-center
                       transition
                       duration-300
                       hover:-translate-y-2
                       hover:shadow-xl">

                <div
                    class="w-16
                           h-16
                           mx-auto
                           rounded-2xl
                           flex
                           items-center
                           justify-center
                           text-3xl"

                    style="
                        background:
                        rgba(99,102,241,.10);
                    ">

                    💬

                </div>

                <h4 class="font-bold mt-5">

                    Bantuan

                </h4>

                <p class="text-sm text-slate-500 mt-2">

                    Hubungi admin

                </p>

            </div>

        </a>

    </div>

</div>
{{-- ===================================================== --}}
{{-- TIMELINE AKTIVITAS --}}
{{-- ===================================================== --}}

<div class="mt-12">

    <div class="flex items-center justify-between mb-7">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                📜 Aktivitas Terbaru

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Semua aktivitas akun Anda ditampilkan di sini.

            </p>

        </div>

        <a href="#"
           class="font-semibold hover:underline"
           style="color:var(--color-merah);">

            Lihat Semua →

        </a>

    </div>

    <div
        class="bg-white
               rounded-[30px]
               shadow-lg
               p-8">

        @forelse($activities as $activity)

        <div class="flex gap-5 relative pb-8">

            {{-- Garis Timeline --}}
            @unless($loop->last)

            <div
                class="absolute
                       left-6
                       top-12
                       w-[2px]
                       h-full"

                style="
                    background:
                    rgba(204,34,34,.12);
                ">
            </div>

            @endunless

            {{-- Icon --}}
            <div>

                <div

                    class="w-12
                           h-12
                           rounded-full
                           flex
                           items-center
                           justify-center
                           text-xl
                           shadow"

                    style="
                        background:

                        @switch($activity['color'])

                            @case('green')
                                rgba(34,197,94,.15)
                                ;
                                @break

                            @case('blue')
                                rgba(59,130,246,.15)
                                ;
                                @break

                            @case('red')
                                rgba(239,68,68,.15)
                                ;
                                @break

                            @default
                                rgba(251,191,36,.18)
                                ;
                        @endswitch
                    ">

                    {{ $activity['icon'] }}

                </div>

            </div>

            {{-- Content --}}
            <div class="flex-1">

                <div class="flex justify-between items-start">

                    <div>

                        <h4
                            class="font-bold text-lg">

                            {{ $activity['title'] }}

                        </h4>

                        <p
                            class="text-sm mt-1 text-slate-500">

                            {{ $activity['description'] ?? 'Aktivitas terbaru Anda.' }}

                        </p>

                    </div>

                    <small
                        class="text-slate-400">

                        {{ $activity['date']->diffForHumans() }}

                    </small>

                </div>

                <div class="mt-4">

                    <span

                        class="inline-flex
                               px-4
                               py-2
                               rounded-full
                               text-xs
                               font-bold"

                        style="
                            @switch($activity['color'])

                                @case('green')
                                    background:#DCFCE7;
                                    color:#15803D;
                                    @break

                                @case('blue')
                                    background:#DBEAFE;
                                    color:#1D4ED8;
                                    @break

                                @case('red')
                                    background:#FEE2E2;
                                    color:#B91C1C;
                                    @break

                                @default
                                    background:#FEF3C7;
                                    color:#92400E;

                            @endswitch
                        ">

                        {{ $activity['status'] }}

                    </span>

                </div>

            </div>

        </div>

        @empty

        <div class="py-16 text-center">

            <div class="text-6xl">

                📭

            </div>

            <h3 class="mt-5 text-2xl font-bold">

                Belum Ada Aktivitas

            </h3>

            <p class="text-slate-500 mt-2">

                Aktivitas Anda akan muncul setelah melakukan
                transaksi, donasi atau checkout.

            </p>

        </div>

        @endforelse

    </div>

</div>

{{-- ===================================================== --}}
{{-- REKOMENDASI MERCHANDISE --}}
{{-- ===================================================== --}}

<div class="mt-14">

    <div class="flex justify-between items-center mb-7">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                🛍 Rekomendasi Merchandise

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Produk pilihan yang mungkin Anda sukai.

            </p>

        </div>

        <a href="{{ route('merchandise') }}"
           class="font-semibold hover:underline"
           style="color:var(--color-merah);">

            Lihat Semua →

        </a>

    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-7">

        @foreach($products as $product)

        <div
            class="bg-white
                   rounded-[28px]
                   overflow-hidden
                   shadow-lg
                   hover:shadow-2xl
                   transition
                   duration-300
                   hover:-translate-y-2">

            {{-- Foto --}}
            <div
                class="relative overflow-hidden h-64">
                @php
                    $gambar = is_array($product->gambar)
                        ? ($product->gambar[0] ?? null)
                        : $product->gambar;
                @endphp
                <img

                    src="{{ $gambar ? asset('storage/'.$gambar) : asset('images/default-product.png') }}"

                    class="w-full h-full object-cover transition duration-500 hover:scale-110">

                <div
                    class="absolute top-4 left-4">

                    <span

                        class="px-3 py-1 rounded-full text-xs font-bold"

                        style="
                            background:rgba(255,255,255,.9);
                            color:var(--color-merah);
                        ">

                        ⭐ Pilihan

                    </span>

                </div>

            </div>

            {{-- Isi --}}
            <div class="p-6">

                <h3
                    class="font-bold text-lg">

                    {{ $product->nama }}

                </h3>

                <p
                    class="text-sm mt-2 text-slate-500 line-clamp-2">

                    {{ Str::limit($product->deskripsi,70) }}

                </p>

                <div class="flex justify-between items-center mt-6">

                    <div>

                        <div
                            class="text-2xl font-bold"
                            style="color:var(--color-merah);">

                            Rp {{ number_format($product->harga,0,',','.') }}

                        </div>

                    </div>

                </div>

                <a

                    href="#"

                    class="mt-6
                           w-full
                           block
                           text-center
                           py-3
                           rounded-2xl
                           font-semibold
                           text-white"

                    style="
                        background:
                        linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">

                    Lihat Produk

                </a>

            </div>

        </div>

        @endforeach

    </div>

</div>

{{-- ====================================================== --}}
{{-- DONASI SAYA --}}
{{-- ====================================================== --}}

<div class="mt-14">

    <div class="flex justify-between items-center mb-7">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                ❤️ Ringkasan Donasi Saya

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Terima kasih atas kontribusi Anda untuk
                mendukung program Sikola Foundation.

            </p>

        </div>

        <a href="{{ route('donatur.donasi.index') }}"
           class="font-semibold hover:underline"
           style="color:var(--color-merah);">

            Riwayat Donasi →

        </a>

    </div>

    <div class="grid lg:grid-cols-3 gap-7">
        <div
            class="rounded-[30px]
                   bg-white
                   shadow-lg
                   p-8">

            <div class="text-5xl mb-4">

                ❤️

            </div>

            <p class="text-slate-500">

                Total Donasi

            </p>

            <h2
                class="text-4xl font-bold mt-4"
                style="color:var(--color-merah);">

                Rp {{ number_format($donasiSummary['total'],0,',','.') }}

            </h2>

            <div class="mt-5">

                <span
                    class="px-4 py-2 rounded-full text-sm"

                    style="
                        background:
                        rgba(204,34,34,.08);
                        color:var(--color-merah);
                    ">

                    {{ $donasiSummary['jumlah'] }} Transaksi

                </span>

            </div>

        </div>
        <div
            class="rounded-[30px]
                   bg-white
                   shadow-lg
                   p-8">

            <div class="text-5xl mb-4">

                🎯

            </div>

            <p class="text-slate-500">

                Donasi Bulan Ini

            </p>

            <h2
                class="text-4xl font-bold mt-4"
                style="color:var(--color-kuning);">

                Rp {{ number_format($donasiSummary['bulanIni'],0,',','.') }}

            </h2>

            <div class="mt-6">

                <div
                    class="h-3 rounded-full bg-slate-200 overflow-hidden">

                    <div
                        class="h-full rounded-full"

                        style="
                            width:{{ $donasiSummary['progress'] }}%;
                            background:
                            linear-gradient(
                                90deg,
                                var(--color-kuning),
                                var(--color-merah)
                            );
                        ">

                    </div>

                </div>

                <p
                    class="mt-3 text-sm text-slate-500">

                    {{ round($donasiSummary['progress']) }}%
                    dari target bulan ini

                </p>

            </div>

        </div>
        <div
            class="rounded-[30px]
                   shadow-lg
                   p-8"

            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
                color:white;
            ">

            <div class="text-5xl mb-5">

                🏆

            </div>

            <h3 class="text-2xl font-bold">

                Dampak Donasi

            </h3>

            <p class="mt-4 opacity-90">

                Donasi Anda telah membantu mendukung berbagai
                kegiatan pendidikan dan sosial.

            </p>

            <div class="grid grid-cols-2 gap-5 mt-8">

                <div>

                    <div class="text-3xl font-bold">

                        {{ $donasiSummary['jumlah'] }}

                    </div>

                    <small>

                        Donasi

                    </small>

                </div>

                <div>

                    <div class="text-3xl font-bold">

                        {{ number_format($donasiSummary['total']/1000000,1) }} Jt

                    </div>

                    <small>

                        Kontribusi

                    </small>

                </div>

            </div>

        </div>
    </div>
</div>
{{-- ===================================================== --}}
{{-- PROGRAM BERJALAN --}}
{{-- ===================================================== --}}

<div class="mt-14">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                🌱 Program yang Sedang Berjalan

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Terima kasih atas dukungan Anda.
                Berikut beberapa program yang sedang kami jalankan.

            </p>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        @foreach($programs as $program)

            <div
                class="bg-white
                       rounded-[30px]
                       overflow-hidden
                       shadow-lg
                       hover:shadow-2xl
                       transition
                       duration-300
                       hover:-translate-y-2">

                {{-- Gambar --}}
                <img

                    src="{{ asset('storage/'.$program->gambar) }}"

                    class="w-full h-56 object-cover">

                <div class="p-7">

                    <h3
                        class="text-xl font-bold">

                        {{ $program->judul }}

                    </h3>

                    <p
                        class="text-slate-500 mt-3 line-clamp-3">

                        {{ Str::limit($program->deskripsi,120) }}

                    </p>

                    <div class="mt-6">

                        <div class="flex justify-between text-sm">

                            <span>Terkumpul</span>

                            <span>

                                Rp {{ number_format($program->terkumpul,0,',','.') }}

                            </span>

                        </div>

                        <div
                            class="mt-3 h-3 rounded-full bg-slate-200 overflow-hidden">

                            <div

                                class="h-full rounded-full"

                                style="
                                    width:{{ $program->persen }}%;
                                    background:
                                    linear-gradient(
                                        90deg,
                                        var(--color-kuning),
                                        var(--color-merah)
                                    );
                                ">

                            </div>

                        </div>

                        <div
                            class="text-right mt-2 text-sm text-slate-500">

                            {{ round($program->persen) }}%

                        </div>

                    </div>

                    <a

                        href="{{ route('admin.donasiDetail',$program->slug) }}"

                        class="block
                               mt-7
                               text-center
                               py-3
                               rounded-2xl
                               font-semibold
                               text-white"

                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                        Lihat Program

                    </a>

                </div>

            </div>

        @endforeach
    </div>
</div>

<div class="mt-12">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-3xl font-bold"
                style="color:var(--color-hitam)">

                Riwayat Donasi

            </h2>

            <p style="color:var(--color-coklat)">
                Donasi terakhir yang telah Anda lakukan
            </p>

        </div>

        <a href="{{ route('donatur.donasi.index') }}"
           class="font-semibold"
           style="color:var(--color-merah)">

            Lihat Semua →

        </a>

    </div>

    <div class="bg-white rounded-[30px] shadow-xl overflow-hidden">

        @forelse($recentDonations as $donasi)

        <div
            class="flex items-center justify-between px-8 py-6 border-b hover:bg-orange-50 transition">

            <div class="flex gap-5 items-center">

                <div
                    class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

                    style="background:rgba(204,34,34,.08)">

                    ❤️

                </div>

                <div>

                    <h4 class="font-bold text-lg">

                        {{ $donasi->kategori->nama }}

                    </h4>

                    <p class="text-slate-500">

                        {{ $donasi->created_at->translatedFormat('d F Y H:i') }}

                    </p>

                </div>

            </div>

            <div class="text-right">

                <h3 class="text-2xl font-bold">

                    Rp {{ number_format($donasi->jumlah,0,',','.') }}

                </h3>

                @php

                    $badge = match($donasi->status){

                        'dikonfirmasi' => 'bg-green-100 text-green-700',

                        'menunggu' => 'bg-yellow-100 text-yellow-700',

                        'ditolak' => 'bg-red-100 text-red-700',

                        default => 'bg-slate-100 text-slate-700'

                    };

                @endphp

                <span class="px-4 py-1 rounded-full text-sm {{ $badge }}">

                    {{ ucfirst($donasi->status) }}

                </span>

            </div>

        </div>

        @empty

        <div class="py-20 text-center">

            <div class="text-6xl mb-5">

                ❤️

            </div>

            <h3 class="text-2xl font-bold mb-2">

                Belum Ada Donasi

            </h3>

            <p class="text-slate-500">

                Mulai berdonasi untuk membantu lebih banyak orang.

            </p>

            <a href="{{ route('donatur.program') }}"
               class="inline-block mt-6 px-6 py-3 rounded-xl text-white font-semibold"

               style="background:linear-gradient(135deg,var(--color-merah),var(--color-coklat))">

                Donasi Sekarang

            </a>

        </div>

        @endforelse

    </div>

</div>
{{-- ========================================================= --}}
{{-- IMPACT DASHBOARD --}}
{{-- ========================================================= --}}

<div class="mt-16">

    <div class="mb-8">

        <h2
            class="text-3xl font-bold"
            style="color:var(--color-hitam);">

            📊 Dampak Kontribusi Anda

        </h2>

        <p
            class="mt-2"
            style="color:var(--color-coklat);">

            Setiap donasi yang Anda berikan membantu
            pendidikan dan kegiatan sosial di Indonesia.

        </p>

    </div>

    <div class="grid lg:grid-cols-4 gap-7">
        <div
            class="rounded-[30px]
                   bg-white
                   shadow-lg
                   p-8
                   text-center
                   hover:-translate-y-2
                   transition">

            <div class="text-5xl">

                ❤️

            </div>

            <h2
                class="text-4xl font-bold mt-6"
                style="color:var(--color-merah);">

                {{ $impact['totalDonasi'] }}

            </h2>

            <p class="mt-2 text-slate-500">

                Total Donasi

            </p>

        </div>
        <div
            class="rounded-[30px]
                   bg-white
                   shadow-lg
                   p-8
                   text-center
                   hover:-translate-y-2
                   transition">

            <div class="text-5xl">

                🎓

            </div>

            <h2
                class="text-4xl font-bold mt-6"
                style="color:var(--color-kuning);">

                {{ $impact['anak'] }}

            </h2>

            <p class="mt-2 text-slate-500">

                Anak Terbantu

            </p>

        </div>
        <div
            class="rounded-[30px]
                   bg-white
                   shadow-lg
                   p-8
                   text-center
                   hover:-translate-y-2
                   transition">

            <div class="text-5xl">

                🏫

            </div>

            <h2
                class="text-4xl font-bold mt-6"
                style="color:var(--color-coklat);">

                {{ $impact['program'] }}

            </h2>

            <p class="mt-2 text-slate-500">

                Program Didukung

            </p>

        </div>
        <div
            class="rounded-[30px]
                   p-8
                   text-center
                   shadow-xl"

            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
                color:white;
            ">

            <div class="text-5xl">

                🏆

            </div>

            <h2
                class="text-4xl font-bold mt-6">

                #{{ $impact['ranking'] }}

            </h2>

            <p class="mt-2 opacity-90">

                Ranking Donatur

            </p>

        </div>
    </div>
</div>
{{-- ===================================== --}}
{{-- ACHIEVEMENT --}}
{{-- ===================================== --}}

<section class="mt-12">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam)">

                🏅 Pencapaian Anda

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat)">

                Terima kasih telah menjadi bagian dari perubahan.

            </p>

        </div>

    </div>

    <div class="grid lg:grid-cols-4 gap-6">

        <div
            class="rounded-3xl bg-white p-8 text-center transition hover:-translate-y-2 hover:shadow-xl">

            <div class="text-5xl">

                ❤️

            </div>

            <h3 class="font-bold text-xl mt-5">

                {{ $totalDonasis }}

            </h3>

            <p class="text-slate-500 mt-2">

                Donasi

            </p>

        </div>

        <div
            class="rounded-3xl bg-white p-8 text-center transition hover:-translate-y-2 hover:shadow-xl">

            <div class="text-5xl">

                📦

            </div>

            <h3 class="font-bold text-xl mt-5">

                {{ $totalOrder }}

            </h3>

            <p class="text-slate-500 mt-2">

                Order

            </p>

        </div>

        <div
            class="rounded-3xl bg-white p-8 text-center transition hover:-translate-y-2 hover:shadow-xl">

            <div class="text-5xl">

                🌱

            </div>

            <h3 class="font-bold text-xl mt-5">

                {{ $totalRelawan }}

            </h3>

            <p class="text-slate-500 mt-2">

                Event Relawan

            </p>

        </div>

        <div
            class="rounded-3xl bg-white p-8 text-center transition hover:-translate-y-2 hover:shadow-xl">

            <div class="text-5xl">

                ⭐

            </div>

            <h3 class="font-bold text-xl mt-5">

                {{ number_format(auth()->user()->total_poin) }}

            </h3>

            <p class="text-slate-500 mt-2">

                Total Poin

            </p>

        </div>

    </div>

</section>
{{-- ========================================= --}}
{{-- TARGET BULAN INI --}}
{{-- ========================================= --}}

<section class="mt-12">

    <div class="rounded-[35px] overflow-hidden shadow-2xl"

        style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
        ">

        <div class="grid lg:grid-cols-2">

            <div class="p-10 text-white">

                <span
                    class="uppercase tracking-[5px] text-xs opacity-80">

                    Monthly Challenge

                </span>

                <h2
                    class="text-4xl font-bold mt-3">

                    Target Donasi Bulan Ini 🎯

                </h2>

                <p
                    class="mt-5 opacity-90 leading-relaxed">

                    Setiap donasi Anda membantu lebih banyak
                    anak Indonesia mendapatkan pendidikan
                    yang layak.

                </p>

                <div class="mt-8">

                    <div class="flex justify-between mb-2">

                        <span>

                            Rp {{ number_format($challenge['current'],0,',','.') }}

                        </span>

                        <span>

                            Rp {{ number_format($challenge['target'],0,',','.') }}

                        </span>

                    </div>

                    <div
                        class="h-4 rounded-full bg-white/20 overflow-hidden">

                        <div

                            class="h-full rounded-full transition-all duration-1000"

                            style="
                                width:{{ $challenge['progress'] }}%;
                                background:white;
                            ">

                        </div>

                    </div>

                    <div
                        class="mt-3 opacity-90">

                        {{ round($challenge['progress']) }}%
                        Target Tercapai

                    </div>

                </div>

                <div class="flex gap-4 mt-8">

                    <a
                        href="{{ route('donasi') }}"

                        class="px-7 py-3 rounded-2xl font-semibold"

                        style="
                            background:white;
                            color:var(--color-merah);
                        ">

                        ❤️ Donasi Sekarang

                    </a>

                    <a
                        href="{{ route('donatur.donasi.index') }}"

                        class="px-7 py-3 rounded-2xl border border-white">

                        Riwayat Donasi

                    </a>

                </div>

            </div>

            <div
                class="hidden lg:flex items-center justify-center">

                <div class="text-center text-white">

                    <div
                        class="w-52 h-52 rounded-full border-[10px]
                               border-white/20 flex items-center justify-center">

                        <div>

                            <div class="text-6xl font-bold">

                                {{ round($challenge['progress']) }}%

                            </div>

                            <div class="opacity-90">

                                Progress

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- ============================================= --}}
{{-- LEADERBOARD DONATUR --}}
{{-- ============================================= --}}

<section class="mt-12">

    <div class="flex justify-between items-center mb-7">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                🏆 Leaderboard Donatur

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Donatur dengan kontribusi terbesar.

            </p>

        </div>

        <div
            class="px-5 py-3 rounded-2xl"

            style="
                background:rgba(204,34,34,.08);
            ">

            Ranking Anda

            <span
                class="font-bold text-xl"
                style="color:var(--color-merah);">

                #{{ $leaderboard['ranking'] }}

            </span>

        </div>

    </div>

    <div
        class="bg-white rounded-[30px] shadow-xl overflow-hidden">
        @foreach($leaderboard['list'] as $i=>$item)

            <div

                class="flex justify-between items-center px-8 py-5 border-b transition hover:bg-orange-50

                {{ auth()->id()==$item->id ? 'bg-orange-50' : '' }}">

                <div class="flex items-center gap-5">

                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold"

                        style="

                            background:

                            {{ $i==0 ? '#FFD700' : ($i==1 ? '#C0C0C0' : ($i==2 ? '#CD7F32' : '#F4F4F4')) }};

                        ">

                        @if($i==0)

                            🥇

                        @elseif($i==1)

                            🥈

                        @elseif($i==2)

                            🥉

                        @else

                            {{ $i+1 }}

                        @endif

                    </div>

                    <img

                        src="{{ $item->avatar
                            ? asset('storage/'.$item->avatar)
                            : 'https://ui-avatars.com/api/?name='.urlencode($item->name).'&background=CC2222&color=fff' }}"

                        class="w-14 h-14 rounded-full object-cover">

                    <div>

                        <div class="font-bold text-lg">

                            {{ $item->name }}

                            @if(auth()->id()==$item->id)

                                <span
                                    class="text-xs px-2 py-1 rounded-full"

                                    style="background:rgba(204,34,34,.10);color:var(--color-merah);">

                                    Anda

                                </span>

                            @endif

                        </div>

                        <div class="text-slate-500">

                            {{ ucfirst($item->role) }}

                        </div>

                    </div>

                </div>

                <div class="text-right">

                    <div
                        class="font-bold text-xl">

                        Rp {{ number_format($item->total_donasi ?? 0,0,',','.') }}

                    </div>

                    <div
                        class="text-sm text-slate-500">

                        Total Donasi

                    </div>

                </div>

            </div>

        @endforeach
    </div>
</section>
{{-- ========================================= --}}
{{-- GRAFIK DONASI --}}
{{-- ========================================= --}}

<section class="mt-12">

<div
    class="bg-white
           rounded-[35px]
           shadow-xl
           p-10">

    <div class="grid md:grid-cols-3 gap-5 mb-8">

        <div class="rounded-2xl bg-orange-50 p-5">

            <small>Total Tahun Ini</small>

            <h3 class="text-2xl font-bold">

                Rp {{ number_format(array_sum($donationChart['values']),0,',','.') }}

            </h3>

        </div>

        <div class="rounded-2xl bg-green-50 p-5">

            <small>Bulan Terbaik</small>

            <h3 class="text-2xl font-bold">

                {{ $donationChart['labels'][array_keys($donationChart['values'], max($donationChart['values']))[0]] }}

            </h3>

        </div>

        <div class="rounded-2xl bg-blue-50 p-5">

            <small>Donasi Terbesar</small>

            <h3 class="text-2xl font-bold">

                Rp {{ number_format(max($donationChart['values']),0,',','.') }}

            </h3>

        </div>

    </div>

    <div class="flex justify-between items-center">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                📈 Grafik Donasi Tahun {{ now()->year }}

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Perkembangan kontribusi donasi Anda.

            </p>

        </div>

    </div>

    <div class="mt-10">

        <canvas
            id="donationChart"
            height="90">

        </canvas>

    </div>

</div>

</section>
{{-- ========================================= --}}
{{-- SUCCESS STORIES --}}
{{-- ========================================= --}}

<section class="mt-14">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                ❤️ Kisah Penerima Manfaat

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Setiap donasi membawa perubahan nyata.

            </p>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        @foreach($stories as $story)

        <div
            class="bg-white rounded-[30px] overflow-hidden shadow-xl transition hover:-translate-y-2 hover:shadow-2xl">

            <div class="overflow-hidden">

                <img

                    src="{{$story->gambar ? asset('storage/'.$story->gambar): 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=900'}}"


                    class="w-full h-60 object-cover transition duration-500 hover:scale-110">

            </div>

            <div class="p-7">

                <h3
                    class="text-2xl font-bold"
                    style="color:var(--color-hitam);">

                    {{ $story->judul }}

                </h3>

                <p
                    class="mt-4 leading-7"
                    style="color:var(--color-coklat);">

                    {{ Str::limit($story->deskripsi,120) }}

                </p>

                <a

                    href="#"

                    class="inline-flex items-center gap-2 mt-6 font-semibold"

                    style="color:var(--color-merah);">

                    Baca Selengkapnya →

                </a>

            </div>

        </div>

        @endforeach

    </div>

</section>
{{-- ====================================== --}}
{{-- ACHIEVEMENT --}}
{{-- ====================================== --}}

<section class="mt-14">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                🏅 Badge & Achievement

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Semakin banyak Anda berdonasi,
                semakin banyak badge yang terbuka.

            </p>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-7">

        @foreach($achievement as $badge)

        <div

            class="rounded-[28px] p-7 transition duration-300 hover:-translate-y-2

            {{ $badge['unlock']
                ? 'bg-white shadow-xl'
                : 'bg-gray-100 opacity-60'
            }}">

            <div
                class="text-6xl">

                {{ $badge['icon'] }}

            </div>

            <h3
                class="text-2xl font-bold mt-5">

                {{ $badge['title'] }}

            </h3>

            <p
                class="mt-3 text-slate-500">

                {{ $badge['desc'] }}

            </p>

            @if($badge['unlock'])

                <div

                    class="mt-6 inline-flex px-4 py-2 rounded-full text-sm font-semibold"

                    style="
                        background:rgba(34,197,94,.10);
                        color:#22C55E;
                    ">

                    ✔ Badge Terbuka

                </div>

            @else

                <div

                    class="mt-6 inline-flex px-4 py-2 rounded-full text-sm font-semibold"

                    style="
                        background:rgba(156,163,175,.15);
                        color:#6B7280;
                    ">

                    🔒 Belum Terbuka

                </div>

            @endif

        </div>

        @endforeach

    </div>

</section>
{{-- ============================================= --}}
{{-- PENUTUP DASHBOARD --}}
{{-- ============================================= --}}

<section class="mt-16 mb-10">

    <div
        class="relative overflow-hidden rounded-[40px] p-12"

        style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
        ">

        <!-- Background Decoration -->
        <div
            class="absolute -top-24 -right-24 w-72 h-72 rounded-full opacity-10 bg-white">
        </div>

        <div
            class="absolute -bottom-32 left-20 w-96 h-96 rounded-full opacity-5 bg-white">
        </div>

        <div class="relative z-10">

            <div class="text-center">

                <div class="text-6xl mb-6">
                    ❤️
                </div>

                <h2
                    class="text-4xl font-bold text-white">

                    Terima Kasih,
                    {{ auth()->user()->name }}

                </h2>

                <p
                    class="mt-6 max-w-3xl mx-auto text-lg leading-8 text-white/90">

                    Setiap rupiah yang Anda donasikan telah menjadi
                    harapan bagi mereka yang membutuhkan.

                    Terima kasih telah menjadi bagian dari perjalanan
                    <b>Sikola Foundation</b> dalam menghadirkan
                    pendidikan, kepedulian, dan masa depan yang lebih baik.

                </p>

            </div>

            <div
                class="grid md:grid-cols-3 gap-6 mt-12">

                <div
                    class="rounded-3xl p-6 text-center"

                    style="
                        background:rgba(255,255,255,.12);
                        backdrop-filter:blur(8px);
                    ">

                    <div class="text-4xl mb-3">
                        🎓
                    </div>

                    <h4 class="text-xl font-bold text-white">

                        Pendidikan

                    </h4>

                    <p class="mt-2 text-white/80">

                        Membantu lebih banyak anak mendapatkan akses pendidikan.

                    </p>

                </div>

                <div
                    class="rounded-3xl p-6 text-center"

                    style="
                        background:rgba(255,255,255,.12);
                        backdrop-filter:blur(8px);
                    ">

                    <div class="text-4xl mb-3">
                        🤝
                    </div>

                    <h4 class="text-xl font-bold text-white">

                        Kepedulian

                    </h4>

                    <p class="mt-2 text-white/80">

                        Menumbuhkan semangat gotong royong dan berbagi.

                    </p>

                </div>

                <div
                    class="rounded-3xl p-6 text-center"

                    style="
                        background:rgba(255,255,255,.12);
                        backdrop-filter:blur(8px);
                    ">

                    <div class="text-4xl mb-3">
                        🌎
                    </div>

                    <h4 class="text-xl font-bold text-white">

                        Dampak Nyata

                    </h4>

                    <p class="mt-2 text-white/80">

                        Bersama kita menciptakan perubahan untuk Indonesia.

                    </p>

                </div>

            </div>

            <div
                class="flex flex-wrap justify-center gap-5 mt-12">

                <a

                    href="{{ route('donatur.donasi.index') }}"

                    class="px-8 py-4 rounded-2xl font-bold"

                    style="
                        background:white;
                        color:var(--color-merah);
                    ">

                    ❤️ Donasi Lagi

                </a>

                <a

                    href="{{ route('event.index') }}"

                    class="px-8 py-4 rounded-2xl border-2 border-white text-white font-bold">

                    🤝 Lihat Event

                </a>

            </div>

            <div
                class="mt-12 text-center">

                <div
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-full"

                    style="
                        background:rgba(255,255,255,.10);
                    ">

                    <span class="text-2xl">
                        ✨
                    </span>

                    <span class="text-white font-semibold">

                        "Kebaikan sekecil apa pun akan selalu membawa harapan."

                    </span>

                </div>

            </div>

        </div>

    </div>

</section>
@endsection
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx =
document.getElementById('donationChart');

const gradient =
ctx.getContext('2d').createLinearGradient(
0,
0,
0,
300
);

gradient.addColorStop(
0,
'rgba(204,34,34,.35)'
);

gradient.addColorStop(
1,
'rgba(204,34,34,0)'
);

new Chart(ctx,{

type:'line',

data:{

labels:@json($donationChart['labels']),

datasets:[{

label:'Donasi',

data:@json($donationChart['values']),

fill:true,

backgroundColor:gradient,

borderColor:'#CC2222',

borderWidth:4,

pointRadius:6,

pointHoverRadius:8,

pointBackgroundColor:'#D4A017',

tension:.45

}]

},

options:{

responsive:true,

plugins:{

legend:{
display:false
},

tooltip:{

callbacks:{

label:function(context){

return 'Rp ' +

new Intl.NumberFormat('id-ID')

.format(context.raw);

}

}

}

},

scales:{

y:{

ticks:{

callback:function(value){

return 'Rp ' +

new Intl.NumberFormat('id-ID')

.format(value);

}

}

}

}

}

});

</script>

@endpush
