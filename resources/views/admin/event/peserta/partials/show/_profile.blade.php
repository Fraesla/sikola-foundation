<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- TITLE --}}
    {{-- ========================================= --}}
    <div class="flex items-center gap-3 mb-8">

        <div
            class="w-12 h-12 rounded-2xl bg-blue-100
                   flex items-center justify-center">

            <i class="fas fa-user text-blue-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Profil Peserta

            </h2>

            <p class="text-slate-500">

                Informasi lengkap peserta event.

            </p>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        {{-- ========================================= --}}
        {{-- FOTO --}}
        {{-- ========================================= --}}
        <div class="flex flex-col items-center">

            @if($peserta->user->foto)

                <img
                    src="{{ asset('storage/'.$peserta->user->foto) }}"
                    class="w-44 h-44 rounded-full object-cover border-4 border-blue-100 shadow">

            @else

                <div
                    class="w-44 h-44 rounded-full
                           bg-slate-100
                           flex items-center justify-center">

                    <i class="fas fa-user text-7xl text-slate-400"></i>

                </div>

            @endif

            <h3 class="mt-5 text-xl font-bold text-slate-800">

                {{ $peserta->user->name }}

            </h3>

            <span
                class="mt-2 px-4 py-2 rounded-full
                       bg-blue-100 text-blue-700
                       text-sm font-semibold">

                ID #{{ $peserta->id }}

            </span>

        </div>

        {{-- ========================================= --}}
        {{-- INFORMASI --}}
        {{-- ========================================= --}}
        <div class="lg:col-span-3">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama --}}
                <div>

                    <label class="text-sm text-slate-500">

                        Nama Lengkap

                    </label>

                    <div class="mt-2 font-semibold text-lg">

                        {{ $peserta->user->name }}

                    </div>

                </div>

                {{-- Email --}}
                <div>

                    <label class="text-sm text-slate-500">

                        Email

                    </label>

                    <div class="mt-2 font-semibold text-lg">

                        {{ $peserta->user->email }}

                    </div>

                </div>

                {{-- Nomor HP --}}
                <div>

                    <label class="text-sm text-slate-500">

                        Nomor HP

                    </label>

                    <div class="mt-2 font-semibold text-lg">

                        {{ $peserta->relawan?->no_telepon ?? '-' }}

                    </div>

                </div>

                {{-- Jenis Kelamin --}}
                <div>

                    <label class="text-sm text-slate-500">

                        Jenis Kelamin

                    </label>

                    <div class="mt-2 font-semibold text-lg">

                        {{
                            match($peserta->relawan?->jenis_kelamin) {
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                                default => '-',
                            }
                        }}

                    </div>

                </div>

                {{-- Tanggal Registrasi --}}
                <div>

                    <label class="text-sm text-slate-500">

                        Tanggal Registrasi

                    </label>

                    <div class="mt-2 font-semibold text-lg">

                        {{ optional($peserta->registrasi?->created_at)->translatedFormat('d F Y H:i') ?? '-' }}

                    </div>

                </div>

                {{-- Status --}}
                <div>

                    <label class="text-sm text-slate-500">

                        Status Peserta

                    </label>

                    <div class="mt-2">

                        @php

                            $status = [
                                'aktif' => 'green',
                                'lulus' => 'blue',
                                'tidak_lulus' => 'red',
                                'nonaktif' => 'gray'
                            ];

                            $color = $status[$peserta->status] ?? 'gray';

                        @endphp

                        <span
                            class="inline-flex items-center gap-2
                                   px-4 py-2 rounded-full
                                   bg-{{ $color }}-100
                                   text-{{ $color }}-700
                                   font-semibold">

                            <span
                                class="w-2.5 h-2.5 rounded-full
                                       bg-{{ $color }}-500">

                            </span>

                            {{ ucfirst(str_replace('_',' ',$peserta->status)) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
