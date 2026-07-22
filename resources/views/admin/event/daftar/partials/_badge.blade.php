@if($item->status=='mendaftar')

<span
    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">

    🟡 Menunggu Konfirmasi

</span>

@elseif($item->status=='dikonfirmasi')

<span
    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

    🟢 Dikonfirmasi

</span>

@else

<span
    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold">

    🔴 Ditolak

</span>

@endif