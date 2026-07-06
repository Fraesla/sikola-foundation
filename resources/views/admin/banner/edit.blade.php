@extends('layouts.admin', [
    'activePage' => 'konten'
])

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-[var(--color-coklat)]">
                Edit Banner
            </h1>

            <p class="text-slate-500 mt-2">
                Perbarui informasi banner website.
            </p>
        </div>

        <a href="{{ url()->previous() }}"
           class="px-4 py-2 rounded-xl border">
            ← Kembali
        </a>

    </div>

    <div class="card-admin p-8">

        <form
            action="{{ route('admin.banners.update',$banner->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- KIRI --}}
                <div>

                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Judul Banner
                        </label>

                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul',$banner->judul) }}"
                            class="w-full rounded-xl border px-4 py-3">

                        @error('judul')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="6"
                            class="w-full rounded-xl border px-4 py-3">{{ old('deskripsi',$banner->deskripsi) }}</textarea>

                    </div>

                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            URL Tautan
                        </label>

                        <input
                            type="url"
                            name="url_tautan"
                            value="{{ old('url_tautan',$banner->url_tautan) }}"
                            class="w-full rounded-xl border px-4 py-3">

                    </div>

                </div>

                {{-- KANAN --}}
                <div>

                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Gambar Banner
                        </label>

                        <div id="dropzone"
                            class="relative border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center cursor-pointer transition-all duration-300 hover:border-[var(--color-merah)] hover:bg-slate-50">

                            {{-- Preview --}}
                            <img
                                id="preview-image"
                                src="{{ isset($banner) ? asset('storage/'.$banner->gambar) : '' }}"
                                class="w-full h-64 object-cover rounded-xl {{ isset($banner) ? '' : 'hidden' }}">

                            <div class="absolute inset-0 bg-black/40 rounded-xl flex items-center justify-center opacity-0 hover:opacity-100 transition">

                                <span class="text-white font-semibold">
                                    Klik atau Drag Gambar Baru
                                </span>

                            </div>
                            <p id="file-info" class="text-sm text-slate-500 mt-3"></p>
                            <input
                                type="file"
                                id="gambar"
                                name="gambar"
                                accept="image/*"
                                class="hidden">

                        </div>

                       

                        @error('gambar')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    

                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Urutan Tampil
                        </label>

                        <input
                            type="number"
                            name="urutan"
                            value="{{ old('urutan',$banner->urutan) }}"
                            class="w-full rounded-xl border px-4 py-3">

                    </div>
                    <!-- NOTE -->
                    <div
                        class="rounded-2xl p-4 text-sm"
                        style="
                            background: rgba(212,160,23,.08);
                            border: 1px solid rgba(212,160,23,.25);
                        ">

                        <h4
                            class="font-bold mb-3"
                            style="color: var(--color-coklat);">

                            📌 Keterangan Urutan Banner

                        </h4>

                        <ul class="space-y-2 text-slate-600">

                            <li><strong>1</strong> = Hero Banner Home / Dashboard</li>

                            <li><strong>2</strong> = Hero Banner Tentang</li>

                            <li><strong>3</strong> = Hero Banner Event</li>

                            <li><strong>4</strong> = Hero Banner Donasi</li>

                            <li><strong>5</strong> = Hero Banner Relawan</li>

                            <li><strong>6</strong> = Hero Banner Berita</li>

                            <li><strong>7</strong> = Hero Banner Merchandise</li>

                            <li><strong>8</strong> = Hero Banner Tim</li>

                            <li><strong>9</strong> = Hero Banner Kontak</li>

                        </ul>

                    </div>

                    <div class="mb-6">

                        <label class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_aktif"
                                value="1"
                                {{ $banner->is_aktif ? 'checked' : '' }}>

                            <span>
                                Banner Aktif
                            </span>

                        </label>

                    </div>

                </div>

            </div>

            <div class="border-t mt-8 pt-6 flex justify-end gap-3">

                <a
                    href="{{ route('admin.banners.index') }}"
                    class="px-5 py-3 rounded-xl border">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl text-white font-semibold shadow-lg"
                    style="
                        background:linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">

                    💾 Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const dropzone = document.getElementById('dropzone');
    const input = document.getElementById('gambar');
    const preview = document.getElementById('preview-image');
    const placeholder = document.getElementById('placeholder');
    const fileInfo = document.getElementById('file-info');

    if (!dropzone || !input) return;

    function showPreview(file) {

        if (!file) return;

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');

        if (placeholder) {
            placeholder.classList.add('hidden');
        }

        fileInfo.innerHTML =
            file.name + ' • ' +
            (file.size / 1024 / 1024).toFixed(2) +
            ' MB';
    }

    dropzone.onclick = () => input.click();

    input.onchange = e => {
        showPreview(e.target.files[0]);
    };

    dropzone.ondragover = e => {
        e.preventDefault();
        dropzone.classList.add('border-red-500');
    };

    dropzone.ondragleave = () => {
        dropzone.classList.remove('border-red-500');
    };

    dropzone.ondrop = e => {
        e.preventDefault();

        dropzone.classList.remove('border-red-500');

        const file = e.dataTransfer.files[0];

        const dt = new DataTransfer();
        dt.items.add(file);

        input.files = dt.files;

        showPreview(file);
    };

});
</script>
