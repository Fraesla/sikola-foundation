@extends('layouts.pembeli',[
    'activePage' => 'keranjang'
])

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold"
            style="color: var(--color-hitam);">

            Keranjang Saya

        </h1>

        <p class="mt-2"
           style="color: var(--color-coklat);">

            Kelola produk yang ingin Anda beli.

        </p>
    </div>

    <div class="px-5 py-3 rounded-2xl bg-white shadow">

        <span class="text-slate-500">
            Total Item
        </span>

        <div class="text-2xl font-bold">
            {{ $cartItems->count() }}
        </div>

    </div>

</div>


@if($cartItems->count() > 0)

<div class="grid lg:grid-cols-3 gap-8">

    {{-- LIST PRODUK --}}
    <div class="lg:col-span-2 space-y-5">

        @foreach($cartItems as $item)

        <div class="admin-card p-6 rounded-3xl">

            <div class="flex justify-between">

                <div class="flex gap-5">

                    <img src="{{ asset('storage/' . ($item->product->gambar[0] ?? 'default.png')) }}"
                        class="w-28 h-28 rounded-2xl object-cover">

                    <div>

                        <h3 class="font-bold text-xl">
                            {{ $item->product->nama }}
                        </h3>

                        <p class="text-slate-500 mt-2">
                            Harga :
                            Rp {{ number_format($item->product->harga,0,',','.') }}
                        </p>

                        <div class="mt-4">

                            <span class="px-4 py-2 rounded-xl bg-slate-100">
                                Qty : {{ $item->qty }}
                            </span>

                        </div>

                    </div>

                </div>

                <div class="text-right">

                    <h4 class="font-bold text-2xl"
                        style="color: var(--color-merah);">

                        Rp {{ number_format($item->qty * $item->product->harga,0,',','.') }}

                    </h4>

                    <form action="{{ route('pembeli.keranjang.destroy',$item->id) }}"
                          method="POST"
                          class="mt-6">

                        @csrf
                        @method('DELETE')

                        <button
                            class="px-4 py-2 rounded-xl text-white"
                            style="background-color: var(--color-merah);">

                            Hapus

                        </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>


    {{-- RINGKASAN --}}
    <div>

        <div class="admin-card p-6 rounded-3xl sticky top-5">

            <h3 class="text-xl font-bold mb-6">
                Ringkasan Belanja
            </h3>

            <div class="flex justify-between mb-4">

                <span>Total Item</span>

                <span>{{ $cartItems->sum('qty') }}</span>

            </div>

            <div class="flex justify-between mb-6">

                <span>Total Harga</span>

                <span class="font-bold text-xl">

                    Rp {{ number_format($cartItems->sum(fn($i) => $i->qty * $i->product->harga),0,',','.') }}

                </span>

            </div>

            <a href="{{ route('pembeli.orders.create') }}"
               class="block w-full text-center py-4 rounded-2xl text-white font-semibold"
               style="background: linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
               );">

                Lanjut Checkout

            </a>

        </div>

    </div>

</div>

@else

{{-- EMPTY STATE --}}

<div class="admin-card rounded-3xl p-16 text-center">

    <div class="text-8xl mb-6">
        🛒
    </div>

    <h2 class="text-3xl font-bold mb-3">

        Keranjang Masih Kosong

    </h2>

    <p class="text-slate-500 mb-8">

        Anda belum menambahkan produk ke keranjang.

    </p>

    <a href="{{ route('pembeli.keranjang.create') }}"
       class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl text-white font-semibold"
       style="background: linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
       );">

        🛍 Mulai Belanja

    </a>

</div>

@endif

@endsection