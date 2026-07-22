@php

    $totalEvent = $events->total();

    $eventAktif = $events->where('status', 'terbuka')->count();

    $eventSelesai = $events->where('status', 'selesai')->count();

    $totalPeserta = $events->sum(function ($event) {
        return $event->pesertas_count ?? ($event->pesertas->count() ?? 0);
    });

@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

    {{-- ========================================= --}}
    {{-- TOTAL EVENT --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Total Event

                </p>

                <h2 class="mt-3 text-4xl font-black text-slate-800">

                    {{ number_format($totalEvent) }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">

                <i class="fas fa-calendar-days text-2xl text-blue-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- EVENT AKTIF --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Event Aktif

                </p>

                <h2 class="mt-3 text-4xl font-black text-green-600">

                    {{ number_format($eventAktif) }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">

                <i class="fas fa-circle-play text-2xl text-green-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- EVENT SELESAI --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Event Selesai

                </p>

                <h2 class="mt-3 text-4xl font-black text-indigo-600">

                    {{ number_format($eventSelesai) }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center">

                <i class="fas fa-flag-checkered text-2xl text-indigo-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- TOTAL PESERTA --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Total Peserta

                </p>

                <h2 class="mt-3 text-4xl font-black text-amber-600">

                    {{ number_format($totalPeserta) }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-amber-100 flex items-center justify-center">

                <i class="fas fa-users text-2xl text-amber-600"></i>

            </div>

        </div>

    </div>

</div>