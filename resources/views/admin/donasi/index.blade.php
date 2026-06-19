@extends('layouts.admin', [
    'activePage' => 'donasi'
])

@section('content')

<!-- Header -->
<div class="flex justify-between items-center mb-8">

    <div>

        <h1
            class="text-3xl font-bold"
            style="color: var(--color-hitam);">

            Manajemen Donasi

        </h1>

        <p
            class="mt-2"
            style="color: var(--color-coklat);">

            Kelola seluruh transaksi dan verifikasi donasi.

        </p>

    </div>

</div>

<!-- Statistik -->
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="admin-card p-6">

        <p class="admin-muted">
            Total Donasi
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-merah);">

            Rp 75 Jt

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Pending
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-kuning);">

            8

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Donatur Aktif
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: #16a34a;">

            124

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Langganan Bulanan
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-coklat);">

            32

        </h2>

    </div>

</div>

<!-- Filter -->
<div class="admin-card p-5 mb-8">

    <div class="flex flex-wrap gap-3">

        <button
            class="px-5 py-2 rounded-xl text-white font-medium"
            style="background-color: var(--color-merah);">

            Semua Donasi

        </button>

        <button
            class="px-5 py-2 rounded-xl font-medium"
            style="
                background: rgba(212,160,23,.12);
                color: var(--color-kuning);
            ">

            Menunggu Verifikasi

        </button>

        <button
            class="px-5 py-2 rounded-xl font-medium"
            style="
                background: rgba(22,163,74,.12);
                color: #16a34a;
            ">

            Langganan Aktif

        </button>

    </div>

</div>

<!-- Tabel -->
<div class="admin-card overflow-hidden">

    <div
        class="px-6 py-5 border-b"
        style="border-color: rgba(212,160,23,.15);">

        <h3
            class="font-bold text-xl"
            style="color: var(--color-hitam);">

            Data Donasi

        </h3>

    </div>

    <table class="w-full">

        <thead
            style="
                background:
                rgba(212,160,23,.08);
            ">

            <tr>

                <th class="p-4 text-left">
                    Donatur
                </th>

                <th class="p-4 text-left">
                    Nominal
                </th>

                <th class="p-4 text-left">
                    Metode
                </th>

                <th class="p-4 text-left">
                    Tanggal
                </th>

                <th class="p-4 text-left">
                    Status
                </th>

                <th class="p-4 text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

            <tr
                class="border-t"
                style="
                    border-color:
                    rgba(212,160,23,.1);
                ">

                <td class="p-4">
                    Farhan Maulidani
                </td>

                <td
                    class="p-4 font-semibold"
                    style="color: var(--color-merah);">

                    Rp 500.000

                </td>

                <td class="p-4">
                    Transfer BCA
                </td>

                <td class="p-4">
                    12 Jan 2026
                </td>

                <td class="p-4">

                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold"
                        style="
                            background:
                            rgba(212,160,23,.15);

                            color:
                            var(--color-kuning);
                        ">

                        Pending

                    </span>

                </td>

                <td class="p-4 text-center">

                    <button
                        class="px-4 py-2 rounded-lg text-white font-medium"
                        style="
                            background-color:
                            var(--color-merah);
                        ">

                        Verifikasi

                    </button>

                </td>

            </tr>

        </tbody>

    </table>

</div>

@endsection