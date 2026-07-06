@extends('layouts.app')

@section('content')

<!-- HERO -->
@if($bannerRelawan->count() > 0)

<section class="relative">

    <div class="swiper relawanSwiper">

        <div class="swiper-wrapper">

            @foreach($bannerRelawan as $banner)

            <div class="swiper-slide">

                <section class="relative min-h-[500px] md:min-h-[550px] flex items-center overflow-hidden">

                    <!-- Background -->
                    <img src="{{ asset('storage/'.$banner->gambar) }}"
                         class="absolute inset-0 w-full h-full object-cover"
                         alt="{{ $banner->judul }}">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/60"></div>

                    <!-- Back Button -->
                    <a href="{{ url()->previous() }}"
                       class="absolute top-8 left-8 z-30 inline-flex items-center gap-3 px-5 py-3 rounded-xl"
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

                    <!-- Content -->
                    <div class="container mx-auto px-6 relative z-20 text-center text-white">

                        <span class="uppercase tracking-[4px]"
                              style="color: var(--color-kuning);">
                            Program Relawan
                        </span>

                        <h1 class="text-5xl md:text-6xl font-bold mt-4">
                            {{ $banner->judul }}
                        </h1>

                        <p class="mt-5 max-w-3xl mx-auto text-lg">
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
    class="relative py-24"
    style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
    ">

    <div class="container mx-auto px-6 text-center text-white">

        <a href="{{ url('/#program') }}"
           class="absolute top-8 left-10 z-20 inline-flex items-center gap-3 px-5 py-3 rounded-xl"
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

        <span class="uppercase tracking-[4px]"
              style="color: var(--color-kuning);">
            Program Relawan
        </span>

        <h1 class="text-5xl md:text-6xl font-bold mt-4">
            Bergabung Menjadi Relawan
        </h1>

        <p class="mt-5 max-w-3xl mx-auto text-lg"
           style="color: rgba(249,246,240,.9);">

            Bersama Sikola Foundation, mari berkontribusi
            dalam kegiatan pendidikan, sosial, donasi,
            dan pemberdayaan masyarakat.

        </p>

    </div>

</section>

@endif

