@extends('layouts.pembeli',[
    'activePage' => 'keranjang'
])

@section('content')

<div class="grid lg:grid-cols-3 gap-8">

    {{-- FORM CHECKOUT --}}
    <div class="lg:col-span-2">

        <div class="admin-card p-8 rounded-3xl">

            <div class="mb-8">

                <h1 class="text-4xl font-bold"
                    style="color: var(--color-hitam);">

                    Checkout Pesanan

                </h1>

                <p class="mt-2"
                   style="color: var(--color-coklat);">

                    Lengkapi data pengiriman Anda.

                </p>

            </div>

            <form action="{{ route('pembeli.orders.store') }}"
                  method="POST">

                @csrf

                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Nama --}}
                    <div>
                        <label class="font-semibold">
                            Nama Penerima
                        </label>

                        <input type="text"
                               name="nama_penerima"
                               value="{{ old('nama_penerima') }}"
                               class="w-full mt-2 rounded-2xl border border-slate-200 px-5 py-4">

                        @error('nama_penerima')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- Telp --}}
                    <div>
                        <label class="font-semibold">
                            No Telepon
                        </label>

                        <input type="text"
                               name="telp_penerima"
                               value="{{ old('no_telp_penerima') }}"
                               class="w-full mt-2 rounded-2xl border border-slate-200 px-5 py-4">

                        @error('no_telp_penerima')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">
                            Alamat Lengkap
                        </label>

                        <textarea name="alamat"
                                  rows="5"
                                  class="w-full mt-2 rounded-2xl border border-slate-200 px-5 py-4">{{ old('alamat_pengiriman') }}</textarea>

                        @error('alamat_pengiriman')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    {{-- Kota --}}
                    <div>

                        <label class="font-semibold">
                            Kota / Kabupaten
                        </label>

                        <input type="text"
                               name="kota"
                               value="{{ old('kota') }}"
                               class="w-full mt-2 rounded-2xl border border-slate-200 px-5 py-4">

                    </div>

                    {{-- Provinsi --}}
                    <div>
                        <label>Provinsi</label>

                        <select name="provinsi"
                                id="provinsi"
                                class="w-full rounded-xl mt-2">

                            <option value="">Pilih Provinsi</option>
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
                    </div>

                    {{-- Kode Pos --}}
                    <div>

                        <label class="font-semibold">
                            Kode Pos
                        </label>

                        <input type="text"
                               name="kode_pos"
                               value="{{ old('kode_pos') }}"
                               class="w-full mt-2 rounded-2xl border border-slate-200 px-5 py-4">

                    </div>

                </div>

                <button
                    class="mt-8 w-full py-4 rounded-2xl text-white font-bold text-lg transition hover:opacity-90"
                    style="
                        background:
                        linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">

                    🛍 Buat Pesanan

                </button>

            </form>

        </div>

    </div>

    {{-- RINGKASAN --}}
    <div>

        <div class="admin-card p-8 rounded-3xl sticky top-5">

            <h3 class="text-2xl font-bold mb-6">

                Ringkasan Pesanan

            </h3>

            @foreach($cartItems as $item)

            <div class="flex items-center gap-4 mb-5">

                <img src="{{ asset('storage/'.$item->product->gambar[0]) }}"
                     class="w-16 h-16 rounded-xl object-cover">

                <div class="flex-1">

                    <h4 class="font-semibold">
                        {{ $item->product->nama }}
                    </h4>

                    <small class="text-slate-500">
                        {{ $item->qty }} x
                        Rp {{ number_format($item->product->harga,0,',','.') }}
                    </small>

                </div>

            </div>

            @endforeach

            <hr class="my-6">

            <div class="space-y-4">

                <div class="flex justify-between">

                    <span>Total Item</span>

                    <strong>
                        {{ $cartItems->sum('qty') }}
                    </strong>

                </div>

                <div class="flex justify-between mb-4">
                    <span>Subtotal</span>

                    <span>
                        Rp {{ number_format(
                            $cartItems->sum(fn($i) =>
                            $i->qty * $i->product->harga),
                        0,',','.') }}
                    </span>
                </div>

                <div class="flex justify-between mb-4">
                    <span>Ongkir</span>

                    <span id="ongkirText">
                        Rp 0
                    </span>
                </div>

                <div class="flex justify-between text-2xl font-bold">
                    <span>Total</span>

                    <span id="totalText">
                        Rp {{ number_format(
                            $cartItems->sum(fn($i)=>
                            $i->qty * $i->product->harga),
                        0,',','.') }}
                    </span>
                </div>

            </div>

            <div class="mt-8 p-5 rounded-2xl"
                 style="background: rgba(212,160,23,.08);">

                <h4 class="font-bold mb-2">

                    Transfer Pembayaran

                </h4>

                <p class="text-sm text-slate-600">

                    BCA : <strong>1234567890</strong><br>
                    a/n Sikola Foundation

                </p>

            </div>

        </div>

    </div>

</div>
<script>

const provinsi = document.getElementById('provinsi');

const ongkirMap = {
    'Sumatera Barat':15000,
    'Riau':20000,
    'Jambi':20000,
    'DKI Jakarta':25000,
    'Jawa Barat':25000,
    'Jawa Tengah':30000,
    'Jawa Timur':30000,
    'Kalimantan':40000,
    'Papua':60000
};

const subtotal =
{{ $cartItems->sum(fn($i)=>$i->qty * $i->product->harga) }};

provinsi.addEventListener('change',function(){

    let ongkir = ongkirMap[this.value] || 0;

    document.getElementById('ongkirText').innerHTML =
        'Rp ' + ongkir.toLocaleString('id-ID');

    document.getElementById('totalText').innerHTML =
        'Rp ' + (subtotal + ongkir).toLocaleString('id-ID');

});

</script>
@endsection