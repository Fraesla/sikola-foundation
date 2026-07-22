@extends('layouts.admin',['activePage'=>'event'])

@section('title','Input Absensi')

@section('content')

<div class="space-y-8">

    {{-- ======================================== --}}
    {{-- HEADER --}}
    {{-- ======================================== --}}
    @include('admin.event.absensi.partials.create._header')

    {{-- ======================================== --}}
    {{-- STATISTIK --}}
    {{-- ======================================== --}}
    @include('admin.event.absensi.partials.create._statistik')

    {{-- ======================================== --}}
    {{-- FLASH MESSAGE --}}
    {{-- ======================================== --}}

    @if(session('success'))

        <div class="rounded-2xl border border-green-200 bg-green-50 p-5">

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

        <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

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

    {{-- ======================================== --}}
    {{-- VALIDATION --}}
    {{-- ======================================== --}}

    @if($errors->any())

        <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

            <h4 class="font-bold text-red-700 mb-3">

                Validasi Gagal

            </h4>

            <ul class="list-disc list-inside text-red-600 space-y-1">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- ======================================== --}}
    {{-- FORM --}}
    {{-- ======================================== --}}

    <form
        action="{{ route('admin.absensi.store',$event) }}"
        method="POST"
        class="space-y-8">

        @csrf

        <input
            type="hidden"
            name="hari_ke"
            value="{{ $hariKe }}">

        {{-- FILTER HARI --}}
        @include('admin.event.absensi.partials.create._filter')

        {{-- TABEL ABSENSI --}}
        @include('admin.event.absensi.partials.create._table')

        {{-- FOOTER --}}
        @include('admin.event.absensi.partials.create._footer')

    </form>

</div>

@endsection