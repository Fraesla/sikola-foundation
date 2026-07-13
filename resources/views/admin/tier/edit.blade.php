@extends('layouts.admin',['activePage'=>'tier'])

@section('title', 'Edit Tier')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- HEADER --}}
    <div class="mb-8">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-4xl font-bold text-slate-800">

                    ✏ Edit Tier

                </h1>

                <p class="text-slate-500 mt-2">

                    Perbarui informasi tier
                    <b>{{ $tier->nama }}</b>

                </p>

            </div>

            <a
                href="{{ route('admin.tier.index') }}"
                class="px-6 py-3 rounded-2xl bg-slate-200 hover:bg-slate-300 font-semibold">

                ← Kembali

            </a>

        </div>

    </div>

    {{-- FORM --}}
    <form
        action="{{ route('admin.tier.update',$tier) }}"
        method="POST">

        @include('admin.tier.form')

    </form>

</div>

@endsection