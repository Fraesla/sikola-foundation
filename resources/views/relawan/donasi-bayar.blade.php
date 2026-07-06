@extends('layouts.relawan',['activePage'=>'donasi'])

@section('content')

<div class="max-w-5xl mx-auto">


<div class="mb-8">

    <h1 class="text-4xl font-bold">
        Pembayaran Donasi
    </h1>

    <p class="text-slate-500 mt-2">
        Silahkan transfer sesuai nominal berikut
    </p>

</div>

<div class="grid lg:grid-cols-2 gap-8">

    {{-- DETAIL --}}
    <div class="bg-white rounded-[32px] p-8 shadow">

        <h3 class="text-2xl font-bold mb-6">

            Detail Donasi

        </h3>

        <div class="space-y-5">

            <div>

                <small class="text-slate-400">

                    Kode Donasi

                </small>

                <h4 class="font-bold">

                    DON-{{ str_pad($donasi->id,6,'0',STR_PAD_LEFT) }}

                </h4>

            </div>

            <div>

                <small class="text-slate-400">

                    Program

                </small>

                <h4 class="font-bold">

                    {{ $donasi->kategori->nama }}

                </h4>

            </div>

            <div>

                <small class="text-slate-400">

                    Nominal

                </small>

                <h2 class="text-4xl font-bold">

                    Rp {{ number_format($donasi->jumlah,0,',','.') }}

                </h2>

            </div>

        </div>

    </div>


    {{-- REKENING --}}
    <div class="bg-white rounded-[32px] p-8 shadow">

        <h3 class="text-2xl font-bold mb-6">

            Transfer Ke Rekening

        </h3>

        <div class="rounded-3xl p-8 text-white"

             style="
                background:
                linear-gradient(
                    135deg,
                    var(--color-merah),
                    var(--color-coklat)
                );
             ">

            <h4 class="text-xl font-bold">

                BANK BSI

            </h4>

            <h2 class="text-3xl font-bold mt-4">

                7123891238

            </h2>

            <p class="mt-3">

                a.n Yayasan Sikola

            </p>

        </div>

        {{-- FORM UPLOAD BUKTI --}}
        <div class="mt-8">

            <h4 class="font-bold text-lg mb-4">
                Upload Bukti Transfer
            </h4>

            <form action="{{ route(
                    'relawan.donasi.upload',
                    $donasi->id
                ) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="mb-4">

                    <input type="file"
                        name="bukti_transfer"

                        class="w-full border
                               border-slate-200
                               rounded-2xl p-4"

                        required>

                    @error('bukti_transfer')

                        <small class="text-red-500">

                            {{ $message }}

                        </small>

                    @enderror

                </div>

                <button
                    type="submit"

                    class="w-full py-4 rounded-2xl
                           text-white font-semibold"

                    style="
                        background:
                        linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">

                    📤 Upload Bukti Transfer

                </button>

            </form>

        </div>

    </div>

</div>


</div>

@endsection
