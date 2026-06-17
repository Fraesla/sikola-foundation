@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="bg-gradient-to-r from-blue-600 to-cyan-500 py-24">

    <div class="container mx-auto px-6 text-center text-white">

        <span class="uppercase tracking-widest text-blue-100">
            Tentang Kami
        </span>

        <h1 class="text-5xl md:text-6xl font-bold mt-4">
            Sikola Foundation
        </h1>

        <p class="mt-6 max-w-3xl mx-auto text-xl text-blue-100">
            Yayasan yang berfokus pada pendidikan, kegiatan sosial,
            pengembangan masyarakat, dan pemberdayaan generasi muda.
        </p>

    </div>

</section>

<!-- SEJARAH -->
<section class="py-24 bg-white">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div>

                <span class="text-blue-600 font-semibold">
                    SEJARAH YAYASAN
                </span>

                <h2 class="text-4xl font-bold mt-3">
                    Awal Berdirinya Sikola Foundation
                </h2>

                <p class="mt-6 text-slate-600 leading-8">
                    Sikola Foundation didirikan dengan tujuan membantu
                    masyarakat memperoleh akses pendidikan yang lebih baik,
                    memperluas kesempatan belajar, dan mendukung kegiatan
                    sosial yang memberikan dampak positif bagi lingkungan.
                </p>

                <p class="mt-4 text-slate-600 leading-8">
                    Sejak berdiri, yayasan telah melaksanakan berbagai
                    program pendidikan, pelatihan, donasi, kegiatan sosial,
                    serta kolaborasi dengan berbagai pihak untuk menciptakan
                    perubahan yang berkelanjutan.
                </p>

            </div>

            <div>

                <div class="bg-blue-50 rounded-3xl p-12">

                    <div class="text-center">

                        <div class="text-6xl mb-4">
                            🏢
                        </div>

                        <h3 class="text-2xl font-bold">
                            Berdiri Sejak 2025
                        </h3>

                        <p class="mt-3 text-slate-600">
                            Berkomitmen memberikan kontribusi nyata
                            melalui pendidikan dan kegiatan sosial.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- VISI MISI -->
<section class="py-24 bg-slate-50">

    <div class="container mx-auto px-6">

        <div class="text-center mb-16">

            <span class="text-blue-600 font-semibold">
                VISI & MISI
            </span>

            <h2 class="text-4xl font-bold mt-3">
                Arah dan Tujuan Yayasan
            </h2>

        </div>

        <div class="grid lg:grid-cols-2 gap-8">

            <!-- VISI -->
            <div class="bg-white rounded-3xl p-10 shadow-sm">

                <div
                    class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl">
                    🎯
                </div>

                <h3 class="text-3xl font-bold mt-6">
                    Visi
                </h3>

                <p class="mt-4 text-slate-600 leading-8">
                    Menjadi yayasan yang berkontribusi dalam
                    meningkatkan kualitas pendidikan, sosial,
                    dan pemberdayaan masyarakat secara berkelanjutan.
                </p>

            </div>

            <!-- MISI -->
            <div class="bg-white rounded-3xl p-10 shadow-sm">

                <div
                    class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center text-3xl">
                    🚀
                </div>

                <h3 class="text-3xl font-bold mt-6">
                    Misi
                </h3>

                <ul class="mt-4 space-y-3 text-slate-600">

                    <li>✓ Menyelenggarakan program pendidikan.</li>

                    <li>✓ Mendorong kegiatan sosial kemasyarakatan.</li>

                    <li>✓ Memberikan dukungan melalui program donasi.</li>

                    <li>✓ Mengembangkan relawan dan anggota yayasan.</li>

                    <li>✓ Membangun kolaborasi dengan berbagai pihak.</li>

                </ul>

            </div>

        </div>

    </div>

</section>

<!-- TEAM -->
<section class="py-24 bg-white">

    <div class="container mx-auto px-6">

        <div class="text-center mb-16">

            <span class="text-blue-600 font-semibold">
                TEAM MEMBER
            </span>

            <h2 class="text-4xl font-bold mt-3">
                Pengurus Yayasan
            </h2>

            <p class="mt-4 text-slate-500">
                Orang-orang yang berperan dalam menjalankan program yayasan.
            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Ketua -->
            <div class="bg-slate-50 rounded-3xl p-8 text-center">

                <div
                    class="w-28 h-28 mx-auto rounded-full bg-blue-100 flex items-center justify-center text-5xl">
                    👨
                </div>

                <h3 class="font-bold text-xl mt-5">
                    Nama Ketua
                </h3>

                <p class="text-slate-500">
                    Ketua Yayasan
                </p>

            </div>

            <!-- Sekretaris -->
            <div class="bg-slate-50 rounded-3xl p-8 text-center">

                <div
                    class="w-28 h-28 mx-auto rounded-full bg-green-100 flex items-center justify-center text-5xl">
                    👩
                </div>

                <h3 class="font-bold text-xl mt-5">
                    Nama Sekretaris
                </h3>

                <p class="text-slate-500">
                    Sekretaris
                </p>

            </div>

            <!-- Bendahara -->
            <div class="bg-slate-50 rounded-3xl p-8 text-center">

                <div
                    class="w-28 h-28 mx-auto rounded-full bg-yellow-100 flex items-center justify-center text-5xl">
                    👨
                </div>

                <h3 class="font-bold text-xl mt-5">
                    Nama Bendahara
                </h3>

                <p class="text-slate-500">
                    Bendahara
                </p>

            </div>

            <!-- Koordinator -->
            <div class="bg-slate-50 rounded-3xl p-8 text-center">

                <div
                    class="w-28 h-28 mx-auto rounded-full bg-purple-100 flex items-center justify-center text-5xl">
                    👩
                </div>

                <h3 class="font-bold text-xl mt-5">
                    Nama Koordinator
                </h3>

                <p class="text-slate-500">
                    Koordinator Program
                </p>

            </div>

        </div>

    </div>

</section>

@endsection