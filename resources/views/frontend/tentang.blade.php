@extends('layouts.app')

@section('content')

@if($bannerTentang->count() > 0)

<section class="relative">

        <div class="swiper tentangSwiper">

        <div class="swiper-wrapper">

            @foreach($bannerTentang as $banner)

            <div class="swiper-slide">

                <section class="relative py-32">

                    <!-- Background -->
                    <img src="{{ asset('storage/'.$banner->gambar) }}"
                         class="absolute inset-0 w-full h-full object-cover"
                         alt="{{ $banner->judul }}">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/60"></div>

                    <!-- Content -->
                    <div class="relative z-10 container mx-auto px-6 text-center text-white">

                        <span class="uppercase tracking-[4px]"
                              style="color: var(--color-kuning);">

                            Tentang Kami

                        </span>

                        <h1 class="text-5xl md:text-6xl font-bold mt-4">
                            {{ $banner->judul }}
                        </h1>

                        <p class="mt-6 max-w-3xl mx-auto text-xl">
                            {{ $banner->deskripsi }}
                        </p>

                        @if($banner->url_tautan)
                            <a href="{{ $banner->url_tautan }}"
                               class="inline-block mt-8 px-8 py-3 rounded-xl font-semibold"
                               style="
                                    background: var(--color-kuning);
                                    color: var(--color-hitam);
                               ">
                                Selengkapnya
                            </a>
                        @endif

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
<section class="py-28"
    style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
    ">

    <div class="container mx-auto px-6 text-center text-white">

        <span class="uppercase tracking-[4px]"
              style="color:var(--color-kuning);">
            Tentang Kami
        </span>

        <h1 class="text-5xl md:text-6xl font-bold mt-4">
            Sikola Foundation
        </h1>

        <p class="mt-6 max-w-3xl mx-auto text-xl"
           style="color: rgba(249,246,240,.9);">

            Yayasan yang berfokus pada pendidikan, kegiatan sosial,
            pengembangan masyarakat, dan pemberdayaan generasi muda.

        </p>

    </div>

</section>

@endif
<!-- SEJARAH -->
<section
    class="py-24"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div>

                <span class="font-semibold" style="color: var(--color-merah);">
                    SEJARAH YAYASAN
                </span>

                <h2 class="text-4xl font-bold mt-3" style="color: var(--color-hitam);">
                    Awal Berdirinya Sikola Foundation
                </h2>

                <p class="mt-6 leading-8" style="color: var(--color-coklat);">
                    Sikola Foundation didirikan dengan tujuan membantu
                    masyarakat memperoleh akses pendidikan yang lebih baik,
                    memperluas kesempatan belajar, dan mendukung kegiatan
                    sosial yang memberikan dampak positif bagi lingkungan.
                </p>

                <p class="mt-4  leading-8" style="color: var(--color-coklat);">
                    Sejak berdiri, yayasan telah melaksanakan berbagai
                    program pendidikan, pelatihan, donasi, kegiatan sosial,
                    serta kolaborasi dengan berbagai pihak untuk menciptakan
                    perubahan yang berkelanjutan.
                </p>

            </div>

            <div>

                <div
                class="rounded-3xl p-12"
                style="
                    background-color: rgba(212,160,23,.15);
                    border: 2px solid var(--color-kuning);
                ">

                    <div class="text-center">

                        <div class="text-6xl mb-4">
                            🏢
                        </div>

                        <h3 class="text-2xl font-bold" style="color: var(--color-hitam);">
                            Berdiri Sejak 2025
                        </h3>

                        <p class="mt-3 " style="color: var(--color-coklat);">
                            Berkomitmen memberikan kontribusi nyata
                            melalui pendidikan dan kegiatan sosial.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- VISI MISI -->
