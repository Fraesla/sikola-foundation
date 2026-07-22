<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center justify-between mb-8">

        <div class="flex items-center gap-3">

            <div
                class="w-12 h-12 rounded-2xl
                       bg-green-100
                       flex items-center justify-center">

                <i class="fas fa-certificate text-green-600 text-xl"></i>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Sertifikat

                </h2>

                <p class="text-slate-500">

                    Sertifikat kelulusan peserta event.

                </p>

            </div>

        </div>

        @if(!$peserta->sertifikat)

            <button
                type="button"

                class="inline-flex items-center gap-2
                       px-4 py-3 rounded-xl
                       bg-indigo-600 hover:bg-indigo-700
                       text-white text-sm font-semibold"

                data-route="{{ route('admin.peserta.sertifikat.upload',$peserta) }}"
                data-nama="{{ $peserta->user->name }}"

                onclick="openUpload(this)">

                <i class="fas fa-upload"></i>

                Upload

            </button>

        @endif

    </div>

    {{-- ========================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================= --}}
    @if($peserta->sertifikat)

        <div class="flex flex-col items-center">

            <div
                class="w-32 h-32 rounded-full
                       bg-green-100
                       flex items-center justify-center">

                <i class="fas fa-file-pdf text-6xl text-green-600"></i>

            </div>

            <h3 class="mt-6 text-xl font-bold text-slate-800">

                Sertifikat Telah Diterbitkan

            </h3>

            <p class="text-slate-500 mt-2">

                Peserta telah memperoleh sertifikat event.

            </p>

            @if($peserta->sertifikat_diterbitkan)

                <div
                    class="mt-6 px-5 py-3
                           rounded-xl
                           bg-slate-100">

                    <span class="text-sm text-slate-500">

                        Diterbitkan pada

                    </span>

                    <div class="font-bold mt-1">

                        {{ \Carbon\Carbon::parse($peserta->sertifikat_diterbitkan)->translatedFormat('d F Y H:i') }}

                    </div>

                </div>

            @endif

            <div class="mt-8 flex flex-wrap justify-center gap-3">

                <a
                    href="{{ route('admin.peserta.sertifikat.download',$peserta) }}"

                    class="inline-flex items-center gap-2
                           px-5 py-3 rounded-xl
                           bg-blue-600 hover:bg-blue-700
                           text-white font-semibold">

                    <i class="fas fa-download"></i>

                    Download

                </a>

                <button
                    type="button"

                    class="inline-flex items-center gap-2
                           px-5 py-3 rounded-xl
                           bg-amber-500 hover:bg-amber-600
                           text-white font-semibold"

                    data-route="{{ route('admin.peserta.sertifikat.upload',$peserta) }}"
                    data-nama="{{ $peserta->user->name }}"

                    onclick="openUpload(this)">

                    <i class="fas fa-rotate"></i>

                    Ganti File

                </button>

            </div>

        </div>

    @else

        <div class="flex flex-col items-center py-10">

            <div
                class="w-32 h-32 rounded-full
                       bg-red-100
                       flex items-center justify-center">

                <i class="fas fa-file-circle-xmark text-6xl text-red-500"></i>

            </div>

            <h3 class="mt-6 text-xl font-bold text-slate-800">

                Sertifikat Belum Tersedia

            </h3>

            <p class="text-slate-500 mt-2 text-center max-w-md">

                Upload sertifikat setelah peserta dinyatakan lulus
                agar dapat diunduh oleh peserta.

            </p>

        </div>

    @endif

    {{-- ========================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================= --}}
    <div
        class="mt-8 rounded-2xl
               bg-green-50
               border border-green-100
               p-5">

        <div class="flex gap-3">

            <i class="fas fa-circle-info text-green-600 mt-1"></i>

            <div>

                <h4 class="font-bold text-green-700">

                    Informasi Sertifikat

                </h4>

                <p class="text-sm text-green-600 mt-1 leading-6">

                    Sertifikat yang diunggah harus berformat PDF.
                    Peserta dapat mengunduh sertifikat melalui akun
                    masing-masing setelah admin menerbitkannya.

                </p>

            </div>

        </div>

    </div>

</div>