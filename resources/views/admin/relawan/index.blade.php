@extends('layouts.admin', [
    'activePage' => 'relawan'
])

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold">
        Verifikasi Relawan
    </h1>

    <p class="text-slate-500 mt-2">

        Kelola pendaftaran volunteer dan verifikasi dokumen.

    </p>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-slate-50">

<tr>

    <th class="p-4 text-left">
        Nama
    </th>

    <th class="p-4 text-left">
        Email
    </th>

    <th class="p-4 text-left">
        KTP
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

<tr class="border-t">

    <td class="p-4">
        Farhan Maulidani
    </td>

    <td class="p-4">
        farhan@gmail.com
    </td>

    <td class="p-4">

        <button class="text-blue-600">

            Preview KTP

        </button>

    </td>

    <td class="p-4">

        <span
            class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

            Pending

        </span>

    </td>

    <td class="p-4 text-center">

        <button
            class="bg-green-600 text-white px-3 py-2 rounded-lg">

            Setujui

        </button>

        <button
            class="bg-red-600 text-white px-3 py-2 rounded-lg ml-2">

            Tolak

        </button>

    </td>

</tr>

</tbody>

</table>

</div>

@endsection