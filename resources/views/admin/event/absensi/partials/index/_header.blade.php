<div class="admin-card rounded-3xl overflow-hidden">

    {{-- ========================================= --}}
    {{-- TOP BAR --}}
    {{-- ========================================= --}}
    <div class="h-2 bg-gradient-to-r from-green-500 via-emerald-500 to-blue-500"></div>
    

    <div class="p-8">

        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">

            {{-- ========================================= --}}
            {{-- TITLE --}}
            {{-- ========================================= --}}
            <div>
                {{-- TOMBOL KEMBALI KE DASHBOARD --}}

                <span
                    class="inline-flex items-center gap-2
                           px-4 py-2 rounded-full
                           bg-green-100
                           text-green-700
                           text-sm
                           font-semibold">

                    <i class="fas fa-calendar-check"></i>

                    Manajemen Absensi

                </span>
                <a href="{{ url('/admin/events/show') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border bg-white text-slate-700 font-semibold text-sm hover:shadow transition">
                        🏠 Dashboard
                    </a>

                <h1
                    class="mt-5
                           text-4xl
                           font-black
                           text-slate-800">

                    Rekap Absensi Event

                </h1>

                <p
                    class="mt-4
                           max-w-3xl
                           text-lg
                           text-slate-500
                           leading-8">

                    Kelola seluruh absensi peserta event,
                    lakukan monitoring kehadiran,
                    proses scan QR Code,
                    serta lihat rekap absensi setiap event
                    dalam satu halaman.

                </p>

            </div>

            {{-- ========================================= --}}
            {{-- SUMMARY --}}
            {{-- ========================================= --}}
            <div
                class="grid grid-cols-3 gap-4
                       min-w-[360px]">

                {{-- Total Event --}}
                <div
                    class="rounded-2xl
                           bg-blue-50
                           p-5
                           text-center">

                    <div
                        class="w-12 h-12 mx-auto mb-3
                               rounded-xl
                               bg-blue-100
                               flex items-center justify-center">

                        <i class="fas fa-calendar-days text-blue-600"></i>

                    </div>

                    <div
                        class="text-3xl
                               font-black
                               text-blue-600">

                        {{ $events->total() }}

                    </div>

                    <div
                        class="mt-1
                               text-xs
                               text-slate-500">

                        Event

                    </div>

                </div>

                {{-- Event Aktif --}}
                <div
                    class="rounded-2xl
                           bg-green-50
                           p-5
                           text-center">

                    <div
                        class="w-12 h-12 mx-auto mb-3
                               rounded-xl
                               bg-green-100
                               flex items-center justify-center">

                        <i class="fas fa-play text-green-600"></i>

                    </div>

                    <div
                        class="text-3xl
                               font-black
                               text-green-600">

                        {{ $events->where('status','terbuka')->count() }}

                    </div>

                    <div
                        class="mt-1
                               text-xs
                               text-slate-500">

                        Terbuka

                    </div>

                </div>

                {{-- Event Selesai --}}
                <div
                    class="rounded-2xl
                           bg-indigo-50
                           p-5
                           text-center">

                    <div
                        class="w-12 h-12 mx-auto mb-3
                               rounded-xl
                               bg-indigo-100
                               flex items-center justify-center">

                        <i class="fas fa-flag-checkered text-indigo-600"></i>

                    </div>

                    <div
                        class="text-3xl
                               font-black
                               text-indigo-600">

                        {{ $events->where('status','selesai')->count() }}

                    </div>

                    <div
                        class="mt-1
                               text-xs
                               text-slate-500">

                        Selesai

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>