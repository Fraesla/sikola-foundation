{{-- ========================================================= --}}
{{-- MODAL HAPUS PESERTA --}}
{{-- ========================================================= --}}

<div
    id="deleteModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm px-4">

    <div
        class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden animate-fade-in">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>

                <h3 class="text-xl font-bold text-red-600">

                    Hapus Peserta

                </h3>

                <p class="text-sm text-slate-500 mt-1">

                    Tindakan ini tidak dapat dibatalkan.

                </p>

            </div>

            <button
                type="button"
                onclick="closeModal('deleteModal')"
                class="w-10 h-10 rounded-xl hover:bg-slate-100 transition">

                <i class="fas fa-times text-slate-500"></i>

            </button>

        </div>

        {{-- Form --}}
        <form
            id="deleteForm"
            method="POST">

            @csrf
            @method('DELETE')

            <div class="p-6 space-y-6">

                {{-- Icon --}}
                <div class="flex justify-center">

                    <div
                        class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center">

                        <i class="fas fa-trash-alt text-red-600 text-4xl"></i>

                    </div>

                </div>

                {{-- Nama Peserta --}}
                <div>

                    <label
                        class="block text-sm font-semibold text-slate-700 mb-2">

                        Nama Peserta

                    </label>

                    <input
                        type="text"
                        id="deletePeserta"
                        class="w-full rounded-xl border-slate-300 bg-slate-100"
                        readonly>

                </div>

                {{-- Informasi --}}
                <div
                    class="rounded-xl border border-red-200 bg-red-50 p-4">

                    <div class="flex gap-3">

                        <i class="fas fa-exclamation-triangle text-red-500 mt-1"></i>

                        <div class="text-sm text-red-700">

                            Menghapus peserta akan menghapus seluruh data
                            absensi peserta pada event ini.

                            <br><br>

                            Apabila peserta memiliki poin, maka poin tersebut
                            juga akan dikurangi dari akun pengguna.

                        </div>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div
                class="px-6 py-5 bg-slate-50 border-t flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeModal('deleteModal')"
                    class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-100 transition">

                    Batal

                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">

                    <i class="fas fa-trash-alt mr-2"></i>

                    Hapus Peserta

                </button>

            </div>

        </form>

    </div>

</div>