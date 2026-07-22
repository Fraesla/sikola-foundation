@php

$kuota = $item->event->kuota ?? 0;

$terdaftar = $item->event
    ->registrasis()
    ->where('status','dikonfirmasi')
    ->count();

$persen = $kuota
    ? min(
        100,
        round(($terdaftar/$kuota)*100)
    )
    : 0;

@endphp

<div class="mt-6">

    <div
        class="flex justify-between text-sm mb-2">

        <span>

            Kuota Event

        </span>

        <strong>

            {{ $terdaftar }}

            /

            {{ $kuota }}

        </strong>

    </div>

    <div
        class="h-3 rounded-full bg-slate-200">

        <div
            class="h-3 rounded-full"
            style="
                width:{{ $persen }}%;
                background:
                linear-gradient(
                    90deg,
                    var(--color-merah),
                    var(--color-kuning)
                );
            ">

        </div>

    </div>

    <div
        class="text-right mt-2 text-xs text-slate-500">

        {{ $persen }}%

    </div>

</div>