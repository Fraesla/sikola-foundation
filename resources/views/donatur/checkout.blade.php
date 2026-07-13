@extends('layouts.donatur',[
    'activePage' => 'keranjang'
])

@section('content')

<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8 font-sans" style="background-color: var(--color-putih);">
    
    <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-8">

        {{-- FORM CHECKOUT (KIRI) --}}
        <div class="lg:col-span-8">
            <div class="card-admin p-8 lg:p-10">

                <div class="mb-10">
                    <h1 class="text-3xl font-extrabold tracking-tight" style="color: var(--color-hitam); font-family: var(--font-display);">
                        Checkout Pesanan
                    </h1>
                    <p class="mt-2 text-sm md:text-base" style="color: var(--color-coklat);">
                        Lengkapi data pengiriman Anda dengan benar untuk memastikan paket sampai tujuan.
                    </p>
                </div>

                <form action="{{ route('donatur.orders.store') }}" method="POST">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">

                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-bold mb-2" style="color: var(--color-hitam);">
                                Nama Penerima
                            </label>
                            <input type="text"
                                   name="nama_penerima"
                                   value="{{ old('nama_penerima') }}"
                                   placeholder="Contoh: Budi Santoso"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 focus:bg-white px-4 py-3.5 text-sm transition-all text-slate-800">
                            @error('nama_penerima')
                                <small class="text-red-500 font-medium mt-1 block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Telp --}}
                        <div>
                            <label class="block text-sm font-bold mb-2" style="color: var(--color-hitam);">
                                No Telepon / WhatsApp
                            </label>
                            <input type="text"
                                   name="telp_penerima"
                                   value="{{ old('telp_penerima') }}"
                                   placeholder="Contoh: 081234567890"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 focus:bg-white px-4 py-3.5 text-sm transition-all text-slate-800">
                            @error('telp_penerima')
                                <small class="text-red-500 font-medium mt-1 block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2" style="color: var(--color-hitam);">
                                Alamat Lengkap
                            </label>
                            <textarea name="alamat"
                                      rows="4"
                                      placeholder="Nama Jalan, Gedung, No. Rumah, RT/RW, Kelurahan, Kecamatan"
                                      class="w-full rounded-xl border border-slate-200 bg-slate-50 focus:bg-white px-4 py-3.5 text-sm transition-all text-slate-800">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="text-red-500 font-medium mt-1 block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Provinsi --}}
                        <div>
                            <label class="block text-sm font-bold mb-2" style="color: var(--color-hitam);">
                                Provinsi
                            </label>
                            <select name="provinsi"
                                    id="provinsi"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 focus:bg-white px-4 py-3.5 text-sm transition-all text-slate-800 cursor-pointer">
                                <option value="" disabled selected>Pilih Provinsi Pengiriman</option>
                                <option value="Sumatera Barat">Sumatera Barat</option>
                                <option value="Riau">Riau</option>
                                <option value="Jambi">Jambi</option>
                                <option value="DKI Jakarta">DKI Jakarta</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                                <option value="Kalimantan">Kalimantan</option>
                                <option value="Papua">Papua</option>
                            </select>
                            @error('provinsi')
                                <small class="text-red-500 font-medium mt-1 block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Kota --}}
                        <div>
                            <label class="block text-sm font-bold mb-2" style="color: var(--color-hitam);">
                                Kota / Kabupaten
                            </label>
                            <input type="text"
                                   name="kota"
                                   value="{{ old('kota') }}"
                                   placeholder="Contoh: Kota Padang"
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 focus:bg-white px-4 py-3.5 text-sm transition-all text-slate-800">
                            @error('kota')
                                <small class="text-red-500 font-medium mt-1 block">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Kode Pos --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2" style="color: var(--color-hitam);">
                                Kode Pos
                            </label>
                            <input type="text"
                                   name="kode_pos"
                                   value="{{ old('kode_pos') }}"
                                   placeholder="Contoh: 25111"
                                   class="w-full md:w-1/2 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white px-4 py-3.5 text-sm transition-all text-slate-800">
                            @error('kode_pos')
                                <small class="text-red-500 font-medium mt-1 block">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-10 pt-8 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="btn-primary w-full md:w-auto px-10 py-4 flex items-center justify-center gap-2 text-lg shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Buat Pesanan Sekarang
                        </button>
                    </div>

                </form>
            </div>
        </div>

        {{-- RINGKASAN PESANAN (KANAN) --}}
        <div class="lg:col-span-4">
            <div class="card-admin p-6 md:p-8 sticky top-8">

                <h3 class="text-xl font-extrabold mb-6" style="color: var(--color-hitam); font-family: var(--font-display);">
                    Ringkasan Pesanan
                </h3>

                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 scrollbar-thin">
                    @foreach($cartItems as $item)
                    <div class="flex items-center gap-4 group">
                        <div class="relative">
                            <img src="{{ asset('storage/'.$item->product->gambar[0]) }}"
                                 class="w-16 h-16 rounded-xl object-cover shadow-sm transition-transform group-hover:scale-105" 
                                 style="border: 1px solid rgba(212,160,23,.2);">
                            <span class="absolute -top-2 -right-2 bg-slate-800 text-white text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full shadow">
                                {{ $item->qty }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-sm text-slate-900 line-clamp-1">
                                {{ $item->product->nama }}
                            </h4>
                            <p class="text-xs font-semibold mt-1" style="color: var(--color-merah);">
                                Rp {{ number_format($item->product->harga,0,',','.') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="my-6 border-t border-dashed" style="border-color: rgba(212,160,23,.3);"></div>

                <div class="space-y-4 font-medium text-sm" style="color: var(--color-coklat);">
                    <div class="flex justify-between">
                        <span>Total Item</span>
                        <strong style="color: var(--color-hitam);">{{ $cartItems->sum('qty') }} Barang</strong>
                    </div>

                    <div class="flex justify-between">
                        <span>Subtotal Produk</span>
                        <span style="color: var(--color-hitam);">
                            Rp {{ number_format($cartItems->sum(fn($i) => $i->qty * $i->product->harga), 0,',','.') }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span>Ongkos Kirim</span>
                        <span id="ongkirText" class="px-2 py-1 bg-green-50 text-green-700 rounded-md font-bold text-xs">
                            Pilih Provinsi
                        </span>
                    </div>
                </div>

                <div class="my-6 border-t border-slate-100"></div>

                <div class="flex justify-between items-end">
                    <span class="text-sm font-bold" style="color: var(--color-hitam);">Total Tagihan</span>
                    <span id="totalText" class="text-2xl font-extrabold" style="color: var(--color-merah);">
                        Rp {{ number_format($cartItems->sum(fn($i)=> $i->qty * $i->product->harga), 0,',','.') }}
                    </span>
                </div>

                {{-- Kotak Transfer Premium --}}
                <div class="mt-8 p-5 rounded-2xl border border-dashed flex items-start gap-4 transition-all"
                     style="background: rgba(212,160,23,.03); border-color: var(--color-kuning);">
                    <div class="p-2 rounded-lg" style="background: rgba(212,160,23,.1);">
                        <svg class="w-6 h-6" style="color: var(--color-kuning);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-sm mb-1" style="color: var(--color-hitam);">Transfer Pembayaran</h4>
                        <p class="text-xs font-medium leading-relaxed" style="color: var(--color-coklat);">
                            Bank BCA<br>
                            <span class="text-base font-bold tracking-wide" style="color: var(--color-merah);">123 456 7890</span><br>
                            a.n Sikola Foundation
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    const provinsi = document.getElementById('provinsi');
    
    const ongkirMap = {
        'Sumatera Barat': 15000,
        'Riau': 20000,
        'Jambi': 20000,
        'DKI Jakarta': 25000,
        'Jawa Barat': 25000,
        'Jawa Tengah': 30000,
        'Jawa Timur': 30000,
        'Kalimantan': 40000,
        'Papua': 60000
    };
    
    const subtotal = {{ $cartItems->sum(fn($i)=>$i->qty * $i->product->harga) }};
    
    provinsi.addEventListener('change', function() {
        let ongkir = ongkirMap[this.value] || 0;
        
        let ongkirElement = document.getElementById('ongkirText');
        ongkirElement.innerHTML = 'Rp ' + ongkir.toLocaleString('id-ID');
        ongkirElement.classList.remove('bg-green-50', 'text-green-700');
        ongkirElement.classList.add('text-slate-800'); // Merubah gaya jika provinsi sudah dipilih
    
        document.getElementById('totalText').innerHTML = 'Rp ' + (subtotal + ongkir).toLocaleString('id-ID');
    });
</script>

@endsection