<div class="py-20 px-8 text-center">

    {{-- ========================================= --}}
    {{-- ICON --}}
    {{-- ========================================= --}}
    <div
        class="mx-auto
               w-28 h-28
               rounded-full
               bg-slate-100
               flex items-center
               justify-center">

        <i class="fas fa-users-slash text-5xl text-slate-400"></i>

    </div>

    {{-- ========================================= --}}
    {{-- TITLE --}}
    {{-- ========================================= --}}
    <h2
        class="mt-8
               text-3xl
               font-black
               text-slate-800">

        Belum Ada Peserta

    </h2>

    {{-- ========================================= --}}
    {{-- DESCRIPTION --}}
    {{-- ========================================= --}}
    <p
        class="mt-4
               max-w-2xl
               mx-auto
               text-slate-500
               leading-8">

        Event ini belum memiliki peserta yang aktif.
        Silakan lakukan proses registrasi peserta terlebih
        dahulu sebelum melakukan absensi.

    </p>

    {{-- ========================================= --}}
    {{-- INFO --}}
    {{-- ========================================= --}}
    <div
        class="mt-10
               inline-flex
               items-center
               gap-3
               px-6
               py-4
               rounded-2xl
               bg-amber-50
               border
               border-amber-200
               text-amber-700">

        <i class="fas fa-circle-info text-lg"></i>

        <span class="font-semibold">

            Tidak ada peserta yang dapat diabsen.

        </span>

    </div>

    {{-- ========================================= --}}
    {{-- ACTION --}}
    {{-- ========================================= --}}
    <div class="mt-10 flex flex-wrap justify-center gap-4">

        <a
            href="{{ route('admin.absensi.index') }}"
            class="inline-flex
                   items-center
                   gap-3
                   px-6
                   py-3
                   rounded-2xl
                   bg-slate-100
                   hover:bg-slate-200
                   text-slate-700
                   font-semibold
                   transition">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a
            href="{{ route('admin.event.show', $event) }}"
            class="inline-flex
                   items-center
                   gap-3
                   px-6
                   py-3
                   rounded-2xl
                   bg-blue-600
                   hover:bg-blue-700
                   text-white
                   font-semibold
                   transition">

            <i class="fas fa-calendar-days"></i>

            Lihat Detail Event

        </a>

    </div>

</div>