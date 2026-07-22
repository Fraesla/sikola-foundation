@extends('layouts.admin',['activePage'=>'event'])

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- Header --}}
    @include('admin.event.daftar.components._header')

    {{-- Statistik --}}
    @include('admin.event.daftar.components._statistik')

    {{-- Filter --}}
    @include('admin.event.daftar.components._filter')

    {{-- Flash Message --}}
    @include('admin.event.daftar.components._flash')

    {{-- Card Registrasi --}}
    @include('admin.event.daftar.components._cards')

    {{-- Pagination --}}
    @include('admin.event.daftar.components._pagination')

</div>

@include('admin.event.daftar.components._script')

@endsection