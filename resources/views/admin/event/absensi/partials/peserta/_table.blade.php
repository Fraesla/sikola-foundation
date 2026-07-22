<div class="admin-card rounded-3xl overflow-hidden">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="p-6 border-b border-slate-200">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Daftar Peserta

                </h2>

                <p class="text-slate-500 mt-1">

                    Seluruh peserta yang mengikuti event ini.

                </p>

            </div>

            <span
                class="px-4 py-2 rounded-xl
                       bg-blue-100
                       text-blue-700
                       font-semibold">

                {{ $pesertas->total() }} Peserta

            </span>

        </div>

    </div>

    @if($pesertas->count())

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left">

                            Peserta

                        </th>

                        <th class="px-6 py-4 text-center">

                            Status

                        </th>

                        <th class="px-6 py-4 text-center">

                            Hadir

                        </th>

                        <th class="px-6 py-4 text-center">

                            Tidak Hadir

                        </th>

                        <th class="px-6 py-4 text-center">

                            Scan

                        </th>

                        <th class="px-6 py-4 text-center">

                            Kehadiran

                        </th>

                        <th class="px-6 py-4 text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($pesertas as $peserta)

                        @php

                            $hadir = $peserta->absensi->sum('hadir');

                            $tidakHadir = $peserta->absensi->sum('tidak_hadir');

                            $scan = $peserta->absensi->sum('target_scan');

                            $total = $hadir + $tidakHadir;

                            $persen = $total > 0
                                ? round(($hadir / $total) * 100)
                                : 0;

                        @endphp

                        <tr class="border-t hover:bg-slate-50">

                            {{-- PESERTA --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-4">

                                    <div>

                                        @if($peserta->user->foto)

                                            <img
                                                src="{{ asset('storage/'.$peserta->user->foto) }}"
                                                class="w-12 h-12 rounded-full object-cover">

                                        @else

                                            <div
                                                class="w-12 h-12 rounded-full
                                                       bg-slate-200
                                                       flex items-center justify-center">

                                                <i class="fas fa-user text-slate-500"></i>

                                            </div>

                                        @endif

                                    </div>

                                    <div>

                                        <div class="font-bold text-slate-800">

                                            {{ $peserta->user->name }}

                                        </div>

                                        <div class="text-sm text-slate-500">

                                            {{ $peserta->user->email }}

                                        </div>

                                    </div>

                                </div>

                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-5 text-center">

                                <span
                                    class="px-3 py-2 rounded-full
                                    {{ $peserta->status=='aktif'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">

                                    {{ ucfirst($peserta->status) }}

                                </span>

                            </td>

                            {{-- HADIR --}}
                            <td class="px-6 py-5 text-center font-bold text-green-600">

                                {{ $hadir }}

                            </td>

                            {{-- TIDAK HADIR --}}
                            <td class="px-6 py-5 text-center font-bold text-red-600">

                                {{ $tidakHadir }}

                            </td>

                            {{-- SCAN --}}
                            <td class="px-6 py-5 text-center">

                                {{ $scan }}

                            </td>

                            {{-- PERSENTASE --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex-1 h-3 rounded-full bg-slate-200 overflow-hidden">

                                        <div
                                            class="h-full rounded-full bg-green-500"
                                            style="width: {{ $persen }}%">

                                        </div>

                                    </div>

                                    <span
                                        class="font-bold text-sm text-slate-700">

                                        {{ $persen }}%

                                    </span>

                                </div>

                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-5">

                                <div class="flex justify-center gap-2">

                                    {{-- Detail Peserta --}}
                                    <a
                                        href="{{ route('admin.peserta.show', $peserta) }}"
                                        class="w-10 h-10
                                               rounded-xl
                                               bg-blue-100
                                               hover:bg-blue-200
                                               text-blue-600
                                               flex
                                               items-center
                                               justify-center"
                                        title="Detail Peserta">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    {{-- Input Absensi --}}
                                    <a
                                        href="{{ route('admin.absensi.create', $event) }}"
                                        class="w-10 h-10
                                               rounded-xl
                                               bg-green-100
                                               hover:bg-green-200
                                               text-green-600
                                               flex
                                               items-center
                                               justify-center"
                                        title="Input Absensi">

                                        <i class="fas fa-calendar-check"></i>

                                    </a>

                                    {{-- Rekap --}}
                                    <a
                                        href="{{ route('admin.absensi.rekap', $event) }}"
                                        class="w-10 h-10
                                               rounded-xl
                                               bg-indigo-100
                                               hover:bg-indigo-200
                                               text-indigo-600
                                               flex
                                               items-center
                                               justify-center"
                                        title="Rekap">

                                        <i class="fas fa-chart-column"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="p-6 border-t">

            {{ $pesertas->links() }}

        </div>

    @else

        @include('admin.event.absensi.partials.peserta._empty')

    @endif

</div>