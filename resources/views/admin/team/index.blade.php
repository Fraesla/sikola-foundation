@extends('layouts.admin',['activePage'=>'konten'])

@section('content')

<div class="flex justify-between items-center mb-8">


<div>
    <h1 class="text-3xl font-bold text-[var(--color-coklat)]">
        Team Member
    </h1>

    <p class="text-slate-500 mt-2">
        Kelola anggota dan pengurus organisasi.
    </p>
</div>

<div class="flex gap-3">

    <a href="{{ route('admin.konten') }}"
       class="px-5 py-3 rounded-xl border bg-white">
        ← Kembali
    </a>

    <a href="{{ route('admin.team.create') }}"
       class="px-5 py-3 rounded-xl text-white font-semibold shadow-lg"
       style="background:linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
       );">

        + Tambah Team

    </a>

</div>


</div>

{{-- Statistik --}}

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">


<div class="card-admin p-6">
    <p class="text-slate-500">Total Team</p>
    <h2 class="text-4xl font-bold mt-2">
        {{ $totalTeam }}
    </h2>
</div>

<div class="card-admin p-6">
    <p class="text-slate-500">Aktif</p>
    <h2 class="text-4xl font-bold mt-2 text-green-600">
        {{ $teamAktif }}
    </h2>
</div>

<div class="card-admin p-6">
    <p class="text-slate-500">Nonaktif</p>
    <h2 class="text-4xl font-bold mt-2 text-red-600">
        {{ $teamNonaktif }}
    </h2>
</div>


</div>

{{-- Filter --}}

<form method="GET"
      class="card-admin p-5 mb-6">


<div class="flex flex-col md:flex-row gap-4 justify-between">

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari nama atau jabatan..."
           class="w-full md:w-96 rounded-xl border px-4 py-3">

    <div class="flex gap-3">

        <select name="status"
                class="rounded-xl border px-4 py-3">

            <option value="">Semua Status</option>
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>

        </select>

        <select name="sort"
                class="rounded-xl border px-4 py-3">

            <option value="latest">
                Terbaru
            </option>

            <option value="oldest">
                Terlama
            </option>

        </select>

        <button class="px-5 py-3 rounded-xl text-white"
                style="background:linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );">

            Cari

        </button>

    </div>

</div>


</form>

<div class="card-admin overflow-hidden">

<table class="w-full">

<thead class="bg-slate-50">

<tr>
    <th class="p-4 text-left">Foto</th>
    <th class="p-4 text-left">Nama</th>
    <th class="p-4 text-left">Jabatan</th>
    <th class="p-4 text-left">Status</th>
    <th class="p-4 text-center">Aksi</th>
</tr>

</thead>

<tbody>

@forelse($teams as $team)

<tr class="border-t">


<td class="p-4">

    <img src="{{ asset('storage/'.$team->foto) }}"
         class="w-14 h-14 rounded-full object-cover">

</td>

<td>

    <h4 class="font-semibold">
        {{ $team->nama }}
    </h4>

    <small class="text-slate-500">
        {{ $team->email }}
    </small>

</td>

<td>
    {{ $team->jabatan }}
</td>

<td>

    @if($team->is_aktif)

        <span class="badge-success">
            Aktif
        </span>

    @else

        <span class="badge-danger">
            Nonaktif
        </span>

    @endif

</td>

<td class="text-center">

    <div class="flex justify-center gap-2">

        <a href="{{ route('admin.team.edit',$team->id) }}"
           class="px-3 py-2 rounded-lg bg-blue-100 text-blue-600">

            ✏️ Edit

        </a>

        <form action="{{ route('admin.team.destroy',$team->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus team ini?')">

            @csrf
            @method('DELETE')

            <button
            class="px-3 py-2 rounded-lg bg-red-100 text-red-600">

            🗑 Hapus

            </button>

        </form>

    </div>

</td>


</tr>

@empty

<tr>

<td colspan="5" class="p-16 text-center">


<div class="text-7xl mb-4">
    👥
</div>

<h3 class="text-2xl font-bold">
    Belum Ada Team
</h3>

<p class="text-slate-500 mt-3">
    Tambahkan anggota pertama.
</p>

<a href="{{ route('admin.team.create') }}"
   class="btn-primary mt-6 inline-flex">

    + Tambah Team

</a>


</td>

</tr>

@endforelse

</tbody>

</table>

<div class="p-6 border-t">
    {{ $teams->withQueryString()->links() }}
</div>

</div>

@endsection
