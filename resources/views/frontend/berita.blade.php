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

    <div class="container mx-auto px-6 text-center text-white">

        <span
            class="uppercase tracking-[4px]"
            style="color: var(--color-kuning);">
            Berita & Artikel
        </span>

        <h1 class="text-5xl font-bold mt-4">
            Informasi Terbaru
        </h1>

        <p
            class="mt-4 max-w-2xl mx-auto text-lg"
            style="color: rgba(249,246,240,.9);">
            Ikuti perkembangan kegiatan, event, program donasi,
            dan berbagai informasi terbaru dari Sikola Foundation.
        </p>

    </div>

</section>

<!-- FILTER -->
<section
    class="py-10"
    style="
        background-color: var(--color-putih);
        border-bottom: 2px solid rgba(212,160,23,.2);
    ">

    <div class="container mx-auto px-6">

        <div class="flex flex-wrap gap-3 justify-center">

            <button
                class="px-5 py-2 rounded-full font-medium"
                style="
                    background-color: var(--color-merah);
                    color: var(--color-putih);
                ">
                Semua
            </button>

           <button
                class="px-5 py-2 rounded-full transition"
                style="
                    background-color: rgba(212,160,23,.15);
                    color: var(--color-hitam);
                ">
                Event
            </button>

            <button
                class="px-5 py-2 rounded-full transition"
                style="
                    background-color: rgba(212,160,23,.15);
                    color: var(--color-hitam);
                ">
                Donasi
            </button>

            <button
                class="px-5 py-2 rounded-full transition"
                style="
                    background-color: rgba(212,160,23,.15);
                    color: var(--color-hitam);
                ">
                Volunteer
            </button>

            <button
                class="px-5 py-2 rounded-full transition"
                style="
                    background-color: rgba(212,160,23,.15);
                    color: var(--color-hitam);
                ">
                Pendidikan
            </button>

        </div>

    </div>

</section>

<!-- LIST BERITA -->
<section
    class="py-20"
    style="
        background-color: rgba(212,160,23,.08);
    ">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Artikel 1 -->
            <article class="news-card">

                <img
                    src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                    class="w-full h-56 object-cover"
                    alt=""
                >

                <div class="p-6">

                    <span class="badge-event px-3 py-1 rounded-full text-sm">
                        Event
                    </span>

                    <h3 class="news-title text-xl font-bold mt-4">
                        Seminar Pendidikan Untuk Generasi Muda
                    </h3>

                    <p class="news-text mt-3">
                        Kegiatan seminar pendidikan yang diikuti
                        oleh ratusan peserta dari berbagai daerah.
                    </p>

                    <a
                        href="{{ url('/berita/seminar-pendidikan-generasi-muda') }}"
                        class="news-link inline-flex items-center gap-2 mt-5"
                    >
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 2 -->
            <article class="news-card">

                 <img
                    src="https://images.unsplash.com/photo-1509099836639-18ba1795216d"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span class="badge-donasi px-3 py-1 rounded-full text-sm">
                        Donasi
                    </span>

                    <h3 class="news-title text-xl font-bold mt-4">
                        Penyaluran Donasi Untuk Sekolah Pedalaman
                    </h3>

                    <p class="news-text mt-3">
                        Bantuan perlengkapan sekolah berhasil
                        disalurkan kepada siswa di daerah terpencil.
                    </p>

                    <a
                        href="{{ url('/berita/penyaluran-donasi-untuk-sekolah-pedalaman') }}"
                        class="news-link inline-flex items-center gap-2 mt-5"
                    >
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 3 -->
            <article class="news-card">

                 <img
                    src="https://images.unsplash.com/photo-1517048676732-d65bc937f952"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span class="badge-volunteer px-3 py-1 rounded-full text-sm">
                        Volunteer
                    </span>

                    <h3 class="news-title text-xl font-bold mt-4">
                        Pelatihan Volunteer Sikola Foundation
                    </h3>

                    <p class="news-text mt-3">
                        Mempersiapkan relawan untuk mendukung
                        berbagai program sosial dan pendidikan.
                    </p>

                    <a
                        href="{{ url('/berita/pelatihan-volunteer-sikola-foundation') }}"
                        class="news-link inline-flex items-center gap-2 mt-5"
                    >
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 4 -->
            <article class="news-card">

                 <img
                    src="https://images.unsplash.com/photo-1497486751825-1233686d5d80"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span class="badge-pendidikan px-3 py-1 rounded-full text-sm">
                        Pendidikan
                    </span>

                    <h3 class="news-title text-xl font-bold mt-4">
                        Program Literasi Anak Usia Dini
                    </h3>

                    <p class="news-text mt-3">
                        Program membaca dan belajar yang dirancang
                        untuk meningkatkan minat literasi anak.
                    </p>

                    <a
                        href="{{ url('/berita/program-literasi-anak-usia-dini') }}"
                        class="news-link inline-flex items-center gap-2 mt-5"
                    >
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 5 -->
            <article class="news-card">

                 <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7" alt="" class="w-full h-56 object-cover">

                <div class="p-6">

                    <span class="badge-event px-3 py-1 rounded-full text-sm">
                        Event
                    </span>

                    <h3 class="news-title text-xl font-bold mt-4">
                        Workshop Teknologi Untuk Pelajar
                    </h3>

                    <p class="news-text mt-3">
                        Workshop pengenalan teknologi dan coding
                        bagi siswa tingkat SMA.
                    </p>

                    <a
                        href="{{ url('/berita/workshop-teknologi-untuk-pelajar') }}"
                        class="news-link inline-flex items-center gap-2 mt-5"
                    >
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

            <!-- Artikel 6 -->
            <article class="news-card">

                 <img
                    src="https://images.unsplash.com/photo-1469571486292-b53601020f1d"
                    alt=""
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    <span class="badge-donasi px-3 py-1 rounded-full text-sm">
                        Donasi
                    </span>

                    <h3 class="news-title text-xl font-bold mt-4">
                        Donasi Buku Untuk Rumah Belajar
                    </h3>

                    <p class="news-text mt-3">
                        Pengumpulan dan distribusi buku bacaan
                        bagi anak-anak di berbagai daerah.
                    </p>

                    <a
                        href="{{ url('/berita/donasi-buku-untuk-rumah-belajar') }}"
                        class="news-link inline-flex items-center gap-2 mt-5"
                    >
                        Baca Selengkapnya →
                    </a>

                </div>

            </article>

        </div>

        <!-- PAGINATION -->
        <div class="flex justify-center mt-16">

            <nav class="flex items-center gap-2">

                <a href="#"
class="w-10 h-10 rounded-xl flex items-center justify-center transition"
style="
    border: 1px solid var(--color-kuning);
    color: var(--color-hitam);
">
                    ‹
                </a>

               <a href="#"
class="w-10 h-10 rounded-xl flex items-center justify-center"
style="
    background-color: var(--color-merah);
    color: var(--color-putih);
">
    1
</a>

                <a href="#"
class="w-10 h-10 rounded-xl flex items-center justify-center transition"
style="
    border: 1px solid var(--color-kuning);
    color: var(--color-hitam);
">
    2
</a>

               <a href="#"
class="w-10 h-10 rounded-xl flex items-center justify-center transition"
style="
    border: 1px solid var(--color-kuning);
    color: var(--color-hitam);
">
                    3
                </a>

                <a href="#"
class="w-10 h-10 rounded-xl flex items-center justify-center transition"
style="
    border: 1px solid var(--color-kuning);
    color: var(--color-hitam);
">
                    ›
                </a>

            </nav>

        </div>

    </div>

</section>

@endsection