@extends('layouts.admin', [
    'activePage' => 'konten'
])

@section('content')

<!-- HEADER -->
<div class="mb-8">

    <h1
        class="text-3xl font-bold"
        style="color: var(--color-hitam);">

        Manajemen Konten

    </h1>

    <p
        class="mt-2"
        style="color: var(--color-coklat);">

        Kelola banner website, postingan berita, dan team member.

    </p>

</div>

<!-- MENU KONTEN -->
<div class="grid lg:grid-cols-3 gap-6">

    <!-- Banner -->
    <div
        class="rounded-3xl overflow-hidden transition hover:-translate-y-2"
        style="
            background: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="h-2"
            style="background-color: var(--color-kuning);">
        </div>

        <div class="p-6">

            <p
                class="text-xs uppercase tracking-[4px] mb-4"
                style="color: var(--color-coklat);">

                Konten

            </p>

            <h3
                class="text-2xl font-bold mb-4"
                style="color: var(--color-hitam);">

                Banner

            </h3>

            <p
                class="leading-7"
                style="color: var(--color-coklat);">

                Kelola banner homepage, upload gambar,
                ubah judul, tombol CTA dan atur urutan slide.

            </p>

            <a href="{{ url('/admin/banner') }}"
               class="inline-flex mt-6 px-5 py-3 rounded-xl font-semibold transition hover:opacity-90"
               style="
                    background-color: var(--color-merah);
                    color: var(--color-putih);
               ">

                Kelola Banner

            </a>

        </div>

    </div>

    <!-- Postingan -->
    <div
        class="rounded-3xl overflow-hidden transition hover:-translate-y-2"
        style="
            background: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="h-2"
            style="background-color: var(--color-merah);">
        </div>

        <div class="p-6">

            <p
                class="text-xs uppercase tracking-[4px] mb-4"
                style="color: var(--color-coklat);">

                Konten

            </p>

            <h3
                class="text-2xl font-bold mb-4"
                style="color: var(--color-hitam);">

                Postingan

            </h3>

            <p
                class="leading-7"
                style="color: var(--color-coklat);">

                Kelola artikel dan berita menggunakan
                editor WYSIWYG seperti QuillJS atau TipTap.

            </p>

            <a href="{{ url('/admin/postingan') }}"
               class="inline-flex mt-6 px-5 py-3 rounded-xl font-semibold transition hover:opacity-90"
               style="
                    background-color: var(--color-merah);
                    color: var(--color-putih);
               ">

                Kelola Postingan

            </a>

        </div>

    </div>

    <!-- Team -->
    <div
        class="rounded-3xl overflow-hidden transition hover:-translate-y-2"
        style="
            background: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="h-2"
            style="background-color: var(--color-coklat);">
        </div>

        <div class="p-6">

            <p
                class="text-xs uppercase tracking-[4px] mb-4"
                style="color: var(--color-coklat);">

                Konten

            </p>

            <h3
                class="text-2xl font-bold mb-4"
                style="color: var(--color-hitam);">

                Team Member

            </h3>

            <p
                class="leading-7"
                style="color: var(--color-coklat);">

                Kelola data pengurus dan anggota tim,
                foto profil, jabatan dan sosial media.

            </p>

            <a href="{{ url('/admin/team') }}"
               class="inline-flex mt-6 px-5 py-3 rounded-xl font-semibold transition hover:opacity-90"
               style="
                    background-color: var(--color-merah);
                    color: var(--color-putih);
               ">

                Kelola Team

            </a>

        </div>

    </div>

</div>

<!-- STATISTIK -->
<div class="grid md:grid-cols-3 gap-6 mt-10">

    <div
        class="rounded-3xl p-6"
        style="
            background: white;
            box-shadow: var(--shadow);
        ">

        <p style="color: var(--color-coklat);">
            Total Banner
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            5

        </h2>

    </div>

    <div
        class="rounded-3xl p-6"
        style="
            background: white;
            box-shadow: var(--shadow);
        ">

        <p style="color: var(--color-coklat);">
            Total Postingan
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            24

        </h2>

    </div>

    <div
        class="rounded-3xl p-6"
        style="
            background: white;
            box-shadow: var(--shadow);
        ">

        <p style="color: var(--color-coklat);">
            Team Member
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            12

        </h2>

    </div>

</div>

@endsection