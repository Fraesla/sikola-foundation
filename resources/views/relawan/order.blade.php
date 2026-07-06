@extends('layouts.relawan',[
    'activePage' => 'order'
])

@section('content')

<div class="rounded-3xl overflow-hidden"
     style="
        background: white;
        box-shadow: var(--shadow);
     ">

    {{-- Header --}}
    <div class="p-8 border-b"
         style="
            background:
            linear-gradient(
                135deg,
                rgba(204,34,34,.08),
                rgba(139,94,42,.08)
            );
         ">

        <h1 class="text-3xl font-bold"
            style="color: var(--color-hitam);">

            📦 Riwayat Order

        </h1>

        <p class="mt-2"
           style="color: var(--color-coklat);">

            Lihat seluruh transaksi merchandise yang pernah Anda lakukan.

        </p>

    </div>

    <div class="space-y-6">
        @forelse($orders as $order)

        <div class="bg-white rounded-[32px]
            overflow-hidden
            transition duration-300
            hover:-translate-y-1"

             style="
                border:1px solid rgba(139,94,42,.12);
                box-shadow:
                    0 10px 40px rgba(139,94,42,.08);
             ">

            {{-- HEADER --}}
            <div class="p-7 border-b"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        rgba(255,255,255,1),
                        rgba(204,34,34,.03),
                        rgba(212,160,23,.04)
                    );
                ">

                <div class="flex flex-col lg:flex-row justify-between lg:items-start gap-6">

                    <div>

                        <div class="flex items-center gap-4 flex-wrap">

                            <h3 class="text-3xl font-bold">
                                #{{ $order->kode_order ?? '-' }}
                            </h3>

                             {{-- STATUS BADGE --}}
                            @php

                                $statusColor = match($order->status){

                                    'menunggu_pembayaran'
                                        => 'bg-amber-50 text-amber-700 border border-amber-200',

                                    'menunggu_konfirmasi'
                                        => 'bg-orange-50 text-orange-700 border border-orange-200',

                                    'dikonfirmasi'
                                        => 'bg-blue-50 text-blue-700 border border-blue-200',

                                    'diproses'
                                        => 'bg-purple-50 text-purple-700 border border-purple-200',

                                    'dikirim'
                                        => 'bg-emerald-50 text-emerald-700 border border-emerald-200',

                                    'selesai'
                                        => 'bg-green-50 text-green-700 border border-green-200',

                                    'dibatalkan'
                                        => 'bg-red-50 text-red-700 border border-red-200',

                                    default
                                        => 'bg-slate-50 text-slate-700 border'
                                };

                            @endphp

                            <span class="px-5 py-2 rounded-full text-sm font-bold {{ $statusColor }}">
                                {{ ucwords(str_replace('_',' ',$order->status)) }}
                            </span>

                        </div>

                        <div class="mt-5 flex flex-wrap gap-6 text-sm text-slate-500">

                            <div>
                                🕒 {{ $order->created_at?->format('d M Y H:i') ?? '-' }}
                            </div>

                            <div>
                                🚚 {{ $order->ekspedisi ?? '-' }}
                            </div>

                            <div>
                                📦 Resi:
                                {{ $order->no_resi ?? '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="text-right">

                        <small class="text-slate-500">
                            Total Pembayaran
                        </small>

                        <div class="text-4xl font-extrabold mt-2"
                             style="color:var(--color-merah);">

                            Rp {{ number_format($order->total_harga,0,',','.') }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- BODY --}}
            <div class="p-6">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                    {{-- PRODUK --}}
                    <div class="lg:col-span-6">

                        @php

                        $produk = $order->items->first();

                        @endphp

                        <div class="flex gap-5 p-6 rounded-[30px]"
                             style="
                                border:1px solid rgba(139,94,42,.08);

                                background:
                                linear-gradient(
                                    135deg,
                                    #fff,
                                    rgba(212,160,23,.03)
                                );

                                box-shadow:
                                    0 10px 25px rgba(0,0,0,.04);
                             ">

                            <img
                                src="@if($produk && isset($produk->merchandise->gambar[0]))
                                    {{ asset('storage/'.$produk->merchandise->gambar[0]) }}
                                @else
                                    https://placehold.co/120x120
                                @endif"

                                class="w-28 h-28 rounded-2xl object-cover shadow-lg hover:scale-105 transition">
                            <div class="flex-1">

                                <h3 class="font-bold text-3xl">
                                    {{ $produk->nama_produk ?? '-' }}
                                </h3>

                                <div class="text-slate-500 text-lg mt-2">
                                    {{ $order->items->count() }} Produk
                                </div>

                                <div class="mt-5 flex gap-3 flex-wrap">

                                    <span class="px-5 py-2 rounded-full bg-slate-100">

                                        {{ $order->ekspedisi ?? '-' }}

                                    </span>

                                    <span class="px-5 py-2 rounded-full bg-blue-50 text-blue-700">

                                        👤 {{ $order->nama_penerima ?? '-' }}

                                    </span>

                                </div>

                                <div class="mt-7">

                                    <small class="text-slate-500">
                                        Total Belanja
                                    </small>

                                    <div class="text-4xl font-extrabold mt-1"
                                         style="color:var(--color-merah);">

                                        Rp {{ number_format($order->total_harga,0,',','.') }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- PENGIRIMAN --}}
                    <div class="lg:col-span-3">

                        <div class="h-full rounded-[30px] p-6"
                             style="
                                background:
                                linear-gradient(
                                    135deg,
                                    rgba(204,34,34,.04),
                                    rgba(139,94,42,.04)
                                );

                                border:1px solid rgba(139,94,42,.08);
                             ">

                            <h3 class="font-bold text-xl mb-6"style="color:var(--color-coklat);">
                                🚚 Informasi Pengiriman
                            </h3>

                            <div class="space-y-5">

                                <div>

                                    <small class="text-slate-500">
                                        Resi
                                    </small>

                                    <div class="font-bold text-lg">
                                        {{ $order->no_resi ?? '-' }}
                                    </div>

                                </div>

                                <hr>

                                <div>

                                    <small class="text-slate-500">
                                        Ekspedisi
                                    </small>

                                    <div class="font-bold text-lg">
                                        {{ $order->ekspedisi ?? '-' }}
                                    </div>

                                </div>

                                <hr>

                                <div>

                                    <small class="text-slate-500">
                                        Penerima
                                    </small>

                                    <div class="font-bold text-lg">
                                        {{ $order->nama_penerima ?? '-' }}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ACTION --}}
                    <div class="lg:col-span-3">

                        <div class="grid gap-4">

                            <a href="{{ route('relawan.orders.show',$order->id) }}"
                               class="w-full py-4 rounded-2xl text-center font-semibold transition"

                               style="
                                    border:2px solid var(--color-coklat);
                                    color:var(--color-coklat);
                                ">

                                📄 Detail Pesanan

                            </a>

                            @if($order->status=='menunggu_pembayaran')

                                <a href="{{ route('relawan.orders.bayar',$order->id) }}"
                                       class="px-6 py-3 rounded-xl
                                              bg-red-600 text-white
                                              font-semibold">

                                        Bayar Sekarang

                                    </a>
                            @endif

                            @if($order->status=='dikirim')

                            <form action="{{ route('relawan.orders.selesai',$order->id) }}"
                                  method="POST">

                                @csrf

                                <button
                                    type="submit"
                                    onclick="return confirm(
                                        'Apakah Anda yakin barang sudah diterima dengan baik?\n\nPesanan akan diselesaikan dan poin akan diberikan.'
                                    )"

                                    class="w-full py-4 rounded-2xl
                                           text-white font-bold
                                           hover:scale-[1.02]
                                           transition"

                                    style="
                                        background:
                                        linear-gradient(
                                            135deg,
                                            #16a34a,
                                            #22c55e
                                        );
                                    ">

                                    ✅ Barang Diterima

                                </button>

                            </form>

                            @endif


                            @if($order->status=='dikirim')

                            <a href="{{ route('relawan.orders.komplain',$order->id) }}"
                               class="w-full py-4 rounded-2xl
                                      text-center font-semibold"

                               style="
                                    background:
                                    linear-gradient(
                                        135deg,
                                        rgba(212,160,23,.15),
                                        rgba(212,160,23,.25)
                                    );

                                    color:#b7791f;
                                ">

                                ⚠ Ajukan Komplain

                            </a>

                            @endif

                            @if($order->status!='selesai' && $order->status!='dibatalkan')

                                <div x-data="{ openBatal:false }">

                                    {{-- Tombol --}}
                                    <button
                                        @click="openBatal = true"
                                        class="w-full py-4 rounded-2xl font-semibold transition"
                                        style="
                                            background: rgba(204,34,34,.06);
                                            border:1px solid rgba(204,34,34,.15);
                                            color: var(--color-merah);
                                        ">

                                        ❌ Batalkan Pesanan

                                    </button>

                                    {{-- Modal --}}
                                    <template x-teleport="body">

                                        <div
                                            x-show="openBatal"
                                            x-cloak
                                            x-transition.opacity
                                            class="fixed inset-0 z-[9999]">

                                            {{-- Backdrop --}}
                                            <div
                                                class="absolute inset-0 bg-black/60 backdrop-blur-sm"
                                                @click="openBatal = false">
                                            </div>

                                            {{-- Box --}}
                                            <div class="absolute inset-0 flex items-center justify-center p-4">

                                                <div
                                                    @click.away="openBatal = false"

                                                    x-transition.scale

                                                    class="bg-white w-full max-w-xl rounded-[32px]
                                                           overflow-hidden shadow-2xl">

                                                    {{-- Header --}}
                                                    <div class="p-8 border-b">

                                                        <h3 class="text-3xl font-bold"
                                                            style="color:var(--color-hitam)">

                                                            Batalkan Pesanan

                                                        </h3>

                                                        <p class="mt-2 text-slate-500">

                                                            Apakah Anda yakin ingin membatalkan pesanan ini?

                                                        </p>

                                                    </div>

                                                    <form
                                                        action="{{ route('relawan.orders.batal',$order->id) }}"
                                                        method="POST">

                                                        @csrf
                                                        @method('PUT')

                                                        <div class="p-8">

                                                            <label class="block font-semibold mb-3">

                                                                Alasan Pembatalan

                                                            </label>

                                                            <textarea
                                                                name="alasan_batal"
                                                                rows="5"
                                                                required

                                                                class="w-full rounded-3xl
                                                                       border border-slate-300
                                                                       p-5 resize-none
                                                                       focus:ring-2
                                                                       focus:ring-red-500"

                                                                placeholder="Contoh: Salah memesan ukuran, ingin mengganti produk, dll"></textarea>

                                                            <div class="mt-5 p-4 rounded-2xl
                                                                        bg-red-50 border border-red-100">

                                                                <div class="text-red-600 text-sm">

                                                                    ⚠ Pesanan yang dibatalkan tidak dapat dipulihkan kembali.

                                                                </div>

                                                            </div>

                                                        </div>

                                                        {{-- Footer --}}
                                                        <div class="p-6 border-t bg-slate-50 flex gap-3">

                                                            <button
                                                                type="button"
                                                                @click="openBatal = false"

                                                                class="flex-1 py-4 rounded-2xl
                                                                       border font-semibold">

                                                                Kembali

                                                            </button>

                                                            <button
                                                                type="submit"

                                                                class="flex-1 py-4 rounded-2xl
                                                                       text-white font-bold"

                                                                style="
                                                                    background:
                                                                    linear-gradient(
                                                                        135deg,
                                                                        var(--color-merah),
                                                                        #dc2626
                                                                    );
                                                                ">

                                                                Ya, Batalkan

                                                            </button>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    </template>
                            </div>
                            @elseif($order->status == 'dibatalkan')
                                        <div class="mt-5 bg-red-50 border border-red-200 rounded-2xl p-4">

                                            <div class="font-semibold text-red-700">
                                                ❌ Pesanan Dibatalkan
                                            </div>

                                            <div class="mt-2 text-slate-600">
                                                <strong>Alasan:</strong>
                                                {{ $order->alasan_batal }}
                                            </div>

                                        </div>

                            @endif

                        </div>

                    </div>


                </div>


                {{-- TIMELINE --}}
                <div class="mt-8 rounded-[28px] p-8"

                     style="
                        background:
                        linear-gradient(
                            135deg,
                            rgba(245,245,245,.8),
                            rgba(255,255,255,1)
                        );

                        border:1px solid rgba(139,94,42,.08);
                     ">

                    @php

                    $step = match($order->status){

                        'menunggu_pembayaran' => 1,
                        'menunggu_konfirmasi' => 2,
                        'dikonfirmasi' => 3,
                        'diproses' => 4,
                        'dikirim' => 5,
                        'selesai' => 6,
                        default => 0

                    };

                    $steps = [

                        'Bayar',
                        'Konfirmasi',
                        'Disetujui',
                        'Diproses',
                        'Dikirim',
                        'Selesai'

                    ];

                    @endphp


                    <div class="relative">

