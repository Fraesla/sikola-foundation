{{-- ========================================================= --}}
{{-- MODAL UPDATE STATUS PESERTA --}}
{{-- ========================================================= --}}

<div
    id="statusModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm px-4">

    <div
        class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden animate-fade-in">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>

                <h3 class="text-xl font-bold text-slate-800">

                    Update Status Peserta

                </h3>

                <p class="text-sm text-slate-500 mt-1">

                    Ubah status peserta event.

                </p>

            </div>

            <button
                type="button"
                onclick="closeModal('statusModal')"
                class="w-10 h-10 rounded-xl hover:bg-slate-100 transition">

                <i class="fas fa-times text-slate-500"></i>

            </button>

        </div>

        {{-- Form --}}
        <form
            id="statusForm"
            method="POST">

            @csrf
            @method('PATCH')

            <div class="p-6 space-y-5">

                <div>

                    <label
                        for="status"
                        class="block text-sm font-semibold text-slate-700 mb-2">

                        Status Peserta

                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                        <option value="aktif">

                            Aktif

                        </option>

                        <option value="lulus">

                            Lulus

                        </option>

                        <option value="tidak_lulus">

                            Tidak Lulus

                        </option>

                        <option value="nonaktif">

                            Nonaktif

                        </option>

                    </select>

                </div>

                <div
                    class="rounded-xl bg-blue-50 border border-blue-100 p-4">

                    <div class="flex gap-3">

                        <i class="fas fa-info-circle text-blue-500 mt-1"></i>

                        <div class="text-sm text-blue-700">

                            Status peserta akan langsung diperbarui setelah
                            tombol <strong>Simpan Perubahan</strong> ditekan.

                        </div>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div
                class="px-6 py-5 bg-slate-50 border-t flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeModal('statusModal')"
                    class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-100 transition">

                    Batal

                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">

                    <i class="fas fa-save mr-2"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>