<div class="grid xl:grid-cols-3 lg:grid-cols-2 gap-8">

@forelse($registrasi as $item)

<div
    class="admin-card rounded-[30px] overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition duration-300">

    {{-- Header --}}
    <div
        class="px-7 py-6 border-b bg-gradient-to-r from-red-50 to-yellow-50">

        @include('admin.event.daftar.partials._profile')

    </div>

    {{-- Body --}}
    <div class="p-7">

        <div class="space-y-5">

            <div>

                <small class="text-slate-500">

                    EVENT

                </small>

                <h2
                    class="text-xl font-black mt-1"
                    style="color:var(--color-hitam);">

                    {{ $item->event->judul }}

                </h2>

            </div>

            <div class="space-y-3">

                <div class="flex justify-between">

                    <span class="text-slate-500">

                        📍 Lokasi

                    </span>

                    <strong>

                        {{ $item->event->lokasi }}

                    </strong>

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-500">

                        📅 Event

                    </span>

                    <strong>

                        {{ $item->event->tanggal_mulai->format('d M Y') }}

                    </strong>

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-500">

                        📝 Daftar

                    </span>

                    <strong>

                        {{ $item->created_at->format('d M Y H:i') }}

                    </strong>

                </div>

            </div>

            {{-- Badge --}}
            @include('admin.event.daftar.partials._badge')

            {{-- Progress --}}
            @include('admin.event.daftar.partials._progress')

        </div>

        <div class="mt-8">

            @include('admin.event.daftar.partials._action')

        </div>

    </div>

</div>

@empty

<div class="col-span-full">

    @include('admin.event.daftar.components._empty')

</div>

@endforelse

</div>