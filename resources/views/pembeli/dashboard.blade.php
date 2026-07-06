@extends('layouts.pembeli',[
    'activePage' => 'dashboard'
])

@section('content')

<!-- HERO -->
<div
    class="relative overflow-hidden rounded-[30px] p-10 mb-10"

    style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
    ">

    <!-- Background Circle -->
    <div
        class="absolute -right-16 -top-16 w-72 h-72 rounded-full opacity-10"

        style="
            background:white;
        ">
    </div>

    <div
        class="absolute -bottom-24 right-24 w-52 h-52 rounded-full opacity-10"

        style="
            background:white;
        ">
    </div>

    <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center">

        <div class="text-white">

            <span
                class="uppercase tracking-[5px] text-xs font-semibold opacity-80">

                Dashboard Pembeli

            </span>

            <h1
                class="text-5xl font-bold mt-3">

                Halo,
                {{ auth()->user()->name }} 👋

            </h1>

            <p
                class="mt-5 text-lg opacity-90 max-w-xl leading-relaxed">

                Terima kasih telah menjadi bagian dari
                <b>Sikola Foundation.</b>

                Setiap pembelian dan donasi Anda ikut
                membantu pendidikan dan kegiatan sosial
                bagi masyarakat yang membutuhkan.

            </p>

            <div class="flex gap-4 mt-8">

                <a
                    href="{{ route('merchandise') }}"

                    class="px-7 py-3 rounded-2xl font-semibold"

                    style="
                        background:white;
                        color:var(--color-merah);
                    ">

                    🛍 Belanja Lagi

                </a>

                <a href="{{ route('pembeli.keranjang.index') }}"

                    class="px-7 py-3 rounded-2xl border border-white font-semibold text-white transition duration-300 hover:bg-white hover:text-[var(--color-merah)]">

                    🛒 Keranjang
                </a>

            </div>

        </div>

        <div class="mt-10 lg:mt-0">

            <img
                src="{{ auth()->user()->avatar
                        ? asset('storage/'.auth()->user()->avatar)
                        : 'https://i.pravatar.cc/220' }}"

                class="w-44 h-44 rounded-full border-[8px] object-cover shadow-2xl"

                style="
                    border-color:
                    rgba(255,255,255,.25);
                ">

        </div>

    </div>

</div>

<!-- STATISTIK -->
<div class="grid lg:grid-cols-4 md:grid-cols-2 gap-7">

    <!-- ORDER -->
    <div
        class="bg-white rounded-[28px] p-7 shadow-lg hover:-translate-y-2 transition duration-300">

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

            style="
                background:
                rgba(204,34,34,.08);
            ">

            📦

        </div>

        <p
            class="mt-6 text-sm"

            style="
                color:var(--color-coklat);
            ">

            Total Order

        </p>

        <div
            class="flex items-end justify-between mt-2">

            <h2
                class="text-4xl font-bold">

                {{ $totalOrder }}

            </h2>

            <span
                class="text-green-600 text-sm">

                ✔ Selesai

            </span>

        </div>

    </div>

    <!-- KERANJANG -->
    <div
        class="bg-white rounded-[28px] p-7 shadow-lg hover:-translate-y-2 transition duration-300">

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

            style="
                background:
                rgba(212,160,23,.10);
            ">

            🛒

        </div>

        <p
            class="mt-6 text-sm"

            style="
                color:var(--color-coklat);
            ">

            Keranjang

        </p>

        <div
            class="flex items-end justify-between mt-2">

            <h2
                class="text-4xl font-bold">

                {{ $totalKeranjang }}

            </h2>

            <span
                style="color:var(--color-kuning);">

                Produk

            </span>

        </div>

    </div>

    <!-- BELANJA -->
    <div
        class="bg-white rounded-[28px] p-7 shadow-lg hover:-translate-y-2 transition duration-300">

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

            style="
                background:
                rgba(34,197,94,.12);
            ">

            💰

        </div>

        <p
            class="mt-6 text-sm"

            style="
                color:var(--color-coklat);
            ">

            Total Belanja

        </p>

        <h2
            class="text-3xl font-bold mt-3">

            Rp {{ number_format($totalBelanja,0,',','.') }}

        </h2>

        <small
            class="text-slate-400">

            Akumulasi seluruh transaksi

        </small>

    </div>

    <!-- MEMBER -->
    <div
        class="bg-white rounded-[28px] p-7 shadow-lg hover:-translate-y-2 transition duration-300">

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

            style="
                background:
                rgba(139,94,42,.12);
            ">

            🏅

        </div>

        <p
            class="mt-6 text-sm"

            style="
                color:var(--color-coklat);
            ">

            Membership

        </p>

        <h2
            class="text-3xl font-bold mt-2">

            {{ auth()->user()->tier?->nama ?? 'Regular' }}

        </h2>

        <small
            style="
                color:var(--color-coklat);
            ">

            Member Sikola Foundation

        </small>

    </div>

