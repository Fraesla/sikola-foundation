@extends('layouts.admin', [
    'activePage' => 'event'
])

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold">Manajemen Event</h1>
        <p class="text-slate-500 mt-2">
            Kelola event, peserta, kehadiran dan poin volunteer.
        </p>
    </div>

    <a href="#"
       class="bg-blue-600 text-white px-5 py-3 rounded-xl">

        + Tambah Event

    </a>

</div>

<!-- Statistik -->
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-slate-500">Total Event</p>
        <h2 class="text-3xl font-bold mt-2">12</h2>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-slate-500">Upcoming</p>
        <h2 class="text-3xl font-bold mt-2 text-blue-600">5</h2>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-slate-500">Peserta</p>
        <h2 class="text-3xl font-bold mt-2">245</h2>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-slate-500">Volunteer Hadir</p>
        <h2 class="text-3xl font-bold mt-2 text-green-600">180</h2>
    </div>

</div>

<!-- Tabel Event -->
<div class="bg-white rounded-2xl shadow overflow-hidden">

    <div class="p-6 border-b">

        <h3 class="font-bold text-lg">
            Daftar Event
        </h3>

    </div>

    <table class="w-full">

        <thead class="bg-slate-50">

            <tr>

                <th class="p-4 text-left">Event</th>
                <th class="p-4 text-left">Tanggal</th>
                <th class="p-4 text-left">Lokasi</th>
                <th class="p-4 text-left">Peserta</th>
                <th class="p-4 text-left">Status</th>
                <th class="p-4 text-center">Aksi</th>

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
                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                        Upcoming
                    </span>
                </td>

                <td class="p-4 text-center">

                    <button class="text-blue-600">
                        Peserta
                    </button>

                    <button class="text-yellow-600 ml-3">
                        Edit
                    </button>

                </td>

            </tr>

        </tbody>

    </table>

</div>

@endsection