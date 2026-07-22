<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">

    {{-- ========================================= --}}
    {{-- TOTAL HARI --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Total Hari

                </p>

                <h2 class="mt-3 text-4xl font-black text-slate-800">

                    {{ $totalHari }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-blue-100
                       flex items-center justify-center">

                <i class="fas fa-calendar-days text-2xl text-blue-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- TOTAL SCAN --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Total Scan

                </p>

                <h2 class="mt-3 text-4xl font-black text-indigo-600">

                    {{ $totalScan }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-indigo-100
                       flex items-center justify-center">

                <i class="fas fa-qrcode text-2xl text-indigo-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- HADIR --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Hadir

                </p>

                <h2 class="mt-3 text-4xl font-black text-green-600">

                    {{ $totalHadir }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-green-100
                       flex items-center justify-center">

                <i class="fas fa-user-check text-2xl text-green-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- TIDAK HADIR --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Tidak Hadir

                </p>

                <h2 class="mt-3 text-4xl font-black text-red-600">

                    {{ $totalTidakHadir }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl
                       bg-red-100
                       flex items-center justify-center">

                <i class="fas fa-user-xmark text-2xl text-red-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- PERSENTASE --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div>

            <div class="flex items-center justify-between">

                <p class="text-sm text-slate-500">

                    Kehadiran

                </p>

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

            <div class="mt-5">

                <div class="w-full h-3 bg-slate-200 rounded-full overflow-hidden">

                    <div
                        class="h-3 rounded-full transition-all duration-700

                        @if($persentase>=80)
                            bg-green-500
                        @elseif($persentase>=50)
                            bg-yellow-500
                        @else
                            bg-red-500
                        @endif"

                        style="width: {{ $persentase }}%">

                    </div>

                </div>

            </div>

            <div class="mt-4 text-sm text-slate-500">

                Persentase Kehadiran Peserta

            </div>

        </div>

    </div>

</div>