</div>

@if($membership)

    <div class="mt-10">
        <div class="rounded-[30px] overflow-hidden" style="background:linear-gradient(135deg,#ffffff,#fff8ef);box-shadow:var(--shadow);">

            <div class="grid lg:grid-cols-2">

                <div class="p-10">

                    <span
                    class="uppercase tracking-[4px]
                    text-xs font-semibold"

                    style="color:var(--color-kuning);">

                    Membership

                    </span>

                    <h2
                    class="text-3xl font-bold mt-3"
                    style="color:var(--color-hitam);">

                    👑 {{ strtoupper($membership['tier']->nama) }}

                    </h2>

                    <p
                    class="mt-3"
                    style="color:var(--color-coklat);">

                    Total poin Anda

                    </p>

                    <div
                    class="text-5xl font-bold mt-3"
                    style="color:var(--color-merah);">

                    {{ number_format(auth()->user()->total_poin) }}

                        <span class="text-xl">

                        PTS

                        </span>

                    </div>

                </div>

                <div class="p-10">

                <div class="flex justify-between">

                <span>

                Progress Membership

                </span>

                <strong>

                {{ round($membership['progress']) }}%

                </strong>

                </div>

                <div
                class="h-4 rounded-full mt-4"

                style="
                background:#f3f4f6;
                ">

                <div

                class="h-4 rounded-full"

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

                @if($membership['nextTier'])

                <p
                class="mt-4"
                style="color:var(--color-coklat);">

                Tinggal

                <strong>

                {{ number_format($membership['remaining']) }}

                poin

                </strong>

                lagi menuju

                <strong>

                {{ $membership['nextTier']->nama }}

                </strong>

                </p>

                @else

                <p
                class="mt-4 text-green-600 font-semibold">

                🎉 Anda telah mencapai Tier Tertinggi

                </p>

                @endif

                </div>

            </div>

        </div>

    </div>

@endif
<div class="mt-8">

<h4 class="font-bold mb-4">

Benefit Membership

</h4>

<div class="grid grid-cols-2 gap-4">

<div class="flex items-center gap-2">

✅ Diskon Merchandise

</div>

<div class="flex items-center gap-2">

✅ Prioritas Event

</div>

<div class="flex items-center gap-2">

✅ Reward Point

</div>

<div class="flex items-center gap-2">

✅ Sertifikat Digital

</div>

</div>

