<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center gap-3 mb-8">

        <div
            class="w-12 h-12 rounded-2xl
                   bg-emerald-100
                   flex items-center justify-center">

            <i class="fas fa-chart-pie text-emerald-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Ringkasan Kehadiran

            </h2>

            <p class="text-slate-500">

                Rekapitulasi kehadiran peserta selama mengikuti event.

            </p>

        </div>

    </div>

    <div class="grid lg:grid-cols-2 gap-8">

        {{-- ========================================= --}}
        {{-- PROGRESS --}}
        {{-- ========================================= --}}
        <div>

            <div class="flex justify-between mb-3">

                <span class="font-semibold text-slate-700">

                    Persentase Kehadiran

                </span>

                <span
                    class="font-bold

                    @if($persentase>=80)

                        text-green-600

                    @elseif($persentase>=50)

                        text-yellow-600

                    @else

                        text-red-600

                    @endif">

                    {{ number_format($persentase,2) }}%

                </span>

            </div>

            <div class="w-full h-5 bg-slate-200 rounded-full overflow-hidden">

                <div

                    class="h-5 rounded-full transition-all duration-700

                    @if($persentase>=80)

                        bg-green-500

                    @elseif($persentase>=50)

                        bg-yellow-500

                    @else

                        bg-red-500

                    @endif"

                    style="width: {{ min($persentase,100) }}%">

                </div>

            </div>

            <div class="mt-5 text-sm text-slate-500">

                Kehadiran dihitung berdasarkan total hari event.

            </div>

        </div>

        {{-- ========================================= --}}
        {{-- HASIL --}}
        {{-- ========================================= --}}
        <div
            class="rounded-2xl border p-6

            @if($persentase>=80)

                border-green-200 bg-green-50

            @elseif($persentase>=50)

                border-yellow-200 bg-yellow-50

            @else

                border-red-200 bg-red-50

            @endif">

            <div class="flex items-center gap-4">

                <div
                    class="w-16 h-16 rounded-2xl flex items-center justify-center

                    @if($persentase>=80)

                        bg-green-100

                    @elseif($persentase>=50)

                        bg-yellow-100

                    @else

                        bg-red-100

                    @endif">

                    <i
                        class="fas

                        @if($persentase>=80)

                            fa-award text-green-600

                        @elseif($persentase>=50)

                            fa-circle-exclamation text-yellow-600

                        @else

                            fa-circle-xmark text-red-600

                        @endif

                        text-3xl">

                    </i>

                </div>

                <div>

                    <h3
                        class="text-xl font-bold

                        @if($persentase>=80)

                            text-green-700

                        @elseif($persentase>=50)

                            text-yellow-700

                        @else

                            text-red-700

                        @endif">

                        @if($persentase>=80)

                            Memenuhi Syarat Kelulusan

                        @elseif($persentase>=50)

                            Kehadiran Cukup

                        @else

                            Kehadiran Kurang

                        @endif

                    </h3>

                    <p class="mt-2 text-slate-600">

                        Hadir <strong>{{ $totalHadir }}</strong> dari
                        <strong>{{ $totalHari }}</strong> hari.

                    </p>

                    <p class="text-slate-600">

                        Total Scan QR :
                        <strong>{{ number_format($totalScan) }}</strong>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>