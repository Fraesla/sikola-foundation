<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    {{-- ========================================= --}}
    {{-- TOTAL PESERTA --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Total Peserta

                </p>

                <h2
                    class="text-4xl font-black mt-2"
                    style="color: var(--color-hitam);">

                    {{ number_format($totalPeserta) }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">

                <i class="fas fa-users text-2xl text-blue-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- PESERTA AKTIF --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Peserta Aktif

                </p>

                <h2
                    class="text-4xl font-black mt-2 text-green-600">

                    {{ number_format($pesertaAktif) }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">

                <i class="fas fa-user-check text-2xl text-green-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- LULUS --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Peserta Lulus

                </p>

                <h2
                    class="text-4xl font-black mt-2 text-indigo-600">

                    {{ number_format($pesertaLulus) }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center">

                <i class="fas fa-award text-2xl text-indigo-600"></i>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- TIDAK LULUS --}}
    {{-- ========================================= --}}
    <div class="admin-card rounded-3xl p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">

                    Tidak Lulus

                </p>

                <h2
                    class="text-4xl font-black mt-2 text-red-600">

                    {{ number_format($pesertaTidakLulus) }}

                </h2>

            </div>

            <div
                class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">

                <i class="fas fa-user-times text-2xl text-red-600"></i>

            </div>

        </div>

    </div>

</div>