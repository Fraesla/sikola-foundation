@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="relative h-[500px] overflow-hidden">

    <!-- Tombol Back -->
    <a href="{{ url('/event') }}"
       class="absolute top-8 left-8 z-30 inline-flex items-center gap-3 px-5 py-3 rounded-xl transition hover:bg-white/20"
       style="
            background: rgba(0,0,0,.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212,160,23,.5);
            color: var(--color-putih);
       ">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 19l-7-7 7-7"/>
        </svg>

        BACK
    </a>

    <!-- Background Image -->
    <img
        src="{{ $event->image }}"
        class="absolute inset-0 w-full h-full object-cover"
        alt="{{ $event->title }}">

    <!-- Overlay -->
    <div
        class="absolute inset-0"
        style="
            background:
            linear-gradient(
                rgba(26,26,26,.65),
                rgba(26,26,26,.65)
            ),
            linear-gradient(
                135deg,
                rgba(204,34,34,.35),
                rgba(139,94,42,.35)
            );
        ">
    </div>

    <!-- Content -->
    <div class="absolute inset-0 flex items-center z-10">

        <div class="container mx-auto px-6">

            <div class="max-w-4xl">

                <span
                    class="inline-flex px-4 py-2 rounded-full text-sm font-semibold"
                    style="
                        background-color: var(--color-kuning);
                        color: var(--color-hitam);
                    ">
                    🎉 Event Sikola Foundation
                </span>

                <h1
                    class="text-5xl md:text-7xl font-bold text-white mt-6">
                    {{ $event->title }}
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

                <div
                    class="rounded-3xl p-10"
                    style="
                        background-color: white;
                        box-shadow: var(--shadow);
                    ">

                    <div
                        class="flex flex-wrap gap-6 pb-6 mb-8 border-b"
                        style="
                            border-color:
                            rgba(212,160,23,.2);
                        ">

                        <span style="color: var(--color-coklat);">
                            📅 {{ $event->date }}
                        </span>

                        <span style="color: var(--color-coklat);">
                            📍 {{ $event->location }}
                        </span>

                    </div>

                    <div class="prose prose-lg max-w-none">

                        {!! $event->description !!}

                    </div>

                </div>

            </div>

            <!-- SIDEBAR -->
            <div>

                <div
                    class="rounded-3xl p-6 sticky top-24"
                    style="
                        background-color: white;
                        box-shadow: var(--shadow);
                    ">

                    <h3
                        class="font-bold text-xl mb-6"
                        style="color: var(--color-hitam);">

                        Informasi Event

                    </h3>

                    <div class="space-y-4">

                        <p style="color: var(--color-coklat);">
                            📅 {{ $event->date }}
                        </p>

                        <p style="color: var(--color-coklat);">
                            📍 {{ $event->location }}
                        </p>

                        <p style="color: var(--color-coklat);">
                            👥 Kuota:
                            {{ $event->quota }}
                        </p>

                        <p style="color: var(--color-coklat);">
                            ✅ Terdaftar:
                            {{ $event->registered }}
                        </p>

                        <div
                            class="rounded-xl p-4 text-center font-bold"
                            style="
                                background-color:
                                rgba(212,160,23,.12);

                                color:
                                var(--color-merah);
                            ">

                            Sisa Kuota:
                            {{ $event->quota - $event->registered }}

                        </div>

                    </div>

                    <a href="#"
                       class="block mt-8 text-center py-3 rounded-xl font-semibold transition hover:opacity-90"
                       style="
                            background-color:
                            var(--color-merah);

                            color:
                            var(--color-putih);
                       ">

                        🤝 Daftar Sebagai Relawan

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- CTA -->
<section
    class="py-24"
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
                Siap Bergabung Dalam Event Ini?
            </h2>

            <p
                class="mt-4 max-w-2xl mx-auto"
                style="color: rgba(249,246,240,.9);">

                Jadilah bagian dari gerakan pendidikan,
                sosial, dan pemberdayaan masyarakat bersama
                Sikola Foundation.

            </p>

            <a href="#"
               class="inline-block mt-8 px-8 py-4 rounded-xl font-bold"
               style="
                    background-color:
                    var(--color-kuning);

                    color:
                    var(--color-hitam);
               ">

                Daftar Sekarang

            </a>

        </div>

    </div>

</section>

@endsection