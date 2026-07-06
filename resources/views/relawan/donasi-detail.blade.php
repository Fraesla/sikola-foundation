@extends('layouts.relawan',[
'activePage' => 'donasi'
])

@section('content')

<div class="max-w-7xl mx-auto">


{{-- HEADER --}}
<div class="mb-8 flex justify-between items-center">

    <div>

        <h1 class="text-4xl font-bold"
            style="color:var(--color-hitam)">

            Detail Donasi

        </h1>

        <p class="text-slate-500 mt-2">

            Informasi lengkap donasi Anda

        </p>

    </div>

    <a href="{{ url()->previous() }}"
       class="px-6 py-3 rounded-2xl border">

        ← Kembali

    </a>

</div>


{{-- CARD UTAMA --}}
<div class="bg-white rounded-[32px]
            p-8 shadow-lg border
            border-slate-100 mb-8">

    <div class="grid lg:grid-cols-[1fr_1.5fr] gap-10">

        {{-- GAMBAR --}}
        <div>

            <img
                src="{{ $donasi->kategori?->gambar
                    ? asset('storage/'.$donasi->kategori->gambar)
                    : asset('images/default-donasi.jpg') }}"

                class="w-full h-[350px]
                       rounded-[30px]
                       object-cover shadow">

        </div>


        {{-- INFORMASI --}}
        <div>

            <div class="flex flex-wrap gap-3 mb-5">

                <span class="px-4 py-2 rounded-full
                             bg-red-50 text-red-600
                             font-bold">

                    DON-{{ str_pad($donasi->id,6,'0',STR_PAD_LEFT) }}

                </span>

                @if($donasi->status=='menunggu')

                    @if(!$donasi->bukti_transfer)

                        <span class="px-4 py-2 rounded-full
                                     bg-yellow-100 text-yellow-700">

                            ⏳ Menunggu Pembayaran

                        </span>

                    @else

                        <span class="px-4 py-2 rounded-full
                                     bg-blue-100 text-blue-700">

                            🔍 Menunggu Verifikasi

                        </span>

                    @endif

                @elseif($donasi->status=='dikonfirmasi')

                    <span class="px-4 py-2 rounded-full
                                 bg-green-100 text-green-700">

                        ✅ Berhasil

                    </span>

                @else

                    <span class="px-4 py-2 rounded-full
                                 bg-red-100 text-red-700">

                        ❌ Ditolak

                    </span>

                @endif

            </div>

            <h2 class="text-4xl font-bold mb-3">

                {{ $donasi->kategori->nama ?? '-' }}

            </h2>

            <p class="text-slate-500 mb-8">

                {{ $donasi->kategori->deskripsi ?? '-' }}

            </p>

            <div class="grid md:grid-cols-2 gap-5">

                <div class="bg-slate-50 rounded-2xl p-5">

                    <small class="text-slate-400">
                        Nominal Donasi
                    </small>

                    <h4 class="font-bold text-2xl mt-2">

                        Rp {{ number_format($donasi->jumlah,0,',','.') }}

                    </h4>

                </div>

                <div class="bg-slate-50 rounded-2xl p-5">

                    <small class="text-slate-400">
                        Jenis Donasi
                    </small>

                    <h4 class="font-bold text-2xl mt-2">

                        {{ ucfirst($donasi->tipe) }}

                    </h4>

                </div>

                <div class="bg-slate-50 rounded-2xl p-5">

                    <small class="text-slate-400">
                        Poin
                    </small>

                    <h4 class="font-bold text-2xl mt-2">

                        {{ $donasi->poin_diberikan }}

                    </h4>

                </div>

                <div class="bg-slate-50 rounded-2xl p-5">

                    <small class="text-slate-400">
                        Tanggal Donasi
                    </small>

                    <h4 class="font-bold text-lg mt-2">

                        {{ $donasi->created_at->format('d F Y H:i') }}

                    </h4>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- TIMELINE --}}
<div class="bg-white rounded-[32px]
            p-8 shadow-lg border
            border-slate-100 mb-8">

    <h3 class="text-2xl font-bold mb-8">

        Timeline Donasi

    </h3>

    <div class="space-y-6">

        <div class="flex gap-4">

            <div class="w-10 h-10 rounded-full
                        bg-green-100 text-green-600
                        flex items-center justify-center">

                ✓

            </div>

            <div>

                <h4 class="font-bold">

                    Donasi Dibuat

                </h4>

                <p class="text-slate-500">

                    {{ $donasi->created_at->format('d M Y H:i') }}

                </p>

            </div>

        </div>

        @if($donasi->bukti_transfer)

        <div class="flex gap-4">

            <div class="w-10 h-10 rounded-full
                        bg-blue-100 text-blue-600
                        flex items-center justify-center">

                ↑

            </div>

            <div>

                <h4 class="font-bold">

                    Bukti Transfer Diupload

                </h4>

                <p class="text-slate-500">

                    Menunggu verifikasi admin

                </p>

            </div>

        </div>

        @endif

        @if($donasi->status=='dikonfirmasi')

        <div class="flex gap-4">

            <div class="w-10 h-10 rounded-full
                        bg-green-100 text-green-600
                        flex items-center justify-center">

                ✔

            </div>

            <div>

                <h4 class="font-bold">

                    Donasi Dikonfirmasi

                </h4>

                <p class="text-slate-500">

                    {{ $donasi->dikonfirmasi_at }}

                </p>

            </div>

        </div>

        @endif

        @if($donasi->status=='ditolak')

        <div class="flex gap-4">

            <div class="w-10 h-10 rounded-full
                        bg-red-100 text-red-600
                        flex items-center justify-center">

                ✖

            </div>

            <div>

                <h4 class="font-bold">

                    Donasi Ditolak

                </h4>

                <p class="text-red-600">

                    {{ $donasi->alasan_tolak }}

                </p>

            </div>

        </div>

        @endif

    </div>

</div>


{{-- BUKTI TRANSFER --}}
@if($donasi->bukti_transfer)

<div class="bg-white rounded-[32px]
            p-8 shadow-lg border
            border-slate-100 mb-8">

    <h3 class="text-2xl font-bold mb-6">

        Bukti Transfer

    </h3>

    <img
        src="{{ asset('storage/'.$donasi->bukti_transfer) }}"
        class="rounded-3xl w-full max-w-xl">

</div>

@endif


{{-- PESAN --}}
@if($donasi->pesan)

<div class="bg-white rounded-[32px]
            p-8 shadow-lg border
            border-slate-100 mb-8">

    <h3 class="text-2xl font-bold mb-4">

        Pesan Relawan

    </h3>

    <div class="bg-slate-50 rounded-2xl p-6">

        {{ $donasi->pesan }}

    </div>

</div>

@endif


{{-- AKSI --}}
<div class="flex flex-wrap gap-4">

    @if($donasi->status=='menunggu' && !$donasi->bukti_transfer)

        <a href="{{ route('relawan.donasi.bayar',$donasi->id) }}"
           class="px-8 py-4 rounded-2xl
                  text-white font-semibold"

           style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
           ">

            💳 Bayar Sekarang

        </a>

        <!-- <a href="{{ route('relawan.donasi.upload',$donasi->id) }}"
           class="px-8 py-4 rounded-2xl
                  bg-blue-50 text-blue-600">

            ⬆ Upload Bukti

        </a> -->

    @endif

</div>


</div>

@endsection
