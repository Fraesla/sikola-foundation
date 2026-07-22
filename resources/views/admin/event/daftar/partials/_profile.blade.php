<div class="flex items-center gap-4">

    <div
        class="w-16 h-16 rounded-full flex items-center justify-center text-white font-black text-xl"
        style="
            background:
            linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
        ">

        {{ strtoupper(substr($item->user->name ?? 'U',0,1)) }}

    </div>

    <div class="flex-1">

        <h3
            class="text-xl font-black"
            style="color:var(--color-hitam);">

            {{ $item->user->name }}

        </h3>

        <p
            class="text-sm text-slate-500">

            {{ $item->user->email }}

        </p>

    </div>

</div>