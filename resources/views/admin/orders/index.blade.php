@extends('layouts.admin',[
    'activePage' => 'order'
])

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold"
            style="color:var(--color-hitam);">

            Order Management

        </h1>

        <p class="mt-2"
           style="color:var(--color-coklat);">

            Kelola pesanan, pembayaran dan pengiriman.

        </p>

    </div>

    <a href="{{ url()->previous() }}"
        class="px-6 py-3 rounded-2xl bg-white shadow">
            ← Kembali
    </a>

</div>


{{-- STATISTIK --}}
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="card-admin p-6">

        <p class="admin-muted">
            Total Order
        </p>

        <h2 class="text-4xl font-bold mt-2"
            style="color:var(--color-merah);">

            {{ $totalOrder }}

        </h2>

    </div>

    <div class="card-admin p-6">

        <p class="admin-muted">
            Menunggu Konfirmasi
        </p>

        <h2 class="text-4xl font-bold mt-2 text-yellow-500">

            {{ $orderBaru }}

        </h2>

    </div>

    <div class="card-admin p-6">

        <p class="admin-muted">
            Diproses
        </p>

        <h2 class="text-4xl font-bold mt-2 text-blue-600">

            {{ $orderDiproses }}

        </h2>

    </div>

    <div class="card-admin p-6">

        <p class="admin-muted">
            Selesai
        </p>

        <h2 class="text-4xl font-bold mt-2 text-green-600">

            {{ $orderSelesai }}

        </h2>

    </div>

</div>


{{-- FILTER --}}
<form class="card-admin p-5 mb-6">

    <div class="flex flex-col lg:flex-row gap-4 justify-between">

        <div class="flex gap-3">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari kode order / nama penerima..."
                   class="w-80 rounded-xl border px-4 py-3">

            <button class="btn-primary">

                Cari

            </button>

        </div>

        <div class="flex gap-3">

            <select name="status"
                    onchange="this.form.submit()"
                    class="rounded-xl border px-4 py-3">

                <option value="">
                    Semua Status
                </option>

                <option value="menunggu_pembayaran">
                    Menunggu Pembayaran
                </option>

                <option value="menunggu_konfirmasi">
                    Menunggu Konfirmasi
                </option>

                <option value="diproses">
                    Diproses
                </option>

                <option value="dikirim">
                    Dikirim
                </option>

                <option value="selesai">
                    Selesai
                </option>

                <option value="dibatalkan">
                    Dibatalkan
                </option>

            </select>

            <select name="sort"
                    onchange="this.form.submit()"
                    class="rounded-xl border px-4 py-3">

                <option value="latest">
                    Terbaru
                </option>

                <option value="oldest">
                    Terlama
                </option>

            </select>

        </div>

    </div>

