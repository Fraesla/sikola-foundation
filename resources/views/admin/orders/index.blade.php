@extends('layouts.admin',[
    'activePage' => 'order'
])

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold"
            style="color:var(--color-hitam);">

            Order Management

        </h1>

        <p class="mt-2"
           style="color:var(--color-coklat);">

            Kelola pesanan, pembayaran dan pengiriman.

        </p>

    </div>

</div>


{{-- STATISTIK --}}
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="card-admin p-6">

        <p class="admin-muted">
            Total Order
        </p>

        <h2 class="text-4xl font-bold mt-2"
            style="color:var(--color-merah);">

            {{ $totalOrder }}

        </h2>

    </div>

    <div class="card-admin p-6">

        <p class="admin-muted">
            Menunggu Konfirmasi
        </p>

        <h2 class="text-4xl font-bold mt-2 text-yellow-500">

            {{ $orderBaru }}

        </h2>

    </div>

    <div class="card-admin p-6">

        <p class="admin-muted">
            Diproses
        </p>

        <h2 class="text-4xl font-bold mt-2 text-blue-600">

            {{ $orderDiproses }}

        </h2>

    </div>

    <div class="card-admin p-6">

        <p class="admin-muted">
            Selesai
        </p>

        <h2 class="text-4xl font-bold mt-2 text-green-600">

            {{ $orderSelesai }}

        </h2>

    </div>

</div>


{{-- FILTER --}}
<form class="card-admin p-5 mb-6">

    <div class="flex flex-col lg:flex-row gap-4 justify-between">

        <div class="flex gap-3">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari kode order / nama penerima..."
                   class="w-80 rounded-xl border px-4 py-3">

            <button class="btn-primary">

                Cari

            </button>

        </div>

        <div class="flex gap-3">

            <select name="status"
                    onchange="this.form.submit()"
                    class="rounded-xl border px-4 py-3">

                <option value="">
                    Semua Status
                </option>

                <option value="menunggu_pembayaran">
                    Menunggu Pembayaran
                </option>

                <option value="menunggu_konfirmasi">
                    Menunggu Konfirmasi
                </option>

                <option value="diproses">
                    Diproses
                </option>

                <option value="dikirim">
                    Dikirim
                </option>

                <option value="selesai">
                    Selesai
                </option>

                <option value="dibatalkan">
                    Dibatalkan
                </option>

            </select>

            <select name="sort"
                    onchange="this.form.submit()"
                    class="rounded-xl border px-4 py-3">

                <option value="latest">
                    Terbaru
                </option>

                <option value="oldest">
                    Terlama
                </option>

            </select>

        </div>

    </div>

</form>


{{-- TABEL --}}
<div class="card-admin overflow-hidden">

    <div class="p-6 border-b">

        <h3 class="font-bold text-xl">

            Daftar Order

        </h3>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50">

            <tr>

                <th class="p-4 text-left">
                    Order
                </th>

                <th>
                    Customer
                </th>

                <th>
                    Total
                </th>

                <th>
                    Status
                </th>

                <th>
                    Tanggal
                </th>

                <th class="text-center">
                    Aksi
                </th>

            </tr>

            </thead>

            <tbody>

            @forelse($orders as $order)

                <tr class="border-t hover:bg-slate-50">

                    <td class="p-4">

                        <div>

                            <div class="font-semibold">

                                {{ $order->kode_order }}

                            </div>

                            <small class="text-slate-500">

                                {{ Str::limit(
                                    $order->alamat_pengiriman,
                                    40
                                ) }}

                            </small>

                        </div>

                    </td>

                    <td>

                        <div>

                            <div class="font-semibold">

                                {{ $order->nama_penerima }}

                            </div>

                            <small class="text-slate-500">

                                {{ $order->no_telp_penerima }}

                            </small>

                        </div>

                    </td>

                    <td class="font-bold"
                        style="color:var(--color-merah);">

                        Rp
                        {{ number_format(
                            $order->total_harga,
                            0,
                            ',',
                            '.'
                        ) }}

                    </td>

                    <td>

                        @switch($order->status)

                            @case('menunggu_konfirmasi')
                                <span class="badge-warning">
                                    Menunggu
                                </span>
                            @break

                            @case('diproses')
                                <span class="badge-primary">
                                    Diproses
                                </span>
                            @break

                            @case('dikirim')
                                <span class="badge-success">
                                    Dikirim
                                </span>
                            @break

                            @case('selesai')
                                <span class="badge-success">
                                    Selesai
                                </span>
                            @break

                            @case('dibatalkan')
                                <span class="badge-danger">
                                    Dibatalkan
                                </span>
                            @break

                            @default
                                <span class="badge-secondary">
                                    Menunggu Bayar
                                </span>

                        @endswitch

                    </td>

                    <td>

                        {{ $order->created_at->format('d M Y') }}

                    </td>

                    <td>

                        <div class="flex justify-center gap-2">

                            <a href="#"
                               class="px-3 py-2 rounded-xl bg-blue-100 text-blue-600">

                                Detail

                            </a>

                            <a href="#"
                               class="px-3 py-2 rounded-xl bg-yellow-100 text-yellow-600">

                                Status

                            </a>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6"
                        class="p-12 text-center">

                        <div class="flex flex-col items-center">

                            <div class="text-6xl mb-3">

                                📦

                            </div>

                            <h3 class="font-bold text-xl">

                                Belum Ada Pesanan

                            </h3>

                            <p class="text-slate-500">

                                Pesanan customer akan muncul di sini.

                            </p>

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-6 border-t">

        {{ $orders->links() }}

    </div>

</div>

@endsection