@extends('layouts.admin',['activePage'=>'event'])

@section('content')

<div class="mb-10">

    <h1 class="text-4xl font-bold">
        Event & Peserta
    </h1>

    <p class="mt-2 text-lg"
       style="color:var(--color-coklat)">
        Kelola seluruh event, peserta, registrasi,
        absensi dan reward poin volunteer.
    </p>

</div>

<div class="grid lg:grid-cols-2 gap-8">

    {{-- EVENT --}}
    <div class="admin-card rounded-[34px] overflow-hidden">

        <div class="h-2"
             style="background:
             linear-gradient(90deg,
             var(--color-kuning),
             var(--color-coklat));">
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
                Kelola seluruh event volunteer,
                kuota peserta, lokasi kegiatan,
                reward poin serta jadwal pelaksanaan.
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
                        Aktif
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
               style="background:
               linear-gradient(135deg,
               var(--color-merah),
               var(--color-coklat));">

                Kelola Event

            </a>

        </div>

    </div>


    {{-- PESERTA --}}
    <div class="admin-card rounded-[34px] overflow-hidden">

        <div class="h-2"
             style="background:
             linear-gradient(90deg,
             var(--color-merah),
             var(--color-kuning));">
        </div>

        <div class="p-8">

            <div class="uppercase tracking-[8px] text-sm"
                 style="color:var(--color-coklat)">
                Peserta
            </div>

            <h2 class="text-4xl font-bold mt-5">
                Data Peserta
            </h2>

            <p class="mt-5 leading-8"
               style="color:var(--color-coklat)">
                Kelola seluruh peserta event,
                verifikasi pendaftaran,
                absensi kegiatan,
                serta pemberian poin volunteer.
            </p>

            <div class="grid grid-cols-3 gap-6 mt-10">

                <div>

                    <small class="admin-muted">
                        Total Peserta
                    </small>

                    <h3 class="text-5xl font-bold mt-2"
                        style="color:var(--color-kuning)">
                        {{ $totalPeserta }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Pending
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-blue-600">
                        {{ $pendingPeserta }}
                    </h3>

                </div>

                <div>

                    <small class="admin-muted">
                        Hadir
                    </small>

                    <h3 class="text-5xl font-bold mt-2 text-green-600">
                        {{ $hadirPeserta }}
                    </h3>

                </div>

            </div>

            <a href="{{ route('admin.eventDaftar.index') }}"
               class="inline-block mt-10 px-8 py-4 rounded-2xl text-white font-semibold"
               style="background:
               linear-gradient(135deg,
               var(--color-kuning),
               var(--color-coklat));">

                Kelola Peserta

            </a>

        </div>

    </div>

</div>

@endsection