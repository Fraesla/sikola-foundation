<div class="flex flex-col items-center gap-3">

    @if($peserta->sertifikat)

        {{-- ========================= --}}
        {{-- STATUS --}}
        {{-- ========================= --}}

        <span
            class="inline-flex items-center gap-2
                   px-3 py-2
                   rounded-full
                   bg-green-100
                   text-green-700
                   text-xs
                   font-semibold">

            <i class="fas fa-circle-check"></i>

            Sudah Terbit

        </span>

        {{-- ========================= --}}
        {{-- TANGGAL --}}
        {{-- ========================= --}}

        @if($peserta->sertifikat_diterbitkan)

            <small class="text-slate-500 text-center">

                {{ \Carbon\Carbon::parse($peserta->sertifikat_diterbitkan)->format('d M Y') }}

            </small>

        @endif

        {{-- ========================= --}}
        {{-- DOWNLOAD --}}
        {{-- ========================= --}}

        <a
            href="{{ route('admin.peserta.sertifikat.download',$peserta) }}"
            class="inline-flex items-center gap-2
                   px-3 py-2
                   rounded-xl
                   bg-blue-600
                   hover:bg-blue-700
                   text-white
                   text-xs
                   font-semibold">

            <i class="fas fa-download"></i>

            Download

        </a>

    @else

        {{-- ========================= --}}
        {{-- BELUM ADA --}}
        {{-- ========================= --}}

        <span
            class="inline-flex items-center gap-2
                   px-3 py-2
                   rounded-full
                   bg-red-100
                   text-red-700
                   text-xs
                   font-semibold">

            <i class="fas fa-file-circle-xmark"></i>

            Belum Ada

        </span>

        {{-- ========================= --}}
        {{-- BUTTON UPLOAD --}}
        {{-- ========================= --}}

        <!-- <button

            type="button"

            class="inline-flex items-center gap-2
                   px-3 py-2
                   rounded-xl
                   bg-indigo-600
                   hover:bg-indigo-700
                   text-white
                   text-xs
                   font-semibold"

            data-route="{{ route('admin.peserta.sertifikat.upload', $peserta) }}"
            data-nama="{{ $peserta->user->name }}"

            onclick="openUpload(this)">

            <i class="fa-solid fa-upload"></i>

            Upload

        </button> -->
        <!-- <form
                action="{{ route('admin.peserta.finalisasi',$peserta->event_id) }}"
                method="POST">

                @csrf

                <button
                    class="inline-flex items-center gap-2
                   px-3 py-2
                   rounded-xl
                   bg-indigo-600
                   hover:bg-indigo-700
                   text-white
                   text-xs
                   font-semibold"
                    onclick="return confirm('Yakin mau Finalisasi Event ini?')">

                    <i class="fas fa-flag-checkered "></i>

                    Selesaikan  Event

                </button>

        </form> -->

    @endif

</div>