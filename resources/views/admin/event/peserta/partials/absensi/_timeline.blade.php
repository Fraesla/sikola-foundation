<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center gap-3 mb-8">

        <div
            class="w-12 h-12 rounded-2xl
                   bg-indigo-100
                   flex items-center justify-center">

            <i class="fas fa-timeline text-indigo-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Timeline Kehadiran

            </h2>

            <p class="text-slate-500">

                Riwayat kehadiran peserta selama event berlangsung.

            </p>

        </div>

    </div>

    @forelse($absensis as $absensi)

        @php

            $status = $absensi->status ?? 'tidak_hadir';

            $scanPertama = $absensi->details->sortBy('created_at')->first();

        @endphp

        <div class="relative pl-10 pb-8 border-l-2 border-slate-200 last:border-0">

            {{-- Timeline Dot --}}
            <div
                class="absolute -left-[13px]
                       w-6 h-6 rounded-full

                       @if($status=='hadir')
                            bg-green-500
                       @elseif($status=='izin')
                            bg-yellow-500
                       @elseif($status=='sakit')
                            bg-blue-500
                       @else
                            bg-red-500
                       @endif">

            </div>

            <div class="admin-card border border-slate-200 rounded-2xl p-6">

                {{-- Header --}}
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">

                    <div>

                        <h3 class="text-xl font-bold text-slate-800">

                            Hari ke-{{ $absensi->hari_ke }}

                        </h3>

                        <p class="text-slate-500 mt-1">

                            {{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('l, d F Y') }}

                        </p>

                    </div>

                    <span
                        @class([
                            'px-4 py-2 rounded-full text-sm font-semibold',

                            'bg-green-100 text-green-700'=>$status=='hadir',

                            'bg-yellow-100 text-yellow-700'=>$status=='izin',

                            'bg-blue-100 text-blue-700'=>$status=='sakit',

                            'bg-red-100 text-red-700'=>$status=='tidak_hadir',
                        ])>

                        {{ ucfirst(str_replace('_',' ',$status)) }}

                    </span>

                </div>

                {{-- Statistik --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                    <div>

                        <small class="text-slate-500">

                            Total Scan

                        </small>

                        <div class="mt-2 text-2xl font-black text-indigo-600">

                            {{ $absensi->details->count() }}

                        </div>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Scan Pertama

                        </small>

                        <div class="mt-2 text-lg font-semibold">

                            {{ $scanPertama ? $scanPertama->created_at->format('H:i:s') : '-' }}

                        </div>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Scan Terakhir

                        </small>

                        <div class="mt-2 text-lg font-semibold">

                            {{ $absensi->details->count() ? $absensi->details->sortByDesc('created_at')->first()->created_at->format('H:i:s') : '-' }}

                        </div>

                    </div>

                </div>

                {{-- Progress Scan --}}
                @if($absensi->details->count())

                    <div class="mt-8">

                        <div class="flex justify-between text-sm text-slate-500 mb-2">

                            <span>

                                Aktivitas Scan

                            </span>

                            <span>

                                {{ $absensi->details->count() }} Scan

                            </span>

                        </div>

                        <div class="w-full h-3 bg-slate-200 rounded-full">

                            <div
                                class="h-3 rounded-full bg-indigo-600"
                                style="width:100%">

                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    @empty

        <div class="py-16 text-center">

            <i class="fas fa-calendar-xmark text-6xl text-slate-300"></i>

            <h3 class="mt-6 text-2xl font-bold text-slate-700">

                Belum Ada Data Absensi

            </h3>

            <p class="text-slate-500 mt-2">

                Peserta belum pernah melakukan scan QR pada event ini.

            </p>

        </div>

    @endforelse

</div>