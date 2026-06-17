@extends('layouts.app')

@section('content')

<!-- HERO SLIDER -->
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

                                <span
                                    class="inline-flex bg-blue-600 text-white px-4 py-2 rounded-full text-sm">
                                    Sikola Foundation
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

                                    <a href="/donation"
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold">

                                        Donasi Sekarang

                                    </a>

                                    <a href="#program"
                                       class="bg-white text-slate-800 px-8 py-4 rounded-xl font-semibold">

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

        <div class="swiper-button-prev text-white"></div>
        <div class="swiper-button-next text-white"></div>

    </div>

</section>

<!-- PROGRAM -->
<section id="program" class="py-24 bg-white">

    <div class="container mx-auto px-6">

        <div class="text-center mb-16">

            <span class="text-blue-600 font-semibold">
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
                class="bg-slate-50 p-8 rounded-3xl border hover:shadow-xl hover:-translate-y-2 transition-all duration-300 h-full">

                <div
                    class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">

                    🎉

                </div>

                <h3 class="text-2xl font-bold mt-6 group-hover:text-blue-600">
                    Event
                </h3>

                <p class="mt-4 text-slate-600">
                    Berbagai kegiatan sosial, edukasi, seminar,
                    workshop, dan event komunitas yang memberikan
                    dampak positif bagi masyarakat.
                </p>

                <div class="flex justify-between items-center mt-6">

                    <span class="font-medium text-blue-600">
                        Selengkapnya
                    </span>

                    <span class="text-xl">
                        →
                    </span>

                </div>

            </div>

        </a>

        <!-- DONASI -->
        <a href="{{ url('/donasi') }}"
           class="group block">

            <div
                class="bg-slate-50 p-8 rounded-3xl border hover:shadow-xl hover:-translate-y-2 transition-all duration-300 h-full">

                <div
                    class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">

                    💝

                </div>

                <h3 class="text-2xl font-bold mt-6 group-hover:text-green-600">
                    Donasi
                </h3>

                <p class="mt-4 text-slate-600">
                    Salurkan bantuan untuk mendukung program pendidikan,
                    kegiatan sosial, dan pemberdayaan masyarakat melalui
                    donasi yang transparan.
                </p>

                <div class="flex justify-between items-center mt-6">

                    <span class="font-medium text-blue-600">
                        Selengkapnya
                    </span>

                    <span class="text-xl">
                        →
                    </span>

                </div>

            </div>

        </a>

        <!-- MEMBERSHIP -->
        <a href="{{ url('/relawan') }}"
           class="group block">

            <div
                class="bg-slate-50 p-8 rounded-3xl border hover:shadow-xl hover:-translate-y-2 transition-all duration-300 h-full">

                <div
                    class="w-16 h-16 rounded-2xl bg-orange-100 flex items-center justify-center text-3xl">

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

                    <span class="font-medium text-blue-600">
                        Selengkapnya
                    </span>

                    <span class="text-xl">
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
<section class="py-20 bg-blue-600 text-white">

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
<section class="py-24 bg-slate-50">

    <div class="container mx-auto px-6">

        <div
            class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-3xl p-12 md:p-16 text-center text-white">

            <h2 class="text-4xl md:text-5xl font-bold">
                Hubungi Kami Untuk Informasi Lebih Lanjut
            </h2>

            <p class="mt-6 text-lg text-blue-100 max-w-3xl mx-auto">
                Ingin berkolaborasi, menjadi volunteer, atau mengetahui lebih lanjut
                tentang program Sikola Foundation? Tim kami siap membantu Anda.
            </p>

            <div class="mt-10">

                <a href="{{ url('/kontak') }}"
                   class="inline-flex items-center gap-2 bg-white text-blue-700 px-10 py-4 rounded-xl font-bold text-lg hover:shadow-xl transition">

                    📞 Kontak Kami

                </a>

            </div>

        </div>

    </div>

</section>

@endsection