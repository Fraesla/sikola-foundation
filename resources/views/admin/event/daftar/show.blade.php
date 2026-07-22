@extends('layouts.admin',['activePage'=>'event'])

@section('content')

<div class="max-w-6xl mx-auto space-y-8">

    {{-- Header --}}
    @include('admin.event.daftar.components._header',[
        'detail'=>true
    ])

    {{-- Flash --}}
    @include('admin.event.daftar.components._flash')

    {{-- Detail Registrasi --}}
    @include('admin.event.daftar.components._detail')

</div>

@include('admin.event.daftar.components._script')

@endsection