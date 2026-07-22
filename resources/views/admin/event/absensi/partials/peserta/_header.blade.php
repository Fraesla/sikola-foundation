<div class="admin-card rounded-3xl overflow-hidden">

    {{-- ========================================= --}}
    {{-- TOP BAR --}}
    {{-- ========================================= --}}
    <div class="h-2 bg-gradient-to-r from-green-500 via-emerald-500 to-blue-500"></div>

    <div class="p-8">

        <div class="flex flex-col xl:flex-row xl:justify-between xl:items-center gap-8">

            {{-- ========================================= --}}
            {{-- INFORMASI EVENT --}}
            {{-- ========================================= --}}
            <div>

                <span
                    class="inline-flex items-center gap-2
                           px-4 py-2 rounded-full
                           bg-green-100
                           text-green-700
                           text-sm font-semibold">

                    <i class="fas fa-users"></i>

                    Daftar Peserta Event

                </span>

                <h1
                    class="mt-5
                           text-4xl
                           font-black
                           text-slate-800">

                    {{ $event->judul }}

                </h1>

                <p
                    class="mt-4
                           text-slate-500
                           leading-8
                           max-w-3xl">

                    {{ $event->deskripsi ?: 'Belum terdapat deskripsi event.' }}

                </p>

                <div class="flex flex-wrap gap-6 mt-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-blue-100
                                   flex items-center justify-center">

                            <i class="fas fa-calendar-days text-blue-600"></i>

                        </div>

                        <div>

                            <small class="text-slate-500">

                                Periode

                            </small>

                            <div class="font-semibold">

                                {{ optional($event->tanggal_mulai)->translatedFormat('d M Y') }}
                                -

                                {{ optional($event->tanggal_selesai)->translatedFormat('d M Y') }}

                            </div>

                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-red-100
                                   flex items-center justify-center">

                            <i class="fas fa-location-dot text-red-600"></i>

                        </div>

                        <div>

                            <small class="text-slate-500">

                                Lokasi

                            </small>

                            <div class="font-semibold">

                                {{ $event->lokasi }}

                            </div>

                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-amber-100
                                   flex items-center justify-center">

                            <i class="fas fa-user-group text-amber-600"></i>

                        </div>

                        <div>

                            <small class="text-slate-500">

                                Total Peserta

                            </small>

                            <div class="font-semibold">

                                {{ $pesertas->total() }} Peserta

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- ========================================= --}}
            {{-- ACTION --}}
            {{-- ========================================= --}}
            <div class="flex flex-col gap-3">

                <a
                    href="{{ route('admin.absensi.create', $event) }}"
                    class="inline-flex items-center justify-center gap-3
                           px-6 py-3 rounded-2xl
                           bg-green-600 hover:bg-green-700
                           text-white font-semibold">

                    <i class="fas fa-calendar-check"></i>

                    Input Absensi

                </a>

                <a
                    href="{{ route('admin.absensi.rekap', $event) }}"
                    class="inline-flex items-center justify-center gap-3
                           px-6 py-3 rounded-2xl
                           bg-indigo-600 hover:bg-indigo-700
                           text-white font-semibold">

                    <i class="fas fa-chart-column"></i>

                    Rekap Absensi

                </a>

                <a
                    href="{{ route('admin.absensi.index') }}"
                    class="inline-flex items-center justify-center gap-3
                           px-6 py-3 rounded-2xl
                           bg-slate-100 hover:bg-slate-200
                           text-slate-700 font-semibold">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>