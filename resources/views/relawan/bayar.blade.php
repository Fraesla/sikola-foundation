@extends('layouts.relawan')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- HEADER --}}
            <div class="admin-card rounded-3xl p-8">

                <div class="flex justify-between items-start">

                    <div>

                        <h1 class="text-4xl font-bold">
                            Pembayaran Order
                        </h1>

                        <p class="mt-2 text-slate-500">
                            Silahkan selesaikan pembayaran untuk melanjutkan proses pesanan.
                        </p>

                    </div>

                    <div class="text-right">

                        <span class="text-sm text-slate-500">
                            Kode Order
                        </span>

                        <h3 class="font-bold text-xl">
                            {{ $order->kode_order }}
                        </h3>

                    </div>

                </div>

            </div>

            {{-- BANK --}}
            <div class="rounded-3xl p-8 text-white relative overflow-hidden"
                 style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                 ">

                <div class="absolute right-0 top-0 text-[160px] opacity-10">
                    💳
                </div>

                <span class="uppercase tracking-[4px]">
                    Rekening Tujuan
                </span>

                <h2 class="text-4xl font-bold mt-3">
                    BCA
                </h2>

                <div class="mt-8">

                    <p class="text-sm opacity-80">
                        Nomor Rekening
                    </p>

                    <div class="flex items-center gap-4">

                        <h3 class="text-3xl font-bold">
                            1234567890
                        </h3>

                        <button
                            onclick="navigator.clipboard.writeText('1234567890')"
                            class="bg-white/20 px-4 py-2 rounded-xl">

                            Salin

                        </button>

                    </div>

                </div>

                <div class="mt-6">

                    <p class="text-sm opacity-80">
                        Atas Nama
                    </p>

                    <h3 class="text-2xl font-semibold">
                        Sikola Foundation
                    </h3>

                </div>

            </div>

            {{-- LANGKAH PEMBAYARAN --}}
            <div class="admin-card rounded-3xl p-8">

                <h3 class="text-2xl font-bold mb-6">
                    Cara Pembayaran
                </h3>

                <div class="space-y-4">

                    <div class="flex gap-4">

                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center text-white"
                            style="background: var(--color-merah);">

                            1

                        </div>

                        <div>
                            Transfer sesuai nominal yang tertera.
                        </div>

                    </div>

                    <div class="flex gap-4">

                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center text-white"
                            style="background: var(--color-merah);">

                            2

                        </div>

                        <div>
                            Upload bukti pembayaran.
                        </div>

                    </div>

                    <div class="flex gap-4">

                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center text-white"
                            style="background: var(--color-merah);">

                            3

                        </div>

                        <div>
                            Admin akan memverifikasi pembayaran.
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- RIGHT --}}
        <div class="space-y-6">

            {{-- TOTAL --}}
            <div class="admin-card rounded-3xl p-8">

                <h3 class="font-bold text-xl mb-6">

                    Total Transfer

                </h3>

                <div
                    class="text-5xl font-bold"
                    style="color: var(--color-merah);">

                    Rp {{ number_format($order->total_harga,0,',','.') }}

                </div>

                <div class="mt-4">

                    <span
                        class="px-4 py-2 rounded-full"
                        style="
                            background: rgba(212,160,23,.15);
                            color: var(--color-kuning);
                        ">

                        Menunggu Pembayaran

                    </span>

                </div>

            </div>


            {{-- UPLOAD --}}
            <div class="admin-card rounded-3xl p-8">

                <h3 class="font-bold text-xl mb-5">
                    Upload Bukti
                </h3>

                <form action="{{ route('relawan.orders.upload-bukti',$order->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <label
                        class="border-2 border-dashed rounded-3xl p-8 block text-center cursor-pointer">

                        <div class="text-6xl mb-4">
                            📷
                        </div>

                        <h4 class="font-bold">
                            Pilih Bukti Transfer
                        </h4>

                        <p class="text-slate-500 mt-2">
                            JPG, PNG maksimal 2 MB
                        </p>

                        <input
                            type="file"
                            id="preview-image"
                            name="bukti_pembayaran"
                            class="hidden"
                            onchange="previewFile(event)">

                    </label>

                    <div class="mt-5 text-center">

                        <img id="preview"
                             class="hidden mx-auto rounded-2xl max-h-60">

                    </div>

                    @error('bukti_pembayaran')
                        <div class="text-red-500 mt-3">
                            {{ $message }}
                        </div>
                    @enderror

                    <button
                        class="w-full mt-6 py-4 rounded-2xl text-white font-bold"

                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                        Upload Bukti Pembayaran

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script>
function previewFile(event)
{
    let reader = new FileReader();

    reader.onload = function(){
        let output = document.getElementById('preview');

        output.src = reader.result;
        output.classList.remove('hidden');
    }

    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection