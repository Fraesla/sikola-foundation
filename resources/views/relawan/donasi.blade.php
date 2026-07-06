@extends('layouts.relawan',[
    'activePage' => 'donasi'
])

@section('content')

<div class="mb-8 flex justify-between items-center">

    <div>

        <h1 class="text-4xl font-bold"
            style="color:var(--color-hitam)">

            Riwayat Donasi

        </h1>

        <p class="mt-2 text-slate-500">

            Semua histori donasi Anda

        </p>

    </div>

    <a href="{{ route('relawan.donasi.create') }}"
       class="px-6 py-3 rounded-2xl
              text-white font-semibold"

       style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
       ">

        + Donasi Baru

    </a>

</div>


{{-- FILTER --}}
<div class="admin-card p-6 mb-8">

    <form method="GET">

        <div class="grid md:grid-cols-3 gap-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari kode donasi, Program..."

                class="rounded-2xl border
                       border-slate-200 p-4">

            <select name="status" class="rounded-2xl border border-slate-200 p-4">

                <option value="">
                    Semua Status
                </option>

                <option value="menunggu_pembayaran"
                    @selected(request('status')=='menunggu_pembayaran')>

                    Menunggu Pembayaran

                </option>

                <option value="menunggu_verifikasi"
                    @selected(request('status')=='menunggu_verifikasi')>

                    Menunggu Verifikasi

                </option>

                <option value="berhasil"
                    @selected(request('status')=='berhasil')>

                    Berhasil

                </option>

                <option value="ditolak"
                    @selected(request('status')=='ditolak')>

                    Ditolak

                </option>

            </select>

            <button
                class="rounded-2xl text-white font-semibold"

                style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

                Filter

            </button>

        </div>

    </form>

</div>


{{-- LIST DONASI PREMIUM --}}

