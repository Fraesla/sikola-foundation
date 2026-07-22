<div class="admin-card rounded-3xl overflow-hidden shadow-sm">

    {{-- ========================================================= --}}
    {{-- TOP BAR --}}
    {{-- ========================================================= --}}
    <div class="h-2 bg-gradient-to-r from-indigo-600 via-blue-500 to-cyan-500"></div>

    <div class="p-8">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-8">

            {{-- LEFT --}}
            <div class="flex-1">

                <div class="flex flex-wrap items-center gap-3">

                    <span
                        class="inline-flex items-center gap-2
                               px-4 py-2 rounded-full
                               bg-indigo-100 text-indigo-700
                               font-semibold text-sm">

                        <i class="fas fa-chart-column"></i>

                        Rekap Absensi

                    </span>

                    @if(now()->between($event->tanggal_mulai, $event->tanggal_selesai))

                        <span
                            class="inline-flex items-center gap-2
                                   px-4 py-2 rounded-full
                                   bg-green-100 text-green-700
                                   font-semibold text-sm">

                            <i class="fas fa-circle text-[10px]"></i>

                            Event Berlangsung

                        </span>

                    @elseif(now()->lt($event->tanggal_mulai))

                        <span
                            class="inline-flex items-center gap-2
                                   px-4 py-2 rounded-full
                                   bg-yellow-100 text-yellow-700
                                   font-semibold text-sm">

                            <i class="fas fa-clock"></i>

                            Belum Dimulai

                        </span>

                    @else

                        <span
                            class="inline-flex items-center gap-2
                                   px-4 py-2 rounded-full
                                   bg-slate-200 text-slate-700
                                   font-semibold text-sm">

                            <i class="fas fa-circle-check"></i>

                            Event Selesai

                        </span>

                    @endif

                </div>

                <h1 class="mt-5 text-4xl font-black text-slate-800">

                    {{ $event->judul }}

                </h1>

                <p class="mt-3 text-slate-500 max-w-3xl leading-7">

                    {{ $event->deskripsi ?: 'Ringkasan kehadiran seluruh peserta selama pelaksanaan event.' }}

                </p>

            </div>

            {{-- RIGHT --}}
           <div class="flex flex-wrap items-center gap-2">

                <a
                    href="{{ route('admin.absensi.peserta',$event) }}"
                    class="inline-flex items-center gap-2
                           px-4 py-2
                           rounded-lg
                           border border-slate-200
                           bg-white
                           hover:bg-slate-50
                           text-slate-700
                           text-sm
                           font-semibold">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

                <a
                    href="{{ route('admin.absensi.create',$event) }}"
                    class="inline-flex items-center gap-2
                           px-4 py-2
                           rounded-lg
                           bg-indigo-600
                           hover:bg-indigo-700
                           text-white
                           text-sm
                           font-semibold">

                    <i class="fas fa-clipboard-check"></i>

                    Input Absensi

                </a>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- INFORMATION CARD --}}
        {{-- ========================================================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-5 mt-10">

            {{-- Mulai --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-xl
                               bg-blue-100
                               flex items-center justify-center">

                        <i class="fas fa-calendar-day text-blue-600"></i>

                    </div>

                    <div>

                        <div class="text-sm text-slate-500">

                            Mulai

                        </div>

                        <div class="font-bold">

                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d M Y') }}

                        </div>

                    </div>

                </div>

            </div>

            {{-- Selesai --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-xl
                               bg-red-100
                               flex items-center justify-center">

                        <i class="fas fa-calendar-xmark text-red-600"></i>

                    </div>

                    <div>

                        <div class="text-sm text-slate-500">

                            Selesai

                        </div>

                        <div class="font-bold">

                            {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d M Y') }}

                        </div>

                    </div>

                </div>

            </div>

            {{-- Lokasi --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-xl
                               bg-green-100
                               flex items-center justify-center">

                        <i class="fas fa-location-dot text-green-600"></i>

                    </div>

                    <div>

                        <div class="text-sm text-slate-500">

                            Lokasi

                        </div>

                        <div class="font-bold">

                            {{ $event->lokasi }}

                        </div>

                    </div>

                </div>

            </div>

            {{-- Peserta --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-xl
                               bg-indigo-100
                               flex items-center justify-center">

                        <i class="fas fa-users text-indigo-600"></i>

                    </div>

                    <div>

                        <div class="text-sm text-slate-500">

                            Peserta

                        </div>

                        <div class="font-bold">

                            {{ $pesertas->count() }}

                        </div>

                    </div>

                </div>

            </div>

            {{-- Durasi --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-xl
                               bg-yellow-100
                               flex items-center justify-center">

                        <i class="fas fa-hourglass-half text-yellow-600"></i>

                    </div>

                    <div>

                        <div class="text-sm text-slate-500">

                            Durasi

                        </div>

                        <div class="font-bold">

                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->diffInDays($event->tanggal_selesai)+1 }}
                            Hari

                        </div>

                    </div>

                </div>

            </div>

            {{-- Hari Ini --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-xl
                               bg-cyan-100
                               flex items-center justify-center">

                        <i class="fas fa-calendar-week text-cyan-600"></i>

                    </div>

                    <div>

                        <div class="text-sm text-slate-500">

                            Hari Ini

                        </div>

                        <div class="font-bold">

                            {{ now()->translatedFormat('d M Y') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>