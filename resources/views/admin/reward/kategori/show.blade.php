@extends('layouts.admin', [
    'activePage' => 'reward'
])

@section('title','Detail Reward')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-4xl font-black">
                🎁 Detail Reward
            </h1>

            <p class="text-slate-500 mt-2">
                Informasi lengkap reward.
            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('admin.rewards.edit',$reward) }}"
                class="px-6 py-3 rounded-xl bg-yellow-500 text-white font-semibold">

                ✏ Edit

            </a>

            <a href="{{ route('admin.rewards.index') }}"
                class="px-6 py-3 rounded-xl bg-slate-200 font-semibold">

                ← Kembali

            </a>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- FOTO --}}
        <div class="card-admin p-8">

            <h3 class="text-xl font-bold mb-5">

                Gambar Reward

            </h3>

            @if($reward->gambar)

                <img
                    src="{{ asset('storage/'.$reward->gambar) }}"
                    class="w-full rounded-3xl shadow-lg object-cover">

            @else

                <div
                    class="w-full h-80 rounded-3xl bg-slate-100 flex items-center justify-center text-7xl">

                    🎁

                </div>

            @endif

        </div>

        {{-- DETAIL --}}
        <div class="lg:col-span-2 card-admin p-8">

            <h3 class="text-2xl font-bold mb-8">

                Informasi Reward

            </h3>

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="text-slate-500 text-sm">
                        Nama Reward
                    </label>

                    <div class="font-bold text-xl mt-1">
                        {{ $reward->nama }}
                    </div>

                </div>

                <div>

                    <label class="text-slate-500 text-sm">
                        Slug
                    </label>

                    <div class="font-semibold mt-1">
                        {{ $reward->slug }}
                    </div>

                </div>

                <div>

                    <label class="text-slate-500 text-sm">
                        Kategori
                    </label>

                    <div class="mt-1">

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">

                            {{ $reward->kategori }}

                        </span>

                    </div>

                </div>

                <div>

                    <label class="text-slate-500 text-sm">
                        Poin Dibutuhkan
                    </label>

                    <div class="font-bold text-green-600 text-xl mt-1">

                        {{ number_format($reward->poin) }} Poin

                    </div>

                </div>

                <div>

                    <label class="text-slate-500 text-sm">
                        Stok
                    </label>

                    <div class="font-bold mt-1">

                        {{ number_format($reward->stok) }}

                    </div>

                </div>

                <div>

                    <label class="text-slate-500 text-sm">
                        Urutan
                    </label>

                    <div class="font-bold mt-1">

                        {{ $reward->urutan }}

                    </div>

                </div>

                <div>

                    <label class="text-slate-500 text-sm">
                        Status
                    </label>

                    <div class="mt-1">

                        @if($reward->is_aktif)

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">

                                Aktif

                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">

                                Nonaktif

                            </span>

                        @endif

                    </div>

                </div>

                <div>

                    <label class="text-slate-500 text-sm">
                        Dibuat Oleh
                    </label>

                    <div class="mt-1">

                        {{ optional($reward->creator)->name ?? '-' }}

                    </div>

                </div>

                <div class="md:col-span-2">

                    <label class="text-slate-500 text-sm">

                        Deskripsi

                    </label>

                    <div class="mt-2 leading-8 text-slate-700">

                        {!! nl2br(e($reward->deskripsi)) !!}

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="card-admin p-8">

        <h3 class="text-xl font-bold mb-6">

            Statistik Penukaran Reward

        </h3>

        <div class="grid md:grid-cols-4 gap-6">

            <div>

                <div class="text-slate-500">

                    Total Ditukar

                </div>

                <div class="text-4xl font-black text-blue-600 mt-2">

                    {{ $totalRedeem }}

                </div>

            </div>

            <div>

                <div class="text-slate-500">

                    Menunggu

                </div>

                <div class="text-4xl font-black text-yellow-500 mt-2">

                    {{ $pendingRedeem }}

                </div>

            </div>

            <div>

                <div class="text-slate-500">

                    Diproses

                </div>

                <div class="text-4xl font-black text-indigo-600 mt-2">

                    {{ $diprosesRedeem }}

                </div>

            </div>

            <div>

                <div class="text-slate-500">

                    Selesai

                </div>

                <div class="text-4xl font-black text-green-600 mt-2">

                    {{ $selesaiRedeem }}

                </div>

            </div>

        </div>

    </div>

    {{-- Riwayat Penukaran --}}
    <div class="card-admin p-8">

        <div class="flex justify-between items-center mb-6">

            <h3 class="text-xl font-bold">

                Riwayat Penukaran Reward

            </h3>

            <span class="text-slate-500">

                {{ $reward->redemptions->count() }} Penukaran

            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b">

                        <th class="text-left py-3">User</th>

                        <th class="text-left py-3">Poin</th>

                        <th class="text-left py-3">Status</th>

                        <th class="text-left py-3">Diproses Oleh</th>

                        <th class="text-left py-3">Tanggal</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($reward->redemptions as $redeem)

                        <tr class="border-b hover:bg-slate-50">

                            <td>

                                {{ $redeem->user->name }}

                            </td>

                            <td>

                                {{ number_format($redeem->total_poin) }}

                            </td>

                            <td>

                                @switch($redeem->status)

                                    @case('menunggu')

                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">

                                            Menunggu

                                        </span>

                                    @break

                                    @case('diproses')

                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">

                                            Diproses

                                        </span>

                                    @break

                                    @case('selesai')

                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">

                                            Selesai

                                        </span>

                                    @break

                                @endswitch

                            </td>

                            <td>

                                {{ optional($redeem->processor)->name ?? '-' }}

                            </td>

                            <td>

                                {{ $redeem->created_at->format('d M Y H:i') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center py-10 text-slate-400">

                                Belum ada penukaran reward.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection