@php

    $totalEvent = $pesertas->count();

    $totalLulus = $pesertas->where('status','lulus')->count();

    $totalAktif = $pesertas->where('status','aktif')->count();

    $totalPoint = $pesertas->sum('poin');

    $rataKehadiran = $totalEvent
        ? round($pesertas->avg('persentase_hadir'),2)
        : 0;

@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">

    {{-- ========================================= --}}
    {{-- TOTAL EVENT --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Total Event

                </p>

                <h2 class="text-4xl font-black mt-3 text-slate-800">

                    {{ $totalEvent }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-blue-100
                       flex items-center justify-center">

                <i class="fas fa-calendar-days text-blue-600 text-2xl"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- LULUS --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Event Lulus

                </p>

                <h2 class="text-4xl font-black mt-3 text-green-600">

                    {{ $totalLulus }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-green-100
                       flex items-center justify-center">

                <i class="fas fa-award text-green-600 text-2xl"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- AKTIF --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Masih Aktif

                </p>

                <h2 class="text-4xl font-black mt-3 text-indigo-600">

                    {{ $totalAktif }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-indigo-100
                       flex items-center justify-center">

                <i class="fas fa-user-check text-indigo-600 text-2xl"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- TOTAL POINT --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Total Point

                </p>

                <h2 class="text-4xl font-black mt-3 text-yellow-600">

                    {{ number_format($totalPoint) }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-yellow-100
                       flex items-center justify-center">

                <i class="fas fa-star text-yellow-600 text-2xl"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- RATA-RATA KEHADIRAN --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div>

            <div class="flex justify-between">

                <span class="text-sm text-slate-500">

                    Rata-rata Hadir

                </span>

                <span
                    class="font-bold

                    @if($rataKehadiran>=80)

                        text-green-600

                    @elseif($rataKehadiran>=50)

                        text-yellow-600

                    @else

                        text-red-600

                    @endif">

                    {{ $rataKehadiran }}%

                </span>

            </div>

            <div class="mt-5">

                <div class="w-full h-3 bg-slate-200 rounded-full overflow-hidden">

                    <div
                        class="h-3 rounded-full

                        @if($rataKehadiran>=80)

                            bg-green-500

                        @elseif($rataKehadiran>=50)

                            bg-yellow-500

                        @else

                            bg-red-500

                        @endif"

                        style="width: {{ min($rataKehadiran,100) }}%">

                    </div>

                </div>

            </div>

            <p class="mt-4 text-sm text-slate-500">

                Persentase Kehadiran

            </p>

        </div>

    </div>

</div>