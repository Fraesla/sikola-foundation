<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center gap-3 mb-8">

        <div
            class="w-12 h-12 rounded-2xl
                   bg-indigo-100
                   flex items-center justify-center">

            <i class="fas fa-clock-rotate-left text-indigo-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Timeline Riwayat Event

            </h2>

            <p class="text-slate-500">

                Riwayat seluruh event yang pernah diikuti peserta.

            </p>

        </div>

    </div>

    @forelse($pesertas as $peserta)

        @php

            $hadir = $peserta->absensi->where('status','hadir')->count();

            $totalHari = $peserta->absensi->count();

            $persentase = $totalHari
                ? round(($hadir/$totalHari)*100)
                : 0;

        @endphp

        <div class="relative pl-10 pb-10 border-l-2 border-slate-200 last:border-0">

            {{-- DOT --}}
            <div
                class="absolute -left-[13px]
                       w-6 h-6 rounded-full

                @if($peserta->status=='lulus')

                    bg-green-500

                @elseif($peserta->status=='aktif')

                    bg-blue-500

                @elseif($peserta->status=='tidak_lulus')

                    bg-red-500

                @else

                    bg-slate-400

                @endif">

            </div>

            <div class="admin-card border border-slate-200 rounded-2xl p-6">

                <div class="flex flex-col xl:flex-row xl:justify-between gap-6">

                    <div>

                        <h3 class="text-xl font-bold text-slate-800">

                            {{ $peserta->event->judul }}

                        </h3>

                        <p class="text-slate-500 mt-2">

                            {{ optional($peserta->event->tanggal_mulai)->translatedFormat('d M Y') }}
                            -
                            {{ optional($peserta->event->tanggal_selesai)->translatedFormat('d M Y') }}

                        </p>

                    </div>

                    <span
                        @class([
                            'px-4 py-2 rounded-full text-sm font-semibold h-fit',

                            'bg-green-100 text-green-700'=>$peserta->status=='lulus',

                            'bg-blue-100 text-blue-700'=>$peserta->status=='aktif',

                            'bg-red-100 text-red-700'=>$peserta->status=='tidak_lulus',

                            'bg-gray-100 text-gray-700'=>$peserta->status=='nonaktif',
                        ])>

                        {{ ucwords(str_replace('_',' ',$peserta->status)) }}

                    </span>

                </div>

                <div class="grid grid-cols-2 xl:grid-cols-4 gap-6 mt-8">

                    <div>

                        <small class="text-slate-500">

                            Point

                        </small>

                        <div class="mt-2 text-2xl font-black text-yellow-600">

                            {{ number_format($peserta->poin) }}

                        </div>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Hari Hadir

                        </small>

                        <div class="mt-2 text-2xl font-black text-green-600">

                            {{ $hadir }}

                        </div>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Total Hari

                        </small>

                        <div class="mt-2 text-2xl font-black text-blue-600">

                            {{ $totalHari }}

                        </div>

                    </div>

                    <div>

                        <small class="text-slate-500">

                            Kehadiran

                        </small>

                        <div
                            class="mt-2 text-2xl font-black

                            @if($persentase>=80)

                                text-green-600

                            @elseif($persentase>=50)

                                text-yellow-600

                            @else

                                text-red-600

                            @endif">

                            {{ $persentase }}%

                        </div>

                    </div>

                </div>

                {{-- Progress --}}
                <div class="mt-8">

                    <div class="flex justify-between mb-2 text-sm text-slate-500">

                        <span>Progress Kehadiran</span>

                        <span>{{ $persentase }}%</span>

                    </div>

                    <div class="w-full h-3 rounded-full bg-slate-200 overflow-hidden">

                        <div
                            class="h-3 rounded-full

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

            </div>

        </div>

    @empty

        @include('admin.event.peserta.partials.riwayat._empty')

    @endforelse

</div>