@extends('layouts.admin', [
    'activePage' => 'pengguna'
])

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1
            class="text-3xl font-bold"
            style="color: var(--color-hitam);">

            Manajemen Pengguna

        </h1>

        <p
            class="mt-2"
            style="color: var(--color-coklat);">

            Kelola admin, relawan, donatur, dan member.

        </p>

    </div>

    <a href="{{ route('admin.pengguna.create') }}" class="px-5 py-3 rounded-xl text-white font-semibold"
    style="background-color: var(--color-merah);">
        + Tambah Pengguna
    </a>

</div>

<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="admin-card p-6">

        <p class="admin-muted">
            Total Pengguna
        </p>

        <h2 class="text-3xl font-bold mt-2">
            {{ $totalUser }}
        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Relawan
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color:#16a34a;">

             {{ $totalRelawan }}

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Donatur
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-merah);">

            {{ $totalDonatur }}

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Pembeli
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-kuning);">

            {{ $totalPembeli }}

        </h2>

    </div>

</div>

<div class="admin-card p-5 mb-6">

    <div class="flex flex-wrap gap-3">

        <button
            class="px-5 py-2 rounded-xl text-white"
            style="background-color: var(--color-merah);">

            Semua

        </button>

        <button
            class="px-5 py-2 rounded-xl"
            style="
                background: rgba(139,94,42,.1);
                color: var(--color-coklat);
            ">

            Admin

        </button>

        <button
            class="px-5 py-2 rounded-xl"
            style="
                background: rgba(22,163,74,.1);
                color:#16a34a;
            ">

            Relawan

        </button>

        <button
            class="px-5 py-2 rounded-xl"
            style="
                background: rgba(204,34,34,.1);
                color: var(--color-merah);
            ">

            Donatur

        </button>

        <button
            class="px-5 py-2 rounded-xl"
            style="
                background: rgba(204,34,34,.1);
                color: var(--color-kuning);
            ">

            Pembeli

        </button>

    </div>

</div>

<div class="admin-card overflow-hidden">

    <div
        class="px-6 py-5 border-b"
        style="border-color: rgba(212,160,23,.15);">

        <h3
            class="font-bold text-xl"
            style="color: var(--color-hitam);">

            Daftar Pengguna

        </h3>

    </div>

    <table class="w-full">

        <thead
            style="
                background:
                rgba(212,160,23,.08);
            ">

            <tr>

                <th class="p-4 text-left">Nama</th>
                <th class="p-4 text-left">Role</th>
                <th class="p-4 text-left">Poin</th>
                <th class="p-4 text-left">Tier</th>
                <th class="p-4 text-left">Status</th>
                <th class="p-4 text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

        @forelse($users as $user)

        <tr class="border-t">

            <td class="p-4">

                <div>
                    <div class="font-semibold">
                        {{ $user->name }}
                    </div>

                    <small class="text-slate-500">
                        {{ $user->email }}
                    </small>
                </div>

            </td>

            <td class="p-4">

                @php
                    $badge = [
                        'admin' => 'bg-red-100 text-red-700',
                        'relawan' => 'bg-green-100 text-green-700',
                        'donatur' => 'bg-blue-100 text-blue-700',
                        'pembeli' => 'bg-yellow-100 text-yellow-700',
                    ];
                @endphp

                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $badge[$user->role] ?? 'bg-slate-100' }}">
                    {{ ucfirst($user->role) }}
                </span>

            </td>

            <td class="p-4">
                {{ number_format($user->total_poin) }}
            </td>

            <td class="p-4">

                @if($user->tier)

                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold"
                        style="
                            background: rgba(212,160,23,.15);
                            color: var(--color-kuning);
                        ">

                        {{ $user->tier->nama }}

                    </span>

                @else

                    <span class="text-slate-400">
                        -
                    </span>

                @endif

            </td>

            <td class="p-4">

                @if($user->is_active)

                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">

                        Aktif

                    </span>

                @else

                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">

                        Nonaktif

                    </span>

                @endif

            </td>

            <td class="p-4 text-center">

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('admin.pengguna.show',$user->id) }}"
                           class="px-4 py-2 rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition">
                            Detail
                        </a>

                        <a href="{{ route('admin.pengguna.edit',$user->id) }}" class="px-4 py-2 rounded-xl bg-yellow-500 text-white">
                            Edit
                        </a>

                        @if($user->is_active)

                            <form action="{{ route('admin.pengguna.nonaktif',$user->id) }}"
                                  method="POST">

                                @csrf

                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-xl font-semibold transition hover:opacity-90"
                                    style="
                                        background: linear-gradient(135deg,#ef4444,#dc2626);
                                        color:white;
                                    " onsubmit="return confirm('Yakin noaktifkan pengguna ini?')">

                                    🔒 Nonaktifkan

                                </button>

                            </form>

                        @else

                            <form action="{{ route('admin.pengguna.aktif',$user->id) }}"
                                  method="POST">

                                @csrf

                                <button
                                    type="submit"
                                    class="px-4 py-2 rounded-xl font-semibold transition hover:opacity-90"
                                    style="
                                        background: linear-gradient(135deg,#22c55e,#16a34a);
                                        color:white;
                                    " onsubmit="return confirm('Yakin aktifkan pengguna ini ?')">

                                    ✅ Aktifkan

                                </button>

                            </form>

                        @endif
                        <form action="{{ route('admin.pengguna.destroy',$user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                                <button class="px-4 py-2 rounded-xl bg-red-600 text-white">Hapus</button>

                        </form>

                    </div>

                </td>

        </tr>

        @empty

        <tr>

            <td colspan="6" class="text-center py-10">

                <div class="flex flex-col items-center">

                    <div class="text-5xl mb-3">
                        👥
                    </div>

                    <h3 class="font-bold text-lg">
                        Belum ada pengguna
                    </h3>

                    <p class="text-slate-500">
                        Data pengguna akan muncul di sini.
                    </p>

                </div>

            </td>

        </tr>

        @endforelse

        </tbody>
</table>

</div>

@endsection