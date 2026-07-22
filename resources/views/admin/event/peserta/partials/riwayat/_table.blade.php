<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center justify-between mb-8">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Daftar Riwayat Event

            </h2>

            <p class="text-slate-500 mt-1">

                Seluruh event yang pernah diikuti peserta.

            </p>

        </div>

        <div
            class="px-4 py-2 rounded-xl
                   bg-slate-100 text-slate-700
                   font-semibold">

            {{ $pesertas->total() }} Event

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead>

                <tr class="bg-slate-50 border-b">

                    <th class="px-6 py-4 text-left">

                        Event

                    </th>

                    <th class="px-6 py-4 text-center">

                        Periode

                    </th>

                    <th class="px-6 py-4 text-center">

                        Kehadiran

                    </th>

                    <th class="px-6 py-4 text-center">

                        Point

                    </th>

                    <th class="px-6 py-4 text-center">

                        Sertifikat

                    </th>

                    <th class="px-6 py-4 text-center">

                        Status

                    </th>

                    <th class="px-6 py-4 text-center">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pesertas as $peserta)

                    @php

                        $hadir = $peserta->absensi->where('status','hadir')->count();

                        $hari = $peserta->absensi->count();

                        $persen = $hari ? round(($hadir/$hari)*100) : 0;

                    @endphp

                    <tr class="border-b hover:bg-slate-50 transition">

                        {{-- EVENT --}}
                        <td class="px-6 py-5">

                            <div class="font-bold text-slate-800">

                                {{ $peserta->event->judul }}

                            </div>

                            <div class="text-sm text-slate-500 mt-1">

                                {{ optional($peserta->event->tanggal_mulai)->translatedFormat('d M Y') }}

                            </div>

                        </td>

                        {{-- PERIODE --}}
                        <td class="px-6 py-5 text-center">

                            {{ optional($peserta->event->tanggal_mulai)->format('d/m/Y') }}

                            <br>

                            s/d

                            <br>

                            {{ optional($peserta->event->tanggal_selesai)->format('d/m/Y') }}

                        </td>

                        {{-- HADIR --}}
                        <td class="px-6 py-5 text-center">

                            <div class="font-bold text-green-600">

                                {{ $hadir }}

                                /

                                {{ $hari }}

                            </div>

                            <small class="text-slate-500">

                                {{ $persen }}%

                            </small>

                        </td>

                        {{-- POINT --}}
                        <td class="px-6 py-5 text-center">

                            <span
                                class="inline-flex items-center
                                       px-3 py-2 rounded-full
                                       bg-yellow-100
                                       text-yellow-700
                                       font-bold">

                                {{ number_format($peserta->poin) }}

                            </span>

                        </td>

                        {{-- SERTIFIKAT --}}
                        <td class="px-6 py-5 text-center">

                            @if($peserta->sertifikat)

                                <span
                                    class="inline-flex items-center gap-2
                                           px-3 py-2 rounded-full
                                           bg-green-100
                                           text-green-700">

                                    <i class="fas fa-circle-check"></i>

                                    Ada

                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-2
                                           px-3 py-2 rounded-full
                                           bg-red-100
                                           text-red-700">

                                    <i class="fas fa-circle-xmark"></i>

                                    Belum

                                </span>

                            @endif

                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5 text-center">

                            @include('admin.event.peserta.partials.index._status',[
                                'peserta'=>$peserta
                            ])

                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-2">

                                <a
                                    href="{{ route('admin.peserta.show',$peserta) }}"
                                    class="w-10 h-10 rounded-xl
                                           bg-blue-100 hover:bg-blue-200
                                           text-blue-600
                                           flex items-center justify-center">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a
                                    href="{{ route('admin.peserta.absensi',$peserta) }}"
                                    class="w-10 h-10 rounded-xl
                                           bg-green-100 hover:bg-green-200
                                           text-green-600
                                           flex items-center justify-center">

                                    <i class="fas fa-qrcode"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="py-16">

                            @include('admin.event.peserta.partials.riwayat._empty')

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($pesertas->hasPages())

        <div class="mt-8">

            {{ $pesertas->links() }}

        </div>

    @endif

</div>