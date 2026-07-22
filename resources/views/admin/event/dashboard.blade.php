@extends('layouts.admin',['activePage'=>'event'])

@section('content')

<div class="mb-10">

    <h1 class="text-4xl font-bold">
        Event & Volunteer
    </h1>

    <p class="mt-2 text-lg"
       style="color:var(--color-coklat)">
        Kelola seluruh event, registrasi peserta,
        absensi kegiatan serta reward poin volunteer.
    </p>

</div>

<div class="grid lg:grid-cols-2 gap-8">

    {{-- ================= EVENT ================= --}}
    <div class="admin-card rounded-[34px] overflow-hidden">

        <div class="h-2"
             style="background:linear-gradient(90deg,var(--color-kuning),var(--color-coklat));">
        </div>

        <div class="p-8">

            <div class="uppercase tracking-[8px] text-sm"
                 style="color:var(--color-coklat)">
                Event
            </div>

            <h2 class="text-4xl font-bold mt-5">
                Manajemen Event
            </h2>

            <p class="mt-5 leading-8"
               style="color:var(--color-coklat)">
                Kelola seluruh event, lokasi kegiatan,
                kuota peserta, reward poin dan jadwal
                pelaksanaan volunteer.
            </p>

            <div class="grid grid-cols-3 gap-6 mt-10">

                <div>

                    <small class="admin-muted">
                        Total Event
                    </small>

                    <h3 class="text-5xl font-bold mt-2"
                        style="color:var(--color-merah)">
                        {{ $totalEvent }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Terbuka
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-green-600">
                        {{ $eventAktif }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Kuota
                    </small>

                    <h3 class="text-5xl font-bold mt-2"
                        style="color:var(--color-kuning)">
                        {{ $totalKuota }}
                    </h3>

                </div>

            </div>

            <a href="{{ route('admin.events.index') }}"
               class="inline-block mt-10 px-8 py-4 rounded-2xl text-white font-semibold"
               style="background:linear-gradient(135deg,var(--color-merah),var(--color-coklat));">

                Kelola Event

            </a>

        </div>

    </div>

    {{-- ================= REGISTRASI ================= --}}
    <div class="admin-card rounded-[34px] overflow-hidden">

        <div class="h-2"
             style="background:linear-gradient(90deg,var(--color-merah),var(--color-kuning));">
        </div>

        <div class="p-8">

            <div class="uppercase tracking-[8px] text-sm"
                 style="color:var(--color-coklat)">
                Registrasi
            </div>

            <h2 class="text-4xl font-bold mt-5">
                Registrasi Event
            </h2>

            <p class="mt-5 leading-8"
               style="color:var(--color-coklat)">
                Verifikasi seluruh pendaftaran
                peserta sebelum menjadi volunteer
                aktif pada event.
            </p>

            <div class="grid grid-cols-3 gap-6 mt-10">

                <div>

                    <small class="admin-muted">
                        Total
                    </small>

                    <h3 class="text-5xl font-bold mt-2"
                        style="color:var(--color-kuning)">
                        {{ $totalRegistrasi }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Pending
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-blue-600">
                        {{ $registrasiPending }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Diterima
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-green-600">
                        {{ $registrasiDiterima }}
                    </h3>

                </div>

            </div>

            <a href="{{ route('admin.event.daftar') }}"
               class="inline-block mt-10 px-8 py-4 rounded-2xl text-white font-semibold"
               style="background:linear-gradient(135deg,var(--color-kuning),var(--color-coklat));">

                Kelola Registrasi

            </a>

        </div>

    </div>

    {{-- ================= PESERTA ================= --}}
    <div class="admin-card rounded-[34px] overflow-hidden">

        <div class="h-2"
             style="background:linear-gradient(90deg,#0EA5E9,#2563EB);">
        </div>

        <div class="p-8">

            <div class="uppercase tracking-[8px] text-sm text-blue-700">
                Peserta
            </div>

            <h2 class="text-4xl font-bold mt-5">
                Data Peserta
            </h2>

            <p class="mt-5 leading-8 text-gray-600">
                Kelola seluruh peserta aktif,
                poin volunteer, sertifikat dan
                status kelulusan.
            </p>

            <div class="grid grid-cols-3 gap-6 mt-10">

                <div>

                    <small class="admin-muted">
                        Total
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-blue-700">
                        {{ $totalPeserta }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Lulus
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-green-600">
                        {{ $pesertaLulus }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Tidak
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-red-600">
                        {{ $pesertaTidakLulus }}
                    </h3>

                </div>

            </div>

            <a href="{{ route('admin.peserta.index') }}"
               class="inline-block mt-10 px-8 py-4 rounded-2xl bg-blue-600 text-white font-semibold">

                Kelola Peserta

            </a>

        </div>

    </div>

    {{-- ================= ABSENSI ================= --}}
    <div class="admin-card rounded-[34px] overflow-hidden">

        <div class="h-2 bg-green-600"></div>

        <div class="p-8">

            <div class="uppercase tracking-[8px] text-sm text-green-700">
                Absensi
            </div>

            <h2 class="text-4xl font-bold mt-5">
                Rekap Absensi
            </h2>

            <p class="mt-5 leading-8 text-gray-600">
                Monitoring kehadiran volunteer,
                total scan, persentase hadir
                dan hasil rekap event.
            </p>

            <div class="grid grid-cols-3 gap-6 mt-10">

                <div>

                    <small class="admin-muted">
                        Total Event Terbuka
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-green-700">
                        {{ $eventAktif }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Total Hadir
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-green-500">
                        {{ $totalHadir }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Total Rekap
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-yellow-600">
                        {{ $totalRekap }}
                    </h3>

                </div>

            </div>

            <a href="{{ route('admin.absensi.index') }}"
               class="inline-block mt-10 px-8 py-4 rounded-2xl bg-green-600 text-white font-semibold">

                Kelola Absensi

            </a>

        </div>

    </div>

</div>

@endsection