<div class="admin-card rounded-3xl p-8">

    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">

        {{-- ========================================= --}}
        {{-- INFORMASI PESERTA --}}
        {{-- ========================================= --}}
        <div class="flex items-center gap-6">

            {{-- Foto --}}
            @if($peserta->user->foto)

                <img
                    src="{{ asset('storage/'.$peserta->user->foto) }}"
                    class="w-24 h-24 rounded-full object-cover border-4 border-blue-100 shadow">

            @else

                <div
                    class="w-24 h-24 rounded-full
                           bg-blue-100
                           flex items-center justify-center">

                    <i class="fas fa-user text-4xl text-blue-600"></i>

                </div>

            @endif

            {{-- Biodata --}}
            <div>

                <span
                    class="inline-flex items-center gap-2
                           px-3 py-1 rounded-full
                           bg-blue-100 text-blue-700
                           text-sm font-semibold">

                    <i class="fas fa-qrcode"></i>

                    Detail Absensi Peserta

                </span>

                <h1 class="text-3xl font-black text-slate-800 mt-3">

                    {{ $peserta->user->name }}

                </h1>

                <div class="mt-2 text-slate-500">

                    {{ $peserta->user->email }}

                </div>

                <div class="mt-3 flex flex-wrap gap-3">

                    <span
                        class="px-3 py-2 rounded-xl
                               bg-slate-100 text-slate-700
                               text-sm">

                        <i class="fas fa-calendar mr-2"></i>

                        {{ $peserta->event->judul }}

                    </span>

                    <span
                        class="px-3 py-2 rounded-xl
                               bg-green-100 text-green-700
                               text-sm">

                        <i class="fas fa-user-check mr-2"></i>

                        {{ ucfirst(str_replace('_',' ',$peserta->status)) }}

                    </span>

                </div>

            </div>

        </div>

        {{-- ========================================= --}}
        {{-- ACTION --}}
        {{-- ========================================= --}}
        <div class="flex flex-wrap gap-3">

            <a
                href="{{ route('admin.peserta.show',$peserta) }}"
                class="inline-flex items-center gap-2
                       px-5 py-3 rounded-xl
                       bg-indigo-600
                       hover:bg-indigo-700
                       text-white font-semibold">

                <i class="fas fa-user"></i>

                Detail Peserta

            </a>

            <a
                href="{{ route('admin.peserta.index') }}"
                class="inline-flex items-center gap-2
                       px-5 py-3 rounded-xl
                       bg-slate-100
                       hover:bg-slate-200
                       text-slate-700 font-semibold">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </div>

</div>