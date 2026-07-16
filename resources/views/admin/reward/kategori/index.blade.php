@extends('layouts.admin', [
    'activePage' => 'reward'
])

@section('title','Reward')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold">
                🎁 Reward
            </h1>

            <p class="text-slate-500 mt-1">
                Kelola reward yang dapat ditukarkan menggunakan poin.
            </p>

        </div>

        <a href="{{ route('admin.rewards.create') }}"
           class="px-5 py-3 rounded-xl bg-gradient-to-r from-red-600 to-yellow-500 text-white font-semibold shadow-lg">

            + Tambah Reward

        </a>

    </div>

    {{-- CARD --}}
    <div class="grid md:grid-cols-4 gap-5">

        <div class="card-admin p-6">

            <p class="text-slate-500">
                Total Reward
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $reward->total() }}
            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="text-slate-500">
                Reward Aktif
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">

                {{ \App\Models\Reward::where('is_aktif',1)->count() }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="text-slate-500">
                Total Stok
            </p>

            <h2 class="text-3xl font-bold text-blue-600 mt-2">
                {{ \App\Models\Reward::sum('stok') }}
            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="text-slate-500">
                Reward Tukar
            </p>

            <h2 class="text-3xl font-bold text-orange-600 mt-2">

                {{ \App\Models\RewardRedeem::count() }}

            </h2>

        </div>

    </div>

    {{-- FILTER --}}
    <form class="card-admin p-5">

        <div class="grid md:grid-cols-4 gap-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari reward..."
                class="rounded-xl border p-3">

            <select
                name="kategori"
                class="rounded-xl border p-3">

                <option value="">Semua Kategori</option>

                @foreach(
                    \App\Models\Reward::select('kategori')
                        ->distinct()
                        ->orderBy('kategori')
                        ->pluck('kategori')
                    as $item
                )

                    <option
                        value="{{ $item }}"
                        @selected(request('kategori')==$item)>

                        {{ ucfirst($item) }}

                    </option>

                @endforeach

            </select>

            <select
                name="status"
                class="rounded-xl border p-3">

                <option value="">
                    Semua Status
                </option>

                <option value="1"
                    @selected(request('status')=='1')>

                    Aktif

                </option>

                <option value="0"
                    @selected(request('status')=='0')>

                    Nonaktif

                </option>

            </select>

            <button
                class="rounded-xl bg-slate-900 text-white">

                Filter

            </button>

        </div>

    </form>

    {{-- TABLE --}}
    <div class="card-admin overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="p-4 text-left">
                        Gambar
                    </th>

                    <th>
                        Reward
                    </th>

                    <th>
                        Kategori
                    </th>

                    <th>Poin</th>

                    <th>Stok</th>

                    <th>Urutan</th>

                    <th>Status</th>

                    <th>Dibuat Oleh</th>

                    <th width="170">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($reward as $item)

                <tr class="border-t hover:bg-slate-50">

                    <td class="p-4">

                        @if($item->gambar)

                            <img
                                src="{{ asset('storage/'.$item->gambar) }}"
                                class="w-20 h-20 rounded-xl object-cover">

                        @else

                            <div class="w-20 h-20 rounded-xl bg-slate-200 flex items-center justify-center">

                                🎁

                            </div>

                        @endif

                    </td>

                    <td>

                        <div class="font-bold">

                            {{ $item->nama }}

                        </div>

                        <div class="text-sm text-slate-500">

                            {{ $item->slug }}

                        </div>

                    </td>

                    <td>

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">

                            {{ ucfirst($item->kategori) }}

                        </span>

                    </td>

                    <td>

                        {{ number_format($item->poin) }}

                    </td>

                    <td>

                        {{ $item->stok }}

                    </td>

                    <td>

                        @if($item->is_aktif)

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">

                                Aktif

                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">

                                Nonaktif

                            </span>

                        @endif

                    </td>
                    <td>

                        {{ $item->urutan }}

                    </td>
                    <td>

                        {{ optional($item->creator)->name ?? '-' }}

                    </td>

                    <td>

                        <div class="flex gap-2">

                            <a href="{{ route('admin.rewards.show',$item) }}"
                               class="px-3 py-2 rounded-lg bg-blue-600 text-white">

                                Detail

                            </a>

                            <a href="{{ route('admin.rewards.edit',$item) }}"
                               class="px-3 py-2 rounded-lg bg-yellow-500 text-white">

                                Edit

                            </a>

                            <form
                                action="{{ route('admin.rewards.destroy',$item) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus reward ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="px-3 py-2 rounded-lg bg-red-600 text-white">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center p-10 text-slate-400">

                        Belum ada reward.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $reward->links() }}

</div>

@endsection
