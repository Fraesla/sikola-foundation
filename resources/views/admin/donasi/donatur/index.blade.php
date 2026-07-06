@extends('layouts.admin',['activePage'=>'donasi'])

@section('content')

<div class="space-y-8">


{{-- HEADER --}}
<div class="flex justify-between items-start">

    <div>

        <h1 class="text-4xl font-bold">

            Manajemen Donasi

        </h1>

        <p class="text-slate-500 mt-2">

            Kelola seluruh transaksi dan verifikasi donasi.

        </p>

    </div>

     <div>  
         <a href="{{ url()->previous() }}"class="px-6 py-3 rounded-2xl border">
            ← Kembali
        </a>
    </div>

</div>


{{-- STATISTIK --}}
<div class="grid lg:grid-cols-4 gap-6">

    <div class="admin-card p-6 rounded-3xl">

        <p class="text-slate-500">

            Total Donasi

        </p>

        <h2 class="text-4xl font-bold mt-3"
            style="color:var(--color-merah)">

            Rp {{ number_format($totalDonasi,0,',','.') }}

        </h2>

    </div>

    <div class="admin-card p-6 rounded-3xl">

        <p class="text-slate-500">

            Pending

        </p>

        <h2 class="text-4xl font-bold mt-3 text-yellow-500">

            {{ $pending }}

        </h2>

    </div>

    <div class="admin-card p-6 rounded-3xl">

        <p class="text-slate-500">

            Donatur Aktif

        </p>

        <h2 class="text-4xl font-bold mt-3 text-green-600">

            {{ $donaturAktif }}

        </h2>

    </div>

    <div class="admin-card p-6 rounded-3xl">

        <p class="text-slate-500">

            Langganan Aktif

        </p>

        <h2 class="text-4xl font-bold mt-3"
            style="color:var(--color-coklat)">

            {{ $langgananAktif }}

        </h2>

    </div>

</div>


{{-- FILTER --}}
<div class="admin-card p-6 rounded-3xl">

    <form>

        <div class="grid md:grid-cols-3 gap-4">

            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari donasi, program, donatur..."

                class="rounded-2xl border p-4">

            <select
                name="status"
                class="rounded-2xl border p-4">

                <option value="">

                    Semua Status

                </option>

                <option value="menunggu_pembayaran">

                    Menunggu Pembayaran

                </option>

                <option value="menunggu_verifikasi">

                    Menunggu Verifikasi

                </option>

                <option value="dikonfirmasi">

                    Berhasil

                </option>

                <option value="ditolak">

                    Ditolak

                </option>

            </select>

            <button
                class="rounded-2xl text-white"

                style="
                background:
                linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
                );
                ">

                Filter

            </button>

        </div>

    </form>

</div>

{{-- LIST DONASI --}}
<div class="space-y-6">

@foreach($donasis as $donasi)