<!-- CONTENT -->
<section
    class="py-20"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-12 items-start">

            <!-- INFORMASI -->
            <div>

                <span
                    class="font-semibold"
                    style="color: var(--color-merah);">
                    MENJADI RELAWAN
                </span>

                <h2
                    class="text-4xl font-bold mt-3"
                    style="color: var(--color-hitam);">

                    Bersama Membawa Dampak Positif

                </h2>

                <p
                    class="mt-6 leading-8"
                    style="color: var(--color-coklat);">

                    Relawan merupakan bagian penting dalam
                    mendukung berbagai program Sikola Foundation.
                    Anda dapat berkontribusi melalui kegiatan
                    sosial, pendidikan, donasi, pelatihan,
                    maupun pemberdayaan masyarakat.

                </p>

                <div class="mt-8 space-y-4">

                    <div
                        class="flex items-center gap-4 p-4 rounded-2xl"
                        style="
                            background-color:
                            rgba(212,160,23,.12);
                        ">

                        <span class="text-2xl">🎓</span>

                        <div>

                            <h4
                                class="font-bold"
                                style="color: var(--color-hitam);">

                                Program Pendidikan

                            </h4>

                            <p
                                style="color: var(--color-coklat);">

                                Mengajar dan mendampingi peserta didik.

                            </p>

                        </div>

                    </div>

                    <div
                        class="flex items-center gap-4 p-4 rounded-2xl"
                        style="
                            background-color:
                            rgba(204,34,34,.08);
                        ">

                        <span class="text-2xl">🤝</span>

                        <div>

                            <h4
                                class="font-bold"
                                style="color: var(--color-hitam);">

                                Kegiatan Sosial

                            </h4>

                            <p
                                style="color: var(--color-coklat);">

                                Mendukung program sosial dan kemanusiaan.

                            </p>

                        </div>

                    </div>

                    <div
                        class="flex items-center gap-4 p-4 rounded-2xl"
                        style="
                            background-color:
                            rgba(139,94,42,.08);
                        ">

                        <span class="text-2xl">🌱</span>

                        <div>

                            <h4
                                class="font-bold"
                                style="color: var(--color-hitam);">

                                Pengabdian Masyarakat

                            </h4>

                            <p
                                style="color: var(--color-coklat);">

                                Membantu pemberdayaan masyarakat lokal.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- FORM -->
            <div class="rounded-3xl p-8 md:p-10"
                 style="
                    background:white;
                    box-shadow: var(--shadow);
                 ">

                <form action="{{ url('relawan/daftar') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">

                        {{-- NIK --}}
                        <div>
                            <label class="font-semibold mb-2 block">
                                NIK
                            </label>

                            <input
                                type="text"
                                name="nik"
                                value="{{ old('nik') }}"
                                class="w-full rounded-xl border p-4">

                            @error('nik')
                                <small class="text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>


                        {{-- NO HP --}}
                        <div>
                            <label class="font-semibold mb-2 block">
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                name="no_telepon"
                                value="{{ old('no_telepon') }}"
                                class="w-full rounded-xl border p-4">
                        </div>


                        {{-- TEMPAT LAHIR --}}
                        <div>
                            <label class="font-semibold mb-2 block">
                                Tempat Lahir
                            </label>

                            <input
                                type="text"
                                name="tempat_lahir"
                                value="{{ old('tempat_lahir') }}"
                                class="w-full rounded-xl border p-4">
                        </div>


                        {{-- TANGGAL LAHIR --}}
                        <div>
                            <label class="font-semibold mb-2 block">
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                name="tanggal_lahir"
                                class="w-full rounded-xl border p-4">
                        </div>


                        {{-- JK --}}
                        <div>
                            <label class="font-semibold mb-2 block">
                                Jenis Kelamin
                            </label>

                            <select
                                name="jenis_kelamin"
                                class="w-full rounded-xl border p-4">

                                <option value="">
                                    Pilih Jenis Kelamin
                                </option>

                                <option value="L">
                                    Laki-laki
                                </option>

                                <option value="P">
                                    Perempuan
                                </option>

                            </select>
                        </div>


                        {{-- PEKERJAAN --}}
                        <div>
                            <label class="font-semibold mb-2 block">
                                Pekerjaan
                            </label>

                            <input
                                type="text"
                                name="pekerjaan"
                                class="w-full rounded-xl border p-4">
                        </div>


                        {{-- PENDIDIKAN --}}
                        <div class="md:col-span-2">

                            <label class="font-semibold mb-2 block">
                                Pendidikan Terakhir
                            </label>

                            <input
                                type="text"
                                name="pendidikan"
                                class="w-full rounded-xl border p-4">

                        </div>


                        {{-- ALAMAT --}}
                        <div class="md:col-span-2">

                            <label class="font-semibold mb-2 block">
                                Alamat
                            </label>

                            <textarea
                                rows="4"
                                name="alamat"
                                class="w-full rounded-xl border p-4"></textarea>

                        </div>


                        {{-- KEAHLIAN --}}
                        <div class="md:col-span-2">

                            <label class="font-semibold mb-2 block">
                                Keahlian
                            </label>

                            <textarea
                                rows="4"
                                name="keahlian"
                                placeholder="Contoh : Mengajar, Desain Grafis, Public Speaking"
                                class="w-full rounded-xl border p-4"></textarea>

                        </div>


                        {{-- ORGANISASI --}}
                        <div class="md:col-span-2">

                            <label class="font-semibold mb-2 block">
                                Pengalaman Organisasi
                            </label>

                            <textarea
                                rows="4"
                                name="pengalaman_organisasi"
                                class="w-full rounded-xl border p-4"></textarea>

                        </div>


                        {{-- MOTIVASI --}}
                        <div class="md:col-span-2">

                            <label class="font-semibold mb-2 block">
                                Motivasi Bergabung
                            </label>

                            <textarea
                                rows="5"
                                name="motivasi"
                                class="w-full rounded-xl border p-4"></textarea>

                        </div>


                        {{-- FOTO KTP --}}
                        <div class="md:col-span-2">

                            <label class="font-semibold mb-2 block">
                                Upload Foto KTP
                            </label>

                            <input
                                type="file"
                                name="foto_ktp"
                                class="w-full rounded-xl border p-4">

                            <small class="text-slate-500">
                                Format JPG/PNG maksimal 2MB
                            </small>

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="w-full mt-10 py-5 rounded-2xl text-white font-bold text-lg transition hover:opacity-90"
                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                        🤝 Daftar Menjadi Relawan

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection