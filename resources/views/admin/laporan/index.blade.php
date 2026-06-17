@extends('layouts.admin', [
    'activePage' => 'laporan'
])

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            Laporan
        </h1>

        <p class="text-slate-500 mt-2">
            Rekap seluruh aktivitas sistem.
        </p>

    </div>

    <div class="flex gap-3">

        <button
            class="bg-green-600 text-white px-5 py-3 rounded-xl">

            Export Excel

        </button>

        <button
            class="bg-red-600 text-white px-5 py-3 rounded-xl">

            Export PDF

        </button>

    </div>

</div>

<div class="grid md:grid-cols-3 gap-6">

    <div class="bg-white rounded-2xl p-6 shadow">

        <h3 class="font-bold text-lg">
            Total Donasi
        </h3>

        <p class="text-4xl font-bold mt-4">
            Rp 75 Juta
        </p>

    </div>

    <div class="bg-white rounded-2xl p-6 shadow">

        <h3 class="font-bold text-lg">
            Penjualan Merchandise
        </h3>

        <p class="text-4xl font-bold mt-4">
            Rp 25 Juta
        </p>

    </div>

    <div class="bg-white rounded-2xl p-6 shadow">

        <h3 class="font-bold text-lg">
            Aktivitas Relawan
        </h3>

        <p class="text-4xl font-bold mt-4">
            125 Event
        </p>

    </div>

</div>

<div class="bg-white rounded-2xl shadow p-6 mt-8">

    <h3 class="font-bold text-xl mb-4">

        Ringkasan Bulanan

    </h3>

    <canvas id="reportChart"></canvas>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(
document.getElementById('reportChart'),
{
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei'],
        datasets: [{
            label: 'Donasi',
            data: [5,8,7,10,12]
        }]
    }
});

</script>

@endpush