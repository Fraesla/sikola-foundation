@extends('layouts.admin',['activePage'=>'merchandise'])

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

        <div>
            <h1 class="text-4xl font-bold"
                style="color: var(--color-coklat);">

                🛍️ Tambah Produk Merchandise

            </h1>

            <p class="text-slate-500 mt-2">
                Tambahkan produk merchandise baru untuk organisasi.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('admin.merchandise.index') }}"
               class="px-6 py-3 rounded-xl border bg-white hover:shadow-lg transition">

                ← Kembali

            </a>

            <button form="form-merchandise"
                    class="px-6 py-3 rounded-xl text-white font-semibold shadow-lg hover:scale-105 transition"
                    style="
                        background:
                        linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">

                💾 Simpan Produk

            </button>

        </div>

    </div>


    <form id="form-merchandise"
          action="{{ route('admin.merchandise.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- KIRI --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- INFORMASI PRODUK --}}
                <div class="card-admin p-8">

                    <h3 class="text-xl font-bold mb-6">
                        Informasi Produk
                    </h3>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="font-semibold block mb-2">
                                Nama Produk
                            </label>

                            <input type="text"
                                   name="nama"
                                   value="{{ old('nama') }}"
                                   class="w-full rounded-xl border px-4 py-3"
                                   placeholder="Contoh: Kaos Sikola Foundation">

                            @error('nama')
                                <small class="text-red-500">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div>
                            <label class="font-semibold block mb-2">
                                Kategori
                            </label>

                            <select name="kategori"
                                    class="w-full rounded-xl border px-4 py-3">

                                <option value="">Pilih Kategori</option>
                                <option>Kaos</option>
                                <option>Topi</option>
                                <option>Tas</option>
                                <option>Mug</option>
                                <option>Sticker</option>
                                <option>Aksesoris</option>

                            </select>
                        </div>

                    </div>


                    <div class="mt-6">

                        <label class="font-semibold block mb-2">
                            Deskripsi Produk
                        </label>

                        <textarea rows="8"
                                  name="deskripsi"
                                  class="w-full rounded-xl border px-4 py-3"
                                  placeholder="Tuliskan deskripsi produk...">{{ old('deskripsi') }}</textarea>

                    </div>

                </div>


                {{-- HARGA --}}
                <div class="card-admin p-8">

                    <h3 class="text-xl font-bold mb-6">
                        Harga & Stok
                    </h3>

                    <div class="grid md:grid-cols-3 gap-6">

                        <div>
                            <label class="font-semibold block mb-2">
                                Harga
                            </label>

                            <input type="number"
                                   name="harga"
                                   class="w-full rounded-xl border px-4 py-3"
                                   placeholder="120000">
                        </div>

                        <div>
                            <label class="font-semibold block mb-2">
                                Stok
                            </label>

                            <input type="number"
                                   name="stok"
                                   class="w-full rounded-xl border px-4 py-3"
                                   placeholder="50">
                        </div>

                        <div>
                            <label class="font-semibold block mb-2">
                                Berat (Gram)
                            </label>

                            <input type="number"
                                   name="berat_gram"
                                   class="w-full rounded-xl border px-4 py-3"
                                   placeholder="250">
                        </div>

                    </div>

                </div>

            </div>


            {{-- SIDEBAR --}}
            <div class="space-y-6">

                {{-- UPLOAD FOTO --}}
                <div class="card-admin p-8">

                    <h3 class="text-xl font-bold mb-5">
                        Foto Produk
                    </h3>

                    <div id="dropzone"
                         class="border-2 border-dashed rounded-2xl p-8 text-center cursor-pointer">

                        <div id="placeholder">

                            <div class="text-7xl">
                                🖼️
                            </div>

                            <p class="mt-4 text-slate-500">
                                Klik atau Drag Gambar
                            </p>

                            <small class="text-slate-400">
                                Bisa upload banyak gambar
                            </small>

                        </div>

                        <div id="preview-container"
                             class="grid grid-cols-2 gap-3 mt-4">
                        </div>

                        <input type="file"
                               id="gambar"
                               name="gambar[]"
                               class="hidden"
                               multiple
                               accept="image/*">

                    </div>

                </div>


                {{-- PENGATURAN --}}
                <div class="card-admin p-8">

                    <h3 class="text-xl font-bold mb-5">
                        Pengaturan
                    </h3>

                    <div class="mb-5">

                        <label class="font-semibold block mb-2">
                            Poin Reward
                        </label>

                        <input type="number"
                               name="poin_reward"
                               value="0"
                               class="w-full rounded-xl border px-4 py-3">

                    </div>

                    <div>

                        <label class="font-semibold block mb-2">
                            Status Produk
                        </label>

                        <select name="is_aktif"
                                class="w-full rounded-xl border px-4 py-3">

                            <option value="1">
                                Aktif
                            </option>

                            <option value="0">
                                Nonaktif
                            </option>

                        </select>

                    </div>

                </div>


                {{-- CARD INFO --}}
                <div class="rounded-3xl p-6 text-white"
                     style="
                        background:
                        linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                     ">

                    <h4 class="font-bold text-lg mb-2">
                        Tips Produk
                    </h4>

                    <ul class="space-y-2 text-sm">

                        <li>✓ Gunakan foto berkualitas tinggi</li>
                        <li>✓ Tambahkan deskripsi lengkap</li>
                        <li>✓ Tentukan stok dengan benar</li>
                        <li>✓ Atur poin reward untuk member</li>

                    </ul>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection


@push('scripts')

<script>

const input = document.getElementById('gambar');
const dropzone = document.getElementById('dropzone');
const previewContainer = document.getElementById('preview-container');
const placeholder = document.getElementById('placeholder');

dropzone.addEventListener('click', () => input.click());

input.addEventListener('change', function(){

    previewContainer.innerHTML = '';

    if(this.files.length > 0){
        placeholder.classList.add('hidden');
    }

    [...this.files].forEach(file => {

        let img = document.createElement('img');

        img.src = URL.createObjectURL(file);

        img.classList.add(
            'w-full',
            'h-32',
            'object-cover',
            'rounded-xl'
        );

        previewContainer.appendChild(img);

    });

});

</script>

@endpush