@extends('layouts.admin',[
    'activePage' => 'order'
])

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold">
                Detail Order
            </h1>

            <p class="text-slate-500 mt-2">
                {{ $order->kode_order }}
            </p>

        </div>

        <a href="{{ url()->previous() }}"
           class="px-6 py-3 rounded-2xl bg-white shadow">

            ← Kembali

        </a>

    </div>



    <div class="grid lg:grid-cols-3 gap-8">

        {{-- KIRI --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- CUSTOMER --}}
            <div class="card-admin p-8 rounded-3xl">

                <h3 class="text-2xl font-bold mb-6">
                    👤 Informasi Customer
                </h3>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <small class="text-slate-500">
                            Nama Penerima
                        </small>

                        <h4 class="font-semibold text-lg">
                            {{ $order->nama_penerima }}
                        </h4>
                    </div>

                    <div>
                        <small class="text-slate-500">
                            No Telepon
                        </small>

                        <h4 class="font-semibold text-lg">
                            {{ $order->no_telp_penerima }}
                        </h4>
                    </div>

                    <div class="md:col-span-2">
                        <small class="text-slate-500">
                            Alamat
                        </small>

                        <p class="font-medium">
                            {{ $order->alamat_pengiriman }},
                            {{ $order->kota }},
                            {{ $order->provinsi }},
                            {{ $order->kode_pos }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- PRODUK --}}
            <div class="card-admin p-8 rounded-3xl">

                <h3 class="text-2xl font-bold mb-6">
                    📦 Produk Pesanan
                </h3>

                <div class="space-y-5">

                    @foreach($order->items as $item)

                    <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50">

                        <div class="flex gap-5">

                            <img
                                src="{{ asset('storage/'.$item->merchandise->gambar[0]) }}"
                                class="w-24 h-24 rounded-2xl object-cover">

                            <div>

                                <h4 class="font-bold text-lg">
                                    {{ $item->nama_produk }}
                                </h4>

                                <p class="text-slate-500">
                                    Qty : {{ $item->quantity }}
                                </p>

                                <p class="text-slate-500">
                                    Harga :
                                    Rp {{ number_format($item->harga_satuan,0,',','.') }}
                                </p>

                            </div>

                        </div>

                        <div class="text-right">

                            <div class="font-bold text-xl text-red-600">

                                Rp {{ number_format($item->subtotal,0,',','.') }}

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>


            {{-- BUKTI TRANSFER --}}
            <div class="card-admin p-8 rounded-3xl">

                <h3 class="text-2xl font-bold mb-6">
                    💳 Bukti Pembayaran
                </h3>

                @if($order->bukti_pembayaran)

                    <img
                        src="{{ asset('storage/'.$order->bukti_pembayaran) }}"
                        class="w-full rounded-3xl border">

                @else

                    <div class="text-center py-16">

                        <div class="text-6xl mb-4">
                            🧾
                        </div>

                        <h4 class="font-bold">
                            Belum Ada Bukti Pembayaran
                        </h4>

                    </div>

                @endif

            </div>

        </div>



        {{-- KANAN --}}
        <div class="space-y-8">

            {{-- STATUS --}}
            <div class="card-admin p-8 rounded-3xl">

                <h3 class="text-xl font-bold mb-6">
                    Status Pesanan
                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between">
                        <span>Status</span>

                        <span class="font-bold">

                            {{ ucfirst(str_replace('_',' ',$order->status)) }}

                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Total</span>

                        <span class="font-bold text-red-600">

                            Rp {{ number_format($order->total_harga,0,',','.') }}

                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Ongkir</span>

                        <span>

                            Rp {{ number_format($order->ongkos_kirim,0,',','.') }}

                        </span>
                    </div>

                </div>

            </div>


            {{-- PENGIRIMAN --}}
            <div class="card-admin p-8 rounded-3xl">

                <h3 class="text-xl font-bold mb-6">
                    🚚 Informasi Pengiriman
                </h3>

                <div class="space-y-4">

                    <div>
                        <small class="text-slate-500">
                            Ekspedisi
                        </small>

                        <h4 class="font-semibold">
                            {{ $order->ekspedisi ?? '-' }}
                        </h4>
                    </div>

                    <div>
                        <small class="text-slate-500">
                            No Resi
                        </small>

                        <h4 class="font-semibold">
                            {{ $order->no_resi ?? '-' }}
                        </h4>
                    </div>

                </div>

            </div>


            {{-- TIMELINE --}}
            <div class="card-admin p-8 rounded-3xl">

                <h3 class="font-bold text-xl mb-6">
                    Timeline
                </h3>

                <div class="space-y-5">

                    <div>✅ Order Dibuat</div>

                    @if($order->status != 'menunggu_pembayaran')
                        <div>✅ Pembayaran Diterima</div>
                    @endif

                    @if(in_array($order->status,['diproses','dikirim','selesai']))
                        <div>🚚 Sedang Diproses</div>
                    @endif

                    @if(in_array($order->status,['dikirim','selesai']))
                        <div>📦 Pesanan Dikirim</div>
                    @endif

                    @if($order->status == 'selesai')
                        <div>🎉 Pesanan Selesai</div>
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection