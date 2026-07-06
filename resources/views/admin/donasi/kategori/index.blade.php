@extends('layouts.admin',[
    'activePage' => 'donasi'
])

@section('content')

<!-- HEADER -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

    <div>
        <h1 class="text-3xl font-bold"
            style="color: var(--color-hitam)">
            Kategori Donasi
        </h1>

        <p class="mt-2"
           style="color: var(--color-coklat)">
            Kelola seluruh kategori program donasi.
        </p>
    </div>

    <div class="flex gap-3 self-start md:self-auto">

        <!-- Tombol Back -->
        <a href="{{ url()->previous() }}"
           class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 transition">
            ← Kembali
        </a>

        <!-- Tombol Tambah -->
        <a href="{{ route('admin.donasiKategori.create') }}"
           class="inline-flex items-center px-5 py-3 rounded-xl text-white font-semibold shadow-lg hover:scale-105 transition"
           style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
           ">
            + Tambah Kategori
        </a>

    </div>

</div>


<!-- STATISTIK -->
<div class="grid md:grid-cols-3 gap-6 mb-8">

    <div class="admin-card p-6">
        <p class="admin-muted">
            Total Kategori
        </p>

        <h2 class="text-4xl font-bold mt-2"
            style="color: var(--color-merah)">
            {{ $kategori->total() }}
        </h2>
    </div>

    <div class="admin-card p-6">
        <p class="admin-muted">
            Kategori Aktif
        </p>

        <h2 class="text-4xl font-bold mt-2 text-green-600">
            {{ \App\Models\DonationCategory::where('is_aktif',1)->count() }}
        </h2>
    </div>

    <div class="admin-card p-6">
        <p class="admin-muted">
            Kategori Nonaktif
        </p>

        <h2 class="text-4xl font-bold mt-2 text-red-500">
            {{ \App\Models\DonationCategory::where('is_aktif',0)->count() }}
        </h2>
    </div>

</div>


<!-- FILTER -->
<div class="admin-card p-5 mb-8">

    <form class="flex flex-wrap gap-4">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari kategori..."
            class="flex-1 min-w-[250px] rounded-xl border px-4 py-3">

        <select
            name="status"
            class="rounded-xl border px-4 py-3">

            <option value="">
                Semua Status
            </option>

            <option value="1"
                {{ request('status')=='1' ? 'selected':'' }}>
                Aktif
            </option>

            <option value="0"
                {{ request('status')=='0' ? 'selected':'' }}>
                Nonaktif
            </option>

        </select>

        <button
            class="px-6 py-3 rounded-xl text-white"
            style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
            ">

            Cari

        </button>

    </form>

</div>


<!-- TABLE -->
<div class="admin-card overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead
                style="background: rgba(212,160,23,.08)">

                <tr>

                    <th class="p-5 text-left">
                        Kategori
                    </th>

                    <th class="p-5">
                        Lokasi
                    </th>

                    <th class="p-5">
                        Minimal
                    </th>

                    <th class="p-5">
                        Maksimal
                    </th>

                    <th class="p-5">
                        Target
                    </th>

                    <th class="p-5">
                        Status
                    </th>

                    <th class="p-5 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($kategori as $item)

                <tr class="border-t hover:bg-slate-50 transition">

                    <td class="p-5">

                        <div class="flex items-center gap-4">

                            <img
                                src="{{ asset('storage/'.$item->gambar) }}"
                                class="w-20 h-20 rounded-2xl object-cover shadow">

                            <div>

                                <h4 class="font-bold text-lg">
                                    {{ $item->nama }}
                                </h4>

                                <p class="text-slate-500 text-sm">
                                    {{ Str::limit($item->deskripsi,70) }}
                                </p>

                            </div>

                        </div>

                    </td>

                    <td class="p-5">
                        {{ $item->lokasi }}
                    </td>

                    <td class="p-5">
                        Rp {{ number_format($item->minimal_donasi,0,',','.') }}
                    </td>

                    <td class="p-5">

                        {{ $item->maksimal_donasi
                            ? 'Rp '.number_format($item->maksimal_donasi,0,',','.')
                            : 'Tidak dibatasi'
                        }}

                    </td>

                    <td class="p-5 font-semibold"
                        style="color: var(--color-merah)">

                        Rp {{ number_format($item->target_default,0,',','.') }}

                    </td>

                    <td class="p-5">

                        @if($item->is_aktif)

                            <span
                                class="px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-600">

                                Aktif

                            </span>

                        @else

                            <span
                                class="px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-600">

                                Nonaktif

                            </span>

                        @endif

                    </td>

                    <td class="p-5">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.donasiKategori.edit',$item->id) }}"
                               class="px-4 py-2 rounded-xl bg-blue-100 text-blue-600 hover:scale-105 transition">

                                Edit

                            </a>

                            <form
                                action="{{ route('admin.donasiKategori.destroy',$item->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus data?')"
                                    class="px-4 py-2 rounded-xl bg-red-100 text-red-600 hover:scale-105 transition">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7"
                        class="text-center py-20">

                        <div class="space-y-2">

                            <div class="text-5xl">
                                📦
                            </div>

                            <h3 class="font-bold text-xl">
                                Belum ada kategori donasi
                            </h3>

                            <p class="text-slate-500">
                                Silakan tambahkan kategori baru.
                            </p>

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- PAGINATION -->
<div class="mt-8">
    {{ $kategori->links() }}
</div>

@endsection
