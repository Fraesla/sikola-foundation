@extends('layouts.admin', [
    'activePage' => 'konten'
])

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-[var(--color-coklat)]">
                Tambah Banner
            </h1>

            <p class="text-slate-500 mt-2">
                Tambahkan banner baru untuk ditampilkan di homepage.
            </p>
        </div>

        <a href="{{ route('admin.banners.index') }}"
           class="px-5 py-3 rounded-xl border hover:bg-slate-50 transition">

            ← Kembali

        </a>

    </div>

    <form
        action="{{ route('admin.banners.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="grid md:grid-cols-3 gap-8">

            <!-- FORM -->
            <div class="md:col-span-2">

                <div class="card-admin p-8 rounded-3xl">

                    <h3 class="text-xl font-bold mb-6">
                        Informasi Banner
                    </h3>

                    <!-- Judul -->
                    <div class="mb-5">

                        <label class="block mb-2 font-medium">
                            Judul Banner
                        </label>

                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul') }}"
                            class="w-full rounded-xl border px-4 py-3">

                        @error('judul')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-5">

                        <label class="block mb-2 font-medium">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="5"
                            class="w-full rounded-xl border px-4 py-3">{{ old('deskripsi') }}</textarea>

                    </div>

                    <!-- URL -->
                    <div class="mb-5">

                        <label class="block mb-2 font-medium">
                            URL Tautan
                        </label>

                        <input
                            type="text"
                            name="url_tautan"
                            value="{{ old('url_tautan') }}"
                            placeholder="https://..."
                            class="w-full rounded-xl border px-4 py-3">

                    </div>

                </div>

            </div>

            <!-- SIDEBAR -->
            <div>

                <!-- Upload -->
                <div class="card-admin p-6 rounded-3xl mb-6">

                    <h3 class="font-bold mb-4">
                        Gambar Banner
                    </h3>

                    <input
                        type="file"
                        name="gambar"
                        id="gambar"
                        accept="image/*"
                        class="w-full border rounded-xl p-3">

                    @error('gambar')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="mt-4">

                        <img
                            id="preview"
                            class="hidden w-full rounded-xl border">

                    </div>

                </div>

                <!-- Pengaturan -->
                <div class="card-admin p-6 rounded-3xl mb-6">

                    <h3 class="font-bold mb-4">
                        Pengaturan
                    </h3>

                    <div class="mb-4">

                        <label class="block mb-2">
                            Urutan
                        </label>

                        <input
                            type="number"
                            name="urutan"
                            value="{{ old('urutan',1) }}"
                            class="w-full rounded-xl border px-4 py-3">

                    </div>

                    <div>

                        <label class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="is_aktif"
                                checked>

                            <span>
                                Banner Aktif
                            </span>

                        </label>

                    </div>

                </div>

                <!-- Tombol -->
                <button
                    type="submit"
                    class="w-full py-4 rounded-2xl text-white font-semibold shadow-lg hover:scale-105 transition"
                    style="
                        background:linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">

                    Simpan Banner

                </button>

            </div>

        </div>

    </form>

</div>

<script>

document
.getElementById('gambar')
.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(event){

            const preview =
                document.getElementById('preview');

            preview.src = event.target.result;

            preview.classList.remove('hidden');
        };

        reader.readAsDataURL(file);
    }

});

</script>

@endsection