@extends('layouts.app')

@section('content')

<!-- HERO SLIDER kalau ada data banner-->
@if($banners->count())
<section class="relative">

    <div class="swiper heroSwiper">

        <div class="swiper-wrapper">

            @foreach($banners as $hero)

            <div class="swiper-slide">

                <div class="relative h-[700px]">

                    <img src="{{ asset('storage/'.$hero->gambar) }}"
                         class="absolute inset-0 w-full h-full object-cover"
                         alt="{{ $hero->judul }}">

                    <div class="absolute inset-0 bg-black/60"></div>

                    <div class="relative z-10 h-full flex items-center">

                        <div class="container mx-auto px-6">

                            <div class="max-w-4xl">

                                <span
                                    class="inline-flex px-4 py-2 rounded-full text-sm font-semibold"
                                    style="
                                        background-color: var(--color-kuning);
                                        color: var(--color-hitam);
                                    ">
                                    ✨ Sikola Foundation
                                </span>

                                <h1 class="mt-6 text-5xl md:text-7xl font-bold text-white">
                                    {{ $hero->judul }}
                                </h1>

                                <p class="mt-6 text-lg text-gray-200">
                                    {{ $hero->deskripsi }}
                                </p>

                                <div class="mt-8 flex gap-4">

                                    <a href="/donasi"
                                       class="px-8 py-4 rounded-xl font-semibold"
                                       style="
                                            background-color: var(--color-merah);
                                            color:white;
                                       ">
                                        Donasi Sekarang
                                    </a>

                                    <a href="#program"
                                       class="px-8 py-4 rounded-xl font-semibold"
                                       style="
                                            background-color: var(--color-kuning);
                                            color: var(--color-hitam);
                                       ">
                                        Lihat Program
                                    </a>

                                    @if($hero->url_tautan)
                                    <a href="{{ $hero->url_tautan }}"
                                       class="px-8 py-4 rounded-xl font-semibold"
                                       style="
                                            background-color: var(--color-hitam);
                                            color: var(--color-putih);
                                       ">
                                        Selengkapnya
                                    </a>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev hero-prev"></div>
        <div class="swiper-button-next hero-next"></div>

    </div>

</section>
<!-- HERO SLIDER  jika nggak ada data banner-->
@else
<section class="relative">

    <div class="swiper heroSwiper">

        <div class="swiper-wrapper">

            <!-- Slide 1 -->
            <div class="swiper-slide">

                <div class="relative h-[700px]">

                    <img
                        src="https://images.unsplash.com/photo-1509062522246-3755977927d7"
                        class="absolute inset-0 w-full h-full object-cover"
                        alt="">

                    <div class="absolute inset-0 bg-black/60"></div>

                    <div class="relative z-10 h-full flex items-center">

                        <div class="container mx-auto px-6">

                            <div class="max-w-3xl">

                                <span class="inline-flex px-4 py-2 rounded-full text-sm font-semibold"
                                style="
                                    background-color: var(--color-kuning);
                                    color: var(--color-hitam);">
                                        ✨ Sikola Foundation
                                </span>

                                <h1
                                    class="mt-6 text-5xl md:text-7xl font-bold text-white leading-tight">

                                    Bersama Membangun Masa Depan Pendidikan Indonesia

                                </h1>

                                <p
                                    class="mt-6 text-lg md:text-xl text-gray-200">

                                    Dukung program pendidikan, beasiswa,
                                    dan pemberdayaan masyarakat untuk
                                    generasi yang lebih baik.

                                </p>

                                <div class="mt-8 flex flex-wrap gap-4">

                                    <a href="/donasi"
                                       class="px-8 py-4 rounded-xl font-semibold transition hover:scale-105"
                                       style="
                                          background-color: var(--color-merah);
                                          color: var(--color-putih); ">
                                            Donasi Sekarang
                                    </a>

                                    <a href="#program"
                                       class="px-8 py-4 rounded-xl font-semibold transition hover:scale-105"
                                       style="
                                          background-color: var(--color-kuning);
                                          color: var(--color-hitam);">
                                            Lihat Program
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">

                <div class="relative h-[700px]">

                    <img
                        src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                        class="absolute inset-0 w-full h-full object-cover"
                        alt="">

                    <div class="absolute inset-0 bg-black/60"></div>

                    <div class="relative z-10 h-full flex items-center">

                        <div class="container mx-auto px-6">

                            <div class="max-w-3xl">

                                <h1
                                    class="text-5xl md:text-7xl font-bold text-white">

                                    Beasiswa Untuk Generasi Berprestasi

                                </h1>

                                <p
                                    class="mt-5 text-xl text-gray-200">

                                    Membantu siswa dan mahasiswa
                                    meraih pendidikan terbaik.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">

                <div class="relative h-[700px]">

                    <img
                        src="https://images.unsplash.com/photo-1517048676732-d65bc937f952"
                        class="absolute inset-0 w-full h-full object-cover"
                        alt="">

                    <div class="absolute inset-0 bg-black/60"></div>

                    <div class="relative z-10 h-full flex items-center">

                        <div class="container mx-auto px-6">

                            <div class="max-w-3xl">

                                <h1
                                    class="text-5xl md:text-7xl font-bold text-white">

                                    Menjadi Relawan Untuk Perubahan

                                </h1>

                                <p
                                    class="mt-5 text-xl text-gray-200">

                                    Bersama membangun dampak sosial
                                    yang berkelanjutan.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="swiper-pagination"></div>

        <div class="swiper-button-prev hero-prev"></div>
        <div class="swiper-button-next hero-next"></div>

    </div>

