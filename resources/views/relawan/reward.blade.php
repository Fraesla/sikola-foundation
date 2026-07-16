@extends('layouts.relawan',[
    'activePage' => 'reward'
])

@section('title','Reward')

@section('content')

<div class="space-y-8">

    {{-- HERO --}}
    <div
        class="relative overflow-hidden rounded-3xl
               bg-gradient-to-r from-red-600 via-red-700 to-yellow-700
               text-white p-10">

        <div class="relative z-10">

            <p class="uppercase tracking-[6px] text-sm opacity-80">

                Reward Center

            </p>

            <h1 class="text-5xl font-black mt-3">

                Tukarkan Poin Anda 🎁

            </h1>

            <p class="mt-4 max-w-2xl text-lg text-white/90">

                Poin diperoleh dari donasi dan aktivitas di Sikola.
                Tukarkan poin menjadi merchandise, saldo maupun hadiah menarik.

            </p>

        </div>

        <div
            class="absolute -right-10 -top-10
                   w-72 h-72 rounded-full
                   border-[15px] border-white/20">

        </div>

        <div
            class="absolute right-20 bottom-0
                   w-56 h-56 rounded-full
                   bg-white/10">

        </div>

    </div>

    {{-- INFO --}}
    <div class="grid lg:grid-cols-4 gap-6">

        <div class="card-admin p-6">

            <p class="text-slate-500">

                Total Poin

            </p>

            <h2 class="text-4xl font-black text-yellow-500 mt-2">

                {{ number_format(auth()->user()->total_poin) }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="text-slate-500">

                Reward Tersedia

            </p>

            <h2 class="text-4xl font-black text-red-600 mt-2">

                {{ $reward->total() }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="text-slate-500">

                Reward Ditukar

            </p>

            <h2 class="text-4xl font-black text-green-600 mt-2">

                {{ auth()->user()->processedRewardRedemptions()->count() }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="text-slate-500">

                Menunggu Proses

            </p>

            <h2 class="text-4xl font-black text-blue-600 mt-2">

                {{ auth()->user()->processedRewardRedemptions()->where('status','menunggu')->count() }}

            </h2>

        </div>

    </div>

    {{-- FILTER --}}
    <div class="card-admin p-6">

        <form method="GET">

            <div class="grid lg:grid-cols-4 gap-2">

                {{-- Search --}}
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari reward..."
                    class="rounded-xl border p-3">

                {{-- Kategori --}}
                <select
                    name="kategori"
                    class="rounded-xl border p-3">

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach($kategori as $item)

                        <option
                            value="{{ $item }}"
                            @selected(request('kategori')==$item)>

                            {{ ucfirst($item) }}

                        </option>

                    @endforeach

                </select>

                {{-- Filter --}}
                <button
                    type="submit"
                    class="rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold transition">

                    🔍 Filter

                </button>

                {{-- Cek Status Claim --}}
                <a href="{{ route(auth()->user()->role.'.reward.riwayat') }}"
                   class="flex items-center justify-center rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold transition">

                    🚚 Cek Barang Claim

                </a>

            </div>

        </form>

    </div>

    {{-- GRID REWARD --}}
    <div class="grid lg:grid-cols-3 gap-8">
        @forelse($reward as $item)

            <div class="card-admin overflow-hidden">

                {{-- Gambar --}}
                <div class="relative">

                    @if($item->gambar)

                        <img
                            src="{{ asset('storage/'.$item->gambar) }}"
                            class="w-full h-60 object-cover">

                    @else

                        <div class="w-full h-60 bg-slate-100 flex items-center justify-center text-7xl">

                            🎁

                        </div>

                    @endif

                    <span
                        class="absolute top-4 left-4
                               bg-white/90 backdrop-blur
                               px-4 py-2 rounded-full
                               text-sm font-bold">

                        {{ ucfirst($item->kategori) }}

                    </span>

                </div>

                {{-- Body --}}
                <div class="p-6">

                    <h2 class="text-2xl font-black">

                        {{ $item->nama }}

                    </h2>

                    <p class="text-slate-500 mt-2 line-clamp-3">

                        {{ $item->deskripsi }}

                    </p>

                    <!-- {{-- Nilai Reward --}}
                    @if($item->nilai_reward)

                    <div class="mt-4">

                        <span class="text-sm text-slate-500">

                            Nilai Reward

                        </span>

                        <div class="text-xl font-bold text-green-600">

                            Rp {{ number_format($item->nilai_reward,0,',','.') }}

                        </div>

                    </div>

                    @endif -->

                    {{-- Info --}}
                    <div class="grid grid-cols-2 gap-4 mt-6">

                        <div>

                            <div class="text-slate-500 text-sm">

                                Poin

                            </div>

                            <div class="text-2xl font-black text-yellow-500">

                                {{ number_format($item->poin) }}

                            </div>

                        </div>

                        <div>

                            <div class="text-slate-500 text-sm">

                                Stok

                            </div>

                            @if($item->stok > 0)

                                <div class="text-2xl font-black text-green-600">

                                    {{ $item->stok }}

                                </div>

                            @else

                                <div class="text-2xl font-black text-red-600">

                                    Habis

                                </div>

                            @endif

                        </div>

                    </div>

                    {{-- Progress poin --}}
                    @php

                        $persen = min(
                            100,
                            (auth()->user()->total_poin / max($item->poin,1)) * 100
                        );

                    @endphp

                    <div class="mt-6">

                        <div class="flex justify-between text-sm mb-2">

                            <span>Poin Anda</span>

                            <span>

                                {{ number_format(auth()->user()->total_poin) }}
                                /
                                {{ number_format($item->poin) }}

                            </span>

                        </div>

                        <div class="h-3 rounded-full bg-slate-200 overflow-hidden">

                            <div
                                class="h-full bg-gradient-to-r
                                       from-yellow-400
                                       to-red-500"
                                style="width: {{ $persen }}%">

                            </div>

                        </div>

                    </div>

                    {{-- Tombol --}}
                    <div class="mt-8">

                        @if(!$item->is_aktif)

                            <button
                                disabled
                                class="w-full py-3 rounded-xl
                                       bg-slate-300 text-slate-500">

                                Reward Tidak Aktif

                            </button>

                        @elseif($item->stok <= 0)

                            <button
                                disabled
                                class="w-full py-3 rounded-xl
                                       bg-red-100 text-red-600">

                                Stok Habis

                            </button>

                        @elseif(auth()->user()->total_poin < $item->poin)

                            <button
                                disabled
                                class="w-full py-3 rounded-xl
                                       bg-yellow-100 text-yellow-700">

                                Poin Belum Cukup

                            </button>

                        @else

                            <button
                                onclick="openRedeem(
                                    '{{ $item->id }}',
                                    '{{ $item->nama }}',
                                    '{{ number_format($item->poin) }}'
                                )"
                                class="w-full py-3 rounded-xl
                                       bg-gradient-to-r
                                       from-red-600
                                       to-yellow-500
                                       text-white
                                       font-bold">

                                🎁 Tukarkan Reward

                            </button>

                        @endif

                    </div>

                </div>

            </div>

        @empty

        <div class="lg:col-span-3">

            <div class="card-admin p-16 text-center">

                <div class="text-7xl">

                    🎁

                </div>

                <h2 class="text-3xl font-bold mt-5">

                    Reward Belum Tersedia

                </h2>

                <p class="text-slate-500 mt-3">

                    Saat ini belum ada reward yang dapat ditukarkan.

                </p>

            </div>

        </div>

         @endforelse

    </div>
    {{-- Pagination --}}
    <div class="mt-8">

        {{ $reward->links() }}

    </div>

{{-- Modal Redeem --}}
<div
    id="redeemModal"
    class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

    <div class="bg-white rounded-3xl w-full max-w-lg p-8">

        <h2 class="text-3xl font-black">

            🎁 Tukarkan Reward

        </h2>

        <p class="text-slate-500 mt-2">

            Pastikan poin Anda mencukupi sebelum menukarkan reward.

        </p>

        <form
            action="{{ route(auth()->user()->role.'.reward.store') }}"
            method="POST"
            class="mt-8">

            @csrf

            <input
                type="hidden"
                id="reward_id"
                name="reward_id">

            <div class="space-y-5">

                <div>

                    <label class="text-sm text-slate-500">

                        Reward

                    </label>

                    <div
                        id="reward_nama"
                        class="font-bold text-xl mt-1">

                    </div>

                </div>

                <div>

                    <label class="text-sm text-slate-500">

                        Poin Dibutuhkan

                    </label>

                    <div
                        id="reward_poin"
                        class="font-bold text-yellow-600 text-2xl">

                    </div>

                </div>

                <div>

                    <label class="text-sm text-slate-500">

                        Poin Anda

                    </label>

                    <div class="font-bold text-green-600 text-2xl">

                        {{ number_format(auth()->user()->total_poin) }}

                    </div>

                </div>

                <div>

                    <label class="text-sm text-slate-500">

                        Jumlah :

                    </label>

                    <input
                        type="number"
                        name="qty"
                        value="{{ old('qty') }}"
                        class="w-full rounded-2xl border-slate-300">

                </div>
                


                <div>

                    <label class="font-semibold">

                        Catatan (Opsional)

                    </label>

                    <textarea
                        name="catatan"
                        rows="4"
                        class="w-full mt-2 rounded-xl border p-3"
                        placeholder="Contoh: Kirim ke alamat rumah saya..."></textarea>

                </div>

            </div>

            <div class="flex gap-3 mt-8">

                <button
                    type="button"
                    onclick="closeRedeem()"
                    class="flex-1 py-3 rounded-xl bg-slate-200">

                    Batal

                </button>

                <button
                    class="flex-1 py-3 rounded-xl
                           bg-gradient-to-r
                           from-red-600
                           to-yellow-500
                           text-white
                           font-bold">

                    Tukarkan

                </button>

            </div>

        </form>

    </div>

</div>
@endsection
@push('scripts')

<script>

function openRedeem(id,nama,poin)
{
    document
        .getElementById('reward_id')
        .value=id;

    document
        .getElementById('reward_nama')
        .innerHTML=nama;

    document
        .getElementById('reward_poin')
        .innerHTML=poin+" Poin";

    document
        .getElementById('redeemModal')
        .classList.remove('hidden');

    document
        .getElementById('redeemModal')
        .classList.add('flex');
}

function closeRedeem()
{
    document
        .getElementById('redeemModal')
        .classList.remove('flex');

    document
        .getElementById('redeemModal')
        .classList.add('hidden');
}

window.onclick=function(e){

    let modal=document.getElementById('redeemModal');

    if(e.target===modal){

        closeRedeem();

    }

}

</script>
@endpush