<div class="admin-card rounded-3xl p-6">

    <form method="GET">

        <div class="grid lg:grid-cols-12 gap-4">

            <div class="lg:col-span-6">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama peserta, email, atau event..."
                    class="w-full rounded-2xl border px-5 py-3">

            </div>

            <div class="lg:col-span-3">

                <select
                    name="status"
                    class="w-full rounded-2xl border px-5 py-3">

                    <option value="">

                        Semua Status

                    </option>

                    <option
                        value="mendaftar"
                        @selected(request('status')=='mendaftar')>

                        Mendaftar

                    </option>

                    <option
                        value="dikonfirmasi"
                        @selected(request('status')=='dikonfirmasi')>

                        Dikonfirmasi

                    </option>

                    <option
                        value="ditolak"
                        @selected(request('status')=='ditolak')>

                        Ditolak

                    </option>

                </select>

            </div>

            <div class="lg:col-span-3">

                <button
                    class="w-full rounded-2xl py-3 text-white font-semibold"
                    style="background:linear-gradient(135deg,var(--color-merah),var(--color-coklat));">

                    🔍 Cari Data

                </button>

            </div>

        </div>

    </form>

</div>