</section>
@endif

<!-- PROGRAM -->
<section id="program" class="py-24 bg-white" style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="text-center mb-16">

            <span class="text-blue-600 font-semibold" style="color: var(--color-merah);">
                PROGRAM KAMI
            </span>

            <h2 class="text-4xl font-bold mt-2">
                Program Unggulan Sikola Foundation
            </h2>

            <p class="mt-4 text-slate-500">
                Program yang memberikan dampak nyata bagi masyarakat.
            </p>

        </div>

        <div class="grid md:grid-cols-3 gap-8">

        <!-- EVENT -->
        <a href="{{ url('/event') }}"
           class="group block">

            <div
                class="p-8 rounded-3xl border hover:shadow-xl hover:-translate-y-2 transition-all duration-300 h-full" style="background-color: var(--color-putih); border-color: var(--color-coklat);">

                <div
                    class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl" style="background-color:#FCE8E8;">
                    🎉
                </div>

                <div class="group">
                    <h3 class="text-2xl font-bold mt-6
                               text-[var(--color-hitam)]
                               group-hover:text-[var(--color-merah)]">
                        Event
                    </h3>
                </div>

                <p class="mt-4 text-slate-600">
                    Berbagai kegiatan sosial, edukasi, seminar,
                    workshop, dan event komunitas yang memberikan
                    dampak positif bagi masyarakat.
                </p>

                <div class="flex justify-between items-center mt-6">

                    <span class="font-medium text-[var(--color-merah)]">
                        Selengkapnya
                    </span>

                    <span class="text-xl text-[var(--color-merah)]">
                        →
                    </span>

                </div>

            </div>

        </a>

        <!-- DONASI -->
        <a href="{{ url('/donasi') }}"
           class="group block">

            <div
                class="p-8 rounded-3xl border hover:shadow-xl hover:-translate-y-2 transition-all duration-300 h-full" style="background-color: var(--color-putih); border-color: var(--color-coklat);">

                <div
                    class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl" style="background-color:#FFF3D4;">

                    💝

                </div>

                <h3 class="text-2xl font-bold mt-6 group-hover:text-green-600" >
                    Donasi
                </h3>

                <p class="mt-4 text-slate-600">
                    Salurkan bantuan untuk mendukung program pendidikan,
                    kegiatan sosial, dan pemberdayaan masyarakat melalui
                    donasi yang transparan.
                </p>

                <div class="flex justify-between items-center mt-6">

                    <span class="font-medium text-[var(--color-merah)]">
                        Selengkapnya
                    </span>

                    <span class="text-xl text-[var(--color-merah)]">
                        →
                    </span>

                </div>

            </div>

        </a>

        <!-- MEMBERSHIP -->
        <a href="{{ url('/relawan') }}"
           class="group block">

            <div
                class="p-8 rounded-3xl border hover:shadow-xl hover:-translate-y-2 transition-all duration-300 h-full" style="background-color: var(--color-putih); border-color: var(--color-coklat);">

                <div
                    class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl" style="background-color:#F5E8DA;">

                    🤝

                </div>

                <h3 class="text-2xl font-bold mt-6 group-hover:text-orange-600">
                    Relawan / Membership
                </h3>

                <p class="mt-4 text-slate-600">
                    Bergabung sebagai relawan dalam berbagai kegiatan
                    sosial, pendidikan, dan kemanusiaan bersama
                    Sikola Foundation.
                </p>

                <div class="flex justify-between items-center mt-6">

                    <span class="font-medium text-[var(--color-merah)]">
                        Selengkapnya
                    </span>

                    <span class="text-xl text-[var(--color-merah)]">
                        →
                    </span>

                </div>

            </div>

        </a>

    </div>

