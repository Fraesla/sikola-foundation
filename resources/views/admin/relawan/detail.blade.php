@extends('layouts.admin', [
    'activePage' => 'relawan'
])

@section('content')

<div class="mb-6">
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl text-white font-semibold transition hover:opacity-90"
       style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
       ">

        ← Kembali

    </a>
</div>


<div class="rounded-3xl overflow-hidden"
     style="
        background: white;
        box-shadow: var(--shadow);
     ">

    {{-- HEADER --}}
    <div class="p-10 text-white"
         style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
         ">

        <div class="flex flex-col md:flex-row items-center gap-8">

            {{-- FOTO KTP --}}
            <div>

                <img
                    src="{{ asset('storage/'.$relawan->foto_ktp) }}"
                    class="w-52 h-52 rounded-3xl object-cover border-4 border-white shadow-xl">

            </div>

            {{-- INFO --}}
            <div class="flex-1">

                <h1 class="text-4xl font-bold">
                    {{ $relawan->user->name }}
                </h1>

                <p class="mt-2 text-lg opacity-90">
                    {{ $relawan->user->email }}
                </p>

                <div class="mt-5">

                    @if($relawan->status == 'menunggu')

                        <span class="px-4 py-2 rounded-full bg-yellow-200 text-yellow-900 font-semibold">
                            ⏳ Menunggu Verifikasi
                        </span>

                    @elseif($relawan->status == 'disetujui')

                        <span class="px-4 py-2 rounded-full bg-green-200 text-green-900 font-semibold">
                            ✅ Relawan Aktif
                        </span>

                    @else

                        <span class="px-4 py-2 rounded-full bg-red-200 text-red-900 font-semibold">
                            ❌ Ditolak
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- DETAIL --}}
    <div class="p-8">

        <div class="grid md:grid-cols-2 gap-6">

            <div class="bg-slate-50 rounded-2xl p-5">
                <small class="text-slate-500">NIK</small>
                <h3 class="font-bold text-lg">
                    {{ $relawan->nik }}
                </h3>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5">
                <small class="text-slate-500">Nomor Telepon</small>
                <h3 class="font-bold text-lg">
                    {{ $relawan->no_telepon }}
                </h3>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5">
                <small class="text-slate-500">Tempat Lahir</small>
                <h3 class="font-bold text-lg">
                    {{ $relawan->tempat_lahir }}
                </h3>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5">
                <small class="text-slate-500">Tanggal Lahir</small>
                <h3 class="font-bold text-lg">
                    {{ \Carbon\Carbon::parse($relawan->tanggal_lahir)->format('d F Y') }}
                </h3>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5">
                <small class="text-slate-500">Jenis Kelamin</small>
                <h3 class="font-bold text-lg">
                    {{ $relawan->jenis_kelamin_label }}
                </h3>
            </div>
            <div class="bg-slate-50 rounded-2xl p-5">
                <small class="text-slate-500">Pekerjaan</small>
                <h3 class="font-bold text-lg">
                    {{ $relawan->pekerjaan }}
                </h3>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5">
                <small class="text-slate-500">Pendidikan</small>
                <h3 class="font-bold text-lg">
                    {{ $relawan->pendidikan }}
                </h3>
            </div>

            <div class="bg-slate-50 rounded-2xl p-5">
                <small class="text-slate-500">Tanggal Daftar</small>
                <h3 class="font-bold text-lg">
                    {{ $relawan->created_at->format('d F Y H:i') }}
                </h3>
            </div>

        </div>


        {{-- ALAMAT --}}
        <div class="mt-8 bg-slate-50 rounded-2xl p-6">

            <h3 class="font-bold text-xl mb-3">
                📍 Alamat
            </h3>

            <p>
                {{ $relawan->alamat }}
            </p>

        </div>


        {{-- MOTIVASI --}}
        <div class="mt-8 bg-slate-50 rounded-2xl p-6">

            <h3 class="font-bold text-xl mb-3">
                💡 Motivasi Bergabung
            </h3>

            <p>
                {{ $relawan->motivasi }}
            </p>

        </div>


        {{-- KEAHLIAN --}}
        <div class="mt-8 bg-slate-50 rounded-2xl p-6">

            <h3 class="font-bold text-xl mb-3">
                🚀 Keahlian
            </h3>

            <p>
                {{ $relawan->keahlian }}
            </p>

        </div>


        {{-- PENGALAMAN --}}
        <div class="mt-8 bg-slate-50 rounded-2xl p-6">

            <h3 class="font-bold text-xl mb-3">
                🏢 Pengalaman Organisasi
            </h3>

            <p>
                {{ $relawan->pengalaman_organisasi }}
            </p>

        </div>

    </div>

</div>

@endsection