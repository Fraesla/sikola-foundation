@extends('layouts.app')

@section('content')

<!-- HERO -->
<section
    class="py-24"
    style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
    ">

    <div class="container mx-auto px-6 text-center">

        <span
            class="uppercase tracking-[4px]"
            style="color: var(--color-kuning);">

            Struktur Organisasi

        </span>

        <h1 class="text-5xl font-bold mt-4 text-white">
            Tim Sikola Foundation
        </h1>

        <p
            class="mt-4 max-w-3xl mx-auto text-lg"
            style="color: rgba(249,246,240,.9);">

            Orang-orang hebat yang bekerja bersama untuk
            mewujudkan program pendidikan, sosial, dan kemanusiaan.

        </p>

    </div>

</section>

<!-- TEAM -->
<section
    class="py-20"
    style="background-color: var(--color-putih);">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            @for($i=1;$i<=8;$i++)

            <div
                class="rounded-3xl overflow-hidden text-center transition duration-300 hover:-translate-y-2"
                style="
                    background-color: white;
                    box-shadow: var(--shadow);
                ">

                <!-- HEADER -->
                <div
                    class="h-24"
                    style="
                        background:
                        linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">
                </div>

                <!-- PHOTO -->
                <div class="-mt-14">

                    <img
                        src="https://i.pravatar.cc/300?img={{ $i }}"
                        class="
                            w-28 h-28
                            rounded-full
                            mx-auto
                            border-4
                        "
                        style="
                            border-color: var(--color-kuning);
                        ">

                </div>

                <!-- CONTENT -->
                <div class="p-6">

                    <h3
                        class="text-xl font-bold"
                        style="color: var(--color-hitam);">

                        Team Member {{ $i }}

                    </h3>

                    <p
                        class="mt-2 font-medium"
                        style="color: var(--color-merah);">

                        Koordinator Program

                    </p>

                    <p
                        class="mt-4 text-sm leading-6"
                        style="color: var(--color-coklat);">

                        Berperan dalam mengelola dan
                        menjalankan berbagai program
                        sosial dan pendidikan yayasan.

                    </p>

                    <!-- SOCIAL -->
                    <div class="flex justify-center gap-3 mt-6">

                        <a href="#"
                           class="w-10 h-10 rounded-full flex items-center justify-center transition"
                           style="
                                background-color: rgba(212,160,23,.15);
                                color: var(--color-merah);
                           ">
                            🌐
                        </a>

                        <a href="#"
                           class="w-10 h-10 rounded-full flex items-center justify-center transition"
                           style="
                                background-color: rgba(212,160,23,.15);
                                color: var(--color-merah);
                           ">
                            📘
                        </a>

                        <a href="#"
                           class="w-10 h-10 rounded-full flex items-center justify-center transition"
                           style="
                                background-color: rgba(212,160,23,.15);
                                color: var(--color-merah);
                           ">
                            📷
                        </a>

                        <a href="#"
                           class="w-10 h-10 rounded-full flex items-center justify-center transition"
                           style="
                                background-color: rgba(212,160,23,.15);
                                color: var(--color-merah);
                           ">
                            💼
                        </a>

                    </div>

                </div>

            </div>

            @endfor

        </div>

    </div>

</section>

<!-- CTA -->
<section
    class="py-20"
    style="
        background-color: rgba(212,160,23,.08);
    ">

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

            <h2 class="text-4xl font-bold text-white">
                Bergabung Menjadi Relawan
            </h2>

            <p
                class="mt-4 max-w-2xl mx-auto"
                style="color: rgba(249,246,240,.9);">

                Jadilah bagian dari perubahan dan ikut
                berkontribusi dalam program-program
                Sikola Foundation.

            </p>

            <a href="{{ url('/relawan') }}"
               class="inline-block mt-8 px-8 py-4 rounded-xl font-bold"
               style="
                    background-color: var(--color-kuning);
                    color: var(--color-hitam);
               ">

                Daftar Relawan

            </a>

        </div>

    </div>

</section>

@endsection