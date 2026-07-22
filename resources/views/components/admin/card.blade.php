@props([
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'color' => 'blue',
])

@php

$colors = [

    'blue' => [
        'header' => 'bg-blue-50 border-blue-200',
        'icon'   => 'bg-blue-100 text-blue-600',
    ],

    'green' => [
        'header' => 'bg-green-50 border-green-200',
        'icon'   => 'bg-green-100 text-green-600',
    ],

    'red' => [
        'header' => 'bg-red-50 border-red-200',
        'icon'   => 'bg-red-100 text-red-600',
    ],

    'yellow' => [
        'header' => 'bg-yellow-50 border-yellow-200',
        'icon'   => 'bg-yellow-100 text-yellow-600',
    ],

    'purple' => [
        'header' => 'bg-purple-50 border-purple-200',
        'icon'   => 'bg-purple-100 text-purple-600',
    ],

];

$style = $colors[$color] ?? $colors['blue'];

@endphp

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

    @if($title)

        <div class="px-6 py-5 border-b {{ $style['header'] }}">

            <div class="flex items-center gap-4">

                @if($icon)

                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $style['icon'] }}">

                        <i class="{{ $icon }} text-xl"></i>

                    </div>

                @endif

                <div>

                    <h2 class="text-xl font-bold text-slate-800">

                        {{ $title }}

                    </h2>

                    @if($subtitle)

                        <p class="text-sm text-slate-500 mt-1">

                            {{ $subtitle }}

                        </p>

                    @endif

                </div>

            </div>

        </div>

    @endif

    <div class="p-6">

        {{ $slot }}

    </div>

</div>