<div
    class="admin-card p-7 rounded-[32px]
           border border-slate-100
           hover:shadow-2xl hover:-translate-y-1
           transition duration-300">

    <div class="grid lg:grid-cols-12 gap-8 items-center">

        {{-- ================================= --}}
        {{-- FOTO + IDENTITAS --}}
        {{-- ================================= --}}
        <div class="lg:col-span-4 flex gap-5 items-center">

            <img
                src="{{ asset('storage/'.$donasi->kategori->gambar) }}"
                class="w-28 h-28 rounded-[28px]
                       object-cover shadow-lg">

            <div>

                <div class="flex items-center gap-3 flex-wrap">

                    <span
                        class="px-4 py-2 rounded-full
                               text-sm font-bold"

                        style="
                            background: rgba(220,38,38,.08);
                            color: var(--color-merah);
                        ">

                        DON-{{ str_pad($donasi->id,6,'0',STR_PAD_LEFT) }}

                    </span>

                    {{-- STATUS --}}
                    @if($donasi->status=='menunggu' && !$donasi->bukti_transfer)

                        <span
                            class="px-4 py-2 rounded-full
                                   bg-yellow-100
                                   text-yellow-700
                                   text-sm font-semibold">

                            ⏳ Menunggu Pembayaran

                        </span>

                    @elseif($donasi->status=='menunggu')

                        <span
                            class="px-4 py-2 rounded-full
                                   bg-blue-100
                                   text-blue-700
                                   text-sm font-semibold">

                            🕒 Menunggu Verifikasi

                        </span>

                    @elseif($donasi->status=='dikonfirmasi')

                        <span
                            class="px-4 py-2 rounded-full
                                   bg-green-100
                                   text-green-700
                                   text-sm font-semibold">

                            ✔ Berhasil

                        </span>

                    @else

                        <span
                            class="px-4 py-2 rounded-full
                                   bg-red-100
                                   text-red-700
                                   text-sm font-semibold">

                            ✖ Ditolak

                        </span>

                    @endif

                </div>

                <h3 class="text-xl font-bold mt-4">

                    {{ $donasi->user->name }}

                </h3>

                <p class="text-slate-500 mt-1">

                    {{ $donasi->created_at->format('d F Y • H:i') }}

                </p>

                <div class="mt-5">

                    <h2
                        class="text-4xl font-bold"

                        style="color:var(--color-merah)">

                        Rp {{ number_format($donasi->jumlah,0,',','.') }}

                    </h2>

                    <p class="text-slate-600 mt-1">

                        Donasi {{ ucfirst($donasi->tipe) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- ================================= --}}
        {{-- DETAIL --}}
        {{-- ================================= --}}
        <div
            class="lg:col-span-4
                   border-l border-r
                   border-slate-100
                   px-8">

            <div class="grid gap-5">

                <div>

                    <small class="text-slate-400">

                        Program

                    </small>

                    <h4 class="font-bold text-lg mt-1">

                        {{ $donasi->kategori->nama }}

                    </h4>

                </div>

                <div>

                    <small class="text-slate-400">

                        Metode Pembayaran

                    </small>

                    <h4 class="font-semibold mt-1">

                        Transfer Manual

                    </h4>

                </div>

                <div>

                    <small class="text-slate-400">

                        Poin Reward

                    </small>

                    <h4
                        class="font-bold text-xl mt-1 text-green-600">

                        {{ floor($donasi->jumlah/10000) }} Poin

                    </h4>

                </div>

            </div>

        </div>


        {{-- ================================= --}}
        {{-- ACTION --}}
        {{-- ================================= --}}
        <div class="lg:col-span-4">

            <div class="flex flex-col gap-3">

                <div class="flex gap-2">

                    <a href="{{ route(
                        'admin.donasis.show',
                        $donasi->id
                    ) }}"
                       class="flex-1 text-center px-4 py-3
                              rounded-2xl border">

                        👁 Detail

                    </a>

                    @if($donasi->bukti_transfer)

                    <a href="{{ asset(
                        'storage/'.$donasi->bukti_transfer
                    ) }}"
                       target="_blank"

                       class="flex-1 text-center px-4 py-3
                              rounded-2xl
                              bg-blue-100
                              text-blue-700">

                        📄 Bukti

                    </a>

                    @endif

                </div>


                @if(
                    $donasi->status=='menunggu'
                    && $donasi->bukti_transfer
                )

                <div class="grid grid-cols-2 gap-2">

                    {{-- VERIFIKASI --}}
                    <form method="POST"
                          action="{{ route(
                            'admin.donasis.konfirmasi',
                            $donasi->id
                          ) }}">

                        @csrf

                        <button
                            onclick="return confirm(
                                'Apakah anda terima donasi ini ?'
                            )"

                            class="w-full px-4 py-3 rounded-2xl
                                   text-white font-semibold"

                            style="
                                background:
                                linear-gradient(
                                    135deg,
                                    #16a34a,
                                    #15803d
                                );
                            ">

                            ✔ Verifikasi

                        </button>

                    </form>


                    {{-- TOLAK --}}
                    <button
                        onclick="openRejectModal(
                            {{ $donasi->id }}
                        )"

                        class="px-4 py-3 rounded-2xl
                               bg-red-100
                               text-red-600
                               font-semibold">

                        ✖ Tolak

                    </button>

                </div>

                @endif


                {{-- STATUS SUDAH SELESAI --}}
                @if($donasi->status=='dikonfirmasi')

                <div class="w-full py-3 rounded-2xl
                            text-center
                            bg-green-100
                            text-green-700
                            font-bold">

                    ✅ Donasi Selesai

                </div>

                @endif

                @if($donasi->status=='ditolak')

                <div class="rounded-2xl p-4 bg-red-50">

                    <div class="font-bold text-red-600 mb-2">

                        ❌ Donasi Ditolak

                    </div>

                    <p class="text-sm text-slate-600">

                        {{ $donasi->alasan_tolak }}

                    </p>

                </div>

                @endif

            </div>

            {{-- ALASAN DITOLAK --}}
            @if($donasi->status=='ditolak'
                && $donasi->alasan_tolak)

            <div
                class="mt-5 p-4 rounded-2xl
                       bg-red-50 border border-red-100">

                <p class="font-semibold text-red-600">

                    Alasan Penolakan

                </p>

                <p class="text-sm mt-2 text-slate-600">

                    {{ $donasi->alasan_tolak }}

                </p>

            </div>

            @endif

        </div>

    </div>


    {{-- PROGRESS DONASI --}}
    <div class="mt-8">

        <div class="flex items-center gap-2">

            <div class="w-full h-2 rounded-full bg-slate-100">

                <div
                    class="h-2 rounded-full"

                    style="
                    width:
                    {{
                        $donasi->status=='dikonfirmasi'
                        ? '100%'
                        : ($donasi->bukti_transfer
                            ? '70%'
                            : '35%')
                    }};

                    background:
                    linear-gradient(
                        90deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                    ">
                </div>

            </div>

        </div>

    </div>

</div>

@endforeach

</div>


<div>

    {{ $donasis->links() }}

</div>


</div>
<div id="rejectModal"
     class="fixed inset-0 z-50 hidden">

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="relative flex items-center
                justify-center min-h-screen p-4">

        <div class="bg-white rounded-3xl
                    w-full max-w-lg p-8">

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

                    class="w-full mt-3 rounded-2xl
                           border p-4"

                    placeholder="Masukkan alasan penolakan..."></textarea>

                <div class="flex gap-3 mt-6">

                    <button
                        type="button"
                        onclick="closeRejectModal()"

                        class="flex-1 py-3 rounded-2xl
                               border">

                        Batal

                    </button>

                    <button
                        class="flex-1 py-3 rounded-2xl
                               text-white"

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
@endsection
@push('scripts')

<script>

function openRejectModal(id)
{
    document
        .getElementById('rejectModal')
        .classList.remove('hidden');

    document
        .getElementById('rejectForm')
        .action =
        '/admin/donasis/'+id+'/tolak';
}

function closeRejectModal()
{
    document
        .getElementById('rejectModal')
        .classList.add('hidden');
}

</script>

@endpush