@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    Peserta Event
</h1>

<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-slate-50">

<tr>
    <th class="p-4">Nama</th>
    <th class="p-4">Email</th>
    <th class="p-4">Status Hadir</th>
    <th class="p-4">Poin</th>
    <th class="p-4">Aksi</th>
</tr>

</thead>

<tbody>

<tr class="border-t">

    <td class="p-4">Farhan</td>

    <td class="p-4">
        farhan@gmail.com
    </td>

    <td class="p-4">

        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

            Belum Konfirmasi

        </span>

    </td>

    <td class="p-4">

        20

    </td>

    <td class="p-4">

        <button
            class="bg-green-500 text-white px-3 py-2 rounded-lg">

            Hadir

        </button>

        <button
            class="bg-blue-600 text-white px-3 py-2 rounded-lg ml-2">

            +10 Poin

        </button>

    </td>

</tr>

</tbody>

</table>

</div>

@endsection