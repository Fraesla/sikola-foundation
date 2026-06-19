@extends('layouts.admin', [
    'activePage' => 'event'
])

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1
    class="text-3xl font-bold"
    style="color: var(--color-hitam);">Manajemen Event</h1>
        <p
    class="mt-2"
    style="color: var(--color-coklat);">
            Kelola event, peserta, kehadiran dan poin volunteer.
        </p>
    </div>

    <a href="#"
   class="px-5 py-3 rounded-xl font-semibold transition hover:opacity-90"
   style="
        background-color: var(--color-merah);
        color: var(--color-putih);
   ">

        + Tambah Event

    </a>

</div>

<!-- Statistik -->
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div
    class="p-6 rounded-3xl"
    style="
        background: white;
        box-shadow: var(--shadow);
    ">
        <p style="color: var(--color-coklat);">
            Total Event
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-merah);">
            12
        </h2>
    </div>

    <div
    class="p-6 rounded-3xl"
    style="
        background: white;
        box-shadow: var(--shadow);
    ">
        <p style="color: var(--color-coklat);">Upcoming</p>
        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-kuning);">
            5
        </h2>
    </div>

    <div
    class="p-6 rounded-3xl"
    style="
        background: white;
        box-shadow: var(--shadow);
    ">
        <p style="color: var(--color-coklat);">Peserta</p>
        <h2 class="text-3xl font-bold mt-2">245</h2>
    </div>

    <div
    class="p-6 rounded-3xl"
    style="
        background: white;
        box-shadow: var(--shadow);
    ">
        <p style="color: var(--color-coklat);">Volunteer Hadir</p>
        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-coklat);">
            180
        </h2>
    </div>

</div>

<!-- Tabel Event -->
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
    "></div>


    <div class="p-6 border-b">

        <h3 class="font-bold text-lg">
            Daftar Event
        </h3>

    </div>


    <table class="w-full">

        <thead
            style="
                background-color:
                rgba(212,160,23,.08);
            ">

            <tr>

                <th class="p-4 text-left" style="color: var(--color-hitam);">Event</th>
                <th class="p-4 text-left" style="color: var(--color-hitam);">Tanggal</th>
                <th class="p-4 text-left" style="color: var(--color-hitam);">Lokasi</th>
                <th class="p-4 text-left" style="color: var(--color-hitam);">Peserta</th>
                <th class="p-4 text-left" style="color: var(--color-hitam);">Status</th>
                <th class="p-4 text-center" style="color: var(--color-hitam);">Aksi</th>

            </tr>

        </thead>

        <tbody>

            <tr class="border-t">

                <td class="p-4">
                    Seminar Pendidikan 2026
                </td>

                <td class="p-4">
                    20 Jan 2026
                </td>

                <td class="p-4">
                    Padang
                </td>

                <td class="p-4">
                    65 / 100
                </td>

                <td class="p-4">
                    <span
    class="px-3 py-1 rounded-full text-sm font-semibold"
    style="
        background-color:
        rgba(212,160,23,.15);

        color:
        var(--color-merah);
    ">
                        Upcoming
                    </span>
                </td>

                <td class="p-4 text-center">

                    <button
    class="font-medium"
    style="color: var(--color-merah);">

    Peserta

</button>

                    <button
    class="ml-3 font-medium"
    style="color: var(--color-kuning);">

    Edit

</button>
<button
    class="ml-3 font-medium"
    style="color: #dc2626;">

    Hapus

</button>

                </td>

            </tr>

        </tbody>

    </table>

</div>

@endsection