</div>
<!-- PRODUK REKOMENDASI -->
<div class="mt-14">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-3xl font-bold"
                style="color:var(--color-hitam)">

                Merchandise Terbaru

            </h2>

            <p class="mt-2"
               style="color:var(--color-coklat)">

                Dukung kegiatan Sikola Foundation melalui pembelian merchandise.

            </p>

        </div>

        <a href="{{ route('merchandise') }}"
           class="font-semibold"
           style="color:var(--color-merah)">

            Lihat Semua →

        </a>

    </div>

    <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6">

        @forelse($products as $product)

        <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition duration-500">

            <!-- FOTO -->
            <div class="relative overflow-hidden">
                @php
                    $gambar = is_array($product->gambar)
                        ? ($product->gambar[0] ?? null)
                        : $product->gambar;
                @endphp
                <img
                    src="{{ $gambar ? asset('storage/'.$gambar) : asset('images/default-product.png') }}"
                    class="w-full h-60 object-cover group-hover:scale-110 transition duration-500">

                @if($product->stok <= 5)

                <span
                    class="absolute top-4 left-4
                    px-3 py-1 rounded-full
                    text-xs font-bold
                    bg-red-600 text-white">

                    Stok Terbatas

                </span>

                @endif

            </div>

            <!-- BODY -->

            <div class="p-5">

                <h3 class="font-bold text-lg">

                    {{ $product->nama }}

                </h3>

                <p class="text-sm text-slate-500 mt-2">

                    {{ Str::limit($product->deskripsi,70) }}

                </p>

                <div class="mt-5 flex justify-between items-center">

                    <div>

                        <div class="text-xs text-slate-400">

                            Harga

                        </div>

                        <div
                            class="font-bold text-xl"
                            style="color:var(--color-merah)">

                            Rp {{ number_format($product->harga,0,',','.') }}

                        </div>

                    </div>
                    <a
                        href="#"
                        class="px-4 py-2 rounded-xl text-white font-semibold"
                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                        Detail

                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-span-4">

            <div
                class="rounded-3xl bg-white p-10 text-center shadow">

                <div class="text-6xl mb-5">

                    🛍

                </div>

                <h3 class="text-2xl font-bold">

                    Belum ada merchandise

                </h3>

                <p class="text-slate-500 mt-2">

                    Produk akan segera tersedia.

                </p>

            </div>

        </div>

        @endforelse

    </div>

</div>
<!-- ===========================
     MEMBERSHIP + QUICK ACTION
============================ -->

