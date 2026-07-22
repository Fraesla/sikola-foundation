@php

    $totalPeserta = $absensis->count();

    $totalHadir = $absensis->where('status', 'hadir')->count();

    $totalTidakHadir = $absensis->where('status', 'tidak_hadir')->count();

    $totalBelumAbsen = $absensis->where('status', 'belum_absen')->count();

    $persentase = $totalPeserta > 0
        ? round(($totalHadir / $totalPeserta) * 100, 1)
        : 0;

@endphp

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">

    {{-- Total Peserta --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-sm text-slate-500">

                    Total Peserta

                </p>

                <h2 class="text-4xl font-black mt-3">

                    {{ $totalPeserta }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">

                <i class="fas fa-users text-2xl text-blue-600"></i>

            </div>

        </div>

    </div>

    {{-- Hadir --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-sm text-slate-500">

                    Hadir

                </p>

                <h2 class="text-4xl font-black mt-3 text-green-600">

                    {{ $totalHadir }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">

                <i class="fas fa-user-check text-2xl text-green-600"></i>

            </div>

        </div>

    </div>

    {{-- Tidak Hadir --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-sm text-slate-500">

                    Tidak Hadir

                </p>

                <h2 class="text-4xl font-black mt-3 text-red-600">

                    {{ $totalTidakHadir }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">

                <i class="fas fa-user-xmark text-2xl text-red-600"></i>

            </div>

        </div>

    </div>

    {{-- Belum Absen --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-sm text-slate-500">

                    Belum Absen

                </p>

                <h2 class="text-4xl font-black mt-3 text-yellow-500">

                    {{ $totalBelumAbsen }}

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center">

                <i class="fas fa-clock text-2xl text-yellow-600"></i>

            </div>

        </div>

    </div>

    {{-- Persentase --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-sm text-slate-500">

                    Kehadiran

                </p>

                <h2 class="text-4xl font-black mt-3 text-indigo-600">

                    {{ $persentase }}%

                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center">

                <i class="fas fa-chart-pie text-2xl text-indigo-600"></i>

            </div>

        </div>

    </div>

</div>

{{-- INFORMASI MODE --}}

<div class="mt-6">

    @if($mode == 'input')

        <div class="rounded-2xl border border-green-200 bg-green-50 p-5">

            <div class="flex gap-3">

                <i class="fas fa-circle-check text-green-600 mt-1"></i>

                <div>

                    <h4 class="font-bold text-green-700">

                        Mode Input Absensi

                    </h4>

                    <p class="text-green-700 mt-1">

                        Hari ini merupakan jadwal absensi yang sedang berlangsung.
                        Status peserta masih dapat diubah dan disimpan.

                    </p>

                </div>

            </div>

        </div>

    @elseif($mode == 'history')

        <div class="rounded-2xl border border-blue-200 bg-blue-50 p-5">

            <div class="flex gap-3">

                <i class="fas fa-clock-rotate-left text-blue-600 mt-1"></i>

                <div>

                    <h4 class="font-bold text-blue-700">

                        Mode Riwayat

                    </h4>

                    <p class="text-blue-700 mt-1">

                        Data absensi hari ini hanya ditampilkan sebagai riwayat.
                        Untuk mengubah data gunakan menu Edit Absensi atau Rekap Absensi.

                    </p>

                </div>

            </div>

        </div>

    @else

        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">

            <div class="flex gap-3">

                <i class="fas fa-lock text-amber-600 mt-1"></i>

                <div>

                    <h4 class="font-bold text-amber-700">

                        Jadwal Belum Dibuka

                    </h4>

                    <p class="text-amber-700 mt-1">

                        Hari absensi yang dipilih belum memasuki jadwal pelaksanaan.
                        Input absensi akan aktif ketika tanggal tersebut tiba.

                    </p>

                </div>

            </div>

        </div>

    @endif

</div>