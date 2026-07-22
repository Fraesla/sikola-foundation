@extends('layouts.admin',['activePage'=>'event'])

@section('title', 'Detail Peserta Event')

@section('content')

<div class="space-y-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.show._header')

    {{-- ========================================= --}}
    {{-- PROFILE --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.show._profile')

    {{-- ========================================= --}}
    {{-- INFORMASI EVENT --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.show._event')

    {{-- ========================================= --}}
    {{-- KEHADIRAN --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.show._kehadiran')

    {{-- ========================================= --}}
    {{-- POINT & SERTIFIKAT --}}
    {{-- ========================================= --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

        @include('admin.event.peserta.partials.show._point')

        @include('admin.event.peserta.partials.show._sertifikat')

    </div>

    {{-- ========================================= --}}
    {{-- CATATAN ADMIN --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.show._catatan')

    {{-- ========================================= --}}
    {{-- RIWAYAT ABSENSI --}}
    {{-- ========================================= --}}
    @include('admin.event.peserta.partials.show._riwayat')

    {{-- ========================================= --}}
    {{-- QUICK ACTION --}}
    {{-- ========================================= --}}
    <!-- @include('admin.event.peserta.partials.show._action') -->

</div>

@endsection

@push('scripts')

    {{-- Modal yang digunakan --}}
    @include('admin.event.peserta.partials.index._modal-status')

    @include('admin.event.peserta.partials.index._modal-point')

    @include('admin.event.peserta.partials.index._modal-catatan')

    @include('admin.event.peserta.partials.index._modal-upload')

    @include('admin.event.peserta.partials.index._modal-delete')

    {{-- Script modal --}}
    @include('admin.event.peserta.partials.index._modal-script')

@endpush