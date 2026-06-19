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
            Donasi
        </span>

        <h1 class="text-5xl md:text-6xl font-bold mt-4">
            Bersama Membawa Perubahan
        </h1>

        <p
            class="mt-5 max-w-3xl mx-auto text-lg"
            style="color: rgba(249,246,240,.9);">

            Setiap donasi yang Anda berikan membantu
            mendukung program pendidikan, kegiatan sosial,
            dan pemberdayaan masyarakat yang dijalankan
            oleh Sikola Foundation.

        </p>

    </div>

</section>

<!-- DONASI -->
<section
    class="py-20"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-10">

            <!-- FORM -->
            <div
                class="rounded-3xl p-8"
                style="
                    background-color: white;
                    box-shadow: var(--shadow);
                ">

                <h2
                    class="text-3xl font-bold mb-8"
                    style="color: var(--color-hitam);">

                    Form Donasi

                </h2>

                <form class="space-y-5">

                    <input
                        type="text"
                        placeholder="Nama Donatur"
                        class="w-full rounded-xl p-4 border outline-none"
                        style="border-color: rgba(212,160,23,.3);">

                    <input
                        type="email"
                        placeholder="Email"
                        class="w-full rounded-xl p-4 border outline-none"
                        style="border-color: rgba(212,160,23,.3);">

                    <input
                        type="number"
                        placeholder="Nominal Donasi"
                        class="w-full rounded-xl p-4 border outline-none"
                        style="border-color: rgba(212,160,23,.3);">

                    <select
                        class="w-full rounded-xl p-4 border outline-none"
                        style="border-color: rgba(212,160,23,.3);">

                        <option>Donasi Sekali</option>
                        <option>Donasi Bulanan</option>

                    </select>

                    <button
                        type="submit"
                        class="w-full py-4 rounded-xl font-semibold transition hover:opacity-90"
                        style="
                            background-color: var(--color-merah);
                            color: var(--color-putih);
                        ">

                        ❤️ Donasi Sekarang

                    </button>

                </form>

            </div>

            <!-- REKENING -->
            <div
                class="rounded-3xl p-8"
                style="
                    background-color: rgba(212,160,23,.08);
                    border: 1px solid rgba(212,160,23,.15);
                ">

                <h2
                    class="text-3xl font-bold mb-8"
                    style="color: var(--color-hitam);">

                    Informasi Rekening

                </h2>

                <div class="space-y-6">

                    <div
                        class="rounded-2xl p-6 bg-white"
                        style="box-shadow: var(--shadow);">

                        <p
                            class="font-bold text-lg"
                            style="color: var(--color-merah);">

                            Bank BCA

                        </p>

                        <p style="color: var(--color-coklat);">
                            1234567890
                        </p>

                        <p style="color: var(--color-coklat);">
                            a.n Sikola Foundation
                        </p>

                    </div>

                    <div
                        class="rounded-2xl p-6 bg-white"
                        style="box-shadow: var(--shadow);">

                        <p
                            class="font-bold text-lg"
                            style="color: var(--color-merah);">

                            Bank Mandiri

                        </p>

                        <p style="color: var(--color-coklat);">
                            9876543210
                        </p>

                        <p style="color: var(--color-coklat);">
                            a.n Sikola Foundation
                        </p>

                    </div>

                </div>

                <!-- INFO -->
                <div
                    class="mt-8 rounded-2xl p-6"
                    style="
                        background-color: rgba(204,34,34,.08);
                    ">

                    <h3
                        class="font-bold mb-3"
                        style="color: var(--color-merah);">

                        💡 Informasi Donasi

                    </h3>

                    <p style="color: var(--color-coklat);">

                        Setelah melakukan transfer,
                        mohon lakukan konfirmasi pembayaran
                        agar donasi dapat segera kami verifikasi.

                    </p>

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

@endsection