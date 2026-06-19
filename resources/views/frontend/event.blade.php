@extends('layouts.app')

@section('content')

<!-- HERO -->
<section
    class="relative py-24"
    style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
    ">

    <div class="container mx-auto px-6">

        <!-- Back Button -->
        <a href="{{ url('/#program') }}"
           class="absolute top-8 left-8 z-30 inline-flex items-center gap-3 px-5 py-3 rounded-xl"
           style="
                background: rgba(255,255,255,.12);
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

            Back
        </a>

        <!-- Hero Content -->
        <div class="text-center text-white">

            <span
                class="uppercase tracking-[4px]"
                style="color: var(--color-kuning);">
                Event Sikola Foundation
            </span>

            <h1 class="text-5xl md:text-6xl font-bold mt-4">
                Kegiatan & Agenda Yayasan
            </h1>

            <p
                class="mt-5 max-w-3xl mx-auto text-lg"
                style="color: rgba(249,246,240,.9);">
                Ikuti berbagai kegiatan pendidikan, sosial,
                seminar, workshop, dan program pemberdayaan
                masyarakat yang diselenggarakan oleh
                Sikola Foundation.
            </p>

        </div>

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

        <div class="flex justify-center flex-wrap gap-3">

            <button
                class="px-6 py-2 rounded-full font-semibold"
                style="
                    background-color: var(--color-merah);
                    color: var(--color-putih);
                ">
                Semua
            </button>

            <button
                class="px-6 py-2 rounded-full transition"
                style="
                    background-color: rgba(212,160,23,.15);
                    color: var(--color-hitam);
                ">
                Mendatang
            </button>

            <button
                class="px-6 py-2 rounded-full transition"
                style="
                    background-color: rgba(212,160,23,.15);
                    color: var(--color-hitam);
                ">
                Arsip
            </button>

        </div>

    </div>

</section>

<!-- EVENT LIST -->
<section
    class="py-20"
    style="background-color: rgba(212,160,23,.08);">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($events as $event)

            <article
                class="rounded-3xl overflow-hidden transition duration-300 hover:-translate-y-2"
                style="
                    background-color: white;
                    box-shadow: var(--shadow);
                ">

                <img
                    src="{{ $event['image'] }}"
                    alt="{{ $event['title'] }}"
                    class="w-full h-56 object-cover">

                <div class="p-6">

                    @if($event['status'] == 'upcoming')

                        <span
                            class="inline-flex px-3 py-1 rounded-full text-sm font-medium"
                            style="
                                background-color: rgba(204,34,34,.15);
                                color: var(--color-merah);
                            ">
                            📅 Mendatang
                        </span>

                    @else

                        <span
                            class="inline-flex px-3 py-1 rounded-full text-sm font-medium"
                            style="
                                background-color: rgba(139,94,42,.15);
                                color: var(--color-coklat);
                            ">
                            📚 Arsip
                        </span>

                    @endif

                    <h3
                        class="text-xl font-bold mt-4"
                        style="color: var(--color-hitam);">

                        {{ $event['title'] }}

                    </h3>

                    <div
                        class="mt-4 space-y-2 text-sm"
                        style="color: var(--color-coklat);">

                        <p>
                            📅 {{ $event['date'] }}
                        </p>

                        <p>
                            📍 {{ $event['location'] }}
                        </p>

                    </div>

                    <a
                        href="{{ route('event.show', $event['slug']) }}"
                        class="inline-flex items-center gap-2 mt-6 font-semibold transition hover:translate-x-1"
                        style="color: var(--color-merah);">

                        Detail Event →

                    </a>

                </div>

            </article>

            @endforeach

        </div>

    </div>

</section>

<!-- CTA -->
<section
    class="py-24"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div
            class="rounded-3xl p-12 md:p-16 text-center"
            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
                color: var(--color-putih);
            ">

            <h2 class="text-4xl md:text-5xl font-bold">
                Ingin Mengikuti Event Kami?
            </h2>

            <p
                class="mt-5 max-w-3xl mx-auto text-lg"
                style="color: rgba(249,246,240,.9);">

                Bergabunglah dalam berbagai kegiatan sosial,
                pendidikan, workshop, dan program kemanusiaan
                bersama Sikola Foundation.

            </p>

            <div class="mt-10">

                <a
                    href="{{ url('/kontak') }}"
                    class="inline-flex items-center gap-2 px-10 py-4 rounded-xl font-bold text-lg transition hover:scale-105"
                    style="
                        background-color: var(--color-kuning);
                        color: var(--color-hitam);
                    ">

                    📞 Hubungi Kami

                </a>

            </div>

        </div>

    </div>

</section>

@endsection