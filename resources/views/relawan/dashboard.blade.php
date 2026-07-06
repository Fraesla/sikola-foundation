@extends('layouts.relawan',[
    'activePage' => 'dashboard'
])

@section('content')

<!-- HERO PREMIUM RELAWAN -->
<div class="relative overflow-hidden rounded-[35px] px-12 py-12 mb-10 text-white" style="background:linear-gradient(135deg,#0f766e,#115e59,#0d9488);">
    <!-- Background Decoration -->
    <div
    class="absolute -top-24 -right-24 w-96 h-96 rounded-full"

    style="
    background:rgba(255,255,255,.08);
    ">
    </div>

    <div
    class="absolute -bottom-20 left-1/2 w-72 h-72 rounded-full"

    style="
    background:rgba(255,255,255,.05);
    ">
    </div>

    <div
    class="absolute right-10 bottom-0 text-[180px] opacity-10">

        🤝

    </div>

    <div class="relative z-10">

        <span
        class="inline-flex items-center gap-2
        px-4 py-2 rounded-full
        text-sm font-semibold"

        style="
        background:rgba(255,255,255,.15);
        ">

            ❤️ Relawan Dashboard

        </span>

        <h1
        class="text-5xl font-extrabold mt-6 leading-tight">

            Halo,
            {{ auth()->user()->name }}

            🙌

        </h1>

        <p
        class="text-lg mt-6
        max-w-3xl
        leading-9
        text-white/90">

            Terima kasih telah menjadi bagian dari
            <b>Sikola Foundation.</b>

            Waktu, tenaga, dan semangat yang Anda berikan
            telah membantu menghadirkan perubahan nyata
            bagi masyarakat yang membutuhkan.

        </p>

        <!-- Statistik Singkat -->
        <div class="grid md:grid-cols-3 gap-5 mt-10">

            <div
            class="rounded-2xl p-5"

            style="
            background:rgba(255,255,255,.12);
            backdrop-filter:blur(12px);
            ">

                <div class="text-3xl">
                    📅
                </div>

                <div class="mt-3 text-white/70 text-sm">

                    Event Diikuti

                </div>

                <div class="text-3xl font-bold mt-2">

                    {{ $totalEvent ?? 0 }}

                </div>

            </div>

            <div
            class="rounded-2xl p-5"

            style="
            background:rgba(255,255,255,.12);
            backdrop-filter:blur(12px);
            ">

                <div class="text-3xl">
                    ⏰
                </div>

                <div class="mt-3 text-white/70 text-sm">

                    Jam Pengabdian

                </div>

                <div class="text-3xl font-bold mt-2">

                    {{ $totalJam ?? 0 }}

                </div>

            </div>

            <div
            class="rounded-2xl p-5"

            style="
            background:rgba(255,255,255,.12);
            backdrop-filter:blur(12px);
            ">

                <div class="text-3xl">
                    ⭐

                </div>

                <div class="mt-3 text-white/70 text-sm">

                    Badge Relawan

                </div>

                <div class="text-3xl font-bold mt-2">

                    {{ $badge ?? 'Bronze' }}

                </div>

            </div>

        </div>

        <!-- Tombol -->
        <div class="flex flex-wrap gap-4 mt-10">

            <a
            href="{{ route('event.index') }}"
            class="px-8 py-4 rounded-2xl bg-white font-bold transition hover:scale-105"

            style="
            color:#0f766e;
            ">

                📅 Lihat Event

            </a>

            <a
            href="#"
            class="px-8 py-4 rounded-2xl border border-white text-white font-semibold transition hover:bg-white hover:text-teal-700">

                📖 Aktivitas Saya

            </a>

            <a
            href="#"
            class="px-8 py-4 rounded-2xl border border-white text-white font-semibold transition hover:bg-white hover:text-teal-700">

                ❤️ Program Relawan

            </a>

        </div>

    </div>

</div>

<!-- ========================= -->
<!-- PREMIUM VOLUNTEER STATS -->
<!-- ========================= -->

