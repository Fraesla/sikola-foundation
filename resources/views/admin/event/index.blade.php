@extends('layouts.admin',['activePage'=>'event'])

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold text-[var(--color-coklat)]">
            Manajemen Event
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola seluruh event organisasi.
        </p>
    </div>

    <a href="{{ route('admin.events.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-white font-semibold shadow-lg hover:scale-105 transition duration-300"
       style="
            background: linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
       ">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 4v16m8-8H4"/>

        </svg>

        Tambah Event

    </a>

</div>


{{-- Statistik --}}
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="card-admin p-6">
        <p>Total Event</p>

        <h2 class="text-4xl font-bold text-red-600 mt-2">
            {{ $totalEvent }}
        </h2>
    </div>

    <div class="card-admin p-6">
        <p>Terbuka</p>

        <h2 class="text-4xl font-bold text-green-600 mt-2">
            {{ $upcomingEvent }}
        </h2>
    </div>

    <div class="card-admin p-6">
        <p>Draft</p>

        <h2 class="text-4xl font-bold text-yellow-500 mt-2">
            {{ $draftEvent }}
        </h2>
    </div>

    <div class="card-admin p-6">
        <p>Selesai</p>

        <h2 class="text-4xl font-bold text-blue-600 mt-2">
            {{ $selesaiEvent }}
        </h2>
    </div>

</div>

{{-- FILTER --}}
<form class="card-admin p-6 mb-8 rounded-3xl"
      style="
        background: rgba(255,255,255,.95);
        backdrop-filter: blur(12px);
      ">

<div class="flex flex-col md:flex-row gap-4 justify-between">

    <input type="text"
       name="search"
       value="{{ request('search') }}"
       placeholder="Cari nama event..."
       class="w-full md:w-96 rounded-2xl border-0 px-5 py-4 shadow-sm focus:ring-2"
       style="
            background: #fafafa;
            border:1px solid rgba(0,0,0,.08);
       ">

    <div class="flex gap-3">

        <select name="status"
                onchange="this.form.submit()"
                class="rounded-xl border px-4 py-3">

            <option value="">Semua Status</option>
            <option value="draft">Draft</option>
            <option value="terbuka">Terbuka</option>
            <option value="ditutup">Ditutup</option>
            <option value="selesai">Selesai</option>

        </select>

        <select name="sort"
                onchange="this.form.submit()"
                class="rounded-xl border px-4 py-3">

            <option value="latest">Terbaru</option>
            <option value="oldest">Terlama</option>

        </select>

        <button
            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-white font-semibold shadow-md hover:opacity-90 transition"
            style="
                background: linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
            ">

            🔍 Cari

        </button>

    </div>

</div>

</form>
<div class="p-6 border-b flex justify-between items-center">

    <div>

        <h3 class="text-xl font-bold"
            style="color: var(--color-hitam);">

            📋 Daftar Event

        </h3>

        <p class="text-sm mt-1"
           style="color: var(--color-coklat);">

            Total {{ $events->total() }} event ditemukan

        </p>

    </div>

</div>
<div class="card-admin overflow-hidden">

<table class="w-full">

<thead class="bg-slate-50">

<tr>

<th class="p-4 text-left">Event</th>
<th>Tanggal</th>
<th>Lokasi</th>
<th>Kuota</th>
<th>Status</th>
<th class="text-center">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($events as $event)

<tr class="border-t transition duration-300 hover:bg-amber-50 hover:shadow-sm">

<td class="p-4">

<div class="flex items-center gap-4">

<img src="{{ asset('storage/'.$event->gambar) }}"
     class="w-20 h-14 rounded-lg object-cover">

<div>

<h4 class="font-semibold">
    {{ $event->judul }}
</h4>

<small class="text-slate-500">
    {{ Str::limit($event->deskripsi,50) }}
</small>

</div>

</div>

</td>

<td>
{{ $event->tanggal_mulai->format('d M Y') }}
</td>

<td>{{ $event->lokasi }}</td>

<td>{{ $event->kuota ?? 'Unlimited' }}</td>

<td>

@if($event->status=='terbuka')
<span class="badge-success">Terbuka</span>

@elseif($event->status=='draft')
<span class="badge-warning">Draft</span>

@elseif($event->status=='ditutup')
<span class="badge-danger">Ditutup</span>

@else
<span class="badge-primary">Selesai</span>
@endif

</td>

<td>

<div class="flex justify-center gap-2">

<a href="{{ route('admin.events.edit',$event) }}"
   class="px-3 py-2 rounded-lg bg-blue-100 text-blue-600">

✏️ Edit

</a>

<form action="{{ route('admin.events.destroy',$event) }}"
      method="POST">

@csrf
@method('DELETE')

<button onclick="return confirm('Hapus event?')"
        class="px-3 py-2 rounded-lg bg-red-100 text-red-600">

🗑 Hapus

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="p-16">

    <div class="flex flex-col items-center justify-center">

        <div
            class="w-28 h-28 rounded-full flex items-center justify-center mb-6"
            style="
                background:
                linear-gradient(
                    135deg,
                    rgba(220,38,38,.1),
                    rgba(161,98,7,.1)
                );
            ">

            <span class="text-6xl">
                📅
            </span>

        </div>

        <h3 class="text-2xl font-bold mb-2"
            style="color: var(--color-hitam);">

            Belum Ada Event

        </h3>

        <p class="max-w-md text-center mb-6"
           style="color: var(--color-coklat);">

            Saat ini belum ada event yang dibuat.
            Mulailah membuat event pertama untuk
            mengelola kegiatan organisasi.

        </p>

        <a href="{{ route('admin.events.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-white font-semibold shadow-lg hover:scale-105 transition"
           style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
           ">

            ➕ Buat Event Pertama

        </a>

    </div>

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="p-6 border-t">

{{ $events->links() }}

</div>

</div>

@endsection
