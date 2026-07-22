@php

    $totalPeserta = $absensis->count();

    $totalHadir = $absensis->where('status', 'hadir')->count();

    $totalTidakHadir = $absensis->where('status', 'tidak_hadir')->count();

    $totalBelumAbsen = $absensis->where('status', 'belum_absen')->count();

    $totalScan = $absensis->sum('total_scan');

    $persentase = $totalPeserta > 0
        ? round(($totalHadir / $totalPeserta) * 100, 1)
        : 0;

@endphp
@if($absensis->count())

<div class="admin-card rounded-3xl overflow-hidden">

    {{-- ================================================= --}}
    {{-- HEADER --}}
    {{-- ================================================= --}}
    <div class="p-6 border-b border-slate-200">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Daftar Absensi Peserta

                </h2>

                <p class="text-slate-500 mt-2">

                    @switch($mode)

                        @case('input')

                            Silakan lakukan input absensi peserta untuk hari ini.

                        @break

                        @case('history')

                            Anda dapat melihat dan memperbaiki absensi
                            Hari ke-{{ $hariKe }} apabila terdapat kesalahan.

                        @break

                        @default

                            Jadwal absensi belum dimulai.
                            Data hanya dapat dilihat.

                    @endswitch

                </p>

            </div>

            <div class="flex items-center gap-3 flex-wrap">

                <span
                    class="inline-flex items-center gap-2
                           px-4 py-2
                           rounded-xl
                           bg-slate-100
                           text-slate-700
                           font-semibold">

                    <i class="fas fa-users"></i>

                    {{ $absensis->count() }} Peserta

                </span>

                @if($mode == 'future')

                    <span
                        class="inline-flex items-center gap-2
                               px-4 py-2
                               rounded-xl
                               bg-yellow-100
                               text-yellow-700
                               font-semibold">

                        <i class="fas fa-lock"></i>

                        Read Only

                    </span>

                @elseif($mode == 'history')

                    <span
                        class="inline-flex items-center gap-2
                               px-4 py-2
                               rounded-xl
                               bg-blue-100
                               text-blue-700
                               font-semibold">

                        <i class="fas fa-pen"></i>

                        Koreksi Absensi

                    </span>

                @else

                    <span
                        class="inline-flex items-center gap-2
                               px-4 py-2
                               rounded-xl
                               bg-green-100
                               text-green-700
                               font-semibold">

                        <i class="fas fa-circle-check"></i>

                        Input Hari Ini

                    </span>

                @endif

            </div>

        </div>

    </div>

    {{-- ================================================= --}}
    {{-- TABLE --}}
    {{-- ================================================= --}}
    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-center w-16">
                        No
                    </th>

                    <th class="px-6 py-4 text-left">
                        Peserta
                    </th>

                    <th class="px-6 py-4 text-center">
                        Status
                    </th>

