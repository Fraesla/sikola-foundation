@extends('layouts.admin', ['activePage' => 'event'])

@section('content')

<style>
/* ==========================
   STATISTIC
========================== */

.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:40px;
}

@media(max-width:1200px){
    .stats-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:768px){
    .stats-grid{
        grid-template-columns:1fr;
    }
}

.stat-card{
    background:#fff;
    border-radius:22px;
    padding:24px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.3s;
    position:relative;
    overflow:hidden;
}

.stat-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 35px rgba(0,0,0,.15);
}

.stat-card::before{
    content:"";
    position:absolute;
    left:0;
    top:0;
    width:6px;
    height:100%;
}

.stat-red::before{
    background:#dc2626;
}

.stat-yellow::before{
    background:#f59e0b;
}

.stat-green::before{
    background:#16a34a;
}

.stat-blue::before{
    background:#2563eb;
}

.stat-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.stat-title{
    color:#64748b;
    font-size:15px;
    font-weight:600;
}

.stat-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
}

.icon-red{
    background:#fee2e2;
}

.icon-yellow{
    background:#fef3c7;
}

.icon-green{
    background:#dcfce7;
}

.icon-blue{
    background:#dbeafe;
}

.stat-value{
    font-size:42px;
    font-weight:800;
    color:#0f172a;
    line-height:1;
    margin-bottom:10px;
}

.stat-desc{
    color:#64748b;
    font-size:14px;
}

.btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;

    padding:12px 28px;

    border-radius:14px;

    font-size:15px;
    font-weight:600;

    color:#fff !important;
    text-decoration:none !important;

    background:linear-gradient(
        135deg,
        var(--color-merah),
        var(--color-coklat)
    );

    box-shadow:0 10px 25px rgba(181,101,29,.25);

    transition:.3s;
}

.btn-back:hover{
    color:#fff !important;
    transform:translateY(-2px);
    box-shadow:0 15px 35px rgba(181,101,29,.35);
}
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="container-fluid mb-4">

        <div class="row align-items-center">

            <div class="col-lg-8 col-md-8">

                <div class="text-uppercase fw-bold text-warning mb-2"
                     style="letter-spacing:4px;">
                    EVENT CENTER
                </div>

                <h1 class="page-title mb-2">
                    Registrasi Event
                </h1>

                <p class="page-subtitle mb-0">
                    Kelola seluruh pendaftaran peserta event,
                    konfirmasi kehadiran,
                    dan pemberian reward poin volunteer.
                </p>

            </div>

            <div class="col-lg-4 col-md-4 text-end">

                <a href="{{ url()->previous() }}"
                   onclick="return confirm('Kembali ke halaman sebelumnya?')"
                   class="btn-back">

                    <i class="fas fa-arrow-left me-2"></i>
                     ← Kembali

                </a>

            </div>

        </div>

    </div>

    {{-- =========================
    STATISTIK
    ========================= --}}

    <div class="bg-white rounded-4 shadow-sm overflow-hidden mb-5">

        <div class="stats-grid">

    {{-- Total --}}
    <div class="stat-card stat-red">

        <div class="stat-header">

            <div class="stat-title">
                Total Registrasi
            </div>

            <div class="stat-icon icon-red">
                👥
            </div>

        </div>

        <div class="stat-value">
            {{ $registrasi->total() }}
        </div>

        <div class="stat-desc">
            Semua peserta event
        </div>

    </div>

    {{-- Menunggu --}}
    <div class="stat-card stat-yellow">

        <div class="stat-header">

            <div class="stat-title">
                Menunggu
            </div>

            <div class="stat-icon icon-yellow">
                ⏳
            </div>

        </div>

        <div class="stat-value">
            {{ \App\Models\EventRegistrasi::where('status','mendaftar')->count() }}
        </div>

        <div class="stat-desc">
            Belum dikonfirmasi
        </div>

    </div>

    {{-- Hadir --}}
    <div class="stat-card stat-green">

        <div class="stat-header">

            <div class="stat-title">
                Sudah Hadir
            </div>

            <div class="stat-icon icon-green">
                ✅
            </div>

        </div>

        <div class="stat-value">
            {{ \App\Models\EventRegistrasi::where('status','hadir')->count() }}
        </div>

        <div class="stat-desc">
            Peserta hadir
        </div>

    </div>

    {{-- Reward --}}
    <div class="stat-card stat-blue">

        <div class="stat-header">

            <div class="stat-title">
                Reward Dibagikan
            </div>

            <div class="stat-icon icon-blue">
                🏆
            </div>

        </div>

        <div class="stat-value">
            {{ \App\Models\EventRegistrasi::sum('poin_diberikan') }}
        </div>

        <div class="stat-desc">
            Total poin diberikan
        </div>

    </div>

