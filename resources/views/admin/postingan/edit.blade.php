@extends('layouts.admin',['activePage'=>'konten'])

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">

        <div>
            <h1 class="text-4xl font-bold text-[var(--color-coklat)]">
                ✏️ Edit Postingan
            </h1>

            <p class="text-slate-500 mt-2">
                Perbarui artikel dan berita website.
            </p>
        </div>

        <a href="{{ url()->previous() }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl border bg-white hover:shadow-lg transition">

            ← Kembali

        </a>

    </div>

    <div class="card-admin p-8 rounded-3xl shadow-xl">

        <form action="{{ route('admin.postingans.update',$postingan->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

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
                               value="{{ old('judul',$postingan->judul) }}"
                               class="w-full rounded-2xl border border-slate-300 px-5 py-3
                                      focus:ring-2 focus:ring-red-500">

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
                             class="bg-white rounded-2xl"></div>

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
                             class="group border-2 border-dashed border-slate-300
                                    rounded-3xl p-6 text-center cursor-pointer
                                    hover:border-red-500 hover:bg-red-50 transition">

                            <img id="preview"
                                 src="{{ $postingan->gambar_cover ? asset('storage/'.$postingan->gambar_cover) : '' }}"
                                 class="rounded-2xl h-56 w-full object-cover mb-4
                                 {{ $postingan->gambar_cover ? '' : 'hidden' }}">

                            <div id="placeholder"
                                 class="{{ $postingan->gambar_cover ? 'hidden' : '' }}">

                                <div class="text-7xl mb-4">
                                    🖼️
                                </div>

                                <h4 class="font-semibold">
                                    Upload Cover Artikel
                                </h4>

                                <p class="text-slate-500 mt-2">
                                    Klik atau drag gambar ke sini
                                </p>

                                <small class="text-slate-400">
                                    JPG, PNG, WEBP • Maks 2MB
                                </small>

                            </div>

                            <input type="file"
                                   name="gambar_cover"
                                   id="gambar_cover"
                                   class="hidden"
                                   accept="image/*">

                        </div>

                    </div>

                    {{-- Tips --}}
                    <div class="bg-slate-50 rounded-3xl p-5 mb-6">

                        <h5 class="font-bold mb-4">
                            Tips Penulisan
                        </h5>

                        <ul class="space-y-3 text-sm text-slate-500">
                            <li>✅ Gunakan judul menarik.</li>
                            <li>✅ Gunakan gambar berkualitas.</li>
                            <li>✅ Pastikan isi artikel lengkap.</li>
                            <li>✅ Cek kembali sebelum publikasi.</li>
                        </ul>

                    </div>

                    {{-- Kategori --}}
                    <div class="mb-6">

                        <label class="font-semibold block mb-2">
                            Kategori
                        </label>

                        <input type="text"
                               name="kategori"
                               value="{{ old('kategori',$postingan->kategori) }}"
                               class="w-full rounded-2xl border px-5 py-3">

                    </div>

                    {{-- Status --}}
                    <div class="mb-6">

                        <label class="font-semibold block mb-2">
                            Status
                        </label>

                        <select name="status"
                                class="w-full rounded-2xl border px-5 py-3">

                            <option value="draft"
                                {{ $postingan->status=='draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="publikasi"
                                {{ $postingan->status=='publikasi' ? 'selected' : '' }}>
                                Publikasi
                            </option>

                            <option value="arsip"
                                {{ $postingan->status=='arsip' ? 'selected' : '' }}>
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
                               value="{{ $postingan->published_at ? \Carbon\Carbon::parse($postingan->published_at)->format('Y-m-d\TH:i') : '' }}"
                               class="w-full rounded-2xl border px-5 py-3">

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-t mt-10 pt-6 flex justify-end gap-3">

                <a href="{{ route('admin.postingans.index') }}"
                   class="px-6 py-3 rounded-2xl border">

                    Batal

                </a>

                <button type="submit"
                        class="px-8 py-3 rounded-2xl text-white font-semibold shadow-lg hover:scale-105 transition"
                        style="
                            background:linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                    💾 Update Postingan

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
</style>

@endpush

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>

<script>

const quill = new Quill('#editor',{
    theme:'snow',
    placeholder:'Tulis artikel disini...',
    modules:{
        toolbar:[
            [{header:[1,2,3,false]}],
            ['bold','italic','underline'],
            ['blockquote','code-block'],
            [{'list':'ordered'},{'list':'bullet'}],
            ['link','image'],
            ['clean']
        ]
    }
});

// tampilkan konten lama
quill.root.innerHTML = `{!! addslashes($postingan->konten) !!}`;

document.querySelector('form').onsubmit = function(){
    document.getElementById('konten').value =
        quill.root.innerHTML;
};

// Upload Cover
const input = document.getElementById('gambar_cover');
const preview = document.getElementById('preview');
const placeholder = document.getElementById('placeholder');
const dropzone = document.getElementById('dropzone');

dropzone.addEventListener('click',()=>input.click());

input.addEventListener('change',function(){

    const file = this.files[0];

    if(!file) return;

    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');
    placeholder.classList.add('hidden');

});

dropzone.addEventListener('dragover',e=>{
    e.preventDefault();
});

dropzone.addEventListener('drop',e=>{

    e.preventDefault();

    input.files = e.dataTransfer.files;

    const file = e.dataTransfer.files[0];

    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');
    placeholder.classList.add('hidden');

});

</script>

@endpush