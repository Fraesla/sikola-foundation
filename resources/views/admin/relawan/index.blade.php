@extends('layouts.admin', [
    'activePage' => 'relawan'
])

@section('content')

<!-- HEADER -->
<div class="mb-8">

    <span
        class="uppercase tracking-[4px] text-xs font-semibold"
        style="color: var(--color-kuning);">

        Volunteer Center

    </span>

    <h1
        class="text-4xl font-bold mt-2"
        style="color: var(--color-hitam);">

        Verifikasi Relawan

    </h1>

    <p
        class="mt-2"
        style="color: var(--color-coklat);">

        Kelola pendaftaran volunteer, verifikasi dokumen,
        dan persetujuan anggota relawan.

    </p>

</div>

<!-- STATISTIK -->
<div class="grid md:grid-cols-3 gap-6 mb-8">

    <div
        class="rounded-3xl p-6"
        style="
            background: white;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--color-kuning);
        ">

        <p style="color: var(--color-coklat);">
            Total Pendaftar
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            {{ $totalPendaftar }}

        </h2>

    </div>

    <div
        class="rounded-3xl p-6"
        style="
            background: white;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--color-merah);
        ">

        <p style="color: var(--color-coklat);">
            Menunggu Verifikasi
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            {{ $menunggu }}

        </h2>

    </div>

    <div
        class="rounded-3xl p-6"
        style="
            background: white;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--color-coklat);
        ">

        <p style="color: var(--color-coklat);">
            Relawan Aktif
        </p>

        <h2
            class="text-4xl font-bold mt-3"
            style="color: var(--color-merah);">

            {{ $aktif }}

        </h2>

    </div>

</div>

<!-- TABLE -->
<div
    class="rounded-3xl overflow-hidden"
    style="
        background: white;
        box-shadow: var(--shadow);
    ">

    <div
        class="h-2"
        style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
        ">
    </div>

    <div class="p-6 border-b">

        <h3
            class="text-xl font-bold"
            style="color: var(--color-hitam);">

            Daftar Verifikasi Relawan

        </h3>

    </div>

    <table class="w-full">

        <thead
            style="
                background-color:
                rgba(212,160,23,.08);
            ">

            <tr>

                <th class="p-4 text-left">
                    Nama
                </th>

                <th class="p-4 text-left">
                    Email
                </th>

                <th class="p-4 text-left">
                    Dokumen
                </th>

                <th class="p-4 text-left">
                    Status
                </th>

                <th class="p-4 text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

        @forelse($relawans as $item)

        <tr class="border-t"
            style="border-color: rgba(212,160,23,.15);">

            <td class="p-4">

                <div>
                    <div class="font-semibold">
                        {{ $item->user->name ?? '-' }}
                    </div>

                    <small class="text-slate-500">
                        NIK : {{ $item->nik }}
                    </small>
                </div>

            </td>

            <td class="p-4">
                {{ $item->user->email ?? '-' }}
            </td>

            <td class="p-4">

                @if($item->foto_ktp)

                    <a href="{{ route('admin.relawans.ktp', $item->id) }}"
                       target="_blank"
                       style="color: var(--color-merah);">

                        👁 Preview KTP

                    </a>

                @else

                    <span class="text-slate-400">
                        Tidak ada file
                    </span>

                @endif

            </td>

            <td class="p-4">

                @if($item->status == 'menunggu')

                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold"
                        style="
                            background: rgba(212,160,23,.15);
                            color: var(--color-coklat);
                        ">

                        Pending

                    </span>

                @elseif($item->status == 'disetujui')

                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">

                        Disetujui

                    </span>

                @else

                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">

                        Ditolak

                    </span>

                @endif

            </td>

            <td class="p-4">

                <div class="flex items-center justify-center gap-2">

                    {{-- Tombol Detail --}}
                    <a href="{{ route('admin.relawans.show',$item->id) }}"
                       class="px-4 py-2 rounded-xl font-semibold text-sm transition hover:opacity-90"
                       style="
                            background: #2563eb;
                            color: white;
                       ">

                        🔍 Detail

                    </a>

                    @if($item->status == 'menunggu')

                        {{-- Tombol Setujui --}}
                        <form
                            action="{{ route('admin.relawans.setujui',$item->id) }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                onclick="return confirm('Apakah terima relawan jadi ini ?')"
                                class="px-4 py-2 rounded-xl font-semibold text-sm transition hover:opacity-90"
                                style="
                                    background: var(--color-kuning);
                                    color: var(--color-hitam);
                                ">

                                ✅ Setujui

                            </button>

                        </form>

                        {{-- Tombol Tolak --}}
                        <form
                            action="{{ route('admin.relawans.tolak',$item->id) }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                onclick="return confirm('Tolak relawan ini?')"
                                class="px-4 py-2 rounded-xl font-semibold text-sm transition hover:opacity-90"
                                style="
                                    background: var(--color-merah);
                                    color: white;
                                ">

                                ❌ Tolak

                            </button>

                        </form>

                    @endif

                </div>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="5" class="text-center py-10">

                <div class="flex flex-col items-center">

                    <div class="text-5xl mb-3">
                        🙋
                    </div>

                    <h3 class="font-bold text-lg">
                        Belum ada pendaftar relawan
                    </h3>

                    <p class="text-slate-500">
                        Data relawan akan muncul di sini.
                    </p>

                </div>

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection