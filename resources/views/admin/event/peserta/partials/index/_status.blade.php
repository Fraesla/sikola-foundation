@switch($peserta->status)

    @case('aktif')

        <span
            class="inline-flex items-center gap-2 px-3 py-2 rounded-full
                   bg-green-100 text-green-700 text-xs font-bold">

            <span class="w-2 h-2 rounded-full bg-green-500"></span>

            Aktif

        </span>

    @break


    @case('lulus')

        <span
            class="inline-flex items-center gap-2 px-3 py-2 rounded-full
                   bg-blue-100 text-blue-700 text-xs font-bold">

            <span class="w-2 h-2 rounded-full bg-blue-500"></span>

            Lulus

        </span>

    @break


    @case('tidak_lulus')

        <span
            class="inline-flex items-center gap-2 px-3 py-2 rounded-full
                   bg-red-100 text-red-700 text-xs font-bold">

            <span class="w-2 h-2 rounded-full bg-red-500"></span>

            Tidak Lulus

        </span>

    @break


    @case('noaktif')

        <span
            class="inline-flex items-center gap-2 px-3 py-2 rounded-full
                   bg-gray-100 text-gray-700 text-xs font-bold">

            <span class="w-2 h-2 rounded-full bg-gray-500"></span>

            Non Aktif

        </span>

    @break


    @default

        <span
            class="inline-flex items-center gap-2 px-3 py-2 rounded-full
                   bg-yellow-100 text-yellow-700 text-xs font-bold">

            <span class="w-2 h-2 rounded-full bg-yellow-500"></span>

            Tidak Diketahui

        </span>

@endswitch