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

    <div class="container mx-auto px-6 text-center text-white">

    	 <!-- Back Button -->
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

        <span
            class="uppercase tracking-[4px]"
            style="color: var(--color-kuning);">
            Program Relawan
        </span>

        <h1 class="text-5xl md:text-6xl font-bold mt-4">
            Bergabung Menjadi Relawan
        </h1>

        <p
            class="mt-5 max-w-3xl mx-auto text-lg"
            style="color: rgba(249,246,240,.9);">

            Bersama Sikola Foundation, mari berkontribusi
            dalam kegiatan pendidikan, sosial, donasi,
            dan pemberdayaan masyarakat.

        </p>

    </div>

</section>

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
            <div>

                <div
                    class="rounded-3xl p-8"
                    style="
                        background-color: white;
                        box-shadow: var(--shadow);
                    ">

                    <h3
                        class="text-2xl font-bold mb-6"
                        style="color: var(--color-hitam);">

                        Form Pendaftaran Relawan

                    </h3>

                    <form>

                        <input
                            type="text"
                            placeholder="Nama Lengkap"
                            class="w-full p-4 rounded-xl mb-4 border"
                            style="
                                border-color:
                                rgba(212,160,23,.3);
                            ">

                        <input
                            type="email"
                            placeholder="Email"
                            class="w-full p-4 rounded-xl mb-4 border"
                            style="
                                border-color:
                                rgba(212,160,23,.3);
                            ">

                        <input
                            type="text"
                            placeholder="Nomor HP"
                            class="w-full p-4 rounded-xl mb-4 border"
                            style="
                                border-color:
                                rgba(212,160,23,.3);
                            ">

                        <textarea
                            rows="5"
                            placeholder="Motivasi Bergabung"
                            class="w-full p-4 rounded-xl mb-4 border"
                            style="
                                border-color:
                                rgba(212,160,23,.3);
                            "></textarea>

                        <button
                            type="submit"
                            class="w-full py-4 rounded-xl font-semibold transition hover:opacity-90"
                            style="
                                background-color:
                                var(--color-merah);

                                color:
                                var(--color-putih);
                            ">

                            🤝 Daftar Menjadi Relawan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection