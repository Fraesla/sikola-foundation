@extends('layouts.admin',['activePage'=>'konten'])

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">

        <div>
            <h1 class="text-4xl font-bold text-[var(--color-coklat)]">
                ✍️ Tambah Postingan
            </h1>

            <p class="text-slate-500 mt-2">
                Tulis artikel, berita, atau informasi terbaru untuk website.
            </p>
        </div>

        <a href="{{ route('admin.postingans.index') }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl border border-slate-300 bg-white hover:shadow-lg transition">

            <span>←</span>
            <span>Kembali</span>

        </a>

    </div>

    <div class="card-admin p-8 rounded-3xl shadow-xl">

        <form action="{{ route('admin.postingans.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="grid lg:grid-cols-3 gap-8">

                {{-- KIRI --}}
                <div class="lg:col-span-2">

                    {{-- Judul --}}
                    <div class="mb-6">
                        <label class="font-semibold block mb-2">
                            Judul Artikel
                        </label>

                        <input type="text"
                               name="judul"
                               value="{{ old('judul') }}"
                               class="w-full rounded-2xl border border-slate-300 px-5 py-3
                                focus:ring-2 focus:ring-[var(--color-merah)]
                                focus:border-[var(--color-merah)] transition">

                        @error('judul')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- Konten --}}
                    <div class="mb-6">

                        <label class="font-semibold block mb-2">
                            Konten Artikel
                        </label>

                        <div id="editor"
                             style="height:590px"
                             class="bg-white"></div>

                        <input type="hidden"
                               name="konten"
                               id="konten">

                        @error('konten')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>

                {{-- KANAN --}}
                <div>

                    {{-- Cover --}}
                    <div class="mb-6">

                        <label class="font-semibold block mb-2">
                            Gambar Cover
                        </label>

                        <div id="dropzone"
                             class="group border-2 border-dashed border-slate-300 rounded-3xl p-6 text-center cursor-pointer
                                    hover:border-[var(--color-merah)]
                                    hover:bg-red-50 transition">

                            <img id="preview"
                                 class="hidden rounded-2xl h-56 w-full object-cover mb-4 shadow">

                            <div id="placeholder">

                                <div class="text-7xl mb-4 group-hover:scale-110 transition">
                                    🖼️
                                </div>

                                <h4 class="font-semibold text-lg">
                                    Upload Cover Artikel
                                </h4>

                                <p class="text-slate-500 mt-2">
                                    Klik atau drag gambar ke sini
                                </p>

                                <small class="block mt-3 text-slate-400">
                                    JPG, PNG, WEBP • Maks 2 MB
                                </small>

                            </div>

                            <input
                                type="file"
                                name="gambar_cover"
                                id="gambar_cover"
                                class="hidden"
                                accept="image/*">

                        </div>

                        <div class="bg-slate-50 rounded-3xl p-5 mb-6">

                            <h5 class="font-bold mb-4">
                                Tips Penulisan
                            </h5>

                            <ul class="space-y-3 text-sm text-slate-500">

                                <li>✅ Gunakan judul yang menarik.</li>

                                <li>✅ Tambahkan gambar cover berkualitas.</li>

                                <li>✅ Gunakan kategori agar mudah dicari.</li>

                                <li>✅ Publikasikan saat artikel siap.</li>

                            </ul>

                        </div>

                    </div>

                    {{-- Kategori --}}
                    <div class="mb-6">

                        <label class="font-semibold block mb-2">
                            Kategori
                        </label>

                        <input type="text"
                               name="kategori"
                               class="w-full rounded-2xl border border-slate-300 px-5 py-3
                                focus:ring-2 focus:ring-[var(--color-merah)]
                                focus:border-[var(--color-merah)] transition">

                    </div>

                    {{-- Status --}}
                    <div class="mb-6">

                        <label class="font-semibold block mb-2">
                            Status
                        </label>

                        <select name="status"
                                class="w-full rounded-2xl border border-slate-300 px-5 py-3
                                    focus:ring-2 focus:ring-[var(--color-merah)]
                                    focus:border-[var(--color-merah)] transition">

                            <option value="draft">
                                Draft
                            </option>

                            <option value="publikasi">
                                Publikasi
                            </option>

                            <option value="arsip">
                                Arsip
                            </option>

                        </select>

                    </div>

                    {{-- Publish --}}
                    <div class="mb-6">

                        <label class="font-semibold block mb-2">
                            Tanggal Publikasi
                        </label>

                        <input type="datetime-local"
                               name="published_at"
                               class="w-full rounded-2xl border border-slate-300 px-5 py-3
                                focus:ring-2 focus:ring-[var(--color-merah)]
                                focus:border-[var(--color-merah)] transition">

                    </div>

                </div>

            </div>

           <div class="border-t mt-10 pt-6 flex justify-end gap-3">

                <a href="{{ route('admin.postingans.index') }}"
                   class="px-6 py-3 rounded-2xl border hover:bg-slate-50 transition">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-8 py-3 rounded-2xl text-white font-semibold shadow-lg hover:scale-105 transition"
                    style="
                        background: linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">

                    💾 Simpan Postingan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css"
      rel="stylesheet">

<style>
    .ql-toolbar svg {
        width: 18px !important;
        height: 18px !important;
    }

    .ql-toolbar button {
        width: 28px !important;
        height: 28px !important;
    }

    .ql-container {
        min-height: 400px;
        background: #fff;
    }

    .ql-editor {
        min-height: 350px;
    }
    .ql-toolbar{
    border-radius:20px 20px 0 0;
    background:#fff;
    }

    .ql-container{
        min-height:450px;
        background:#fff;
        border-radius:0 0 20px 20px;
    }

    .ql-editor{
        min-height:400px;
        font-size:16px;
        line-height:1.8;
    }

    .ql-editor p{
        margin-bottom:12px;
    }

    .ql-toolbar button:hover{
        background:#f5f5f5;
        border-radius:8px;
    }
</style>
@endpush
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>

<script>

const quill = new Quill('#editor', {

    theme: 'snow',

    placeholder: 'Tulis artikel disini...',

    modules: {

        toolbar: [
            [{header:[1,2,3,false]}],
            ['bold','italic','underline'],
            ['blockquote','code-block'],
            [{'list':'ordered'},{'list':'bullet'}],
            ['link','image'],
            ['clean']
        ]
    }
});

document.querySelector('form').onsubmit = function () {

    document.getElementById('konten').value =
        quill.root.innerHTML;
};

// Preview Cover
const input = document.getElementById('gambar_cover');
const preview = document.getElementById('preview');
const placeholder = document.getElementById('placeholder');
const dropzone = document.getElementById('dropzone');

dropzone.addEventListener('click', () => input.click());

input.addEventListener('change', function(){

    const file = this.files[0];

    if(!file) return;

    preview.src = URL.createObjectURL(file);

    preview.classList.remove('hidden');

    placeholder.classList.add('hidden');
});

// Drag Drop
dropzone.addEventListener('dragover', e=>{
    e.preventDefault();
});

dropzone.addEventListener('drop', e=>{

    e.preventDefault();

    input.files = e.dataTransfer.files;

    const file = e.dataTransfer.files[0];

    preview.src = URL.createObjectURL(file);

    preview.classList.remove('hidden');

    placeholder.classList.add('hidden');
});

</script>

@endpush