<!--                     <th class="px-6 py-4 text-center">
                        Scan
                    </th> -->

                    <th class="px-6 py-4 text-center">
                        Persentase
                    </th>

                    <th class="px-6 py-4 text-center">
                        Kehadiran
                    </th>

                    <th class="px-6 py-4 text-left">
                        Catatan
                    </th>

                    <th class="px-6 py-4 text-center">
                        Update Terakhir
                    </th>

                </tr>

            </thead>

            <tbody>

            @foreach($absensis as $absensi)

            <tr class="border-t hover:bg-slate-50 transition">

                {{-- NO --}}
                <td class="px-6 py-5 text-center">

                    {{ $loop->iteration }}

                </td>

                {{-- PESERTA --}}
                <td class="px-6 py-5">

                    <div class="flex items-center gap-4">

                        @if($absensi->peserta->user->avatar)

                            <img
                                src="{{ asset('storage/'.$absensi->peserta->user->avatar) }}"
                                class="w-12 h-12 rounded-full object-cover">

                        @else

                            <div
                                class="w-12 h-12 rounded-full
                                       bg-slate-200
                                       flex items-center justify-center">

                                <i class="fas fa-user text-slate-500"></i>

                            </div>

                        @endif

                        <div>

                            <div class="font-bold text-slate-800">

                                {{ $absensi->peserta->user->name }}

                            </div>

                            <div class="text-sm text-slate-500">

                                {{ $absensi->peserta->user->email }}

                            </div>

                        </div>

                    </div>

                </td>
                                {{-- STATUS --}}
                <td class="px-6 py-5 text-center">

                    @switch($absensi->status)

                        @case('hadir')

                            <span
                                class="inline-flex items-center gap-2
                                       px-3 py-2 rounded-xl
                                       bg-green-100 text-green-700
                                       text-sm font-semibold">

                                <i class="fas fa-circle-check"></i>

                                Hadir

                            </span>

                        @break

                        @case('tidak_hadir')

                            <span
                                class="inline-flex items-center gap-2
                                       px-3 py-2 rounded-xl
                                       bg-red-100 text-red-700
                                       text-sm font-semibold">

                                <i class="fas fa-circle-xmark"></i>

                                Tidak Hadir

                            </span>

                        @break

                        @default

                            <span
                                class="inline-flex items-center gap-2
                                       px-3 py-2 rounded-xl
                                       bg-yellow-100 text-yellow-700
                                       text-sm font-semibold">

                                <i class="fas fa-clock"></i>

                                Belum Absen

                            </span>

                    @endswitch

                </td>

                {{-- TOTAL SCAN --}}
                <!-- <td class="px-6 py-5 text-center">

                    <span
                        class="inline-flex items-center justify-center
                               w-12 h-10
                               rounded-xl
                               bg-slate-100
                               font-bold">

                        {{ $absensi->total_scan }}

                    </span>

                </td> -->

                {{-- PERSENTASE --}}
                <td class="px-6 py-5 text-center">

                    <span
                        class="inline-flex items-center justify-center
                               px-3 py-2
                               rounded-xl
                               bg-indigo-100
                               text-indigo-700
                               font-bold">

                        {{ $persentase }}%

                    </span>

                </td>

                {{-- KEHADIRAN --}}
                <td class="px-6 py-5">

                    <div class="flex justify-center gap-8">

                        {{-- HADIR --}}
                        <label
                            class="inline-flex items-center gap-2
                                   cursor-pointer">

                            <input
                                type="radio"
                                name="status[{{ $absensi->id }}]"
                                value="hadir"
                                @checked($absensi->status=='hadir')
                                @disabled($mode=='future')

                            >

                            <span
                                class="text-green-700 font-medium">

                                Hadir

                            </span>

                        </label>

                        {{-- TIDAK HADIR --}}
                        <label
                            class="inline-flex items-center gap-2
                                   cursor-pointer">

                            <input
                                type="radio"
                                name="status[{{ $absensi->id }}]"
                                value="tidak_hadir"
                                @checked($absensi->status=='tidak_hadir')
                                @disabled($mode=='future')

                            >

                            <span
                                class="text-red-700 font-medium">

                                Tidak Hadir

                            </span>

                        </label>

                    </div>

                </td>

                {{-- CATATAN --}}
                <td class="px-6 py-5">

                    <input

                        type="text"

                        name="catatan[{{ $absensi->id }}]"

                        value="{{ old('catatan.'.$absensi->id, $absensi->catatan) }}"

                        placeholder="Catatan (opsional)"

                        class="w-full rounded-xl border-slate-300"

                        @readonly($mode=='future')

                    >

                </td>

                {{-- UPDATE TERAKHIR --}}
                <td class="px-6 py-5 text-center text-sm text-slate-500">

                    @if($absensi->selesai_pada)

                        <div class="font-medium">

                            {{ $absensi->selesai_pada->translatedFormat('d M Y') }}

                        </div>

                        <div class="text-xs mt-1">

                            {{ $absensi->selesai_pada->format('H:i') }}

                        </div>

                    @else

                        -

                    @endif

                </td>

            </tr>

            @endforeach
                        </tbody>

        </table>

    </div>

</div>

@else

    @include('admin.event.absensi.partials.create._empty')

@endif

{{-- ================================================= --}}
{{-- AUTO COUNTER --}}
{{-- ================================================= --}}
@if($mode != 'future')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const totalPeserta = {{ $absensis->count() }};

    function hitungAbsensi() {

        let hadir = 0;
        let tidakHadir = 0;

        document.querySelectorAll('input[type="radio"]:checked').forEach(function(item){

            if(item.value === 'hadir'){

                hadir++;

            }else if(item.value === 'tidak_hadir'){

                tidakHadir++;

            }

        });

        let belum = totalPeserta - hadir - tidakHadir;

        const totalHadir = document.getElementById('totalHadir');
        const totalTidakHadir = document.getElementById('totalTidakHadir');
        const totalBelumAbsen = document.getElementById('totalBelumAbsen');

        if(totalHadir){

            totalHadir.innerText = hadir;

        }

        if(totalTidakHadir){

            totalTidakHadir.innerText = tidakHadir;

        }

        if(totalBelumAbsen){

            totalBelumAbsen.innerText = belum;

        }

        const progress = document.getElementById('progressKehadiran');

        if(progress){

            let persen = totalPeserta > 0
                ? Math.round((hadir / totalPeserta) * 100)
                : 0;

            progress.style.width = persen + '%';

            progress.innerHTML = persen + '%';

        }

    }

    document.querySelectorAll('input[type="radio"]').forEach(function(item){

        item.addEventListener('change', hitungAbsensi);

    });

    hitungAbsensi();

});

</script>

@endif