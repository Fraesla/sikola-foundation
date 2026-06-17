@extends('layouts.admin', [
    'activePage' => 'pengguna'
])

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold">
        Manajemen Pengguna
    </h1>

</div>

<div class="flex gap-3 mb-6">

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
        Semua
    </button>

    <button class="bg-slate-200 px-4 py-2 rounded-lg">
        Admin
    </button>

    <button class="bg-slate-200 px-4 py-2 rounded-lg">
        Relawan
    </button>

    <button class="bg-slate-200 px-4 py-2 rounded-lg">
        Donatur
    </button>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-slate-50">

<tr>

    <th class="p-4">Nama</th>
    <th class="p-4">Role</th>
    <th class="p-4">Poin</th>
    <th class="p-4">Tier</th>
    <th class="p-4">Status</th>
    <th class="p-4">Aksi</th>

</tr>

</thead>

<tbody>

<tr class="border-t">

    <td class="p-4">
        Farhan
    </td>

    <td class="p-4">
        Volunteer
    </td>

    <td class="p-4">
        250
    </td>

    <td class="p-4">

        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

            Gold

        </span>

    </td>

    <td class="p-4">

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

            Aktif

        </span>

    </td>

    <td class="p-4">

        <button class="bg-red-600 text-white px-3 py-2 rounded-lg">

            Nonaktifkan

        </button>

    </td>

</tr>

</tbody>

</table>

</div>

@endsection