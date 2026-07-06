@extends('layouts.app')

@section('content')

<!-- HERO -->
@if($bannerKontak->count() > 0)

<section class="relative">

    <div class="swiper kontakSwiper">

        <div class="swiper-wrapper">

            @foreach($bannerKontak as $banner)

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

                            Hubungi Kami

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

            Hubungi Kami

        </span>

        <h1 class="text-5xl font-bold mt-4 text-white">
            Kontak Sikola Foundation
        </h1>

        <p
            class="mt-4 max-w-3xl mx-auto text-lg"
            style="color: rgba(249,246,240,.9);">

            Kami siap membantu dan menjawab pertanyaan Anda
            mengenai program pendidikan, donasi, volunteer,
            maupun kerja sama.

        </p>

    </div>

</section>

@endif

<!-- CONTACT -->
<section
    class="py-20"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-10">

            <!-- LEFT -->
            <div>

                <div
                    class="rounded-3xl p-8"
                    style="
                        background-color: white;
                        box-shadow: var(--shadow);
                    ">

                    <h2
                        class="text-3xl font-bold mb-8"
                        style="color: var(--color-hitam);">

                        Informasi Kontak

                    </h2>

                    <div class="space-y-8">

                        <div class="flex gap-4">

                            <div
                                class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl"
                                style="
                                    background-color: rgba(212,160,23,.15);
                                ">
                                📍
                            </div>

                            <div>

                                <h3
                                    class="font-bold"
                                    style="color: var(--color-hitam);">

                                    Alamat

                                </h3>

                                <p style="color: var(--color-coklat);">
                                    Jl. Sikola Foundation No. 1,
                                    Padang, Sumatera Barat
                                </p>

                            </div>

                        </div>

                        <div class="flex gap-4">

                            <div
                                class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl"
                                style="
                                    background-color: rgba(212,160,23,.15);
                                ">
                                📞
                            </div>

                            <div>

                                <h3
                                    class="font-bold"
                                    style="color: var(--color-hitam);">

                                    Telepon

                                </h3>

                                <p style="color: var(--color-coklat);">
                                    +62 812-3456-7890
                                </p>

                            </div>

                        </div>

                        <div class="flex gap-4">

                            <div
                                class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl"
                                style="
                                    background-color: rgba(212,160,23,.15);
                                ">
                                ✉️
                            </div>

                            <div>

                                <h3
                                    class="font-bold"
                                    style="color: var(--color-hitam);">

                                    Email

                                </h3>

                                <p style="color: var(--color-coklat);">
                                    info@sikolafoundation.org
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- FORM -->
                <div
                    class="mt-8 rounded-3xl p-8"
                    style="
                        background-color: white;
                        box-shadow: var(--shadow);
                    ">

                    <h2
                        class="text-2xl font-bold mb-6"
                        style="color: var(--color-hitam);">

                        Kirim Pesan

                    </h2>

                    <form>

                        <div class="mb-4">

                            <input
                                type="text"
                                placeholder="Nama Lengkap"
                                class="w-full px-4 py-3 rounded-xl border">

                        </div>

                        <div class="mb-4">

                            <input
                                type="email"
                                placeholder="Email"
                                class="w-full px-4 py-3 rounded-xl border">

                        </div>

                        <div class="mb-4">

                            <textarea
                                rows="5"
                                placeholder="Pesan"
                                class="w-full px-4 py-3 rounded-xl border"></textarea>

                        </div>

                        <button
                            type="submit"
                            class="w-full py-3 rounded-xl font-semibold"
                            style="
                                background-color: var(--color-merah);
                                color: var(--color-putih);
                            ">

                            Kirim Pesan

                        </button>

                    </form>

                </div>

            </div>

            <!-- RIGHT -->
            <div>

                <div
                    class="overflow-hidden rounded-3xl"
                    style="box-shadow: var(--shadow);">

                    <iframe
                        src="https://www.google.com/maps?q=Padang&output=embed"
                        class="w-full h-[700px]"
                        loading="lazy">
                    </iframe>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- CTA -->
<section
    class="py-20"
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

            <h2 class="text-4xl font-bold text-white">
                Mari Berkolaborasi Bersama Kami
            </h2>

            <p
                class="mt-4 max-w-2xl mx-auto"
                style="color: rgba(249,246,240,.9);">

                Kami terbuka untuk kerja sama, sponsor,
                kegiatan sosial, pendidikan, dan program
                kemanusiaan lainnya.

            </p>

            <a
                href="mailto:info@sikolafoundation.org"
                class="inline-block mt-8 px-8 py-4 rounded-xl font-bold"
                style="
                    background-color: var(--color-kuning);
                    color: var(--color-hitam);
                ">

                Hubungi Sekarang

            </a>

        </div>

    </div>

</section>
<script>
new Swiper('.kontakSwiper', {
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