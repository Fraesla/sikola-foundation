<div class="admin-card rounded-3xl overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left">

                        Peserta

                    </th>

                    <th class="px-6 py-4 text-left">

                        Event

                    </th>

                    <th class="px-6 py-4 text-center">

                        Status

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

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pesertas as $peserta)

                    <tr class="border-t hover:bg-slate-50 transition">

                        {{-- ===================== --}}
                        {{-- PROFILE --}}
                        {{-- ===================== --}}

                        <td class="px-6 py-5">

                            @include(
                                'admin.event.peserta.partials.index._profile',
                                [
                                    'peserta'=>$peserta
                                ]
                            )

                        </td>

                        {{-- ===================== --}}
                        {{-- EVENT --}}
                        {{-- ===================== --}}

                        <td class="px-6 py-5">

                            <div>

                                <h4 class="font-bold text-slate-800">

                                    {{ $peserta->event->judul }}

                                </h4>

                                <div
                                    class="text-sm text-slate-500 mt-1">

                                    <i class="fas fa-location-dot"></i>

                                    {{ $peserta->event->lokasi }}

                                </div>

                                <div
                                    class="text-sm text-slate-500">

                                    <i class="fas fa-calendar"></i>

                                    {{ \Carbon\Carbon::parse($peserta->event->tanggal_mulai)->format('d M Y') }}

                                </div>

                            </div>

                        </td>

                        {{-- ===================== --}}
                        {{-- STATUS --}}
                        {{-- ===================== --}}

                        <td class="px-6 py-5 text-center">

                            @include(
                                'admin.event.peserta.partials.index._status',
                                [
                                    'peserta'=>$peserta
                                ]
                            )

                        </td>

                        {{-- ===================== --}}
                        {{-- PROGRESS --}}
                        {{-- ===================== --}}

                        <td class="px-6 py-5">

                            @include(
                                'admin.event.peserta.partials.index._progress',
                                [
                                    'peserta'=>$peserta
                                ]
                            )

                        </td>

                        {{-- ===================== --}}
                        {{-- POINT --}}
                        {{-- ===================== --}}

                        <td class="px-6 py-5 text-center">

                            @include(
                                'admin.event.peserta.partials.index._point',
                                [
                                    'peserta'=>$peserta
                                ]
                            )

                        </td>

                        {{-- ===================== --}}
                        {{-- SERTIFIKAT --}}
                        {{-- ===================== --}}

                        <td class="px-6 py-5 text-center">

                            @include(
                                'admin.event.peserta.partials.index._sertifikat',
                                [
                                    'peserta'=>$peserta
                                ]
                            )

                        </td>

                        {{-- ===================== --}}
                        {{-- ACTION --}}
                        {{-- ===================== --}}

                        <td class="px-6 py-5 text-center">

                            @include(
                                'admin.event.peserta.partials.index._action',
                                [
                                    'peserta'=>$peserta
                                ]
                            )

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-20">

                            <div class="space-y-4">

                                <i
                                    class="fas fa-users text-6xl text-slate-300">
                                </i>

                                <h3
                                    class="text-xl font-bold text-slate-500">

                                    Belum Ada Peserta

                                </h3>

                                <p
                                    class="text-slate-400">

                                    Tidak ada data peserta yang sesuai dengan filter.

                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($pesertas->hasPages())

        <div class="border-t px-6 py-5">

            {{ $pesertas->links() }}

        </div>

    @endif

</div>