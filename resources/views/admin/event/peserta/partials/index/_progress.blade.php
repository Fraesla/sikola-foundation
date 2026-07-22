<div class="w-56">

    {{-- ========================================= --}}
    {{-- Progress Bar --}}
    {{-- ========================================= --}}

    <div
        class="w-full h-3 rounded-full bg-slate-200 overflow-hidden">

        @php

            $persentase = max(
                0,
                min(
                    100,
                    $peserta->persentase_kehadiran ?? 0
                )
            );

        @endphp

        <div
            class="h-full rounded-full
            @if($persentase >= 80)
                bg-green-500
            @elseif($persentase >= 60)
                bg-yellow-500
            @else
                bg-red-500
            @endif"

            style="width: {{ $persentase }}%;">

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- Persentase --}}
    {{-- ========================================= --}}

    <div
        class="flex justify-between items-center mt-2">

        <span
            class="text-xs text-slate-500">

            Kehadiran

        </span>

        <span
            class="font-bold text-sm">

            {{ number_format($persentase,2) }}%

        </span>

    </div>

    {{-- ========================================= --}}
    {{-- Statistik --}}
    {{-- ========================================= --}}

    <div
        class="grid grid-cols-3 gap-2 mt-4">

        <div
            class="rounded-xl bg-green-50 p-2 text-center">

            <div
                class="text-lg font-bold text-green-600">

                {{ $peserta->total_hadir }}

            </div>

            <small
                class="text-slate-500">

                Hadir

            </small>

        </div>

        <div
            class="rounded-xl bg-red-50 p-2 text-center">

            <div
                class="text-lg font-bold text-red-600">

                {{ $peserta->total_tidak_hadir }}

            </div>

            <small
                class="text-slate-500">

                Alpha

            </small>

        </div>

        <div
            class="rounded-xl bg-blue-50 p-2 text-center">

            <div
                class="text-lg font-bold text-blue-600">

                {{ $peserta->total_scan }}

            </div>

            <small
                class="text-slate-500">

                Scan

            </small>

        </div>

    </div>

</div>