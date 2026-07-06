@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="relative h-[550px] overflow-hidden">

    <a href="{{ route('event.index') }}"
        class="absolute top-8 left-8 z-30 px-5 py-3 rounded-xl flex items-center gap-2"
        style="
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(10px);
            color:white;
            border:1px solid rgba(255,255,255,.2);
        ">

        ← Kembali

    </a>

    <img src="{{ url()->previous() }}"
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0"
        style="
            background:
            linear-gradient(
                rgba(0,0,0,.65),
                rgba(0,0,0,.75)
            );
        ">
    </div>

    <div class="absolute inset-0 flex items-center">

        <div class="container mx-auto px-6 text-white relative z-10">

            <span
                class="px-4 py-2 rounded-full text-sm font-semibold"
                style="
                    background:rgba(212,160,23,.2);
                    color:var(--color-kuning);
                ">

                {{ ucfirst($event->status) }}

            </span>

            <h1 class="text-5xl md:text-6xl font-bold mt-6">
                {{ $event->judul }}
            </h1>

            <div class="flex flex-wrap gap-8 mt-8 text-lg">

                <div>
                    📅
                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)
                        ->translatedFormat('d F Y H:i') }}
                </div>

                <div>
                    📍 {{ $event->lokasi }}
                </div>

            </div>

        </div>

    </div>

</section>


{{-- CONTENT --}}
<section class="py-20">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-4 gap-10">

            {{-- KONTEN --}}
            <div class="lg:col-span-3">

                <div
                    class="rounded-3xl p-10"
                    style="
                        background:white;
                        box-shadow:var(--shadow);
                    ">

                    <h2 class="text-3xl font-bold mb-8">
                        Tentang Event
                    </h2>

                    <div class="prose prose-lg max-w-none">

                        {!! $event->deskripsi !!}

                    </div>

                </div>

            </div>

            {{-- SIDEBAR --}}
            <div>

                <div
                    class="rounded-3xl p-8 sticky top-24"
                    style="
                        background:white;
                        box-shadow:var(--shadow);
                    ">

                    <h3
                        class="text-2xl font-bold mb-6"
                        style="color:var(--color-hitam)">

                        Informasi Event

                    </h3>

                    <div class="space-y-5">

                        <div>

                            <p class="text-sm text-slate-500">
                                Tanggal Mulai
                            </p>

                            <p class="font-semibold">

                                {{ \Carbon\Carbon::parse($event->tanggal_mulai)
                                    ->translatedFormat('d F Y H:i') }}

                            </p>

                        </div>

                        @if($event->tanggal_selesai)

                        <div>

                            <p class="text-sm text-slate-500">
                                Tanggal Selesai
                            </p>

                            <p class="font-semibold">

                                {{ \Carbon\Carbon::parse($event->tanggal_selesai)
                                    ->translatedFormat('d F Y H:i') }}

                            </p>

                        </div>

                        @endif

                        <div>

                            <p class="text-sm text-slate-500">
                                Lokasi
                            </p>

                            <p class="font-semibold">
                                {{ $event->lokasi }}
                            </p>

                        </div>

                        <div>

                            <p class="text-sm text-slate-500">
                                Kuota
                            </p>

                            <p class="font-semibold">

                                {{ $event->kuota ?? 'Unlimited' }}

                            </p>

                        </div>

                        <div>

                            <p class="text-sm text-slate-500">
                                Reward Poin
                            </p>

                            <p class="font-semibold">
                                {{ $event->poin_reward }} Poin
                            </p>

                        </div>

                        <div>

                            <p class="text-sm text-slate-500">
                                Status
                            </p>

                            @if($event->status == 'terbuka')

                                <span
                                    class="px-3 py-1 rounded-full text-sm"
                                    style="
                                        background:rgba(22,163,74,.15);
                                        color:#16a34a;
                                    ">

                                    Terbuka

                                </span>

                            @elseif($event->status == 'ditutup')

                                <span
                                    class="px-3 py-1 rounded-full text-sm"
                                    style="
                                        background:rgba(245,158,11,.15);
                                        color:#f59e0b;
                                    ">

                                    Ditutup

                                </span>

                            @elseif($event->status == 'draft')

                                <span
                                    class="px-3 py-1 rounded-full text-sm"
                                    style="
                                        background:rgba(148,163,184,.15);
                                        color:#64748b;
                                    ">

                                    Draft

                                </span>

                            @else

                                <span
                                    class="px-3 py-1 rounded-full text-sm"
                                    style="
                                        background:rgba(204,34,34,.15);
                                        color:var(--color-merah);
                                    ">

                                    Selesai

                                </span>

                            @endif

                        </div>

                    </div>

                   @if($event->status=='terbuka')

                    <form
                        action="{{ route('relawan.events.daftar',$event->id) }}"
                        method="POST"

                        onsubmit="return confirm(
                            'Apakah Anda yakin ingin mendaftar event ini?\n\nData yang sudah dikirim akan menunggu verifikasi admin.'
                        )">

                        @csrf

                        <button
                            class="w-full mt-8 py-4 rounded-xl
                                   font-bold text-white"

                            style="
                                background:
                                linear-gradient(
                                    135deg,
                                    var(--color-merah),
                                    var(--color-coklat)
                                );
                            ">

                            Daftar Event

                        </button>

                    </form>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>


{{-- EVENT LAINNYA --}}
<section
    class="py-20"
    style="background:rgba(212,160,23,.08)">

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
                color:white;
            ">

            <h2 class="text-4xl font-bold">
                Mari Bergabung Bersama Sikola Foundation
            </h2>

            <p class="mt-5 max-w-3xl mx-auto">

                Jadilah bagian dari perubahan melalui kegiatan
                sosial, pendidikan, dan pemberdayaan masyarakat.

            </p>

            <a href="{{ url('/kontak') }}"
               class="inline-block mt-8 px-8 py-4 rounded-xl font-bold"
               style="
                    background:var(--color-kuning);
                    color:var(--color-hitam);
               ">

                Hubungi Kami

            </a>

        </div>

    </div>

</section>

@endsection