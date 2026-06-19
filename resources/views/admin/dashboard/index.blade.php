@extends('layouts.admin', [
    'activePage' => 'dashboard'
])

@section('content')

<!-- Welcome -->
<div
    class="rounded-3xl p-8 mb-8"
    style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
        color: var(--color-putih);
    ">

    <h1 class="text-3xl font-bold">
        Dashboard Admin
    </h1>

    <p class="mt-3 opacity-90">
        Selamat datang di panel administrasi
        Sikola Foundation.
    </p>

</div>

<!-- Statistik -->
<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Donasi -->
    <div
        class="rounded-3xl p-6"
        style="
            background-color: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl"
            style="
                background-color: rgba(204,34,34,.12);
                color: var(--color-merah);
            ">
            💰
        </div>

        <p
            class="mt-4 text-sm"
            style="color: var(--color-coklat);">

            Total Donasi

        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-hitam);">

            Rp 25 Jt

        </h2>

    </div>

    <!-- Order -->
    <div
        class="rounded-3xl p-6"
        style="
            background-color: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl"
            style="
                background-color: rgba(212,160,23,.15);
                color: var(--color-kuning);
            ">
            🛍
        </div>

        <p
            class="mt-4 text-sm"
            style="color: var(--color-coklat);">

            Total Order

        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-hitam);">

            124

        </h2>

    </div>

    <!-- Relawan -->
    <div
        class="rounded-3xl p-6"
        style="
            background-color: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl"
            style="
                background-color: rgba(139,94,42,.15);
                color: var(--color-coklat);
            ">
            🤝
        </div>

        <p
            class="mt-4 text-sm"
            style="color: var(--color-coklat);">

            Relawan Baru

        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-hitam);">

            18

        </h2>

    </div>

    <!-- Pending -->
    <div
        class="rounded-3xl p-6"
        style="
            background-color: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl"
            style="
                background-color: rgba(204,34,34,.12);
                color: var(--color-merah);
            ">
            ⏳
        </div>

        <p
            class="mt-4 text-sm"
            style="color: var(--color-coklat);">

            Pending

        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-merah);">

            6

        </h2>

    </div>

</div>

<!-- Grafik -->
<div
    class="rounded-3xl p-8 mt-10"
    style="
        background-color: white;
        box-shadow: var(--shadow);
    ">

    <div class="flex items-center justify-between mb-6">

        <h3
            class="text-2xl font-bold"
            style="color: var(--color-hitam);">

            Grafik Donasi Bulanan

        </h3>

    </div>

    <canvas id="donationChart" height="100"></canvas>

</div>

<!-- Notifikasi -->
<div
    class="rounded-3xl p-8 mt-10"
    style="
        background-color: white;
        box-shadow: var(--shadow);
    ">

    <h3
        class="text-2xl font-bold mb-6"
        style="color: var(--color-hitam);">

        Notifikasi Pending

    </h3>

    <div class="space-y-4">

        <div
            class="p-4 rounded-2xl"
            style="
                background-color: rgba(204,34,34,.08);
                border-left: 4px solid var(--color-merah);
            ">

            💰 5 Donasi menunggu verifikasi pembayaran.

        </div>

        <div
            class="p-4 rounded-2xl"
            style="
                background-color: rgba(212,160,23,.10);
                border-left: 4px solid var(--color-kuning);
            ">

            🤝 2 Relawan menunggu persetujuan admin.

        </div>

        <div
            class="p-4 rounded-2xl"
            style="
                background-color: rgba(139,94,42,.10);
                border-left: 4px solid var(--color-coklat);
            ">

            🛍 3 Order merchandise perlu diproses.

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('donationChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
        datasets: [{
            label: 'Donasi',
            data: [
                5000000,
                3000000,
                7000000,
                4000000,
                6000000,
                8000000
            ],
            backgroundColor: '#CC2222',
            borderRadius: 8
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

</script>
@endpush