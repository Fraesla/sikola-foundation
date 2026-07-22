<div class="relative inline-block text-left">

    <button
        type="button"
        class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 transition"
        onclick="toggleDropdown(event,'dropdown-{{ $peserta->id }}')">

        <i class="fas fa-ellipsis-v text-slate-600"></i>

    </button>

    <div
        id="dropdown-{{ $peserta->id }}"
        class="hidden absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden z-40">

        {{-- Detail --}}
        <a
            href="{{ route('admin.peserta.show',$peserta) }}"
            class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50">

            <i class="fas fa-eye w-5 text-blue-500"></i>

            <span>Detail Peserta</span>

        </a>

        {{-- Absensi --}}
        <a
            href="{{ route('admin.peserta.absensi',$peserta) }}"
            class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50">

            <i class="fas fa-calendar-check w-5 text-green-500"></i>

            <span>Detail Absensi</span>

        </a>

        {{-- Riwayat --}}
        <a
            href="{{ route('admin.peserta.riwayat',$peserta->user) }}"
            class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50">

            <i class="fas fa-history w-5 text-purple-500"></i>

            <span>Riwayat Event</span>

        </a>

        <div class="border-t"></div>

        {{-- Status --}}
        <!-- <button
            type="button"
            class="flex w-full items-center gap-3 px-4 py-3 hover:bg-slate-50"

            data-route="{{ route('admin.peserta.status',$peserta) }}"
            data-status="{{ $peserta->status }}"

            onclick="openStatus(this)">

            <i class="fas fa-user-check w-5 text-cyan-500"></i>

            <span>Update Status</span>

        </button> -->

        {{-- Point --}}
        <!-- <button
            type="button"
            class="flex w-full items-center gap-3 px-4 py-3 hover:bg-slate-50"

            data-route="{{ route('admin.peserta.poin',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"
            data-poin="{{ $peserta->poin }}"

            onclick="openPoint(this)">

            <i class="fas fa-star w-5 text-yellow-500"></i>

            <span>Update Poin</span>

        </button> -->

        {{-- Catatan --}}
        <button
            type="button"
            class="flex w-full items-center gap-3 px-4 py-3 hover:bg-slate-50"

            data-route="{{ route('admin.peserta.update',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"
            data-catatan="{{ $peserta->catatan }}"

            onclick="openCatatan(this)">

            <i class="fas fa-sticky-note w-5 text-blue-500"></i>

            <span>Catatan</span>

        </button>

        <!-- {{-- Upload Sertifikat --}}
        <button
            type="button"
            class="flex w-full items-center gap-3 px-4 py-3 hover:bg-slate-50"

            data-route="{{ route('admin.peserta.sertifikat.upload',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"

            onclick="openUpload(this)">

            <i class="fas fa-file-upload w-5 text-indigo-500"></i>

            <span>Upload Sertifikat</span>

        </button> -->

        {{-- Download Sertifikat --}}
        @if($peserta->sertifikat)

            <a
                href="{{ route('admin.peserta.sertifikat.download',$peserta) }}"
                class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50">

                <i class="fas fa-download w-5 text-emerald-500"></i>

                <span>Download Sertifikat</span>

            </a>

        @endif

        <div class="border-t"></div>

        {{-- Delete --}}
        <button
            type="button"
            class="flex w-full items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50"

            data-route="{{ route('admin.peserta.destroy',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"

            onclick="openDelete(this)">

            <i class="fas fa-trash-alt w-5"></i>

            <span>Hapus Peserta</span>

        </button>

    </div>

</div>