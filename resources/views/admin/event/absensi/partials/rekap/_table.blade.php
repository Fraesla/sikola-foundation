@php

    use Carbon\Carbon;

    $totalHari = Carbon::parse($event->tanggal_mulai)
        ->diffInDays($event->tanggal_selesai) + 1;

@endphp

<div class="admin-card rounded-3xl overflow-hidden">

    {{-- HEADER --}}
    <div class="p-6 border-b border-slate-200">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Rekap Kehadiran Peserta

                </h2>

                <p class="text-slate-500 mt-2">

                    Seluruh riwayat kehadiran peserta selama event berlangsung.

                </p>

            </div>

            <span
                class="px-4 py-2 rounded-xl
                       bg-indigo-100
                       text-indigo-700
                       font-semibold">

                {{ $pesertas->count() }} Peserta

            </span>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full whitespace-nowrap">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-center">

                        No

                    </th>

                    <th class="px-6 py-4 text-left">

                        Peserta

                    </th>

                    @for($hari=1;$hari<=$totalHari;$hari++)

                        <th class="px-4 py-4 text-center">

                            H{{ $hari }}

                        </th>

                    @endfor

                    <th class="px-6 py-4 text-center">

                        Hadir

                    </th>

                    <th class="px-6 py-4 text-center">

                        Tidak Hadir

                    </th>

                    <th class="px-6 py-4 text-center">

                        Kehadiran

                    </th>

                    <th class="px-6 py-4 text-center">

                        Status

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pesertas as $peserta)

                    @php

                        $hadir = $peserta->absensi
                            ->where('status','hadir')
                            ->count();

                        $tidak = $peserta->absensi
                            ->where('status','tidak_hadir')
                            ->count();

                        $persen = $totalHari
                            ? round(($hadir/$totalHari)*100)
                            : 0;

                    @endphp

                    <tr class="border-t hover:bg-slate-50">

                        <td class="px-6 py-5 text-center">

                            {{ $loop->iteration }}

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                @if($peserta->user->avatar)

                                    <img
                                        src="{{ asset('storage/'.$peserta->user->avatar) }}"
                                        class="w-12 h-12 rounded-full object-cover">

                                @else

                                    <div
                                        class="w-12 h-12 rounded-full
                                               bg-slate-200
                                               flex items-center justify-center">

                                        <i class="fas fa-user"></i>

                                    </div>

                                @endif

                                <div>

                                    <div class="font-bold">

                                        {{ $peserta->user->name }}

                                    </div>

                                    <div class="text-sm text-slate-500">

                                        {{ $peserta->user->email }}

                                    </div>

                                </div>

                            </div>

                        </td>

                        @for($hari=1;$hari<=$totalHari;$hari++)

                            @php

                                $absen = $peserta->absensi
                                    ->where('hari_ke',$hari)
                                    ->first();

                            @endphp

                            <td class="px-3 py-5 text-center">

                                @if(!$absen)

                                    —

                                @elseif($absen->status=='hadir')

                                    <span class="text-green-600 text-xl">

                                        <i class="fas fa-circle-check"></i>

                                    </span>

                                @elseif($absen->status=='tidak_hadir')

                                    <span class="text-red-600 text-xl">

                                        <i class="fas fa-circle-xmark"></i>

                                    </span>

                                @else

                                    <span class="text-yellow-500 text-xl">

                                        <i class="fas fa-clock"></i>

                                    </span>

                                @endif

                            </td>

                        @endfor

                        <td class="px-6 py-5 text-center font-bold text-green-600">

                            {{ $hadir }}

                        </td>

                        <td class="px-6 py-5 text-center font-bold text-red-600">

                            {{ $tidak }}

                        </td>

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
                                    class="font-bold text-sm">

                                    {{ $persen }}%

                                </span>

                            </div>

                        </td>

                        <td class="px-6 py-5 text-center">

                            @if($persen>=75)

                                <span
                                    class="px-3 py-2 rounded-xl
                                           bg-green-100
                                           text-green-700
                                           font-semibold">

                                    Lulus

                                </span>

                            @else

                                <span
                                    class="px-3 py-2 rounded-xl
                                           bg-red-100
                                           text-red-700
                                           font-semibold">

                                    Belum

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="{{ $totalHari+6 }}"
                            class="py-16 text-center text-slate-400">

                            Belum ada data peserta.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>