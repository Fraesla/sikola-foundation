@extends('layouts.app')

@section('content')

<!-- HERO -->
@if($bannerMerchandise->count() > 0)

<section class="relative">

    <div class="swiper merchandiseSwiper">

        <div class="swiper-wrapper">

            @foreach($bannerMerchandise as $banner)

            <div class="swiper-slide">

                <section class="relative min-h-[500px] flex items-center overflow-hidden">

                    <!-- Background -->
                    <img src="{{ asset('storage/'.$banner->gambar) }}"
                         class="absolute inset-0 w-full h-full object-cover"
                         alt="{{ $banner->judul }}">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/60"></div>

                    <!-- Content -->
                    <div class="relative z-10 container mx-auto px-6 text-center text-white">

                        <span
                            class="uppercase tracking-[4px]"
                            style="color: var(--color-kuning);">

                            Merchandise Resmi

                        </span>

                        <h1 class="text-5xl md:text-6xl font-bold mt-4">
                            {{ $banner->judul }}
                        </h1>

                        <p class="mt-6 max-w-3xl mx-auto text-lg text-gray-200">
                            {{ $banner->deskripsi }}
                        </p>

                        

                    </div>

                </section>

            </div>

            @endforeach

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

@else

<!-- HERO DEFAULT -->
<section
    class="py-24"
    style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
    ">

    <div class="container mx-auto px-6 text-center">

        <span
            class="uppercase tracking-[4px]"
            style="color: var(--color-kuning);">

            Merchandise Resmi

        </span>

        <h1 class="text-5xl font-bold mt-4 text-white">
            Merchandise Sikola Foundation
        </h1>

        <p
            class="mt-4 max-w-2xl mx-auto text-lg"
            style="color: rgba(249,246,240,.9);">

            Dukung program pendidikan dan sosial dengan membeli
            merchandise resmi Sikola Foundation.

        </p>

    </div>

</section>

@endif

<!-- FILTER -->
<section
    class="py-10"
    style="
        background-color: var(--color-putih);
        border-bottom: 2px solid rgba(212,160,23,.15);
    ">

    <div class="container mx-auto px-6">

        <div class="flex flex-wrap justify-center gap-3">

            {{-- Semua --}}
            <a
                href="{{ route('merchandise') }}"
                class="px-6 py-2 rounded-full font-semibold transition"
                style="
                    background-color:
                    {{ !request('kategori') ? 'var(--color-merah)' : 'rgba(212,160,23,.15)' }};

                    color:
                    {{ !request('kategori') ? 'white' : 'var(--color-hitam)' }};
                ">

                Semua

            </a>

            @foreach($categories as $category)

                <a
                    href="{{ route('merchandise', ['kategori' => $category]) }}"
                    class="px-6 py-2 rounded-full font-semibold transition"
                    style="
                        background-color:
                        {{ request('kategori') == $category
                            ? 'var(--color-merah)'
                            : 'rgba(212,160,23,.15)' }};

                        color:
                        {{ request('kategori') == $category
                            ? 'white'
                            : 'var(--color-hitam)' }};
                    ">

                    {{ $category }}

                </a>

            @endforeach

        </div>

    </div>

</section>