</form>

        
{{-- TABEL --}}
<div class="card-admin rounded-[32px] overflow-hidden">
    <div class="bg-white rounded-[32px]
                border border-slate-100
                shadow-[0_10px_40px_rgba(0,0,0,0.06)]
                hover:shadow-[0_20px_60px_rgba(0,0,0,0.10)]
                transition-all duration-300
                p-6 md:p-8">

        {{-- Header --}}
        <div class="p-8 border-b border-slate-100">
            <h2 class="text-3xl font-bold">
                Daftar Order
            </h2>

            <p class="text-slate-500 mt-2">
                Kelola semua pesanan customer.
            </p>
        </div>


        <div class="p-6 space-y-6">

            @forelse($orders as $order)

            <div class="bg-white rounded-[30px]
                        border border-slate-100
                        shadow-sm hover:shadow-2xl
                        transition duration-300 p-7">

                <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">

                    {{-- ================= LEFT PANEL ================= --}}
                    <div class="xl:col-span-8 space-y-6">

                        {{-- CUSTOMER + ORDER --}}
                        <div class="bg-slate-50 rounded-3xl p-6">

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- CUSTOMER --}}
                    <div class="flex flex-col sm:flex-row items-center gap-4">

                        <img src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_penerima) }}"
                             class="w-20 h-20 rounded-full shadow-lg shrink-0">

                        <div class="text-center sm:text-left">

                            <h3 class="font-bold text-2xl">
                                {{ $order->nama_penerima }}
                            </h3>

                            <div class="text-slate-500">
                                {{ $order->no_telp_penerima }}
                            </div>

                            <span class="inline-block mt-2 px-3 py-1
                                         rounded-full bg-blue-100
                                         text-blue-700 text-sm">
                                Member
                            </span>

                        </div>

                    </div>


                    {{-- ORDER --}}
                    <div class="flex-1 min-w-0 text-center lg:text-right">

                        <small class="text-slate-500 block">
                            Nomor Order
                        </small>

                        <h3 class="font-bold
                                   text-lg sm:text-xl xl:text-2xl
                                   mt-2 leading-tight break-words">

                            {{ $order->kode_order }}

                        </h3>

                        <div class="text-sm text-slate-500 mt-3">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </div>

                    </div>


                    {{-- TOTAL --}}
                    <div class="flex-1 min-w-0 text-center lg:text-right">

                        <small class="text-slate-500 block">
                            Total Belanja
                        </small>

                        <div class="font-bold text-red-600
                                    text-2xl sm:text-3xl xl:text-4xl
                                    mt-2">

                            Rp {{ number_format($order->total_harga,0,',','.') }}

                        </div>

                    </div>

                </div>
        </div>


        {{-- ALAMAT --}}
        <div class="bg-slate-50 rounded-3xl p-6">

            <div class="font-semibold mb-3">
                📍 Alamat Pengiriman
            </div>

            <div class="text-slate-700 leading-7">

                {{ $order->alamat_pengiriman }}

            </div>

            <div class="mt-2 text-slate-500">

                {{ $order->kota }},
                {{ $order->provinsi }}

            </div>

        </div>

    </div>



    {{-- ================= RIGHT PANEL ================= --}}
    <div class="xl:col-span-4 space-y-5">

        {{-- STATUS --}}
        <div class="bg-slate-50 rounded-3xl p-6">

            <small class="text-slate-500">
                Status Pesanan
            </small>

            <div class="mt-3">

                <span class="px-5 py-2 rounded-full
                @if($order->status=='menunggu_konfirmasi')
                    bg-yellow-100 text-yellow-700
                @elseif($order->status=='dikonfirmasi')
                    bg-blue-100 text-blue-700
                @elseif($order->status=='diproses')
                    bg-indigo-100 text-indigo-700
                @elseif($order->status=='dikirim')
                    bg-green-100 text-green-700
                @elseif($order->status=='selesai')
                    bg-emerald-100 text-emerald-700
                @endif">

                    {{ ucwords(str_replace('_',' ',$order->status)) }}

                </span>

            </div>

        </div>

        {{-- ACTION BUTTON --}}
        <div class="bg-slate-50 rounded-3xl p-5 space-y-3">

            {{-- tombol yang sudah ada --}}
            {{-- DETAIL --}}
                                <a href="{{ route('admin.orders.show',$order->id) }}"
                                   class="block w-full text-center
                                          px-5 py-3 rounded-2xl
                                          bg-gradient-to-r
                                          from-red-600 to-amber-700
                                          text-white font-semibold
                                          shadow-lg hover:shadow-xl
                                          hover:scale-[1.02] transition">

                                    Detail Order

                                </a>


                                {{-- VERIFIKASI PEMBAYARAN --}}
                                @if($order->status == 'menunggu_konfirmasi')

                                    <form action="{{ route('admin.orders.konfirmasi',$order->id) }}"
                                          method="POST">

                                        @csrf

                                        <button
                                            class="w-full px-5 py-3 rounded-2xl
                                                   bg-green-100 text-green-700
                                                   font-semibold hover:bg-green-200">

                                            ✓ Verifikasi Pembayaran

                                        </button>

                                    </form>

                                @endif


                                {{-- PROSES ORDER --}}
                                @if($order->status == 'dikonfirmasi')

                                    <form action="{{ route('admin.orders.proses',$order->id) }}"
                                          method="POST">

                                        @csrf

                                        <button
                                            class="w-full px-5 py-3 rounded-2xl
                                                   bg-yellow-100 text-yellow-700
                                                   font-semibold hover:bg-yellow-200">

                                            ⚙️ Proses Order

                                        </button>

                                    </form>

                                @endif


                                {{-- INPUT RESI --}}
                                @if($order->status == 'diproses')

                                    <a href="{{ route('admin.orders.edit',$order->id) }}"
                                       class="block w-full text-center
                                              px-5 py-3 rounded-2xl
                                              bg-indigo-100 text-indigo-700
                                              font-semibold hover:bg-indigo-200">

                                        🚚 Input Resi

                                    </a>

                                @endif


                                {{-- SUDAH DIKIRIM --}}
                                @if($order->status == 'dikirim')

                                    <div
                                        class="w-full text-center
                                               px-5 py-3 rounded-2xl
                                               bg-green-100 text-green-700
                                               font-semibold">

                                        📦 Sudah Dikirim

                                    </div>

                                @endif          
        </div>

        {{-- DETAIL PRODUK --}}
        <div class="bg-slate-50 rounded-3xl p-5">

            {{-- accordion produk --}}

            <div x-data="{ detail:false }" class="mt-6">

                            <button
                                @click="detail = !detail"
                                type="button"
                                class="w-full flex items-center justify-center gap-2
                                       px-4 py-3 rounded-2xl
                                       bg-slate-50 hover:bg-slate-100
                                       border border-slate-200
                                       text-blue-600 font-semibold
                                       transition">

                                <svg x-show="!detail"
                                     xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>

                                </svg>

                                <svg x-show="detail"
                                     xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5 15l7-7 7 7"/>

                                </svg>

                                <span x-text="detail ? 'Sembunyikan Detail Produk' : 'Lihat Detail Produk'"></span>

                            </button>

                            <div
                                x-show="detail"
                                x-transition.duration.300ms
                                class="mt-6 space-y-4">

                                {{-- isi produk --}}

                                @foreach($order->items as $item) 
                                    <div
                                        class="bg-gradient-to-r from-slate-50 to-white
                                               border border-slate-100 rounded-3xl p-4
                                               hover:shadow-lg transition">

                                        <div class="flex flex-col gap-4">

                                            {{-- BARIS ATAS --}}
                                            <div class="flex items-center gap-4">

                                                <img
                                                    src="{{ asset('storage/' . ($item->merchandise->gambar[0] ?? 'default.jpg')) }}"
                                                    class="w-20 h-20 rounded-2xl object-cover shadow shrink-0">

                                                <div class="flex-1 min-w-0">

                                                    <h4 class="font-bold text-lg break-words">
                                                        {{ $item->nama_produk }}
                                                    </h4>

                                                    <div class="flex flex-wrap gap-2 mt-2">

                                                        <span
                                                            class="px-3 py-1 rounded-full
                                                                   bg-blue-50 text-blue-700 text-sm">
                                                            Qty {{ $item->quantity }}
                                                        </span>

                                                        <span
                                                            class="px-3 py-1 rounded-full
                                                                   bg-orange-50 text-orange-700 text-sm">
                                                            Merchandise
                                                        </span>

                                                    </div>

                                                </div>

                                            </div>

                                            {{-- BARIS BAWAH --}}
                                            <div
                                                class="border-t pt-3
                                                       flex items-center justify-between">

                                                <small class="text-slate-500">
                                                    Subtotal
                                                </small>

                                                <div
                                                    class="text-xl font-bold text-red-600
                                                           break-all">

                                                    Rp {{ number_format($item->subtotal,0,',','.') }}

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>
        </div>

    </div>

