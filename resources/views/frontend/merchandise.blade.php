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

            Merchandise Resmi

        </span>

        <h1 class="text-5xl font-bold mt-4 text-white">
            Merchandise Sikola Foundation
        </h1>

        <p
            class="mt-4 max-w-2xl mx-auto text-lg"
            style="color: rgba(249,246,240,.9);">

            Dukung program pendidikan dan sosial dengan membeli
            merchandise resmi Sikola Foundation.

        </p>

    </div>

</section>

<!-- FILTER -->
<section
    class="py-10"
    style="
        background-color: var(--color-putih);
        border-bottom: 2px solid rgba(212,160,23,.15);
    ">

    <div class="container mx-auto px-6">

        <div class="flex flex-wrap justify-center gap-3">

            <!-- Active -->
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
                Kaos
            </button>

            <button
                class="px-6 py-2 rounded-full transition"
                style="
                    background-color: rgba(212,160,23,.15);
                    color: var(--color-hitam);
                ">
                Topi
            </button>

            <button
                class="px-6 py-2 rounded-full transition"
                style="
                    background-color: rgba(212,160,23,.15);
                    color: var(--color-hitam);
                ">
                Tumbler
            </button>

        </div>

    </div>

</section>

<!-- PRODUCT LIST -->
<section
    class="py-20"
    style="background-color: rgba(212,160,23,.08);">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            @for($i=1;$i<=8;$i++)

            <div
                class="rounded-3xl overflow-hidden transition duration-300 hover:-translate-y-2"
                style="
                    background-color: white;
                    box-shadow: var(--shadow);
                ">

                <img
                    src="https://picsum.photos/500/350?random={{ $i }}"
                    class="w-full h-64 object-cover"
                    alt="Merchandise">

                <div class="p-6">

                    <span
                        class="inline-block px-3 py-1 rounded-full text-xs font-medium"
                        style="
                            background-color: rgba(212,160,23,.15);
                            color: var(--color-kuning);
                        ">
                        Merchandise
                    </span>

                    <h3
                        class="font-bold text-xl mt-4"
                        style="color: var(--color-hitam);">

                        Kaos Sikola Foundation

                    </h3>

                    <p
                        class="mt-2"
                        style="color: var(--color-coklat);">

                        Kaos premium dengan desain eksklusif
                        Sikola Foundation.

                    </p>

                    <div
                        class="mt-4 text-2xl font-bold"
                        style="color: var(--color-merah);">

                        Rp 150.000

                    </div>

                    <button
                        class="w-full mt-5 py-3 rounded-xl font-semibold transition"
                        style="
                            background-color: var(--color-merah);
                            color: var(--color-putih);
                        "
                        onmouseover="this.style.backgroundColor='var(--color-coklat)'"
                        onmouseout="this.style.backgroundColor='var(--color-merah)'">

                        🛒 Tambah ke Keranjang

                    </button>

                </div>

            </div>

            @endfor

        </div>

    </div>

</section>

@endsection