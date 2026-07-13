@extends('layouts.admin', [
    'activePage' => 'merchandise'
])

@section('content')

<div class="max-w-7xl mx-auto pb-16">
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold">Detail Order</h1>
            <p class="text-slate-500 mt-2">{{ $order->kode_order }}</p>
        </div>
        <a href="{{ url()->previous() }}" class="px-6 py-3 rounded-2xl bg-white shadow hover:bg-slate-50 transition">← Kembali</a>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        {{-- KIRI --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- CUSTOMER INFO --}}
            <div class="card-admin p-8 rounded-3xl">
                <h3 class="text-2xl font-bold mb-6">👤 Informasi Customer</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <small class="text-slate-500">Nama Penerima</small>
                        <h4 class="font-semibold text-lg">{{ $order->nama_penerima }}</h4>
                    </div>
                    <div>
                        <small class="text-slate-500">No Telepon</small>
                        <h4 class="font-semibold text-lg">{{ $order->no_telp_penerima }}</h4>
                    </div>
                    <div class="md:col-span-2">
                        <small class="text-slate-500">Alamat</small>
                        <p class="font-medium">{{ $order->alamat_pengiriman }}, {{ $order->kota }}, {{ $order->provinsi }}, {{ $order->kode_pos }}</p>
                    </div>
                </div>
            </div>

            {{-- BUKTI PEMBAYARAN (Conditional) --}}
            @if($order->bukti_pembayaran)
            <div class="card-admin p-8 rounded-3xl">
                <h3 class="text-2xl font-bold mb-6">💳 Bukti Pembayaran</h3>
                <img src="{{ asset('storage/'.$order->bukti_pembayaran) }}" class="w-full rounded-3xl border shadow-sm cursor-pointer" onclick="window.open(this.src)">
            </div>
            @endif

            {{-- PRODUK --}}
            <div class="card-admin p-8 rounded-3xl">
                <h3 class="text-2xl font-bold mb-6">📦 Produk Pesanan</h3>
                <div class="space-y-5">
                    @foreach($order->items as $item)
                    <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50">
                        <div class="flex gap-5">
                            <img src="{{ asset('storage/'.$item->merchandise->gambar[0]) }}" class="w-20 h-20 rounded-2xl object-cover">
                            <div>
                                <h4 class="font-bold text-lg">{{ $item->nama_produk }}</h4>
                                <p class="text-slate-500">Qty : {{ $item->quantity }} | Rp {{ number_format($item->harga_satuan,0,',','.') }}</p>
                            </div>
                        </div>
                        <div class="font-bold text-xl text-red-600">Rp {{ number_format($item->subtotal,0,',','.') }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- KANAN --}}
        <div class="space-y-8">
            {{-- STATUS DENGAN LOGIKA DINAMIS --}}
            <div class="card-admin p-8 rounded-3xl">
                @php
                    $statusColor = 'bg-slate-100 text-slate-800 border-slate-200';
                    $statusText = ucwords(str_replace('_', ' ', $order->status));

                    if ($order->status == 'selesai') {
                        if ($order->dikonfirmasi_oleh) {
                            $statusColor = 'bg-rose-100 text-rose-800 border-rose-200';
                            $statusText = 'Selesai (Refund)';
                        } elseif (!$order->bukti_pembayaran) {
                            $statusColor = 'bg-gray-100 text-gray-800 border-gray-200';
                            $statusText = 'Selesai (Dibatalkan)';
                        } else {
                            $statusColor = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                            $statusText = 'Selesai (Pengiriman)';
                        }
                    } else {
                        $statusColor = match($order->status) {
                            'menunggu_pembayaran' => 'bg-amber-100 text-amber-800 border-amber-200',
                            'menunggu_konfirmasi' => 'bg-orange-100 text-orange-800 border-orange-200',
                            'dikonfirmasi'        => 'bg-blue-100 text-blue-800 border-blue-200',
                            'diproses'            => 'bg-purple-100 text-purple-800 border-purple-200',
                            'dikirim'             => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                            'dibatalkan'          => 'bg-red-100 text-red-800 border-red-200',
                            default               => 'bg-slate-100 text-slate-800 border-slate-200'
                        };
                    }
                @endphp
                
                <h3 class="text-xl font-bold mb-6">Status Pesanan</h3>
                <span class="px-4 py-2 rounded-full text-sm font-extrabold uppercase border {{ $statusColor }}">
                    {{ $statusText }}
                </span>
                
                <div class="space-y-4 mt-6 border-t pt-6">
                    <div class="flex justify-between"><span>Total</span><span class="font-bold text-red-600">Rp {{ number_format($order->total_harga,0,',','.') }}</span></div>
                    <div class="flex justify-between"><span>Ongkir</span><span>Rp {{ number_format($order->ongkos_kirim,0,',','.') }}</span></div>
                </div>
            </div>

            {{-- PENGIRIMAN & TIMELINE --}}
            <div class="card-admin p-8 rounded-3xl">
                <h3 class="text-xl font-bold mb-6">🚚 Informasi Pengiriman</h3>
                <div class="space-y-4">
                    <div><small class="text-slate-500">Ekspedisi</small><h4 class="font-semibold">{{ $order->ekspedisi ?? '-' }}</h4></div>
                    <div><small class="text-slate-500">No Resi</small><h4 class="font-semibold">{{ $order->no_resi ?? '-' }}</h4></div>
                </div>
            </div>
            {{-- ALASAN PEMBATALAN (Conditional) --}}
            @if($order->alasan_batal)
            <div class="p-6 rounded-[2rem] border border-red-100 bg-red-50 flex items-start gap-4">
                <div class="text-2xl">⚠️</div>
                <div>
                    <h4 class="text-[10px] font-extrabold uppercase tracking-widest text-red-600 mb-1">Catatan Pembatalan</h4>
                    <p class="text-sm font-semibold text-red-900 italic">"{{ $order->alasan_batal }}"</p>
                </div>
            </div>
            @endif
            {{-- BUKTI REFUND (Conditional) --}}
            @if($order->bukti_refund)
            <div class="card-admin p-8 rounded-3xl">
                <h3 class="text-xl font-bold mb-6">🏦 Bukti Refund</h3>
                <div class="space-y-4">
                    <img src="{{ asset('storage/'.$order->bukti_refund) }}" 
                         class="w-full rounded-2xl border shadow-sm cursor-pointer hover:opacity-90 transition" 
                         onclick="window.open(this.src)">
                    
                    <!-- @if($order->dikonfirmasi_oleh)
                    <div class="text-sm">
                        <p class="text-slate-500">Diproses oleh:</p>
                        <p class="font-bold text-slate-800">{{ $order->dikonfirmasi_oleh }}</p>
                    </div>
                    @endif -->
                </div>
            </div>
            @endif

            {{-- TIMELINE --}}
            <!-- <div class="card-admin p-8 rounded-3xl">
                <h3 class="font-bold text-xl mb-6">Timeline</h3>
                <div class="space-y-5 text-sm">
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
            </div> -->
        </div>
    </div>
</div>

@endsection