<div class="grid lg:grid-cols-4 gap-7 mb-12">

    <!-- Total Event -->
    <div
    class="group relative overflow-hidden rounded-[28px] bg-white p-7 transition duration-500 hover:-translate-y-2 hover:shadow-2xl"

    style="
    box-shadow:var(--shadow);
    ">

        <div
        class="absolute top-0 right-0 w-32 h-32 rounded-full blur-3xl opacity-20"

        style="
        background:#14b8a6;
        "></div>

        <div
        class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

        style="
        background:linear-gradient(135deg,#14b8a6,#0f766e);
        color:white;
        ">

            📅

        </div>

        <p
        class="mt-6 text-sm uppercase tracking-widest"

        style="color:var(--color-coklat);">

            Event Diikuti

        </p>

        <h2
        class="text-5xl font-black mt-3"

        style="color:var(--color-hitam);">

            {{ $totalEvent ?? 0 }}

        </h2>

        <div class="mt-6">

            <div class="flex justify-between text-sm">

                <span>Target Tahun</span>

                <span>{{ $totalEventKatergori ?? 0 }} Event</span>

            </div>

            <div
            class="h-2 rounded-full mt-2"

            style="background:#ecfdf5;">

                <div
                class="h-2 rounded-full"

                style="
                width:{{ min(100,(($totalEvent ?? 0)/12)*100) }}%;
                background:#14b8a6;
                ">

                </div>

            </div>

        </div>

    </div>

    <!-- Jam Pengabdian -->
    <div
    class="group relative overflow-hidden rounded-[28px] bg-white p-7 transition duration-500 hover:-translate-y-2 hover:shadow-2xl"

    style="box-shadow:var(--shadow);">

        <div
        class="absolute top-0 right-0 w-32 h-32 rounded-full blur-3xl opacity-20"

        style="
        background:#f59e0b;
        "></div>

        <div
        class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

        style="
        background:linear-gradient(135deg,#f59e0b,#d97706);
        color:white;
        ">

            ⏰

        </div>

        <p
        class="mt-6 text-sm uppercase tracking-widest"

        style="color:var(--color-coklat);">

            Jam Pengabdian

        </p>

        <h2
        class="text-5xl font-black mt-3">

            {{ $totalJam ?? 0 }}

        </h2>

        <div class="mt-5 text-sm text-slate-500">

            Total waktu mengabdi

        </div>

    </div>

    <!-- Kehadiran -->
    <div
    class="group relative overflow-hidden rounded-[28px] bg-white p-7 transition duration-500 hover:-translate-y-2 hover:shadow-2xl"

    style="box-shadow:var(--shadow);">

        <div
        class="absolute top-0 right-0 w-32 h-32 rounded-full blur-3xl opacity-20"

        style="
        background:#2563eb;
        "></div>

        <div
        class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

        style="
        background:linear-gradient(135deg,#2563eb,#1d4ed8);
        color:white;
        ">

            ✅

        </div>

        <p
        class="mt-6 text-sm uppercase tracking-widest"

        style="color:var(--color-coklat);">

            Kehadiran

        </p>

        <h2
        class="text-5xl font-black">

            {{ $totalHadir ?? 0 }}

        </h2>

        <div class="mt-5">

            <span
            class="px-3 py-1 rounded-full text-xs font-bold"

            style="
            background:#dbeafe;
            color:#2563eb;
            ">

                Sangat Aktif

            </span>

        </div>

    </div>

    <!-- Badge -->
    <div
    class="group relative overflow-hidden rounded-[28px] bg-white p-7 transition duration-500 hover:-translate-y-2 hover:shadow-2xl"

    style="box-shadow:var(--shadow);">

        <div
        class="absolute top-0 right-0 w-32 h-32 rounded-full blur-3xl opacity-20"

        style="
        background:#dc2626;
        "></div>

        <div
        class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

        style="
        background:linear-gradient(135deg,#dc2626,#991b1b);
        color:white;
        ">

            🏆

        </div>

        <p
        class="mt-6 text-sm uppercase tracking-widest"

        style="color:var(--color-coklat);">

            Badge Saat Ini

        </p>

        <h2
        class="text-3xl font-black mt-3">

            {{ $badge ?? 'Bronze' }}

        </h2>

        <div class="mt-5 text-sm text-slate-500">

            Terus tingkatkan kontribusimu.

        </div>

    </div>

</div>
<!-- ======================================= -->
<!-- LEVEL & PROGRESS RELAWAN -->
<!-- ======================================= -->

<div class="grid lg:grid-cols-3 gap-8 mb-12">

    <!-- Progress Level -->
    <div
        class="lg:col-span-2 rounded-[32px] bg-white p-8 relative overflow-hidden"
        style="box-shadow:var(--shadow);">

        <div
            class="absolute top-0 right-0 w-72 h-72 rounded-full blur-3xl opacity-10"
            style="background:var(--color-merah);">
        </div>

        <div class="flex justify-between items-center mb-8">

            <div>

                <p
                    class="uppercase tracking-[5px] text-xs font-semibold"
                    style="color:var(--color-coklat);">

                    LEVEL RELAWAN

                </p>

                <h2
                    class="text-3xl font-black mt-2"
                    style="color:var(--color-hitam);">

                    {{ $levelRelawan }}

                </h2>

            </div>

            <div
                class="w-24 h-24 rounded-full flex items-center justify-center text-5xl"

                style="
                background:linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
                color:white;
                ">

                🏅

            </div>

        </div>

        <div class="mb-4 flex justify-between">

            <span
                class="font-semibold"
                style="color:var(--color-hitam);">

                Progress Menuju {{ $nextLevel }}

            </span>

            <span
                class="font-bold"
                style="color:var(--color-merah);">

                {{ $progressRelawan }}%

            </span>

        </div>

        <div
            class="h-5 rounded-full overflow-hidden"

            style="
            background:#f3f4f6;
            ">

            <div
                class="h-full rounded-full transition-all duration-1000"

                style="
                width:{{ $progressRelawan }}%;
                background:linear-gradient(
                    90deg,
                    var(--color-merah),
                    var(--color-kuning)
                );
                ">

            </div>

        </div>

        <div class="grid md:grid-cols-3 gap-5 mt-8">

            <div
                class="rounded-2xl p-5"
                style="background:rgba(204,34,34,.05);">

                <div class="text-3xl mb-3">🎯</div>

                <div class="text-sm text-slate-500">

                    Target Berikutnya

                </div>

                <div
                    class="text-2xl font-bold mt-2"
                    style="color:var(--color-merah);">

                    {{ number_format($targetJam) }} Jam

                </div>

            </div>

            <div
                class="rounded-2xl p-5"
                style="background:rgba(212,160,23,.08);">

                <div class="text-3xl mb-3">⭐</div>

                <div class="text-sm text-slate-500">

                    Poin Relawan

                </div>

                <div
                    class="text-2xl font-bold mt-2"
                    style="color:var(--color-kuning);">

                    {{ number_format($totalPoinRelawan) }}

                </div>

            </div>

            <div
                class="rounded-2xl p-5"
                style="background:rgba(59,130,246,.08);">

                <div class="text-3xl mb-3">📈</div>

                <div class="text-sm text-slate-500">

                    Jam Saat Ini

                </div>

                <div
                    class="text-2xl font-bold mt-2 text-blue-600">

                    {{ number_format($jamPengabdian) }}

                </div>

            </div>

        </div>

    </div>

    <!-- Badge -->
    <div
        class="rounded-[32px] bg-white p-8 text-center relative overflow-hidden"
        style="box-shadow:var(--shadow);">

        <div
            class="absolute inset-0 opacity-5"
            style="
            background:
            radial-gradient(circle,var(--color-kuning),transparent);
            ">
        </div>

        <div
            class="w-28 h-28 rounded-full mx-auto flex items-center justify-center text-6xl"

            style="
            background:linear-gradient(
                135deg,
                var(--color-kuning),
                #facc15
            );
            color:white;
            ">

            🏆

        </div>

        <h3
            class="text-3xl font-black mt-6"
            style="color:var(--color-hitam);">

            {{ $badgeRelawan }}

        </h3>

        <p
            class="mt-3"
            style="color:var(--color-coklat);">

            Badge berdasarkan kontribusi
            sebagai relawan.

        </p>

        <div class="mt-8">

            <span
                class="px-5 py-2 rounded-full font-bold"

                style="
                background:rgba(212,160,23,.15);
                color:var(--color-kuning);
                ">

                {{ $progressRelawan }}% Selesai

            </span>

        </div>

    </div>

</div>
<!-- ================================================= -->
<!-- JADWAL EVENT TERDEKAT -->
<!-- ================================================= -->

<div class="mb-12">

    <div class="flex justify-between items-center mb-7">

        <div>

            <p class="uppercase tracking-[4px] text-xs font-bold"
               style="color:var(--color-coklat);">

                EVENT RELAWAN

            </p>

            <h2 class="text-3xl font-black mt-2"
                style="color:var(--color-hitam);">

                Jadwal Terdekat

            </h2>

        </div>

        <a href="{{ route('event.index') }}"
           class="px-5 py-3 rounded-2xl text-white font-semibold transition hover:scale-105"

           style="
           background:linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
           );
           ">

            Lihat Semua →

        </a>

    </div>

    <div class="grid lg:grid-cols-3 gap-6">

        @forelse($upcomingEvents as $event)

        <div
            class="rounded-[30px] bg-white overflow-hidden group transition duration-500 hover:-translate-y-2"

            style="box-shadow:var(--shadow);">

            <div class="relative">

                <img
                    src="{{ asset('storage/'.$event->gambar) }}"
                    class="w-full h-52 object-cover group-hover:scale-105 transition duration-700">

                <div
                    class="absolute top-5 left-5 px-4 py-2 rounded-full text-sm font-bold"

                    style="
                    background:rgba(255,255,255,.95);
                    color:var(--color-merah);
                    ">

                    {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}

                </div>

            </div>

            <div class="p-7">

                <h3
                    class="text-2xl font-bold"

                    style="color:var(--color-hitam);">

                    {{ $event->judul }}

                </h3>

                <p
                    class="mt-4 text-sm leading-7"

                    style="color:var(--color-coklat);">

                    {{ Str::limit($event->deskripsi,120) }}

                </p>

                <div class="space-y-3 mt-6">

                    <div class="flex items-center gap-3">

                        📍

                        <span>{{ $event->lokasi }}</span>

                    </div>

                    <div class="flex items-center gap-3">

                        🕒

                        <span>

                            {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('l, d F Y') }}

                        </span>

                    </div>

                    <div class="flex items-center gap-3">

                        👥

                        <span>

                            {{ $event->registrasis_count }}
                            Relawan Terdaftar

                        </span>

                    </div>

                </div>

                <div class="mt-8">

                    <div class="flex justify-between text-sm mb-2">

                        <span>Countdown</span>

                        <span class="font-bold text-red-600">

                            {{ now()->diffInDays($event->tanggal,false) }}
                            Hari Lagi

                        </span>

                    </div>

                    <div
                        class="h-3 rounded-full overflow-hidden"
                        style="background:#ececec;">

                        <div
                            class="h-full rounded-full"

                            style="
                            width:{{ max(5,100-now()->diffInDays($event->tanggal,false)) }}%;
                            background:linear-gradient(
                                90deg,
                                var(--color-merah),
                                var(--color-kuning)
                            );
                            ">

                        </div>

                    </div>

                </div>

                <a
                    href="{{ route('event.show',$event->slug) }}"

                    class="mt-8 block w-full py-3 rounded-2xl text-center font-semibold text-white transition hover:scale-[1.03]"

                    style="
                    background:linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                    ">

                    Detail Event

                </a>

            </div>

        </div>

        @empty

        <div class="lg:col-span-3">

            <div
                class="rounded-[30px] bg-white p-12 text-center"
                style="box-shadow:var(--shadow);">

                <div class="text-7xl">

                    📅

                </div>

                <h3
                    class="text-3xl font-bold mt-6"
                    style="color:var(--color-hitam);">

                    Belum Ada Event

                </h3>

                <p
                    class="mt-4"
                    style="color:var(--color-coklat);">

                    Event relawan berikutnya akan segera diumumkan.

                </p>

            </div>

        </div>

        @endforelse

    </div>

</div>
<!-- ========================================= -->
<!-- TIMELINE AKTIVITAS RELAWAN -->
<!-- ========================================= -->

<div class="mb-12">

    <div class="flex items-center justify-between mb-8">

        <div>

            <p
                class="uppercase tracking-[4px] text-xs font-bold"
                style="color:var(--color-coklat);">

                AKTIVITAS TERBARU

            </p>

            <h2
                class="text-3xl font-black mt-2"
                style="color:var(--color-hitam);">

                Timeline Kontribusi

            </h2>

        </div>

        <div
            class="px-5 py-3 rounded-2xl text-sm font-semibold"

            style="
            background:rgba(204,34,34,.08);
            color:var(--color-merah);
            ">

            {{ $aktivitas->count() }} Aktivitas

        </div>

    </div>

    <div
        class="bg-white rounded-[32px] p-8"
        style="box-shadow:var(--shadow);">

        <div class="relative">

            <div
                class="absolute left-[22px] top-0 bottom-0 w-[3px] rounded-full"

                style="
                background:
                linear-gradient(
                    to bottom,
                    var(--color-merah),
                    var(--color-kuning)
                );
                ">
            </div>

            @forelse($aktivitas as $item)

            <div class="relative flex gap-6 pb-10">

                <!-- Dot -->

                <div
                    class="w-11 h-11 rounded-full flex items-center justify-center text-lg shrink-0 z-10"

                    style="
                    background:
                    {{ $item['bg'] }};
                    ">

                    {{ $item['icon'] }}

                </div>

                <div
                    class="flex-1 rounded-3xl p-6 transition hover:-translate-y-1"

                    style="
                    background:#fafafa;
                    border:1px solid rgba(0,0,0,.04);
                    ">

                    <div class="flex justify-between items-start">

                        <div>

                            <h4
                                class="font-bold text-lg"
                                style="color:var(--color-hitam);">

                                {{ $item['title'] }}

                            </h4>

                            <p
                                class="mt-2"
                                style="color:var(--color-coklat);">

                                {{ $item['desc'] }}

                            </p>

                        </div>

                        <span
                            class="text-sm font-semibold">

                            {{ $item['time'] }}

                        </span>

                    </div>

                </div>

            </div>

            @empty

            <div class="text-center py-16">

                <div class="text-7xl">

                    📋

                </div>

                <h3
                    class="text-2xl font-bold mt-5"
                    style="color:var(--color-hitam);">

                    Belum Ada Aktivitas

                </h3>

                <p
                    class="mt-3"
                    style="color:var(--color-coklat);">

                    Aktivitas relawan Anda akan muncul di sini.

                </p>

            </div>

            @endforelse

        </div>

    </div>

</div>
<!-- ========================================= -->
<!-- ACHIEVEMENT RELAWAN -->
<!-- ========================================= -->

<section class="mt-10">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-2xl font-bold"
                style="color:var(--color-hitam);">

                🏅 Achievement Relawan

            </h2>

            <p class="text-sm mt-1"
               style="color:var(--color-coklat);">

                Badge yang berhasil Anda kumpulkan.

            </p>

        </div>

        <span
            class="px-4 py-2 rounded-full text-sm font-semibold"

            style="
                background:rgba(212,160,23,.12);
                color:var(--color-coklat);
            ">

            {{ count($badges) }} Badge

        </span>

    </div>

    <div class="grid md:grid-cols-4 gap-6">

        @foreach($badges as $badge)

        <div
            class="group rounded-3xl bg-white p-6 border transition duration-300 hover:-translate-y-2 hover:shadow-xl"

            style="border-color:rgba(212,160,23,.15);">

            <div
                class="w-20 h-20 mx-auto rounded-full flex items-center justify-center text-5xl"

                style="
                    background:
                    {{ $badge['active']
                        ? 'linear-gradient(135deg,#FFD54F,#F59E0B)'
                        : '#F3F4F6'
                    }};
                ">

                {{ $badge['icon'] }}

            </div>

            <h3
                class="mt-5 text-lg font-bold text-center"

                style="
                    color:
                    {{ $badge['active']
                        ? 'var(--color-hitam)'
                        : '#94A3B8'
                    }};
                ">

                {{ $badge['title'] }}

            </h3>

            <p
                class="text-sm text-center mt-2"

                style="color:var(--color-coklat);">

                {{ $badge['desc'] }}

            </p>

            @if($badge['active'])

                <div
                    class="mt-5 text-center">

                    <span
                        class="px-3 py-1 rounded-full text-xs font-semibold"

                        style="
                            background:rgba(16,185,129,.15);
                            color:#059669;
                        ">

                        ✔ Dimiliki

                    </span>

                </div>

            @else

                <div
                    class="mt-5 text-center">

                    <span
                        class="px-3 py-1 rounded-full text-xs"

                        style="
                            background:#F3F4F6;
                            color:#64748B;
                        ">

                        🔒 Belum Terbuka

                    </span>

                </div>

            @endif

        </div>

        @endforeach

    </div>

</section>
<!-- ========================================= -->
<!-- QUICK ACTIONS -->
<!-- ========================================= -->

<section class="mt-10">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-2xl font-bold"
                style="color:var(--color-hitam);">

                ⚡ Quick Actions

            </h2>

            <p class="text-sm mt-1"
               style="color:var(--color-coklat);">

                Akses cepat seluruh fitur relawan.

            </p>

        </div>

    </div>

    <div class="grid md:grid-cols-4 gap-6">

        <!-- Event -->
        <a href="{{ route('event.index') }}">

            <div
                class="group rounded-3xl bg-white p-7 text-center border transition duration-300 hover:-translate-y-2 hover:shadow-xl"

                style="border-color:rgba(212,160,23,.15);">

                <div
                    class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl"

                    style="
                        background:rgba(204,34,34,.10);
                    ">

                    📅

                </div>

                <h3
                    class="font-bold mt-5 group-hover:text-red-600">

                    Lihat Event

                </h3>

                <p
                    class="text-sm mt-2 text-slate-500">

                    Cari event terbaru

                </p>

            </div>

        </a>

        <!-- Jadwal -->
        <a href="#">

            <div
                class="group rounded-3xl bg-white p-7 text-center border transition duration-300 hover:-translate-y-2 hover:shadow-xl"

                style="border-color:rgba(212,160,23,.15);">

                <div
                    class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl"

                    style="
                        background:rgba(16,185,129,.12);
                    ">

                    🗓️

                </div>

                <h3
                    class="font-bold mt-5 group-hover:text-green-600">

                    Jadwal Saya

                </h3>

                <p
                    class="text-sm mt-2 text-slate-500">

                    Lihat agenda relawan

                </p>

            </div>

        </a>

        <!-- Riwayat -->
        <a href="{{ route('relawan.events.index') }}">

            <div
                class="group rounded-3xl bg-white p-7 text-center border transition duration-300 hover:-translate-y-2 hover:shadow-xl"

                style="border-color:rgba(212,160,23,.15);">

                <div
                    class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl"

                    style="
                        background:rgba(59,130,246,.12);
                    ">

                    📜

                </div>

                <h3
                    class="font-bold mt-5 group-hover:text-blue-600">

                    Riwayat Event

                </h3>

                <p
                    class="text-sm mt-2 text-slate-500">

                    Aktivitas yang telah selesai

                </p>

            </div>

        </a>

        <!-- Sertifikat -->
        <a href="#">

            <div
                class="group rounded-3xl bg-white p-7 text-center border transition duration-300 hover:-translate-y-2 hover:shadow-xl"

                style="border-color:rgba(212,160,23,.15);">

                <div
                    class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-3xl"

                    style="
                        background:rgba(245,158,11,.15);
                    ">

                    🏆

                </div>

                <h3
                    class="font-bold mt-5 group-hover:text-yellow-600">

                    Sertifikat

                </h3>

                <p
                    class="text-sm mt-2 text-slate-500">

                    Download sertifikat

                </p>

            </div>

        </a>

    </div>

</section>
<!-- ========================================= -->
<!-- PROGRESS PENGABDIAN -->
<!-- ========================================= -->

<section class="mt-10">

    <div class="rounded-[32px] bg-white p-8 shadow-sm border"

         style="border-color:rgba(212,160,23,.15);">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

            <!-- kiri -->

            <div class="flex-1">

                <div class="flex items-center gap-3">

                    <div
                        class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl"

                        style="background:rgba(204,34,34,.10);">

                        ❤️

                    </div>

                    <div>

                        <h2
                            class="text-2xl font-bold"

                            style="color:var(--color-hitam);">

                            Progress Pengabdian

                        </h2>

                        <p
                            class="text-sm"

                            style="color:var(--color-coklat);">

                            Terus tingkatkan kontribusi Anda untuk masyarakat.

                        </p>

                    </div>

                </div>

                <!-- progress -->

                <div class="mt-8">

                    <div class="flex justify-between mb-3">

                        <span class="font-semibold">

                            {{ $jamPengabdian }} Jam

                        </span>

                        <span class="font-bold"

                              style="color:var(--color-merah);">

                            {{ $progressRelawan }}%

                        </span>

                    </div>

                    <div
                        class="w-full h-5 rounded-full overflow-hidden"

                        style="background:#F3F4F6;">

                        <div

                            class="h-full rounded-full transition-all duration-1000"

                            style="
                                width:{{ $progressRelawan }}%;
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

                <div
                    class="mt-6 rounded-2xl p-5"

                    style="background:rgba(204,34,34,.05);">

                    <div
                        class="flex justify-between items-center">

                        <div>

                            <div class="text-sm text-slate-500">

                                Target Berikutnya

                            </div>

                            <div class="text-xl font-bold">

                                {{ $targetJam }} Jam Pengabdian

                            </div>

                        </div>

                        <div
                            class="text-right">

                            <div
                                class="text-sm text-slate-500">

                                Sisa

                            </div>

                            <div
                                class="text-2xl font-bold"

                                style="color:var(--color-merah);">

                                {{ $sisaJam }} Jam

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- kanan -->

            <div class="lg:w-72">

                <div
                    class="rounded-3xl p-8 text-center"

                    style="
                        background:
                        linear-gradient(
                            135deg,
                            rgba(204,34,34,.10),
                            rgba(212,160,23,.10)
                        );
                    ">

                    <div class="text-6xl mb-4">

                        🏅

                    </div>

                    <h3
                        class="text-xl font-bold">

                        Hampir Mencapai Target

                    </h3>

                    <p
                        class="text-sm mt-3 text-slate-600 leading-relaxed">

                        Selesaikan

                        <b>{{ $sisaJam }} jam</b>

                        lagi agar memperoleh badge relawan berikutnya dan bonus poin.

                    </p>

                    <button

                        class="mt-6 px-6 py-3 rounded-xl text-white font-semibold"

                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                        Semangat!

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- ========================================== -->
<!-- PROGRAM MEMBUTUHKAN RELAWAN -->
<!-- ========================================== -->

<section class="mt-12">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                Program Membutuhkan Relawan

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Jadilah bagian dari perubahan hari ini.

            </p>

        </div>

        <a href="{{ route('event.index') }}"
           class="font-semibold"
           style="color:var(--color-merah);">

            Lihat Semua →

        </a>

    </div>

    <div class="grid lg:grid-cols-3 gap-7">

        @foreach($programRelawan as $event)

            @php

                $kuota = max($event->kuota,1);

                $progress = min(
                    100,
                    round(($event->registrasi_count/$kuota)*100)
                );

            @endphp

            <div
                class="group bg-white rounded-[30px] overflow-hidden shadow-sm border transition duration-300 hover:-translate-y-2 hover:shadow-xl"

                style="border-color:rgba(212,160,23,.15);">

                <!-- gambar -->

                <div class="relative h-52 overflow-hidden">

                    <img

                        src="{{ asset('storage/'.$event->gambar) }}"

                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">

                    </div>

                    <span
                        class="absolute top-5 left-5 px-4 py-2 rounded-full text-xs font-bold bg-white">

                        {{ $event->lokasi }}

                    </span>

                </div>

                <div class="p-6">

                    <h3
                        class="text-xl font-bold mb-2">

                        {{ $event->judul }}

                    </h3>

                    <p
                        class="text-sm text-slate-500 line-clamp-3">

                        {{ Str::limit($event->deskripsi,120) }}

                    </p>

                    <!-- tanggal -->

                    <div
                        class="mt-5 flex items-center justify-between">

                        <span>

                            📅

                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d M Y') }}

                        </span>

                        <span>

                            👥

                            {{ $event->registrasi_count }}

                            /

                            {{ $event->kuota }}

                        </span>

                    </div>

                    <!-- progress -->

                    <div
                        class="mt-5">

                        <div
                            class="flex justify-between text-sm mb-2">

                            <span>

                                Kuota Terisi

                            </span>

                            <span>

                                {{ $progress }}%

                            </span>

                        </div>

                        <div
                            class="h-3 rounded-full bg-slate-200 overflow-hidden">

                            <div

                                class="h-full rounded-full"

                                style="
                                    width:{{ $progress }}%;
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

                    <!-- tombol -->

                    <a
                        href="{{ route('event.show',$event->slug) }}"

                        class="mt-6 w-full py-3 rounded-2xl text-white font-semibold flex items-center justify-center"

                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                        Daftar Sekarang

                    </a>

                </div>

            </div>

        @endforeach

    </div>

</section>
<!-- ========================================== -->
<!-- LEADERBOARD RELAWAN -->
<!-- ========================================== -->

<section class="mt-14">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                Leaderboard Relawan

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Relawan paling aktif bulan ini.

            </p>

        </div>

        <div
            class="px-4 py-2 rounded-full text-sm font-semibold"

            style="
                background:rgba(204,34,34,.08);
                color:var(--color-merah);
            ">

            🏆 Hall of Fame

        </div>

    </div>

    <div class="bg-white rounded-[34px] shadow-sm overflow-hidden">

        @foreach($leaderboard as $index => $item)

            @php

                $medal = match($index){

                    0 => '🥇',
                    1 => '🥈',
                    2 => '🥉',
                    default => '⭐'

                };

            @endphp

            <div
                class="flex items-center justify-between px-8 py-6 border-b hover:bg-slate-50 transition">

                <div class="flex items-center gap-5">

                    <div
                        class="text-3xl w-12 text-center">

                        {{ $medal }}

                    </div>

                    @if($item->avatar)

                        <img

                            src="{{ asset('storage/'.$item->avatar) }}"

                            class="w-16 h-16 rounded-full object-cover border-2"

                            style="border-color:rgba(212,160,23,.35);">

                    @else

                        <div
                            class="w-16 h-16 rounded-full flex items-center justify-center text-xl font-bold text-white"

                            style="
                                background:
                                linear-gradient(
                                    135deg,
                                    var(--color-merah),
                                    var(--color-coklat)
                                );
                            ">

                            {{ strtoupper(substr($item->name,0,1)) }}

                        </div>

                    @endif

                    <div>

                        <div
                            class="font-bold text-lg">

                            {{ $item->name }}

                        </div>

                        <div
                            class="text-sm text-slate-500">

                            {{ ucfirst($item->role) }}

                        </div>

                    </div>

                </div>

                <div class="text-right">

                    <div
                        class="text-2xl font-bold"

                        style="color:var(--color-merah);">

                        {{ number_format($item->total_poin) }}

                    </div>

                    <div
                        class="text-sm text-slate-500">

                        poin

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</section>
<!-- ======================================= -->
<!-- KALENDER EVENT -->
<!-- ======================================= -->

<section class="mt-14">

    <div class="flex items-center justify-between mb-8">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                Kalender Event

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Jadwal kegiatan relawan yang akan datang.

            </p>

        </div>

        <a
            href="{{ route('event.index') }}"

            class="font-semibold"

            style="color:var(--color-merah);">

            Lihat Semua →

        </a>

    </div>

    <div class="space-y-6">

        @forelse($upcomingEvents as $event)

        @php

            $days = now()->diffInDays($event->tanggal_mulai,false);

        @endphp

        <div
            class="bg-white rounded-[30px] p-7 shadow-sm hover:-translate-y-1 hover:shadow-xl transition">

            <div class="flex flex-col lg:flex-row justify-between gap-6">

                <div class="flex gap-5">

                    <div
                        class="w-20 h-20 rounded-3xl flex flex-col items-center justify-center"

                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                            color:white;
                        ">

                        <div class="text-3xl">

                            📅

                        </div>

                    </div>

                    <div>

                        <h3
                            class="text-xl font-bold">

                            {{ $event->judul }}

                        </h3>

                        <div
                            class="mt-2 text-sm"

                            style="color:var(--color-coklat);">

                            📍 {{ $event->lokasi }}

                        </div>

                        <div
                            class="mt-2 text-sm text-slate-500">

                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}

                            •

                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('H:i') }}

                        </div>

                        <div
                            class="mt-4 flex gap-3 flex-wrap">

                            <span
                                class="px-4 py-2 rounded-full text-sm"

                                style="
                                    background:rgba(212,160,23,.12);
                                    color:var(--color-kuning);
                                ">

                                👥 {{ $event->registrasi_count }} Relawan

                            </span>

                            @if($event->isRegistered)

                                <span
                                    class="px-4 py-2 rounded-full text-sm bg-green-100 text-green-700">

                                    ✔ Terdaftar

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

                <div
                    class="flex flex-col justify-center items-end">

                    @if($days>0)

                        <div
                            class="text-5xl font-black"

                            style="color:var(--color-merah);">

                            {{ $days }}

                        </div>

                        <div
                            class="text-slate-500">

                            hari lagi

                        </div>

                    @elseif($days==0)

                        <div
                            class="text-2xl font-bold text-green-600">

                            Hari Ini

                        </div>

                    @else

                        <div
                            class="text-slate-400">

                            Selesai

                        </div>

                    @endif

                </div>

            </div>

        </div>

        @empty

        <div
            class="bg-white rounded-[30px] p-16 text-center shadow-sm">

            <div class="text-6xl mb-5">

                📅

            </div>

            <h3
                class="text-2xl font-bold">

                Belum Ada Event

            </h3>

            <p
                class="mt-3 text-slate-500">

                Jadwal kegiatan relawan berikutnya akan segera diumumkan.

            </p>

        </div>

        @endforelse

    </div>

