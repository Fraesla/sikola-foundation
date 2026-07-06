@extends('layouts.app')

@section('content')

<!-- HERO -->
@if($bannerDonasi->count())

<section class="relative">

    <div class="swiper donasiSwiper">

        <div class="swiper-wrapper">

            @foreach($bannerDonasi as $banner)

            <div class="swiper-slide">

                <section class="relative h-[420px] md:h-[500px] overflow-hidden">

                    <!-- Background -->
                    <img src="{{ asset('storage/'.$banner->gambar) }}"
                         class="absolute inset-0 w-full h-full object-cover"
                         alt="{{ $banner->judul }}">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/60"></div>

                    <div class="relative z-20 flex items-center justify-center h-full">

                        <!-- Back Button -->
                        <a href="{{ url()->previous() }}"
                           class="absolute top-6 left-4 md:top-8 md:left-10 z-30 inline-flex items-center gap-3 px-5 py-3 rounded-xl"
                           style="
                                background: rgba(255,255,255,.12);
                                backdrop-filter: blur(10px);
                                border: 1px solid rgba(212,160,23,.5);
                                color: white;
                           ">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>

                            Back
                        </a>

                        <!-- Content -->
                        <div class="container mx-auto px-6 text-center text-white">

                            <span class="uppercase tracking-[4px]"
                                  style="color: var(--color-kuning);">
                                Donasi
                            </span>

                            <h1 class="text-4xl md:text-6xl font-bold mt-4">
                                {{ $banner->judul }}
                            </h1>

                            <p class="mt-5 max-w-3xl mx-auto text-lg">
                                {{ $banner->deskripsi }}
                            </p>

                        </div>

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
    class="relative py-24"
    style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
    ">

    <div class="container mx-auto px-6 text-center text-white">

        <a href="{{ url('/#program') }}"
           class="absolute top-8 left-10 z-20 inline-flex items-center gap-3 px-5 py-3 rounded-xl"
           style="
                background: rgba(255,255,255,.12);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(212,160,23,.5);
                color: var(--color-putih);
           ">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>

            Back
        </a>

        <span class="uppercase tracking-[4px]"
              style="color: var(--color-kuning);">
            Donasi
        </span>

        <h1 class="text-5xl md:text-6xl font-bold mt-4">
            Bersama Membawa Perubahan
        </h1>

        <p class="mt-5 max-w-3xl mx-auto text-lg"
           style="color: rgba(249,246,240,.9);">

            Setiap donasi yang Anda berikan membantu
            mendukung program pendidikan, kegiatan sosial,
            dan pemberdayaan masyarakat yang dijalankan
            oleh Sikola Foundation.

        </p>

    </div>

</section>

@endif
<!-- KATEGORI DONASI -->
<section class="py-20 bg-white">

    <div class="container mx-auto px-6">

        <div class="text-center mb-14">

            <span class="uppercase tracking-[4px]"
                  style="color: var(--color-kuning);">
                Program Donasi
            </span>

            <h2 class="text-4xl font-bold mt-3"
                style="color: var(--color-hitam);">

                Pilih Program Donasi

            </h2>

            <p class="mt-4 max-w-2xl mx-auto"
               style="color: var(--color-coklat);">

                Setiap kontribusi Anda akan membantu
                mendukung berbagai program sosial dan pendidikan.

            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($kategoriDonasi as $item)

            <div
                class="group rounded-3xl overflow-hidden transition duration-300 hover:-translate-y-2"
                style="
                    background:white;
                    box-shadow: var(--shadow);
                ">

                <!-- Image -->
                <div class="relative h-60 overflow-hidden">

                    <img
                        src="{{ asset('storage/'.$item->gambar) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                    <div class="absolute bottom-5 left-5">

                        <span
                            class="px-4 py-2 rounded-full text-sm font-semibold"
                            style="
                                background: rgba(255,255,255,.15);
                                backdrop-filter: blur(10px);
                                color: white;
                            ">

                            {{ $item->lokasi }}

                        </span>

                    </div>

                </div>

                <!-- Content -->
                <div class="p-7">

                    <h3
                        class="text-2xl font-bold group-hover:text-red-600 transition"
                        style="color: var(--color-hitam);">

                        {{ $item->nama }}

                    </h3>

                    <p
                        class="mt-3 line-clamp-3"
                        style="color: var(--color-coklat);">

                        {{ $item->deskripsi }}

                    </p>

                    <!-- Info -->
                    <div class="mt-6 space-y-3">

                        <div class="flex justify-between">

                            <span style="color: var(--color-coklat)">
                                Minimal
                            </span>

                            <strong style="color: var(--color-merah)">
                                Rp {{ number_format($item->minimal_donasi,0,',','.') }}
                            </strong>

                        </div>

                        <div class="flex justify-between">

                            <span style="color: var(--color-coklat)">
                                Target
                            </span>

                            <strong style="color: var(--color-kuning)">
                                Rp {{ number_format($item->target_default,0,',','.') }}
                            </strong>

                        </div>

                    </div>

                    <a
                        href="{{ route('admin.donasiDetail',$item->slug) }}"
                        class="block w-full text-center mt-8 py-4 rounded-2xl font-semibold transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                            color:white;
                        ">

                        ❤️ Donasi Sekarang

                    </a>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

<!-- CTA -->
<section
    class="py-24"
    style="background-color: rgba(212,160,23,.08);">

    <div class="container mx-auto px-6">

        <div
            class="rounded-3xl p-12 text-center"
            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
            ">

            <h2
                class="text-4xl font-bold"
                style="color: var(--color-putih);">

                Terima Kasih Atas Dukungan Anda

            </h2>

            <p
                class="mt-4 max-w-2xl mx-auto"
                style="color: rgba(249,246,240,.9);">

                Bersama kita dapat menciptakan dampak yang
                lebih besar bagi pendidikan, sosial,
                dan masyarakat Indonesia.

            </p>

        </div>

    </div>

</section>

@endsection
