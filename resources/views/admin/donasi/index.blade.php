@extends('layouts.admin', [
    'activePage' => 'donasi'
])

@section('content')

<!-- Header -->
<div class="mb-10">

    <h1
        class="text-4xl font-bold"
        style="color: var(--color-hitam);">

        Donasi & Donatur

    </h1>

    <p
        class="mt-2 text-lg"
        style="color: var(--color-coklat);">

        Kelola kategori donasi, program donasi,
        donatur, dan transaksi donasi.

    </p>

</div>

<!-- Card Menu -->
<div class="grid md:grid-cols-2 gap-8">

    <!-- DONASI -->
    <div class="admin-card rounded-[32px] overflow-hidden">

        <div
            class="h-2"
            style="
                background:
                linear-gradient(
                    90deg,
                    var(--color-kuning),
                    var(--color-coklat)
                );
            ">
        </div>

        <div class="p-8">

            <span
                class="uppercase tracking-[6px] text-sm"
                style="color: var(--color-coklat);">

                Donasi

            </span>

            <h2
                class="text-4xl font-bold mt-6"
                style="color: var(--color-hitam);">

                Kategori Donasi

            </h2>

            <p
                class="mt-6 text-lg leading-9"
                style="color: var(--color-coklat);">

                CRUD kategori donasi, target donasi,
                nominal minimum, nominal maksimum,
                lokasi program, dan status donasi.

            </p>

            <!-- Statistik -->
            <div class="grid grid-cols-3 gap-8 mt-10">

                <div>

                    <p class="admin-muted">
                        Total Kategori
                    </p>

                    <h3
                        class="text-5xl font-bold mt-2"
                        style="color: var(--color-merah);">

                        {{ $totalKategori ?? 0 }}

                    </h3>

                </div>

                <div>

                    <p class="admin-muted">
                        Aktif
                    </p>

                    <h3
                        class="text-5xl font-bold mt-2"
                        style="color:#16a34a;">

                        {{ $kategoriAktif ?? 0 }}

                    </h3>

                </div>

                <div>

                    <p class="admin-muted">
                        Lokasi
                    </p>

                    <h3
                        class="text-5xl font-bold mt-2"
                        style="color: var(--color-kuning);">

                        {{ $totalLokasi ?? 0 }}

                    </h3>

                </div>

            </div>

            <a href="{{ route('admin.donasiKategori.index') }}"
               class="inline-block mt-10 px-8 py-4 rounded-2xl text-white font-semibold"
               style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
               ">

                Kelola Donasi

            </a>

        </div>

    </div>

    <!-- DONATUR -->
    <div class="admin-card rounded-[32px] overflow-hidden">

        <div
            class="h-2"
            style="
                background:
                linear-gradient(
                    90deg,
                    var(--color-merah),
                    var(--color-kuning)
                );
            ">
        </div>

        <div class="p-8">

            <span
                class="uppercase tracking-[6px] text-sm"
                style="color: var(--color-coklat);">

                Donatur

            </span>

            <h2
                class="text-4xl font-bold mt-6"
                style="color: var(--color-hitam);">

                Data Donatur

            </h2>

            <p
                class="mt-6 text-lg leading-9"
                style="color: var(--color-coklat);">

                Kelola data donatur, riwayat donasi,
                verifikasi pembayaran, dan status
                transaksi donasi.

            </p>

            <!-- Statistik -->
            <div class="grid grid-cols-3 gap-8 mt-10">

                <div>

                    <p class="admin-muted">
                        Total Donatur
                    </p>

                    <h3
                        class="text-5xl font-bold mt-2"
                        style="color: var(--color-kuning);">

                        {{ $totalDonatur ?? 0 }}

                    </h3>

                </div>

                <div>

                    <p class="admin-muted">
                        Pending
                    </p>

                    <h3
                        class="text-5xl font-bold mt-2"
                        style="color:#2563eb;">

                        {{ $donasiPending ?? 0 }}

                    </h3>

                </div>

                <div>

                    <p class="admin-muted">
                        Selesai
                    </p>

                    <h3
                        class="text-5xl font-bold mt-2"
                        style="color:#16a34a;">

                        {{ $donasiSelesai ?? 0 }}

                    </h3>

                </div>

            </div>

            <a href="{{ route('admin.donasis.index') }}"
               class="inline-block mt-10 px-8 py-4 rounded-2xl text-white font-semibold"
               style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-kuning),
                        var(--color-coklat)
                    );
               ">

                Kelola Donatur

            </a>

        </div>

    </div>

</div>

@endsection