<div class="grid lg:grid-cols-3 gap-8 mt-10">

    <!-- Membership -->
    <div
        class="lg:col-span-2 bg-white rounded-[30px] p-8 shadow-lg">

        <div class="flex justify-between items-center">

            <div>

                <h2
                    class="text-2xl font-bold"
                    style="color:var(--color-hitam);">

                    ⭐ Membership Saya

                </h2>

                <p
                    class="mt-2"
                    style="color:var(--color-coklat);">

                    Nikmati berbagai keuntungan sebagai member Sikola Foundation.

                </p>

            </div>

            <div>

                <span
                    class="px-4 py-2 rounded-full text-sm font-bold"

                    style="
                        background:rgba(212,160,23,.15);
                        color:var(--color-kuning);
                    ">

                    {{ auth()->user()->tier->nama ?? 'Regular Member' }}

                </span>

            </div>

        </div>

        @php

            $progress = auth()->user()->tier ? 100 : 35;

        @endphp

        <div class="mt-8">

            <div
                class="flex justify-between text-sm mb-2">

                <span>

                    Progress Membership

                </span>

                <span>

                    {{ $progress }}%

                </span>

            </div>

            <div
                class="w-full h-4 rounded-full overflow-hidden"

                style="
                    background:#ececec;
                ">

                <div

                    class="h-full rounded-full"

                    style="
                        width:{{ $progress }}%;
                        background:
                        linear-gradient(
                            90deg,
                            var(--color-kuning),
                            var(--color-merah)
                        );
                    ">

                </div>

            </div>

        </div>

        <div class="grid md:grid-cols-3 gap-5 mt-8">

            <div
                class="rounded-2xl p-5"

                style="
                    background:rgba(204,34,34,.05);
                ">

                <div class="text-3xl">

                    🎁

                </div>

                <h4
                    class="font-bold mt-3">

                    Merchandise

                </h4>

                <small
                    class="text-slate-500">

                    Diskon khusus member

                </small>

            </div>

            <div
                class="rounded-2xl p-5"

                style="
                    background:rgba(212,160,23,.08);
                ">

                <div class="text-3xl">

                    ❤️

                </div>

                <h4
                    class="font-bold mt-3">

                    Donasi

                </h4>

                <small
                    class="text-slate-500">

                    Riwayat donasi tersimpan

                </small>

            </div>

            <div
                class="rounded-2xl p-5"

                style="
                    background:rgba(139,94,42,.08);
                ">

                <div class="text-3xl">

                    🏆

                </div>

                <h4
                    class="font-bold mt-3">

                    Badge

                </h4>

                <small
                    class="text-slate-500">

                    Reward loyal member

                </small>

            </div>

        </div>

    </div>

    <!-- Quick Action -->
    <div
        class="bg-white rounded-[30px] p-8 shadow-lg">

        <h2
            class="text-2xl font-bold mb-6">

            ⚡ Quick Actions

        </h2>

        <div class="space-y-4">

            <a

                href="{{ route('merchandise') }}"

                class="flex items-center justify-between rounded-2xl p-5 transition hover:scale-[1.02]"

                style="
                    background:
                    rgba(212,160,23,.10);
                ">

                <div>

                    <div class="font-bold">

                        🛍 Belanja

                    </div>

                    <small
                        class="text-slate-500">

                        Lihat semua merchandise

                    </small>

                </div>

                ➜

            </a>

            <a

                href="{{ route('pembeli.relawan.daftar') }}"

                class="flex items-center justify-between rounded-2xl p-5 transition hover:scale-[1.02]"

                style="
                    background:
                    rgba(204,34,34,.08);
                ">

                <div>

                    <div class="font-bold">

                        🤝 Menjadi Relawan

                    </div>

                    <small
                        class="text-slate-500">

                        Daftar kegiatan sosial

                    </small>

                </div>

                ➜

            </a>
            <div x-data="{openDonatur:false}">
                <button
                    @click="openDonatur=true"
                    class="w-full flex items-center justify-between rounded-2xl p-5 transition hover:scale-[1.02]"
                    style="background:rgba(139,94,42,.08);">

                    <div class="text-left">

                        <div class="font-bold">
                            ❤️ Berdonasi
                        </div>

                        <small class="text-slate-500">
                            Bantu pendidikan Indonesia
                        </small>

                    </div>

                    ➜

                </button>
                <div x-show="openDonatur"
                     x-transition
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

                    <div
                        @click.away="openDonatur=false"
                        class="bg-white rounded-3xl p-8 w-full max-w-md">

                        <div class="text-center">

                            <div class="text-6xl mb-4">❤️</div>

                            <h2 class="text-2xl font-bold">
                                Menjadi Donatur
                            </h2>

                            <p class="mt-4 text-slate-500">
                                Setelah bergabung menjadi donatur,
                                akun Anda akan berubah menjadi
                                <b>Role Donatur</b>.
                            </p>

                        </div>

                        <div class="grid grid-cols-2 gap-3 mt-8">

                            <button
                                @click="openDonatur=false"
                                class="py-3 rounded-2xl border">

                                Batal

                            </button>

                            <form
                                action="{{ route('pembeli.daftar.donatur') }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <button
                                    class="w-full py-3 rounded-2xl text-white"
                                    style="
                                        background:
                                        linear-gradient(
                                            135deg,
                                            var(--color-kuning),
                                            var(--color-coklat)
                                        );
                                    ">

                                    Ya, Saya Yakin

                                </button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<!-- =========================
        RIWAYAT AKTIVITAS
========================== -->

