<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center justify-between mb-8">

        <div class="flex items-center gap-3">

            <div
                class="w-12 h-12 rounded-2xl
                       bg-purple-100
                       flex items-center justify-center">

                <i class="fas fa-clock-rotate-left text-purple-600 text-xl"></i>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Riwayat Absensi

                </h2>

                <p class="text-slate-500">

                    Riwayat kehadiran peserta selama event berlangsung.

                </p>

            </div>

        </div>

        <a
            href="{{ route('admin.peserta.absensi',$peserta) }}"
            class="inline-flex items-center gap-2
                   px-4 py-3 rounded-xl
                   bg-indigo-600 hover:bg-indigo-700
                   text-white text-sm font-semibold">

            <i class="fas fa-eye"></i>

            Lihat Detail

        </a>

    </div>

    {{-- ========================================= --}}
    {{-- TABLE --}}
    {{-- ========================================= --}}

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b bg-slate-50">

                    <th class="px-5 py-4 text-left">

                        Hari

                    </th>

                    <th class="px-5 py-4 text-left">

                        Tanggal

                    </th>

                    <!-- <th class="px-5 py-4 text-center">

                        Scan

                    </th> -->

                    <th class="px-5 py-4 text-center">

                        Status

                    </th>

                    <th class="px-5 py-4 text-center">

                        Jam

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($peserta->absensi as $absen)

                    <tr class="border-b hover:bg-slate-50">

                        <td class="px-5 py-4 font-semibold">

                            Hari {{ $absen->hari_ke }}

                        </td>

                        <td class="px-5 py-4">

                            {{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d M Y') }}

                        </td>

                        <!-- <td class="px-5 py-4 text-center">

                            @if($absen->count())

                                <span
                                    class="inline-flex items-center
                                           px-3 py-1 rounded-full
                                           bg-blue-100
                                           text-blue-700
                                           text-xs font-semibold">

                                    {{ $absen->count() }} Scan

                                </span>

                            @else

                                <span
                                    class="text-slate-400">

                                    -

                                </span>

                            @endif

                        </td> -->

                        <td class="px-5 py-4 text-center">

                            @php

                                $status = $absen->status ?? 'tidak_hadir';

                            @endphp

                            <span

                                @class([

                                    'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold',

                                    'bg-green-100 text-green-700'=>$status=='hadir',

                                    'bg-red-100 text-red-700'=>$status=='tidak_hadir',

                                    'bg-yellow-100 text-yellow-700'=>$status=='izin',

                                ])>

                                {{ ucwords(str_replace('_',' ',$status)) }}

                            </span>

                        </td>

                        <td class="px-5 py-4 text-center">

                            @if($absen->selesai_pada)

                                {{ \Carbon\Carbon::parse($absen->selesai_pada)->format('H:i') }}

                            @else

                                -

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="py-16 text-center">

                            <i class="fas fa-calendar-xmark text-5xl text-slate-300"></i>

                            <h3 class="mt-5 text-xl font-bold text-slate-600">

                                Belum Ada Riwayat

                            </h3>

                            <p class="text-slate-500 mt-2">

                                Peserta belum memiliki riwayat absensi.

                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>