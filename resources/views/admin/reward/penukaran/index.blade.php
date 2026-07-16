@extends('layouts.admin', [
    'activePage' => 'reward'
])

@section('title','Penukaran Reward')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-4xl font-black">

                Penukaran Reward

            </h1>

            <p class="text-slate-500 mt-2">

                Kelola seluruh permintaan penukaran reward pengguna.

            </p>

        </div>

    </div>

    {{-- SUMMARY --}}
    <div class="grid lg:grid-cols-4 gap-6">

        <div class="card-admin p-6">

            <p class="uppercase tracking-[3px] text-xs text-slate-500">

                Total Penukaran

            </p>

            <h2 class="text-4xl font-black mt-3">

                {{ \App\Models\RewardRedeem::count() }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="uppercase tracking-[3px] text-xs text-slate-500">

                Menunggu

            </p>

            <h2 class="text-4xl font-black mt-3 text-yellow-600">

                {{ \App\Models\RewardRedeem::where('status','menunggu')->count() }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="uppercase tracking-[3px] text-xs text-slate-500">

                Diproses

            </p>

            <h2 class="text-4xl font-black mt-3 text-blue-600">

                {{ \App\Models\RewardRedeem::where('status','diproses')->count() }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="uppercase tracking-[3px] text-xs text-slate-500">

                Selesai

            </p>

            <h2 class="text-4xl font-black mt-3 text-green-600">

                {{ \App\Models\RewardRedeem::where('status','selesai')->count() }}

            </h2>

        </div>

    </div>

    {{-- FILTER --}}
    <div class="card-admin p-6">

        <form method="GET">

            <div class="grid lg:grid-cols-4 gap-4">

                {{-- Search --}}
                <div>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari kode / nama user..."
                        class="w-full rounded-xl border p-3">

                </div>

                {{-- Status --}}
                <div>

                    <select
                        name="status"
                        class="w-full rounded-xl border p-3">

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="menunggu"
                            @selected(request('status')=='menunggu')>

                            Menunggu

                        </option>

                        <option
                            value="diproses"
                            @selected(request('status')=='diproses')>

                            Diproses

                        </option>

                        <option
                            value="selesai"
                            @selected(request('status')=='selesai')>

                            Selesai

                        </option>

                        <option
                            value="dibatalkan"
                            @selected(request('status')=='dibatalkan')>

                            Dibatalkan

                        </option>

                    </select>

                </div>

                {{-- Kategori Reward --}}
                <div>

                    <select
                        name="kategori"
                        class="w-full rounded-xl border p-3">

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach(
                            \App\Models\Reward::select('kategori')
                                ->distinct()
                                ->orderBy('kategori')
                                ->pluck('kategori')
                            as $kategori
                        )

                            <option
                                value="{{ $kategori }}"
                                @selected(request('kategori')==$kategori)>

                                {{ ucfirst($kategori) }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Button --}}
                <div>

                    <button
                        class="w-full rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3">

                        Filter Data

                    </button>

                </div>

            </div>

        </form>

    </div>

    {{-- TABLE --}}
    <div class="card-admin overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="p-4 text-left">

                        Kode

                    </th>

                    <th>

                        User

                    </th>

                    <th>

                        Reward

                    </th>

                    <th>

                        Qty

                    </th>

                    <th>

                        Total Poin

                    </th>

                    <th>

                        Status

                    </th>

                    <th>

                        Tanggal

                    </th>

                    <th width="150">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($redeem as $item)
                    <tr class="border-t hover:bg-slate-50 transition">

                        {{-- Kode --}}
                        <td class="p-4">

                            <div class="font-bold text-slate-800">

                                {{ $item->kode }}

                            </div>

                        </td>

                        {{-- User --}}
                        <td>

                            <div class="font-semibold">

                                {{ $item->user->name }}

                            </div>

                            <div class="text-xs text-slate-500">

                                {{ $item->user->email }}

                            </div>

                        </td>

                        {{-- Reward --}}
                        <td>

                            <div class="flex items-center gap-3">

                                @if($item->reward->gambar)

                                    <img
                                        src="{{ asset('storage/'.$item->reward->gambar) }}"
                                        class="w-14 h-14 rounded-xl object-cover border">

                                @else

                                    <div
                                        class="w-14 h-14 rounded-xl bg-slate-200 flex items-center justify-center text-2xl">

                                        🎁

                                    </div>

                                @endif

                                <div>

                                    <div class="font-semibold">

                                        {{ $item->reward->nama }}

                                    </div>

                                    <div class="text-xs text-slate-500">

                                        {{ ucfirst($item->reward->kategori) }}

                                    </div>

                                </div>

                            </div>

                        </td>

                        {{-- Qty --}}
                        <td class="text-center font-semibold">

                            {{ number_format($item->qty) }}

                        </td>

                        {{-- Total Poin --}}
                        <td>

                            <span class="font-bold text-red-600">

                                {{ number_format($item->total_poin) }}

                                Poin

                            </span>

                        </td>

                        {{-- Status --}}
                        <td>

                            @if($item->status=='menunggu')

                                <span
                                    class="inline-flex px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">

                                    Menunggu

                                </span>

                            @elseif($item->status=='diproses')

                                <span
                                    class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">

                                    Diproses

                                </span>

                            @elseif($item->status=='selesai')

                                <span
                                    class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                                    Selesai

                                </span>

                            @elseif($item->status=='dibatalkan')

                                <span
                                    class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">

                                    Dibatalkan

                                </span>

                            @endif

                        </td>

                        {{-- Tanggal --}}
                        <td>

                            <div class="text-sm">

                                {{ $item->created_at->format('d M Y') }}

                            </div>

                            <div class="text-xs text-slate-500">

                                {{ $item->created_at->format('H:i') }}

                            </div>

                        </td>

                        {{-- Aksi --}}
                        <td>

                            <div class="flex flex-wrap gap-2">

                                {{-- Detail --}}
                                <a
                                    href="{{ route('admin.redeem.show',$item) }}"
                                    class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm">

                                    Detail

                                </a>

                                {{-- PROSES --}}
                                @if($item->status=='menunggu')
                                <a
                                    href="{{ route('admin.redeem.proses',$item) }}"
                                    class="px-3 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white text-sm">

                                    Verifikasi

                                </a>

                                @endif


                                {{-- BATALKAN --}}
                                @if(in_array($item->status,['menunggu']))

                                <button
                                    type="button"
                                    onclick="openCancelModal({{ $item->id }})"
                                    class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm">

                                    Batalkan

                                </button>

                                @endif

                            </div>


                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="text-6xl">

                                    🎁

                                </div>

                                <h3 class="mt-4 text-xl font-bold">

                                    Belum Ada Penukaran Reward

                                </h3>

                                <p class="text-slate-500 mt-2">

                                    Data penukaran reward akan muncul di halaman ini.

                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse
             </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="flex justify-end">

        {{ $redeem->links() }}

    </div>

</div>
<div
    id="cancelModal"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">

        <h3 class="text-xl font-bold mb-5">

            Batalkan Penukaran Reward

        </h3>

        <form
            id="cancelForm"
            method="POST">

            @csrf
            @method('PUT')

            <div>

                <label class="font-semibold">

                    Alasan Pembatalan

                </label>

                <textarea
                    name="catatan_admin"
                    rows="5"
                    required
                    class="w-full mt-2 border rounded-xl p-3"></textarea>

            </div>

            <div class="flex justify-end gap-3 mt-6">

                <button
                    type="button"
                    onclick="closeCancelModal()"
                    class="px-5 py-2 rounded-lg bg-slate-200">

                    Tutup

                </button>

                <button
                    class="px-5 py-2 rounded-lg bg-red-600 text-white">

                    Batalkan Reward

                </button>

            </div>

        </form>

    </div>

</div>
@endsection
@push('scripts')
<script>

function openCancelModal(id)
{
    document.getElementById('cancelModal').classList.remove('hidden');
    document.getElementById('cancelModal').classList.add('flex');

    document.getElementById('cancelForm').action =
        "{{ url('admin/redeem') }}/" + id + "/batalkan";
}

function closeCancelModal()
{
    document.getElementById('cancelModal').classList.remove('flex');
    document.getElementById('cancelModal').classList.add('hidden');
}

</script>
@endpush