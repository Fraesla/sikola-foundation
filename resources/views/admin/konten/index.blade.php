@extends('layouts.admin', [
    'activePage' => 'konten'
])

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold text-slate-800">
        Manajemen Konten
    </h1>

    <p class="text-slate-500 mt-2">
        Kelola banner website, postingan berita, dan team member.
    </p>

</div>

<div class="grid lg:grid-cols-3 gap-6">

    <!-- Banner -->
    <div
        class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-lg transition">

        <div class="h-1 bg-amber-500"></div>

        <div class="p-6">

            <p class="text-xs tracking-[4px] uppercase text-slate-500 mb-4">
                Konten
            </p>

            <h3 class="text-2xl font-bold text-slate-800 mb-4">
                Banner
            </h3>

            <p class="text-slate-600 leading-7">
                Kelola banner homepage, upload gambar,
                ubah judul, tombol CTA dan atur urutan drag & drop.
            </p>

            <a href="{{ url('/admin/banner') }}"
                class="inline-flex mt-6 bg-blue-600 text-white px-5 py-2 rounded-lg">

                Kelola Banner

            </a>

        </div>

    </div>

    <!-- Postingan -->
    <div
        class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-lg transition">

        <div class="h-1 bg-blue-600"></div>

        <div class="p-6">

            <p class="text-xs tracking-[4px] uppercase text-slate-500 mb-4">
                Konten
            </p>

            <h3 class="text-2xl font-bold text-slate-800 mb-4">
                Postingan
            </h3>

            <p class="text-slate-600 leading-7">
                Kelola artikel dan berita menggunakan editor
                WYSIWYG QuillJS atau TipTap.
            </p>

            <a href="{{ url('/admin/postingan') }}"
                class="inline-flex mt-6 bg-blue-600 text-white px-5 py-2 rounded-lg">

                Kelola Postingan

            </a>

        </div>

    </div>

    <!-- Team -->
    <div
        class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-lg transition">

        <div class="h-1 bg-green-600"></div>

        <div class="p-6">

            <p class="text-xs tracking-[4px] uppercase text-slate-500 mb-4">
                Konten
            </p>

            <h3 class="text-2xl font-bold text-slate-800 mb-4">
                Team Member
            </h3>

            <p class="text-slate-600 leading-7">
                Kelola data pengurus dan anggota tim,
                foto profil, jabatan dan sosial media.
            </p>

            <a href="{{ url('/admin/team') }}"
                class="inline-flex mt-6 bg-blue-600 text-white px-5 py-2 rounded-lg">

                Kelola Team

            </a>

        </div>

    </div>

</div>

<!-- Ringkasan Statistik -->
<div class="grid md:grid-cols-3 gap-6 mt-10">

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-slate-500">
            Total Banner
        </p>

        <h2 class="text-4xl font-bold mt-3">
            5
        </h2>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-slate-500">
            Total Postingan
        </p>

        <h2 class="text-4xl font-bold mt-3">
            24
        </h2>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-slate-500">
            Team Member
        </p>

        <h2 class="text-4xl font-bold mt-3">
            12
        </h2>

    </div>

</div>

@endsection