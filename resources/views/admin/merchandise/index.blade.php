@extends('layouts.admin', [
    'activePage' => 'merchandise'
])

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            Merchandise & Order
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola produk, stok dan pesanan.
        </p>

    </div>

    <button
        class="bg-blue-600 text-white px-5 py-3 rounded-xl">

        + Tambah Produk

    </button>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-slate-50">

<tr>

    <th class="p-4">Produk</th>
    <th class="p-4">Stok</th>
    <th class="p-4">Harga</th>
    <th class="p-4">Terjual</th>
    <th class="p-4">Aksi</th>

</tr>

</thead>

<tbody>

<tr class="border-t">

    <td class="p-4">
        Kaos Sikola Foundation
    </td>

    <td class="p-4">
        50
    </td>

    <td class="p-4">
        Rp 120.000
    </td>

    <td class="p-4">
        35
    </td>

    <td class="p-4">

        <button class="text-blue-600">
            Edit
        </button>

        <button class="text-red-600 ml-3">
            Hapus
        </button>

    </td>

</tr>

</tbody>

</table>

</div>

@endsection