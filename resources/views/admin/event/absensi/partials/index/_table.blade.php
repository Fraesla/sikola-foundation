<div class="admin-card rounded-3xl overflow-hidden">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="p-6 border-b border-slate-200">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Daftar Event

                </h2>

                <p class="text-slate-500 mt-1">

                    Pilih event untuk melakukan absensi peserta.

                </p>

            </div>

            <span
                class="px-4 py-2 rounded-xl
                       bg-green-100
                       text-green-700
                       font-semibold">

                {{ $events->total() }} Event

            </span>

        </div>

    </div>

    @if($events->count())

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead>

                    <tr class="bg-slate-50">

                        <th class="px-6 py-4 text-left">

                            Event

                        </th>

                        <th class="px-6 py-4 text-center">

                            Tanggal

                        </th>

                        <th class="px-6 py-4 text-center">

                            Lokasi

                        </th>

                        <th class="px-6 py-4 text-center">

                            Peserta

                        </th>

                        <th class="px-6 py-4 text-center">

                            Status

                        </th>

                        <th class="px-6 py-4 text-center">

                            Status Absensi

                        </th>

                        <th class="px-6 py-4 text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($events as $event)

                        <tr class="border-t hover:bg-slate-50 transition">

                            {{-- EVENT --}}
                            <td class="px-6 py-5">

                                <div class="font-bold text-slate-800">

                                    {{ $event->judul }}

                                </div>

                                @if($event->deskripsi)

                                    <div class="text-sm text-slate-500 mt-1 line-clamp-2">

                                        {{ Str::limit(strip_tags($event->deskripsi),80) }}

                                    </div>

                                @endif

                            </td>

                            {{-- TANGGAL --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold">

                                    {{ optional($event->tanggal_mulai)->format('d M Y') }}

                                </div>

                                <small class="text-slate-500">

                                    s/d

                                    {{ optional($event->tanggal_selesai)->format('d M Y') }}

                                </small>

                            </td>

                            {{-- LOKASI --}}
                            <td class="px-6 py-5 text-center">

                                {{ $event->lokasi }}

                            </td>

                            {{-- PESERTA --}}
                            <td class="px-6 py-5 text-center">

                                <span
                                    class="inline-flex items-center
                                           gap-2
                                           px-3 py-2
                                           rounded-full
                                           bg-blue-100
                                           text-blue-700
                                           font-semibold">

                                    <i class="fas fa-users"></i>

                                    {{ $event->pesertas_count ?? 0 }}

                                </span>

                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-5 text-center">

                                @php

                                    $badge = match($event->status){

                                        'terbuka'=>'green',

                                        'draft'=>'yellow',

                                        'selesai'=>'blue',

                                        'dibatalkan'=>'red',

                                        default=>'gray'

                                    };

                                @endphp

                                <span
                                    class="inline-flex items-center gap-2
                                           px-4 py-2
                                           rounded-full
                                           bg-{{ $badge }}-100
                                           text-{{ $badge }}-700
                                           font-semibold">

                                    <span
                                        class="w-2 h-2 rounded-full
                                               bg-{{ $badge }}-500">

                                    </span>

                                    {{ ucfirst($event->status) }}

                                </span>

                            </td>
                            <td class="px-6 py-5 text-center">

                                @switch($event->status_absensi)

                                    @case('belum_generate')

                                        <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold">

                                            Belum Disiapkan

                                        </span>

                                        @break

                                    @case('siap_absensi')

                                        <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

                                            Siap Diisi

                                        </span>

                                        @break
                                    @case('belum_mulai')

                                        <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">

                                            Belum Mulai

                                        </span>

                                        @break

                                    @default

                                        <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">

                                            Selesai

                                        </span>

                                @endswitch

                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-5">

                                @if($event->status != 'terbuka')

                                    <span
                                        class="inline-flex items-center
                                               px-4 py-2
                                               rounded-full
                                               bg-slate-100
                                               text-slate-600
                                               font-semibold">

                                        <i class="fas fa-lock mr-2"></i>

                                        Event Ditutup

                                    </span>

                                @else

                                    <div class="flex justify-center gap-2">

                                        {{-- BELUM MULAI (Belum masuk tanggal event) --}}
                                        @if($event->status_absensi == 'belum_mulai')
                                            <span class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-bold text-xs shadow-md transition cursor-not-allowed">
                                                <i class="fas fa-lock mr-2"></i> Event Belum Dimulai
                                            </span>

                                        {{-- BELUM GENERATE (Sudah masuk tanggal, tapi belum digenerate) --}}
                                        @elseif($event->status_absensi == 'belum_generate')
                                            <a href="{{ route('admin.absensi.peserta',$event) }}"
                                               class="w-11 h-11 rounded-xl bg-blue-100 hover:bg-blue-200 text-blue-600 flex items-center justify-center"
                                               title="Daftar Peserta">
                                                <i class="fas fa-users"></i>
                                            </a>

                                            <form action="{{ route('admin.absensi.generate',$event) }}" method="POST">
                                                @csrf
                                                <button onclick="return confirm('Generate jadwal absensi event ini?')"
                                                    class="w-11 h-11 rounded-xl bg-orange-100 hover:bg-orange-200 text-orange-600 flex items-center justify-center"
                                                    title="Generate Jadwal Absensi">
                                                    <i class="fas fa-gears"></i>
                                                </button>
                                            </form>

                                        {{-- SIAP ABSENSI --}}
                                        @elseif($event->status_absensi == 'siap_absensi')
                                            <a href="{{ route('admin.absensi.peserta',$event) }}"
                                               class="w-11 h-11 rounded-xl bg-blue-100 hover:bg-blue-200 text-blue-600 flex items-center justify-center" title="Peserta">
                                                <i class="fas fa-users"></i>
                                            </a>

                                            <a href="{{ route('admin.absensi.create',$event) }}"
                                               class="w-11 h-11 rounded-xl bg-green-100 hover:bg-green-200 text-green-600 flex items-center justify-center" title="Input Absensi">
                                                <i class="fas fa-calendar-check"></i>
                                            </a>

                                            <a href="{{ route('admin.absensi.rekap',$event) }}"
                                               class="w-11 h-11 rounded-xl bg-indigo-100 hover:bg-indigo-200 text-indigo-600 flex items-center justify-center" title="Rekap">
                                                <i class="fas fa-chart-column"></i>
                                            </a>

                                        {{-- ABSENSI SELESAI / SELESAI --}}
                                        @else
                                            <a href="{{ route('admin.absensi.rekap',$event) }}"
                                               class="w-11 h-11 rounded-xl bg-indigo-100 hover:bg-indigo-200 text-indigo-600 flex items-center justify-center" title="Rekap">
                                                <i class="fas fa-chart-column"></i>
                                            </a>

                                            <a href="{{ route('admin.absensi.peserta',$event) }}"
                                               class="w-11 h-11 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center" title="Detail Peserta">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif

                                    </div>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="p-6 border-t">

            {{ $events->links() }}

        </div>

    @else

        @include('admin.event.absensi.partials.index._empty')

    @endif

</div>
