@extends('layouts.app')

@section('content')

<!-- HERO -->
@if($bannerBerita->count() > 0)

<section class="relative">

    <div class="swiper beritaSwiper">

        <div class="swiper-wrapper">

            @foreach($bannerBerita as $banner)

            <div class="swiper-slide">

                <section class="relative min-h-[500px] flex items-center">

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
                            Berita & Artikel
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

@endif

<!-- FILTER -->
<section
    class="py-10"
    style="
        background-color: var(--color-putih);
        border-bottom: 2px solid rgba(212,160,23,.2);
    ">

    <div class="container mx-auto px-6">

        <div class="flex justify-center flex-wrap gap-3">

            <a href="{{ route('berita.index') }}"
               class="px-6 py-2 rounded-full font-semibold"
               style="
                    background:
                    {{ request('status') == null
                        ? 'var(--color-merah)'
                        : 'rgba(212,160,23,.15)' }};

                    color:
                    {{ request('status') == null
                        ? 'white'
                        : 'var(--color-hitam)' }};
               ">

                Semua

            </a>

            <a href="{{ route('berita.index',['status'=>'publikasi']) }}"
               class="px-6 py-2 rounded-full"

               style="
                    background:
                    {{ request('status') == 'publikasi'
                        ? 'var(--color-merah)'
                        : 'rgba(212,160,23,.15)' }};

                    color:
                    {{ request('status') == 'publikasi'
                        ? 'white'
                        : 'var(--color-hitam)' }};
               ">

                Dipublikasikan

            </a>

            <a href="{{ route('berita.index',['status'=>'draft']) }}"
               class="px-6 py-2 rounded-full"

               style="
                    background:
                    {{ request('status') == 'draft'
                        ? 'var(--color-merah)'
                        : 'rgba(212,160,23,.15)' }};

                    color:
                    {{ request('status') == 'draft'
                        ? 'white'
                        : 'var(--color-hitam)' }};
               ">

                Draft

            </a>

            <a href="{{ route('berita.index',['status'=>'arsip']) }}"
               class="px-6 py-2 rounded-full"

               style="
                    background:
                    {{ request('status') == 'arsip'
                        ? 'var(--color-merah)'
                        : 'rgba(212,160,23,.15)' }};

                    color:
                    {{ request('status') == 'arsip'
                        ? 'white'
                        : 'var(--color-hitam)' }};
               ">

                Arsip

            </a>

        </div>

    </div>

</section>

<!-- LIST BERITA -->
<section
    class="py-20"
    style="background-color: rgba(212,160,23,.08);">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($posts as $post)

                <article class="news-card">

                    <img
                        src="{{ asset('storage/'.$post->gambar_cover) }}"
                        alt="{{ $post->judul }}"
                        class="w-full h-56 object-cover">

                    <div class="p-6">

                        @php

                        $badgeColor = match($post->status){
                            'publikasi' => [
                                'bg' => 'rgba(34,197,94,.15)',
                                'text' => '#16a34a',
                                'label' => 'Dipublikasikan'
                            ],

                            'draft' => [
                                'bg' => 'rgba(245,158,11,.15)',
                                'text' => '#d97706',
                                'label' => 'Draft'
                            ],

                            default => [
                                'bg' => 'rgba(107,114,128,.15)',
                                'text' => '#6b7280',
                                'label' => 'Arsip'
                            ]
                        };

                        @endphp

                        <span
                            class="inline-flex px-3 py-1 rounded-full text-sm font-medium"
                            style="
                                background: {{ $badgeColor['bg'] }};
                                color: {{ $badgeColor['text'] }};
                            ">

                            {{ $badgeColor['label'] }}

                        </span>

                        <h3
                            class="news-title text-xl font-bold mt-4">

                            {{ $post->judul }}

                        </h3>

                        <p class="news-text mt-3">

                            {{ Str::limit(strip_tags($post->konten),120) }}

                        </p>

                        <div
                            class="mt-4 text-sm text-slate-500">

                            {{ optional($post->published_at)->translatedFormat('d F Y') }}

                        </div>

                        <a
                            href="{{ route('berita.show',$post->slug) }}"
                            class="news-link inline-flex items-center gap-2 mt-5">

                            Baca Selengkapnya →

                        </a>

                    </div>

                </article>

            @empty

                <div class="col-span-3">

                    <div class="news-card p-12 text-center">

                        <div class="text-7xl">
                            📰
                        </div>

                        <h3 class="text-2xl font-bold mt-4">

                            Belum Ada Berita

                        </h3>

                        <p class="mt-2 text-slate-500">

                            Saat ini belum ada berita yang dipublikasikan.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="mt-16">

            {{ $posts->links() }}

        </div>

    </div>

</section>

@endsection
