@php

use Carbon\Carbon;

$mulai = Carbon::parse($event->tanggal_mulai);
$selesai = Carbon::parse($event->tanggal_selesai);

$totalHari = $mulai->diffInDays($selesai) + 1;

@endphp

<div class="admin-card rounded-3xl p-8">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-8">

        <div
            class="w-12 h-12 rounded-2xl
                   bg-emerald-100
                   flex items-center justify-center">

            <i class="fas fa-calendar-check text-emerald-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Jadwal Absensi

            </h2>

            <p class="text-slate-500">

                Pilih hari pelaksanaan untuk melihat atau mengisi absensi.

            </p>

        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Hari --}}
        <div>

            <label class="block mb-2 font-semibold">

                Hari Pelaksanaan

            </label>

            <select
                id="hari_ke"
                class="w-full rounded-2xl border-slate-300">

                @for($i=1;$i<=$totalHari;$i++)

                    @php

                        $tgl = $mulai->copy()->addDays($i-1);

                        if($tgl->isToday()){

                            $label = '🟡 Hari Ini';

                        }elseif($tgl->lt(today())){

                            $label = '🟢 Selesai';

                        }else{

                            $label = '⚪ Belum';

                        }

                    @endphp

                    <option
                        value="{{ $i }}"
                        @selected($hariKe==$i)>

                        Hari ke-{{ $i }}
                        —
                        {{ $tgl->translatedFormat('d M Y') }}
                        ({{ $label }})

                    </option>

                @endfor

            </select>

        </div>

        {{-- Tanggal --}}
        <div>

            <label class="block mb-2 font-semibold">

                Tanggal

            </label>

            <div
                class="h-[50px]
                       rounded-2xl
                       bg-slate-100
                       px-5
                       flex items-center
                       font-semibold">

                {{ $tanggal->translatedFormat('d F Y') }}

            </div>

        </div>

        {{-- Status --}}
        <div>

            <label class="block mb-2 font-semibold">

                Status Hari

            </label>

            <div
                class="h-[50px]
                       rounded-2xl
                       px-5
                       flex items-center">

                @if($mode=='history')

                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold">

                        📖 Riwayat

                    </span>

                @elseif($mode=='input')

                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">

                        ✍️ Input Absensi

                    </span>

                @else

                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 font-semibold">

                        ⏳ Belum Dibuka

                    </span>

                @endif

            </div>

        </div>

    </div>

    {{-- Info --}}
    <div
        class="mt-8
               rounded-2xl
               border
               border-blue-200
               bg-blue-50
               p-5">

        <div class="flex gap-3">

            <i class="fas fa-circle-info text-blue-600 mt-1"></i>

            <div>

                <h4 class="font-bold text-blue-700">

                    Informasi

                </h4>

                <ul class="mt-2 space-y-2 text-blue-700">

                    <li>• Hari yang sudah lewat akan menampilkan <strong>riwayat absensi</strong>.</li>

                    <li>• Hari berjalan dapat digunakan untuk <strong>input absensi</strong>.</li>

                    <li>• Hari berikutnya belum dapat dilakukan absensi.</li>

                </ul>

            </div>

        </div>

    </div>

</div>

<script>

document.getElementById('hari_ke').addEventListener('change',function(){

    window.location =
        "{{ route('admin.absensi.create',$event) }}" +
        "?hari_ke="+this.value;

});

</script>