<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center gap-3 mb-8">

        <div
            class="w-12 h-12 rounded-2xl
                   bg-red-100
                   flex items-center justify-center">

            <i class="fas fa-sliders text-red-600 text-xl"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Aksi Peserta

            </h2>

            <p class="text-slate-500">

                Kelola status, poin, sertifikat, catatan maupun data peserta.

            </p>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- BUTTON GRID --}}
    {{-- ========================================= --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

        {{-- Status --}}
        <button
            type="button"
            onclick="openStatus(this)"

            data-route="{{ route('admin.peserta.status',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"
            data-status="{{ $peserta->status }}"

            class="rounded-2xl border border-green-200 bg-green-50 hover:bg-green-100 transition p-6 text-left">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">

                    <i class="fas fa-user-check text-2xl text-green-600"></i>

                </div>

                <div>

                    <h3 class="font-bold text-green-700">

                        Update Status

                    </h3>

                    <p class="text-sm text-slate-500 mt-1">

                        Aktif, Lulus atau Tidak Lulus.

                    </p>

                </div>

            </div>

        </button>

        {{-- Point --}}
        <button
            type="button"
            onclick="openPoint(this)"

            data-route="{{ route('admin.peserta.poin',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"
            data-poin="{{ $peserta->poin }}"

            class="rounded-2xl border border-yellow-200 bg-yellow-50 hover:bg-yellow-100 transition p-6 text-left">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-xl bg-yellow-100 flex items-center justify-center">

                    <i class="fas fa-star text-2xl text-yellow-600"></i>

                </div>

                <div>

                    <h3 class="font-bold text-yellow-700">

                        Update Point

                    </h3>

                    <p class="text-sm text-slate-500 mt-1">

                        Tambah atau kurangi poin peserta.

                    </p>

                </div>

            </div>

        </button>

        {{-- Catatan --}}
        <button
            type="button"
            onclick="openCatatan(this)"

            data-route="{{ route('admin.peserta.update',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"
            data-catatan="{{ $peserta->catatan }}"

            class="rounded-2xl border border-blue-200 bg-blue-50 hover:bg-blue-100 transition p-6 text-left">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">

                    <i class="fas fa-note-sticky text-2xl text-blue-600"></i>

                </div>

                <div>

                    <h3 class="font-bold text-blue-700">

                        Edit Catatan

                    </h3>

                    <p class="text-sm text-slate-500 mt-1">

                        Tambahkan catatan internal admin.

                    </p>

                </div>

            </div>

        </button>

        {{-- Upload Sertifikat --}}
        <button
            type="button"
            onclick="openUpload(this)"

            data-route="{{ route('admin.peserta.sertifikat.upload',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"

            class="rounded-2xl border border-indigo-200 bg-indigo-50 hover:bg-indigo-100 transition p-6 text-left">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center">

                    <i class="fas fa-certificate text-2xl text-indigo-600"></i>

                </div>

                <div>

                    <h3 class="font-bold text-indigo-700">

                        Upload Sertifikat

                    </h3>

                    <p class="text-sm text-slate-500 mt-1">

                        Upload atau ganti sertifikat.

                    </p>

                </div>

            </div>

        </button>

        {{-- Detail Absensi --}}
        <a
            href="{{ route('admin.peserta.absensi',$peserta) }}"
            class="rounded-2xl border border-purple-200 bg-purple-50 hover:bg-purple-100 transition p-6">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center">

                    <i class="fas fa-calendar-check text-2xl text-purple-600"></i>

                </div>

                <div>

                    <h3 class="font-bold text-purple-700">

                        Detail Absensi

                    </h3>

                    <p class="text-sm text-slate-500 mt-1">

                        Lihat seluruh riwayat scan QR.

                    </p>

                </div>

            </div>

        </a>

        {{-- Hapus --}}
        <button
            type="button"
            onclick="openDelete(this)"

            data-route="{{ route('admin.peserta.destroy',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"

            class="rounded-2xl border border-red-200 bg-red-50 hover:bg-red-100 transition p-6 text-left">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center">

                    <i class="fas fa-trash text-2xl text-red-600"></i>

                </div>

                <div>

                    <h3 class="font-bold text-red-700">

                        Hapus Peserta

                    </h3>

                    <p class="text-sm text-slate-500 mt-1">

                        Menghapus data peserta beserta absensinya.

                    </p>

                </div>

            </div>

        </button>

    </div>

</div>