<!-- PRODUCT LIST -->
<section
    class="py-20"
    style="background-color: rgba(212,160,23,.08);">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

           @forelse($merchandises as $item)

            <div
                class="rounded-3xl overflow-hidden transition duration-300 hover:-translate-y-2"
                style="
                    background-color: white;
                    box-shadow: var(--shadow);
                ">

                {{-- Gambar --}}
                <img
                    src="{{ asset('storage/'.$item->gambar[0]) }}"
                    class="w-full h-64 object-cover"
                    alt="{{ $item->nama }}">

                <div class="p-6">

                    {{-- Kategori --}}
                    <span
                        class="inline-block px-3 py-1 rounded-full text-xs font-medium"
                        style="
                            background-color: rgba(212,160,23,.15);
                            color: var(--color-kuning);
                        ">

                        {{ $item->kategori }}

                    </span>

                    {{-- Nama --}}
                    <h3
                        class="font-bold text-xl mt-4"
                        style="color: var(--color-hitam);">

                        {{ $item->nama }}

                    </h3>

                    {{-- Deskripsi --}}
                    <p
                        class="mt-2 line-clamp-3"
                        style="color: var(--color-coklat);">

                        {{ \Illuminate\Support\Str::limit($item->deskripsi,100) }}

                    </p>

                    {{-- Harga --}}
                    <div
                        class="mt-4 text-2xl font-bold"
                        style="color: var(--color-merah);">

                        Rp {{ number_format($item->harga,0,',','.') }}

                    </div>

                    {{-- Stok --}}
                    <div
                        class="mt-2 text-sm"
                        style="color: var(--color-coklat);">

                        Stok :
                        <strong>{{ $item->stok }}</strong>

                    </div>

                    {{-- Poin --}}
                    <div
                        class="mt-1 text-sm"
                        style="color: var(--color-coklat);">

                        Reward :
                        <strong>{{ $item->poin_reward }} Poin</strong>

                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-5">

                        {{-- Tambah Keranjang --}}
                        <form action="{{ route('pembeli.keranjang.store') }}" method="POST">
                            @csrf

                            <input type="hidden"
                                   name="merchandise_id"
                                   value="{{ $item->id }}">

                            <button
                                type="submit"
                                class="w-full py-3 rounded-xl font-semibold"
                                style="background:var(--color-merah);color:white;">
                                🛒 Keranjang
                            </button>
                        </form>

                        {{-- Beli Sekarang --}}
                        <button
                            type="button"
                            onclick="checkoutNow({{ $item->id }},{{ $item->stok }})"
                            class="w-full py-3 rounded-xl font-semibold bg-green-600 hover:bg-green-700 text-white">
                            ⚡ Beli
                        </button>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-span-4">

                <div
                    class="bg-white rounded-3xl p-16 text-center"
                    style="box-shadow: var(--shadow);">

                    <div class="text-7xl mb-4">
                        🛍️
                    </div>

                    <h3 class="text-3xl font-bold">
                        Produk Tidak Ditemukan
                    </h3>

                    <p class="mt-3 text-slate-500">
                        Belum ada merchandise pada kategori ini.
                    </p>

                </div>

            </div>

            @endforelse

        </div>

        @if($merchandises->hasPages())
        <div class="mt-12">
            {{ $merchandises->links() }}
        </div>
        @endif

    </div>

</section>
<div id="checkoutModal"
     class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center">

    <div class="bg-white rounded-3xl p-8 w-[420px]">

        <h2 class="text-2xl font-bold">
            Checkout Produk
        </h2>

        <p class="text-slate-500 mt-2">
            Berapa jumlah yang ingin dibeli?
        </p>

        <form action="{{ route(auth()->user()->role . '.checkout.langsung') }}" method="POST">

            @csrf

            <input type="hidden"
                   id="checkoutProduct"
                   name="merchandise_id">

            <div class="mt-5">

                <label class="font-semibold">
                    Jumlah
                </label>

                <input
                    type="number"
                    id="checkoutQty"
                    name="qty"
                    value="1"
                    min="1"
                    class="w-full mt-2 rounded-xl border p-3">

                <small
                    id="stokInfo"
                    class="text-slate-500">
                </small>

            </div>

            <div class="flex gap-3 mt-8">

                <button
                    type="button"
                    onclick="closeCheckout()"
                    class="flex-1 py-3 rounded-xl bg-slate-200">
                    Batal
                </button>

                <button
                    type="submit"
                    class="flex-1 py-3 rounded-xl bg-green-600 text-white font-bold">
                    Checkout
                </button>

            </div>

        </form>

    </div>

</div>
<script>

function checkoutNow(id, stok)
{
    document
        .getElementById('checkoutModal')
        .classList
        .remove('hidden');

    document
        .getElementById('checkoutProduct')
        .value = id;

    let qty = document.getElementById('checkoutQty');

    qty.value = 1;
    qty.max = stok;

    document
        .getElementById('stokInfo')
        .innerHTML = "Stok tersedia : <b>"+stok+"</b>";
}

function closeCheckout()
{
    document
        .getElementById('checkoutModal')
        .classList
        .add('hidden');
}

</script>
@endsection
