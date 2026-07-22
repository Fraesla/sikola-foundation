<div class="admin-card rounded-3xl p-8">

    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">

        {{-- ========================================= --}}
        {{-- PROFIL USER --}}
        {{-- ========================================= --}}
        <div class="flex items-center gap-6">

            {{-- Foto --}}
            @if($user->foto)

                <img
                    src="{{ asset('storage/'.$user->foto) }}"
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
                           bg-indigo-100 text-indigo-700
                           text-sm font-semibold">

                    <i class="fas fa-clock-rotate-left"></i>

                    Riwayat Event Peserta

                </span>

                <h1 class="text-3xl font-black text-slate-800 mt-3">

                    {{ $user->name }}

                </h1>

                <p class="mt-2 text-slate-500">

                    {{ $user->email }}

                </p>

                <div class="mt-4 flex flex-wrap gap-3">

                    <span
                        class="px-4 py-2 rounded-xl
                               bg-slate-100 text-slate-700
                               text-sm font-medium">

                        <i class="fas fa-calendar-check mr-2"></i>

                        {{ $pesertas->total() }} Event Diikuti

                    </span>

                    <span
                        class="px-4 py-2 rounded-xl
                               bg-green-100 text-green-700
                               text-sm font-medium">

                        <i class="fas fa-user-check mr-2"></i>

                        Peserta Aktif

                    </span>

                </div>

            </div>

        </div>

        {{-- ========================================= --}}
        {{-- ACTION --}}
        {{-- ========================================= --}}
        <div class="flex flex-wrap gap-3">

            <a
                href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2
                       px-5 py-3 rounded-xl
                       bg-slate-100
                       hover:bg-slate-200
                       text-slate-700
                       font-semibold">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </div>

</div>