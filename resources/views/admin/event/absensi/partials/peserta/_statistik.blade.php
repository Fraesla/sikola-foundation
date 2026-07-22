@php

    $totalPeserta = $pesertas->total();

    $pesertaAktif = $pesertas->where('status', 'aktif')->count();

    $totalHadir = $pesertas->sum(function ($peserta) {
        return $peserta->absensi->where('status', 'hadir')->count();
    });

    $belumAbsen = $pesertas->sum(function ($peserta) {
        return $peserta->absensi->where('status', 'belum_absen')->count();
    });

@endphp

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    {{-- ========================================= --}}
    {{-- TOTAL PESERTA --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Total Peserta

                </p>

                <h2 class="mt-3 text-4xl font-black text-slate-800">

                    {{ number_format($totalPeserta) }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-blue-100
                       flex items-center justify-center">

                <i class="fas fa-users text-2xl text-blue-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- PESERTA AKTIF --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Peserta Aktif

                </p>

                <h2 class="mt-3 text-4xl font-black text-green-600">

                    {{ number_format($pesertaAktif) }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-green-100
                       flex items-center justify-center">

                <i class="fas fa-user-check text-2xl text-green-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- TOTAL HADIR --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Total Hadir

                </p>

                <h2 class="mt-3 text-4xl font-black text-indigo-600">

                    {{ number_format($totalHadir) }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-indigo-100
                       flex items-center justify-center">

                <i class="fas fa-calendar-check text-2xl text-indigo-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- BELUM ABSEN --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Belum Absen

                </p>

                <h2 class="mt-3 text-4xl font-black text-orange-600">

                    {{ number_format($belumAbsen) }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-orange-100
                       flex items-center justify-center">

                <i class="fas fa-clock text-2xl text-orange-600"></i>

            </div>

        </div>

    </div>

</div>