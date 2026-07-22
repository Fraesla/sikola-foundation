<div class="py-20 text-center">

    {{-- ========================================= --}}
    {{-- ICON --}}
    {{-- ========================================= --}}
    <div
        class="mx-auto
               w-28 h-28
               rounded-full
               bg-slate-100
               flex items-center justify-center">

        <i class="fas fa-calendar-xmark text-5xl text-slate-400"></i>

    </div>

    {{-- ========================================= --}}
    {{-- TITLE --}}
    {{-- ========================================= --}}
    <h3
        class="mt-8
               text-3xl
               font-black
               text-slate-800">

        Belum Ada Riwayat Event

    </h3>

    {{-- ========================================= --}}
    {{-- DESCRIPTION --}}
    {{-- ========================================= --}}
    <p
        class="mt-4
               max-w-xl
               mx-auto
               text-slate-500
               leading-8">

        Peserta ini belum pernah mengikuti event apa pun.
        Setelah mengikuti event, seluruh riwayat kehadiran,
        poin, sertifikat, dan status kelulusan akan muncul
        pada halaman ini.

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
               bg-blue-50
               border
               border-blue-100
               text-blue-700">

        <i class="fas fa-circle-info text-xl"></i>

        <span class="font-semibold">

            Belum terdapat data riwayat event.

        </span>

    </div>

    {{-- ========================================= --}}
    {{-- BUTTON --}}
    {{-- ========================================= --}}
    <div class="mt-10">

        <a
            href="{{ route('admin.peserta.index') }}"
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

            <i class="fas fa-arrow-left"></i>

            Kembali ke Data Peserta

        </a>

    </div>

</div>