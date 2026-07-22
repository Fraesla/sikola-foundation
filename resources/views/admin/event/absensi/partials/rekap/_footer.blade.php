@php

    use Carbon\Carbon;

    $totalHari = Carbon::parse($event->tanggal_mulai)
        ->diffInDays($event->tanggal_selesai) + 1;

    $totalPeserta = $pesertas->count();

    $totalHadir = $pesertas->sum(function ($peserta) {
        return $peserta->absensi->where('status','hadir')->count();
    });

    $totalTidakHadir = $pesertas->sum(function ($peserta) {
        return $peserta->absensi->where('status','tidak_hadir')->count();
    });

    $totalBelum = $totalHari-$totalHadir-$totalTidakHadir;

    $tanggalMulai = \Carbon\Carbon::parse($event->tanggal_mulai);

    $tanggalSelesai = \Carbon\Carbon::parse($event->tanggal_selesai);

    $totalHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

    $persentase = round(($totalHadir / $totalHari) * 100);

@endphp

<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- INFORMASI --}}
    {{-- ========================================= --}}
    <div class="rounded-2xl border border-blue-200 bg-blue-50 p-6">

        <div class="flex gap-4">

            <i class="fas fa-circle-info text-blue-600 mt-1"></i>

            <div>

                <h4 class="font-bold text-blue-700">

                    Ringkasan Rekap Event

                </h4>

                <ul class="mt-4 space-y-2 text-blue-700 leading-7">

                    <li>

                        • Total Hari Event :

                        <strong>{{ $totalHari }} Hari</strong>

                    </li>

                    <li>

                        • Total Peserta :

                        <strong>{{ $totalPeserta }} Peserta</strong>

                    </li>

                    <li>

                        • Total Kehadiran :

                        <strong>{{ $totalHadir }}</strong>

                    </li>

                    <li>

                        • Total Tidak Hadir :

                        <strong>{{ $totalTidakHadir }}</strong>

                    </li>

                    <li>

                        • Belum Absen :

                        <strong>{{ $totalBelum }}</strong>

                    </li>

                    <li>

                        • Persentase Kehadiran Event :

                        <strong>{{ $persentase }}%</strong>

                    </li>

                </ul>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- BUTTON --}}
    {{-- ========================================= --}}
    <div class="mt-8 flex flex-col lg:flex-row justify-between items-center gap-5">

        <div>

            <div class="text-sm text-slate-500">

                Periode Event

            </div>

            <div class="font-semibold">

                {{ Carbon::parse($event->tanggal_mulai)->translatedFormat('d M Y') }}

                -

                {{ Carbon::parse($event->tanggal_selesai)->translatedFormat('d M Y') }}

            </div>

        </div>

        <div class="flex flex-wrap gap-3">

            {{-- Kembali --}}
            <a
                href="{{ route('admin.absensi.peserta',$event) }}"
                class="inline-flex items-center gap-2
                       px-6 py-3
                       rounded-2xl
                       bg-slate-100
                       hover:bg-slate-200
                       font-semibold">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

            {{-- Input Absensi --}}
            <a
                href="{{ route('admin.absensi.create',$event) }}"
                class="inline-flex items-center gap-2
                       px-6 py-3
                       rounded-2xl
                       bg-green-600
                       hover:bg-green-700
                       text-white
                       font-semibold">

                <i class="fas fa-clipboard-check"></i>

                Input Absensi

            </a>

            {{-- Refresh --}}
            <a
                href="{{ route('admin.absensi.rekap',$event) }}"
                class="inline-flex items-center gap-2
                       px-6 py-3
                       rounded-2xl
                       bg-indigo-600
                       hover:bg-indigo-700
                       text-white
                       font-semibold">

                <i class="fas fa-rotate-right"></i>

                Refresh

            </a>

            {{-- Export (sementara disabled) --}}
            <button
                type="button"
                disabled
                class="inline-flex items-center gap-2
                       px-6 py-3
                       rounded-2xl
                       bg-amber-100
                       text-amber-700
                       cursor-not-allowed
                       font-semibold">

                <i class="fas fa-file-export"></i>

                Export (Coming Soon)

            </button>

        </div>

    </div>

</div>