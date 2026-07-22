{{-- ========================================================= --}}
{{-- MODAL UPLOAD SERTIFIKAT --}}
{{-- ========================================================= --}}

<div
    id="uploadModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm px-4">

    <div
        class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden animate-fade-in">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <div>

                <h3 class="text-xl font-bold text-slate-800">

                    Upload Sertifikat

                </h3>

                <p class="text-sm text-slate-500 mt-1">

                    Upload sertifikat peserta dalam format PDF.

                </p>

            </div>

            <button
                type="button"
                onclick="closeModal('uploadModal')"
                class="w-10 h-10 rounded-xl hover:bg-slate-100 transition">

                <i class="fas fa-times text-slate-500"></i>

            </button>

        </div>

        {{-- Form --}}
        <form
            id="uploadForm"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="p-6 space-y-6">

                {{-- Nama Peserta --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Nama Peserta

                    </label>

                    <input
                        type="text"
                        id="uploadPeserta"
                        class="w-full rounded-xl border-slate-300 bg-slate-100"
                        readonly>

                </div>

                {{-- Upload File --}}
                <div>

                    <label
                        class="block text-sm font-semibold text-slate-700 mb-2">

                        File Sertifikat

                    </label>

                    <input
                        type="file"
                        id="sertifikat"
                        name="sertifikat"
                        accept=".pdf"
                        required
                        class="block w-full rounded-xl border border-slate-300
                               file:mr-4 file:rounded-lg file:border-0
                               file:bg-blue-600 file:px-4 file:py-2
                               file:text-white hover:file:bg-blue-700">

                    <p class="mt-2 text-sm text-slate-500">

                        Format yang diperbolehkan:
                        <strong>PDF</strong> maksimal
                        <strong>4 MB</strong>.

                    </p>

                </div>

                {{-- Preview Nama File --}}
                <div
                    id="uploadPreview"
                    class="hidden rounded-xl border border-green-200 bg-green-50 p-4">

                    <div class="flex items-center gap-3">

                        <i class="fas fa-file-pdf text-red-500 text-xl"></i>

                        <div>

                            <p class="text-sm font-semibold text-slate-700">

                                File dipilih

                            </p>

                            <p
                                id="uploadFileName"
                                class="text-sm text-slate-500">

                                -

                            </p>

                        </div>

                    </div>

                </div>

                {{-- Informasi --}}
                <div
                    class="rounded-xl border border-blue-200 bg-blue-50 p-4">

                    <div class="flex gap-3">

                        <i class="fas fa-info-circle text-blue-500 mt-1"></i>

                        <div class="text-sm text-blue-700">

                            Sertifikat akan tersimpan pada storage aplikasi
                            dan dapat diunduh oleh admin melalui menu peserta.

                        </div>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div
                class="px-6 py-5 bg-slate-50 border-t flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeModal('uploadModal')"
                    class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-100 transition">

                    Batal

                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">

                    <i class="fas fa-upload mr-2"></i>

                    Upload Sertifikat

                </button>

            </div>

        </form>

    </div>

</div>