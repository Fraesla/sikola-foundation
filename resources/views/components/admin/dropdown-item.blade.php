<a

    {{ $attributes->merge([

        'class' => 'flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition text-sm text-slate-700'

    ]) }}

>

    {{ $slot }}

</a>