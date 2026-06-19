@extends('layouts.admin', [
    'activePage' => 'merchandise'
])

@section('content')

<!-- Header -->
<div class="flex justify-between items-center mb-8">

    <div>

        <h1
            class="text-3xl font-bold"
            style="color: var(--color-hitam);">

            Merchandise & Order

        </h1>

        <p
            class="mt-2"
            style="color: var(--color-coklat);">

            Kelola produk, stok, dan pesanan merchandise.

        </p>

    </div>

    <button
        class="px-5 py-3 rounded-xl font-semibold text-white"
        style="background-color: var(--color-merah);">

        + Tambah Produk

    </button>

</div>

<!-- Statistik -->
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="admin-card p-6">

        <p class="admin-muted">
            Total Produk
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-merah);">

            24

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Total Stok
        </p>

        <h2
            class="text-3xl font-bold mt-2">

            420

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Pesanan Baru
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-kuning);">

            15

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Terjual
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color:#16a34a;">

            235

        </h2>

    </div>

</div>

<!-- Tabel Produk -->
<div class="admin-card overflow-hidden">

    <div
        class="px-6 py-5 border-b"
        style="border-color: rgba(212,160,23,.15);">

        <h3
            class="font-bold text-xl"
            style="color: var(--color-hitam);">

            Daftar Produk

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
                    Produk
                </th>

                <th class="p-4 text-left">
                    Stok
                </th>

                <th class="p-4 text-left">
                    Harga
                </th>

                <th class="p-4 text-left">
                    Terjual
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

                <td class="p-4 font-medium">
                    Kaos Sikola Foundation
                </td>

                <td class="p-4">

                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold"
                        style="
                            background:
                            rgba(22,163,74,.12);
                            color:#16a34a;
                        ">

                        50 Stok

                    </span>

                </td>

                <td
                    class="p-4 font-semibold"
                    style="color: var(--color-merah);">

                    Rp 120.000

                </td>

                <td class="p-4">
                    35 Unit
                </td>

                <td class="p-4 text-center">

                    <button
                        class="px-4 py-2 rounded-lg text-white"
                        style="
                            background-color:
                            var(--color-coklat);
                        ">

                        Edit

                    </button>

                    <button
                        class="px-4 py-2 rounded-lg text-white ml-2"
                        style="
                            background-color:
                            var(--color-merah);
                        ">

                        Hapus

                    </button>

                </td>

            </tr>

        </tbody>

    </table>

</div>

@endsection