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

<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center justify-between mb-8">

        <div class="flex items-center gap-3">

            <div
                class="w-12 h-12 rounded-2xl
                       bg-amber-100
                       flex items-center justify-center">

                <i class="fas fa-star text-amber-600 text-xl"></i>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Reward Point

                </h2>

                <p class="text-slate-500">

                    Total poin yang diperoleh peserta.

                </p>

            </div>

        </div>

        <!-- <button
            type="button"

            class="inline-flex items-center gap-2
                   px-4 py-3 rounded-xl
                   bg-indigo-600 hover:bg-indigo-700
                   text-white text-sm font-semibold"

            data-route="{{ route('admin.peserta.poin',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"
            data-poin="{{ $peserta->poin }}"

            onclick="openPoint(this)">

            <i class="fas fa-pen"></i>

            Edit Point

        </button> -->

    </div>

    {{-- ========================================= --}}
    {{-- POINT --}}
    {{-- ========================================= --}}
    <div class="text-center">

        <div
            class="w-36 h-36 mx-auto rounded-full
                   bg-gradient-to-br
                   from-yellow-100
                   to-orange-100
                   flex items-center justify-center">

            <div>

                <h1
                    class="text-5xl font-black"

                    @class([

                        'text-yellow-600'=>$color=='yellow',
                        'text-gray-600'=>$color=='gray',
                        'text-orange-600'=>$color=='orange',
                        'text-blue-600'=>$color=='blue',

                    ])>

                    {{ number_format($poin) }}

                </h1>

                <small class="text-slate-500">

                    POINT

                </small>

            </div>

        </div>

        <div class="mt-6">

            <span

                @class([

                    'px-5 py-2 rounded-full text-sm font-bold',

                    'bg-yellow-100 text-yellow-700'=>$color=='yellow',

                    'bg-gray-100 text-gray-700'=>$color=='gray',

                    'bg-orange-100 text-orange-700'=>$color=='orange',

                    'bg-blue-100 text-blue-700'=>$color=='blue',

                ])>

                {{ $badge }}

            </span>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- INFO --}}
    {{-- ========================================= --}}
    <div class="mt-8 grid grid-cols-2 gap-4">

        <div
            class="rounded-2xl bg-slate-50 p-5 text-center">

            <div class="text-sm text-slate-500">

                Status

            </div>

            <div class="mt-2 font-bold text-lg">

                {{ ucfirst($badge) }}

            </div>

        </div>

        <div
            class="rounded-2xl bg-slate-50 p-5 text-center">

            <div class="text-sm text-slate-500">

                Total Point

            </div>

            <div
                class="mt-2 text-2xl font-black">

                {{ number_format($poin) }}

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- KETERANGAN --}}
    {{-- ========================================= --}}
    <div
        class="mt-8 rounded-2xl
               bg-blue-50
               border border-blue-100
               p-5">

        <div class="flex gap-3">

            <i class="fas fa-circle-info text-blue-600 mt-1"></i>

            <div>

                <h4 class="font-bold text-blue-700">

                    Informasi Reward

                </h4>

                <p class="text-sm text-blue-600 mt-1 leading-6">

                    Point diberikan berdasarkan kehadiran,
                    penyelesaian event, maupun reward khusus dari admin.
                    Point dapat digunakan sebagai indikator
                    keaktifan peserta.

                </p>

            </div>

        </div>

    </div>

</div>