</div>

                @php

                $percent = match($order->status){
                    'menunggu_pembayaran' => 10,
                    'menunggu_konfirmasi' => 25,
                    'dikonfirmasi' => 50,
                    'diproses' => 70,
                    'dikirim' => 90,
                    'selesai' => 100,
                    default => 0
                };

                @endphp


                <div class="mt-8">

                    <div class="flex justify-between mb-2">

                        <span class="font-semibold">

                            Progress Pesanan

                        </span>

                        <span>

                            {{ $percent }}%

                        </span>

                    </div>

                    <div class="relative">

                        <div class="h-4 bg-slate-100 rounded-full overflow-hidden">

                            <div class="h-full rounded-full
                                        bg-gradient-to-r
                                        from-red-500 via-orange-500 to-amber-500
                                        transition-all duration-1000"

                                 style="width:{{ $percent }}%">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- SHIPPING PROGRESS --}}
                <div class="mt-10">

                    <div class="relative">

                        {{-- GARIS --}}
                        <div class="absolute top-7 left-0 right-0 h-1
                                    bg-slate-200 rounded-full"></div>

                        <div class="absolute top-7 left-0 h-1
                                    rounded-full
                                    bg-gradient-to-r
                                    from-green-500 to-emerald-500"

                             style="width:
                             @if($order->status=='menunggu_konfirmasi')20%
                             @elseif($order->status=='dikonfirmasi')40%
                             @elseif($order->status=='diproses')50%
                             @elseif($order->status=='dikirim')80%
                             @elseif($order->status=='selesai')100%
                             @else 10%
                             @endif">

                        </div>

                        <div class="grid grid-cols-5 relative z-10 gap-4">

                            @php
                            $steps = [
                                ['icon'=>'💳','label'=>'Dibayar'],
                                ['icon'=>'✔','label'=>'Konfirmasi'],
                                ['icon'=>'🔄','label'=>'Proses'],
                                ['icon'=>'🚚','label'=>'Dikirim'],
                                ['icon'=>'🎉','label'=>'Selesai'],
                            ];
                            @endphp

                            @foreach($steps as $index=>$step)

                            @php

                            $currentStep = match($order->status){
                                'menunggu_konfirmasi' => 1,
                                'dikonfirmasi' => 2,
                                'diproses' => 3,
                                'dikirim' => 4,
                                'selesai' => 5,
                                default => 0
                            };

                            $isDone = ($index + 1) <= $currentStep;

                            @endphp

                            <div class="flex flex-col items-center">

                                <div class="w-14 h-14 rounded-full
                                            flex items-center justify-center
                                            text-xl font-bold shadow-lg transition

                                            {{ $isDone
                                                ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white'
                                                : 'bg-white border-2 border-slate-300 text-slate-400'
                                            }}">

                                    {{ $step['icon'] }}

                                </div>

                                <span class="mt-3 text-sm font-semibold text-center">

                                    {{ $step['label'] }}

                                </span>

                            </div>
                            @endforeach

                        </div>

                    </div>

                </div>

                {{-- MINI STATISTIK --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-10">

                    <div class="bg-gradient-to-br
                                from-slate-50 to-white
                                border border-slate-100
                                rounded-3xl p-5 shadow-sm">

                        <div class="flex justify-between items-center">

                            <div>

                                <small class="text-slate-500">
                                    Total Harga
                                </small>

                                <div class="text-2xl font-bold mt-2">

                                    Rp {{ number_format($order->total_harga,0,',','.') }}

                                </div>

                            </div>

                            <div class="w-14 h-14 rounded-2xl
                                        bg-blue-100
                                        flex items-center justify-center
                                        text-2xl">

                                💰

                            </div>

                        </div>

                    </div>

                    <div class="bg-gradient-to-br
                                from-slate-50 to-white
                                border border-slate-100
                                rounded-3xl p-5 shadow-sm">

                        <div class="flex justify-between items-center">

                            <div>

                                <small class="text-slate-500">
                                    Ongkir
                                </small>

                                <div class="text-2xl font-bold mt-2">

                                    Rp {{ number_format($order->ongkos_kirim,0,',','.') }}

                                </div>

                            </div>

                            <div class="w-14 h-14 rounded-2xl
                                    bg-yellow-100
                                    flex items-center justify-center text-2xl">
                                🚚
                             </div>

                        </div>

                    </div>

                    <div class="bg-gradient-to-r
                                from-red-500 to-orange-500
                                text-white rounded-3xl p-5 shadow-lg">

                        <div class="flex justify-between items-center">

                            <div>

                                <small class="opacity-80">
                                    Total Bayar
                                </small>

                                <div class="text-3xl font-bold mt-2">

                                    Rp {{ number_format($order->total_harga + $order->ongkos_kirim,0,',','.') }}

                                </div>

                            </div>

                            <div class="text-4xl">
                                🧾
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @empty

            <div class="text-center py-20">

                <div class="text-7xl mb-5">
                    📦
                </div>

                <h3 class="text-2xl font-bold">
                    Belum Ada Pesanan
                </h3>

            </div>

            @endforelse

        </div>


        <div class="p-8 border-t">
            {{ $orders->links() }}
        </div>

    </div>
</div>
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/csp/dist/cdn.min.js"></script>

@endsection