@extends('layouts.app')

@section('content')

<!-- HERO -->
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

                    <a
                        href="#"
                        class="block text-center w-full mt-5 py-3 rounded-xl font-semibold transition"
                        style="
                            background-color: var(--color-merah);
                            color: var(--color-putih);
                        ">

                        🛒 Tambah ke Keranjang

                    </a>

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

@endsection