</section>
<!-- ========================================= -->
<!-- QUOTE INSPIRASI -->
<!-- ========================================= -->

<section class="mt-10">

    <div
        class="relative overflow-hidden rounded-[32px] p-10"
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
            class="absolute -top-16 -right-16 w-56 h-56 rounded-full"
            style="background:rgba(255,255,255,.08);">
        </div>

        <div
            class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full"
            style="background:rgba(255,255,255,.05);">
        </div>

        <div class="relative z-10">

            <div
                class="w-20 h-20 rounded-full flex items-center justify-center text-5xl mb-8"
                style="background:rgba(255,255,255,.15);">

                💬

            </div>

            <p
                class="text-3xl md:text-4xl leading-relaxed font-semibold max-w-5xl text-white">

                "Relawan bukanlah orang yang memiliki banyak waktu,
                tetapi orang yang memiliki hati untuk berbagi."

            </p>

            <div class="mt-10 flex items-center gap-5">

                <div
                    class="w-16 h-16 rounded-full flex items-center justify-center text-3xl"
                    style="background:rgba(255,255,255,.15);">

                    ❤️

                </div>

                <div>

                    <h4 class="font-bold text-white text-xl">

                        Sikola Foundation

                    </h4>

                    <p
                        class="text-sm"
                        style="color:rgba(255,255,255,.75);">

                        Bersama Relawan Membangun Pendidikan Indonesia

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- ===================================== -->
<!-- RINGKASAN KONTRIBUSI -->
<!-- ===================================== -->

