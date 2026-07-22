<div class="admin-card rounded-3xl p-6">

    <form
        method="GET"
        action="{{ route('admin.absensi.index') }}">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-5">

            {{-- ========================================= --}}
            {{-- SEARCH --}}
            {{-- ========================================= --}}
            <div class="md:col-span-5">

                <label class="block text-sm font-semibold text-slate-600 mb-2">

                    Cari Event

                </label>

                <div class="relative">

                    <i
                        class="fas fa-search absolute
                               left-4 top-1/2 -translate-y-1/2
                               text-slate-400">

                    </i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Judul event atau lokasi..."

                        class="w-full pl-11 pr-4 py-3
                               rounded-2xl border
                               border-slate-200
                               focus:border-green-500
                               focus:ring-4
                               focus:ring-green-100">

                </div>

            </div>

            {{-- ========================================= --}}
            {{-- STATUS --}}
            {{-- ========================================= --}}
            <div class="md:col-span-3">

                <label class="block text-sm font-semibold text-slate-600 mb-2">

                    Status Event

                </label>

                <select
                    name="status"
                    class="w-full px-4 py-3
                           rounded-2xl
                           border border-slate-200
                           focus:border-green-500
                           focus:ring-4
                           focus:ring-green-100">

                    <option value="">

                        Semua Status

                    </option>

                    <option
                        value="terbuka"
                        @selected(request('status')=='terbuka')>

                        Terbuka

                    </option>

                    <option
                        value="selesai"
                        @selected(request('status')=='selesai')>

                        Selesai

                    </option>

                    <option
                        value="ditutup"
                        @selected(request('status')=='ditutup')>

                        Ditutup

                    </option>

                </select>

            </div>

            {{-- ========================================= --}}
            {{-- BUTTON --}}
            {{-- ========================================= --}}
            <div
                class="md:col-span-4
                       flex items-end
                       gap-3">

                <button
                    type="submit"

                    class="inline-flex items-center gap-2
                           px-6 py-3
                           rounded-2xl
                           bg-green-600
                           hover:bg-green-700
                           text-white
                           font-semibold">

                    <i class="fas fa-search"></i>

                    Cari

                </button>

                <a
                    href="{{ route('admin.absensi.index') }}"

                    class="inline-flex items-center gap-2
                           px-6 py-3
                           rounded-2xl
                           bg-slate-100
                           hover:bg-slate-200
                           text-slate-700
                           font-semibold">

                    <i class="fas fa-rotate-left"></i>

                    Reset

                </a>

            </div>

        </div>

    </form>

</div>