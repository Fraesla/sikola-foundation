@extends('layouts.admin',['activePage'=>'event'])

@section('content')

{{-- ================= HEADER ================= --}}
<div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-6 mb-10">

    <div>

        <span
            class="uppercase tracking-[8px] text-sm font-semibold"
            style="color:var(--color-coklat);">

            Event Volunteer

        </span>

        <h1
            class="text-5xl font-black mt-3"
            style="color:var(--color-hitam);">

            Manajemen Event

        </h1>

        <p
            class="mt-4 text-lg max-w-3xl leading-8"
            style="color:var(--color-coklat);">

            Kelola seluruh event volunteer, registrasi peserta,
            absensi kegiatan, sertifikat serta reward poin
            volunteer dalam satu dashboard.

        </p>

    </div>

    <div class="flex flex-wrap gap-4">

        {{-- Tombol Kembali --}}
        <a
            href="{{ url('/admin/events/show') }}"
            class="px-8 py-4 rounded-2xl font-bold border border-slate-200 bg-white shadow hover:bg-slate-50 transition">

            ← Kembali

        </a>

        {{-- Tambah Event --}}
        <a
            href="{{ route('admin.events.create') }}"
            class="px-8 py-4 rounded-2xl text-white font-bold shadow-xl hover:scale-105 transition"
            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
            ">

            ➕ Tambah Event

        </a>

    </div>

</div>


{{-- ================= STATISTIK ================= --}}
<div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6 mb-10">

    {{-- Total Event --}}
    <div class="admin-card rounded-3xl p-7">

        <div class="flex justify-between items-start">

            <div>

                <p class="text-sm text-slate-500 uppercase">
                    Total Event
                </p>

                <h2
                    class="text-5xl font-black mt-3"
                    style="color:var(--color-merah);">

                    {{ $totalEvent }}

                </h2>

            </div>

            <div
                class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl"
                style="background:rgba(220,38,38,.12);">

                📅

            </div>

        </div>

    </div>


    {{-- Event Aktif --}}
    <div class="admin-card rounded-3xl p-7">

        <div class="flex justify-between">

            <div>

                <p class="text-sm text-slate-500 uppercase">
                    Event Terbuka
                </p>

                <h2
                    class="text-5xl font-black mt-3 text-green-600">

                    {{ $upcomingEvent }}

                </h2>

            </div>

            <div
                class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">

                🚀

            </div>

        </div>

    </div>


    {{-- Event Selesai --}}
    <div class="admin-card rounded-3xl p-7">

        <div class="flex justify-between">

            <div>

                <p class="text-sm text-slate-500 uppercase">
                    Event Selesai
                </p>

                <h2
                    class="text-5xl font-black mt-3 text-blue-600">

                    {{ $selesaiEvent }}

                </h2>

            </div>

            <div
                class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">

                ✅

            </div>

        </div>

    </div>


    {{-- Total Peserta --}}
    <div class="admin-card rounded-3xl p-7">

        <div class="flex justify-between">

            <div>

                <p class="text-sm text-slate-500 uppercase">
                    Total Peserta
                </p>

                <h2
                    class="text-5xl font-black mt-3"
                    style="color:var(--color-kuning);">

                    {{ $totalPeserta }}

                </h2>

            </div>

            <div
                class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center text-3xl">

                👥

            </div>

        </div>

    </div>

</div>


{{-- ================= FILTER ================= --}}
<div
    class="admin-card rounded-3xl p-8 mb-10">

<form
    method="GET"
    action="{{ route('admin.events.index') }}">

<div
    class="grid lg:grid-cols-4 gap-5">

    {{-- Search --}}
    <div class="lg:col-span-2">

        <label
            class="text-sm font-semibold text-slate-600">

            Cari Event

        </label>

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari judul event..."
            class="mt-2 w-full rounded-2xl border px-5 py-4 focus:ring-2">

    </div>


    {{-- Status --}}
    <div>

        <label
            class="text-sm font-semibold text-slate-600">

            Status

        </label>

        <select
            name="status"
            class="mt-2 w-full rounded-2xl border px-5 py-4">

            <option value="">Semua</option>

            <option
                value="draft"
                @selected(request('status')=='draft')>

                Draft

            </option>

            <option
                value="terbuka"
                @selected(request('status')=='terbuka')>

                Terbuka

            </option>

             <option
                value="ditutup"
                @selected(request('status')=='ditutup')>

                Ditutup

            </option>

            <option
                value="selesai"
                @selected(request('status')=='selesai')>

                Selesai

            </option>

        </select>

    </div>


    {{-- Sort --}}
    <div>

        <label
            class="text-sm font-semibold text-slate-600">

            Urutkan

        </label>

        <select
            name="sort"
            class="mt-2 w-full rounded-2xl border px-5 py-4">

            <option
                value="latest"
                @selected(request('sort')=='latest')>

                Terbaru

            </option>

            <option
                value="oldest"
                @selected(request('sort')=='oldest')>

                Terlama

            </option>

        </select>

    </div>

