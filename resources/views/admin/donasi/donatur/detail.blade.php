@extends('layouts.admin',[
    'activePage' => 'donasi'
])

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold"
                style="color:var(--color-hitam)">

                Detail Langganan

            </h1>

            <p class="text-slate-500 mt-2">

                Informasi langganan donasi bulanan Anda

            </p>

        </div>

        <a href="{{ url()->previous() }}"
            class="px-6 py-3 rounded-2xl border">

            ← Kembali

        </a>

    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-[32px] shadow-lg border border-slate-100 p-8">

        <div class="grid lg:grid-cols-[320px_1fr] gap-10">

            {{-- FOTO --}}
            <div>

                <img
                    src="{{ $donasi->kategori?->gambar
                        ? asset('storage/'.$donasi->kategori->gambar)
                        : asset('images/default-donasi.jpg') }}"
                    class="w-full h-[300px] rounded-3xl object-cover">

            </div>

            {{-- INFO --}}
            <div>

                <div class="flex flex-wrap gap-3 mb-6">

                    <span class="px-4 py-2 rounded-full bg-red-50 text-red-600 font-bold">

                        DON-{{ str_pad($donasi->id,6,'0',STR_PAD_LEFT) }}

                    </span>

                    @if($donasi->langganan->is_aktif)

                        <span class="px-4 py-2 rounded-full bg-green-100 text-green-700">

                            🟢 Langganan Aktif

                        </span>

                    @else

                        <span class="px-4 py-2 rounded-full bg-red-100 text-red-700">

                            🔴 Langganan Berhenti

                        </span>

                    @endif

                </div>

                <h2 class="text-4xl font-bold mb-2">

                    {{ $donasi->kategori->nama }}

                </h2>

                <p class="text-slate-500 mb-8">

                    {{ $donasi->kategori->deskripsi }}

                </p>

                @php

                    $target = $donasi->langganan->jumlah_bulanan;

                    $terkumpul = $donasi->langganan->total_terkumpul;

                    $persen = $target > 0
                        ? min(($terkumpul/$target)*100,100)
                        : 0;

                @endphp

                {{-- STATISTIK --}}
                <div class="grid md:grid-cols-2 gap-5">

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <small class="text-slate-400">

                            Target Bulanan

                        </small>

                        <h3 class="font-bold text-3xl mt-2">

                            Rp {{ number_format($target,0,',','.') }}

                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <small class="text-slate-400">

                            Total Terkumpul

                        </small>

                        <h3 class="font-bold text-3xl mt-2 text-green-600">

                            Rp {{ number_format($terkumpul,0,',','.') }}

                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <small class="text-slate-400">

                            Poin

                        </small>

                        <h3 class="font-bold text-3xl mt-2 text-yellow-500">

                            {{ $donasi->langganan->total_poin_aktif }} Poin

                        </h3>

                    </div>

                    <div class="bg-slate-50 rounded-2xl p-5">

                        <small class="text-slate-400">

                            Periode Aktif

                        </small>

                        <h3 class="font-bold mt-2">

                            {{ \Carbon\Carbon::parse($donasi->langganan->tanggal_mulai)->translatedFormat('d F Y') }}

                            -

                            {{ \Carbon\Carbon::parse($donasi->langganan->tanggal_akhir)->translatedFormat('d F Y') }}

                        </h3>

                    </div>

                </div>

                {{-- PROGRESS --}}
                <div class="mt-8">

                    <div class="flex justify-between mb-2">

                        <span class="font-semibold">

                            Progress Target

                        </span>

                        <span>

                            {{ number_format($persen,1) }}%

                        </span>

                    </div>

                    <div class="w-full bg-slate-200 rounded-full h-4">

                        <div
                            class="bg-green-500 h-4 rounded-full"
                            style="width:{{ $persen }}%">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- RIWAYAT PEMBAYARAN --}}
    <div class="bg-white rounded-[32px] shadow-lg border border-slate-100 mt-8 p-8">

        <h3 class="text-2xl font-bold mb-6">

            Riwayat Pembayaran

        </h3>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b">

                        <th class="text-left py-4">Periode</th>

                        <th class="text-left">Tanggal</th>

                        <th class="text-left">Nominal</th>

                        <th class="text-center">Poin</th>

                        <th class="text-center">Bonus</th>

                        <th class="text-center">Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($donasi->langganan->riwayatPembayaran()->latest()->get() as $item)

                    <tr class="border-b">

                        <td class="py-4">

                            {{ \Carbon\Carbon::parse($item->periode)->translatedFormat('F Y') }}

                        </td>

                        <td>

                            {{ $item->created_at->format('d M Y') }}

                        </td>

                        <td>

                            Rp {{ number_format($item->jumlah,0,',','.') }}

                        </td>

                        <td class="text-center">

                            {{ $item->poin }}

                        </td>

                        <td class="text-center">

                            {{ $item->bonus }}

                        </td>

                        <td class="text-center">

                            @if($item->status=='dikonfirmasi')

                                <span class="text-green-600 font-semibold">

                                    ✔ Berhasil

                                </span>

                            @elseif($item->status=='menunggu')

                                <span class="text-yellow-600">

                                    Menunggu

                                </span>

                            @else

                                <span class="text-red-600">

                                    Ditolak

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-10 text-slate-400">

                            Belum ada riwayat pembayaran.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection