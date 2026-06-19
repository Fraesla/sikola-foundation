@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="relative">

    <div class="h-[500px]">

        <img
            src="{{ $news->thumbnail }}"
            class="w-full h-full object-cover"
            alt="{{ $news->title }}">

        <div
    class="absolute inset-0"
    style="
        background:
        linear-gradient(
            rgba(26,26,26,.65),
            rgba(26,26,26,.75)
        );
    ">
</div>

    </div>

    <div
        class="absolute inset-0 flex items-center">

        <div class="container mx-auto px-6">

            <div class="max-w-4xl">

                <span
    class="inline-flex px-4 py-2 rounded-full font-semibold"
    style="
        background-color: var(--color-kuning);
        color: var(--color-hitam);
    ">

                    Berita

                </span>

                <h1
                    class="text-4xl md:text-6xl font-bold text-white mt-6">

                    {{ $news->title }}

                </h1>

            </div>

        </div>

    </div>

</section>

<!-- CONTENT -->
<section
    class="py-20"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-4 gap-12">

            <!-- ARTIKEL -->
            <div class="lg:col-span-3">

                <!-- META -->
                <div
    class="flex flex-wrap gap-6 border-b pb-6 mb-8"
    style="
        color: var(--color-coklat);
        border-color: rgba(212,160,23,.25);
    ">

                    <span>
                        📅 {{ $news->created_at->format('d M Y') }}
                    </span>

                    <span>
                        👁 {{ number_format($news->views) }} Views
                    </span>

                </div>

                <!-- WYSIWYG CONTENT -->
               <div class="article-content prose prose-lg max-w-none">
    {!! $news->content !!}
</div>

            </div>

            <!-- SIDEBAR -->
            <div>

                <div
    class="rounded-3xl p-6 sticky top-24"
    style="
        background-color: white;
        border: 2px solid rgba(212,160,23,.2);
        box-shadow: var(--shadow);
    ">

                    <h3
    class="font-bold text-xl mb-6"
    style="color: var(--color-merah);">
    Berita Terbaru
</h3>

                    <div class="space-y-5">

                        <a
    href="#"
    class="block transition hover:translate-x-1"
    style="color: var(--color-hitam);">

    Workshop Teknologi Untuk Pelajar

</a>

                        <a href="#"
                           class="block hover:text-blue-600">

                            Donasi Buku Untuk Rumah Belajar

                        </a>

                        <a href="#"
                           class="block hover:text-blue-600">

                            Pelatihan Volunteer Sikola Foundation

                        </a>

                    </div>

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
                color: var(--color-putih);
            ">

            <h2 class="text-4xl font-bold">
                Ingin Mendukung Program Kami?
            </h2>

            <p
                class="mt-4 max-w-2xl mx-auto"
                style="color: rgba(249,246,240,.85);">

                Mari bersama menciptakan dampak positif
                bagi masyarakat melalui pendidikan,
                donasi, dan kegiatan sosial.

            </p>

            <a
                href="{{ url('/donasi') }}"
                class="inline-block mt-8 px-8 py-4 rounded-xl font-bold transition hover:scale-105"
                style="
                    background-color: var(--color-kuning);
                    color: var(--color-hitam);
                ">

                💝 Donasi Sekarang

            </a>

        </div>

    </div>

</section>

@endsection