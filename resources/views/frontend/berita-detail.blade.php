@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="relative">

    <div class="h-[500px]">

        <img
            src="{{ $news->thumbnail }}"
            class="w-full h-full object-cover"
            alt="{{ $news->title }}">

        <div class="absolute inset-0 bg-black/60"></div>

    </div>

    <div
        class="absolute inset-0 flex items-center">

        <div class="container mx-auto px-6">

            <div class="max-w-4xl">

                <span
                    class="inline-flex bg-blue-600 text-white px-4 py-2 rounded-full">

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
<section class="py-20 bg-white">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-4 gap-12">

            <!-- ARTIKEL -->
            <div class="lg:col-span-3">

                <!-- META -->
                <div
                    class="flex flex-wrap gap-6 text-slate-500 border-b pb-6 mb-8">

                    <span>
                        📅 {{ $news->created_at->format('d M Y') }}
                    </span>

                    <span>
                        👁 {{ number_format($news->views) }} Views
                    </span>

                </div>

                <!-- WYSIWYG CONTENT -->
                <div
                    class="prose prose-lg max-w-none">

                    {!! $news->content !!}

                </div>

            </div>

            <!-- SIDEBAR -->
            <div>

                <div
                    class="bg-slate-50 rounded-3xl p-6 sticky top-24">

                    <h3 class="font-bold text-xl mb-6">
                        Berita Terbaru
                    </h3>

                    <div class="space-y-5">

                        <a href="#"
                           class="block hover:text-blue-600">

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
<section class="py-20 bg-slate-50">

    <div class="container mx-auto px-6">

        <div
            class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-3xl p-12 text-center text-white">

            <h2 class="text-4xl font-bold">

                Ingin Mendukung Program Kami?

            </h2>

            <p class="mt-4 text-blue-100">

                Mari bersama menciptakan dampak positif bagi masyarakat.

            </p>

            <a href="{{ url('/donasi') }}"
               class="inline-block mt-8 bg-white text-blue-600 px-8 py-4 rounded-xl font-bold">

                Donasi Sekarang

            </a>

        </div>

    </div>

</section>

@endsection
