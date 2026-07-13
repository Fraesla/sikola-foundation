@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="relative h-[500px] overflow-hidden">

    <!-- Background -->
    <img src="{{ asset('storage/'.$kategori->gambar) }}"
         class="absolute inset-0 w-full h-full object-cover">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/65"></div>

    <!-- Tombol Kembali -->
    <a href="{{ url()->previous() }}"
       class="absolute top-8 left-6 md:left-10 z-20 inline-flex items-center gap-2 px-5 py-3 rounded-2xl transition hover:scale-105"
       style="
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.2);
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

        Kembali

    </a>

    <!-- Content -->
    <div class="relative z-10 h-full flex items-center justify-center">

        <div class="container mx-auto px-6 text-center text-white">

            <span class="uppercase tracking-[5px] text-sm font-semibold"
                  style="color: var(--color-kuning);">
                Program Donasi
            </span>

            <h1 class="text-4xl md:text-6xl font-bold mt-5">
                {{ $kategori->nama }}
            </h1>

            <p class="max-w-3xl mx-auto mt-6 text-lg leading-relaxed">
                {{ $kategori->deskripsi }}
            </p>

            <!-- Statistik -->
            <div class="flex justify-center gap-8 md:gap-16 mt-10">

                <div class="px-8 py-5 rounded-2xl"
                     style="
                        background: rgba(255,255,255,.12);
                        backdrop-filter: blur(12px);
                        border:1px solid rgba(255,255,255,.15);
                     ">

                    <p class="text-sm opacity-80">
                        Dana Terkumpul
                    </p>

                    <h3 class="text-2xl md:text-3xl font-bold mt-2">
                        Rp {{ number_format($terkumpul,0,',','.') }}
                    </h3>

                </div>

                <div class="px-8 py-5 rounded-2xl"
                     style="
                        background: rgba(255,255,255,.12);
                        backdrop-filter: blur(12px);
                        border:1px solid rgba(255,255,255,.15);
                     ">

                    <p class="text-sm opacity-80">
                        Donatur
                    </p>

                    <h3 class="text-2xl md:text-3xl font-bold mt-2">
                        {{ $jumlahDonatur }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

</section> 

<!-- DONASI -->
<section class="py-20 bg-[#faf7f2]">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-3 gap-10">

            {{-- KIRI --}}
            <div class="lg:col-span-2">

                <div class="bg-white rounded-3xl p-8 shadow-lg">

                    <h2 class="text-3xl font-bold mb-6"
                        style="color: var(--color-hitam)">
                        Tentang Program
                    </h2>

                    <div class="prose max-w-none">
                        {!! $kategori->deskripsi !!}
                    </div>

                </div>

            </div>


            {{-- CARD DONASI --}}
            <div>

                <div class="sticky top-28">

                    <div class="bg-white rounded-3xl shadow-xl p-8">

                        <p class="text-slate-500">
                            Dana Terkumpul
                        </p>

                        <h2 class="text-4xl font-bold mt-2"
                            style="color: var(--color-merah)">

                            Rp {{ number_format($terkumpul,0,',','.') }}

                        </h2>

                        @php
                            $persen = $kategori->target_default > 0
                            ? ($terkumpul/$kategori->target_default)*100
                            : 0;
                        @endphp

                        <div class="mt-6">

                            <div class="h-3 rounded-full bg-slate-200">

                                <div
                                    class="h-3 rounded-full"
                                    style="
                                        width:{{ min($persen,100) }}%;
                                        background:
                                        linear-gradient(
                                            135deg,
                                            var(--color-merah),
                                            var(--color-coklat)
                                        );
                                    ">
                                </div>

                            </div>

                        </div>

                        <div class="flex justify-between mt-6">

                            <div>

                                <p class="text-slate-500 text-sm">
                                    Target
                                </p>

                                <b>
                                    Rp {{ number_format($kategori->target_default,0,',','.') }}
                                </b>

                            </div>

                            <div>

                                <p class="text-slate-500 text-sm">
                                    Donatur
                                </p>

                                <b>
                                    {{ $jumlahDonatur }}
                                </b>

                            </div>

                        </div>

                        <hr class="my-8">

                        <h3 class="font-bold mb-4">
                            Pilih Nominal
                        </h3>

                        <div class="grid grid-cols-2 gap-3 mb-5">

                            <button type="button" class="nominal-btn" data-nominal="50000">
                                Rp50.000
                            </button>

                            <button type="button" class="nominal-btn" data-nominal="100000">
                                Rp100.000
                            </button>

                            <button type="button" class="nominal-btn" data-nominal="250000">
                                Rp250.000
                            </button>

                            <button type="button" class="nominal-btn" data-nominal="500000">
                                Rp500.000
                            </button>

                        </div>

                         @php
                            $prefix = auth()->user()->role == 'relawan'
                                ? 'relawan'
                                : 'donatur';
                        @endphp

                        <form id="formDonasi"
                              method="POST">
                            @csrf

                            <input type="hidden"
                                   name="donation_category_id"
                                   value="{{ $kategori->id }}">

                            <input type="hidden"
                                   name="type"
                                   id="jenis_donasi"
                                   value="sekali">

                            <input
                                type="number"
                                id="nominal"
                                name="jumlah"
                                placeholder="Masukkan nominal"
                                class="w-full rounded-xl border p-4 mb-6">

                            <div class="grid grid-cols-2 gap-3 mb-5">

                                <button type="button"
                                    class="jenis-btn py-3 rounded-xl border font-semibold transition"
                                    data-jenis="sekali">

                                    Donasi Sekali

                                </button>

                                <button type="button"
                                    class="jenis-btn py-3 rounded-xl border font-semibold transition"
                                    data-jenis="bulanan">

                                    Donasi Bulanan

                                </button>

                            </div>

                            <textarea
                                name="pesan"
                                placeholder="Pesan (opsional)"
                                class="w-full rounded-xl border p-4 mb-6"></textarea>

                            <button type="submit"
                                    class="block w-full py-4 rounded-2xl text-white font-semibold"
                                    style="
                                        background:
                                        linear-gradient(
                                            135deg,
                                            var(--color-merah),
                                            var(--color-coklat)
                                        );
                                    ">

                                ❤️ Donasi Sekarang

                            </button>

                        </form>

                        <div class="mt-8">

                            <div class="flex justify-between py-3 border-b">

                                <span>Lokasi</span>

                                <b>{{ $kategori->lokasi }}</b>

                            </div>

                            <div class="flex justify-between py-3 border-b">

                                <span>Minimal Donasi</span>

                                <b>
                                    Rp {{ number_format($kategori->minimal_donasi,0,',','.') }}
                                </b>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- DONATUR TERBARU --}}
