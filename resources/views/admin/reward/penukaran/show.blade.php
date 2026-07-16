@extends('layouts.admin',[
    'activePage' => 'reward'
])

@section('title','Detail Redeem Reward')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold">
                🎁 Detail Redeem Reward
            </h1>

            <p class="text-slate-500 mt-2">
                Detail penukaran reward oleh pengguna.
            </p>

        </div>

        <a
            href="{{ route('admin.redeem.index') }}"
            class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 transition">

            ← Kembali

        </a>

    </div>

    {{-- Alert --}}
    @if(session('success'))

        <div class="rounded-xl bg-green-100 text-green-700 p-4">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="rounded-xl bg-red-100 text-red-700 p-4">

            {{ session('error') }}

        </div>

    @endif

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- ===========================
             KOLOM KIRI
        ============================ --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Informasi Redeem --}}
            <div class="card-admin p-6">

                <h2 class="text-xl font-bold mb-5">

                    Informasi Redeem

                </h2>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <p class="text-slate-500 text-sm">

                            Kode Redeem

                        </p>

                        <h4 class="font-bold text-lg mt-1">

                            {{ $redeem->kode }}

                        </h4>

                    </div>

                    <div>

                        <p class="text-slate-500 text-sm">

                            Status

                        </p>

                        <div class="mt-2">

                            @switch($redeem->status)

                                @case('menunggu')

                                    <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">

                                        Menunggu

                                    </span>

                                @break

                                @case('diproses')

                                    <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">

                                        Diproses

                                    </span>

                                @break

                                @case('selesai')

                                    <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

                                        Selesai

                                    </span>

                                @break

                                @case('dibatalkan')

                                    <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold">

                                        Dibatalkan

                                    </span>

                                @break

                            @endswitch

                        </div>

                    </div>

                    <div>

                        <p class="text-slate-500 text-sm">

                            Tanggal Redeem

                        </p>

                        <h4 class="font-semibold mt-1">

                            {{ $redeem->created_at->translatedFormat('d F Y') }}

                        </h4>

                        <small class="text-slate-500">

                            {{ $redeem->created_at->format('H:i') }}

                        </small>

                    </div>

                    <div>

                        <p class="text-slate-500 text-sm">

                            Total Poin

                        </p>

                        <h3 class="text-2xl font-bold text-red-600 mt-1">

                            {{ number_format($redeem->total_poin) }}
                            Poin

                        </h3>

                    </div>

                </div>

            </div>

            {{-- Informasi User --}}
            <div class="card-admin p-6">

                <h2 class="text-xl font-bold mb-5">

                    Informasi User

                </h2>

                <div class="flex gap-5 items-center">

                    <div
                        class="w-20 h-20 rounded-full bg-gradient-to-r from-red-600 to-yellow-500 text-white flex items-center justify-center text-3xl font-bold">

                        {{ strtoupper(substr($redeem->user->name,0,1)) }}

                    </div>

                    <div>

                        <h3 class="text-xl font-bold">

                            {{ $redeem->user->name }}

                        </h3>

                        <p class="text-slate-500">

                            {{ $redeem->user->email }}

                        </p>

                        @if($redeem->user->no_hp)

                            <p class="mt-1">

                                📞 {{ $redeem->user->no_hp }}

                            </p>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        {{-- ===========================
             SIDEBAR
        ============================ --}}
        <div class="space-y-6">

            {{-- Reward --}}
            <div class="card-admin p-6">

                <h2 class="font-bold text-lg mb-4">

                    Reward

                </h2>

                @if($redeem->reward->gambar)

                    <img
                        src="{{ asset('storage/'.$redeem->reward->gambar) }}"
                        class="w-full h-60 object-cover rounded-xl">

                @else

                    <div
                        class="h-60 rounded-xl bg-slate-100 flex items-center justify-center text-7xl">

                        🎁

                    </div>

                @endif

                <h3 class="font-bold text-xl mt-5">

                    {{ $redeem->reward->nama }}

                </h3>

                <p class="text-slate-500 mt-2">

                    {{ $redeem->reward->kategori }}

                </p>

                <div class="mt-4">

                    <span class="bg-red-100 text-red-600 px-4 py-2 rounded-full font-bold">

                        {{ number_format($redeem->reward->poin) }}
                        Poin

                    </span>

                </div>

            </div>

        </div>

    </div>
        {{-- Detail Pengiriman --}}
        <div class="card-admin p-6 mt-6">

            <h3 class="text-xl font-bold mb-5">
                🚚 Informasi Pengiriman
            </h3>

            @if($redeem->reward->kategori != 'saldo')

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="text-slate-500 text-sm">
                            Ekspedisi
                        </label>

                        <div class="font-semibold mt-1">

                            {{ $redeem->ekspedisi ?? '-' }}

                        </div>

                    </div>

                    <div>

                        <label class="text-slate-500 text-sm">
                            Nomor Resi
                        </label>

                        <div class="font-semibold mt-1">

                            {{ $redeem->nomor_resi ?? '-' }}

                        </div>

                    </div>

                </div>

            @else

                <div class="rounded-xl bg-green-50 border border-green-200 p-5">

                    <div class="font-bold text-green-700">

                        Reward Saldo

                    </div>

                    <p class="text-sm text-green-600 mt-2">

                        Reward ini berupa saldo sehingga tidak memerlukan
                        pengiriman maupun nomor resi.

                    </p>

                </div>

            @endif

        </div>




        {{-- Bukti Penyerahan --}}
        <div class="card-admin p-6 mt-6">

            <h3 class="text-xl font-bold mb-5">
                📦 Bukti Penyerahan
            </h3>

            @if($redeem->bukti_penyerahan)

                <img
                    src="{{ asset('storage/'.$redeem->bukti_penyerahan) }}"
                    class="rounded-xl border max-w-lg">

            @else

                <div class="rounded-xl bg-slate-100 p-8 text-center text-slate-500">

                    Belum ada bukti penyerahan.

                </div>

            @endif

        </div>




        {{-- Timeline --}}
        <div class="card-admin p-6 mt-6">

            <h3 class="text-xl font-bold mb-6">
                📋 Timeline Redeem
            </h3>

            <div class="space-y-6">

                {{-- Dibuat --}}
                <div class="flex gap-4">

                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">

                        📝

                    </div>

                    <div>

                        <div class="font-bold">

                            Permintaan Dibuat

                        </div>

                        <div class="text-sm text-slate-500">

                            {{ $redeem->created_at->format('d M Y H:i') }}

                        </div>

                    </div>

                </div>

                {{-- Diproses --}}
                @if($redeem->diproses_at)

                <div class="flex gap-4">

                    <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">

                        ⚙️

                    </div>

                    <div>

                        <div class="font-bold">

                            Diproses Admin

                        </div>

                        <div class="text-sm text-slate-500">

                            {{ $redeem->diproses_at->format('d M Y H:i') }}

                        </div>

                    </div>

                </div>

                @endif

                {{-- Selesai --}}
                @if($redeem->selesai_at)

                <div class="flex gap-4">

                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">

                        ✅

                    </div>

                    <div>

                        <div class="font-bold">

                            Reward Selesai

                        </div>

                        <div class="text-sm text-slate-500">

                            {{ $redeem->selesai_at->format('d M Y H:i') }}

                        </div>

                    </div>

                </div>

                @endif

                {{-- Dibatalkan --}}
                @if($redeem->dibatalkan_at)

                <div class="flex gap-4">

                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">

                        ❌

                    </div>

                    <div>

                        <div class="font-bold text-red-600">

                            Redeem Dibatalkan

                        </div>

                        <div class="text-sm text-slate-500">

                            {{ $redeem->dibatalkan_at->format('d M Y H:i') }}

                        </div>

                    </div>

                </div>

                @endif

            </div>

        </div>
                {{-- Catatan User --}}
        <div class="card-admin p-6 mt-6">

            <h3 class="text-xl font-bold mb-5">

                📝 Catatan User

            </h3>

            @if($redeem->catatan_user)

                <div class="rounded-xl bg-slate-50 border p-5">

                    {{ $redeem->catatan_user }}

                </div>

            @else

                <div class="rounded-xl bg-slate-100 p-5 text-slate-500">

                    Tidak ada catatan dari user.

                </div>

            @endif

        </div>



        {{-- Catatan Admin --}}
        <div class="card-admin p-6 mt-6">

            <h3 class="text-xl font-bold mb-5">

                📄 Catatan Admin

            </h3>

            @if($redeem->catatan_admin)

                <div class="rounded-xl bg-yellow-50 border border-yellow-200 p-5">

                    {{ $redeem->catatan_admin }}

                </div>

            @else

                <div class="rounded-xl bg-slate-100 p-5 text-slate-500">

                    Belum ada catatan admin.

                </div>

            @endif

        </div>

    </div>
</div>
@endsection