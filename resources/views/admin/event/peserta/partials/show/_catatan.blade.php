<div class="admin-card rounded-3xl p-8">

    {{-- ========================================= --}}
    {{-- HEADER --}}
    {{-- ========================================= --}}
    <div class="flex items-center justify-between mb-8">

        <div class="flex items-center gap-3">

            <div
                class="w-12 h-12 rounded-2xl
                       bg-amber-100
                       flex items-center justify-center">

                <i class="fas fa-note-sticky text-amber-600 text-xl"></i>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Catatan Admin

                </h2>

                <p class="text-slate-500">

                    Catatan khusus mengenai peserta.

                </p>

            </div>

        </div>

        <button
            type="button"

            class="inline-flex items-center gap-2
                   px-4 py-3 rounded-xl
                   bg-indigo-600 hover:bg-indigo-700
                   text-white text-sm font-semibold"

            data-route="{{ route('admin.peserta.update',$peserta) }}"
            data-nama="{{ $peserta->user->name }}"
            data-catatan="{{ $peserta->catatan }}"

            onclick="openCatatan(this)">

            <i class="fas fa-pen"></i>

            Edit Catatan

        </button>

    </div>

    {{-- ========================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================= --}}

    @if($peserta->catatan)

        <div
            class="rounded-2xl
                   border border-slate-200
                   bg-slate-50
                   p-6">

            <p
                class="text-slate-700
                       leading-8
                       whitespace-pre-line">

                {{ $peserta->catatan }}

            </p>

        </div>

    @else

        <div
            class="rounded-2xl
                   border-2 border-dashed
                   border-slate-300
                   bg-slate-50
                   p-12">

            <div class="text-center">

                <div
                    class="w-20 h-20 mx-auto
                           rounded-full
                           bg-slate-200
                           flex items-center justify-center">

                    <i class="fas fa-note-sticky text-3xl text-slate-500"></i>

                </div>

                <h3
                    class="mt-5
                           text-xl
                           font-bold
                           text-slate-700">

                    Belum Ada Catatan

                </h3>

                <p
                    class="mt-2
                           text-slate-500
                           max-w-xl
                           mx-auto">

                    Admin belum menambahkan catatan untuk peserta ini.
                    Gunakan tombol <strong>Edit Catatan</strong>
                    untuk menambahkan informasi tambahan.

                </p>

            </div>

        </div>

    @endif

    {{-- ========================================= --}}
    {{-- INFO --}}
    {{-- ========================================= --}}

    <div
        class="mt-8
               rounded-2xl
               border border-blue-100
               bg-blue-50
               p-5">

        <div class="flex gap-3">

            <i class="fas fa-circle-info text-blue-600 mt-1"></i>

            <div>

                <h4 class="font-bold text-blue-700">

                    Informasi

                </h4>

                <p
                    class="text-sm
                           text-blue-600
                           mt-1
                           leading-6">

                    Catatan hanya dapat dilihat oleh admin dan digunakan
                    sebagai dokumentasi internal mengenai perkembangan,
                    evaluasi, maupun informasi penting peserta.

                </p>

            </div>

        </div>

    </div>

</div>