@extends('layouts.admin',['activePage'=>'event'])

@section('title', 'Detail Absensi Peserta')

@section('content')

<div class="space-y-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.absensi._header')

    {{-- ========================================= --}}
    {{-- STATISTIK --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.absensi._statistik')

    {{-- ========================================= --}}
    {{-- FLASH MESSAGE --}}
    {{-- ========================================= --}}
    @if(session('success'))

        <div class="rounded-2xl border border-green-200 bg-green-50 p-5">

            <div class="flex items-center gap-3">

                <i class="fas fa-circle-check text-green-600 text-2xl"></i>

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

                <i class="fas fa-circle-xmark text-red-600 text-2xl"></i>

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
    {{-- TIMELINE ABSENSI --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.absensi._timeline')

    {{-- ========================================= --}}
    {{-- DETAIL SCAN --}}
    {{-- ========================================= --}}
    <!-- @include('admin.event.peserta.partials.absensi._detail') -->

</div>

@endsection