<div
    class="bg-white rounded-[30px] shadow-lg p-8 mt-10">

    <div
        class="flex justify-between items-center mb-8">

        <div>

            <h2
                class="text-2xl font-bold">

                📋 Riwayat Aktivitas

            </h2>

            <p
                class="text-slate-500 mt-2">

                Aktivitas terbaru akun Anda

            </p>

        </div>

        <a

            href="#"

            class="font-semibold"

            style="
                color:var(--color-merah);
            ">

            Lihat Semua →

        </a>

    </div>

    @forelse($activities as $activity)

    <div
        class="flex items-center justify-between py-5 border-b last:border-none">

        <div
            class="flex items-center gap-5">

            <div

                class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl"

                style="
                    background:
                    rgba(204,34,34,.06);
                ">

                {{ $activity['icon'] }}

            </div>

            <div>

                <div class="font-semibold">

                    {{ $activity['title'] }}

                </div>

                @if(!empty($activity['subtitle']))
                <div class="text-sm text-gray-500">
                    {{ $activity['subtitle'] }}
                </div>
                @endif

                <small
                    class="text-slate-400">

                    {{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}

                </small>

            </div>

        </div>

        <div>

            @if($activity['color']=='green')

                <span
                    class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm">

                    ✔ {{ $activity['status'] }}

                </span>

            @elseif($activity['color']=='blue')

                <span
                    class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm">

                    🚚 {{ $activity['status'] }}

                </span>

            @else

                <span
                    class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm">

                    ⏳ {{ $activity['status'] }}

                </span>

            @endif

        </div>

    </div>

    @empty

    <div class="text-center py-12 text-slate-400">

        Belum ada aktivitas.

    </div>

    @endforelse

</div>

<!-- AJAKAN BERGABUNG -->
<!-- QUICK ACTION -->
<div class="mt-12">
    <div class="flex items-center justify-between mb-6">
            <div>

                <h2
                    class="text-3xl font-bold"
                    style="color:var(--color-hitam);">

                    Quick Actions

                </h2>

                <p
                    class="mt-1"
                    style="color:var(--color-coklat);">

                    Semua fitur favorit dalam satu tempat.

                </p>

            </div>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('pembeli.relawan.daftar') }}" class="group">
                <div class="rounded-3xl bg-white p-6 text-center transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl" style="background:rgba(204,34,34,.08);">
                        🤝
                    </div>
                    <h4 class="font-bold mt-5">Relawan</h4>
                    <p class="text-sm mt-2 text-slate-500">Daftar menjadi relawan</p>
                </div>
            </a>
            <div x-data="{openDonatur:false}">
                <button @click="openDonatur=true" class="w-full">
                    <div class="rounded-3xl bg-white p-6 text-center transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl" style="background:rgba(212,160,23,.15);">
                            ❤️
                        </div>
                        <h4 class="font-bold mt-5">Donasi</h4>
                        <p class="text-sm mt-2 text-slate-500">Upgrade menjadi Donatur</p>
                    </div>
                </button>
                <div x-show="openDonatur"
                     x-transition
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

                    <div
                        @click.away="openDonatur=false"
                        class="bg-white rounded-3xl p-8 w-full max-w-md">

                        <div class="text-center">

                            <div class="text-6xl mb-4">❤️</div>

                            <h2 class="text-2xl font-bold">
                                Menjadi Donatur
                            </h2>

                            <p class="mt-4 text-slate-500">
                                Setelah bergabung menjadi donatur,
                                akun Anda akan berubah menjadi
                                <b>Role Donatur</b>.
                            </p>

                        </div>

                        <div class="grid grid-cols-2 gap-3 mt-8">

                            <button
                                @click="openDonatur=false"
                                class="py-3 rounded-2xl border">

                                Batal

                            </button>

                            <form
                                action="{{ route('pembeli.daftar.donatur') }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <button
                                    class="w-full py-3 rounded-2xl text-white"
                                    style="
                                        background:
                                        linear-gradient(
                                            135deg,
                                            var(--color-kuning),
                                            var(--color-coklat)
                                        );
                                    ">

                                    Ya, Saya Yakin

                                </button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
            <a href="{{ route('pembeli.orders.index') }}">
                <div class="rounded-3xl bg-white p-6 text-center transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl" style="background:rgba(139,94,42,.12);">
                        📦
                    </div>
                    <h4 class="font-bold mt-5">Pesanan</h4>
                    <p class="text-sm mt-2 text-slate-500">Lihat semua order</p>
                </div>
            </a>
            <a href="{{ route('pembeli.keranjang.index') }}">
                <div class="rounded-3xl bg-white p-6 text-center transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl"
                         style="background:rgba(212,160,23,.12);">
                        🛒
                    </div>

                    <h4 class="font-bold mt-5">Keranjang</h4>

                    <p class="text-sm mt-2 text-slate-500">
                        Lihat produk di keranjang
                    </p>
                </div>
            </a>
            <a href="#">
                <div class="rounded-3xl bg-white p-6 text-center transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl" style="background:rgba(212,160,23,.12);">
                        💳
                    </div>
                    <h4 class="font-bold mt-5">Membership</h4>
                    <p class="text-sm mt-2 text-slate-500">Level akun Anda</p>
                </div>
            </a>
            <a href="#">
                <div class="rounded-3xl bg-white p-6 text-center transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl">
                        ⭐
                    </div>
                    <h4 class="font-bold mt-5">Reward</h4>
                    <p class="text-sm mt-2 text-slate-500">Lihat poin Anda</p>
                </div>
            </a>
            <a href="{{ route('pembeli.profile') }}">
                <div class="rounded-3xl bg-white p-6 text-center transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl">
                        👤
                    </div>
                    <h4 class="font-bold mt-5">Profil</h4>
                    <p class="text-sm mt-2 text-slate-500">Kelola akun</p>
                </div>
            </a>
            <a href="{{ route('kontak') }}">
                <div class="rounded-3xl bg-white p-6 text-center transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl">
                        📞
                    </div>
                    <h4 class="font-bold mt-5">Bantuan</h4>
                    <p class="text-sm mt-2 text-slate-500">Hubungi admin</p>
                </div>
            </a>
    </div>
