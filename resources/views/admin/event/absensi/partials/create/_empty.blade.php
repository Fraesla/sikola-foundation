<div class="admin-card rounded-3xl overflow-hidden">

    {{-- ========================================= --}}
    {{-- EMPTY STATE --}}
    {{-- ========================================= --}}
    <div class="py-20 px-8 text-center">

        {{-- ICON --}}
        <div
            class="w-28 h-28 mx-auto
                   rounded-full
                   bg-slate-100
                   flex items-center justify-center">

            <i
                class="fas fa-user-slash
                       text-5xl
                       text-slate-400">

            </i>

        </div>

        {{-- TITLE --}}
        <h2
            class="mt-8
                   text-3xl
                   font-black
                   text-slate-800">

            Belum Ada Peserta

        </h2>

        {{-- DESCRIPTION --}}
        <p
            class="mt-4
                   max-w-2xl
                   mx-auto
                   leading-8
                   text-slate-500">

            Event ini belum memiliki peserta aktif sehingga
            absensi belum dapat dilakukan.

            Silakan tambahkan peserta terlebih dahulu
            melalui menu <strong>Peserta Event</strong>.

        </p>

        {{-- ACTION --}}
        <div
            class="mt-10
                   flex
                   flex-col
                   sm:flex-row
                   justify-center
                   gap-4">

            <a
                href="{{ route('admin.absensi.peserta', $event) }}"
                class="inline-flex items-center justify-center
                       gap-3
                       px-6 py-3
                       rounded-2xl
                       bg-blue-600
                       hover:bg-blue-700
                       text-white
                       font-semibold">

                <i class="fas fa-users"></i>

                Lihat Peserta

            </a>

            <a
                href="{{ route('admin.absensi.index') }}"
                class="inline-flex items-center justify-center
                       gap-3
                       px-6 py-3
                       rounded-2xl
                       bg-slate-100
                       hover:bg-slate-200
                       text-slate-700
                       font-semibold">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </div>

</div>