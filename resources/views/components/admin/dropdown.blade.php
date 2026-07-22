@props([
    'align' => 'right',
    'width' => '56',
])

@php

$alignment = match($align){

    'left' => 'left-0 origin-top-left',

    'center' => 'left-1/2 -translate-x-1/2 origin-top',

    default => 'right-0 origin-top-right',

};

@endphp

<div
    x-data="{ open:false }"
    class="relative inline-block text-left">

    {{-- Tombol --}}

    <button

        @click="open=!open"

        @click.outside="open=false"

        class="w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 transition flex items-center justify-center">

        <i class="fas fa-ellipsis-v text-slate-600"></i>

    </button>

    {{-- Dropdown --}}

    <div

        x-show="open"

        x-transition

        class="absolute z-50 mt-2 {{ $alignment }} w-{{ $width }} rounded-2xl bg-white border border-slate-200 shadow-xl overflow-hidden"

        style="display:none;">

        {{ $slot }}

    </div>

</div>