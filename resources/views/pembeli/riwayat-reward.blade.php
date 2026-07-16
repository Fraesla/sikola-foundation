@extends('layouts.pembeli',[
    'activePage' => 'reward'
])

@section('title','Riwayat Reward')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="rounded-3xl bg-gradient-to-r from-red-600 to-yellow-500 p-8 text-white">

        <p class="uppercase tracking-[5px] text-sm font-semibold">
            Reward
        </p>

        <h1 class="text-4xl font-black mt-3">
            Riwayat Penukaran Reward
        </h1>

        <p class="mt-3 text-lg opacity-90 max-w-3xl">
            Semua permintaan penukaran reward yang pernah Anda lakukan.
        </p>

    </div>

    {{-- Summary --}}
    <div class="grid md:grid-cols-4 gap-6">

        <div class="card-admin p-6">

            <p class="text-slate-500">
                Total Redeem
            </p>

            <h2 class="text-4xl font-black mt-3">

                {{ $redeem->total() }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="text-slate-500">
                Menunggu
            </p>

            <h2 class="text-4xl font-black text-yellow-600 mt-3">

                {{ $redeem->where('status','menunggu')->count() }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="text-slate-500">
                Diproses
            </p>

            <h2 class="text-4xl font-black text-blue-600 mt-3">

                {{ $redeem->where('status','diproses')->count() }}

            </h2>

        </div>

        <div class="card-admin p-6">

            <p class="text-slate-500">
                Selesai
            </p>

            <h2 class="text-4xl font-black text-green-600 mt-3">

                {{ $redeem->where('status','selesai')->count() }}

            </h2>

        </div>

    </div>
        {{-- Daftar Riwayat --}}
    <div class="space-y-6">

        @forelse($redeem as $item)

            <div class="card-admin p-6">

                <div class="grid lg:grid-cols-5 gap-6">

                    {{-- Gambar --}}
                    <div>

                        @if($item->reward->gambar)

                            <img
                                src="{{ asset('storage/'.$item->reward->gambar) }}"
                                class="w-full h-44 rounded-2xl object-cover">

                        @else

                            <div class="w-full h-44 rounded-2xl bg-slate-100 flex items-center justify-center text-6xl">

                                🎁

                            </div>

                        @endif

                    </div>

                    {{-- Informasi --}}
                    <div class="lg:col-span-3">

                        <div class="flex items-start justify-between">

                            <div>

                                <h2 class="text-2xl font-bold">

                                    {{ $item->reward->nama }}

                                </h2>

                                <p class="text-slate-500 mt-1">

                                    Kode :
                                    <b>{{ $item->kode }}</b>

                                </p>

                            </div>

                            {{-- Status --}}
                            @switch($item->status)

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

                        <div class="grid md:grid-cols-2 gap-5 mt-6">

                            <div>

                                <p class="text-slate-500 text-sm">
                                    Kategori
                                </p>

                                <p class="font-semibold">
                                    {{ $item->reward->kategori }}
                                </p>

                            </div>

                            <div>

                                <p class="text-slate-500 text-sm">
                                    Qty
                                </p>

                                <p class="font-semibold">
                                    {{ $item->qty }}
                                </p>

                            </div>

                            <div>

                                <p class="text-slate-500 text-sm">
                                    Poin / Item
                                </p>

                                <p class="font-semibold">

                                    {{ number_format($item->poin) }}

                                </p>

                            </div>

                            <div>

                                <p class="text-slate-500 text-sm">
                                    Total Poin
                                </p>

                                <p class="font-bold text-red-600">

                                    {{ number_format($item->total_poin) }}

                                </p>

                            </div>

                            <div>

                                <p class="text-slate-500 text-sm">
                                    Tanggal Penukaran
                                </p>

                                <p>

                                    {{ $item->created_at->format('d M Y H:i') }}

                                </p>

                            </div>

                            <div>

                                <p class="text-slate-500 text-sm">
                                    Diproses
                                </p>

                                <p>

                                    {{ optional($item->diproses_at)->format('d M Y H:i') ?? '-' }}

                                </p>

                            </div>

                        </div>

                        {{-- Catatan User --}}
                        @if($item->catatan_user)

                            <div class="mt-5">

                                <p class="text-slate-500 text-sm mb-1">

                                    Catatan Anda

                                </p>

                                <div class="rounded-xl bg-slate-50 p-4">

                                    {{ $item->catatan_user }}

                                </div>

                            </div>

                        @endif

                        {{-- Catatan Admin --}}
                        @if($item->catatan_admin)

                            <div class="mt-4">

                                <p class="text-slate-500 text-sm mb-1">

                                    Catatan Admin

                                </p>

                                <div class="rounded-xl bg-blue-50 p-4">

                                    {{ $item->catatan_admin }}

                                </div>

                            </div>

                        @endif

                    </div>

                    {{-- Sidebar --}}
                    <div class="space-y-4">
                                                {{-- Bukti Penyerahan --}}
                        @if($item->bukti_penyerahan)

                            <div>

                                <p class="text-sm text-slate-500 mb-2">
                                    Bukti Penyerahan
                                </p>

                                <a
                                    href="{{ asset('storage/'.$item->bukti_penyerahan) }}"
                                    target="_blank">

                                    <img
                                        src="{{ asset('storage/'.$item->bukti_penyerahan) }}"
                                        class="rounded-xl border hover:opacity-90 transition">

                                </a>

                            </div>

                        @endif

                        {{-- Informasi Pengiriman --}}
                        @if($item->ekspedisi)

                            <div class="rounded-xl bg-slate-50 p-4">

                                <p class="text-xs uppercase text-slate-500">

                                    Ekspedisi

                                </p>

                                <p class="font-semibold mt-1">

                                    {{ $item->ekspedisi }}

                                </p>

                            </div>

                        @endif

                        @if($item->nomor_resi)

                            <div class="rounded-xl bg-slate-50 p-4">

                                <p class="text-xs uppercase text-slate-500">

                                    Nomor Resi

                                </p>

                                <p class="font-bold break-all mt-1">

                                    {{ $item->nomor_resi }}

                                </p>

                            </div>

                        @endif

                        @if($item->selesai_at)

                            <div class="rounded-xl bg-green-50 p-4">

                                <p class="text-xs uppercase text-green-600">

                                    Diselesaikan

                                </p>

                                <p class="font-semibold mt-1">

                                    {{ $item->selesai_at->format('d M Y H:i') }}

                                </p>

                            </div>

                        @endif

                        <a
                            href="{{ route(auth()->user()->role.'.reward.riwayat.show',$item->id) }}"
                            class="w-full block text-center py-3 rounded-xl bg-gradient-to-r from-red-600 to-yellow-500 text-white font-semibold hover:shadow-lg transition">

                            Detail Reward

                        </a>
                        @if($item->status == 'diproses')
                            <form
                                action="{{ route(auth()->user()->role.'.reward.riwayat.selesai',$item) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <button
                                    class="px-5 py-2 rounded-xl bg-green-600 text-white hover:bg-green-700">

                                    ✔ Reward Sudah Diterima

                                </button>

                            </form>

                        @endif
                        @if($item->status == 'menunggu')

                            <button type="button" onclick="openCancelModal({{ $item->id }})" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                                Batalkan
                            </button>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="card-admin p-16 text-center">

                <div class="text-7xl">

                    🎁

                </div>

                <h2 class="text-2xl font-bold mt-5">

                    Belum Ada Riwayat Reward

                </h2>

                <p class="text-slate-500 mt-3">

                    Anda belum pernah menukarkan poin menjadi reward.

                </p>

                <a
                    href="{{ route(auth()->user()->role.'.reward.index') }}"
                    class="inline-flex mt-6 px-6 py-3 rounded-xl bg-gradient-to-r from-red-600 to-yellow-500 text-white font-semibold">

                    Lihat Reward

                </a>

            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    <div>

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
                    name="catatan_user"
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
        "{{ url('pembeli/reward/riwayat') }}/" + id + "/batalkan";
}

function closeCancelModal()
{
    document.getElementById('cancelModal').classList.remove('flex');
    document.getElementById('cancelModal').classList.add('hidden');
}

</script>
@endpush