@php
    $detail = $detail ?? false;
@endphp

<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">

    <div>

        <span
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-600">

            📋 {{ $detail ? 'Detail Registrasi' : 'Manajemen Registrasi Event' }}

        </span>

        <h1
            class="text-4xl font-black mt-3"
            style="color:var(--color-hitam);">

            {{ $detail ? 'Detail Peserta Event' : 'Daftar Registrasi Peserta' }}

        </h1>

        <p
            class="mt-3 text-lg max-w-3xl"
            style="color:var(--color-coklat);">

            @if($detail)

                Informasi lengkap peserta yang mendaftar pada event volunteer.

            @else

                Kelola seluruh registrasi peserta, lakukan konfirmasi, penolakan,
                dan pantau kuota event.

            @endif

        </p>

    </div>

    <div class="flex gap-3 flex-wrap items-center">

        {{-- TOMBOL KEMBALI KE DASHBOARD (Selalu Muncul) --}}
        <a
            href="{{ url('/admin/events/show') }}"
            class="px-6 py-3 rounded-2xl border bg-white hover:shadow flex items-center gap-2 font-semibold">
            🏠 Dashboard
        </a>

        @if($detail)

            <a
                href="{{ route('admin.event.daftar') }}"
                class="px-6 py-3 rounded-2xl border bg-white hover:shadow">

                ← Kembali

            </a>

        @else

            <a
                href="{{ route('admin.events.index') }}"
                class="px-6 py-3 rounded-2xl border bg-white hover:shadow">

                📅 Event

            </a>

        @endif

    </div>

</div>