@extends('layouts.admin', ['activePage' => 'konten'])

@section('content')

{{-- HERO --}}
<div class="card-admin p-8 mb-8 overflow-hidden relative">

    <div class="absolute -top-16 -right-16 w-60 h-60 rounded-full opacity-10"
         style="background: var(--color-merah)">
    </div>

    <div class="relative z-10">

        <h1 class="text-4xl font-bold text-[var(--color-coklat)]">
            Dashboard Konten
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola seluruh konten website dari satu tempat.
        </p>

        <div class="grid md:grid-cols-3 gap-5 mt-8">

            <a href="{{ route('admin.banners.create') }}"
               class="rounded-2xl p-5 text-white hover:scale-105 transition"
               style="background:linear-gradient(135deg,var(--color-kuning),var(--color-coklat));">

                <div class="text-4xl">🖼️</div>
                <h3 class="font-bold text-xl mt-3">
                    Tambah Banner
                </h3>

            </a>

            <a href="{{ route('admin.postingans.create') }}"
               class="rounded-2xl p-5 text-white hover:scale-105 transition"
               style="background:linear-gradient(135deg,var(--color-merah),var(--color-coklat));">

                <div class="text-4xl">📰</div>

                <h3 class="font-bold text-xl mt-3">
                    Buat Artikel
                </h3>

            </a>

            <a href="{{ route('admin.team.create') }}"
               class="rounded-2xl p-5 text-white hover:scale-105 transition"
               style="background:linear-gradient(135deg,#059669,#065f46);">

                <div class="text-4xl">👥</div>

                <h3 class="font-bold text-xl mt-3">
                    Tambah Team
                </h3>

            </a>

        </div>

    </div>

</div>

{{-- ANALYTICS --}}
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="card-admin p-6">
        <p class="text-slate-500">Total Banner</p>

        <div class="flex justify-between mt-3">

            <h2 class="text-4xl font-bold text-red-600">
                {{ $totalBanner }}
            </h2>

            <span class="text-5xl">🖼️</span>

        </div>
    </div>

    <div class="card-admin p-6">
        <p class="text-slate-500">Postingan</p>

        <div class="flex justify-between mt-3">

            <h2 class="text-4xl font-bold text-yellow-500">
                {{ $totalPostingan }}
            </h2>

            <span class="text-5xl">📰</span>

        </div>
    </div>

    <div class="card-admin p-6">
        <p class="text-slate-500">Team</p>

        <div class="flex justify-between mt-3">

            <h2 class="text-4xl font-bold text-green-600">
                {{ $totalTeam }}
            </h2>

            <span class="text-5xl">👥</span>

        </div>
    </div>

    <div class="card-admin p-6">
        <p class="text-slate-500">Banner Aktif</p>

        <div class="flex justify-between mt-3">

            <h2 class="text-4xl font-bold text-blue-600">
                {{ $bannerAktif }}
            </h2>

            <span class="text-5xl">🚀</span>

        </div>
    </div>

</div>


<div class="grid lg:grid-cols-3 gap-6 mt-8">

    {{-- AKTIVITAS --}}
    <div class="lg:col-span-2 card-admin p-6">

        <h3 class="text-xl font-bold mb-6">
            Aktivitas Terbaru
        </h3>

        <div class="space-y-5">

            @foreach($postinganTerbaru as $item)

            <div class="flex items-center gap-4 border-b pb-4">

                <div class="w-12 h-12 rounded-full flex items-center justify-center text-xl"
                     style="background:#fee2e2">

                    📰

                </div>

                <div class="flex-1">

                    <h4 class="font-semibold">
                        {{ $item->judul }}
                    </h4>

                    <p class="text-sm text-slate-500">
                        Dibuat {{ $item->created_at->diffForHumans() }}
                    </p>

                </div>

            </div>

            @endforeach

        </div>

    </div>


    {{-- QUICK INFO --}}
    <div class="card-admin p-6">

        <h3 class="text-xl font-bold mb-6">
            Ringkasan Sistem
        </h3>

        <div class="space-y-5">

            <div>
                <p class="text-slate-500">
                    Banner Aktif
                </p>

                <div class="w-full h-3 rounded-full bg-slate-200 mt-2">

                    <div class="h-3 rounded-full"
                         style="
                            width:{{ $persenAktif }}%;
                            background:var(--color-merah);
                         ">
                    </div>

                </div>

            </div>

            <div class="rounded-2xl p-5 bg-slate-50">

                <p class="text-slate-500">
                    Banner Terbaru
                </p>

                <h4 class="font-bold mt-2">
                    {{ $bannerTerbaru->judul ?? '-' }}
                </h4>

            </div>

            <div class="rounded-2xl p-5 bg-slate-50">

                <p class="text-slate-500">
                    Total Konten
                </p>

                <h2 class="text-3xl font-bold">
                    {{ $totalBanner + $totalPostingan + $totalTeam }}
                </h2>

            </div>

        </div>

    </div>

</div>

@endsection