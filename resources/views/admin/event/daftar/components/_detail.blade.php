<div class="grid xl:grid-cols-3 gap-8">

    {{-- ========================================================= --}}
    {{-- PROFILE PESERTA --}}
    {{-- ========================================================= --}}

    <div class="xl:col-span-1">

        <div class="admin-card rounded-[32px] p-8">

            <div class="text-center">

                <div
                    class="w-32 h-32 rounded-full mx-auto flex items-center justify-center
                    text-5xl font-black text-white"
                    style="
                        background:
                        linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">

                    {{ strtoupper(substr($registrasi->user->name,0,1)) }}

                </div>

                <h2
                    class="text-2xl font-black mt-6"
                    style="color:var(--color-hitam);">

                    {{ $registrasi->user->name }}

                </h2>

                <p class="text-slate-500">

                    {{ $registrasi->user->email }}

                </p>

            </div>

            <hr class="my-8">

            <div class="space-y-5">

                <div class="flex justify-between">

                    <span class="text-slate-500">

                        Status

                    </span>

                    @include('admin.event.daftar.partials._badge',[
                        'item'=>$registrasi
                    ])

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-500">

                        Mendaftar

                    </span>

                    <strong>

                        {{ $registrasi->created_at->format('d M Y') }}

                    </strong>

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-500">

                        Jam

                    </span>

                    <strong>

                        {{ $registrasi->created_at->format('H:i') }}

                    </strong>

                </div>

            </div>

        </div>

    </div>

    {{-- ========================================================= --}}
    {{-- DETAIL EVENT --}}
    {{-- ========================================================= --}}

    <div class="xl:col-span-2">

        <div class="admin-card rounded-[32px] overflow-hidden">

            @if($registrasi->event->gambar)

                <img
                    src="{{ asset('storage/'.$registrasi->event->gambar) }}"
                    class="w-full h-72 object-cover">

            @endif

            <div class="p-8">

                <span
                    class="inline-flex px-4 py-2 rounded-full bg-red-100 text-red-600 font-semibold">

                    📅 EVENT

                </span>

                <h1
                    class="text-4xl font-black mt-5"
                    style="color:var(--color-hitam);">

                    {{ $registrasi->event->judul }}

                </h1>

                <p
                    class="mt-5 leading-8 text-slate-600">

                    {{ $registrasi->event->deskripsi }}

                </p>

                <div class="grid md:grid-cols-2 gap-6 mt-10">

                    <div class="admin-card rounded-2xl p-5">

                        <small class="text-slate-500">

                            Lokasi

                        </small>

                        <h4 class="font-bold mt-2">

                            📍 {{ $registrasi->event->lokasi }}

                        </h4>

                    </div>

                    <div class="admin-card rounded-2xl p-5">

                        <small class="text-slate-500">

                            Tanggal

                        </small>

                        <h4 class="font-bold mt-2">

                            📅

                            {{ $registrasi->event->tanggal_mulai->format('d M Y H:i') }}

                        </h4>

                    </div>

                    <div class="admin-card rounded-2xl p-5">

                        <small class="text-slate-500">

                            Reward

                        </small>

                        <h4 class="font-bold mt-2 text-green-600">

                            +{{ $registrasi->event->poin_reward }} Point

                        </h4>

                    </div>

                    <div class="admin-card rounded-2xl p-5">

                        <small class="text-slate-500">

                            Penalty

                        </small>

                        <h4 class="font-bold mt-2 text-red-600">

                            -{{ $registrasi->event->poin_penalty }} Point

                        </h4>

                    </div>

                </div>

                <div class="mt-10">

                    @include('admin.event.daftar.partials._timeline')

                </div>

            </div>

        </div>

    </div>

</div>