@extends('layouts.admin', [
    'activePage' => 'relawan'
])

@section('content')

<!-- HEADER -->
<div class="mb-8">

    <span
        class="uppercase tracking-[4px] text-xs font-semibold"
        style="color: var(--color-kuning);">

        Volunteer Center

    </span>

    <h1
        class="text-4xl font-bold mt-2"
        style="color: var(--color-hitam);">

        Verifikasi Relawan

    </h1>

    <p
        class="mt-2"
        style="color: var(--color-coklat);">

        Kelola pendaftaran volunteer, verifikasi dokumen,
        dan persetujuan anggota relawan.

    </p>

</div>

<!-- STATISTIK -->
<div class="grid md:grid-cols-3 gap-6 mb-8">

    <div
        class="rounded-3xl p-6"
        style="
            background: white;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--color-kuning);
        ">

        <p style="color: var(--color-coklat);">
            Total Pendaftar
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            128

        </h2>

    </div>

    <div
        class="rounded-3xl p-6"
        style="
            background: white;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--color-merah);
        ">

        <p style="color: var(--color-coklat);">
            Menunggu Verifikasi
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            12

        </h2>

    </div>

    <div
        class="rounded-3xl p-6"
        style="
            background: white;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--color-coklat);
        ">

        <p style="color: var(--color-coklat);">
            Relawan Aktif
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            96

        </h2>

    </div>

</div>

<!-- TABLE -->
<div
    class="rounded-3xl overflow-hidden"
    style="
        background: white;
        box-shadow: var(--shadow);
    ">

    <div
        class="h-2"
        style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
        ">
    </div>

    <div class="p-6 border-b">

        <h3
            class="text-xl font-bold"
            style="color: var(--color-hitam);">

            Daftar Verifikasi Relawan

        </h3>

    </div>

    <table class="w-full">

        <thead
            style="
                background-color:
                rgba(212,160,23,.08);
            ">

            <tr>

                <th class="p-4 text-left">
                    Nama
                </th>

                <th class="p-4 text-left">
                    Email
                </th>

                <th class="p-4 text-left">
                    Dokumen
                </th>

                <th class="p-4 text-left">
                    Status
                </th>

                <th class="p-4 text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

            <tr
                class="border-t"
                style="
                    border-color:
                    rgba(212,160,23,.15);
                ">

                <td class="p-4">
                    Farhan Maulidani
                </td>

                <td class="p-4">
                    farhan@gmail.com
                </td>

                <td class="p-4">

                    <button
                        style="
                            color:
                            var(--color-merah);
                        ">

                        👁 Preview KTP

                    </button>

                </td>

                <td class="p-4">

                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold"
                        style="
                            background-color:
                            rgba(212,160,23,.15);

                            color:
                            var(--color-coklat);
                        ">

                        Pending

                    </span>

                </td>

                <td class="p-4 text-center">

                    <button
                        class="px-4 py-2 rounded-xl font-semibold transition hover:opacity-90"
                        style="
                            background-color:
                            var(--color-kuning);

                            color:
                            var(--color-hitam);
                        ">

                        Setujui

                    </button>

                    <button
                        class="px-4 py-2 rounded-xl ml-2 font-semibold transition hover:opacity-90"
                        style="
                            background-color:
                            var(--color-merah);

                            color:
                            var(--color-putih);
                        ">

                        Tolak

                    </button>

                </td>

            </tr>

        </tbody>

    </table>

</div>

@endsection