@extends('layouts.app')

@section('content')

<!-- HERO -->
@if($bannerTeam->count() > 0)

<section class="relative">

    <div class="swiper teamSwiper">

        <div class="swiper-wrapper">

            @foreach($bannerTeam as $banner)

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

                            Struktur Organisasi

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

            Struktur Organisasi

        </span>

        <h1 class="text-5xl font-bold mt-4 text-white">
            Tim Sikola Foundation
        </h1>

        <p
            class="mt-4 max-w-3xl mx-auto text-lg"
            style="color: rgba(249,246,240,.9);">

            Orang-orang hebat yang bekerja bersama untuk
            mewujudkan program pendidikan, sosial, dan kemanusiaan.

        </p>

    </div>

</section>

@endif

<!-- TEAM -->
<section
    class="py-20"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            @forelse($teams as $team)

                <div
                    class="rounded-3xl overflow-hidden text-center transition duration-300 hover:-translate-y-2 hover:shadow-2xl"
                    style="
                        background-color: white;
                        box-shadow: var(--shadow);
                    ">

                    {{-- HEADER --}}
                    <div
                        class="h-28"
                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">
                    </div>

                    {{-- FOTO --}}
                    <div class="-mt-14">

                        <img
                            src="{{ $team->foto
                                    ? asset('storage/'.$team->foto)
                                    : 'https://ui-avatars.com/api/?name='.$team->nama }}"
                            alt="{{ $team->nama }}"
                            class="w-28 h-28 rounded-full mx-auto border-4 object-cover"
                            style="
                                border-color: var(--color-kuning);
                            ">

                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6">

                        <h3
                            class="text-2xl font-bold"
                            style="color: var(--color-hitam);">

                            {{ $team->nama }}

                        </h3>

                        <p
                            class="mt-2 font-semibold"
                            style="color: var(--color-merah);">

                            {{ $team->jabatan }}

                        </p>

                        <p
                            class="mt-4 text-sm leading-7 min-h-[120px]"
                            style="color: var(--color-coklat);">

                            {{ \Illuminate\Support\Str::limit($team->bio,120) }}

                        </p>

                        {{-- SOCIAL MEDIA --}}
                        @php
                            $social = $team->sosial_media ?? [];
                        @endphp

                        <div class="flex justify-center gap-3 mt-6">

                            @if(isset($social['website']))
                            <a href="{{ $social['website'] }}"
                               target="_blank"
                               class="w-10 h-10 rounded-full flex items-center justify-center hover:scale-110 transition"
                               style="
                                    background-color: rgba(212,160,23,.15);
                                    color: var(--color-merah);
                               ">
                                🌐
                            </a>
                            @endif

                            @if(isset($social['facebook']))
                            <a href="{{ $social['facebook'] }}"
                               target="_blank"
                               class="w-10 h-10 rounded-full flex items-center justify-center hover:scale-110 transition"
                               style="
                                    background-color: rgba(212,160,23,.15);
                                    color: var(--color-merah);
                               ">
                                📘
                            </a>
                            @endif

                            @if(isset($social['instagram']))
                            <a href="{{ $social['instagram'] }}"
                               target="_blank"
                               class="w-10 h-10 rounded-full flex items-center justify-center hover:scale-110 transition"
                               style="
                                    background-color: rgba(212,160,23,.15);
                                    color: var(--color-merah);
                               ">
                                📷
                            </a>
                            @endif

                            @if(isset($social['linkedin']))
                            <a href="{{ $social['linkedin'] }}"
                               target="_blank"
                               class="w-10 h-10 rounded-full flex items-center justify-center hover:scale-110 transition"
                               style="
                                    background-color: rgba(212,160,23,.15);
                                    color: var(--color-merah);
                               ">
                                💼
                            </a>
                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-4">

                    <div
                        class="rounded-3xl bg-white p-16 text-center"
                        style="box-shadow: var(--shadow);">

                        <div class="text-7xl mb-4">
                            👥
                        </div>

                        <h3 class="text-3xl font-bold mb-4">
                            Belum Ada Data Tim
                        </h3>

                        <p class="text-slate-500">
                            Saat ini belum ada anggota tim yang ditampilkan.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

<!-- CTA -->
<section
    class="py-20"
    style="
        background-color: rgba(212,160,23,.08);
    ">

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
                Bergabung Menjadi Relawan
            </h2>

            <p
                class="mt-4 max-w-2xl mx-auto"
                style="color: rgba(249,246,240,.9);">

                Jadilah bagian dari perubahan dan ikut
                berkontribusi dalam program-program
                Sikola Foundation.

            </p>

            <a href="{{ url('/relawan') }}"
               class="inline-block mt-8 px-8 py-4 rounded-xl font-bold"
               style="
                    background-color: var(--color-kuning);
                    color: var(--color-hitam);
               ">

                Daftar Relawan

            </a>

        </div>

    </div>

</section>
<script>
new Swiper('.teamSwiper', {
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