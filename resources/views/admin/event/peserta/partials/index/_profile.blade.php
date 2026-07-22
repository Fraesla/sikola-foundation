<div class="flex items-center gap-4">

    {{-- ========================================= --}}
    {{-- FOTO --}}
    {{-- ========================================= --}}

    @if($peserta->user && $peserta->user->foto)

        <img
            src="{{ asset('storage/'.$peserta->user->foto) }}"
            alt="{{ $peserta->user->name }}"
            class="w-14 h-14 rounded-full object-cover border">

    @else

        <div
            class="w-14 h-14 rounded-full flex items-center justify-center
                   font-bold text-lg text-white
                   bg-gradient-to-r from-blue-500 to-indigo-600">

            {{ strtoupper(substr($peserta->user->name ?? 'U',0,1)) }}

        </div>

    @endif

    {{-- ========================================= --}}
    {{-- INFORMASI --}}
    {{-- ========================================= --}}

    <div class="min-w-0 flex-1">

        <h5
            class="font-bold text-slate-800 truncate">

            {{ $peserta->user->name }}

        </h5>

        <p
            class="text-sm text-slate-500 truncate">

            {{ $peserta->user->email }}

        </p>

        <div
            class="flex items-center gap-2 mt-2">

            <span
                class="inline-flex items-center px-2 py-1 rounded-lg
                       bg-slate-100 text-slate-600 text-xs">

                ID :
                #{{ str_pad($peserta->id,5,'0',STR_PAD_LEFT) }}

            </span>

        </div>

    </div>

</div>