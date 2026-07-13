@extends('layouts.admin',[
    'activePage' => 'merchandise'
])

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-4xl font-bold"
            style="color: var(--color-hitam);">

            🚚 Input Pengiriman

        </h1>

        <p class="mt-2 text-slate-500">
            Lengkapi informasi pengiriman untuk customer.
        </p>

    </div>


    <div class="grid lg:grid-cols-3 gap-8">

        {{-- FORM --}}
        <div class="lg:col-span-2">

            <div class="card-admin p-8 rounded-3xl">

                <h3 class="text-2xl font-bold mb-8">
                    Informasi Pengiriman
                </h3>

                <form action="{{ route('admin.orders.update',$order->id) }}"
                      method="POST">

                    @csrf

                    @method('PUT')

                    <div class="grid md:grid-cols-2 gap-6">

                        {{-- Ekspedisi --}}
                        <div>

                            <label class="font-semibold">
                                Ekspedisi
                            </label>

                            <select name="ekspedisi"
                                    class="w-full mt-3 rounded-2xl border-slate-200 py-4">

                                <option value="">
                                    Pilih Ekspedisi
                                </option>

                                <option value="JNE">
                                    JNE
                                </option>

                                <option value="J&T">
                                    J&T Express
                                </option>

                                <option value="SiCepat">
                                    SiCepat
                                </option>

                                <option value="AnterAja">
                                    AnterAja
                                </option>

                                <option value="POS Indonesia">
                                    POS Indonesia
                                </option>

                                <option value="Ninja Xpress">
                                    Ninja Xpress
                                </option>

                            </select>

                        </div>


                        {{-- No Resi --}}
                        <div>

                            <label class="font-semibold">
                                Nomor Resi
                            </label>

                            <input
                                type="text"
                                name="no_resi"
                                placeholder="Masukkan nomor resi"
                                class="w-full mt-3 rounded-2xl border-slate-200 py-4">

                        </div>

                    </div>


                    {{-- Catatan --}}
                    <div class="mt-6">

                        <label class="font-semibold">
                            Catatan Pengiriman (Opsional)
                        </label>

                        <textarea
                            name="catatan"
                            rows="4"
                            placeholder="Contoh: Barang dikirim dalam kondisi baik."
                            class="w-full mt-3 rounded-2xl border-slate-200"></textarea>

                    </div>


                    <div class="flex gap-4 mt-8">

                        <a href="{{ url()->previous() }}"
                           class="px-8 py-4 rounded-2xl bg-slate-100">

                            Kembali

                        </a>

                        <button
                            class="px-10 py-4 rounded-2xl text-white font-bold shadow-lg"

                            style="background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );">

                            🚚 Simpan Pengiriman

                        </button>

                    </div>

                </form>

            </div>

        </div>



        {{-- SIDEBAR --}}
        <div>

            <div class="card-admin p-7 rounded-3xl sticky top-5">

                <h3 class="text-xl font-bold mb-6">
                    Detail Pesanan
                </h3>

                <div class="space-y-5">

                    <div>

                        <small class="text-slate-500">
                            Kode Order
                        </small>

                        <h4 class="font-bold">
                            {{ $order->kode_order }}
                        </h4>

                    </div>

                    <div>

                        <small class="text-slate-500">
                            Customer
                        </small>

                        <h4 class="font-bold">
                            {{ $order->nama_penerima }}
                        </h4>

                    </div>

                    <div>

                        <small class="text-slate-500">
                            No Telepon
                        </small>

                        <h4 class="font-bold">
                            {{ $order->no_telp_penerima }}
                        </h4>

                    </div>

                    <div>

                        <small class="text-slate-500">
                            Alamat
                        </small>

                        <p class="font-medium">
                            {{ $order->alamat_pengiriman }}
                        </p>

                    </div>

                    <div>

                        <small class="text-slate-500">
                            Total Pembayaran
                        </small>

                        <h3 class="text-3xl font-bold text-red-600">

                            Rp {{ number_format(
                                $order->total_harga,
                                0,',','.'
                            ) }}

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection