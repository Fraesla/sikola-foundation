@extends('layouts.admin', [
    'activePage' => 'merchandise'
])

@section('content')

<div class="max-w-7xl mx-auto space-y-8 pb-16">

    {{-- HEADER --}}
    <div class="admin-card rounded-[35px] p-10 mb-8 relative overflow-hidden bg-gradient-to-br from-white to-slate-50 shadow-xl">
        <div class="absolute -right-16 -top-16 w-72 h-72 rounded-full bg-white opacity-50 blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-6">
                {{-- Tombol Kembali Ditambahkan Di Sini --}}
                <a href="{{ route('admin.orders.index') }}" 
                   class="w-16 h-16 rounded-2xl flex items-center justify-center bg-white shadow-lg hover:shadow-xl transition-transform hover:-translate-x-1 border border-slate-100 text-2xl">
                    ←
                </a>
                
                <div>
                    <h1 class="text-5xl font-black" style="color:var(--color-hitam);">💸 Refund Management</h1>
                    <p class="text-lg mt-2 text-slate-500">Proses pengembalian dana untuk order #{{ $order->kode_order }}</p>
                    <div class="mt-4 flex gap-3">
                        <span class="px-5 py-2 rounded-full bg-slate-100 font-bold text-slate-700">{{ $order->kode_order }}</span>
                        <span class="px-5 py-2 rounded-full bg-red-100 text-red-600 font-bold uppercase tracking-wider">{{ $order->status }}</span>
                    </div>
                </div>
            </div>
            
            <div class="text-right">
                <p class="text-slate-400 uppercase tracking-widest text-sm font-bold">Total Refund</p>
                <h1 class="text-6xl font-black mt-2" style="color:var(--color-merah);">
                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                </h1>
                <p class="text-green-600 font-bold mt-2 flex items-center justify-end gap-1">✓ Siap dikembalikan</p>
            </div>
        </div>
    </div>

    {{-- STATISTIK MINI --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach(['Total Produk' => $order->items->count(), 'Total Qty' => $order->items->sum('kuantitas'), 'Ongkir' => 'Rp '.number_format($order->ongkos_kirim), 'Status' => strtoupper($order->status)] as $label => $val)
        <div class="bg-white p-6 rounded-3xl shadow-lg border border-slate-100">
            <div class="text-slate-400 text-xs font-bold uppercase tracking-widest">{{ $label }}</div>
            <div class="text-2xl font-black mt-2 text-slate-800">{{ $val }}</div>
        </div>
        @endforeach
    </div>

    {{-- MAIN CONTENT --}}
    <div class="grid lg:grid-cols-3 gap-8">
        
        {{-- KOLOM KIRI --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- CUSTOMER INFO --}}
            <div class="admin-card rounded-[35px] p-8 shadow-lg">
                <h2 class="text-2xl font-black mb-6">👤 Customer Information</h2>
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center text-white text-3xl font-black shadow-lg" 
                         style="background: linear-gradient(135deg, var(--color-merah), var(--color-coklat));">
                        {{ strtoupper(substr($order->nama_penerima, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-black">{{ $order->nama_penerima }}</h3>
                        <p class="text-slate-500 font-medium">📞 {{ $order->no_telp_penerima }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    @foreach(['Alamat' => $order->alamat_pengiriman, 'Kota' => $order->kota, 'Provinsi' => $order->provinsi, 'Kode Pos' => $order->kode_pos] as $l => $v)
                    <div class="bg-slate-50 p-5 rounded-2xl">
                        <div class="text-xs text-slate-400 uppercase font-bold tracking-widest">{{ $l }}</div>
                        <div class="font-bold mt-1 text-slate-800">{{ $v }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- INFORMASI PENGIRIMAN --}}
            @if($order->ekspedisi || $order->no_resi)
                <div class="admin-card rounded-[35px] p-8 shadow-lg">
                    <h2 class="text-2xl font-black mb-6">🚚 Informasi Pengiriman</h2>
                    <div class="grid grid-cols-2 gap-5">
                        <div class="bg-slate-50 rounded-2xl p-5">
                            <div class="text-xs uppercase text-slate-400 font-bold">Ekspedisi</div>
                            <div class="mt-2 text-xl font-bold">{{ $order->ekspedisi }}</div>
                        </div>
                        <div class="bg-slate-50 rounded-2xl p-5">
                            <div class="text-xs uppercase text-slate-400 font-bold">Nomor Resi</div>
                            <div class="mt-2 text-xl font-bold">{{ $order->no_resi }}</div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- BUKTI PEMBAYARAN CUSTOMER --}}
            <div class="admin-card rounded-[35px] p-8 shadow-lg">
                <h2 class="text-2xl font-black mb-6">📷 Bukti Pembayaran Customer</h2>
                @if($order->bukti_pembayaran)
                    <img src="{{ asset('storage/'.$order->bukti_pembayaran) }}" class="rounded-3xl border shadow-md w-full h-80 object-cover cursor-pointer hover:opacity-90 transition" onclick="window.open(this.src)">
                    <p class="text-xs text-slate-400 mt-4 italic">* Klik gambar untuk memperbesar</p>
                @else
                    <div class="p-10 border-2 border-dashed border-slate-200 rounded-3xl text-center text-slate-400">
                        Tidak ada bukti pembayaran ditemukan
                    </div>
                @endif
            </div>

            {{-- PRODUK --}}
            <div class="admin-card rounded-[35px] p-8 shadow-lg">
                <h2 class="text-2xl font-black mb-6">📦 Produk Direfund</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                        <div class="flex gap-4 items-center">
                            <img src="{{ asset('storage/'.$item->merchandise->gambar[0]) }}" class="w-16 h-16 rounded-xl object-cover">
                            <div>
                                <h3 class="font-bold text-slate-800">{{ $item->nama_produk }}</h3>
                                <p class="text-slate-500 text-sm">{{ $item->kuantitas }} x Rp {{ number_format($item->harga_satuan,0,',','.') }}</p>
                            </div>
                        </div>
                        <div class="font-bold text-red-600">Rp {{ number_format($item->subtotal,0,',','.') }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN (FORM REFUND) --}}
        <div class="lg:col-span-1">
            <form action="{{ route('admin.orders.refund.process',$order->id) }}" method="POST" enctype="multipart/form-data" class="sticky top-8">
                @csrf
                <div class="admin-card rounded-[35px] p-8 shadow-lg">
                    <h2 class="text-2xl font-black mb-6">🏦 Konfirmasi Refund</h2>
                    
                    <label class="block font-bold mb-3">Upload Bukti Transfer</label>
                    <input type="file" name="bukti_refund" id="previewImage" class="hidden" accept="image/*" required>
                    <label for="previewImage" class="block cursor-pointer">
                        <div class="rounded-3xl border-2 border-dashed border-red-200 bg-red-50 p-8 text-center hover:bg-red-100 transition">
                            <div class="text-5xl">📤</div>
                            <p class="mt-2 font-semibold text-slate-600">Klik untuk upload bukti</p>
                        </div>
                    </label>

                    <img id="preview" class="hidden mt-4 rounded-2xl border w-full h-40 object-cover shadow-sm">
                    
                    <button id="submitRefund" type="submit" class="w-full mt-6 py-5 rounded-3xl text-white font-black text-xl shadow-lg hover:scale-[1.02] transition" onsubmit="return confirm('Proses Refund ini akan mengembalikan dana customer. Lanjutkan?')" 
                            style="background: linear-gradient(135deg, var(--color-merah), var(--color-coklat));">
                        💸 Konfirmasi Refund
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const previewImage = document.getElementById('previewImage');
    const preview = document.getElementById('preview');

    previewImage.onchange = function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.classList.remove("hidden");
            }
            reader.readAsDataURL(this.files[0]);
        }
    }

    document.querySelector("form").onsubmit = function() {
        const btn = document.getElementById("submitRefund");
        btn.disabled = true;
        btn.innerHTML = "Memproses...";
    }
</script>

@endsection