</div>

    </div>

</section>

<!-- STATISTIK -->
<section class="py-20" style="background-color: var(--color-merah); color:var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 text-center">

            <div>

                <h3 class="text-5xl font-bold">
                    12M+
                </h3>

                <p class="mt-3">
                    Dana Terkumpul
                </p>

            </div>

            <div>

                <h3 class="text-5xl font-bold">
                    5.200+
                </h3>

                <p class="mt-3">
                    Donatur Aktif
                </p>

            </div>

            <div>

                <h3 class="text-5xl font-bold">
                    150+
                </h3>

                <p class="mt-3">
                    Program Berjalan
                </p>

            </div>

            <div>

                <h3 class="text-5xl font-bold">
                    80+
                </h3>

                <p class="mt-3">
                    Volunteer
                </p>

            </div>

        </div>

    </div>

</section>

<!-- CTA -->
<section
    class="py-24"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div
            class="relative overflow-hidden rounded-[32px] p-12 md:p-16 text-center shadow-xl"
            style="background-color: var(--color-coklat);">

            <!-- Ornament -->
            <div
                class="absolute -top-20 -right-20 w-72 h-72 rounded-full opacity-10"
                style="background-color: var(--color-kuning);">
            </div>

            <div
                class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full opacity-10"
                style="background-color: var(--color-kuning);">
            </div>

            <div class="relative z-10">

                <span
                    class="inline-flex px-4 py-2 rounded-full text-sm font-semibold mb-6"
                    style="
                        background-color: rgba(212,160,23,.15);
                        color: var(--color-kuning);">

                    ✨ Mari Berkolaborasi

                </span>

                <h2
                    class="text-4xl md:text-5xl font-bold leading-tight"
                    style="color: var(--color-putih);">

                    Bersama Kita Ciptakan Dampak Nyata
                    Untuk Pendidikan dan Masyarakat

                </h2>

                <p
                    class="mt-6 text-lg max-w-3xl mx-auto"
                    style="color: #F9F6F0;">

                    Sikola Foundation membuka peluang kolaborasi,
                    program CSR, relawan, dan dukungan donasi
                    untuk membangun masa depan yang lebih baik.

                </p>

                <div
                    class="mt-10 flex flex-wrap justify-center gap-4">

                    <a href="{{ url('/kontak') }}"
                       class="px-8 py-4 rounded-xl font-bold transition hover:-translate-y-1"
                       style="
                            background-color: var(--color-kuning);
                            color: var(--color-hitam);">

                        📞 Hubungi Kami

                    </a>

                    <a href="{{ url('/relawan') }}"
                       class="px-8 py-4 rounded-xl font-bold border transition hover:bg-white/10"
                       style="
                            border-color: var(--color-putih);
                            color: var(--color-putih);">

                        🤝 Menjadi Relawan

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection