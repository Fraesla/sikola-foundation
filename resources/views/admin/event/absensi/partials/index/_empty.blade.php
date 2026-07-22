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

        <i class="fas fa-calendar-xmark text-5xl text-slate-400"></i>

    </div>

    {{-- ========================================= --}}
    {{-- TITLE --}}
    {{-- ========================================= --}}
    <h2
        class="mt-8
               text-3xl
               font-black
               text-slate-800">

        Belum Ada Event

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

        Saat ini belum terdapat event yang dapat dilakukan
        proses absensi. Silakan tambahkan event terlebih
        dahulu agar peserta dapat melakukan check-in dan
        admin dapat mengelola absensi.

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

        <i class="fas fa-circle-info text-lg"></i>

        <span class="font-semibold">

            Tidak ada data event yang tersedia.

        </span>

    </div>

    {{-- ========================================= --}}
    {{-- ACTION --}}
    {{-- ========================================= --}}
    <div class="mt-10">

        <a
            href="{{ route('admin.events.index') }}"
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

            <i class="fas fa-plus-circle"></i>

            Kelola Event

        </a>

    </div>

</div>