</div>

    </div>
    {{-- FILTER & SEARCH --}}
    <div class="bg-white rounded-[28px] shadow-lg p-8 mb-8 border border-slate-100">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h2 class="text-2xl font-bold"
                    style="color:var(--color-hitam)">

                    Filter Registrasi

                </h2>

                <p class="text-slate-500 mt-1">

                    Cari peserta berdasarkan nama, email, event ataupun status registrasi.

                </p>

            </div>

            <div
                class="hidden lg:flex items-center justify-center
                       w-14 h-14 rounded-2xl"

                style="
                    background:rgba(220,38,38,.08);
                    color:var(--color-merah);
                ">

                🔎

            </div>

        </div>


        <form method="GET">

            <div class="grid lg:grid-cols-4 gap-5">

                {{-- SEARCH --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">

                        Nama / Email

                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari peserta..."

                        class="w-full rounded-2xl border border-slate-200
                               px-5 py-4 focus:ring-2
                               focus:ring-red-500
                               focus:border-red-500">

                </div>


                {{-- STATUS --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">

                        Status

                    </label>

                    <select
                        name="status"

                        class="w-full rounded-2xl border border-slate-200
                               px-5 py-4">

                        <option value="">

                            Semua Status

                        </option>

                        <option
                            value="mendaftar"
                            @selected(request('status')=='mendaftar')>

                            Mendaftar

                        </option>

                        <option
                            value="hadir"
                            @selected(request('status')=='hadir')>

                            Hadir

                        </option>

                        <option
                            value="tidak_hadir"
                            @selected(request('status')=='tidak_hadir')>

                            Tidak Hadir

                        </option>

                    </select>

                </div>


                {{-- EVENT --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">

                        Event

                    </label>

                    <select
                        name="event"

                        class="w-full rounded-2xl border border-slate-200
                               px-5 py-4">

                        <option value="">

                            Semua Event

                        </option>

                        @foreach(\App\Models\Event::orderBy('judul')->get() as $event)

                            <option
                                value="{{ $event->id }}"
                                @selected(request('event')==$event->id)>

                                {{ $event->judul }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- BUTTON --}}
                <div
                    class="flex items-end gap-3">

                    <button

                        class="flex-1 py-4 rounded-2xl
                               text-white font-bold"

                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                        🔍 Cari

                    </button>


                    <a href="{{ route('admin.eventDaftar.index') }}"

                       class="px-6 py-4 rounded-2xl
                              border border-slate-200
                              font-semibold
                              hover:bg-slate-50">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- LIST REGISTRASI --}}
    <div class="bg-white rounded-[30px] shadow-lg overflow-hidden">

        <div
            class="px-8 py-6 border-b border-slate-100
                   flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold">

                    Data Registrasi Event

                </h2>

                <p class="text-slate-500 mt-1">

                    Total :

                    <b>{{ $registrasi->total() }}</b>

                    registrasi ditemukan.

                </p>

            </div>

        </div>
                <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-5 text-left font-bold">
                            Peserta
                        </th>

                        <th class="px-6 py-5 text-left font-bold">
                            Event
                        </th>

                        <th class="px-6 py-5 text-center font-bold">
                            Status
                        </th>

                        <th class="px-6 py-5 text-center font-bold">
                            Reward
                        </th>

                        <th class="px-6 py-5 text-center font-bold">
                            Tanggal
                        </th>

                        <th class="px-6 py-5 text-center font-bold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($registrasi as $item)

                <tr class="border-t hover:bg-slate-50 transition">

                    {{-- PESERTA --}}
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-4">

                            @if($item->user->foto ?? false)

                                <img
                                    src="{{ asset('storage/'.$item->user->foto) }}"
                                    class="w-16 h-16 rounded-2xl object-cover">

                            @else

                                <div
                                    class="w-16 h-16 rounded-2xl
                                           flex items-center justify-center
                                           text-white font-bold text-xl"

                                    style="
                                        background:
                                        linear-gradient(
                                            135deg,
                                            var(--color-merah),
                                            var(--color-coklat)
                                        );
                                    ">

                                    {{ strtoupper(substr($item->user->name,0,1)) }}

                                </div>

                            @endif

                            <div>

                                <h3 class="font-bold text-lg">

                                    {{ $item->user->name }}

                                </h3>

                                <p class="text-slate-500">

                                    {{ $item->user->email }}

                                </p>

                            </div>

                        </div>

                    </td>

                    {{-- EVENT --}}
                    <td class="px-6 py-5">

                        <div>

                            <h4 class="font-bold">

                                {{ $item->event->judul }}

                            </h4>

                            <small class="text-slate-500">

                                {{ $item->event->lokasi }}

                            </small>

                        </div>

                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-5 text-center">

                        @if($item->status=='mendaftar')

                            <span
                                class="px-4 py-2 rounded-full
                                       bg-yellow-100
                                       text-yellow-700
                                       font-semibold">

                                ⏳ Mendaftar

                            </span>

                        @elseif($item->status=='dikonfirmasi')

                            <span
                                class="px-4 py-2 rounded-full
                                       bg-green-100
                                       text-green-700
                                       font-semibold">

                                ✅ Konfirmasi

                            </span>
                        
                        @elseif($item->status=='hadir')

                            <span
                                class="px-4 py-2 rounded-full
                                       bg-green-100
                                       text-blue-700
                                       font-semibold">

                                ✅ Hadir

                            </span>

                        @elseif($item->status=='tidak_hadir')

                            <span
                                class="px-4 py-2 rounded-full
                                       bg-red-100
                                       text-red-700
                                       font-semibold">

                                ❌ Tidak Hadir

                            </span>

                        @else

                            <span
                                class="px-4 py-2 rounded-full
                                       bg-slate-100
                                       text-slate-600">

                                -

                            </span>

                        @endif

                    </td>

                    {{-- REWARD --}}
                    <td class="px-6 py-5 text-center">

                        @if($item->poin_diberikan)

                            <span
                                class="font-bold text-green-600">

                                +{{ $item->poin_diberikan }}

                            </span>

                        @else

                            <span class="text-slate-400">

                                -

                            </span>

                        @endif

                    </td>

                    {{-- TANGGAL --}}
                    <td class="px-6 py-5 text-center">

                        {{ $item->created_at->format('d M Y') }}

                        <br>

                        <small class="text-slate-400">

                            {{ $item->created_at->format('H:i') }}

                        </small>

                    </td>

                    {{-- AKSI --}}
                    <td class="px-6 py-5">

                        <div class="flex flex-wrap justify-center gap-2">

                            {{-- DETAIL EVENT --}}
                            <a href="{{ route('admin.eventDaftar.show',$item->id) }}"
                               class="px-4 py-2 rounded-xl border border-slate-300 hover:bg-slate-100 transition">

                                Detail

                            </a>

                            {{-- =========================
                                STATUS MENDAFTAR
                            ========================== --}}
                            @if($item->status == 'mendaftar')

                                {{-- KONFIRMASI --}}
                                <form
                                    action="{{ route('admin.events.konfirmasi',$item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah terima peserta ini mengikuti event?')">

                                    @csrf

                                    <button
                                        class="px-4 py-2 rounded-xl text-white shadow"

                                        style="
                                            background:
                                            linear-gradient(
                                                135deg,
                                                #16a34a,
                                                #22c55e
                                            );
                                        ">

                                        ✓ Konfirmasi

                                    </button>

                                </form>

                                {{-- TOLAK {{ route('admin.event_registrasi.tolak',$item->id) }}--}}
                                <form
                                    action="#"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menolak pendaftaran peserta ini?')">

                                    @csrf

                                    <button
                                        class="px-4 py-2 rounded-xl
                                               bg-red-100
                                               text-red-700
                                               hover:bg-red-200">

                                        ✕ Tolak

                                    </button>

                                </form>

                            @endif


                            {{-- =========================
                                SUDAH DIKONFIRMASI 
                            ========================== --}}
                            @if($item->status == 'dikonfirmasi')

                                {{-- HADIR --}}
                                <form
                                    action="{{ route('admin.events.hadir',['event'=>$item->event_id,'registrasi'=>$item->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin peserta hadir? Reward akan diberikan.')">

                                    @csrf

                                    <button
                                        class="px-4 py-2 rounded-xl text-white"

                                        style="
                                            background:
                                            linear-gradient(
                                                135deg,
                                                #16a34a,
                                                #22c55e
                                            );
                                        ">

                                        ✓ Hadir

                                    </button>

                                </form>

                                {{-- ALFA --}}
                                <form
                                    action="{{ route('admin.events.alfa',['event'=>$item->event_id,'registrasi'=>$item->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Peserta benar-benar tidak hadir?')">

                                    @csrf

                                    <button
                                        class="px-4 py-2 rounded-xl
                                               bg-red-100
                                               text-red-700
                                               hover:bg-red-200">

                                        ✕ Alfa

                                    </button>

                                </form>

                            @endif


                            {{-- =========================
                                SUDAH HADIR {{ route('admin.event_registrasi.reward',$item->id) }}
                            ========================== --}}
                           <!--  @if($item->status == 'hadir' && !$item->poin_diberikan)

                                <form
                                    action="#"
                                    method="POST"
                                    onsubmit="return confirm('Berikan reward kepada peserta?')">

                                    @csrf

                                    <button
                                        class="px-4 py-2 rounded-xl text-white"

                                        style="
                                            background:
                                            linear-gradient(
                                                135deg,
                                                var(--color-merah),
                                                var(--color-coklat)
                                            );
                                        ">

                                        ⭐ Reward

                                    </button>

                                </form>

                            @endif -->

                        </div>

                    </td>

                </tr>

                @empty
                <tr>

                        <td colspan="6" class="py-20 text-center">

                            <div class="flex justify-center mb-6">

                                <div
                                    class="w-28 h-28 rounded-full
                                           flex items-center justify-center
                                           text-5xl"

                                    style="
                                        background:
                                        linear-gradient(
                                            135deg,
                                            rgba(220,38,38,.08),
                                            rgba(181,101,29,.08)
                                        );
                                    ">

                                    📅

                                </div>

                            </div>

                            <h3 class="text-3xl font-bold">

                                Belum Ada Registrasi Event

                            </h3>

                            <p class="text-slate-500 mt-3 max-w-xl mx-auto">

                                Saat ini belum ada peserta yang melakukan
                                registrasi event. Seluruh data registrasi akan
                                tampil di halaman ini beserta status kehadiran
                                dan reward poin.

                            </p>

                            <a
                                href="{{ route('admin.events.index') }}"
                                class="inline-flex items-center gap-2
                                       mt-8 px-8 py-4 rounded-2xl
                                       text-white font-semibold"

                                style="
                                    background:
                                    linear-gradient(
                                        135deg,
                                        var(--color-merah),
                                        var(--color-coklat)
                                    );
                                ">

                                📅 Kelola Event

                            </a>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- PAGINATION --}}
    @if($registrasi->hasPages())

    <div class="mt-10">

        {{ $registrasi->withQueryString()->links() }}

    </div>

    @endif

</div>

@endsection
