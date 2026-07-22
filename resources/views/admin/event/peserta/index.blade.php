@extends('layouts.admin',['activePage'=>'event'])

@section('title', 'Manajemen Peserta Event')

@section('content')

<div class="space-y-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

        <div>

            <span
                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-700">

                <i class="fas fa-users mr-2"></i>

                Manajemen Peserta

            </span>

            <h1 class="text-4xl font-black mt-4 text-slate-800">

                Data Peserta Event

            </h1>

            <p class="text-slate-500 mt-2 max-w-3xl">

                Kelola seluruh peserta event, lihat progres kehadiran,
                update poin reward, upload sertifikat, serta pantau
                seluruh aktivitas peserta dalam satu halaman.

            </p>


        </div>
        <a
            href="{{ url('/admin/events/show') }}"
            class="px-6 py-3 rounded-2xl border bg-white hover:shadow flex items-center gap-2 font-semibold">
            🏠 Dashboard
        </a>

    </div>

    {{-- ========================================= --}}
    {{-- STATISTIK --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.index._statistik')

    {{-- ========================================= --}}
    {{-- FILTER --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.index._filter')

    {{-- ========================================= --}}
    {{-- FLASH MESSAGE --}}
    {{-- ========================================= --}}
    @if(session('success'))

        <div class="rounded-2xl border border-green-200 bg-green-50 p-5">

            <div class="flex items-center gap-3">

                <i class="fas fa-check-circle text-green-600 text-2xl"></i>

                <div>

                    <h4 class="font-bold text-green-700">

                        Berhasil

                    </h4>

                    <p class="text-green-600">

                        {{ session('success') }}

                    </p>

                </div>

            </div>

        </div>

    @endif

    @if(session('error'))

        <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

            <div class="flex items-center gap-3">

                <i class="fas fa-times-circle text-red-600 text-2xl"></i>

                <div>

                    <h4 class="font-bold text-red-700">

                        Terjadi Kesalahan

                    </h4>

                    <p class="text-red-600">

                        {{ session('error') }}

                    </p>

                </div>

            </div>

        </div>

    @endif

    {{-- ========================================= --}}
    {{-- TABEL PESERTA --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.index._table')

</div>

@endsection

@push('scripts')

    {{-- Semua modal akan dipanggil di sini --}}
    @include('admin.event.peserta.partials.index._modal-status')

    @include('admin.event.peserta.partials.index._modal-point')

    @include('admin.event.peserta.partials.index._modal-catatan')

    @include('admin.event.peserta.partials.index._modal-upload')

    @include('admin.event.peserta.partials.index._modal-delete')

    @include('admin.event.peserta.partials.index._modal-script')

@endpush
