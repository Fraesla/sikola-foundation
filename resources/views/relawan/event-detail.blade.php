@extends('layouts.relawan',[
    'activePage'=>'event'
])

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-8">

    <div>

        <h1
            class="text-4xl font-bold"
            style="color:var(--color-hitam)">

            Detail Event

        </h1>

        <p
            class="mt-2"
            style="color:var(--color-coklat)">

            Informasi lengkap mengenai event relawan.

        </p>

    </div>

    <a
        href="{{ url()->previous() }}"
        class="inline-flex items-center gap-2
               px-6 py-3 rounded-2xl
               bg-white font-semibold
               transition duration-300"

        style="
            box-shadow:var(--shadow);
            color:var(--color-hitam);
        "

        onmouseover="
            this.style.background='var(--color-merah)';
            this.style.color='white';
        "

        onmouseout="
            this.style.background='white';
            this.style.color='var(--color-hitam)';
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

        Kembali

    </a>

</div>
<section class="pb-20">

    {{-- HERO --}}
    <section
        class="relative overflow-hidden rounded-[35px]"
        style="
            height:430px;
            background:#000;
        ">

        <img
            src="{{ asset('storage/'.$event->gambar) }}"
            class="absolute inset-0 w-full h-full object-cover opacity-40">

        <div
            class="absolute inset-0"
            style="
                background:
                linear-gradient(
                    rgba(0,0,0,.25),
                    rgba(0,0,0,.75)
                );
            ">
        </div>

        <div class="relative h-full flex items-end">

            <div class="p-12 text-white max-w-4xl">

                <span
                    class="px-5 py-2 rounded-full text-sm font-semibold"

                    style="
                    background:rgba(255,255,255,.18);
                    backdrop-filter:blur(10px);
                    ">

                    📍 {{ $event->lokasi }}

                </span>

                <h1 class="text-6xl font-bold mt-6">

                    {{ $event->judul }}

                </h1>

                <div class="flex flex-wrap gap-8 mt-8">

                    <div>

                        <small class="opacity-80">

                            Mulai

                        </small>

                        <p class="font-bold">

                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)
                                ->translatedFormat('d F Y H:i') }}

                        </p>

                    </div>

                    <div>

                        <small class="opacity-80">

                            Selesai

                        </small>

                        <p class="font-bold">

                            {{ \Carbon\Carbon::parse($event->tanggal_selesai)
                                ->translatedFormat('d F Y H:i') }}

                        </p>

                    </div>

                    <div>

                        <small class="opacity-80">

                            Reward

                        </small>

                        <p class="font-bold">

                            {{ $event->poin_reward }} Poin

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- CONTENT --}}
    <div class="grid lg:grid-cols-3 gap-8 mt-10">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Tentang --}}
            <div
                class="rounded-3xl p-10 bg-white"
                style="box-shadow:var(--shadow)">

                <h2 class="text-3xl font-bold mb-8">

                    Tentang Event

                </h2>

                <div class="prose max-w-none">

                    {!! $event->deskripsi !!}

                </div>

            </div>


            {{-- Timeline --}}
            <div
                class="rounded-3xl p-10 bg-white"
                style="box-shadow:var(--shadow)">

                <h2 class="text-3xl font-bold mb-8">

                    Timeline Event

                </h2>

                <div class="space-y-6">

                    <div class="flex gap-5">

                        <div
                            class="w-12 h-12 rounded-full flex items-center justify-center"

                            style="
                            background:rgba(204,34,34,.12);
                            color:var(--color-merah);
                            ">

                            📅

                        </div>

                        <div>

                            <h4 class="font-bold">

                                Pembukaan Event

                            </h4>

                            <p class="text-slate-500">

                                {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y H:i') }}

                            </p>

                        </div>

                    </div>

                    <div class="flex gap-5">

                        <div
                            class="w-12 h-12 rounded-full flex items-center justify-center"

                            style="
                            background:rgba(212,160,23,.15);
                            color:var(--color-kuning);
                            ">

                            🏁

                        </div>

                        <div>

                            <h4 class="font-bold">

                                Penutupan Event

                            </h4>

                            <p class="text-slate-500">

                                {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d F Y H:i') }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- SIDEBAR --}}
        <div>

            <div
                class="sticky top-24 rounded-3xl bg-white p-8"
                style="box-shadow:var(--shadow)">

                <h3 class="text-2xl font-bold">

                    Informasi Event

                </h3>

                <hr class="my-6">

                <div class="space-y-5">

                    <div class="flex justify-between">

                        <span>Total Kuota</span>

                        <b>

                            {{ $event->kuota + $jumlahPeserta  }}

                        </b>

                    </div>

                    <div class="flex justify-between">

                        <span>Kuota tersisa</span>

                        <b>

                            {{ $event->kuota  }}

                        </b>

                    </div>

                    <div class="flex justify-between">

                        <span>Reward</span>

                        <b class="text-green-600">

                            {{ $event->poin_reward }} Poin

                        </b>

                    </div>

                    <div class="flex justify-between">

                        <span>Status</span>

                        <span
                            class="px-3 py-1 rounded-full"

                            style="
                            background:rgba(22,163,74,.12);
                            color:#16a34a;
                            ">

                            {{ ucfirst($event->status) }}

                        </span>

                    </div>

                </div>


                <div class="mt-8">

                    @php
                        $registrasi = $event->registrasi
                            ->where('user_id',auth()->id())
                            ->first();
                    @endphp


                    @if(!$registrasi)

                        <form
                            action="{{ route('relawan.events.daftar',$event->id) }}"
                            method="POST">

                            @csrf

                            <button
                                onclick="return confirm('Daftar event ini?')"

                                class="w-full py-4 rounded-xl
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

                    @else

                        @if($registrasi->status=='mendaftar')

                            <div
                                class="text-center p-5 rounded-xl"

                                style="
                                background:rgba(245,158,11,.12);
                                color:#f59e0b;
                                ">

                                Menunggu Verifikasi

                            </div>

                        @elseif($registrasi->status=='dikonfirmasi')

                            <div
                                class="text-center p-5 rounded-xl"

                                style="
                                background:rgba(22,163,74,.12);
                                color:#16a34a;
                                ">

                                Anda Terdaftar

                            </div>

                        @elseif($registrasi->status=='hadir')

                            <div
                                class="text-center p-5 rounded-xl"

                                style="
                                background:rgba(22,163,74,.12);
                                color:#16a34a;
                                ">

                                Sudah Selesain

                            </div>

                        @else

                            <div
                                class="text-center p-5 rounded-xl"

                                style="
                                background:rgba(204,34,34,.12);
                                color:var(--color-merah);
                                ">

                                Ditolak

                                <div class="text-sm mt-2">

                                    {{ $registrasi->alasan_tolak }}

                                </div>

                            </div>

                        @endif

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>

@endsection