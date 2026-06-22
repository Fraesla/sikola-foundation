@extends('layouts.admin',['activePage'=>'konten'])

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">

    <div>
        <h1 class="text-3xl font-bold text-[var(--color-coklat)]">
            Manajemen Postingan
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola artikel dan berita website.
        </p>
    </div>

    <div class="flex items-center gap-3">

        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.konten') }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 transition shadow-sm">

            <span>←</span>
            <span>Kembali</span>

        </a>

        {{-- Tombol Tambah Postingan --}}
        <a href="{{ route('admin.postingans.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl text-white font-semibold shadow-lg hover:scale-105 transition"
           style="
                background: linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
           ">

            <span class="text-xl">＋</span>
            <span>Tambah Postingan</span>

        </a>

    </div>


</div>


{{-- CARD STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <div class="card-admin p-6">
        <p class="text-slate-500">Total Postingan</p>

        <h2 class="text-4xl font-bold mt-3 text-[var(--color-merah)]">
            {{ $statistik->total }}
        </h2>
    </div>

    <div class="card-admin p-6">
        <p class="text-slate-500">Dipublikasi</p>

        <h2 class="text-4xl font-bold mt-3 text-green-600">
            {{ $statistik->publikasi }}
        </h2>
    </div>

    <div class="card-admin p-6">
        <p class="text-slate-500">Draft</p>

        <h2 class="text-4xl font-bold mt-3 text-yellow-500">
            {{ $statistik->draft }}
        </h2>
    </div>

    <div class="card-admin p-6">
        <p class="text-slate-500">Arsip</p>

        <h2 class="text-4xl font-bold mt-3 text-slate-600">
            {{ $statistik->arsip }}
        </h2>
    </div>

</div>


{{-- SEARCH FILTER --}}
<form method="GET"
      action="{{ route('admin.postingans.index') }}"
      class="card-admin p-5 mb-8">

    <div class="flex flex-col md:flex-row gap-4 justify-between">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari judul postingan..."
            class="w-full md:w-96 rounded-xl border px-4 py-3">

        <div class="flex gap-3">

            <select
                name="status"
                class="rounded-xl border px-4 py-3">

                <option value="">
                    Semua Status
                </option>

                <option value="publikasi"
                    {{ request('status')=='publikasi' ? 'selected' : '' }}>
                    Publikasi
                </option>

                <option value="draft"
                    {{ request('status')=='draft' ? 'selected' : '' }}>
                    Draft
                </option>

                <option value="arsip"
                    {{ request('status')=='arsip' ? 'selected' : '' }}>
                    Arsip
                </option>

            </select>

            <button
                class="px-6 py-3 rounded-xl text-white"
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


{{-- TABEL --}}
<div class="card-admin overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50">

            <tr>

                <th class="p-5 text-left">Cover</th>
                <th class="p-5 text-left">Judul</th>
                <th class="p-5 text-left">Kategori</th>
                <th class="p-5 text-left">Status</th>
                <th class="p-5 text-center">Views</th>
                <th class="p-5 text-center">Aksi</th>

            </tr>

            </thead>

            <tbody>

            @forelse($postingans as $item)

                <tr class="border-t hover:bg-slate-50 transition">

                    <td class="p-5">

                        <img
                            src="{{ $item->gambar_cover
                                    ? asset('storage/'.$item->gambar_cover)
                                    : asset('images/no-image.png') }}"
                            class="w-24 h-16 rounded-xl object-cover">

                    </td>

                    <td class="p-5">

                        <h4 class="font-semibold">
                            {{ $item->judul }}
                        </h4>

                        <small class="text-slate-500">
                            {{ Str::limit(strip_tags($item->konten),60) }}
                        </small>

                    </td>

                    <td class="p-5">
                        {{ $item->kategori ?? '-' }}
                    </td>

                    <td class="p-5">

                        @if($item->status=='publikasi')
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                Dipublikasi
                            </span>

                        @elseif($item->status=='draft')
                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                Draft
                            </span>

                        @else
                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                Arsip
                            </span>
                        @endif

                    </td>

                    <td class="p-5 text-center">
                        {{ $item->views }}
                    </td>

                    <td class="p-5">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.postingans.edit',$item->id) }}"
                               class="px-3 py-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200">
                                ✏️
                            </a>

                            <form
                                action="{{ route('admin.postingans.destroy',$item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus postingan?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="px-3 py-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                    🗑️
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="p-12">

                        <div class="text-center">

                            <div class="text-8xl mb-5">
                                📰
                            </div>

                            <h3 class="text-2xl font-bold text-[var(--color-coklat)]">
                                Belum Ada Postingan
                            </h3>

                            <p class="text-slate-500 mt-3 mb-8">
                                Mulai tambahkan artikel atau berita pertama.
                            </p>

                            <a href="{{ route('admin.postingans.create') }}"
                               class="inline-flex px-6 py-3 rounded-xl text-white font-semibold"
                               style="
                                    background:linear-gradient(
                                        135deg,
                                        var(--color-merah),
                                        var(--color-coklat)
                                    );
                               ">

                                + Tambah Postingan

                            </a>

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    @if($postingans->count())
    <div class="p-5 border-t bg-slate-50">
        {{ $postingans->links() }}
    </div>
    @endif

</div>

@endsection