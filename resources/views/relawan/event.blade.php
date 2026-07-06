@extends('layouts.relawan',['activePage'=>'event'])

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="relative overflow-hidden rounded-[36px] p-10 text-white"

        style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
        ">

        <div class="absolute right-0 top-0 opacity-10 text-[180px]">

            🎉

        </div>

        <div class="relative z-10">

            <p class="uppercase tracking-[6px] text-sm opacity-80">

                Volunteer Center

            </p>

            <h1 class="text-5xl font-black mt-3">

                Event Relawan

            </h1>

            <p class="mt-5 text-lg opacity-90 max-w-3xl leading-8">

                Ikuti berbagai kegiatan sosial, pengabdian masyarakat,
                dan event kemanusiaan yang diselenggarakan oleh
                Sikola Foundation.

            </p>

            <div class="flex flex-wrap gap-4 mt-8">

                <a href="{{ route('event.index') }}"

                    class="px-7 py-4 rounded-2xl font-bold bg-white"

                    style="color:var(--color-merah)">

                    ➕ Daftar Event

                </a>

                <a href="#eventSaya"

                    class="px-7 py-4 rounded-2xl border border-white/40">

                    Event Saya

                </a>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- STATISTIK --}}
    {{-- ========================================================= --}}

    <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6">

        {{-- Total Event --}}
        <div class="admin-card rounded-[28px] p-7">

            <div class="flex justify-between">

                <div>

                    <small class="text-slate-500">

                        Total Event

                    </small>

                    <h2
                        class="text-5xl font-black mt-3"
                        style="color:var(--color-merah)">

                        {{ $totalEvent }}

                    </h2>

                </div>

                <div class="text-5xl">

                    🎪

                </div>

            </div>

        </div>


        {{-- Terdaftar --}}
        <div class="admin-card rounded-[28px] p-7">

            <div class="flex justify-between">

                <div>

                    <small class="text-slate-500">

                        Terdaftar

                    </small>

                    <h2
                        class="text-5xl font-black mt-3"
                        style="color:var(--color-kuning)">

                        {{ $terdaftar }}

                    </h2>

                </div>

                <div class="text-5xl">

                    🙋

                </div>

            </div>

        </div>


        {{-- Akan Datang --}}
        <div class="admin-card rounded-[28px] p-7">

            <div class="flex justify-between">

                <div>

                    <small class="text-slate-500">

                        Akan Datang

                    </small>

                    <h2
                        class="text-5xl font-black mt-3 text-green-600">

                        {{ $akanDatang }}

                    </h2>

                </div>

                <div class="text-5xl">

                    📅

                </div>

            </div>

        </div>


        {{-- Selesai --}}
        <div class="admin-card rounded-[28px] p-7">

            <div class="flex justify-between">

                <div>

                    <small class="text-slate-500">

                        Event Selesai

                    </small>

                    <h2
                        class="text-5xl font-black mt-3"

                        style="color:var(--color-coklat)">

                        {{ $selesai }}

                    </h2>

                </div>

                <div class="text-5xl">

                    🏆

                </div>

            </div>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- FILTER --}}
    {{-- ========================================================= --}}

    <div class="admin-card rounded-[32px] p-7">

        <form method="GET">

            <div class="grid lg:grid-cols-12 gap-5">

                {{-- SEARCH --}}
                <div class="lg:col-span-5">

                    <label class="text-sm font-semibold text-slate-500">

                        Cari Event

                    </label>

                    <div class="relative mt-2">

                        <span
                            class="absolute left-5 top-4 text-slate-400">

                            🔍

                        </span>

                        <input

                            type="text"

                            name="search"

                            value="{{ request('search') }}"

                            placeholder="Cari judul event atau lokasi..."

                            class="w-full rounded-2xl border pl-14 pr-5 py-4 focus:ring-0"

                        >

                    </div>

                </div>



                {{-- STATUS --}}
                <div class="lg:col-span-3">

                    <label class="text-sm font-semibold text-slate-500">

                        Status

                    </label>

                    <select

                        name="status"

                        class="w-full mt-2 rounded-2xl border py-4 px-5">

                        <option value="">

                            Semua Status

                        </option>

                        <option

                            value="mendaftar"

                            @selected(request('status')=='mendaftar')>

                            Pending

                        </option>

                        <option

                            value="dikonfirmasi"

                            @selected(request('status')=='dikonfirmasi')>

                            Disetujui

                        </option>

                        <option

                            value="hadir"

                            @selected(request('status')=='hadir')>

                            Hadir

                        </option>

                        <option

                            value="ditolak"

                            @selected(request('status')=='ditolak')>

                            Ditolak

                        </option>

                    </select>

                </div>



                {{-- BUTTON --}}
                <div class="lg:col-span-4 flex items-end gap-3">

                    <button

                        class="flex-1 py-4 rounded-2xl text-white font-bold"

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

                    <a

                        href="{{ route('event.index') }}"

                        class="px-6 py-4 rounded-2xl text-white font-bold"

                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-kuning),
                                var(--color-coklat)
                            );
                        ">

                        Semua Event

                    </a>

                </div>

            </div>

        </form>

    </div>



    {{-- ========================================================= --}}
    {{-- LIST EVENT (Bagian 2 dimulai dari sini) --}}
    {{-- ========================================================= --}}

    <div id="eventSaya" class="space-y-6">
        @forelse($registrasi as $item)

        @php

            $event = $item->event;

            $jumlahPeserta = $event->registrasi()->count();

            $persen = $event->kuota > 0
                ? ($jumlahPeserta / $event->kuota) * 100
                : 0;

        @endphp

        <div
            class="admin-card rounded-[34px] overflow-hidden shadow-lg hover:shadow-2xl transition duration-300">

            <div class="grid lg:grid-cols-12">

                {{-- ================================================= --}}
                {{-- GAMBAR --}}
                {{-- ================================================= --}}

                <div class="lg:col-span-4 relative">

                    <img
                        src="{{ asset('storage/'.$event->gambar) }}"
                        class="w-full h-full min-h-[280px] object-cover">

                    {{-- STATUS --}}
                    <div class="absolute top-5 left-5">

                        @if($item->status=='mendaftar')

                            <span
                                class="px-4 py-2 rounded-full bg-yellow-400 text-white font-semibold">

                                Menunggu

                            </span>

                        @elseif($item->status=='dikonfirmasi')

                            <span
                                class="px-4 py-2 rounded-full bg-green-500 text-white font-semibold">

                                Disetujui

                            </span>

                        @elseif($item->status=='hadir')

                            <span
                                class="px-4 py-2 rounded-full bg-blue-500 text-white font-semibold">

                                Hadir

                            </span>

                        @else

                            <span
                                class="px-4 py-2 rounded-full bg-red-500 text-white font-semibold">

                                Ditolak

                            </span>

                        @endif

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- CONTENT --}}
                {{-- ================================================= --}}

                <div class="lg:col-span-8 p-8">

                    <div class="flex justify-between items-start">

                        <div>

                            <small
                                class="uppercase tracking-[4px]"
                                style="color:var(--color-coklat)">

                                Event Volunteer

                            </small>

                            <h2
                                class="text-3xl font-black mt-2">

                                {{ $event->judul }}

                            </h2>

                        </div>

                        <div
                            class="text-right">

                            <small class="text-slate-400">

                                Reward

                            </small>

                            <h3
                                class="text-2xl font-black"

                                style="color:var(--color-merah)">

                                {{ number_format($event->poin_reward) }}

                                Poin

                            </h3>

                        </div>

                    </div>



                    {{-- ============================================== --}}
                    {{-- INFO --}}
                    {{-- ============================================== --}}

                    <div
                        class="grid md:grid-cols-3 gap-6 mt-8">

                        <div>

                            <small class="text-slate-400">

                                Tanggal

                            </small>

                            <h4 class="font-bold mt-1">

                                {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}

                            </h4>

                        </div>

                        <div>

                            <small class="text-slate-400">

                                Lokasi

                            </small>

                            <h4 class="font-bold mt-1">

                                {{ $event->lokasi }}

                            </h4>

                        </div>

                        <div>

                            <small class="text-slate-400">

                                Peserta

                            </small>

                            <h4 class="font-bold mt-1">

                                {{ $jumlahPeserta }}

                                /

                                {{ $event->kuota + $jumlahPeserta}}

                            </h4>

                        </div>

                    </div>


                    {{-- ============================================== --}}
                    {{-- PROGRESS --}}
                    {{-- ============================================== --}}

                    <div class="mt-8">

                        <div class="flex justify-between mb-2">

                            <small>

                                Kuota Terisi

                            </small>

                            <small>

                                {{ number_format($persen,0) }}%

                            </small>

                        </div>

                        <div
                            class="h-3 rounded-full bg-slate-200">

                            <div

                                class="h-3 rounded-full"

                                style="
                                    width:{{ $persen }}%;
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


                    {{-- ============================================== --}}
                    {{-- COUNTDOWN --}}
                    {{-- ============================================== --}}

                    <div
                        class="mt-8 rounded-2xl p-5"

                        style="
                            background:
                            rgba(212,160,23,.08);
                        ">

                        <div
                            class="flex justify-between items-center">

                            <div>

                                <small>

                                    Event Dimulai

                                </small>

                                <h4
                                    class="font-bold text-xl mt-2">

                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->diffForHumans() }}

                                </h4>

                            </div>

                            <div class="text-5xl">

                                ⏳

                            </div>

                        </div>

                    </div>


                    {{-- ============================================== --}}
                    {{-- ACTION --}}
                    {{-- ============================================== --}}

                    <div
                        class="flex flex-wrap gap-3 mt-8">

                        <a
                            href="{{ route('relawan.events.show',$event->id) }}"

                            class="px-6 py-3 rounded-2xl border">

                            👁 Detail

                        </a>


                        @if($item->status=='pending')

                            <form
                                method="POST"
                                action="{{ route('relawan.events.batal',$item->id) }}">

                                @csrf
                                @method('DELETE')

                                <button

                                    onclick="return confirm('Batalkan pendaftaran?')"

                                    class="px-6 py-3 rounded-2xl bg-red-100 text-red-600">

                                    ❌ Batalkan

                                </button>

                            </form>

                        @endif


                        @if($item->status=='dikonfirmasi')

                            <button

                                class="px-6 py-3 rounded-2xl text-white"

                                style="
                                    background:
                                    linear-gradient(
                                        135deg,
                                        var(--color-merah),
                                        var(--color-coklat)
                                    );
                                ">

                                🎫 Lihat Tiket

                            </button>

                        @endif


                        @if($item->status=='hadir')

                            <button

                                disabled

                                class="px-6 py-3 rounded-2xl bg-green-600 text-white">

                                ✔ Event Selesai

                            </button>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        @empty
        {{-- ========================================================= --}}
        {{-- EMPTY STATE --}}
        {{-- ========================================================= --}}

        <div class="admin-card rounded-[36px] p-16 text-center">

            <div
                class="mx-auto w-36 h-36 rounded-full flex items-center justify-center"

                style="
                    background:
                    linear-gradient(
                        135deg,
                        rgba(220,38,38,.08),
                        rgba(212,160,23,.12)
                    );
                ">

                <span class="text-7xl">

                    🎉

                </span>

            </div>

            <h2
                class="text-4xl font-black mt-8"
                style="color:var(--color-hitam)">

                Belum Ada Event

            </h2>

            <p
                class="max-w-2xl mx-auto mt-5 text-lg leading-8"
                style="color:var(--color-coklat)">

                Saat ini Anda belum pernah mendaftar pada event relawan.
                Ayo bergabung dalam kegiatan sosial bersama Sikola Foundation.

            </p>

            <a

                href="{{ route('event.index') }}"

                class="inline-flex items-center gap-3 mt-10
                       px-8 py-5 rounded-2xl text-white font-bold"

                style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

                🚀 Daftar Event Sekarang

            </a>

        </div>

        @endforelse

        </div>


        {{-- ========================================================= --}}
        {{-- PAGINATION --}}
        {{-- ========================================================= --}}

        @if($registrasi->hasPages())

        <div class="flex justify-center mt-12">

            <div
                class="admin-card rounded-3xl px-6 py-4">

                {{ $registrasi->links() }}

            </div>

        </div>

        @endif


        {{-- ========================================================= --}}
        {{-- CTA --}}
        {{-- ========================================================= --}}

        <div
            class="relative overflow-hidden rounded-[40px] p-12 text-white"

            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-kuning),
                    var(--color-coklat)
                );
            ">

            <div
                class="absolute right-0 bottom-0 opacity-10 text-[220px]">

                🌍

            </div>

            <div class="relative z-10">

                <small class="uppercase tracking-[5px]">

                    Volunteer Journey

                </small>

                <h2 class="text-4xl font-black mt-4">

                    Jadilah Bagian Dari Perubahan

                </h2>

                <p
                    class="max-w-3xl mt-5 text-lg leading-8 opacity-90">

                    Setiap kegiatan yang Anda ikuti akan memberikan
                    dampak nyata bagi masyarakat sekaligus menambah
                    pengalaman, sertifikat, dan poin relawan.

                </p>

                <div class="flex flex-wrap gap-4 mt-10">

                    <a

                        href="{{ route('event.index') }}"

                        class="px-8 py-4 rounded-2xl font-bold"

                        style="
                            background:white;
                            color:var(--color-merah);
                        ">

                        Lihat Semua Event

                    </a>

                    <a

                        href="{{ route('relawan.dashboard') }}"

                        class="px-8 py-4 rounded-2xl border border-white/40">

                        Dashboard

                    </a>

                </div>

            </div>

    </div>

</div>


<style>

.admin-card{

    background:#fff;

    border:1px solid rgba(0,0,0,.05);

    transition:.35s;

}

.admin-card:hover{

    transform:translateY(-6px);

    box-shadow:0 25px 60px rgba(0,0,0,.08);

}

</style>

@endsection