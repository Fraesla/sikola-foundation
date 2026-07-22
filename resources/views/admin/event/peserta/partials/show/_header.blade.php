<div class="admin-card rounded-3xl p-8">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

        {{-- ========================================= --}}
        {{-- LEFT --}}
        {{-- ========================================= --}}
        <div>

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-slate-500">

                <a
                    href="{{ url('/admin/events/show') }}"
                    class="hover:text-blue-600 transition">

                    Dashboard

                </a>

                <i class="fas fa-chevron-right text-xs"></i>

                <a
                    href="{{ route('admin.peserta.index') }}"
                    class="hover:text-blue-600 transition">

                    Peserta Event

                </a>

                <i class="fas fa-chevron-right text-xs"></i>

                <span class="font-semibold text-slate-700">

                    Detail Peserta

                </span>

            </nav>

            {{-- Judul --}}
            <h1
                class="mt-4 text-4xl font-black"
                style="color: var(--color-hitam);">

                {{ $peserta->user->name }}

            </h1>

            {{-- Event --}}
            <div class="mt-3 flex flex-wrap items-center gap-3">

                <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                           bg-blue-100 text-blue-700 text-sm font-semibold">

                    <i class="fas fa-calendar-alt"></i>

                    {{ $peserta->event->judul }}

                </span>

                <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                           bg-slate-100 text-slate-700 text-sm">

                    <i class="fas fa-envelope"></i>

                    {{ $peserta->user->email }}

                </span>

            </div>

        </div>

        {{-- ========================================= --}}
        {{-- RIGHT --}}
        {{-- ========================================= --}}
        <div class="flex flex-wrap justify-start lg:justify-end gap-3">

            {{-- Status --}}
            @php

                $statusColor = match($peserta->status){

                    'aktif' => 'green',

                    'lulus' => 'blue',

                    'tidak_lulus' => 'red',

                    default => 'gray'

                };

            @endphp

            <span
                class="inline-flex items-center gap-2
                    px-5 py-3 rounded-2xl
                    bg-{{ $statusColor }}-100
                    text-{{ $statusColor }}-700
                    font-semibold">

                <span
                    class="w-2.5 h-2.5 rounded-full bg-{{ $statusColor }}-500">

                </span>

                {{ ucfirst(str_replace('_',' ', $peserta->status)) }}

            </span>

            {{-- Tombol Kembali --}}
            <a
                href="{{ route('admin.peserta.index') }}"
                class="inline-flex items-center gap-2
                       px-5 py-3 rounded-2xl
                       bg-slate-800 hover:bg-slate-900
                       text-white font-semibold transition">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </div>

</div>