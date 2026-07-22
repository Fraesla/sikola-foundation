<div class="admin-card rounded-3xl p-6">

    <form
        action="{{ route('admin.peserta.index') }}"
        method="GET">

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5">

            {{-- ========================================= --}}
            {{-- SEARCH --}}
            {{-- ========================================= --}}
            <div class="xl:col-span-2">

                <label class="block text-sm font-semibold mb-2">

                    Cari Peserta

                </label>

                <div class="relative">

                    <i
                        class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    </i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nama atau Email..."

                        class="w-full rounded-2xl border border-slate-200 pl-11 pr-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>

            </div>

            {{-- ========================================= --}}
            {{-- EVENT --}}
            {{-- ========================================= --}}
            <div>

                <label class="block text-sm font-semibold mb-2">

                    Event

                </label>

                <select
                    name="event"
                    class="w-full rounded-2xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-blue-500">

                    <option value="">

                        Semua Event

                    </option>

                    @foreach($events as $event)

                        <option
                            value="{{ $event->id }}"
                            @selected(request('event') == $event->id)>

                            {{ $event->judul }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- ========================================= --}}
            {{-- STATUS --}}
            {{-- ========================================= --}}
            <div>

                <label class="block text-sm font-semibold mb-2">

                    Status

                </label>

                <select
                    name="status"
                    class="w-full rounded-2xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-blue-500">

                    <option value="">

                        Semua Status

                    </option>

                    <option
                        value="aktif"
                        @selected(request('status')=='aktif')>

                        Aktif

                    </option>

                    <option
                        value="lulus"
                        @selected(request('status')=='lulus')>

                        Lulus

                    </option>

                    <option
                        value="tidak_lulus"
                        @selected(request('status')=='tidak_lulus')>

                        Tidak Lulus

                    </option>

                    <option
                        value="noaktif"
                        @selected(request('status')=='noaktif')>

                        Non Aktif

                    </option>

                </select>

            </div>

            {{-- ========================================= --}}
            {{-- BUTTON --}}
            {{-- ========================================= --}}
            <div class="flex items-end gap-3">

                <button
                    type="submit"
                    class="flex-1 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 transition">

                    <i class="fas fa-search mr-2"></i>

                    Cari

                </button>

                <a
                    href="{{ route('admin.peserta.index') }}"
                    class="rounded-2xl border border-slate-300 hover:bg-slate-100 px-5 py-3 transition">

                    <i class="fas fa-rotate-right"></i> Reset

                </a>

            </div>

        </div>

    </form>

</div>