{{-- ========================================================= --}}
{{-- MODAL UPDATE POIN PESERTA --}}
{{-- ========================================================= --}}

<div
    id="pointModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm px-4">

    <div
        class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden animate-fade-in">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>

                <h3 class="text-xl font-bold text-slate-800">

                    Update Poin Peserta

                </h3>

                <p class="text-sm text-slate-500 mt-1">

                    Tambah atau kurangi poin peserta event.

                </p>

            </div>

            <button
                type="button"
                onclick="closeModal('pointModal')"
                class="w-10 h-10 rounded-xl hover:bg-slate-100 transition">

                <i class="fas fa-times text-slate-500"></i>

            </button>

        </div>

        {{-- Form --}}
        <form
            id="pointForm"
            method="POST">

            @csrf
            @method('PATCH')

            <div class="p-6 space-y-5">

                {{-- Nama Peserta --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Nama Peserta

                    </label>

                    <input
                        type="text"
                        id="pointPeserta"
                        class="w-full rounded-xl border-slate-300 bg-slate-100"
                        readonly>

                </div>

                {{-- Poin --}}
                <div>

                    <label
                        for="poin"
                        class="block text-sm font-semibold text-slate-700 mb-2">

                        Jumlah Poin

                    </label>

                    <input
                        type="number"
                        id="poin"
                        name="poin"
                        min="0"
                        required
                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                </div>

                {{-- Informasi --}}
                <div
                    class="rounded-xl border border-amber-200 bg-amber-50 p-4">

                    <div class="flex gap-3">

                        <i class="fas fa-star text-amber-500 mt-1"></i>

                        <div class="text-sm text-amber-700">

                            Perubahan poin akan langsung memperbarui
                            <strong>Total Poin User</strong> sesuai logika
                            pada <strong>PesertaController</strong>.

                        </div>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div
                class="px-6 py-5 bg-slate-50 border-t flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeModal('pointModal')"
                    class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-100 transition">

                    Batal

                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-amber-500 text-white hover:bg-amber-600 transition">

                    <i class="fas fa-star mr-2"></i>

                    Update Poin

                </button>

            </div>

        </form>

    </div>

</div>