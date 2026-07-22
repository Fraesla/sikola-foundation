@extends('layouts.admin', ['activePage' => 'event'])

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col lg:flex-row justify-between items-center gap-6 mb-10">

        <div>

            <span
                class="uppercase tracking-[8px] text-sm font-semibold"
                style="color:var(--color-coklat);">

                Event Volunteer

            </span>

            <h1
                class="text-5xl font-black mt-3"
                style="color:var(--color-hitam);">

                Tambah Event

            </h1>

            <p
                class="mt-4 text-lg leading-8 text-slate-500 max-w-3xl">

                Tambahkan event volunteer baru. Lengkapi informasi,
                jadwal, banner, kuota peserta serta pengaturan reward
                agar event siap dipublikasikan.

            </p>

        </div>

        <div class="flex flex-wrap gap-3">

            <a
                href="{{ route('admin.events.index') }}"
                class="px-6 py-3 rounded-2xl border bg-white hover:bg-slate-50 transition">

                ← 

            </a>

            <a
                href="{{ url('/admin/events/show') }}"
                class="px-6 py-3 rounded-2xl border bg-white hover:bg-slate-50 transition">

                Dashboard

            </a>

        </div>

    </div>

    @include('admin.event.kategori._form', [

        'action' => route('admin.events.store'),

        'method' => 'POST',

        'event' => null,

    ])

</div>

@endsection

@include('admin.event.kategori._script')