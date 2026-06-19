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

    <button
        class="px-5 py-3 rounded-xl text-white font-semibold"
        style="background-color: var(--color-merah);">

        + Tambah Pengguna

    </button>

</div>

<div class="grid md:grid-cols-4 gap-6 mb-8">

    <div class="admin-card p-6">

        <p class="admin-muted">
            Total Pengguna
        </p>

        <h2 class="text-3xl font-bold mt-2">
            356
        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Relawan
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color:#16a34a;">

            145

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Donatur
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-merah);">

            98

        </h2>

    </div>

    <div class="admin-card p-6">

        <p class="admin-muted">
            Member Aktif
        </p>

        <h2
            class="text-3xl font-bold mt-2"
            style="color: var(--color-kuning);">

            113

        </h2>

    </div>

</div>

<<div class="admin-card p-5 mb-6">

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

<tr class="border-t">

    <td class="p-4">
        Farhan
    </td>

    <td class="p-4">
        Volunteer
    </td>

    <td class="p-4">
        250
    </td>

    <td class="p-4">

        <span
            class="px-3 py-1 rounded-full text-sm font-semibold"
            style="
            background: rgba(212,160,23,.15);
            color: var(--color-kuning);
            ">

        Gold

        </span>

    </td>

    <td class="p-4">

        <span
class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">

Aktif

</span>

    </td>

    <td class="p-4">

        <button
class="px-4 py-2 rounded-lg text-white ml-2"
style="background-color: var(--color-merah);">

Nonaktifkan

</button>

    </td>

</tr>

<tr class="border-t">

    <td class="p-4">
        Farhan
    </td>

    <td class="p-4">
        Volunteer
    </td>

    <td class="p-4">
        250
    </td>

    <td class="p-4">

        <span
        class="px-3 py-1 rounded-full text-sm font-semibold bg-slate-100 text-slate-600">

        Silver

        </span>

    </td>

    <td class="p-4">

        <span
class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">

Aktif

</span>

    </td>

    <td class="p-4">

        <button
class="px-4 py-2 rounded-lg text-white ml-2"
style="background-color: var(--color-merah);">

Nonaktifkan

</button>

    </td>

</tr>

<tr class="border-t">

    <td class="p-4">
        Farhan
    </td>

    <td class="p-4">
        Volunteer
    </td>

    <td class="p-4">
        250
    </td>

    <td class="p-4">

        <span
            class="px-3 py-1 rounded-full text-sm font-semibold"
            style="
            background: rgba(139,94,42,.1);
            color: var(--color-coklat);
            ">

            Bronze

        </span>

    </td>

    <td class="p-4">

        <span
class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">

Aktif

</span>

    </td>

    <td class="p-4">

        <button
class="px-4 py-2 rounded-lg text-white ml-2"
style="background-color: var(--color-merah);">

Nonaktifkan

</button>

    </td>

</tr>

</tbody>

</table>

</div>

@endsection