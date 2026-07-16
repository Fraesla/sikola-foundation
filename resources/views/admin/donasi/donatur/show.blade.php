@extends('layouts.admin',['activePage'=>'donasi'])

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- HEADER --}}
    <div class="admin-card p-8 rounded-[32px]">

        <div class="flex flex-col lg:flex-row justify-between gap-6">

            <div>

                <div class="flex items-center gap-3 mb-4">

                    <span class="px-4 py-2 rounded-full
                                 bg-red-100 text-red-600
                                 font-bold">

                        DON-{{ str_pad($donasi->id,6,'0',STR_PAD_LEFT) }}

                    </span>

                    @if($donasi->status=='menunggu' && !$donasi->bukti_transfer)

                        <span class="px-4 py-2 rounded-full
                                     bg-yellow-100
                                     text-yellow-700">

                            ⏳ Menunggu Pembayaran

                        </span>

                    @elseif($donasi->status=='menunggu')

                        <span class="px-4 py-2 rounded-full
                                     bg-blue-100
                                     text-blue-700">

                            🔎 Menunggu Verifikasi

                        </span>

                    @elseif($donasi->status=='dikonfirmasi')

                        <span class="px-4 py-2 rounded-full
                                     bg-green-100
                                     text-green-700">

                            ✅ Berhasil

                        </span>

                    @else

                        <span class="px-4 py-2 rounded-full
                                     bg-red-100
                                     text-red-700">

                            ❌ Ditolak

                        </span>

                    @endif

                </div>

                <h1 class="text-4xl font-bold">

                    Detail Donasi

                </h1>

                <p class="text-slate-500 mt-2">

                    Dibuat pada
                    {{ $donasi->created_at->format('d F Y H:i') }}

                </p>

            </div>

            <div>

                <a href="{{ url()->previous() }}"
                   class="px-6 py-3 rounded-2xl border">

                    ← Kembali

                </a>

            </div>

        </div>

    </div>


    <div class="grid lg:grid-cols-3 gap-8">

        {{-- KIRI --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- DETAIL DONATUR --}}
            <div class="admin-card p-8 rounded-[32px]">

                <h3 class="text-2xl font-bold mb-8">

                    Informasi Donatur

                </h3>

                <div class="grid md:grid-cols-2 gap-8">

                    <div>

                        <small class="text-slate-400">
                            Nama Donatur
                        </small>

                        <h4 class="font-bold text-xl mt-1">

                            {{ $donasi->user->name }}

                        </h4>

                    </div>

                    <div>

                        <small class="text-slate-400">
                            Email
                        </small>

                        <h4 class="font-semibold mt-1">

                            {{ $donasi->user->email }}

                        </h4>

                    </div>

                    <div>

                        <small class="text-slate-400">
                            Program Donasi
                        </small>

                        <h4 class="font-bold mt-1">

                            {{ $donasi->kategori->nama ?? '-' }}

                        </h4>

                    </div>

                    <div>

                        <small class="text-slate-400">
                            Jenis Donasi
                        </small>

                        <h4 class="font-bold mt-1">

                            {{ ucfirst($donasi->tipe) }}

                        </h4>

                    </div>

                    <div>

                        <small class="text-slate-400">
                            Nominal
                        </small>

                        <h2 class="font-bold text-4xl mt-1"
                            style="color:var(--color-merah)">

                            Rp {{ number_format($donasi->jumlah,0,',','.') }}

                        </h2>

                    </div>

                    <div>

                        <small class="text-slate-400">
                            Poin Reward
                        </small>

                        <h2 class="font-bold text-3xl mt-1 text-green-600">

                            {{ floor($donasi->jumlah/10000) }} Poin

                        </h2>

                    </div>

                </div>

            </div>


            {{-- PESAN --}}
            @if($donasi->pesan)

            <div class="admin-card p-8 rounded-[32px]">

                <h3 class="text-2xl font-bold mb-5">

                    Pesan Donatur

                </h3>

                <div class="rounded-3xl bg-slate-50 p-6">

                    {{ $donasi->pesan }}

                </div>

            </div>

            @endif


            {{-- BUKTI TRANSFER --}}
            <div class="admin-card p-8 rounded-[32px]">

                <h3 class="text-2xl font-bold mb-6">

                    Bukti Transfer

                </h3>

                @if($donasi->bukti_transfer)

                    <img
                        src="{{ asset('storage/'.$donasi->bukti_transfer) }}"
                        class="w-full rounded-[28px] shadow">

                    <a href="{{ asset('storage/'.$donasi->bukti_transfer) }}"
                       target="_blank"

                       class="mt-5 inline-block
                              px-6 py-3 rounded-2xl
                              bg-blue-100 text-blue-700">

                        🔍 Lihat Full Size

                    </a>

                @else

                    <div class="text-center py-20">

                        <div class="text-7xl mb-4">

                            📄

                        </div>

                        <p class="text-slate-500">

                            Belum upload bukti transfer

                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- SIDEBAR --}}
        <div class="space-y-8">

            {{-- STATUS --}}
            <div class="admin-card p-8 rounded-[32px]">

                <h3 class="text-2xl font-bold mb-6">

                    Status Donasi

                </h3>

                <div class="space-y-5">

                    <div class="flex gap-3">

                        <div class="w-10 h-10 rounded-full
                                    bg-green-100
                                    flex items-center justify-center">

                            ✓

                        </div>

                        <div>

                            <h4 class="font-bold">

                                Donasi Dibuat

                            </h4>

                            <small>

                                {{ $donasi->created_at->format('d M Y H:i') }}

                            </small>

                        </div>

                    </div>

                    <div class="flex gap-3">

                        <div class="w-10 h-10 rounded-full
                                    bg-blue-100
                                    flex items-center justify-center">

                            📤

                        </div>

                        <div>

                            <h4 class="font-bold">

                                Bukti Transfer

                            </h4>

                            <small>

                                {{ $donasi->bukti_transfer
                                    ? 'Sudah Upload'
                                    : 'Belum Upload' }}

                            </small>

                        </div>

                    </div>

                    @if($donasi->dikonfirmasi_at)

                    <div class="flex gap-3">

                        <div class="w-10 h-10 rounded-full
                                    bg-green-100
                                    flex items-center justify-center">

                            ✔

                        </div>

                        <div>

                            <h4 class="font-bold">

                                Diverifikasi

                            </h4>

                            <small>

                                

                            </small>

                        </div>

                    </div>

                    @endif

                </div>

            </div>


            {{-- AKSI --}}
            @if(
                $donasi->status=='menunggu'
                && $donasi->bukti_transfer
            )

            <div class="admin-card p-8 rounded-[32px]">

                <h3 class="font-bold text-xl mb-5">

                    Aksi Admin

                </h3>

                <div class="space-y-3">

                    <form method="POST"
                          action="{{ route('admin.donasis.konfirmasi',$donasi->id) }}">

                        @csrf

                        <button
                            onclick="return confirm(
                                'Apakah anda terima donasi ini ?'
                            )"
                            class="w-full py-4 rounded-2xl
                                   text-white font-bold"

                            style="
                                background:
                                linear-gradient(
                                    135deg,
                                    #16a34a,
                                    #15803d
                                );
                            ">

                            ✔ Konfirmasi Donasi

                        </button>

                    </form>

                    <button
                        onclick="openRejectModal({{ $donasi->id }})"

                        class="w-full py-4 rounded-2xl
                               bg-red-100
                               text-red-600
                               font-bold">

                        ✖ Tolak Donasi

                    </button>

                </div>

            </div>

            @endif


            {{-- ALASAN --}}
            @if(
                $donasi->status=='ditolak'
                && $donasi->alasan_tolak
            )

            <div class="admin-card p-8 rounded-[32px]">

                <h3 class="font-bold text-red-600 mb-4">

                    Alasan Penolakan

                </h3>

                <div class="bg-red-50 p-5 rounded-2xl">

                    {{ $donasi->alasan_tolak }}

                </div>

            </div>

            @endif

        </div>

    </div>

