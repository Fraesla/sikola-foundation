@extends('layouts.admin', [
    'activePage' => 'laporan'
])

@section('content')

<!-- HEADER -->
<div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

    <div>

        <span
            class="uppercase tracking-[4px] text-xs font-semibold"
            style="color: var(--color-kuning);">

            REPORT CENTER

        </span>

        <h1
            class="text-4xl font-bold mt-2"
            style="color: var(--color-hitam);">

            Laporan Sistem

        </h1>

        <p
            class="mt-2"
            style="color: var(--color-coklat);">

            Rekap seluruh aktivitas yayasan, donasi,
            merchandise dan relawan.

        </p>

    </div>

    <div class="flex gap-3">

        <button
            class="px-5 py-3 rounded-xl font-semibold transition hover:opacity-90"
            style="
                background-color: var(--color-kuning);
                color: var(--color-hitam);
            ">

            📊 Export Excel

        </button>

        <button
            class="px-5 py-3 rounded-xl font-semibold transition hover:opacity-90"
            style="
                background-color: var(--color-merah);
                color: var(--color-putih);
            ">

            📄 Export PDF

        </button>

    </div>

</div>

<!-- SUMMARY -->
<div class="grid md:grid-cols-3 gap-6">

    <div
        class="rounded-3xl p-6"
        style="
            background-color: white;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--color-kuning);
        ">

        <p style="color: var(--color-coklat);">
            Total Donasi
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            Rp 75 Juta

        </h2>

    </div>

    <div
        class="rounded-3xl p-6"
        style="
            background-color: white;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--color-merah);
        ">

        <p style="color: var(--color-coklat);">
            Penjualan Merchandise
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            Rp 25 Juta

        </h2>

    </div>

    <div
        class="rounded-3xl p-6"
        style="
            background-color: white;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--color-coklat);
        ">

        <p style="color: var(--color-coklat);">
            Aktivitas Relawan
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            125 Event

        </h2>

    </div>

</div>

<!-- CHART -->
<div
    class="rounded-3xl p-8 mt-8"
    style="
        background-color: white;
        box-shadow: var(--shadow);
    ">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h3
                class="text-2xl font-bold"
                style="color: var(--color-hitam);">

                Ringkasan Bulanan

            </h3>

            <p
                class="mt-1"
                style="color: var(--color-coklat);">

                Grafik perkembangan donasi per bulan

            </p>

        </div>

    </div>

    <canvas id="reportChart" height="100"></canvas>

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
            labels: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei'
            ],
            datasets: [{
                label: 'Donasi (Juta)',
                data: [5,8,7,10,12],
                backgroundColor: '#CC2222',
                borderRadius: 10
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    }
);

</script>

@endpush