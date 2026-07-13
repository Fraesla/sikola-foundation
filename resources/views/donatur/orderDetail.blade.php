@extends('layouts.donatur', ['activePage' => 'order'])

@section('content')

<div class="min-h-screen py-10 px-4 sm:px-6 lg:px-8 font-sans" style="background-color: var(--color-putih);">
    <div class="max-w-6xl mx-auto space-y-8">

        {{-- HEADER --}}
        <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-50 rounded-full blur-3xl opacity-50"></div>
            <div class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h1 class="text-4xl font-bold tracking-tight" style="color: var(--color-hitam); font-family: var(--font-display);">Detail Pesanan</h1>
                    <div class="mt-4 flex items-center gap-4 text-sm font-semibold text-slate-500">
                        <span class="flex items-center gap-1.5">Invoice: <span class="font-bold" style="color: var(--color-hitam);">{{ $order->kode_order ?? '-' }}</span></span>
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                        <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="{{ url('donatur/orders') }}" class="group px-6 py-3 rounded-2xl border border-slate-200 font-bold hover:bg-slate-50 transition-all text-sm flex items-center gap-2">
                        <span class="group-hover:-translate-x-1 transition-transform">←</span> Kembali
                    </a>
                    
                    {{-- DYNAMIC STATUS BADGE --}}
                    @php

                        $statusColor = 'bg-slate-100 text-slate-800 border-slate-200';
                        $statusText  = ucwords(str_replace('_', ' ', $order->status));

                        if ($order->status == 'selesai') {

                            if ($order->dikonfirmasi_oleh) {

                                // Refund selesai
                                $statusColor = 'bg-rose-100 text-rose-800 border-rose-200';
                                $statusText  = 'Selesai (Refund)';

                            } elseif (!$order->bukti_pembayaran) {

                                // Order dibatalkan tanpa pembayaran
                                $statusColor = 'bg-gray-100 text-gray-800 border-gray-200';
                                $statusText  = 'Selesai (Dibatalkan)';

                            } else {

                                // Order selesai normal
                                $statusColor = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                                $statusText  = 'Selesai (Pengiriman)';

                            }

                        } else {

                            $statusColor = match($order->status) {

                                'menunggu_pembayaran'  => 'bg-amber-100 text-amber-800 border-amber-200',

                                'menunggu_konfirmasi'  => 'bg-orange-100 text-orange-800 border-orange-200',

                                'dikonfirmasi'         => 'bg-blue-100 text-blue-800 border-blue-200',

                                'diproses'             => 'bg-purple-100 text-purple-800 border-purple-200',

                                'dikirim'              => 'bg-indigo-100 text-indigo-800 border-indigo-200',

                                'dibatalkan'           => 'bg-red-100 text-red-800 border-red-200',

                                default                => 'bg-slate-100 text-slate-800 border-slate-200'

                            };

                            $statusText = match($order->status) {

                                'menunggu_pembayaran' => 'Menunggu Pembayaran',

                                'menunggu_konfirmasi' => 'Menunggu Konfirmasi',

                                'dikonfirmasi'        => 'Dikonfirmasi',

                                'diproses'            => 'Sedang Diproses',

                                'dikirim'             => 'Sedang Dikirim',

                                'dibatalkan'          => 'Dibatalkan',

                                default               => ucwords(str_replace('_',' ',$order->status))

                            };

                        }

                    @endphp

                    <span class="px-4 py-2 rounded-full text-xs font-extrabold uppercase tracking-wider border {{ $statusColor }}">
                        {{ $statusText }}
                    </span>
                </div>
            </div>
        </div>

        {{-- MAIN GRID --}}
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                
                {{-- PRODUK DIPESAN --}}
                <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-slate-50">
                    <h3 class="text-2xl font-bold mb-8" style="color: var(--color-hitam);">Barang Dipesan</h3>
                    <div class="space-y-8">
                        @foreach($order->items as $item)
                        <div class="group flex items-center gap-6">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
                                <img src="{{ isset($item->merchandise?->gambar[0]) ? asset('storage/'.$item->merchandise->gambar[0]) : 'https://placehold.co/100x100' }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-lg" style="color: var(--color-hitam);">{{ $item->nama_produk }}</h4>
                                <p class="text-xs font-bold mt-1" style="color: var(--color-coklat);">{{ $item->kuantitas }} Item x Rp {{ number_format($item->harga_satuan,0,',','.') }}</p>
                            </div>
                            <div class="font-extrabold text-lg" style="color:var(--color-merah)">Rp {{ number_format($item->subtotal,0,',','.') }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- INFO PENGIRIMAN --}}
                <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-slate-50">
                    <h3 class="text-2xl font-bold mb-8" style="color: var(--color-hitam);">Info Pengiriman</h3>
                    <div class="grid md:grid-cols-2 gap-8 text-sm font-medium">
                        @foreach(['Nama Penerima' => $order->nama_penerima, 'Telepon' => $order->no_telp_penerima, 'Ekspedisi' => $order->ekspedisi, 'Resi' => $order->no_resi] as $label => $val)
                        <div>
                            <p class="font-extrabold text-[10px] text-slate-400 uppercase tracking-widest mb-2">{{ $label }}</p>
                            <p style="color: var(--color-hitam);">{{ $val ?? '-' }}</p>
                        </div>
                        @endforeach
                        <div class="col-span-2">
                            <p class="font-extrabold text-[10px] text-slate-400 uppercase tracking-widest mb-2">Alamat Lengkap</p>
                            <p style="color: var(--color-hitam);">{{ $order->alamat_pengiriman ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="space-y-6">
                {{-- RINGKASAN --}}
                <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-slate-50">
                    <h3 class="text-xl font-bold mb-8" style="color: var(--color-hitam);">Ringkasan</h3>
                    <div class="space-y-4 font-semibold text-sm">
                        <div class="flex justify-between text-slate-400"><span>Total</span><span style="color:var(--color-hitam)">Rp {{ number_format($order->total_harga,0,',','.') }}</span></div>
                    </div>
                </div>

                {{-- 1. Tambahkan di bawah Header atau di dalam kolom produk --}}
                @if($order->alasan_batal)
                <div class="p-8 rounded-[2rem] border border-red-100 bg-red-50 shadow-sm flex items-start gap-4">
                    <div class="text-2xl">⚠️</div>
                    <div>
                        <h4 class="text-[10px] font-extrabold uppercase tracking-widest text-red-600 mb-1">Catatan Pembatalan</h4>
                        <p class="text-sm font-semibold text-red-900 leading-relaxed italic">
                            "{{ $order->alasan_batal }}"
                        </p>
                    </div>
                </div>
                @endif

                {{-- INFO REFUND (Muncul jika ada konfirmasi admin) --}}
                @if($order->status == 'selesai' && $order->dikonfirmasi_oleh)
                <div class="p-8 rounded-[2rem] border border-rose-100 bg-rose-50 shadow-sm">
                    <h4 class="text-[10px] font-extrabold uppercase tracking-widest text-rose-600 mb-4">Informasi Refund</h4>
                    <div class="space-y-4">
                        
                        @if($order->bukti_refund)
                            <div>
                                <p class="text-[10px] text-rose-500 mb-2 font-bold uppercase">Bukti Transfer:</p>
                                <div class="group relative rounded-xl overflow-hidden cursor-pointer border border-rose-200" 
                                     onclick="window.open('{{ asset('storage/'.$order->bukti_refund) }}', '_blank')">
                                    <img src="{{ asset('storage/'.$order->bukti_refund) }}" 
                                         alt="Bukti Refund" 
                                         class="w-full h-32 object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                                        KLIK UNTUK LIHAT
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @endif 
            </div>
        </div>
    </div>
</div>
@endsection