<!--                         <div class="absolute top-5 left-0 right-0
                                    h-1 bg-slate-200"></div> -->

                        <div class="absolute top-8 left-0 h-[6px] rounded-full" 

                             style="
                                background:
                                linear-gradient(
                                    90deg,
                                    var(--color-merah),
                                    var(--color-coklat),
                                    var(--color-kuning)
                                );      

                                width:{{ ($step-1)*20 }}%;
                             ">
                        </div>

                        <div class="grid grid-cols-6 relative z-10">

                            @foreach($steps as $index => $label)

                                <div class="flex flex-col items-center">

                                    <div class="w-16 h-16 rounded-full shadow-lg flex items-center justify-center text-lg font-bold
                                    {{ ($index+1) <= $step
                                        ? 'text-white'
                                        : 'bg-white border'
                                    }}"
                                    @if(($index+1) <= $step)
                                        style="
                                        background:linear-gradient(
                                        135deg,
                                        var(--color-merah),
                                        var(--color-coklat)
                                        );
                                        box-shadow:0 10px 25px rgba(204,34,34,.25);
                                        "
                                    @endif>

                                        @if(($index+1) <= $step)
                                            ✓
                                        @else
                                            {{ $index+1 }}
                                        @endif

                                    </div>

                                    <span class="mt-3 text-sm font-medium">

                                        {{ $label }}

                                    </span>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="mt-5 grid grid-cols-3 gap-3">

                    <div class="rounded-3xl p-6"
                         style="
                            background:
                            linear-gradient(
                                135deg,
                                rgba(255,255,255,1),
                                rgba(212,160,23,.04)
                            );

                            border:1px solid rgba(139,94,42,.08);
                         ">

                        <div class="text-xs text-slate-500">
                            Total Produk
                        </div>

                        <div class="font-bold text-lg">
                            {{ $order->items->sum('kuantitas') }}
                        </div>

                    </div>

                    <div class="rounded-3xl p-6"
                         style="
                            background:
                            linear-gradient(
                                135deg,
                                rgba(255,255,255,1),
                                rgba(212,160,23,.04)
                            );

                            border:1px solid rgba(139,94,42,.08);
                         ">

                        <div class="text-xs text-slate-500">
                            Ongkir
                        </div>

                        <div class="font-bold">

                            Rp {{ number_format($order->ongkos_kirim,0,',','.') }}

                        </div>

                    </div>

                    <div class="rounded-3xl p-6"
                         style="
                            background:
                            linear-gradient(
                                135deg,
                                rgba(255,255,255,1),
                                rgba(212,160,23,.04)
                            );

                            border:1px solid rgba(139,94,42,.08);
                         ">

                        <div class="text-xs text-slate-500">
                            Poin
                        </div>

                        <div class="font-bold">

                            {{ $order->poin_diberikan }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

        @empty
        <div class="bg-white rounded-3xl p-20 text-center">

            <div class="text-8xl mb-6">

                📦

            </div>

            <h3 class="text-3xl font-bold">

                Belum Ada Pesanan

            </h3>

            <p class="mt-3 text-slate-500">

                Anda belum pernah melakukan relawan merchandise.

            </p>

            <a href="{{ route('merchandise') }}"
               class="inline-block mt-8
                      px-8 py-4 rounded-2xl
                      bg-red-600 text-white
                      font-semibold">

                Mulai Belanja

            </a>
        </div>
        @endforelse
    </div>

</div>

@endsection
