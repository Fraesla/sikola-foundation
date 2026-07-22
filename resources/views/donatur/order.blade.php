@extends('layouts.donatur',[
    'activePage' => 'order'
])

@section('content')

<div class="min-h-screen py-10 px-4 sm:px-6 lg:px-8 font-sans" style="background-color: var(--color-putih);">
    
    <div class="max-w-7xl mx-auto">
        
        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">

            <div>
                <h1 class="text-5xl font-black flex items-center gap-3"
                    style="color:var(--color-hitam);">

                    📦 Riwayat Pesanan

                </h1>

                <p class="mt-2 text-lg text-slate-500">
                    Lihat seluruh transaksi merchandise yang pernah Anda lakukan.
                </p>
            </div>

            {{-- Tombol Belanja Lagi --}}
            <a href="{{ route('merchandise') }}"
               class="group inline-flex items-center gap-3 px-8 py-4 rounded-2xl
                      text-white font-bold text-lg shadow-xl transition-all duration-300
                      hover:-translate-y-1 hover:shadow-2xl"
               style="background:linear-gradient(135deg,var(--color-merah),var(--color-coklat));">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 transition-transform group-hover:rotate-12"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2"/>
                </svg>

                Belanja Merchandise

            </a>

        </div>

        <div class="space-y-8">
            @forelse($orders as $order)

            <div class="bg-white rounded-3xl overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                 style="border: 1px solid rgba(212,160,23,.2); box-shadow: 0 10px 40px rgba(139,94,42,.05);">
                
                {{-- HEADER ORDER --}}
                <div class="p-6 md:p-8 border-b"
                     style="background: linear-gradient(135deg, rgba(255,255,255,1), rgba(212,160,23,.03)); border-bottom-color: rgba(212,160,23,.1);">
                    
                    <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">
                        <div>
                            <div class="flex items-center gap-4 flex-wrap">
                                <h3 class="text-2xl font-extrabold tracking-tight" style="color: var(--color-hitam);">
                                    #{{ $order->kode_order ?? '-' }}
                                </h3>

                               {{-- STATUS BADGE DENGAN LOGIKA DINAMIS --}}
                                @php
                                    $statusColor = 'bg-slate-100 text-slate-800 border-slate-200';
                                    $statusText = ucwords(str_replace('_', ' ', $order->status));

                                    if ($order->status == 'selesai') {
                                        if ($order->dikonfirmasi_oleh) {
                                            // Selesai via Refund
                                            $statusColor = 'bg-rose-100 text-rose-800 border-rose-200';
                                            $statusText = 'Selesai (Refund)';
                                        } elseif (!$order->bukti_pembayaran) {
                                            // Selesai karena dibatalkan manual tanpa bukti bayar
                                            $statusColor = 'bg-gray-100 text-gray-800 border-gray-200';
                                            $statusText = 'Selesai (Dibatalkan)';
                                        } else {
                                            // Selesai pengiriman normal
                                            $statusColor = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                                            $statusText = 'Selesai (Pengiriman)';
                                        }
                                    } else {
                                        // Status lainnya menggunakan match standar
                                        $statusColor = match($order->status){
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

                                <span class="px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider border {{ $statusColor }}">
                                    {{ $statusText }}
                                </span> 
                            </div>

                            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-2 text-sm font-semibold" style="color: var(--color-coklat);">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $order->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}
                                </div>
                                <div class="hidden sm:block w-px bg-slate-300"></div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Resi: <span style="color: var(--color-hitam);">{{ $order->no_resi ?? 'Belum tersedia' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-left lg:text-right">
                            <small class="text-xs font-bold uppercase tracking-wide" style="color: var(--color-coklat);">Total Pembayaran</small>
                            <div class="text-3xl font-extrabold mt-1" style="color: var(--color-merah);">
                                Rp {{ number_format($order->total_harga,0,',','.') }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BODY ORDER --}}
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                        {{-- KOLOM 1: PRODUK (Col-6) --}}
                        <div class="lg:col-span-6">
                            @php
                                $produk = $order->items->first();
                            @endphp
                            
                            <div class="flex gap-5 p-5 rounded-2xl transition-all" style="background: rgba(212,160,23,.03); border: 1px solid rgba(212,160,23,.1);">
                                <img src="{{ $produk && isset($produk->merchandise?->gambar[0]) ? asset('storage/'.$produk->merchandise->gambar[0]) : 'https://placehold.co/120x120?text=No+Image' }}"
                                     class="w-24 h-24 rounded-xl object-cover shadow-sm border border-white">
                                
                                <div class="flex-1 flex flex-col justify-center">
                                    <h3 class="font-extrabold text-lg line-clamp-2" style="color: var(--color-hitam);">
                                        {{ $produk->merchandise?->nama_produk ?? $produk->nama_produk ?? 'Produk Tidak Tersedia' }}
                                    </h3>
                                    
                                    <div class="text-sm font-semibold mt-1" style="color: var(--color-coklat);">
                                        {{ $order->items->count() }} Macam Produk
                                    </div>

                                    <div class="mt-3 flex gap-2 flex-wrap">
                                        <span class="px-3 py-1 rounded-md text-xs font-bold bg-white" style="color: var(--color-hitam); border: 1px solid rgba(212,160,23,.2);">
                                            🚚 {{ $order->ekspedisi ?? '-' }}
                                        </span>
                                        <span class="px-3 py-1 rounded-md text-xs font-bold bg-white" style="color: var(--color-hitam); border: 1px solid rgba(212,160,23,.2);">
                                            👤 {{ $order->nama_penerima ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- KOLOM 2: PENGIRIMAN (Col-3) --}}
                        <div class="lg:col-span-3 flex flex-col justify-center">
                            <h4 class="font-extrabold text-sm uppercase tracking-wide mb-4" style="color: var(--color-hitam);">Informasi Pengiriman</h4>
                            
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between items-center border-b border-dashed pb-2" style="border-color: rgba(212,160,23,.3);">
                                    <span style="color: var(--color-coklat);">Ekspedisi</span>
                                    <strong style="color: var(--color-hitam);">{{ $order->ekspedisi ?? '-' }}</strong>
                                </div>
                                <div class="flex justify-between items-center border-b border-dashed pb-2" style="border-color: rgba(212,160,23,.3);">
                                    <span style="color: var(--color-coklat);">No. Resi</span>
                                    <strong style="color: var(--color-hitam);">{{ $order->no_resi ?? '-' }}</strong>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span style="color: var(--color-coklat);">Penerima</span>
                                    <strong class="text-right truncate max-w-[120px]" style="color: var(--color-hitam);">{{ $order->nama_penerima ?? '-' }}</strong>
                                </div>
                            </div>
                        </div>

                        {{-- KOLOM 3: ACTION BUTTONS (Col-3) --}}
                        <div class="lg:col-span-3 flex flex-col justify-center gap-3">
                            
                            <a href="{{ route('donatur.orders.show',$order->id) }}"
                               class="w-full py-3 rounded-xl text-center font-bold text-sm transition-all hover:-translate-y-0.5"
                               style="border: 2px solid var(--color-kuning); color: var(--color-hitam); background: transparent;">
                                📄 Detail Pesanan
                            </a>
                            @if($order->status == 'selesai' || $order->status == 'dibatalkan')
                                {{-- Belanja Lagi --}}
                                <a href="{{ route('donatur.keranjang.create') }}"
                                   class="group flex items-center justify-center gap-3 py-4 rounded-2xl font-bold text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                                   style="background:linear-gradient(135deg,#ef4444,#b45309);">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5 transition group-hover:rotate-12"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2"/>

                                    </svg>

                                    Belanja Lagi

                                </a>
                            @endif

                            @if($order->status == 'menunggu_pembayaran')
                                <a href="{{ route('donatur.orders.bayar',$order->id) }}"
                                   class="w-full py-3 rounded-xl text-center font-bold text-sm text-white transition-all shadow-md hover:-translate-y-0.5"
                                   style="background: linear-gradient(135deg, var(--color-merah), var(--color-coklat));">
                                    💳 Bayar Sekarang
                                </a>
                            @endif

                            @if($order->status == 'dikirim')
                                <form action="{{ route('donatur.orders.selesai',$order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            onclick="return confirm('Apakah Anda yakin barang sudah diterima dengan baik?\n\nPesanan akan diselesaikan dan poin akan diberikan.')"
                                            class="w-full py-3 rounded-xl text-white font-bold text-sm transition-all shadow-md hover:-translate-y-0.5"
                                            style="background: linear-gradient(135deg, #16a34a, #22c55e);">
                                        ✅ Pesanan Diterima
                                    </button>
                                </form>
                                <!-- <a href="{{ route('donatur.orders.komplain',$order->id) }}"
                                   class="w-full py-2.5 rounded-xl text-center font-bold text-xs transition-all hover:bg-orange-50"
                                   style="color: var(--color-merah); border: 1px dashed var(--color-merah);">
                                    ⚠ Ajukan Komplain
                                </a> -->
                            @endif

                            @if($order->status != 'selesai' && $order->status != 'dibatalkan')
                                <div x-data="{ openBatal: false }">
                                    <button @click="openBatal = true"
                                            class="w-full py-3 rounded-xl font-bold text-sm transition-all hover:-translate-y-0.5"
                                            style="background: rgba(204,34,34,.05); border: 1px solid rgba(204,34,34,.2); color: var(--color-merah);">
                                        ❌ Batalkan Pesanan
                                    </button>

                                    {{-- MODAL BATAL --}}
                                    <template x-teleport="body">
                                        <div x-show="openBatal" x-cloak x-transition.opacity class="fixed inset-0 z-[9999] flex items-center justify-center p-4">
                                            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="openBatal = false"></div>
                                            
                                            <div @click.away="openBatal = false" x-transition.scale
                                                 class="bg-white w-full max-w-lg rounded-[28px] overflow-hidden shadow-2xl relative z-10">
                                                
                                                <div class="p-8 border-b border-slate-100">
                                                    <h3 class="text-2xl font-extrabold" style="color: var(--color-hitam); font-family: var(--font-display);">Batalkan Pesanan</h3>
                                                    <p class="mt-2 text-sm font-medium" style="color: var(--color-coklat);">Apakah Anda yakin ingin membatalkan pesanan ini?</p>
                                                </div>

                                                <form action="{{ route('donatur.orders.batal',$order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <div class="p-8 space-y-4">
                                                        <div>
                                                            <label class="block font-bold mb-2 text-sm" style="color: var(--color-hitam);">Alasan Pembatalan</label>
                                                            <textarea name="alasan_batal" rows="4" required
                                                                      class="w-full rounded-2xl border border-slate-200 p-4 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-red-100 focus:border-red-500 transition-all resize-none"
                                                                      placeholder="Contoh: Ingin mengubah alamat pengiriman, salah pilih produk..."></textarea>
                                                        </div>
                                                        <div class="p-4 rounded-xl bg-red-50 border border-red-100 flex gap-3 items-start">
                                                            <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                            <p class="text-xs font-bold text-red-700 leading-relaxed">Pesanan yang sudah dibatalkan tidak dapat dipulihkan. Dana yang sudah masuk akan masuk ke proses refund.</p>
                                                        </div>
                                                    </div>

                                                    <div class="p-6 bg-slate-50 flex gap-3">
                                                        <button type="button" @click="openBatal = false"
                                                                class="flex-1 py-3.5 rounded-xl border border-slate-300 font-bold text-sm text-slate-700 hover:bg-slate-100 transition-all">
                                                            Kembali
                                                        </button>
                                                        <button type="submit"
                                                                class="flex-1 py-3.5 rounded-xl font-bold text-sm text-white shadow-md transition-all hover:-translate-y-0.5"
                                                                style="background: linear-gradient(135deg, var(--color-merah), #991b1b);">
                                                            Ya, Batalkan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            @elseif($order->status == 'dibatalkan')
                                <div class="bg-red-50 border border-red-100 rounded-xl p-4 text-sm">
                                    <div class="font-extrabold text-red-700 mb-1 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Pesanan Dibatalkan
                                    </div>
                                    <p class="font-medium text-red-600/80 leading-relaxed">
                                        Alasan: {{ $order->alasan_batal ?? '-' }}
                                    </p>
                                </div>
                            @endif

                        </div>
                    </div>

                    {{-- TIMELINE PROGRESS --}}
                    @php
                        $step = match($order->status){
                            'menunggu_pembayaran' => 1,
                            'menunggu_konfirmasi' => 2,
                            'dikonfirmasi'        => 3,
                            'diproses'            => 4,
                            'dikirim'             => 5,
                            'selesai'             => 6,
                            default               => 0
                        };
                        $steps = ['Bayar', 'Konfirmasi', 'Disetujui', 'Diproses', 'Dikirim', 'Selesai'];
                    @endphp

                    @if($order->status != 'dibatalkan')
                    <div class="mt-10 pt-8 border-t border-slate-100">
                        <div class="relative w-full max-w-4xl mx-auto hidden md:block">
                            {{-- Base Line --}}
                            <div class="absolute top-1/2 left-0 right-0 h-1.5 bg-slate-100 -translate-y-1/2 rounded-full"></div>
                            {{-- Active Line --}}
                            <div class="absolute top-1/2 left-0 h-1.5 -translate-y-1/2 rounded-full transition-all duration-500" 
                                 style="background: linear-gradient(90deg, var(--color-merah), var(--color-kuning)); width: {{ ($step > 0) ? (($step-1) * 20) : 0 }}%;">
                            </div>
                            
                            <div class="relative z-10 flex justify-between">
                                @foreach($steps as $index => $label)
                                    @php $isActive = ($index + 1) <= $step; @endphp
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-extrabold text-sm transition-all duration-300 shadow-sm"
                                             style="{{ $isActive ? 'background: linear-gradient(135deg, var(--color-merah), var(--color-coklat)); color: white; border: none;' : 'background: white; color: var(--color-coklat); border: 2px solid rgba(212,160,23,.2);' }}">
                                            @if($isActive) ✓ @else {{ $index + 1 }} @endif
                                        </div>
                                        <span class="text-xs font-bold uppercase tracking-wider {{ $isActive ? '' : 'opacity-50' }}" style="color: var(--color-hitam);">
                                            {{ $label }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Mobile Timeline Fallback --}}
                        <div class="md:hidden flex items-center gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <div class="w-10 h-10 shrink-0 rounded-full flex items-center justify-center text-white font-bold" style="background: linear-gradient(135deg, var(--color-merah), var(--color-coklat));">
                                {{ $step > 0 ? $step : '-' }}
                            </div>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Status Saat Ini</p>
                                <p class="text-sm font-extrabold" style="color: var(--color-hitam);">
                                    {{ $step > 0 ? $steps[$step-1] : 'Dibatalkan' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- FOOTER INFO --}}
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="rounded-2xl p-5 flex items-center justify-between" style="background: rgba(212,160,23,.03); border: 1px solid rgba(212,160,23,.1);">
                            <span class="text-xs font-bold uppercase tracking-wider" style="color: var(--color-coklat);">Total Item</span>
                            <span class="font-extrabold text-lg" style="color: var(--color-hitam);">{{ $order->items->sum('kuantitas') }} Barang</span>
                        </div>
                        <div class="rounded-2xl p-5 flex items-center justify-between" style="background: rgba(212,160,23,.03); border: 1px solid rgba(212,160,23,.1);">
                            <span class="text-xs font-bold uppercase tracking-wider" style="color: var(--color-coklat);">Ongkos Kirim</span>
                            <span class="font-extrabold text-lg" style="color: var(--color-hitam);">Rp {{ number_format($order->ongkos_kirim,0,',','.') }}</span>
                        </div>
                        <div class="rounded-2xl p-5 flex items-center justify-between" style="background: rgba(212,160,23,.03); border: 1px solid rgba(212,160,23,.1);">
                            <span class="text-xs font-bold uppercase tracking-wider" style="color: var(--color-coklat);">Poin Didapat</span>
                            <span class="font-extrabold text-lg flex items-center gap-1" style="color: var(--color-kuning);">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                +{{ $order->poin_diberikan }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            @empty
            {{-- EMPTY STATE --}}
            <div class="bg-white rounded-3xl p-12 md:p-20 text-center shadow-sm" style="border: 1px solid rgba(212,160,23,.1);">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl shadow-inner border border-slate-100">
                    📦
                </div>
                <h3 class="text-2xl font-extrabold" style="color: var(--color-hitam); font-family: var(--font-display);">Belum Ada Pesanan</h3>
                <p class="mt-3 text-sm font-medium max-w-sm mx-auto" style="color: var(--color-coklat);">Anda belum pernah melakukan transaksi merchandise. Yuk, koleksi sekarang dan dapatkan poinnya!</p>
                
                <a href="{{ route('merchandise') }}" class="inline-flex items-center gap-2 mt-8 px-8 py-3.5 rounded-xl font-bold text-white shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl"
                   style="background: linear-gradient(135deg, var(--color-merah), var(--color-coklat));">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Mulai Belanja
                </a>
            </div>
            @endforelse
        </div>

    </div>
</div>

@endsection