<section class="mt-14">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                Ringkasan Kontribusi

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Statistik perjalanan Anda sebagai Relawan Sikola Foundation.

            </p>

        </div>

        <div
            class="px-5 py-2 rounded-full"

            style="
                background:rgba(212,160,23,.12);
                color:var(--color-kuning);
            ">

            📈 Update Otomatis

        </div>

    </div>

    <div class="grid lg:grid-cols-5 gap-6">

        <!-- Total Event -->

        <div
            class="bg-white rounded-[28px] p-7 text-center shadow-sm hover:-translate-y-2 transition">

            <div class="text-5xl mb-4">

                🎯

            </div>

            <h3 class="text-4xl font-black">

                {{ $totalPengabdian }}

            </h3>

            <p class="mt-3 text-slate-500">

                Event Diikuti

            </p>

        </div>

        <!-- Jam -->

        <div
            class="bg-white rounded-[28px] p-7 text-center shadow-sm hover:-translate-y-2 transition">

            <div class="text-5xl mb-4">

                ⏱️

            </div>

            <h3 class="text-4xl font-black">

                {{ $totalJamPengabdian }}

            </h3>

            <p class="mt-3 text-slate-500">

                Jam Pengabdian

            </p>

        </div>

        <!-- Poin -->

        <div
            class="bg-white rounded-[28px] p-7 text-center shadow-sm hover:-translate-y-2 transition">

            <div class="text-5xl mb-4">

                ⭐

            </div>

            <h3
                class="text-4xl font-black"

                style="color:var(--color-merah);">

                {{ number_format($totalPoin) }}

            </h3>

            <p class="mt-3 text-slate-500">

                Total Poin

            </p>

        </div>

        <!-- Bulan Ini -->

        <div
            class="bg-white rounded-[28px] p-7 text-center shadow-sm hover:-translate-y-2 transition">

            <div class="text-5xl mb-4">

                📅

            </div>

            <h3 class="text-4xl font-black">

                {{ $kontribusiBulanIni }}

            </h3>

            <p class="mt-3 text-slate-500">

                Bulan Ini

            </p>

        </div>

        <!-- Ranking -->

        <div
            class="rounded-[28px] p-7 text-center text-white shadow-lg"

            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
            ">

            <div class="text-5xl mb-4">

                🏆

            </div>

            <h3 class="text-4xl font-black">

                #{{ $peringkatRelawan }}

            </h3>

            <p class="mt-3 text-white/80">

                Ranking Relawan

            </p>

        </div>

    </div>

