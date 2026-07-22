@extends('layouts.admin',['activePage'=>'event'])

@section('title', 'Rekap Absensi')

@section('content')

<div class="space-y-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    @include('admin.event.absensi.partials.rekap._header')

    {{-- ========================================= --}}
    {{-- STATISTIK --}}
    {{-- ========================================= --}}
    @include('admin.event.absensi.partials.rekap._statistik')

    {{-- ========================================= --}}
    {{-- FLASH MESSAGE --}}
    {{-- ========================================= --}}
    @if(session('success'))

        <div
            class="rounded-2xl
                   border border-green-200
                   bg-green-50
                   p-5">

            <div class="flex items-start gap-3">

                <i class="fas fa-circle-check text-2xl text-green-600 mt-1"></i>

                <div>

                    <h4 class="font-bold text-green-700">

                        Berhasil

                    </h4>

                    <p class="text-green-600 mt-1">

                        {{ session('success') }}

                    </p>

                </div>

            </div>

        </div>

    @endif

    @if(session('error'))

        <div
            class="rounded-2xl
                   border border-red-200
                   bg-red-50
                   p-5">

            <div class="flex items-start gap-3">

                <i class="fas fa-circle-xmark text-2xl text-red-600 mt-1"></i>

                <div>

                    <h4 class="font-bold text-red-700">

                        Terjadi Kesalahan

                    </h4>

                    <p class="text-red-600 mt-1">

                        {{ session('error') }}

                    </p>

                </div>

            </div>

        </div>

    @endif

    {{-- ========================================= --}}
    {{-- TABEL REKAP --}}
    {{-- ========================================= --}}
    @include('admin.event.absensi.partials.rekap._table')

    {{-- ========================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================= --}}
    @include('admin.event.absensi.partials.rekap._footer')

</div>

@endsection