<div class="admin-card rounded-3xl overflow-hidden">

    {{-- ========================================= --}}
    {{-- TOP BAR --}}
    {{-- ========================================= --}}
    <div class="h-2 bg-gradient-to-r from-emerald-500 via-green-500 to-blue-500"></div>

    <div class="p-8">

        <div class="flex flex-col xl:flex-row xl:justify-between xl:items-start gap-8">

            {{-- ================================================= --}}
            {{-- INFORMASI EVENT --}}
            {{-- ================================================= --}}
            <div class="flex-1">

                {{-- Badge --}}
                <div class="flex flex-wrap items-center gap-3">

                    <span
                        class="inline-flex items-center gap-2
                               px-4 py-2 rounded-full
                               bg-emerald-100
                               text-emerald-700
                               text-sm
                               font-semibold">

                        <i class="fas fa-calendar-check"></i>

                        Absensi Event

                    </span>

                    @switch($mode)

                        @case('input')

                            <span
                                class="inline-flex items-center gap-2
                                       px-4 py-2 rounded-full
                                       bg-green-100
                                       text-green-700
                                       text-sm
                                       font-semibold">

                                <i class="fas fa-circle-play"></i>

                                Input Hari Ini

                            </span>

                        @break

                        @case('history')

                            <span
                                class="inline-flex items-center gap-2
                                       px-4 py-2 rounded-full
                                       bg-blue-100
                                       text-blue-700
                                       text-sm
                                       font-semibold">

                                <i class="fas fa-clock-rotate-left"></i>

                                Koreksi Absensi

                            </span>

                        @break

                        @default

                            <span
                                class="inline-flex items-center gap-2
                                       px-4 py-2 rounded-full
                                       bg-yellow-100
                                       text-yellow-700
                                       text-sm
                                       font-semibold">

                                <i class="fas fa-lock"></i>

                                Jadwal Mendatang

                            </span>

                    @endswitch

                </div>

                {{-- Judul --}}
                <h1 class="mt-5 text-4xl font-black text-slate-800">

                    {{ $event->judul }}

                </h1>

                {{-- Deskripsi --}}
                <p class="mt-4 text-slate-500 leading-8 max-w-3xl">

                    {{ $event->deskripsi ?: 'Kelola absensi peserta berdasarkan jadwal pelaksanaan event.' }}

                </p>
                                {{-- ================================================= --}}
                {{-- INFORMASI EVENT --}}
                {{-- ================================================= --}}
                @php

                    $tanggalMulai = \Carbon\Carbon::parse($event->tanggal_mulai);
                    $tanggalSelesai = \Carbon\Carbon::parse($event->tanggal_selesai);

                    $totalHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

                    $progressHari = round(($hariKe / $totalHari) * 100);

                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mt-10">

                    {{-- Hari --}}
                    <div class="rounded-2xl border border-slate-200 p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">

                                <i class="fas fa-calendar-day text-green-600"></i>

                            </div>

                            <div>

                                <p class="text-sm text-slate-500">

                                    Hari

                                </p>

                                <h3 class="font-bold text-slate-800">

                                    Hari ke-{{ $hariKe }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    {{-- Tanggal --}}
                    <div class="rounded-2xl border border-slate-200 p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">

                                <i class="fas fa-calendar text-blue-600"></i>

                            </div>

                            <div>

                                <p class="text-sm text-slate-500">

                                    Tanggal

                                </p>

                                <h3 class="font-bold text-slate-800">

                                    {{ $tanggal->translatedFormat('d M Y') }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    {{-- Lokasi --}}
                    <div class="rounded-2xl border border-slate-200 p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">

                                <i class="fas fa-location-dot text-red-600"></i>

                            </div>

                            <div>

                                <p class="text-sm text-slate-500">

                                    Lokasi

                                </p>

                                <h3 class="font-bold text-slate-800">

                                    {{ $event->lokasi }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    {{-- Peserta --}}
                    <div class="rounded-2xl border border-slate-200 p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center">

                                <i class="fas fa-users text-indigo-600"></i>

                            </div>

                            <div>

                                <p class="text-sm text-slate-500">

                                    Peserta

                                </p>

                                <h3 class="font-bold text-slate-800">

                                    {{ $absensis->count() }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    {{-- Progress Hari --}}
                    <div class="rounded-2xl border border-slate-200 p-5">

                        <p class="text-sm text-slate-500 mb-3">

                            Progress Event

                        </p>

                        <div class="w-full h-3 rounded-full bg-slate-200 overflow-hidden">

                            <div
                                class="h-full rounded-full bg-emerald-500"
                                style="width: {{ $progressHari }}%"
                                id="progressHariEvent">

                            </div>

                        </div>

                        <div class="mt-3 flex justify-between text-sm">

                            <span class="text-slate-500">

                                Hari {{ $hariKe }}

                            </span>

                            <span class="font-bold text-emerald-600">

                                {{ $progressHari }}%

                            </span>

                        </div>

                    </div>

                </div>
                 {{-- STATUS --}}
                    @if($mode == 'input')

                        <div class="rounded-2xl bg-green-50 border border-green-200 p-5">

                            <div class="flex items-start gap-3">

                                <i class="fas fa-circle-check text-green-600 mt-1"></i>

                                <div>

                                    <h4 class="font-bold text-green-700">

                                        Input Absensi

                                    </h4>

                                    <p class="text-sm text-green-600 mt-1 leading-6">

                                        Hari ini merupakan jadwal absensi.
                                        Silakan tentukan status kehadiran seluruh peserta,
                                        kemudian simpan.

                                    </p>

                                </div>

                            </div>

                        </div>

                    @elseif($mode == 'history')

                        <div class="rounded-2xl bg-blue-50 border border-blue-200 p-5">

                            <div class="flex items-start gap-3">

                                <i class="fas fa-clock-rotate-left text-blue-600 mt-1"></i>

                                <div>

                                    <h4 class="font-bold text-blue-700">

                                        Koreksi Absensi

                                    </h4>

                                    <p class="text-sm text-blue-600 mt-1 leading-6">

                                        Anda sedang membuka data absensi yang
                                        sudah tersimpan. Status kehadiran maupun
                                        catatan masih dapat diperbaiki apabila
                                        diperlukan.

                                    </p>

                                </div>

                            </div>

                        </div>

                    @else

                        <div class="rounded-2xl bg-yellow-50 border border-yellow-200 p-5">

                            <div class="flex items-start gap-3">

                                <i class="fas fa-lock text-yellow-600 mt-1"></i>

                                <div>

                                    <h4 class="font-bold text-yellow-700">

                                        Jadwal Belum Dimulai

                                    </h4>

                                    <p class="text-sm text-yellow-700 mt-1 leading-6">

                                        Hari absensi ini belum dapat diinput.
                                        Sistem akan membuka absensi secara otomatis
                                        sesuai tanggal pelaksanaan event.

                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif
            </div>



            {{-- ================================================= --}}
            {{-- ACTION PANEL --}}
            {{-- ================================================= --}}
            <div class="xl:w-80">

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">

                    <h3 class="text-lg font-bold text-slate-800">

                        Menu Absensi

                    </h3>

                    <p class="text-sm text-slate-500 mt-2">

                        Kelola absensi peserta berdasarkan hari pelaksanaan event.

                    </p>

                    <div class="mt-6 space-y-3">

                        {{-- KEMBALI --}}
                        <a
                            href="{{ route('admin.absensi.peserta', $event) }}"
                            class="w-full inline-flex items-center justify-center gap-2
                                   px-6 py-3 rounded-2xl
                                   bg-slate-100 hover:bg-slate-200
                                   text-slate-700 font-semibold">

                            <i class="fas fa-arrow-left"></i>

                            Kembali

                        </a>

                        {{-- REKAP --}}
                        <a
                            href="{{ route('admin.absensi.rekap', $event) }}"
                            class="w-full inline-flex items-center justify-center gap-2
                                   px-6 py-3 rounded-2xl
                                   bg-indigo-600 hover:bg-indigo-700
                                   text-white font-semibold">

                            <i class="fas fa-chart-column"></i>

                            Rekap Absensi

                        </a>

                        {{-- PESERTA --}}
                        <a
                            href="{{ route('admin.absensi.peserta', $event) }}"
                            class="w-full inline-flex items-center justify-center gap-2
                                   px-6 py-3 rounded-2xl
                                   bg-emerald-600 hover:bg-emerald-700
                                   text-white font-semibold">

                            <i class="fas fa-users"></i>

                            Daftar Peserta

                        </a>

                    </div>

                    <hr class="my-6">

                   

                    {{-- FOOTER INFO --}}
                    <div class="mt-6 rounded-2xl bg-white border border-slate-200 p-5">

                        <div class="flex items-center justify-between">

                            <span class="text-slate-500">

                                Periode Event

                            </span>

                            <span class="font-bold text-slate-800">

                                {{ $totalHari }} Hari

                            </span>

                        </div>

                        <div class="mt-3 flex items-center justify-between">

                            <span class="text-slate-500">

                                Hari Aktif

                            </span>

                            <span class="font-bold text-emerald-600">

                                {{ $hariKe }}/{{ $totalHari }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>