</section>
<div
    class="mt-8 bg-white rounded-[30px] p-8 shadow-sm">

    <div class="flex justify-between mb-5">

        <div>

            <h3
                class="text-2xl font-bold">

                Progress Pengabdian Tahun Ini

            </h3>

            <p
                class="text-slate-500 mt-2">

                Semakin aktif mengikuti kegiatan,
                semakin tinggi level relawan Anda.

            </p>

        </div>

        <div
            class="text-right">

            <div
                class="text-4xl font-black"

                style="color:var(--color-merah);">

                {{ $progressRelawan }}%

            </div>

            <div
                class="text-slate-500">

                Progress

            </div>

        </div>

    </div>

    <div
        class="h-5 bg-slate-200 rounded-full overflow-hidden">

        <div

            class="h-full rounded-full transition-all duration-700"

            style="
                width:{{ $progressRelawan }}%;
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
<!-- ========================================= -->
<!-- RIWAYAT PENGABDIAN -->
<!-- ========================================= -->

<section class="mt-14">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h2
                class="text-3xl font-bold"
                style="color:var(--color-hitam);">

                Riwayat Pengabdian

            </h2>

            <p
                class="mt-2"
                style="color:var(--color-coklat);">

                Semua aktivitas sosial yang pernah Anda ikuti.

            </p>

        </div>

        <div
            class="px-5 py-2 rounded-full"

            style="
                background:rgba(212,160,23,.12);
                color:var(--color-kuning);
            ">

            ❤️ Jejak Kebaikan

        </div>

    </div>

    <div class="space-y-6">

        @forelse($riwayatPengabdian as $item)

        <div
            class="bg-white rounded-[30px] p-7 shadow-sm hover:-translate-y-1 hover:shadow-xl transition">

            <div class="flex flex-col lg:flex-row justify-between gap-6">

                <!-- kiri -->

                <div class="flex gap-5">

                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"

                        style="
                            background:
                            rgba(204,34,34,.08);
                        ">

                        🤝

                    </div>

                    <div>

                        <h3
                            class="text-xl font-bold">

                            {{ $item->event->judul }}

                        </h3>

                        <div
                            class="mt-2 text-sm text-slate-500">

                            📍

                            {{ $item->event->lokasi }}

                        </div>

                        <div
                            class="mt-2 text-sm text-slate-500">

                            📅

                            {{ \Carbon\Carbon::parse($item->event->tanggal_mulai)->translatedFormat('d F Y') }}

                        </div>

                    </div>

                </div>

                <!-- kanan -->

                <div class="text-right">

                    @php

                        $badge = match($item->status){

                            'hadir'=>'bg-green-100 text-green-700',

                            'mendaftar'=>'bg-yellow-100 text-yellow-700',

                            default=>'bg-red-100 text-red-700'

                        };

                    @endphp

                    <span

                        class="px-4 py-2 rounded-full text-sm {{ $badge }}">

                        {{ ucfirst($item->status) }}

                    </span>

                    <div
                        class="mt-4">

                        <div
                            class="text-sm text-slate-500">

                            Poin

                        </div>

                        <div
                            class="text-2xl font-bold"

                            style="color:var(--color-merah);">

                            +{{ $item->event->poin ?? 50 }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div
            class="bg-white rounded-[30px] p-16 text-center shadow-sm">

            <div class="text-7xl mb-5">

                📂

            </div>

            <h3
                class="text-2xl font-bold">

                Belum Ada Riwayat

            </h3>

            <p
                class="mt-3 text-slate-500">

                Anda belum mengikuti kegiatan relawan.

            </p>

            <a
                href="{{ route('event.index') }}"

                class="inline-block mt-8 px-7 py-3 rounded-2xl text-white font-semibold"

                style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

                Cari Event

            </a>

        </div>

        @endforelse

    </div>

</section>
<!-- ========================================= -->
<!-- PENUTUP DASHBOARD RELAWAN -->
<!-- ========================================= -->

<section class="mt-16 mb-6">

    <div

        class="relative overflow-hidden rounded-[38px] p-12"

        style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
        ">

        <!-- decoration -->

        <div
            class="absolute -right-20 -top-20 w-72 h-72 rounded-full"
            style="background:rgba(255,255,255,.08);">
        </div>

        <div
            class="absolute -left-24 -bottom-24 w-80 h-80 rounded-full"
            style="background:rgba(255,255,255,.05);">
        </div>

        <div class="relative z-10">

            <div class="grid lg:grid-cols-2 gap-10 items-center">

                <!-- kiri -->

                <div>

                    <span

                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold"

                        style="
                            background:rgba(255,255,255,.15);
                            color:white;
                        ">

                        ❤️ Terima Kasih Relawan

                    </span>

                    <h2

                        class="text-5xl font-black mt-6 leading-tight text-white">

                        Kebaikan yang Anda lakukan
                        hari ini akan menjadi
                        harapan bagi masa depan.

                    </h2>

                    <p

                        class="mt-6 text-lg leading-8"

                        style="color:rgba(255,255,255,.85);">

                        Terima kasih telah menjadi bagian dari
                        <strong>Sikola Foundation.</strong>

                        Setiap tenaga, waktu,
                        dan dedikasi Anda membantu
                        menciptakan perubahan nyata
                        bagi pendidikan Indonesia.

                    </p>

                    <div class="flex flex-wrap gap-4 mt-10">

                        <a

                            href="{{ route('event.index') }}"

                            class="px-7 py-4 rounded-2xl font-bold"

                            style="
                                background:white;
                                color:var(--color-merah);
                            ">

                            🎯 Cari Event Baru

                        </a>

                        <a

                            href="{{ route('relawan.profile') }}"

                            class="px-7 py-4 rounded-2xl border border-white text-white font-bold">

                            👤 Profil Saya

                        </a>

                    </div>

                </div>

                <!-- kanan -->

                <div>

                    <div

                        class="bg-white/10 backdrop-blur rounded-[30px] p-8 border border-white/20">

                        <h3

                            class="text-2xl font-bold text-white mb-8">

                            Ringkasan Anda

                        </h3>

                        <div class="space-y-6">

                            <div class="flex justify-between">

                                <span class="text-white/70">

                                    Event Diikuti

                                </span>

                                <strong class="text-white">

                                    {{ $totalPengabdian }}

                                </strong>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-white/70">

                                    Jam Pengabdian

                                </span>

                                <strong class="text-white">

                                    {{ $jamPengabdian }} Jam

                                </strong>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-white/70">

                                    Total Poin

                                </span>

                                <strong class="text-white">

                                    {{ number_format($totalPoinRelawan) }}

                                </strong>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-white/70">

                                    Badge

                                </span>

                                <strong class="text-white">

                                    🏅 {{ $badgeRelawan }}

                                </strong>

                            </div>

                            <div class="flex justify-between">

                                <span class="text-white/70">

                                    Level

                                </span>

                                <strong class="text-white">

                                    {{ $levelRelawan }}

                                </strong>

                            </div>

                        </div>

                        <div

                            class="mt-8 rounded-2xl p-5"

                            style="
                                background:
                                rgba(255,255,255,.10);
                            ">

                            <div class="text-white/70 text-sm">

                                Motivasi Hari Ini

                            </div>

                            <div class="text-white font-semibold mt-2">

                                🌱 Teruslah menebarkan manfaat,
                                karena satu langkah kecil Anda
                                dapat mengubah masa depan
                                seseorang.

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- footer -->

            <div

                class="border-t border-white/20 mt-12 pt-8 flex flex-col lg:flex-row justify-between items-center">

                <div class="text-white/70">

                    © {{ date('Y') }}
                    Sikola Foundation —
                    Bersama Relawan Membangun Indonesia.

                </div>

                <div class="flex gap-3 mt-5 lg:mt-0">

                    <span

                        class="px-4 py-2 rounded-full"

                        style="
                            background:rgba(255,255,255,.10);
                            color:white;
                        ">

                        🤝 Volunteer

                    </span>

                    <span

                        class="px-4 py-2 rounded-full"

                        style="
                            background:rgba(255,255,255,.10);
                            color:white;
                        ">

                        ❤️ Humanity

                    </span>

                    <span

                        class="px-4 py-2 rounded-full"

                        style="
                            background:rgba(255,255,255,.10);
                            color:white;
                        ">

                        📚 Education

                    </span>

                </div>

            </div>

        </div>

    </div>

</section>
@endsection