<section
    class="py-24"
    style="
        background-color: rgba(212,160,23,.08);
    ">

    <div class="container mx-auto px-6">

        <div class="text-center mb-16">

            <span class="font-semibold" style="color: var(--color-merah);">
                VISI & MISI
            </span>

            <h2 class="text-4xl font-bold mt-3">
                Arah dan Tujuan Yayasan
            </h2>

        </div>

        <div class="grid lg:grid-cols-2 gap-8">

            <!-- VISI -->
            <div
                class="rounded-3xl p-10"
                style="
                    background-color: var(--color-putih);
                    box-shadow: var(--shadow);
                    border-top: 5px solid var(--color-merah);">

                <div
                    class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"
                    style="
                        background-color: rgba(204,34,34,.15);
                    ">
                    🎯
                </div>

                <h3 class="text-3xl font-bold mt-6">
                    Visi
                </h3>

                <p class="mt-4  leading-8" style="color: var(--color-coklat);">
                    Menjadi yayasan yang berkontribusi dalam
                    meningkatkan kualitas pendidikan, sosial,
                    dan pemberdayaan masyarakat secara berkelanjutan.
                </p>

            </div>

            <!-- MISI -->
            <div
                class="rounded-3xl p-10"
                style="
                    background-color: var(--color-putih);
                    box-shadow: var(--shadow);
                    border-top: 5px solid var(--color-kuning);
                ">

                <div
                    class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"
                    style="
                        background-color: rgba(212,160,23,.15);
                    ">
                    🚀
                </div>

                <h3 class="text-3xl font-bold mt-6">
                    Misi
                </h3>

                <ul class="mt-4 space-y-3" style="color: var(--color-coklat);">

                    <li>✓ Menyelenggarakan program pendidikan.</li>

                    <li>✓ Mendorong kegiatan sosial kemasyarakatan.</li>

                    <li>✓ Memberikan dukungan melalui program donasi.</li>

                    <li>✓ Mengembangkan relawan dan anggota yayasan.</li>

                    <li>✓ Membangun kolaborasi dengan berbagai pihak.</li>

                </ul>

            </div>

        </div>

    </div>

</section>

<!-- TEAM -->
<section
    class="py-24"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="text-center mb-16">

            <span
                class="font-semibold"
                style="color: var(--color-merah);">
                TEAM MEMBER
            </span>

            <h2 class="text-4xl font-bold mt-3">
                Pengurus Yayasan
            </h2>

            <p class="mt-4 text-slate-500">
                Orang-orang yang berperan dalam menjalankan program yayasan.
            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Ketua -->
            <div
                class="rounded-3xl p-8 text-center transition"
                style="
                    background-color: var(--color-putih);
                    border: 1px solid rgba(212,160,23,.25);
                    box-shadow: var(--shadow);
                ">

                <div class="w-28 h-28 mx-auto rounded-full flex items-center justify-center text-5xl"
                    style="
                        background-color: rgba(204,34,34,.15);
                        border: 3px solid var(--color-merah);">
                    👨
                </div>

                <h3 class="font-bold text-xl mt-5">
                    Nama Ketua
                </h3>

                <p class="text-slate-500">
                    Ketua Yayasan
                </p>

            </div>

            <!-- Sekretaris -->
            <div
                class="rounded-3xl p-8 text-center transition"
                style="
                    background-color: var(--color-putih);
                    border: 1px solid rgba(212,160,23,.25);
                    box-shadow: var(--shadow);
                ">

                <div class="w-28 h-28 mx-auto rounded-full flex items-center justify-center text-5xl"
                    style="
                        background-color: rgba(212,160,23,.15);
                        border: 3px solid var(--color-kuning);
                    ">
                    👩
                </div>

                <h3 class="font-bold text-xl mt-5">
                    Nama Sekretaris
                </h3>

                <p class="text-slate-500">
                    Sekretaris
                </p>

            </div>

            <!-- Bendahara -->
            <div
                class="rounded-3xl p-8 text-center transition"
                style="
                    background-color: var(--color-putih);
                    border: 1px solid rgba(212,160,23,.25);
                    box-shadow: var(--shadow);
                ">

                <div class="w-28 h-28 mx-auto rounded-full flex items-center justify-center text-5xl"
                    style="
                        background-color: rgba(139,94,42,.15);
                        border: 3px solid var(--color-coklat);">
                    👨
                </div>

                <h3 class="font-bold text-xl mt-5">
                    Nama Bendahara
                </h3>

                <p class="text-slate-500">
                    Bendahara
                </p>

            </div>

            <!-- Koordinator -->
            <div
                class="rounded-3xl p-8 text-center transition"
                style="
                    background-color: var(--color-putih);
                    border: 1px solid rgba(212,160,23,.25);
                    box-shadow: var(--shadow);
                ">

                <div class="w-28 h-28 mx-auto rounded-full flex items-center justify-center text-5xl"
                    style="
                        background-color: rgba(26,26,26,.08);
                        border: 3px solid var(--color-hitam);">
                    👩
                </div>

                <h3 class="font-bold text-xl mt-5">
                    Nama Koordinator
                </h3>

                <p class="text-slate-500">
                    Koordinator Program
                </p>

            </div>

        </div>

    </div>

</section>
<script>
new Swiper('.tentangSwiper', {
    loop: true,

    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    }
});
</script>
@endsection