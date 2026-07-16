@extends('layouts.admin',['activePage'=>'tier'])

@section('title','Detail Tier')

@section('content')

<div class="space-y-8">

    {{-- ===========================
        HEADER
    ============================ --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

        <div>

            <h1 class="text-4xl font-extrabold text-slate-800">

                Detail Tier

            </h1>

            <p class="text-slate-500 mt-2">

                Informasi lengkap mengenai tier
                <b>{{ $tier->nama }}</b>

            </p>

        </div>

        <div class="flex gap-3">

            <a
                href="{{ route('admin.tier.index') }}"
                class="px-5 py-3 rounded-2xl bg-slate-200 hover:bg-slate-300 transition">

                ← Kembali

            </a>

            <a
                href="{{ route('admin.tier.edit',$tier) }}"
                class="px-5 py-3 rounded-2xl bg-yellow-500 text-white hover:bg-yellow-600 transition">

                ✏ Edit Tier

            </a>

        </div>

    </div>


    {{-- ===========================
        HERO CARD
    ============================ --}}
    <div
        class="rounded-3xl
               overflow-hidden
               shadow-xl">

        <div
            class="p-10 text-white"

            style="
                background:
                linear-gradient(
                    135deg,
                    {{ $tier->warna_hex }},
                    #1e293b
                );
            ">

            <div
                class="flex
                       flex-col
                       lg:flex-row
                       lg:justify-between
                       gap-10">

                <div>

                    <div class="text-7xl">

                        {{ $tier->badge_icon }}

                    </div>

                    <h2
                        class="text-5xl
                               font-extrabold
                               mt-5">

                        {{ $tier->nama }}

                    </h2>

                    <p
                        class="text-lg
                               mt-4
                               opacity-90
                               max-w-2xl">

                        {{ $tier->deskripsi }}

                    </p>

                    <div
                        class="flex
                               flex-wrap
                               gap-3
                               mt-8">

                        <span
                            class="px-5 py-2 rounded-full
                                   bg-white/20">

                            Level {{ $tier->urutan }}

                        </span>

                        <span
                            class="px-5 py-2 rounded-full
                                   bg-white/20">

                            Min :
                            {{ number_format($tier->min_poin) }}
                            poin

                        </span>

                        <span
                            class="px-5 py-2 rounded-full
                                   bg-white/20">

                            Max :

                            {{ $tier->max_poin
                                ? number_format($tier->max_poin)
                                : 'Unlimited' }}

                        </span>

                    </div>

                </div>


                {{-- ACTION --}}
                <div
                    class="flex
                           flex-col
                           gap-4
                           lg:w-60">

                    <a
                        href="{{ route('admin.tier.users',$tier) }}"
                        class="rounded-2xl
                               bg-white
                               text-slate-800
                               font-bold
                               text-center
                               py-4
                               hover:bg-slate-100">

                        👥 Lihat User

                    </a>

                    <a
                        href="{{ route('admin.tier.edit',$tier) }}"
                        class="rounded-2xl
                               bg-yellow-500
                               text-white
                               font-bold
                               text-center
                               py-4
                               hover:bg-yellow-600">

                        ✏ Edit Tier

                    </a>

                    <button
                        onclick="hapusTier({{ $tier->id }})"
                        class="rounded-2xl
                               bg-red-600
                               text-white
                               font-bold
                               py-4
                               hover:bg-red-700">

                        🗑 Hapus Tier

                    </button>

                </div>

            </div>

        </div>

    </div>



    {{-- ===========================
        STATISTIK
    ============================ --}}
    <div
        class="grid
               md:grid-cols-2
               xl:grid-cols-4
               gap-6">

        {{-- USER --}}
        <div
            class="bg-white
                   rounded-3xl
                   shadow-lg
                   p-7">

            <div class="text-5xl">

                👥

            </div>

            <div
                class="mt-5
                       text-slate-500">

                Total User

            </div>

            <div
                class="text-4xl
                       font-extrabold
                       mt-2">

                {{ number_format($tier->users_count) }}

            </div>

        </div>


        {{-- TOTAL POIN --}}
        <div
            class="bg-white
                   rounded-3xl
                   shadow-lg
                   p-7">

            <div class="text-5xl">

                ⭐

            </div>

            <div
                class="mt-5
                       text-slate-500">

                Total Poin

            </div>

            <div
                class="text-4xl
                       font-extrabold
                       mt-2">

                {{ number_format($statistik['totalPoin']) }}

            </div>

        </div>


        {{-- RATA --}}
        <div
            class="bg-white
                   rounded-3xl
                   shadow-lg
                   p-7">

            <div class="text-5xl">

                📈

            </div>

            <div
                class="mt-5
                       text-slate-500">

                Rata-rata Exp

            </div>

            <div
                class="text-4xl
                       font-extrabold
                       mt-2">

                {{ number_format($statistik['rataPoin']) }}

            </div>

        </div>


        {{-- BENEFIT --}}
        <div
            class="bg-white
                   rounded-3xl
                   shadow-lg
                   p-7">

            <div class="text-5xl">

                🎁

            </div>

            <div
                class="mt-5
                       text-slate-500">

                Total Benefit

            </div>

            <div
                class="text-4xl
                       font-extrabold
                       mt-2">

                {{ $statistik['totalBenefit'] }}

            </div>

        </div>

    </div>
    {{-- ==========================================================
        INFORMASI TIER + DISTRIBUSI + BENEFIT
    =========================================================== --}}
    <div
        class="grid
               xl:grid-cols-3
               gap-8">

        {{-- ===========================
            INFORMASI TIER
        ============================ --}}
        <div
            class="xl:col-span-2
                   bg-white
                   rounded-3xl
                   shadow-lg
                   p-8">

            <div class="flex items-center gap-3 mb-8">

                <div
                    class="w-14 h-14
                           rounded-2xl
                           flex items-center justify-center
                           text-3xl"

                    style="background: {{ $tier->warna_hex }}20">

                    📋

                </div>

                <div>

                    <h2 class="text-2xl font-bold">

                        Informasi Tier

                    </h2>

                    <p class="text-slate-500">

                        Detail konfigurasi tier.

                    </p>

                </div>

            </div>

            <div
                class="grid
                       md:grid-cols-2
                       gap-6">

                {{-- Nama --}}
                <div class="border rounded-2xl p-5">

                    <div class="text-slate-500 text-sm">

                        Nama Tier

                    </div>

                    <div class="text-2xl font-bold mt-2">

                        {{ $tier->nama }}

                    </div>

                </div>

                {{-- Level --}}
                <div class="border rounded-2xl p-5">

                    <div class="text-slate-500 text-sm">

                        Level

                    </div>

                    <div class="text-2xl font-bold mt-2">

                        {{ $tier->urutan }}

                    </div>

                </div>

                {{-- Minimal --}}
                <div class="border rounded-2xl p-5">

                    <div class="text-slate-500 text-sm">

                        Minimal Exp

                    </div>

                    <div class="text-2xl font-bold mt-2">

                        {{ number_format($tier->min_poin) }}

                    </div>

                </div>

                {{-- Maksimal --}}
                <div class="border rounded-2xl p-5">

                    <div class="text-slate-500 text-sm">

                        Maksimal Exp

                    </div>

                    <div class="text-2xl font-bold mt-2">

                        {{ $tier->max_poin
                            ? number_format($tier->max_poin)
                            : 'Unlimited' }}

                    </div>

                </div>

            </div>

        </div>

        {{-- ===========================
            BADGE PREVIEW
        ============================ --}}
        <div
            class="bg-white
                   rounded-3xl
                   shadow-lg
                   p-8">

            <h2
                class="text-2xl
                       font-bold
                       mb-6">

                Badge Preview

            </h2>

            <div
                class="rounded-3xl
                       p-10
                       text-center"

                style="background: {{ $tier->warna_hex }}20;">

                <div
                    class="text-8xl
                           mb-5">

                    {{ $tier->badge_icon }}

                </div>

                <h2
                    class="text-3xl
                           font-bold">

                    {{ $tier->nama }}

                </h2>

                <div
                    class="mt-4
                           inline-flex
                           px-5
                           py-2
                           rounded-full
                           text-white
                           font-semibold"

                    style="background:{{ $tier->warna_hex }};">

                    Level {{ $tier->urutan }}

                </div>

            </div>

            <div class="mt-8">

                <div class="text-slate-500 mb-2">

                    Warna Badge

                </div>

                <div
                    class="rounded-xl
                           px-4
                           py-3
                           text-white
                           font-semibold"

                    style="background:{{ $tier->warna_hex }};">

                    {{ $tier->warna_hex }}

                </div>

            </div>

        </div>

    </div>

    {{-- ==========================================================
        DISTRIBUSI USER
    =========================================================== --}}
    <div
        class="bg-white
               rounded-3xl
               shadow-lg
               p-8">

        <div
            class="flex
                   justify-between
                   items-center">

            <h2
                class="text-2xl
                       font-bold">

                Distribusi User

            </h2>

            <div
                class="text-3xl
                       font-bold">

                {{ $statistik['persentase'] }}%

            </div>

        </div>

        <div
            class="mt-6
                   w-full
                   h-5
                   rounded-full
                   bg-slate-200">

            <div
                class="h-5
                       rounded-full"

                style="
                    width:{{ $statistik['persentase'] }}%;
                    background:{{ $tier->warna_hex }};
                ">

            </div>

        </div>

        <div
            class="mt-5
                   text-slate-500">

            Tier ini digunakan oleh
            <b>{{ $tier->users_count }}</b>
            pengguna atau sekitar
            <b>{{ $statistik['persentase'] }}%</b>
            dari seluruh pengguna.

        </div>

    </div>

    {{-- ==========================================================
        BENEFIT
    =========================================================== --}}
    <div
        class="bg-white
               rounded-3xl
               shadow-lg
               p-8">

        <div
            class="flex
                   items-center
                   gap-3
                   mb-8">

            <div
                class="w-14
                       h-14
                       rounded-2xl
                       bg-amber-100
                       flex
                       items-center
                       justify-center
                       text-3xl">

                🎁

            </div>

            <div>

                <h2
                    class="text-2xl
                           font-bold">

                    Benefit Tier

                </h2>

                <p class="text-slate-500">

                    Keuntungan yang diperoleh pengguna.

                </p>

            </div>

        </div>

        <div
            class="grid
                   md:grid-cols-2
                   gap-5">

            @forelse($benefit as $item)

                <div
                    class="rounded-2xl
                           border
                           p-5
                           flex
                           items-center
                           gap-4
                           hover:border-green-500
                           hover:bg-green-50
                           transition">

                    <div
                        class="w-12
                               h-12
                               rounded-xl
                               bg-green-100
                               flex
                               items-center
                               justify-center">

                        ✅

                    </div>

                    <div
                        class="font-semibold">

                        {{ $item }}

                    </div>

                </div>

            @empty

                <div
                    class="col-span-full
                           text-center
                           py-12
                           text-slate-500">

                    Belum ada benefit.

                </div>

            @endforelse

        </div>

    </div>
    {{-- ==========================================================
        TOP USER
    =========================================================== --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="p-8 border-b">

            <div class="flex justify-between items-center">

                <div>

                    <h2 class="text-2xl font-bold">

                        🏆 Top User {{ $tier->nama }}

                    </h2>

                    <p class="text-slate-500 mt-2">

                        Pengguna dengan poin tertinggi pada tier ini.

                    </p>

                </div>

                <a
                    href="{{ route('admin.tier.users',$tier) }}"
                    class="px-5 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

                    Lihat Semua

                </a>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="text-left p-5">User</th>

                        <th>Email</th>

                        <th>Total Poin</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($topUsers as $user)

                    <tr class="border-t hover:bg-slate-50">

                        <td class="p-5">

                            <div class="flex items-center gap-4">

                                <img
                                    src="{{ $user->foto
                                            ? asset('storage/'.$user->foto)
                                            : asset('images/default-avatar.png') }}"
                                    class="w-14 h-14 rounded-full object-cover">

                                <div>

                                    <div class="font-bold">

                                        {{ $user->name }}

                                    </div>

                                    <div class="text-slate-500 text-sm">

                                        {{ $user->tier?->nama }}

                                    </div>

                                </div>

                            </div>

                        </td>

                        <td>

                            {{ $user->email }}

                        </td>

                        <td>

                            <span
                                class="px-4 py-2 rounded-full bg-amber-100 text-amber-700 font-bold">

                                ⭐ {{ number_format($user->total_poin) }}

                            </span>

                        </td>

                        <td>

                            @if($user->is_active)

                                <span
                                    class="px-3 py-2 rounded-full bg-green-100 text-green-700">

                                    Aktif

                                </span>

                            @else

                                <span
                                    class="px-3 py-2 rounded-full bg-red-100 text-red-700">

                                    Nonaktif

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center py-16 text-slate-500">

                            Belum ada pengguna pada tier ini.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>
    {{-- ==========================================================
        INSIGHT
    =========================================================== --}}
    <div class="grid lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-3xl shadow-lg p-7">

            <div class="text-5xl mb-5">

                👥

            </div>

            <h3 class="font-bold text-xl">

                User Tier

            </h3>

            <div class="text-4xl font-extrabold mt-4">

                {{ number_format($tier->users_count) }}

            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-lg p-7">

            <div class="text-5xl mb-5">

                ⭐

            </div>

            <h3 class="font-bold text-xl">

                Total Poin

            </h3>

            <div class="text-4xl font-extrabold mt-4">

                {{ number_format($statistik['totalPoin']) }}

            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-lg p-7">

            <div class="text-5xl mb-5">

                📊

            </div>

            <h3 class="font-bold text-xl">

                Distribusi

            </h3>

            <div class="text-4xl font-extrabold mt-4">

                {{ $statistik['persentase'] }}%

            </div>

        </div>

    </div>
    {{-- ==========================================================
        CHART
    =========================================================== --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="flex justify-between items-center mb-8">

            <div>

                <h2 class="text-2xl font-bold">

                    Distribusi Semua Tier

                </h2>

                <p class="text-slate-500">

                    Persentase pengguna pada setiap tier.

                </p>

            </div>

        </div>

        <canvas id="tierChart" height="120"></canvas>

    </div>

    {{-- ==========================================================
        FOOTER BUTTON
    =========================================================== --}}
    <!-- <div class="flex flex-wrap gap-4 justify-end">

        <a
            href="{{ route('admin.tier.index') }}"
            class="px-6 py-3 rounded-2xl bg-slate-200 hover:bg-slate-300">

            ← Kembali

        </a>

        <a
            href="{{ route('admin.tier.edit',$tier) }}"
            class="px-6 py-3 rounded-2xl bg-yellow-500 text-white hover:bg-yellow-600">

            ✏ Edit Tier

        </a>

    </div> -->

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(

    document.getElementById('tierChart'),

    {

        type:'doughnut',

        data:{

            labels:@json($chartLabels),

            datasets:[{

                data:@json($chartData),

                backgroundColor:@json($chartColors),

                borderWidth:0

            }]

        },

        options:{

            responsive:true,

            plugins:{

                legend:{

                    position:'bottom'

                }

            }

        }

    }

);

</script>

@endpush