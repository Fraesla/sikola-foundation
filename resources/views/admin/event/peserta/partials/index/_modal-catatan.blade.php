{{-- ========================================================= --}}
{{-- MODAL UPDATE CATATAN PESERTA --}}
{{-- ========================================================= --}}

<div
    id="catatanModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm px-4">

    <div
        class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden animate-fade-in">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>

                <h3 class="text-xl font-bold text-slate-800">

                    Catatan Peserta

                </h3>

                <p class="text-sm text-slate-500 mt-1">

                    Tambahkan catatan atau evaluasi peserta.

                </p>

            </div>

            <button
                type="button"
                onclick="closeModal('catatanModal')"
                class="w-10 h-10 rounded-xl hover:bg-slate-100 transition">

                <i class="fas fa-times text-slate-500"></i>

            </button>

        </div>

        {{-- Form --}}
        <form
            id="catatanForm"
            method="POST">

            @csrf
            @method('PUT')

            <div class="p-6 space-y-5">

                {{-- Nama Peserta --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Nama Peserta

                    </label>

                    <input
                        type="text"
                        id="catatanPeserta"
                        class="w-full rounded-xl border-slate-300 bg-slate-100"
                        readonly>

                </div>

                {{-- Catatan --}}
                <div>

                    <label
                        for="catatan"
                        class="block text-sm font-semibold text-slate-700 mb-2">

                        Catatan

                    </label>

                    <textarea
                        id="catatan"
                        name="catatan"
                        rows="6"
                        placeholder="Masukkan catatan peserta..."
                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 resize-none"></textarea>

                </div>

                {{-- Informasi --}}
                <div
                    class="rounded-xl border border-blue-200 bg-blue-50 p-4">

                    <div class="flex gap-3">

                        <i class="fas fa-info-circle text-blue-500 mt-1"></i>

                        <div class="text-sm text-blue-700">

                            Catatan ini hanya digunakan oleh admin sebagai
                            evaluasi peserta dan tidak ditampilkan kepada peserta.

                        </div>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div
                class="px-6 py-5 bg-slate-50 border-t flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeModal('catatanModal')"
                    class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-100 transition">

                    Batal

                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">

                    <i class="fas fa-save mr-2"></i>

                    Simpan Catatan

                </button>

            </div>

        </form>

    </div>

</div>