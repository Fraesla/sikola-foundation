@php

    $poin = $peserta->poin ?? 0;

    if ($poin >= 500) {

        $badge = 'Gold';
        $color = 'yellow';

    } elseif ($poin >= 250) {

        $badge = 'Silver';
        $color = 'gray';

    } elseif ($poin >= 100) {

        $badge = 'Bronze';
        $color = 'orange';

    } else {

        $badge = 'Basic';
        $color = 'blue';

    }

@endphp

<div class="flex flex-col items-center gap-2">

    {{-- ========================================= --}}
    {{-- TOTAL POINT --}}
    {{-- ========================================= --}}

    <div
        class="text-2xl font-black
        @if($color=='yellow')
            text-yellow-600
        @elseif($color=='gray')
            text-gray-600
        @elseif($color=='orange')
            text-orange-600
        @else
            text-blue-600
        @endif">

        {{ number_format($poin) }}

    </div>

    {{-- ========================================= --}}
    {{-- BADGE --}}
    {{-- ========================================= --}}

    <span
        class="px-3 py-1 rounded-full text-xs font-bold

        @if($color=='yellow')
            bg-yellow-100 text-yellow-700

        @elseif($color=='gray')
            bg-gray-100 text-gray-700

        @elseif($color=='orange')
            bg-orange-100 text-orange-700

        @else
            bg-blue-100 text-blue-700

        @endif">

        {{ $badge }}

    </span>

    {{-- ========================================= --}}
    {{-- EDIT BUTTON --}}
    {{-- ========================================= --}}

    <!-- <button
        type="button"

        class="mt-2 inline-flex items-center gap-2
               px-3 py-2 rounded-xl
               bg-indigo-50 hover:bg-indigo-100
               text-indigo-700 text-xs font-semibold"

        data-route="{{ route('admin.peserta.poin', $peserta) }}"
        data-nama="{{ $peserta->user->name }}"
        data-poin="{{ $peserta->poin }}"

        onclick="openPoint(this)">

        <i class="fa-solid fa-pen"></i>

        Edit

    </button> -->

</div>