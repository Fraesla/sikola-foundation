@extends('layouts.app')

@section('content')

@if($bannerEvent->count())

<section class="relative">

    <div class="swiper eventSwiper">

        <div class="swiper-wrapper">

            @foreach($bannerEvent as $banner)

            <div class="swiper-slide">

                <section class="relative h-[420px] md:h-[500px] overflow-hidden">

                    <img src="{{ asset('storage/'.$banner->gambar) }}"
                         class="absolute inset-0 w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black/60"></div>

                    <div class="relative z-20 h-full">

                        <div class="relative z-20 flex items-center justify-center h-full">

                            <!-- Tombol Back -->
                            <div class="absolute top-6 left-6 md:top-8 md:left-8 z-30">
                                <a href="{{ url()->previous() }}"
                                   class="inline-flex items-center gap-3 px-6 py-3 rounded-xl"
                                   style="
                                        background: rgba(255,255,255,.12);
                                        backdrop-filter: blur(10px);
                                        border: 1px solid rgba(212,160,23,.5);
                                        color: white;
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
                            </div>

                            <!-- Content -->
                            <div class="container mx-auto px-6 text-center text-white">

                                <span class="uppercase tracking-[4px]"
                                      style="color: var(--color-kuning);">
                                    Event Sikola Foundation
                                </span>

                                <h1 class="text-4xl md:text-6xl font-bold mt-4">
                                    {{ $banner->judul }}
                                </h1>

                                <p class="mt-5 max-w-3xl mx-auto text-lg">
                                    {{ $banner->deskripsi }}
                                </p>

                            </div>

                        </div>

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

        <div class="text-center text-white">

            <span class="uppercase tracking-[4px]"
                  style="color: var(--color-kuning);">

                Event Sikola Foundation

            </span>

            <h1 class="text-5xl md:text-6xl font-bold mt-4">
                Kegiatan & Agenda Yayasan
            </h1>

            <p class="mt-5 max-w-3xl mx-auto text-lg"
               style="color: rgba(249,246,240,.9);">

                Ikuti berbagai kegiatan pendidikan, sosial,
                seminar, workshop, dan program pemberdayaan
                masyarakat yang diselenggarakan oleh
                Sikola Foundation.

            </p>

        </div>

    </div>

</section> 

@endif

<!-- FILTER -->
<section
    class="py-10"
    style="
        background-color: var(--color-putih);
        border-bottom:2px solid rgba(212,160,23,.2);
    ">

    <div class="container mx-auto px-6">

        <form class="flex flex-col md:flex-row gap-4 justify-center">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari event..."
                class="px-5 py-3 rounded-xl border w-full md:w-80">

            <select
                name="status"
                class="px-5 py-3 rounded-xl border">

                <option value="">Semua Event</option>

                <option value="mendatang"
                    {{ request('status')=='mendatang' ? 'selected':'' }}>
                    Mendatang
                </option>

                <option value="arsip"
                    {{ request('status')=='arsip' ? 'selected':'' }}>
                    Arsip
                </option>

            </select>

            <button
                class="px-8 py-3 rounded-xl text-white font-semibold"
                style="background:var(--color-merah);">

                Cari

            </button>

        </form>

    </div>

</section>

<!-- EVENT LIST -->
<section
    class="py-20"
    style="background-color: rgba(212,160,23,.08);">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

           @forelse($events as $event)

            <article
                class="rounded-3xl overflow-hidden transition duration-300 hover:-translate-y-2"
                style="
                    background:#fff;
                    box-shadow:var(--shadow);
                ">

                <img
                    src="{{ asset('storage/'.$event->gambar) }}"
                    alt="{{ $event->judul }}"
                    class="w-full h-56 object-cover">

                <div class="p-6">

                   @if($event->status == 'terbuka')

                        <span
                            class="inline-flex px-3 py-1 rounded-full text-sm font-medium"
                            style="
                                background:rgba(204,34,34,.15);
                                color:var(--color-merah);
                            ">
                            📅 Mendatang
                        </span>

                    @elseif($event->status == 'selesai')

                        <span
                            class="inline-flex px-3 py-1 rounded-full text-sm font-medium"
                            style="
                                background:rgba(139,94,42,.15);
                                color:var(--color-coklat);
                            ">
                            📚 Arsip
                        </span>

                    @elseif($event->status == 'ditutup')

                        <span
                            class="inline-flex px-3 py-1 rounded-full text-sm font-medium"
                            style="
                                background:rgba(245,158,11,.15);
                                color:#d97706;
                            ">
                            🔒 Ditutup
                        </span>

                    @else

                        <span
                            class="inline-flex px-3 py-1 rounded-full text-sm font-medium"
                            style="
                                background:rgba(156,163,175,.15);
                                color:#6b7280;
                            ">
                            📝 Draft
                        </span>

                    @endif


                    <h3
                        class="text-xl font-bold mt-4"
                        style="color:var(--color-hitam);">

                        {{ $event->judul }}

                    </h3>

                    <div
                        class="mt-4 space-y-2 text-sm"
                        style="color:var(--color-coklat);">

                        <p>
                            📅
                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}
                        </p>

                        <p>
                            📍 {{ $event->lokasi }}
                        </p>

                        <p>
                            👥
                            {{ $event->kuota ?? 'Unlimited' }} Peserta
                        </p>

                    </div>

                    <a
                        href="{{ route('event.show',$event->slug) }}"
                        class="inline-flex items-center gap-2 mt-6 font-semibold hover:translate-x-1 transition"
                        style="color:var(--color-merah);">

                        Detail Event →

                    </a>

                </div>

            </article>

            @empty

            <div class="col-span-3">

                <div
                    class="rounded-3xl p-16 text-center bg-white"
                    style="box-shadow:var(--shadow);">

                    <div class="text-7xl mb-4">
                        📅
                    </div>

                    <h3 class="text-2xl font-bold mb-3">
                        Belum Ada Event
                    </h3>

                    <p class="text-slate-500">
                        Saat ini belum ada event yang tersedia.
                    </p>

                </div>

            </div>

            @endforelse

        </div>
        <div class="mt-12">
            {{ $events->links() }}
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
