@props([
    'value',
    'capitalize' => true,
])

@php

$status = strtolower(trim($value));

$badges = [

    /*
    |--------------------------------------------------------------------------
    | Hijau
    |--------------------------------------------------------------------------
    */

    'aktif'          => 'bg-green-100 text-green-700',

    'lulus'          => 'bg-green-100 text-green-700',

    'selesai'        => 'bg-green-100 text-green-700',

    'berhasil'       => 'bg-green-100 text-green-700',

    'dikonfirmasi'   => 'bg-green-100 text-green-700',

    'published'      => 'bg-green-100 text-green-700',

    /*
    |--------------------------------------------------------------------------
    | Biru
    |--------------------------------------------------------------------------
    */

    'terbuka'        => 'bg-blue-100 text-blue-700',

    'diproses'       => 'bg-blue-100 text-blue-700',

    'aktif_member'   => 'bg-blue-100 text-blue-700',

    /*
    |--------------------------------------------------------------------------
    | Kuning
    |--------------------------------------------------------------------------
    */

    'pending'        => 'bg-yellow-100 text-yellow-700',

    'mendaftar'      => 'bg-yellow-100 text-yellow-700',

    'menunggu'       => 'bg-yellow-100 text-yellow-700',

    /*
    |--------------------------------------------------------------------------
    | Merah
    |--------------------------------------------------------------------------
    */

    'ditolak'        => 'bg-red-100 text-red-700',

    'dibatalkan'     => 'bg-red-100 text-red-700',

    'tidak_lulus'    => 'bg-red-100 text-red-700',

    'nonaktif'       => 'bg-red-100 text-red-700',

    /*
    |--------------------------------------------------------------------------
    | Abu
    |--------------------------------------------------------------------------
    */

    'draft'          => 'bg-slate-100 text-slate-700',

    'expired'        => 'bg-slate-100 text-slate-700',

];

$class = $badges[$status]
    ?? 'bg-slate-100 text-slate-700';

$text = $capitalize
    ? ucwords(str_replace('_',' ', $value))
    : $value;

@endphp

<span

    {{ $attributes->merge([

        'class' => "inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {$class}"

    ]) }}

>

    {{ $text }}

</span>