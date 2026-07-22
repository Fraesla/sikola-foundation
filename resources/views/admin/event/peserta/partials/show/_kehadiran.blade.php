<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center gap-3 mb-8">

        <div
            class="w-12 h-12 rounded-2xl
                   bg-green-100
                   flex items-center justify-center">

            <i class="fas fa-calendar-check text-green-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Statistik Kehadiran

            </h2>

            <p class="text-slate-500">

                Ringkasan kehadiran peserta selama mengikuti event.

            </p>

        </div>

    </div>

    @php

        $persentase = $peserta->persentase_kehadiran ?? 0;
        $hadir = $peserta->total_hadir ?? 0;
        $tidakHadir = $peserta->total_tidak_hadir ?? 0;
        $scan = $peserta->total_scan ?? 0;

        $totalHari = \Carbon\Carbon::parse($peserta->event->tanggal_mulai)
                        ->diffInDays(
                            \Carbon\Carbon::parse($peserta->event->tanggal_selesai)
                        ) + 1;

    @endphp

    {{-- ========================================= --}}
    {{-- PROGRESS --}}
    {{-- ========================================= --}}

    <div class="mb-8">

        <div class="flex items-center justify-between mb-3">

            <span class="font-semibold text-slate-700">

                Persentase Kehadiran

            </span>

            <span class="font-black text-2xl text-green-600">

                {{ number_format($persentase,2) }}%

            </span>

        </div>

        <div class="w-full h-5 rounded-full bg-slate-200 overflow-hidden">

            <div
                class="h-full rounded-full bg-green-500 transition-all duration-700"
                style="width: {{ min($persentase,100) }}%">

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- CARD --}}
    {{-- ========================================= --}}

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Total Hari --}}
        <div class="rounded-2xl bg-blue-50 p-5 text-center">

            <div
                class="w-14 h-14 mx-auto rounded-2xl
                       bg-blue-100 flex items-center justify-center">

                <i class="fas fa-calendar text-blue-600 text-xl"></i>

            </div>

            <h4 class="mt-4 text-3xl font-black text-blue-700">

                {{ $totalHari }}

            </h4>

            <p class="text-sm text-slate-500 mt-1">

                Hari Event

            </p>

        </div>

        {{-- Hadir --}}
        <div class="rounded-2xl bg-green-50 p-5 text-center">

            <div
                class="w-14 h-14 mx-auto rounded-2xl
                       bg-green-100 flex items-center justify-center">

                <i class="fas fa-user-check text-green-600 text-xl"></i>

            </div>

            <h4 class="mt-4 text-3xl font-black text-green-700">

                {{ $hadir }}

            </h4>

            <p class="text-sm text-slate-500 mt-1">

                Hadir

            </p>

        </div>

        {{-- Tidak Hadir --}}
        <div class="rounded-2xl bg-red-50 p-5 text-center">

            <div
                class="w-14 h-14 mx-auto rounded-2xl
                       bg-red-100 flex items-center justify-center">

                <i class="fas fa-user-times text-red-600 text-xl"></i>

            </div>

            <h4 class="mt-4 text-3xl font-black text-red-700">

                {{ $tidakHadir }}

            </h4>

            <p class="text-sm text-slate-500 mt-1">

                Tidak Hadir

            </p>

        </div>

        {{-- Scan --}}
        <div class="rounded-2xl bg-indigo-50 p-5 text-center">

            <div
                class="w-14 h-14 mx-auto rounded-2xl
                       bg-indigo-100 flex items-center justify-center">

                <i class="fas fa-qrcode text-indigo-600 text-xl"></i>

            </div>

            <h4 class="mt-4 text-3xl font-black text-indigo-700">

                {{ $scan }}

            </h4>

            <p class="text-sm text-slate-500 mt-1">

                Total Scan

            </p>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- KETERANGAN --}}
    {{-- ========================================= --}}

    <div class="mt-8 rounded-2xl bg-slate-50 border border-slate-200 p-5">

        <div class="flex items-start gap-3">

            <i class="fas fa-circle-info text-blue-600 mt-1"></i>

            <div>

                <h4 class="font-bold text-slate-700">

                    Informasi Kehadiran

                </h4>

                <p class="text-sm text-slate-500 mt-1">

                    Persentase kehadiran dihitung berdasarkan jumlah hari event
                    dibandingkan dengan jumlah kehadiran peserta. Data ini akan
                    diperbarui secara otomatis setiap kali peserta melakukan scan
                    QR Code absensi.

                </p>

            </div>

        </div>

    </div>

</div>