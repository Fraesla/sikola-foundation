@extends('layouts.relawan',['activePage'=>'event'])

@section('title','Absensi Event')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- ===================================================== --}}
    {{-- HEADER EVENT --}}
    {{-- ===================================================== --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl shadow-xl text-white overflow-hidden">
        <div class="p-8">
            <div class="flex items-center justify-between flex-wrap gap-5">
                <div>
                    <div class="text-blue-100 text-sm">Event Relawan</div>
                    <h1 class="text-3xl font-bold mt-2">{{ $event->judul }}</h1>
                    <div class="mt-4 flex flex-wrap gap-5 text-blue-100">
                        <div><i class="fas fa-calendar mr-2"></i> {{ $tanggal->translatedFormat('d F Y') }}</div>
                        <div><i class="fas fa-location-dot mr-2"></i> {{ $event->lokasi }}</div>
                        <div><i class="fas fa-clock mr-2"></i> Hari ke {{ $hariKe }} dari {{ $totalHari }}</div>
                    </div>
                </div>
                <div>
                    @if($mode=='input')
                        <span class="px-5 py-3 rounded-full bg-green-500 font-semibold">Hari Ini</span>
                    @elseif($mode=='history')
                        <span class="px-5 py-3 rounded-full bg-yellow-500 font-semibold">Riwayat</span>
                    @else
                        <span class="px-5 py-3 rounded-full bg-slate-500 font-semibold">Belum Dibuka</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ===================================================== --}}
    {{-- FORM UTAMA ABSENSI --}}
    {{-- ===================================================== --}}
    <form action="{{ route('relawan.events.store',$event) }}" method="POST" class="space-y-6">
       @csrf
        <input type="hidden" name="hari_ke" value="{{ $hariKe }}">

        {{-- STATUS ABSENSI & PILIHAN --}}
        <div class="bg-white rounded-3xl shadow-lg border border-slate-200">
            <div class="p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Status Absensi</h2>
                        <p class="text-slate-500 mt-1">Kehadiran Anda pada hari ke-{{ $hariKe }}</p>
                    </div>
                    
                    @php
                        $warna = match(optional($absensi)->status){
                            'hadir' => 'green',
                            'tidak_hadir' => 'red',
                            default => 'gray'
                        };
                        $label = match(optional($absensi)->status){
                            'hadir' => 'Hadir',
                            'tidak_hadir' => 'Tidak Hadir',
                            default => 'Belum Absen'
                        };
                    @endphp

                    <span class="px-5 py-3 rounded-full bg-{{ $warna }}-100 text-{{ $warna }}-700 font-semibold">
                        {{ $label }}
                    </span>
                </div>

                @if($mode=='input' || $mode=='history')
                <div class="mt-8">
                    @php
                        // Ambil status lama jika validasi gagal, atau status dari database
                        $currentStatus = old('status', optional($absensi)->status);
                    @endphp
                    
                    <div class="grid md:grid-cols-2 gap-5">
                        
                        {{-- OPSI 1: HADIR --}}
                        <label class="cursor-pointer rounded-2xl border-2 border-green-300 p-6 hover:bg-green-50 transition {{ $currentStatus == 'hadir' ? 'bg-green-50 ring-4 ring-green-200' : '' }}" data-type="hadir">
                            {{-- Tambahkan REQUIRED agar tidak bisa disubmit kalau kosong --}}
                            <input type="radio" name="status" value="hadir" class="hidden" {{ $currentStatus == 'hadir' ? 'checked' : '' }} required>
                            <div class="text-center">
                                <i class="fas fa-circle-check text-5xl text-green-600"></i>
                                <div class="mt-3 font-bold text-lg">Hadir</div>
                            </div>
                        </label>

                        {{-- OPSI 2: TIDAK HADIR --}}
                        <label class="cursor-pointer rounded-2xl border-2 border-red-300 p-6 hover:bg-red-50 transition {{ $currentStatus == 'tidak_hadir' ? 'bg-red-50 ring-4 ring-red-200' : '' }}" data-type="tidak_hadir">
                            <input type="radio" name="status" value="tidak_hadir" class="hidden" {{ $currentStatus == 'tidak_hadir' ? 'checked' : '' }} required>
                            <div class="text-center">
                                <i class="fas fa-circle-xmark text-5xl text-red-600"></i>
                                <div class="mt-3 font-bold text-lg">Tidak Hadir</div>
                            </div>
                        </label>

                    </div>

                    <div class="mt-8">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Catatan (Opsional)</label>
                        <textarea name="catatan" rows="4" class="w-full rounded-2xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Tambahkan catatan jika diperlukan...">{{ old('catatan', optional($absensi)->catatan ?? '') }}</textarea>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- ===================================================== --}}
        {{-- RINGKASAN ABSENSI --}}
        {{-- ===================================================== --}}
        @php
            $riwayat = $peserta->absensi ?? collect();
            $totalHadir = $riwayat->where('status','hadir')->count();
            $totalTidakHadir = $riwayat->where('status','tidak_hadir')->count();
            // Menghitung belum absen dari total hari dikurang yang sudah absen
            $totalBelum = $totalHari - ($totalHadir + $totalTidakHadir);
            $persentase = $totalHari ? round(($totalHadir / $totalHari) * 100) : 0;
        @endphp

        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-5">
            <div class="bg-green-50 border border-green-200 rounded-3xl p-6">
                <div class="flex justify-between">
                    <div>
                        <div class="text-green-700 text-sm">Hadir</div>
                        <div class="text-3xl font-bold mt-2 text-green-600">{{ $totalHadir }}</div>
                    </div>
                    <i class="fas fa-circle-check text-4xl text-green-500"></i>
                </div>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-3xl p-6">
                <div class="flex justify-between">
                    <div>
                        <div class="text-red-700 text-sm">Tidak Hadir</div>
                        <div class="text-3xl font-bold mt-2 text-red-600">{{ $totalTidakHadir }}</div>
                    </div>
                    <i class="fas fa-circle-xmark text-4xl text-red-500"></i>
                </div>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-3xl p-6">
                <div class="flex justify-between">
                    <div>
                        <div class="text-gray-700 text-sm">Belum Absen</div>
                        <div class="text-3xl font-bold mt-2 text-gray-600">{{ max(0, $totalBelum) }}</div>
                    </div>
                    <i class="fas fa-clock text-4xl text-gray-500"></i>
                </div>
            </div>

            <div class="bg-indigo-50 border border-indigo-200 rounded-3xl p-6">
                <div class="flex justify-between">
                    <div>
                        <div class="text-indigo-700 text-sm">Persentase</div>
                        <div class="text-3xl font-bold mt-2 text-indigo-600">{{ $persentase }}%</div>
                    </div>
                    <i class="fas fa-chart-line text-4xl text-indigo-500"></i>
                </div>
            </div>
        </div>

        {{-- PROGRESS --}}
        <div class="bg-white rounded-3xl shadow-lg border border-slate-200">
            <div class="p-7">
                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-lg">Progress Kehadiran</h3>
                    <span class="font-bold text-blue-600">{{ $persentase }}%</span>
                </div>
                <div class="mt-5 h-4 bg-slate-200 rounded-full overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-4 rounded-full" style="width:{{ $persentase }}%"></div>
                </div>
            </div>
        </div>

        {{-- RIWAYAT ABSENSI --}}
        <div class="bg-white rounded-3xl shadow-lg border border-slate-200">
            <div class="p-7 border-b">
                <h3 class="text-xl font-bold">Riwayat Absensi</h3>
                <p class="text-slate-500 mt-1">Riwayat kehadiran Anda selama mengikuti event.</p>
            </div>
            <div class="divide-y">
                @foreach($riwayat as $item)
                    @php
                        $color = match($item->status){
                            'hadir' => 'green',
                            'tidak_hadir' => 'red',
                            default => 'gray'
                        };
                    @endphp
                    <div class="flex justify-between items-center px-7 py-5">
                        <div>
                            <div class="font-semibold">Hari {{ $item->hari_ke }}</div>
                            <div class="text-sm text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</div>
                        </div>
                        <span class="px-4 py-2 rounded-full bg-{{ $color }}-100 text-{{ $color }}-700 font-semibold text-sm">
                            {{ ucfirst(str_replace('_',' ',$item->status ?? 'Belum Absen')) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="flex flex-wrap justify-between items-center gap-4 pt-4">
            <a href="{{ route('relawan.events.index') }}" class="inline-flex items-center px-6 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>

            @if($mode == 'input' || $mode == 'history')
                <button type="submit" class="inline-flex items-center px-8 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg transition">
                    <i class="fas fa-floppy-disk mr-2"></i> Simpan Absensi
                </button>
            @endif
        </div>

    </form>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded',function(){
    const cards = document.querySelectorAll('label.cursor-pointer');
    const radios = document.querySelectorAll('input[type=radio]');

    function resetCard(){
        cards.forEach(function(card){
            card.classList.remove('ring-4', 'ring-green-200', 'ring-red-200', 'bg-green-50', 'bg-red-50');
        });
    }

    radios.forEach(function(radio){
        radio.addEventListener('change',function(){
            resetCard();
            if(this.checked){
                const parentLabel = this.closest('label');
                const type = parentLabel.getAttribute('data-type');
                
                if(type === 'hadir') {
                    parentLabel.classList.add('ring-4', 'ring-green-200', 'bg-green-50');
                } else if(type === 'tidak_hadir') {
                    parentLabel.classList.add('ring-4', 'ring-red-200', 'bg-red-50');
                }
            }
        });
    });
});
</script>

@if(session('success'))
<script>
Swal.fire({
    icon:'success',
    title:'Berhasil',
    text:'{{ session('success') }}',
    timer:2000,
    showConfirmButton:false
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon:'error',
    title:'Gagal',
    text:'{{ session('error') }}'
});
</script>
@endif

@if($errors->any())
<script>
Swal.fire({
    icon:'warning',
    title:'Validasi',
    html:`{!! implode('<br>',$errors->all()) !!}`
});
</script>
@endif
@endpush