@props([
    'variant' => 'primary',
    'size' => 'md',
    'loading' => false,
    'type' => 'button',
])

@php

$variants = [

    'primary' => 'bg-blue-600 hover:bg-blue-700 text-white',

    'secondary' => 'bg-slate-600 hover:bg-slate-700 text-white',

    'success' => 'bg-green-600 hover:bg-green-700 text-white',

    'danger' => 'bg-red-600 hover:bg-red-700 text-white',

    'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white',

    'purple' => 'bg-purple-600 hover:bg-purple-700 text-white',

    'outline' => 'border border-slate-300 bg-white hover:bg-slate-100 text-slate-700',

];

$sizes = [

    'sm' => 'px-3 py-2 text-sm',

    'md' => 'px-5 py-2.5 text-sm',

    'lg' => 'px-6 py-3 text-base',

];

@endphp

<button

    type="{{ $type }}"

    {{ $attributes->merge([

        'class' => implode(' ', [

            'inline-flex',

            'items-center',

            'justify-center',

            'gap-2',

            'rounded-xl',

            'font-semibold',

            'transition',

            'duration-200',

            'shadow-sm',

            'focus:outline-none',

            'focus:ring-4',

            'disabled:opacity-60',

            'disabled:pointer-events-none',

            $variants[$variant] ?? $variants['primary'],

            $sizes[$size] ?? $sizes['md'],

        ])

    ]) }}

>

    @if($loading)

        <svg

            class="animate-spin h-4 w-4"

            xmlns="http://www.w3.org/2000/svg"

            fill="none"

            viewBox="0 0 24 24">

            <circle

                class="opacity-25"

                cx="12"

                cy="12"

                r="10"

                stroke="currentColor"

                stroke-width="4">

            </circle>

            <path

                class="opacity-75"

                fill="currentColor"

                d="M4 12a8 8 0 018-8v4l3-3-3-3v4A10 10 0 002 12h2z">

            </path>

        </svg>

    @endif

    {{ $slot }}

</button>