<section class="py-20">

    <div class="container mx-auto px-6">

        <h2 class="text-3xl font-bold mb-10">
            Donatur Terbaru
        </h2>

        <div class="space-y-4">

            @forelse($donasiTerbaru as $item)

                <div class="bg-white rounded-2xl p-5 shadow">

                    <div class="flex justify-between items-center">

                        <div>

                            <h4 class="font-bold">
                                {{ $item->user->name ?? 'Hamba Allah' }}
                            </h4>

                            @if($item->tipe == 'bulanan')

                                <span
                                    class="text-xs
                                           px-2 py-1
                                           rounded-full
                                           bg-blue-100
                                           text-blue-700">

                                    Bulanan

                                </span>

                            @else

                                <span
                                    class="text-xs
                                           px-2 py-1
                                           rounded-full
                                           bg-green-100
                                           text-green-700">

                                    Sekali

                                </span>

                            @endif

                            <p class="text-slate-500 text-sm">
                                {{ $item->created_at->diffForHumans() }}
                            </p>

                        </div>

                        <div class="font-bold text-green-600">

                            Rp {{ number_format($item->jumlah,0,',','.') }}

                        </div>

                    </div>

                </div>

            @empty

                <div
                    class="bg-white rounded-3xl p-12 text-center shadow-lg">

                    <div class="text-6xl mb-5">
                        ❤️
                    </div>

                    <h3
                        class="text-2xl font-bold mb-3"
                        style="color: var(--color-hitam);">

                        Donatur Terbaru Belum Ada

                    </h3>

                    <p
                        class="max-w-xl mx-auto"
                        style="color: var(--color-coklat);">

                        Jadilah donatur pertama yang mendukung program ini
                        dan bantu mewujudkan perubahan yang lebih baik.

                    </p>

                </div>

            @endforelse

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
            ">

            <h2
                class="text-4xl font-bold"
                style="color: var(--color-putih);">

                Terima Kasih Atas Dukungan Anda

            </h2>

            <p
                class="mt-4 max-w-2xl mx-auto"
                style="color: rgba(249,246,240,.9);">

                Bersama kita dapat menciptakan dampak yang
                lebih besar bagi pendidikan, sosial,
                dan masyarakat Indonesia.

            </p>

        </div>

    </div>

</section>
<style>

.jenis-btn{
    border:1px solid #d1d5db;
    background:#fff;
}

.jenis-btn.active{
    background: linear-gradient(
        135deg,
        var(--color-merah),
        var(--color-coklat)
    );
    color:white;
    border:none;
}

</style>

<script>

document.querySelectorAll('.nominal-btn').forEach(button => {

    button.addEventListener('click', function () {

        // hapus active semua tombol
        document.querySelectorAll('.nominal-btn')
            .forEach(btn => btn.classList.remove('active'));

        // aktifkan tombol yang dipilih
        this.classList.add('active');

        // isi input nominal
        document.getElementById('nominal').value =
            this.dataset.nominal;
    });

});

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formDonasi');

    document.querySelectorAll('.jenis-btn').forEach(btn => {

        btn.addEventListener('click', function(){

            document.querySelectorAll('.jenis-btn')
                .forEach(x => x.classList.remove('active'));

            this.classList.add('active');

            document.getElementById('jenis_donasi').value =
                this.dataset.jenis;
        });

    });

    form.addEventListener('submit', function(){

        const jenis = document.getElementById('jenis_donasi').value;

        this.action = jenis === 'bulanan'
            ? "{{ route($prefix.'.donasi.langganan') }}"
            : "{{ route($prefix.'.donasi.sekali') }}";

        console.log(jenis);
        console.log(this.action);

    });

});

</script>

@endsection

