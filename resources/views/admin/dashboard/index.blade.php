@extends('layouts.admin', [
    'activePage' => 'dashboard'
])

@section('content')

<div class="p-6">



    <!-- Statistik -->
    <div class="grid md:grid-cols-4 gap-6 mt-10">

        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-slate-500 text-sm">
                Total Donasi
            </p>

            <h2 class="text-3xl font-bold mt-2">
                Rp 25 Jt
            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-slate-500 text-sm">
                Total Order
            </p>

            <h2 class="text-3xl font-bold mt-2">
                124
            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-slate-500 text-sm">
                Relawan Baru
            </p>

            <h2 class="text-3xl font-bold mt-2">
                18
            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <p class="text-slate-500 text-sm">
                Pending
            </p>

            <h2 class="text-3xl font-bold mt-2 text-red-600">
                6
            </h2>

        </div>

    </div>

    <!-- Grafik -->
    <div class="bg-white rounded-2xl shadow p-6 mt-10">

        <div class="flex justify-between items-center mb-6">

            <h3 class="text-xl font-bold">
                Grafik Donasi Bulanan
            </h3>

        </div>

        <canvas id="donationChart" height="100"></canvas>

    </div>

    <!-- Notifikasi -->
    <div class="bg-white rounded-2xl shadow p-6 mt-10">

        <h3 class="text-xl font-bold mb-6">
            Notifikasi Pending
        </h3>

        <div class="space-y-4">

            <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-xl">

                5 Donasi menunggu verifikasi pembayaran.

            </div>

            <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl">

                2 Relawan menunggu persetujuan admin.

            </div>

            <div class="bg-green-50 border border-green-200 p-4 rounded-xl">

                3 Order merchandise perlu diproses.

            </div>

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

        labels: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun'
        ],

        datasets: [{

            label: 'Donasi',

            data: [
                5000000,
                3000000,
                7000000,
                4000000,
                6000000,
                8000000
            ]

        }]

    }

});

</script>

@endpush