@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="bg-gradient-to-r from-blue-600 to-cyan-500 py-20">

    <div class="container mx-auto px-6 text-center text-white">

        <span class="uppercase tracking-widest text-blue-100">
            Berita & Artikel
        </span>

        <h1 class="text-5xl font-bold mt-4">
            Informasi Terbaru
        </h1>

        <p class="mt-4 text-blue-100 max-w-2xl mx-auto">
            Ikuti perkembangan kegiatan, event, program donasi,
            dan berbagai informasi terbaru dari Sikola Foundation.
        </p>

    </div>

</section>

<!-- FILTER -->
<section class="py-10 bg-white border-b">

    <div class="container mx-auto px-6">

        <div class="flex flex-wrap gap-3 justify-center">

            <button
                class="px-5 py-2 rounded-full bg-blue-600 text-white font-medium">
                Semua
            </button>

            <button
                class="px-5 py-2 rounded-full bg-slate-100 hover:bg-slate-200">
                Event
            </button>

            <button
                class="px-5 py-2 rounded-full bg-slate-100 hover:bg-slate-200">
                Donasi
            </button>

            <button
                class="px-5 py-2 rounded-full bg-slate-100 hover:bg-slate-200">
                Volunteer
            </button>

            <button
                class="px-5 py-2 rounded-full bg-slate-100 hover:bg-slate-200">
                Pendidikan
            </button>

        </div>

    </div>

</section>

<!-- LIST BERITA -->
<section class="py-20 bg-slate-50">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Artikel 1 -->
            <article
                class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                <img
                    src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span
                        class="inline-block px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-600">
                        Event
                    </span>

                    <h3 class="text-xl font-bold mt-4">
                        Seminar Pendidikan Untuk Generasi Muda
                    </h3>

                    <p class="text-slate-600 mt-3">
                        Kegiatan seminar pendidikan yang diikuti
                        oleh ratusan peserta dari berbagai daerah.
                    </p>

                    <a href="{{ url('/berita/seminar-pendidikan-generasi-muda') }}"
                       class="inline-flex mt-5 text-blue-600 font-semibold">
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 2 -->
            <article
                class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                <img
                    src="https://images.unsplash.com/photo-1509099836639-18ba1795216d"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span
                        class="inline-block px-3 py-1 rounded-full text-sm bg-green-100 text-green-600">
                        Donasi
                    </span>

                    <h3 class="text-xl font-bold mt-4">
                        Penyaluran Donasi Untuk Sekolah Pedalaman
                    </h3>

                    <p class="text-slate-600 mt-3">
                        Bantuan perlengkapan sekolah berhasil
                        disalurkan kepada siswa di daerah terpencil.
                    </p>

                    <a href="{{ url('/berita/penyaluran-donasi-untuk-sekolah-pedalaman') }}"
                       class="inline-flex mt-5 text-blue-600 font-semibold">
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 3 -->
            <article
                class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                <img
                    src="https://images.unsplash.com/photo-1517048676732-d65bc937f952"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span
                        class="inline-block px-3 py-1 rounded-full text-sm bg-orange-100 text-orange-600">
                        Volunteer
                    </span>

                    <h3 class="text-xl font-bold mt-4">
                        Pelatihan Volunteer Sikola Foundation
                    </h3>

                    <p class="text-slate-600 mt-3">
                        Mempersiapkan relawan untuk mendukung
                        berbagai program sosial dan pendidikan.
                    </p>

                    <a href="{{ url('/berita/pelatihan-volunteer-sikola-foundation') }}"
                       class="inline-flex mt-5 text-blue-600 font-semibold">
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 4 -->
            <article
                class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                <img
                    src="https://images.unsplash.com/photo-1497486751825-1233686d5d80"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span
                        class="inline-block px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-600">
                        Pendidikan
                    </span>

                    <h3 class="text-xl font-bold mt-4">
                        Program Literasi Anak Usia Dini
                    </h3>

                    <p class="text-slate-600 mt-3">
                        Program membaca dan belajar yang dirancang
                        untuk meningkatkan minat literasi anak.
                    </p>

                    <a href="{{ url('/berita/program-literasi-anak-usia-dini') }}"
                       class="inline-flex mt-5 text-blue-600 font-semibold">
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 5 -->
            <article
                class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                <img
                    src="https://images.unsplash.com/photo-1509062522246-3755977927d7"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span
                        class="inline-block px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-600">
                        Event
                    </span>

                    <h3 class="text-xl font-bold mt-4">
                        Workshop Teknologi Untuk Pelajar
                    </h3>

                    <p class="text-slate-600 mt-3">
                        Workshop pengenalan teknologi dan coding
                        bagi siswa tingkat SMA.
                    </p>

                    <a href="{{ url('/berita/workshop-teknologi-untuk-pelajar') }}"
                       class="inline-flex mt-5 text-blue-600 font-semibold">
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 6 -->
            <article
                class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                <img
                    src="https://images.unsplash.com/photo-1469571486292-b53601020f1d"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span
                        class="inline-block px-3 py-1 rounded-full text-sm bg-green-100 text-green-600">
                        Donasi
                    </span>

                    <h3 class="text-xl font-bold mt-4">
                        Donasi Buku Untuk Rumah Belajar
                    </h3>

                    <p class="text-slate-600 mt-3">
                        Pengumpulan dan distribusi buku bacaan
                        bagi anak-anak di berbagai daerah.
                    </p>

                    <a href="{{ url('/berita/donasi-buku-untuk-rumah-belajar') }}"
                       class="inline-flex mt-5 text-blue-600 font-semibold">
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

        </div>

        <!-- PAGINATION -->
        <div class="flex justify-center mt-16">

            <nav class="flex items-center gap-2">

                <a href="#"
                   class="w-10 h-10 rounded-xl border flex items-center justify-center hover:bg-slate-100">
                    ‹
                </a>

                <a href="#"
                   class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                    1
                </a>

                <a href="#"
                   class="w-10 h-10 rounded-xl border flex items-center justify-center hover:bg-slate-100">
                    2
                </a>

                <a href="#"
                   class="w-10 h-10 rounded-xl border flex items-center justify-center hover:bg-slate-100">
                    3
                </a>

                <a href="#"
                   class="w-10 h-10 rounded-xl border flex items-center justify-center hover:bg-slate-100">
                    ›
                </a>

            </nav>

        </div>

    </div>

</section>

@endsection