</div>
<div id="rejectModal"
     class="fixed inset-0 z-50 hidden">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative flex items-center justify-center min-h-screen p-4">

        <div class="bg-white rounded-[32px]
                    p-8 w-full max-w-lg">

            <h2 class="text-2xl font-bold mb-6">
                Tolak Donasi
            </h2>

            <form id="rejectForm" method="POST">

                @csrf

                <label class="font-semibold">
                    Alasan Penolakan
                </label>

                <textarea
                    name="alasan_tolak"
                    rows="5"
                    required
                    class="w-full border rounded-2xl p-4 mt-3"
                    placeholder="Masukkan alasan penolakan..."></textarea>

                <div class="flex gap-3 mt-6">

                    <button type="button"
                            onclick="closeRejectModal()"
                            class="flex-1 py-3 rounded-2xl border">

                        Batal

                    </button>

                    <button
                        class="flex-1 py-3 rounded-2xl text-white"

                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

function openRejectModal(id)
{
    document
        .getElementById('rejectModal')
        .classList.remove('hidden');

    document
        .getElementById('rejectForm')
        .action = '/admin/donasis/' + id + '/tolak';
}

function closeRejectModal()
{
    document
        .getElementById('rejectModal')
        .classList.add('hidden');
}

</script>

@endsection