<div class="space-y-8 ">

    @forelse($donasis as $donasi)

    <div class="bg-white rounded-[32px]
                border border-slate-100
                shadow-sm hover:shadow-xl
                transition-all duration-300
                p-8 overflow-hidden ">

    <div class="grid lg:grid-cols-[1.3fr_1fr_1fr] gap-8 items-center">

        {{-- ================================= --}}
        {{-- KIRI --}}
        {{-- ================================= --}}
        <div class="flex gap-6">

            {{-- GAMBAR PROGRAM --}}
            <img
                src="{{ $donasi->kategori?->gambar
                        ? asset('storage/'.$donasi->kategori->gambar)
                        : asset('images/default-donasi.jpg') }}"
                class="w-32 h-32 rounded-3xl object-cover shadow-md">

            <div class="flex-1">

                {{-- KODE + STATUS --}}
                <div class="flex flex-wrap gap-3 items-center mb-4">

                    <span class="px-4 py-2 rounded-full
                                 bg-red-50 text-red-600
                                 font-bold">

                        DON-{{ str_pad($donasi->id,6,'0',STR_PAD_LEFT) }}

                    </span>

                    @if($donasi->status == 'menunggu')

                        @if(!$donasi->bukti_transfer)

                            <span class="px-4 py-2 rounded-full
                                         bg-yellow-100 text-yellow-700
                                         font-semibold">

                                ⏳ Menunggu Pembayaran

                            </span>

                        @else

                            <span class="px-4 py-2 rounded-full
                                         bg-blue-100 text-blue-700
                                         font-semibold">

                                🔍 Menunggu Verifikasi

                            </span>

                        @endif

                    @elseif($donasi->status == 'dikonfirmasi')

                        <span class="px-4 py-2 rounded-full
                                     bg-green-100 text-green-700
                                     font-semibold">

                            ✅ Berhasil

                        </span>

                    @elseif($donasi->status == 'ditolak')

                        <span class="px-4 py-2 rounded-full
                                     bg-red-100 text-red-700
                                     font-semibold">

                            ❌ Ditolak

                        </span>

                    @endif

                </div>

                {{-- TANGGAL --}}
                <div class="flex items-center gap-2
                            text-slate-500 mb-6">

                    📅
                    {{ $donasi->created_at->format('d M Y H:i') }}

                </div>

                {{-- NOMINAL --}}
                
                <h2 class="text-4xl font-bold
                           mb-2 text-slate-900">

                    Rp {{ number_format($donasi->jumlah,0,',','.') }}

                </h2>

                {{-- JENIS --}}
                <p class="font-semibold text-lg">

                    Jenis Donasi : {{ ucfirst($donasi->tipe) }}

                </p>

            </div>

        </div>


        {{-- ================================= --}}
        {{-- TENGAH --}}
        {{-- ================================= --}}
        <div class="border-l border-slate-200 pl-8">

            <div class="mb-5">

                <small class="text-slate-400">
                    Program
                </small>

                <h3 class="font-bold text-xl">

                    {{ $donasi->kategori->nama ?? '-' }}

                </h3>

            </div>

            <div class="mb-5">

                <small class="text-slate-400">
                    Metode
                </small>

                <h3 class="font-semibold">

                    Transfer Manual

                </h3>

            </div>

            <div>

                <small class="text-slate-400">
                    Poin
                </small>

                <h3 class="font-semibold">

                    {{ $donasi->poin_diberikan }}
                    poin

                </h3>

            </div>

        </div>


        {{-- ================================= --}}
        {{-- KANAN --}}
        {{-- ================================= --}}
        <div class="border-l border-slate-200
                    pl-8">

            <div class="flex flex-wrap gap-4">

                {{-- DETAIL --}}
                <a href="{{ route('relawan.donasi.show',$donasi->id) }}"
                   class="px-7 py-4 rounded-2xl
                          border border-slate-300
                          hover:bg-slate-50">

                    👁 Detail

                </a>


                {{-- BELUM BAYAR --}}
                @if(
                    $donasi->status=='menunggu'
                    && !$donasi->bukti_transfer
                )

                    <a href="{{ route('relawan.donasi.bayar',$donasi->id) }}"
                       class="px-7 py-4 rounded-2xl
                              text-white font-semibold"

                       style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                       ">

                        💳 Bayar

                    </a>

                    <!-- <a href="{{ route('relawan.donasi.upload',$donasi->id) }}"
                       class="px-7 py-4 rounded-2xl
                              bg-blue-50
                              text-blue-600
                              border border-blue-200">

                        ⬆ Upload Bukti

                    </a> -->

                    <form method="POST"
                          action="{{ route('relawan.donasi.batal',$donasi->id) }}">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Batalkan donasi ini?')"

                            class="px-7 py-4 rounded-2xl
                                   bg-red-50
                                   text-red-600
                                   border border-red-100">

                            ✖ Batalkan

                        </button>

                    </form>

                @endif


                {{-- MENUNGGU VERIFIKASI --}}
                @if(
                    $donasi->status=='menunggu'
                    && $donasi->bukti_transfer
                )

                    <a href="{{ asset('storage/'.$donasi->bukti_transfer) }}"
                       target="_blank"

                       class="px-7 py-4 rounded-2xl
                              border border-blue-300
                              text-blue-600">

                        📄 Lihat Bukti

                    </a>

                @endif


                {{-- SUKSES --}}
                @if($donasi->status=='dikonfirmasi')

                    <button
                        class="px-7 py-4 rounded-2xl
                               border border-green-300
                               text-green-600
                               font-semibold">

                        ✔ Selesai

                    </button>

                @endif

            </div>

        </div>

    </div>

    {{-- ALASAN DITOLAK --}}
    @if(
        $donasi->status=='ditolak'
        && $donasi->alasan_tolak
    )

        <div class="mt-8 p-5 rounded-2xl
                    bg-red-50 border border-red-100">

            <h5 class="font-bold text-red-700 mb-2">

                Alasan Penolakan

            </h5>

            <p>

                {{ $donasi->alasan_tolak }}

            </p>

        </div>

    @endif

    </div>

    @empty

    <div class="bg-white rounded-[32px]
                p-20 text-center">

        <div class="text-8xl mb-6">
            ❤️
        </div>

        <h3 class="text-4xl font-bold mb-4">

            Belum Ada Donasi

        </h3>

        <p class="text-slate-500 mb-10">

            Anda belum memiliki riwayat donasi.

        </p>

        <a href="{{ route('relawan.donasi.create') }}"
           class="px-10 py-5 rounded-2xl
                  text-white font-semibold"

           style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
           ">

            + Donasi Sekarang

        </a>

    </div>

    @endforelse

</div>




{{-- PAGINATION --}}
<div class="mt-8">

    {{ $donasis->links() }}

</div>

@endsection
