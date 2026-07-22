@php

$total = $registrasi->total();

$mendaftar = $registrasi
    ->where('status','mendaftar')
    ->count();

$dikonfirmasi = $registrasi
    ->where('status','dikonfirmasi')
    ->count();

$ditolak = $registrasi
    ->where('status','ditolak')
    ->count();

@endphp

<div class="grid grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="admin-card rounded-3xl p-6">

        <div class="text-5xl mb-3">

            👥

        </div>

        <p class="text-slate-500">

            Total Registrasi

        </p>

        <h2 class="text-3xl font-black mt-2">

            {{ $total }}

        </h2>

    </div>

    <div class="admin-card rounded-3xl p-6">

        <div class="text-5xl mb-3">

            🟡

        </div>

        <p class="text-slate-500">

            Menunggu

        </p>

        <h2 class="text-3xl font-black mt-2 text-yellow-600">

            {{ $mendaftar }}

        </h2>

    </div>

    <div class="admin-card rounded-3xl p-6">

        <div class="text-5xl mb-3">

            🟢

        </div>

        <p class="text-slate-500">

            Dikonfirmasi

        </p>

        <h2 class="text-3xl font-black mt-2 text-green-600">

            {{ $dikonfirmasi }}

        </h2>

    </div>

    <div class="admin-card rounded-3xl p-6">

        <div class="text-5xl mb-3">

            🔴

        </div>

        <p class="text-slate-500">

            Ditolak

        </p>

        <h2 class="text-3xl font-black mt-2 text-red-600">

            {{ $ditolak }}

        </h2>

    </div>

</div>