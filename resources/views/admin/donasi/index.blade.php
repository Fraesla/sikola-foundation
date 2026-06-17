@extends('layouts.admin', [
    'activePage' => 'donasi'
])

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold">
            Manajemen Donasi
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola seluruh transaksi donasi.
        </p>
    </div>

</div>

<!-- Tabs -->
<div class="flex gap-3 mb-8">

    <button class="bg-blue-600 text-white px-5 py-2 rounded-xl">
        Semua Donasi
    </button>

    <button class="bg-yellow-500 text-white px-5 py-2 rounded-xl">
        Menunggu Verifikasi
    </button>

    <button class="bg-green-600 text-white px-5 py-2 rounded-xl">
        Langganan Aktif
    </button>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-slate-50">

<tr>
    <th class="p-4">Donatur</th>
    <th class="p-4">Nominal</th>
    <th class="p-4">Metode</th>
    <th class="p-4">Tanggal</th>
    <th class="p-4">Status</th>
    <th class="p-4">Aksi</th>
</tr>

</thead>

<tbody>

<tr class="border-t">

    <td class="p-4">Farhan</td>
    <td class="p-4">Rp 500.000</td>
    <td class="p-4">Transfer BCA</td>
    <td class="p-4">12 Jan 2026</td>

    <td class="p-4">
        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
            Pending
        </span>
    </td>

    <td class="p-4">
        <button class="bg-green-600 text-white px-3 py-2 rounded-lg">
            Verifikasi
        </button>
    </td>

</tr>

</tbody>

</table>

</div>

@endsection