</div>


<div class="flex justify-end mt-6 gap-3">

    <a
        href="{{ route('admin.events.index') }}"
        class="px-6 py-3 rounded-xl bg-slate-200 font-semibold">

        Reset

    </a>

    <button
        class="px-8 py-3 rounded-xl text-white font-bold"
        style="background:linear-gradient(135deg,var(--color-merah),var(--color-coklat));">

        🔍 Cari

    </button>

</div>

</form>

</div>


{{-- ================= LIST EVENT ================= --}}

<div class="mb-6">

    <h2
        class="text-3xl font-bold"
        style="color:var(--color-hitam);">

        Daftar Event

    </h2>

    <p
        class="text-slate-500 mt-2">

        Total
        <strong>{{ $events->total() }}</strong>
        event ditemukan.

    </p>

</div>


<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">

{{-- ================= CARD EVENT MULAI DI PART 2 ================= --}}
    @forelse($events as $event)

@php

    $jumlahPeserta = $event->pesertas_count ?? $event->pesertas()->count();

    $persentase = ($event->kuota && $event->kuota > 0)
    ? min(100, round(($jumlahPeserta / $event->kuota) * 100))
    : 0;

@endphp

<div
    class="admin-card rounded-[32px] overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition duration-300">

    {{-- ================= GAMBAR EVENT ================= --}}
    <div class="relative">

        @if($event->gambar)

            <img
                src="{{ asset('storage/'.$event->gambar) }}"
                class="w-full h-56 object-cover">

        @else

            <div
                class="h-56 flex items-center justify-center text-7xl bg-slate-100">

                📅

            </div>

        @endif


        {{-- STATUS --}}
        <div
            class="absolute top-5 right-5">

            @if($event->status=='draft')

                <span
                    class="px-4 py-2 rounded-full bg-yellow-500 text-white text-sm font-bold">

                    Draft

                </span>

            @elseif($event->status=='terbuka')

                <span
                    class="px-4 py-2 rounded-full bg-green-600 text-white text-sm font-bold">

                    Terbuka

                </span>

            @elseif($event->status=='selesai')

                <span
                    class="px-4 py-2 rounded-full bg-blue-600 text-white text-sm font-bold">

                    Selesai

                </span>

            @else

                <span
                    class="px-4 py-2 rounded-full bg-red-600 text-white text-sm font-bold">

                    Ditutup

                </span>

            @endif

        </div>

    </div>


    {{-- ================= BODY ================= --}}
    <div class="p-7">

        <h2
            class="text-2xl font-black"
            style="color:var(--color-hitam);">

            {{ $event->judul }}

        </h2>

        <p
            class="mt-3 text-sm leading-7 text-slate-500">

            {{ Str::limit(strip_tags($event->deskripsi),120) }}

        </p>


        {{-- INFO --}}
        <div class="space-y-3 mt-6">

            <div class="flex justify-between">

                <span class="text-slate-500">

                    📍 Lokasi

                </span>

                <strong>

                    {{ $event->lokasi }}

                </strong>

            </div>

            <div class="flex justify-between">

                <span class="text-slate-500">

                    📅 Mulai

                </span>

                <strong>

                    {{ $event->tanggal_mulai->format('d M Y') }}

                </strong>

            </div>

            <div class="flex justify-between">

                <span class="text-slate-500">

                    🏁 Selesai

                </span>

                <strong>

                    {{ $event->tanggal_selesai->format('d M Y') }}

                </strong>

            </div>

            <div class="flex justify-between">

                <span class="text-slate-500">

                    ⭐ Reward

                </span>

                <strong
                    class="text-yellow-600">

                    {{ number_format($event->poin_reward) }}

                    Poin

                </strong>

            </div>

        </div>


        {{-- ================= PROGRESS PESERTA ================= --}}
        <div class="mt-8">

            <div
                class="flex justify-between text-sm mb-2">

                <span>

                    Peserta

                </span>

                <strong>

                    {{ $jumlahPeserta }}

                    /

                    {{ $event->kuota ?? 'Unlimited' }}

                </strong>

            </div>

            <div
                class="w-full h-3 rounded-full bg-slate-200">

                <div
                    class="h-3 rounded-full"

                    style="
                        width:{{ $persentase }}%;
                        background:
                        linear-gradient(
                            90deg,
                            var(--color-merah),
                            var(--color-kuning)
                        );
                    ">

                </div>

            </div>

            <div
                class="text-right mt-2 text-xs text-slate-500">

                {{ $persentase }}%

            </div>

        </div>


        {{-- ================= QUICK STAT ================= --}}
        <div
            class="grid grid-cols-3 gap-4 mt-8">

            <div
                class="rounded-2xl bg-red-50 p-4 text-center">

                <div
                    class="text-2xl font-black text-red-600">

                    {{ $jumlahPeserta }}

                </div>

                <small>

                    Peserta

                </small>

            </div>

            <div
                class="rounded-2xl bg-green-50 p-4 text-center">

                <div
                    class="text-2xl font-black text-green-600">

                    {{ $event->absensis_count ?? 0 }}

                </div>

                <small>

                    Rekap

                </small>

            </div>

            <div
                class="rounded-2xl bg-yellow-50 p-4 text-center">

                <div
                    class="text-2xl font-black text-yellow-600">

                    {{ number_format($event->poin_reward) }}

                </div>

                <small>

                    Point

                </small>

            </div>

        </div>
        {{-- ================= ACTION ================= --}}
        @if($event->status == 'terbuka')

            <div class="grid grid-cols-2 gap-3 mt-8">

                <a
                    href="{{ route('admin.event.daftar',$event) }}"
                    class="text-center py-3 rounded-2xl font-semibold
                           bg-blue-50 text-blue-700 hover:bg-blue-100 transition">

                    📝 Registrasi

                </a>

                <a
                    href="{{ route('admin.peserta.index',$event) }}"
                    class="text-center py-3 rounded-2xl font-semibold
                           bg-green-50 text-green-700 hover:bg-green-100 transition">

                    👥 Peserta

                </a>

                <a
                    href="{{ route('admin.absensi.peserta',$event) }}"
                    class="text-center py-3 rounded-2xl font-semibold
                           bg-yellow-50 text-yellow-700 hover:bg-yellow-100 transition">

                    ✅ Absensi

                </a>

                <a
                    href="{{ route('admin.absensi.rekap',$event) }}"
                    class="text-center py-3 rounded-2xl font-semibold
                           bg-purple-50 text-purple-700 hover:bg-purple-100 transition">

                    📊 Rekap

                </a>

            </div>

            @else

            <div class="mt-8">

                @if($event->status == 'draft')

                    <div
                        class="w-full py-4 rounded-2xl
                               bg-yellow-100
                               text-yellow-700
                               text-center
                               font-bold">

                        📝 Event masih Draft

                    </div>

                @elseif($event->status == 'selesai')

                    <div
                        class="w-full py-4 rounded-2xl
                               bg-blue-100
                               text-blue-700
                               text-center
                               font-bold">

                        ✅ Event Telah Selesai

                    </div>

                @elseif($event->status == 'ditutup')

                    <div
                        class="w-full py-4 rounded-2xl
                               bg-red-100
                               text-red-700
                               text-center
                               font-bold">

                        🔒 Event Ditutup

                    </div>

                @endif

            </div>

        @endif

        {{-- Divider --}}
        <div class="border-t my-6"></div>

            <div class="flex gap-3">

                <a
                    href="{{ route('admin.events.edit',$event) }}"
                    class="flex-1 text-center py-3 rounded-2xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">

                    ✏ Edit

                </a>

                <form
                    action="{{ route('admin.events.destroy',$event) }}"
                    method="POST"
                    class="flex-1">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        onclick="return confirm('Yakin ingin menghapus event ini?')"
                        class="w-full py-3 rounded-2xl bg-red-600 text-white font-semibold hover:bg-red-700 transition">

                        🗑 Hapus

                    </button>

                </form>
                <!-- && $event->status_absensi == 'selesai' -->
                @if(
                    $event->status == 'terbuka'
                    && $jumlahPeserta > 0
                )

                <form
                    action="{{ route('admin.peserta.finalisasi',$event) }}"
                    method="POST"
                    class="col-span-2">

                    @csrf

                    <button
                        onclick="return confirm('Finalisasi event ini? Sertifikat dan poin akan dibuat otomatis.')"
                        class="w-full py-3 rounded-2xl
                               bg-emerald-600
                               hover:bg-emerald-700
                               text-white
                               font-bold">

                        🎓 Akhiri Event

                    </button>

                </form>

                @endif

            </div>

        </div>

    </div>

    @empty

    {{-- ================= EMPTY STATE ================= --}}
    <div class="col-span-full">

        <div
            class="admin-card rounded-[36px] p-20 text-center">

            <div
                class="w-40 h-40 mx-auto rounded-full flex items-center justify-center
                bg-gradient-to-br from-red-100 to-yellow-100">

                <span class="text-7xl">

                    📅

                </span>

            </div>

            <h2
                class="text-4xl font-black mt-8"
                style="color:var(--color-hitam);">

                Belum Ada Event

            </h2>

            <p
                class="mt-5 text-lg text-slate-500 max-w-2xl mx-auto leading-8">

                Saat ini belum ada event volunteer yang dibuat.

                Mulailah membuat event pertama untuk membuka
                registrasi peserta, melakukan absensi,
                memberikan sertifikat dan reward point volunteer.

            </p>

            <a
                href="{{ route('admin.events.create') }}"
                class="inline-block mt-10 px-10 py-5 rounded-2xl text-white font-bold shadow-xl hover:scale-105 transition"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

                ➕ Buat Event Pertama

            </a>

        </div>

    </div>

    @endforelse

</div>


{{-- ================= PAGINATION ================= --}}
@if($events->hasPages())

<div class="mt-12">

    {{ $events->links() }}

</div>

@endif

@endsection