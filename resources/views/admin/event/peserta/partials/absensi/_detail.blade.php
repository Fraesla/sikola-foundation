<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center gap-3 mb-8">

        <div
            class="w-12 h-12 rounded-2xl
                   bg-cyan-100
                   flex items-center justify-center">

            <i class="fas fa-qrcode text-cyan-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Detail Scan QR

            </h2>

            <p class="text-slate-500">

                Riwayat seluruh aktivitas scan peserta.

            </p>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead>

                <tr class="border-b bg-slate-50">

                    <th class="px-5 py-4 text-left">

                        Hari

                    </th>

                    <th class="px-5 py-4 text-left">

                        Waktu Scan

                    </th>

                    <th class="px-5 py-4 text-left">

                        Lokasi

                    </th>

                    <th class="px-5 py-4 text-left">

                        Device

                    </th>

                    <th class="px-5 py-4 text-center">

                        Status

                    </th>

                </tr>

            </thead>

            <tbody>

                @php

                    $totalDetail = 0;

                @endphp

                @forelse($absensis as $absensi)

                    @foreach($absensi->details as $detail)

                        @php

                            $totalDetail++;

                        @endphp

                        <tr class="border-b hover:bg-slate-50 transition">

                            <td class="px-5 py-4 font-semibold">

                                Hari {{ $absensi->hari_ke }}

                            </td>

                            <td class="px-5 py-4">

                                {{ $detail->created_at->translatedFormat('d M Y H:i:s') }}

                            </td>

                            <td class="px-5 py-4">

                                {{ $detail->lokasi ?? '-' }}

                            </td>

                            <td class="px-5 py-4">

                                {{ $detail->device ?? '-' }}

                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-2
                                           px-3 py-2 rounded-full
                                           bg-green-100
                                           text-green-700
                                           text-xs font-semibold">

                                    <i class="fas fa-check-circle"></i>

                                    Scan Berhasil

                                </span>

                            </td>

                        </tr>

                    @endforeach

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="py-16 text-center">

                            <i class="fas fa-qrcode text-6xl text-slate-300"></i>

                            <h3 class="mt-5 text-xl font-bold text-slate-700">

                                Belum Ada Scan

                            </h3>

                            <p class="text-slate-500 mt-2">

                                Belum ada riwayat scan QR peserta.

                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($totalDetail)

        <div
            class="mt-8
                   rounded-2xl
                   bg-cyan-50
                   border border-cyan-100
                   p-5">

            <div class="flex items-center justify-between">

                <div>

                    <h4 class="font-bold text-cyan-700">

                        Total Aktivitas Scan

                    </h4>

                    <p class="text-cyan-600 text-sm mt-1">

                        Seluruh riwayat scan QR peserta selama event.

                    </p>

                </div>

                <div
                    class="text-4xl font-black text-cyan-700">

                    {{ number_format($totalDetail) }}

                </div>

            </div>

        </div>

    @endif

</div>