</div>
<!-- Timeline -->
<div class="bg-white rounded-3xl shadow-sm p-6">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-2xl font-bold">
                📋 Aktivitas Terbaru
            </h2>

            <p class="text-slate-500">
                Semua aktivitas akun Anda
            </p>

        </div>

    </div>

    <div class="space-y-5">

        @foreach($activities as $activity)

        <div
            class="group
                   flex
                   items-center
                   gap-5
                   rounded-2xl
                   p-5
                   transition
                   duration-300
                   hover:bg-slate-50
                   hover:shadow">

            <!-- Icon -->
            <div
                class="w-14
                       h-14
                       rounded-2xl
                       flex
                       items-center
                       justify-center
                       text-2xl"

                style="
                    background:
                    rgba(204,34,34,.08);
                ">

                {{ $activity['icon'] }}

            </div>

            <!-- Content -->
            <div class="flex-1">

                <h3 class="font-bold text-lg">

                    {{ $activity['title'] }}

                </h3>

                @isset($activity['subtitle'])

                    <p class="text-slate-500 text-sm">

                        {{ $activity['subtitle'] }}

                    </p>

                @endisset

                <small class="text-slate-400">

                    {{ $activity['date']->diffForHumans() }}

                </small>

            </div>

            <!-- Badge -->
            <div>

                @php

                    $badge = match($activity['color']){

                        'green' => 'bg-green-100 text-green-700',

                        'blue' => 'bg-blue-100 text-blue-700',

                        'yellow' => 'bg-yellow-100 text-yellow-700',

                        'red' => 'bg-red-100 text-red-700',

                        default => 'bg-gray-100 text-gray-700'

                    };

                @endphp

                <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $badge }}">

                    {{ $activity['status'] }}

                </span>

            </div>

        </div>

        @endforeach

    </div>

</div>
<!-- ===================================== -->
<!-- BAGIAN 8B - FOOTER -->
<!-- ===================================== -->

<div class="mt-12 rounded-3xl overflow-hidden"
     style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
     ">

    <div class="p-10 text-center text-white">

        <div class="text-6xl mb-5">

            🌱

        </div>

        <h2 class="text-3xl font-bold mb-4">

            Terima kasih telah menjadi bagian dari
            Sikola Foundation

        </h2>

        <p class="opacity-90 max-w-2xl mx-auto">

            Setiap pembelian merchandise dan setiap partisipasi Anda
            membantu keberlangsungan program pendidikan dan sosial
            bagi masyarakat.

        </p>

        <div class="mt-8 flex justify-center gap-4">

            <a href="{{ route('merchandise') }}"
               class="px-8 py-3 rounded-2xl font-semibold bg-white text-black">

                Belanja Sekarang

            </a>

            <a href="{{ route('pembeli.keranjang.index') }}"
               class="px-8 py-3 rounded-2xl border border-white text-white">

                Cek Keranjang

            </a>

        </div>

    </div>

</div>
@endsection