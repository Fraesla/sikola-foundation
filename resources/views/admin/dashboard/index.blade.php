@extends('layouts.admin', [
    'activePage' => 'dashboard'
])

@section('content')

<!-- Welcome -->
<div
    class="rounded-3xl p-10 mb-8 overflow-hidden relative"
    style="
        background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );
        color: var(--color-putih);
    ">

    <h1 class="text-4xl mt-3  leading-none font-bold">
        Dashboard Admin
    </h1>

    <p class="mt-3 text-lg  opacity-90">
        Selamat datang di panel administrasi
        Sikola Foundation.
    </p>

</div>

<!-- Statistik -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mt-8">
    <!-- Donasi -->
    <div
        class="rounded-3xl bg-white shadow-md hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between min-h-[180px]"
        style="
            background-color: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"
            style="
                background-color: rgba(204,34,34,.12);
                color: var(--color-merah);
            ">
            💰
        </div>

        <p
            class="mt-5 text-sm font-medium tracking-wide uppercase text-slate-500"
            style="color: var(--color-coklat);">

            Total Donasi

        </p>

        <h2
            class="text-4xl mt-3 leading-none font-bold"
            style="color: var(--color-hitam);">

            Rp {{ number_format($totalDonasi,0,',','.') }}

        </h2>

    </div>

    <!-- Order -->
    <div
        class="rounded-3xl bg-white shadow-md hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between min-h-[180px]"
        style="
            background-color: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"
            style="
                background-color: rgba(212,160,23,.15);
                color: var(--color-kuning);
            ">
            🛍
        </div>

        <p
            class="mt-5 text-sm font-medium tracking-wide uppercase text-slate-500"
            style="color: var(--color-coklat);">

            Total Order

        </p>

        <h2
            class="text-4xl mt-3 leading-none font-bold"
            style="color: var(--color-hitam);">

            {{ number_format($totalOrder) }}

        </h2>

    </div>

    <!-- Relawan -->
    <div
        class="rounded-3xl bg-white shadow-md hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between min-h-[180px]"
        style="
            background-color: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"
            style="
                background-color: rgba(139,94,42,.15);
                color: var(--color-coklat);
            ">
            🤝
        </div>

        <p
            class="mt-5 text-sm font-medium tracking-wide uppercase text-slate-500"
            style="color: var(--color-coklat);">

            Relawan Baru

        </p>

        <h2
            class="text-4xl mt-3 leading-none font-bold"
            style="color: var(--color-hitam);">

            {{ number_format($totalRelawan) }}

        </h2>

    </div>

    <!-- Pending -->
    <div
        class="rounded-3xl bg-white shadow-md hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between min-h-[180px]
"
        style="
            background-color: white;
            box-shadow: var(--shadow);
        ">

        <div
            class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl"
            style="
                background-color: rgba(204,34,34,.12);
                color: var(--color-merah);
            ">
            ⏳
        </div>

        <p
            class="mt-5 text-sm font-medium tracking-wide uppercase text-slate-500"
            style="color: var(--color-coklat);">

            Pending

        </p>

        <h2
            class="text-4xl mt-3 leading-none font-bold"
            style="color: var(--color-merah);">

            {{ number_format($pending) }}

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

    <div class="relative h-96 bg-white rounded-3xl shadow-md p-8mt-8">

        <canvas id="donationChart"></canvas>

    </div>

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

    <div class="grid md:grid-cols-3 gap-5">

        <div
            class="p-5 rounded-2xl border-l-4 bg-red-50 border-red-500"
            style="
                background-color: rgba(204,34,34,.08);
                border-left:4px solid var(--color-merah);
            ">

            💰
            <strong>{{ $pendingDonasi }}</strong>
            Donasi menunggu verifikasi pembayaran.

        </div>

        <div
            class="p-5 rounded-2xl border-l-4 bg-green-50 border-green-500"
            style="
                background-color: rgba(212,160,23,.10);
                border-left:4px solid var(--color-kuning);
            ">

            🤝
            <strong>{{ $pendingRelawan }}</strong>
            Relawan/Event Registrasi menunggu persetujuan admin.

        </div>

        <div
            class="p-5 rounded-2xl border-l-4 bg-yellow-50 border-yellow-500"
            style="
                background-color: rgba(139,94,42,.10);
                border-left:4px solid var(--color-coklat);
            ">

            🛍
            <strong>{{ $pendingOrder }}</strong>
            Order merchandise perlu diproses.

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('donationChart');

new Chart(ctx,{
    type:'bar',

    data:{
        labels:@json($labels),

        datasets:[{

            label:'Total Donasi',

            data:@json($data),

            borderRadius:10,

            backgroundColor:'#CC2222',

            maxBarThickness:35

        }]
    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{
            legend:{
                display:false
            }
        },

        scales:{
            y:{
                beginAtZero:true
            }
        }

    }

});

</script>
@endpush