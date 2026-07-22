@php

$totalPeserta = $pesertas->count();

$totalHadir = $pesertas->sum(function ($peserta) {
    return $peserta->absensi->where('status','hadir')->count();
});

$totalTidakHadir = $pesertas->sum(function ($peserta) {
    return $peserta->absensi->where('status','tidak_hadir')->count();
});

$totalBelum = $pesertas->sum(function ($peserta) {
    return $peserta->absensi->where('status','belum_absen')->count();
});


$tanggalMulai = \Carbon\Carbon::parse($event->tanggal_mulai);

$tanggalSelesai = \Carbon\Carbon::parse($event->tanggal_selesai);

$totalHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

$persentase = round(($totalHadir / $totalHari) * 100);

@endphp

<div class="grid grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="admin-card rounded-3xl p-6">

        <div class="text-slate-500 text-sm">

            Total Peserta

        </div>

        <div class="mt-2 text-4xl font-black text-slate-800">

            {{ $totalPeserta }}

        </div>

    </div>

    <div class="admin-card rounded-3xl p-6 bg-green-50 border border-green-200">

        <div class="text-green-700 text-sm">

            Total Hadir

        </div>

        <div class="mt-2 text-4xl font-black text-green-600">

            {{ $totalHadir }}

        </div>

    </div>

    <div class="admin-card rounded-3xl p-6 bg-red-50 border border-red-200">

        <div class="text-red-700 text-sm">

            Tidak Hadir

        </div>

        <div class="mt-2 text-4xl font-black text-red-600">

            {{ $totalTidakHadir }}

        </div>

    </div>

    <div class="admin-card rounded-3xl p-6 bg-indigo-50 border border-indigo-200">

        <div class="text-indigo-700 text-sm">

            Kehadiran Event

        </div>

        <div class="mt-2 text-4xl font-black text-indigo-600">

            {{ $persentase }}%

        </div>

    </div>

</div>

<div class="admin-card rounded-3xl p-8 mt-6">

    <div class="flex justify-between mb-3">

        <span class="font-semibold text-slate-700">

            Progress Kehadiran Event

        </span>

        <span class="font-bold text-indigo-600">

            {{ $persentase }}%

        </span>

    </div>

    <div class="h-3 rounded-full bg-slate-200 overflow-hidden">

        <div
            class="h-full rounded-full bg-green-500 transition-all"
            style="width: {{ $persentase }}%">

        </div>

    </div>

</div>