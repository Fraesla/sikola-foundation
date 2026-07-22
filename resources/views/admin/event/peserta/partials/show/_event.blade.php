<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center gap-3 mb-8">

        <div
            class="w-12 h-12 rounded-2xl bg-indigo-100
                   flex items-center justify-center">

            <i class="fas fa-calendar-days text-indigo-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Informasi Event

            </h2>

            <p class="text-slate-500">

                Detail event yang diikuti peserta.

            </p>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Judul Event --}}
        <div>

            <label class="text-sm text-slate-500">

                Judul Event

            </label>

            <div class="mt-2 font-semibold text-lg">

                {{ $peserta->event->judul }}

            </div>

        </div>

        {{-- Kategori --}}
        <div>

            <label class="text-sm text-slate-500">

                Kategori

            </label>

            <div class="mt-2">

                <span
                    class="px-4 py-2 rounded-full
                           bg-blue-100 text-blue-700
                           text-sm font-semibold">

                    {{ $peserta->event->status ?? '-' }}

                </span>

            </div>

        </div>

        {{-- Lokasi --}}
        <div>

            <label class="text-sm text-slate-500">

                Lokasi Event

            </label>

            <div class="mt-2 font-semibold">

                <i class="fas fa-location-dot text-red-500 mr-2"></i>

                {{ $peserta->event->lokasi ?? '-' }}

            </div>

        </div>

        {{-- Penyelenggara --}}
        <div>

            <label class="text-sm text-slate-500">

                Penyelenggara

            </label>

           <div class="mt-2 font-semibold">

                {{
                    $peserta->event->creator?->role == 'admin'
                        ? 'Admin'
                        : $peserta->event->creator?->name
                }}

            </div>

        </div>

        {{-- Tanggal Mulai --}}
        <div>

            <label class="text-sm text-slate-500">

                Tanggal Mulai

            </label>

            <div class="mt-2 font-semibold">

                <i class="fas fa-calendar-check text-green-600 mr-2"></i>

                {{ \Carbon\Carbon::parse($peserta->event->tanggal_mulai)->translatedFormat('d F Y') }}

            </div>

        </div>

        {{-- Tanggal Selesai --}}
        <div>

            <label class="text-sm text-slate-500">

                Tanggal Selesai

            </label>

            <div class="mt-2 font-semibold">

                <i class="fas fa-calendar-xmark text-red-600 mr-2"></i>

                {{ \Carbon\Carbon::parse($peserta->event->tanggal_selesai)->translatedFormat('d F Y') }}

            </div>

        </div>

        {{-- Durasi --}}
        <div>

            <label class="text-sm text-slate-500">

                Durasi Event

            </label>

            <div class="mt-2 font-semibold">

                @php

                    $hari = \Carbon\Carbon::parse($peserta->event->tanggal_mulai)
                        ->diffInDays(
                            \Carbon\Carbon::parse($peserta->event->tanggal_selesai)
                        ) + 1;

                @endphp

                {{ $hari }} Hari

            </div>

        </div>

        {{-- Status Registrasi --}}
        <div>

            <label class="text-sm text-slate-500">

                Status Registrasi

            </label>

            <div class="mt-2">

                @php

                    $status = $peserta->registrasi->status ?? 'menunggu';

                    $color = match($status){

                        'dikonfirmasi' => 'green',

                        'ditolak' => 'red',

                        default => 'yellow'

                    };

                @endphp

                <span
                    class="px-4 py-2 rounded-full
                           bg-{{ $color }}-100
                           text-{{ $color }}-700
                           text-sm font-semibold">

                    {{ ucfirst($status) }}

                </span>

            </div>

        </div>

    </div>

</div>