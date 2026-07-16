@extends('layouts.pembeli')

@section('title','Detail Reward')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="rounded-3xl bg-gradient-to-r from-red-600 to-yellow-500 p-8 text-white">

        <div class="flex items-center justify-between">

            <div>

                <p class="uppercase tracking-[5px] text-sm">

                    Reward Redemption

                </p>

                <h1 class="text-4xl font-black mt-3">

                    Detail Penukaran Reward

                </h1>

                <p class="mt-3 opacity-90">

                    Kode Transaksi :

                    <b>{{ $redeem->kode }}</b>

                </p>

            </div>

            <div>

                @switch($redeem->status)

                    @case('menunggu')

                        <span class="px-5 py-3 rounded-full bg-yellow-400 text-yellow-900 font-bold">

                            Menunggu

                        </span>

                    @break

                    @case('diproses')

                        <span class="px-5 py-3 rounded-full bg-blue-500 text-white font-bold">

                            Diproses

                        </span>

                    @break

                    @case('selesai')

                        <span class="px-5 py-3 rounded-full bg-green-500 text-white font-bold">

                            Selesai

                        </span>

                    @break

                    @case('dibatalkan')

                        <span class="px-5 py-3 rounded-full bg-red-500 text-white font-bold">

                            Dibatalkan

                        </span>

                    @break

                @endswitch

            </div>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">

            <div class="card-admin p-8">

                <h2 class="text-2xl font-bold mb-6">

                    Informasi Reward

                </h2>

                <div class="flex gap-6">

                    @if($redeem->reward->gambar)

                        <img
                            src="{{ asset('storage/'.$redeem->reward->gambar) }}"
                            class="w-48 h-48 rounded-2xl object-cover">

                    @else

                        <div class="w-48 h-48 rounded-2xl bg-slate-100 flex items-center justify-center text-7xl">

                            🎁

                        </div>

                    @endif

                    <div class="flex-1">

                        <h3 class="text-3xl font-black">

                            {{ $redeem->reward->nama }}

                        </h3>

                        <p class="text-slate-500 mt-2">

                            {{ $redeem->reward->deskripsi }}

                        </p>

                        <div class="grid grid-cols-2 gap-5 mt-8">

                            <div>

                                <p class="text-slate-500 text-sm">

                                    Kategori

                                </p>

                                <h4 class="font-bold">

                                    {{ $redeem->reward->kategori }}

                                </h4>

                            </div>

                            <div>

                                <p class="text-slate-500 text-sm">

                                    Qty

                                </p>

                                <h4 class="font-bold">

                                    {{ $redeem->qty }}

                                </h4>

                            </div>

                            <div>

                                <p class="text-slate-500 text-sm">

                                    Poin / Item

                                </p>

                                <h4 class="font-bold">

                                    {{ number_format($redeem->poin) }}

                                </h4>

                            </div>

                            <div>

                                <p class="text-slate-500 text-sm">

                                    Total Poin

                                </p>

                                <h4 class="text-red-600 text-xl font-black">

                                    {{ number_format($redeem->total_poin) }}

                                </h4>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
                        {{-- Timeline Status --}}
            <div class="card-admin p-8 mt-8">

                <h2 class="text-2xl font-bold mb-8">

                    Timeline Penukaran

                </h2>

                <div class="space-y-8">

                    {{-- Menunggu --}}
                    <div class="flex gap-5">

                        <div class="w-12 h-12 rounded-full bg-yellow-500 text-white flex items-center justify-center text-xl">

                            ✓

                        </div>

                        <div>

                            <h4 class="font-bold text-lg">

                                Permintaan Dibuat

                            </h4>

                            <p class="text-slate-500">

                                Reward berhasil ditukarkan menggunakan poin.

                            </p>

                            <small class="text-slate-400">

                                {{ $redeem->created_at->format('d M Y H:i') }}

                            </small>

                        </div>

                    </div>

                    {{-- Diproses --}}
                    <div class="flex gap-5">

                        <div class="w-12 h-12 rounded-full
                            {{ in_array($redeem->status,['diproses','selesai']) ? 'bg-blue-600 text-white' : 'bg-slate-200 text-slate-500' }}
                            flex items-center justify-center text-xl">

                            {{ in_array($redeem->status,['diproses','selesai']) ? '✓' : '2' }}

                        </div>

                        <div>

                            <h4 class="font-bold text-lg">

                                Sedang Diproses

                            </h4>

                            <p class="text-slate-500">

                                Admin sedang memproses penukaran reward Anda.

                            </p>

                            @if($redeem->diproses_at)

                                <small class="text-slate-400">

                                    {{ $redeem->diproses_at->format('d M Y H:i') }}

                                </small>

                            @endif

                        </div>

                    </div>

                    {{-- Selesai --}}
                    <div class="flex gap-5">

                        <div class="w-12 h-12 rounded-full
                            {{ $redeem->status=='selesai' ? 'bg-green-600 text-white' : 'bg-slate-200 text-slate-500' }}
                            flex items-center justify-center text-xl">

                            {{ $redeem->status=='selesai' ? '✓' : '3' }}

                        </div>

                        <div>

                            <h4 class="font-bold text-lg">

                                Reward Diterima

                            </h4>

                            <p class="text-slate-500">

                                Reward telah berhasil diberikan.

                            </p>

                            @if($redeem->selesai_at)

                                <small class="text-slate-400">

                                    {{ $redeem->selesai_at->format('d M Y H:i') }}

                                </small>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">

            {{-- Ringkasan --}}
            <div class="card-admin p-6">

                <h3 class="text-xl font-bold mb-5">

                    Ringkasan

                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Reward

                        </span>

                        <span class="font-semibold text-right">

                            {{ $redeem->reward->nama }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Quantity

                        </span>

                        <span class="font-semibold">

                            {{ $redeem->qty }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Total Poin

                        </span>

                        <span class="font-black text-red-600">

                            {{ number_format($redeem->total_poin) }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Status

                        </span>

                        <span class="font-semibold">

                            {{ ucfirst($redeem->status) }}

                        </span>

                    </div>

                </div>

            </div>

            {{-- Catatan User --}}
            @if($redeem->catatan)

                <div class="card-admin p-6">

                    <h3 class="font-bold mb-3">

                        Catatan Anda

                    </h3>

                    <p class="text-slate-600 whitespace-pre-line">

                        {{ $redeem->catatan }}

                    </p>

                </div>

            @endif
                        {{-- Bukti Penyerahan --}}
            @if($redeem->bukti_penyerahan)

                <div class="card-admin p-6">

                    <h3 class="font-bold mb-4">

                        Bukti Penyerahan

                    </h3>

                    <a
                        href="{{ asset('storage/'.$redeem->bukti_penyerahan) }}"
                        target="_blank">

                        <img
                            src="{{ asset('storage/'.$redeem->bukti_penyerahan) }}"
                            class="rounded-2xl border hover:opacity-90 transition">

                    </a>

                    <p class="text-xs text-slate-500 mt-3">

                        Klik gambar untuk memperbesar.

                    </p>

                </div>

            @endif

            {{-- Informasi Pengiriman --}}
            @if($redeem->ekspedisi || $redeem->nomor_resi)

                <div class="card-admin p-6">

                    <h3 class="font-bold mb-5">

                        Informasi Pengiriman

                    </h3>

                    @if($redeem->ekspedisi)

                        <div class="flex justify-between mb-4">

                            <span class="text-slate-500">

                                Ekspedisi

                            </span>

                            <span class="font-semibold">

                                {{ $redeem->ekspedisi }}

                            </span>

                        </div>

                    @endif

                    @if($redeem->nomor_resi)

                        <div class="flex justify-between">

                            <span class="text-slate-500">

                                Nomor Resi

                            </span>

                            <span class="font-bold break-all">

                                {{ $redeem->nomor_resi }}

                            </span>

                        </div>

                    @endif

                </div>

            @endif

            {{-- Diproses Oleh --}}
            @if($redeem->processor)

                <div class="card-admin p-6">

                    <h3 class="font-bold mb-4">

                        Diproses Oleh

                    </h3>

                    <div class="space-y-2">

                        <div class="flex justify-between">

                            <span class="text-slate-500">

                                Admin

                            </span>

                            <span class="font-semibold">

                                {{ $redeem->processor->name }}

                            </span>

                        </div>

                        @if($redeem->diproses_at)

                            <div class="flex justify-between">

                                <span class="text-slate-500">

                                    Diproses Pada

                                </span>

                                <span>

                                    {{ $redeem->diproses_at->format('d M Y H:i') }}

                                </span>

                            </div>

                        @endif

                    </div>

                </div>

            @endif

            {{-- Catatan Admin --}}
            @if($redeem->catatan_admin)

                <div class="card-admin p-6">

                    <h3 class="font-bold mb-4">

                        Catatan Admin

                    </h3>

                    <p class="text-slate-600 whitespace-pre-line">

                        {{ $redeem->catatan_admin }}

                    </p>

                </div>

            @endif

            {{-- Tombol --}}
            <div class="card-admin p-6">

                <a
                    href="{{ route(auth()->user()->role.'.reward.riwayat') }}"
                    class="w-full block text-center py-3 rounded-xl bg-slate-900 text-white font-semibold hover:bg-black transition">

                    ← Kembali ke Riwayat Reward

                </a>

            </div>

        </div>

    </div>

</div>

@endsection
