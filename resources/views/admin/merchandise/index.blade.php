@extends('layouts.admin',['activePage'=>'merchandise'])

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold"
            style="color:var(--color-hitam)">

            Produk Merchandise

        </h1>

        <p class="mt-2"
           style="color:var(--color-coklat)">

            Kelola seluruh produk merchandise.

        </p>

    </div>

    <div class="flex items-center gap-3">

        {{-- Tombol Kembali --}}
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 transition shadow-sm">

            <span>←</span>
            <span>Kembali</span>

        </a>

        {{-- Tombol Tambah Produk --}}
        <a href="{{ route('admin.merchandise.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-white font-semibold shadow-lg hover:scale-105 transition"
           style="
                background: linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
           ">

            <span class="text-lg">+</span>
            <span>Tambah Produk</span>

        </a>

    </div>

</div>


{{-- STATISTIK --}}
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="card-admin p-6">
        <p>Total Produk</p>

        <h2 class="text-4xl font-bold text-red-600 mt-2">
            {{ $totalProduk }}
        </h2>
    </div>

    <div class="card-admin p-6">
        <p>Total Stok</p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $totalStok }}
        </h2>
    </div>

    <div class="card-admin p-6">
        <p>Produk Aktif</p>

        <h2 class="text-4xl font-bold text-green-600 mt-2">
            {{ $produkAktif }}
        </h2>
    </div>

    <div class="card-admin p-6">
        <p>Produk Nonaktif</p>

        <h2 class="text-4xl font-bold text-yellow-500 mt-2">
            {{ $produkNonaktif }}
        </h2>
    </div>

</div>



{{-- FILTER --}}
<form class="card-admin p-6 mb-6">

<div class="grid lg:grid-cols-4 gap-4">

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari produk..."
           class="rounded-xl border px-4 py-3">

    <select name="kategori"
            onchange="this.form.submit()"
            class="rounded-xl border px-4 py-3">

        <option value="">
            Semua Kategori
        </option>

        <option value="Kaos">
            Kaos
        </option>

        <option value="Topi">
            Topi
        </option>

        <option value="Sticker">
            Sticker
        </option>

        <option value="Aksesoris">
            Aksesoris
        </option>

    </select>


    <select name="status"
            onchange="this.form.submit()"
            class="rounded-xl border px-4 py-3">

        <option value="">
            Semua Status
        </option>

        <option value="1">
            Aktif
        </option>

        <option value="0">
            Nonaktif
        </option>

    </select>


    <div class="flex gap-2">

        <select name="sort"
                class="rounded-xl border px-4 py-3 w-full">

            <option value="latest">
                Terbaru
            </option>

            <option value="oldest">
                Terlama
            </option>

        </select>

        <button class="btn-primary">

            Cari

        </button>

    </div>

</div>

</form>



{{-- TABLE --}}
<div class="card-admin overflow-hidden">

<div class="p-6 border-b">

    <h3 class="font-bold text-xl">

        Daftar Produk

    </h3>

</div>

<table class="w-full">

<thead class="bg-slate-50">

<tr>

<th class="p-4 text-left">
    Produk
</th>

<th>Kategori</th>

<th>Harga</th>

<th>Stok</th>

<th>Status</th>

<th class="text-center">
    Aksi
</th>

</tr>

</thead>


<tbody>

@forelse($products as $product)

<tr class="border-t hover:bg-slate-50">

<td class="p-4">

<div class="flex items-center gap-4">

<img
src="{{ asset('storage/'.($product->gambar[0] ?? 'default.png')) }}"
class="w-20 h-20 rounded-xl object-cover">

<div>

<h4 class="font-semibold">
    {{ $product->nama }}
</h4>

<p class="text-sm text-slate-500">
    {{ Str::limit($product->deskripsi,60) }}
</p>

</div>

</div>

</td>

<td>

<span class="badge-warning">
    {{ $product->kategori }}
</span>

</td>

<td class="font-semibold text-red-600">

Rp {{ number_format($product->harga,0,',','.') }}

</td>

<td>

@if($product->stok > 10)

<span class="badge-success">

{{ $product->stok }} Stok

</span>

@else

<span class="badge-danger">

{{ $product->stok }} Stok

</span>

@endif

</td>

<td>

@if($product->is_aktif)

<span class="badge-success">
    Aktif
</span>

@else

<span class="badge-warning">
    Nonaktif
</span>

@endif

</td>

<td>

<div class="flex justify-center gap-2">

<a href="{{ route('admin.merchandise.edit',$product) }}"
   class="px-3 py-2 rounded-lg bg-blue-100 text-blue-600">

    ✏️ Edit

</a>

<form action="{{ route('admin.merchandise.destroy',$product) }}"
      method="POST">

@csrf
@method('DELETE')

<button
onclick="return confirm('Hapus produk?')"
class="px-3 py-2 rounded-lg bg-red-100 text-red-600">

🗑 Hapus

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="6">

<div class="py-20 text-center">

<div class="text-7xl mb-5">

🛍️

</div>

<h3 class="text-2xl font-bold mb-3">

Belum Ada Produk

</h3>

<p class="text-slate-500 mb-6">

Tambahkan produk merchandise pertama
untuk mulai berjualan.

</p>

<a href="{{ route('admin.merchandise.create') }}"
   class="btn-primary">

    + Tambah Produk

</a>

</div>

</td>

</tr>

@endforelse

</tbody>

</table>


@if($products->count())

<div class="p-6 border-t">

{{ $products->links() }}

</div>

@endif

</div>

@endsection