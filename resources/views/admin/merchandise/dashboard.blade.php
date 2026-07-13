@extends('layouts.admin',[
    'activePage' => 'merchandise'
])

@section('content')

{{-- HEADER --}}
<div class="mb-10">

    <h1
        class="text-3xl font-bold"
        style="color: var(--color-hitam);">

        Merchandise & Order

    </h1>

    <p
        class="mt-2"
        style="color: var(--color-coklat);">

        Kelola produk merchandise, stok, pesanan dan pengiriman.

    </p>

</div>


{{-- MENU --}}
<div class="grid lg:grid-cols-2 gap-8">

    {{-- PRODUK --}}
    <div
        class="rounded-3xl overflow-hidden transition duration-300 hover:-translate-y-2"
        style="
            background:white;
            box-shadow:var(--shadow);
        ">

        <div
            class="h-2"
            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-kuning),
                    var(--color-coklat)
                );
            ">
        </div>

        <div class="p-8">

            <p
                class="text-xs uppercase tracking-[4px] mb-4"
                style="color:var(--color-coklat);">

                Merchandise

            </p>

            <h3
                class="text-2xl font-bold mb-4"
                style="color:var(--color-hitam);">

                Produk Merchandise

            </h3>

            <p
                class="leading-7"
                style="color:var(--color-coklat);">

                CRUD produk, upload gambar, manajemen stok,
                kategori produk, poin reward dan status produk.

            </p>

            <div class="grid grid-cols-3 gap-4 mt-8">

                <div>
                    <p class="text-sm text-slate-500">
                        Total Produk
                    </p>

                    <h4 class="text-3xl font-bold text-red-600">
                        {{ $totalProduk }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-slate-500">
                        Total Stok
                    </p>

                    <h4 class="text-3xl font-bold">
                        {{ $totalStok }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-slate-500">
                        Aktif
                    </p>

                    <h4 class="text-3xl font-bold text-green-600">
                        {{ $produkAktif }}
                    </h4>
                </div>

            </div>

            <a
                href="{{ route('admin.merchandise.index') }}"
                class="inline-flex mt-8 px-6 py-3 rounded-xl text-white font-semibold transition hover:opacity-90"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

                Kelola Produk

            </a>

        </div>

    </div>


    {{-- ORDER --}}
    <div
        class="rounded-3xl overflow-hidden transition duration-300 hover:-translate-y-2"
        style="
            background:white;
            box-shadow:var(--shadow);
        ">

        <div
            class="h-2"
            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    #ef4444
                );
            ">
        </div>

        <div class="p-8">

            <p
                class="text-xs uppercase tracking-[4px] mb-4"
                style="color:var(--color-coklat);">

                Order

            </p>

            <h3
                class="text-2xl font-bold mb-4"
                style="color:var(--color-hitam);">

                Pesanan Merchandise

            </h3>

            <p
                class="leading-7"
                style="color:var(--color-coklat);">

                Verifikasi pembayaran, update status order,
                input nomor resi, dan kelola pengiriman.

            </p>

            <div class="grid grid-cols-3 gap-4 mt-8">

                <div>
                    <p class="text-sm text-slate-500">
                        Pesanan Baru
                    </p>

                    <h4 class="text-3xl font-bold text-yellow-500">
                        {{ $orderBaru }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-slate-500">
                        Diproses
                    </p>

                    <h4 class="text-3xl font-bold text-blue-600">
                        {{ $orderDiproses }}
                    </h4>
                </div>

                <div>
                    <p class="text-sm text-slate-500">
                        Selesai
                    </p>

                    <h4 class="text-3xl font-bold text-green-600">
                        {{ $orderSelesai }}
                    </h4>
                </div>

            </div>

            <a
                href="{{ route('admin.orders.index') }}"
                class="inline-flex mt-8 px-6 py-3 rounded-xl text-white font-semibold transition hover:opacity-90"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-coklat),
                        var(--color-kuning)
                    );
                ">

                Kelola Order

            </a>

        </div>

    </div>

</div>


{{-- QUICK ACTION --}}
<div class="grid md:grid-cols-3 gap-6 mt-10">

    <a href="{{ route('admin.merchandise.create') }}"
       class="rounded-3xl p-6 bg-white hover:-translate-y-1 transition"
       style="box-shadow:var(--shadow);">

        <div class="text-4xl mb-3">
            🛍️
        </div>

        <h3 class="font-bold text-lg mb-2">
            Tambah Produk
        </h3>

        <p class="text-slate-500">
            Tambahkan merchandise baru.
        </p>

    </a>

    <a href="{{ route('admin.orders.index') }}"
       class="rounded-3xl p-6 bg-white hover:-translate-y-1 transition"
       style="box-shadow:var(--shadow);">

        <div class="text-4xl mb-3">
            📦
        </div>

        <h3 class="font-bold text-lg mb-2">
            Cek Pesanan
        </h3>

        <p class="text-slate-500">
            Lihat seluruh pesanan terbaru.
        </p>

    </a>

       <a href="{{ route('admin.orders.index', [
            'status' => 'diproses'
        ]) }}"
       class="rounded-3xl p-6 bg-white hover:-translate-y-1 transition"
       style="box-shadow:var(--shadow);">

        <div class="text-4xl mb-3">
            🚚
        </div>

        <h3 class="font-bold text-lg mb-2">
            Pengiriman
        </h3>

        <p class="text-slate-500">
            Update nomor resi dan status kirim.
        </p>

    </a> 

</div>

@endsection