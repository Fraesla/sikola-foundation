@extends('layouts.admin', [
    'activePage' => 'reward'
])

@section('title','Reward')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div>
        <h1 class="text-4xl font-black">
            🎁 Reward Management
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola reward, voucher, merchandise reward, saldo, dan penukaran poin.
        </p>
    </div>

    {{-- CARD BESAR --}}
    <div class="grid lg:grid-cols-2 gap-8">

        {{-- Reward --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-yellow-500 to-red-500"></div>

            <div class="p-8">

                <div class="uppercase tracking-[5px] text-xs text-amber-700 mb-4">
                    Reward
                </div>

                <h2 class="text-4xl font-black mb-4">
                    Daftar Reward
                </h2>

                <p class="text-slate-500 leading-8">
                    Kelola reward yang dapat ditukar menggunakan poin pengguna.
                </p>

                <div class="grid grid-cols-3 mt-8 gap-6">

                    <div>
                        <div class="text-slate-500 text-sm">
                            Total Reward
                        </div>

                        <div class="text-5xl font-black text-red-600 mt-2">
                            {{ $totalReward }}
                        </div>
                    </div>

                    <div>
                        <div class="text-slate-500 text-sm">
                            Total Stok
                        </div>

                        <div class="text-5xl font-black text-blue-600 mt-2">
                            {{ $totalStok }}
                        </div>
                    </div>

                    <div>
                        <div class="text-slate-500 text-sm">
                            Aktif
                        </div>

                        <div class="text-5xl font-black text-green-600 mt-2">
                            {{ $rewardAktif }}
                        </div>
                    </div>

                </div>

                <a href="{{ route('admin.rewards.index') }}"
                   class="inline-block mt-8 px-8 py-4 rounded-2xl bg-gradient-to-r from-yellow-600 to-red-600 text-white font-bold shadow-lg">

                    Kelola Reward

                </a>

            </div>

        </div>

        {{-- Penukaran --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="h-2 bg-gradient-to-r from-green-500 to-blue-500"></div>

            <div class="p-8">

                <div class="uppercase tracking-[5px] text-xs text-green-700 mb-4">
                    Redeem
                </div>

                <h2 class="text-4xl font-black mb-4">
                    Penukaran Reward
                </h2>

                <p class="text-slate-500 leading-8">
                    Pantau seluruh permintaan penukaran reward oleh pengguna.
                </p>

                <div class="grid grid-cols-3 mt-8 gap-6">

                    <div>
                        <div class="text-slate-500 text-sm">
                            Menunggu
                        </div>

                        <div class="text-5xl font-black text-yellow-500 mt-2">
                            {{ $pending }}
                        </div>
                    </div>

                    <div>
                        <div class="text-slate-500 text-sm">
                            Diproses
                        </div>

                        <div class="text-5xl font-black text-blue-600 mt-2">
                            {{ $diproses }}
                        </div>
                    </div>

                    <div>
                        <div class="text-slate-500 text-sm">
                            Selesai
                        </div>

                        <div class="text-5xl font-black text-green-600 mt-2">
                            {{ $selesai }}
                        </div>
                    </div>

                </div>

                <a href="{{ route('admin.redeem.index') }}"
                   class="inline-block mt-8 px-8 py-4 rounded-2xl bg-gradient-to-r from-green-600 to-blue-600 text-white font-bold shadow-lg">

                    Kelola Penukaran

                </a>

            </div>

        </div>

    </div>

    {{-- CARD KECIL --}}
        <!-- <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">

            <a href="{{ route('admin.rewards.index') }}"
               class="bg-white rounded-3xl p-8 shadow hover:-translate-y-1 transition">

                <div class="text-5xl mb-4">🎁</div>

                <h3 class="font-bold text-xl">
                    Reward
                </h3>

                <p class="text-slate-500 mt-2">
                    CRUD reward.
                </p>

            </a>

            <a href="#"
               class="bg-white rounded-3xl p-8 shadow hover:-translate-y-1 transition">

                <div class="text-5xl mb-4">🎟️</div>

                <h3 class="font-bold text-xl">
                    Voucher
                </h3>

                <p class="text-slate-500 mt-2">
                    Reward voucher.
                </p>

            </a>

            <a href="#"
               class="bg-white rounded-3xl p-8 shadow hover:-translate-y-1 transition">

                <div class="text-5xl mb-4">🔄</div>

                <h3 class="font-bold text-xl">
                    Redeem
                </h3>

                <p class="text-slate-500 mt-2">
                    Riwayat penukaran.
                </p>

            </a>

            <a href="{{ route('admin.rewards.index') }}"
               class="bg-white rounded-3xl p-8 shadow hover:-translate-y-1 transition">

                <div class="text-5xl mb-4">⭐</div>

                <h3 class="font-bold text-xl">
                    Poin Reward
                </h3>

                <p class="text-slate-500 mt-2">
                    Manajemen poin.
                </p>

            </a>

        </div> -->

</div>

@endsection