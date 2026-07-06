@extends('layouts.relawan',[
    'activePage' => 'order'
])

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="rounded-[32px] p-8"

         style="
            background:
            linear-gradient(
                135deg,
                rgba(204,34,34,.05),
                rgba(139,94,42,.05)
            );

            border:1px solid rgba(139,94,42,.1);
            box-shadow:0 10px 40px rgba(139,94,42,.08);
         ">

        <div class="flex flex-col lg:flex-row
                    justify-between lg:items-center gap-6">

            <div>

                <h1 class="text-4xl font-bold"
                    style="color:var(--color-hitam)">

                    Detail Pesanan

                </h1>

                <div class="mt-3 text-slate-500">

                    Invoice :

                    <span class="font-bold">

                        {{ $order->kode_order ?? '-' }}

                    </span>

                </div>

                <div class="mt-2 text-slate-500">

                    Tanggal :

                    {{ $order->created_at->format('d M Y H:i') }}

                </div>

            </div>

            @php

                $statusColor = match($order->status){

                    'menunggu_pembayaran'
                        => 'background:#fff7e6;color:#d97706;',

                    'menunggu_konfirmasi'
                        => 'background:#fff3e0;color:#ea580c;',

                    'dikonfirmasi'
                        => 'background:#eff6ff;color:#2563eb;',

                    'diproses'
                        => 'background:#eef2ff;color:#4338ca;',

                    'dikirim'
                        => 'background:#ecfdf5;color:#16a34a;',

                    'selesai'
                        => 'background:#dcfce7;color:#15803d;',

                    'dibatalkan'
                        => 'background:#fef2f2;color:#dc2626;',

                    default => ''
                };

            @endphp

            <a href="{{ url('donatur/orders') }}"
               class="px-6 py-3 rounded-2xl bg-white shadow">

                ← Kembali

            </a>

            <span
                class="px-6 py-3 rounded-full
                       font-bold text-lg"

                style="{{ $statusColor }}">

                {{ ucwords(str_replace('_',' ',$order->status)) }}

            </span>

        </div>

    </div>


    {{-- CONTENT --}}
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- PRODUK --}}
        <div class="lg:col-span-2">

            <div class="bg-white rounded-[32px] p-8"

                 style="
                    border:1px solid rgba(139,94,42,.1);
                    box-shadow:0 8px 30px rgba(139,94,42,.05);
                 ">

                <h3 class="text-2xl font-bold mb-6">

                    Produk Dipesan

                </h3>

                <div class="space-y-6">

                    @foreach($order->items as $item)

                    <div class="flex gap-5 pb-6 border-b">

                        <img

                            src="@if(isset($item->merchandise->gambar[0]))
                                    {{ asset('storage/'.$item->merchandise->gambar[0]) }}
                                  @else
                                    https://placehold.co/100x100
                                  @endif"

                            class="w-24 h-24 rounded-2xl object-cover">

                        <div class="flex-1">

                            <h4 class="font-bold text-xl">

                                {{ $item->nama_produk }}

                            </h4>

                            <div class="text-slate-500 mt-2">

                                Qty : {{ $item->kuantitas }}

                            </div>

                            <div class="text-slate-500">

                                Harga :

                                Rp {{ number_format($item->harga_satuan,0,',','.') }}

                            </div>

                        </div>

                        <div class="font-bold text-xl">

                            Rp {{ number_format($item->subtotal,0,',','.') }}

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>


            {{-- PENGIRIMAN --}}
            <div class="bg-white rounded-[32px] p-8 mt-6"

                 style="
                    border:1px solid rgba(139,94,42,.1);
                    box-shadow:0 8px 30px rgba(139,94,42,.05);
                 ">

                <h3 class="text-2xl font-bold mb-6">

                    Informasi Pengiriman

                </h3>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <small class="text-slate-500">

                            Nama Penerima

                        </small>

                        <div class="font-semibold">

                            {{ $order->nama_penerima ?? '-' }}

                        </div>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            No Telepon

                        </small>

                        <div class="font-semibold">

                            {{ $order->no_telp_penerima ?? '-' }}

                        </div>

                    </div>

                    <div class="md:col-span-2">

                        <small class="text-slate-500">

                            Alamat

                        </small>

                        <div class="font-semibold">

                            {{ $order->alamat_pengiriman ?? '-' }}

                        </div>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Ekspedisi

                        </small>

                        <div class="font-semibold">

                            {{ $order->ekspedisi ?? '-' }}

                        </div>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            No Resi

                        </small>

                        <div class="font-semibold">

                            {{ $order->no_resi ?? '-' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- SIDEBAR --}}
        <div>

            <div class="bg-white rounded-[32px] p-8"

                 style="
                    border:1px solid rgba(139,94,42,.1);
                    box-shadow:0 8px 30px rgba(139,94,42,.05);
                 ">

                <h3 class="text-2xl font-bold mb-6">

                    Ringkasan Pembayaran

                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between">

                        <span>Subtotal</span>

                        <span>

                            Rp {{ number_format($order->total_harga - $order->ongkos_kirim,0,',','.') }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span>Ongkir</span>

                        <span>

                            Rp {{ number_format($order->ongkos_kirim,0,',','.') }}

                        </span>

                    </div>

                    <hr>

                    <div class="flex justify-between
                                text-xl font-bold">

                        <span>Total</span>

                        <span style="color:var(--color-merah)">

                            Rp {{ number_format($order->total_harga,0,',','.') }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- CATATAN --}}
            @if($order->catatan)

            <div class="bg-white rounded-[32px] p-8 mt-6">

                <h3 class="font-bold text-xl mb-3">

                    Catatan

                </h3>

                <div class="text-slate-600">

                    {{ $order->catatan }}

                </div>

            </div>

            @endif


            {{-- ALASAN BATAL --}}
            @if($order->status == 'dibatalkan')

            <div class="rounded-[32px] p-8 mt-6"

                 style="
                    background:#fef2f2;
                    border:1px solid #fecaca;
                 ">

                <h3 class="font-bold text-red-700">

                    Pesanan Dibatalkan

                </h3>

                <div class="mt-3 text-red-600">

                    {{ $order->alasan_batal ?? '-' }}

                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection