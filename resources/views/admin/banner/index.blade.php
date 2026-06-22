@extends('layouts.admin', [
    'activePage' => 'konten'
])

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">

    <div>
        <h1 class="text-3xl font-bold text-[var(--color-coklat)]">
            Banner Website
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola banner yang tampil di halaman utama.
        </p>
    </div>

    <div class="flex items-center gap-3">

        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.konten') }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 transition shadow-sm">

            <span>←</span>
            <span>Kembali</span>

        </a>

        {{-- Tombol Tambah Banner --}}
        <a href="{{ route('admin.banners.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-white font-semibold shadow-lg hover:scale-105 transition"
           style="
                background: linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
           ">

            <span class="text-lg">+</span>
            <span>Tambah Banner</span>

        </a>

    </div>

</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="card-admin p-5">
        <p class="text-slate-500 text-sm">Total Banner</p>
        <h3 class="text-3xl font-bold mt-2">
            {{ $totalBanner }}
        </h3>
    </div>

    <div class="card-admin p-5">
        <p class="text-slate-500 text-sm">Banner Aktif</p>
        <h3 class="text-3xl font-bold mt-2 text-green-600">
            {{ $bannerAktif }}
        </h3>
    </div>

    <div class="card-admin p-5">
        <p class="text-slate-500 text-sm">Nonaktif</p>
        <h3 class="text-3xl font-bold mt-2 text-red-600">
            {{ $bannerNonaktif }}
        </h3>
    </div>

    <div class="card-admin p-5">
        <p class="text-slate-500 text-sm">Urutan Tertinggi</p>
        <h3 class="text-3xl font-bold mt-2">
            {{ $urutanMax }}
        </h3>
    </div>

</div>
<form method="GET"
      action="{{ route('admin.banners.index') }}"
      class="card-admin p-5 mb-6">

    <div class="flex flex-col md:flex-row gap-4 justify-between">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari banner..."
            class="w-full md:w-80 rounded-xl border px-4 py-3">

        <div class="flex gap-3">

            <select
                name="status"
                onchange="this.form.submit()"
                class="rounded-xl border px-4 py-3">

                <option value="">
                    Semua Status
                </option>

                <option value="1"
                    {{ request('status')=='1' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="0"
                    {{ request('status')=='0' ? 'selected' : '' }}>
                    Nonaktif
                </option>

            </select>

            <select
                name="sort"
                onchange="this.form.submit()"
                class="rounded-xl border px-4 py-3">

                <option value="latest"
                    {{ request('sort')=='latest' ? 'selected' : '' }}>
                    Urutan Terbaru
                </option>

                <option value="oldest"
                    {{ request('sort')=='oldest' ? 'selected' : '' }}>
                    Urutan Terlama
                </option>

            </select>

            <button
                type="submit"
                class="px-5 py-3 rounded-xl text-white"
                style="
                    background:linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">
                Cari
            </button>

        </div>

    </div>

</form>
<div class="card-admin overflow-hidden">

<table class="w-full">

<thead class="bg-slate-50">

<tr class="border-t hover:bg-slate-50 transition">

    <th class="px-6 py-4 text-left text-sm uppercase">
        Banner
    </th>

    <th class="px-6 py-4 text-left text-sm uppercase">
        Urutan
    </th>

    <th class="px-6 py-4 text-left text-sm uppercase">
        Status
    </th>

    <th class="px-6 py-4 text-left text-sm uppercase">
        Dibuat Oleh
    </th>

    <th class="px-6 py-4 text-center text-sm uppercase">
        Aksi
    </th>

</tr>

</thead>

<tbody>

@forelse($banners as $banner)

<tr class="border-t hover:bg-slate-50 transition">

    <td class="p-4">
        <div class="flex items-center gap-4">

            <img
                src="{{ asset('storage/'.$banner->gambar) }}"
                class="w-20 h-14 rounded-lg object-cover">

            <div>
                <h4 class="font-semibold">
                    {{ $banner->judul }}
                </h4>

                <small class="text-slate-500">
                    {{ Str::limit($banner->deskripsi,50) }}
                </small>
            </div>

        </div>
    </td>

    <td>{{ $banner->urutan }}</td>

    <td>
        @if($banner->is_aktif)
            <span class="badge-success">Aktif</span>
        @else
            <span class="badge-danger">Nonaktif</span>
        @endif
    </td>

    <td>
        {{ $banner->creator->name ?? '-' }}
    </td>

    <td class="text-center">
        <div class="flex justify-center gap-2">

            <a href="{{ route('admin.banners.edit', $banner->id) }}"
               class="px-3 py-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                ✏️ Edit
            </a>

            <form action="{{ route('admin.banners.destroy', $banner->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus banner ini?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="px-3 py-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                    🗑 Hapus
                </button>

            </form>

        </div>
    </td>

</tr>

@empty

<tr>

    <td colspan="5" class="p-10">

        <div class="bg-white rounded-3xl shadow-lg py-16 text-center">

            <div class="text-8xl mb-5">
                🖼️
            </div>

            <h3 class="text-2xl font-bold text-[var(--color-coklat)]">
                Belum Ada Banner
            </h3>

            <p class="text-slate-500 mt-3 mb-8">
                Banner homepage belum tersedia.
            </p>

            <a
                href="{{ route('admin.banners.create') }}"
                class="btn-primary">

                + Tambah Banner Pertama

            </a>

        </div>

    </td>

</tr>


@endforelse

</tbody>

</table>
<div class="px-6 py-4 border-t bg-slate-50">

    {{ $banners->links() }}

</div>

</div>
@endsection