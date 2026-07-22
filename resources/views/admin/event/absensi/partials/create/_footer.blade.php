@php

    $totalPeserta = $absensis->count();

    $totalHadir = $absensis->where('status', 'hadir')->count();

    $totalTidakHadir = $absensis->where('status', 'tidak_hadir')->count();

    $totalBelumAbsen = $absensis->where('status', 'belum_absen')->count();

    $persentase = $totalPeserta > 0
        ? round(($totalHadir / $totalPeserta) * 100)
        : 0;

@endphp

<div class="admin-card rounded-3xl p-8">

    {{-- ================================================= --}}
    {{-- HEADER --}}
    {{-- ================================================= --}}
    <div class="flex items-center gap-4 mb-8">

        <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center">

            <i class="fas fa-chart-pie text-indigo-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Ringkasan Absensi

            </h2>

            <p class="text-slate-500">

                Statistik kehadiran peserta pada hari ke-{{ $hariKe }}.

            </p>

        </div>

    </div>

    {{-- ================================================= --}}
    {{-- STATISTIK --}}
    {{-- ================================================= --}}
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- Total Peserta --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6">

            <p class="text-sm text-slate-500">

                Total Peserta

            </p>

            <h3
                id="totalPeserta"
                class="mt-2 text-4xl font-black text-slate-800">

                {{ $totalPeserta }}

            </h3>

        </div>

        {{-- Hadir --}}
        <div class="rounded-2xl border border-green-200 bg-green-50 p-6">

            <p class="text-sm text-green-700">

                Hadir

            </p>

            <h3
                id="totalHadir"
                class="mt-2 text-4xl font-black text-green-600">

                {{ $totalHadir }}

            </h3>

        </div>

        {{-- Tidak Hadir --}}
        <div class="rounded-2xl border border-red-200 bg-red-50 p-6">

            <p class="text-sm text-red-700">

                Tidak Hadir

            </p>

            <h3
                id="totalTidakHadir"
                class="mt-2 text-4xl font-black text-red-600">

                {{ $totalTidakHadir }}

            </h3>

        </div>

        {{-- Belum Absen --}}
        <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-6">

            <p class="text-sm text-yellow-700">

                Belum Absen

            </p>

            <h3
                id="totalBelumAbsen"
                class="mt-2 text-4xl font-black text-yellow-600">

                {{ $totalBelumAbsen }}

            </h3>

        </div>

    </div>

    {{-- ================================================= --}}
    {{-- PROGRESS KEHADIRAN --}}
    {{-- ================================================= --}}
    <div class="mt-8">

        <div class="flex items-center justify-between mb-3">

            <span class="font-semibold text-slate-700">

                Persentase Kehadiran

            </span>

            <span
                id="persentaseAbsensi"
                class="text-lg font-bold text-indigo-600">

                {{ $persentase }}%

            </span>

        </div>

        <div class="h-4 rounded-full bg-slate-200 overflow-hidden">

            <div
                id="progressAbsensi"
                class="h-full rounded-full bg-gradient-to-r from-green-500 to-emerald-600 transition-all duration-500"
                style="width: {{ $persentase }}%">

            </div>

        </div>

    </div>
        {{-- ================================================= --}}
    {{-- INFORMASI SISTEM --}}
    {{-- ================================================= --}}
    <div class="mt-10 rounded-3xl border border-blue-200 bg-blue-50 p-6">

        <div class="flex items-start gap-4">

            <div
                class="w-12 h-12 rounded-2xl
                       bg-blue-100
                       flex items-center justify-center
                       shrink-0">

                <i class="fas fa-circle-info text-blue-600 text-lg"></i>

            </div>

            <div class="flex-1">

                <h3 class="text-lg font-bold text-blue-800">

                    Informasi Absensi

                </h3>

                <p class="text-blue-700 mt-1">

                    Status halaman saat ini menyesuaikan tanggal pelaksanaan
                    event.

                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                    <div>

                        <ul class="space-y-3 text-blue-800">

                            <li>

                                <i class="fas fa-calendar-day w-5"></i>

                                Hari Pelaksanaan :

                                <strong>

                                    Hari ke-{{ $hariKe }}

                                </strong>

                            </li>

                            <li>

                                <i class="fas fa-calendar w-5"></i>

                                Tanggal :

                                <strong>

                                    {{ $tanggal->translatedFormat('d F Y') }}

                                </strong>

                            </li>

                            <li>

                                <i class="fas fa-users w-5"></i>

                                Total Peserta :

                                <strong>

                                    {{ $totalPeserta }}

                                </strong>

                            </li>

                        </ul>

                    </div>

                    <div>

                        @switch($mode)

                            @case('input')

                                <div
                                    class="rounded-2xl
                                           bg-green-100
                                           border border-green-200
                                           p-5">

                                    <div class="flex gap-3">

                                        <i class="fas fa-circle-check text-green-600 mt-1"></i>

                                        <div>

                                            <div class="font-bold text-green-700">

                                                Mode Input

                                            </div>

                                            <p class="text-green-700 text-sm mt-2 leading-6">

                                                Absensi hari ini dapat diinput.
                                                Status peserta masih bisa diubah
                                                sebelum tombol
                                                <strong>Simpan Absensi</strong>
                                                ditekan.

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @break

                            @case('history')

                                <div
                                    class="rounded-2xl
                                           bg-indigo-100
                                           border border-indigo-200
                                           p-5">

                                    <div class="flex gap-3">

                                        <i class="fas fa-clock-rotate-left text-indigo-600 mt-1"></i>

                                        <div>

                                            <div class="font-bold text-indigo-700">

                                                Mode Koreksi

                                            </div>

                                            <p class="text-indigo-700 text-sm mt-2 leading-6">

                                                Anda sedang membuka data
                                                absensi yang telah tersimpan.
                                                Status kehadiran maupun catatan
                                                masih dapat diperbarui.

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @break

                            @default

                                <div
                                    class="rounded-2xl
                                           bg-yellow-100
                                           border border-yellow-200
                                           p-5">

                                    <div class="flex gap-3">

                                        <i class="fas fa-lock text-yellow-600 mt-1"></i>

                                        <div>

                                            <div class="font-bold text-yellow-700">

                                                Jadwal Belum Dimulai

                                            </div>

                                            <p class="text-yellow-700 text-sm mt-2 leading-6">

                                                Hari pelaksanaan belum tiba.
                                                Sistem belum mengizinkan
                                                pengisian absensi.

                                            </p>

                                        </div>

                                    </div>

                                </div>

                        @endswitch

                    </div>

                </div>

            </div>

        </div>

    </div>
        {{-- ================================================= --}}
    {{-- FOOTER ACTION --}}
    {{-- ================================================= --}}
    <div class="mt-10 pt-8 border-t border-slate-200">

        <div class="flex flex-col xl:flex-row justify-between items-center gap-6">

            {{-- Informasi Event --}}
            <div>

                <div class="text-sm text-slate-500">

                    Periode Event

                </div>

                <div class="mt-1 font-semibold text-slate-800">

                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d M Y') }}

                    —

                    {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d M Y') }}

                </div>

            </div>

            {{-- Tombol --}}
            <div class="flex flex-wrap justify-center gap-3">

                <a
                    href="{{ route('admin.absensi.peserta',$event) }}"
                    class="inline-flex items-center gap-2
                           px-6 py-3 rounded-2xl
                           bg-slate-100 hover:bg-slate-200
                           text-slate-700 font-semibold">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

                <a
                    href="{{ route('admin.absensi.rekap',$event) }}"
                    class="inline-flex items-center gap-2
                           px-6 py-3 rounded-2xl
                           bg-indigo-600 hover:bg-indigo-700
                           text-white font-semibold">

                    <i class="fas fa-chart-column"></i>

                    Rekap

                </a>

                @if($mode != 'future')

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2
                               px-8 py-3 rounded-2xl
                               bg-green-600 hover:bg-green-700
                               text-white font-bold">

                        <i class="fas fa-floppy-disk"></i>

                        {{ $mode == 'history'
                            ? 'Simpan Perubahan'
                            : 'Simpan Absensi' }}

                    </button>

                @else

                    <button
                        type="button"
                        disabled
                        class="inline-flex items-center gap-2
                               px-8 py-3 rounded-2xl
                               bg-slate-300
                               text-slate-500
                               cursor-not-allowed
                               font-bold">

                        <i class="fas fa-lock"></i>

                        Belum Bisa Input

                    </button>

                @endif

            </div>

        </div>

    </div>

</div>

{{-- ================================================= --}}
{{-- AUTO UPDATE SUMMARY --}}
{{-- ================================================= --}}
@if(in_array($mode, ['input', 'history']))

<script>

document.addEventListener('DOMContentLoaded', function () {

    function hitungAbsensi() {

        let hadir = 0;
        let tidak = 0;

        document.querySelectorAll('input[type="radio"]:checked').forEach(function(item){

            if(item.value === 'hadir'){

                hadir++;

            }else if(item.value === 'tidak_hadir'){

                tidak++;

            }

        });

        const peserta = {{ $totalPeserta }};
        const belum = peserta - hadir - tidak;
        const persen = peserta > 0
            ? Math.round((hadir / peserta) * 100)
            : 0;

        document.getElementById('totalHadir').textContent = hadir;
        document.getElementById('totalTidakHadir').textContent = tidak;
        document.getElementById('totalBelumAbsen').textContent = belum;

        document.getElementById('persentaseAbsensi').textContent = persen + '%';
        document.getElementById('progressAbsensi').style.width = persen + '%';

    }

    document.querySelectorAll('input[type="radio"]').forEach(function(item){

        item.addEventListener('change', hitungAbsensi);

    });

    hitungAbsensi();

});

</script>

@endif