@extends('layouts.admin', [
    'activePage' => 'reward'
])

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-black">
                Voucher Reward
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola seluruh voucher reward.
            </p>

        </div>

        <a href="{{ route('admin.voucher.create') }}"
            class="px-6 py-3 rounded-2xl bg-gradient-to-r from-yellow-500 to-orange-500 text-white font-bold shadow-lg">

            + Tambah Voucher

        </a>

    </div>

    {{-- SUMMARY --}}
    <div class="grid lg:grid-cols-4 gap-6">

        <div class="card-admin p-6">

            <p class="uppercase tracking-[4px] text-xs text-slate-500">
                Total Voucher
            </p>

            <h2 class="text-4xl font-black mt-4">
                {{ \App\Models\RewardVoucher::count() }}
            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="uppercase tracking-[4px] text-xs text-slate-500">
                Aktif
            </p>

            <h2 class="text-4xl font-black text-green-600 mt-4">
                {{ \App\Models\RewardVoucher::where('status','aktif')->count() }}
            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="uppercase tracking-[4px] text-xs text-slate-500">
                Digunakan
            </p>

            <h2 class="text-4xl font-black text-blue-600 mt-4">
                {{ \App\Models\RewardVoucher::where('status','digunakan')->count() }}
            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="uppercase tracking-[4px] text-xs text-slate-500">
                Expired
            </p>

            <h2 class="text-4xl font-black text-red-600 mt-4">
                {{ \App\Models\RewardVoucher::where('status','expired')->count() }}
            </h2>

        </div>

    </div>

    {{-- FILTER --}}
    <div class="card-admin p-6">

        <form>

            <div class="grid lg:grid-cols-4 gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari kode voucher..."
                    class="rounded-xl border p-3">

                <select
                    name="reward_id"
                    class="rounded-xl border p-3">

                    <option value="">
                        Semua Reward
                    </option>

                    @foreach($reward as $item)

                        <option
                            value="{{ $item->id }}"
                            @selected(request('reward_id')==$item->id)>

                            {{ $item->nama }}

                        </option>

                    @endforeach

                </select>

                <select
                    name="status"
                    class="rounded-xl border p-3">

                    <option value="">
                    Semua Status
                    </option>

                    <option value="aktif"
                    @selected(request('status')=='aktif')>

                    Aktif

                    </option>

                    <option value="digunakan"
                    @selected(request('status')=='digunakan')>

                    Digunakan

                    </option>

                    <option value="expired"
                    @selected(request('status')=='expired')>

                    Expired

                    </option>

                    <option value="dibatalkan"
                    @selected(request('status')=='dibatalkan')>

                    Dibatalkan

                    </option>

                </select>

                <button
                    class="rounded-xl bg-blue-600 text-white">

                    Filter

                </button>

            </div>

        </form>

    </div>

    {{-- TABLE --}}
    <div class="card-admin overflow-hidden">

        <table class="w-full">

            <thead>

            <tr class="border-b bg-slate-50">

                <th class="p-4 text-left">Kode</th>

                <th>Reward</th>

                <th>Poin</th>

                <th>Nominal</th>

                <th>Berlaku</th>

                <th>Status</th>

                <th>User</th>

                <th>Aksi</th>

            </tr>

            </thead>

            <tbody>

            @forelse($voucher as $item)

                <tr class="border-b hover:bg-slate-50">

                    <td class="p-4">

                        <div class="font-bold">

                            {{ $item->kode }}

                        </div>

                    </td>

                    <td>

                        {{ $item->reward->nama }}

                    </td>

                    <td>

                        {{ number_format($item->reward->poin) }}

                    </td>

                    <td>

                        Rp {{ number_format($item->nominal) }}

                    </td>

                    <td>

                        @if($item->berlaku_mulai)

                        {{ $item->berlaku_mulai->format('d M Y') }}

                        <br>

                        <small class="text-slate-500">

                        s/d {{ optional($item->berlaku_sampai)->format('d M Y') }}

                        </small>

                        @else

                        -

                        @endif

                    </td>

                    <td>

                        @switch($item->status)

                            @case('aktif')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">

                                Aktif

                                </span>

                            @break

                            @case('digunakan')

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">

                                Digunakan

                                </span>

                            @break

                            @case('expired')

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">

                                Expired

                                </span>

                            @break

                            @case('dibatalkan')

                                <span class="px-3 py-1 rounded-full bg-slate-200 text-slate-700">

                                Dibatalkan

                                </span>

                            @break

                        @endswitch

                    </td>

                    <td>

                        {{ optional($item->user)->name ?? '-' }}

                    </td>

                    <td>

                        <div class="flex gap-2">

                            <a
                                href="{{ route('admin.voucher.show',$item) }}"
                                class="px-3 py-2 rounded-lg bg-blue-600 text-white">

                                Detail

                            </a>

                            <a
                                href="{{ route('admin.voucher.edit',$item) }}"
                                class="px-3 py-2 rounded-lg bg-yellow-500 text-white">

                                Edit

                            </a>

                            <form
                                action="{{ route('admin.voucher.destroy',$item) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus voucher ini?')"
                                    class="px-3 py-2 rounded-lg bg-red-600 text-white">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="8"
                        class="text-center p-8 text-slate-400">

                        Belum ada data voucher.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $voucher->links() }}

</div>

@endsection
