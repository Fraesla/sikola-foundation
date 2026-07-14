@extends('layouts.admin',['activePage'=>'merchandise'])

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

        <div>
            <h1 class="text-4xl font-bold"
                style="color: var(--color-coklat);">

                ✏️ Edit Produk

            </h1>

            <p class="text-slate-500 mt-2">
                Perbarui informasi produk merchandise.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ url()->previous() }}"
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

                💾 Update Produk

            </button>

        </div>

    </div>


    <form id="form-merchandise"
          action="{{ route('admin.merchandise.update',$merchandise) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

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
                                   value="{{ old('nama',$merchandise->nama) }}"
                                   class="w-full rounded-xl border px-4 py-3">

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

                                @foreach([
                                    'Kaos',
                                    'Topi',
                                    'Tas',
                                    'Mug',
                                    'Sticker',
                                    'Aksesoris'
                                ] as $kategori)

                                <option value="{{ $kategori }}"
                                    {{ old('kategori',$merchandise->kategori)==$kategori ? 'selected':'' }}>

                                    {{ $kategori }}

                                </option>

                                @endforeach

                            </select>
                        </div>

                    </div>


                    <div class="mt-6">

                        <label class="font-semibold block mb-2">
                            Deskripsi Produk
                        </label>

                        <textarea rows="8"
                                  name="deskripsi"
                                  class="w-full rounded-xl border px-4 py-3">{{ old('deskripsi',$merchandise->deskripsi) }}</textarea>

                    </div>

                </div>


                {{-- HARGA DAN STOK --}}
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
                                   value="{{ old('harga',$merchandise->harga) }}"
                                   class="w-full rounded-xl border px-4 py-3">

                        </div>

                        <div>

                            <label class="font-semibold block mb-2">
                                Stok
                            </label>

                            <input type="number"
                                   name="stok"
                                   value="{{ old('stok',$merchandise->stok) }}"
                                   class="w-full rounded-xl border px-4 py-3">

                        </div>

                        <div>

                            <label class="font-semibold block mb-2">
                                Berat (Gram)
                            </label>

                            <input type="number"
                                   name="berat_gram"
                                   value="{{ old('berat_gram',$merchandise->berat_gram) }}"
                                   class="w-full rounded-xl border px-4 py-3">

                        </div>

                    </div>

                </div>

            </div>



            {{-- SIDEBAR --}}
            <div class="space-y-6">

                {{-- FOTO --}}
                <div class="card-admin p-8">

                    <h3 class="text-xl font-bold mb-5">
                        Galeri Produk
                    </h3>

                    <div id="dropzone"
                        class="border-2 border-dashed border-slate-300 rounded-3xl p-8 min-h-[250px] cursor-pointer hover:border-[var(--color-merah)] transition">

                        <div id="preview-container"
                             class="flex flex-wrap gap-4">

                            @if(!empty($merchandise->gambar))

                                @foreach($merchandise->gambar as $gambar)

                                    <div class="relative group">

                                        <img src="{{ asset('storage/'.$gambar) }}"
                                             class="w-full h-40 object-cover rounded-2xl shadow-md border-2 border-white">

                                        <div
                                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition rounded-2xl flex items-center justify-center">

                                            <span class="text-white text-sm font-semibold">
                                                Preview
                                            </span>

                                        </div>

                                    </div>

                                @endforeach

                            @endif

                        </div>

                        <div id="placeholder"
                             class="{{ $merchandise->gambar ? 'hidden':'' }}">

                            <div class="text-7xl">
                                🖼️
                            </div>

                            <p class="mt-3 text-slate-500">
                                Klik untuk mengganti gambar
                            </p>

                        </div>

                        <input type="file"
                               id="gambar"
                               name="gambar[]"
                               multiple
                               class="hidden"
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
                               value="{{ old('poin_reward',$merchandise->poin_reward) }}"
                               class="w-full rounded-xl border px-4 py-3">

                    </div>


                    <div>

                        <label class="font-semibold block mb-2">
                            Status Produk
                        </label>

                        <select name="is_aktif"
                                class="w-full rounded-xl border px-4 py-3">

                            <option value="1"
                                {{ old('is_aktif',$merchandise->is_aktif)==1 ? 'selected':'' }}>

                                Aktif

                            </option>

                            <option value="0"
                                {{ old('is_aktif',$merchandise->is_aktif)==0 ? 'selected':'' }}>

                                Nonaktif

                            </option>

                        </select>

                    </div>

                </div>



                {{-- INFO --}}
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
                        Informasi Produk
                    </h4>

                    <div class="space-y-2 text-sm">

                        <div>
                            Dibuat:
                            {{ $merchandise->created_at->format('d M Y') }}
                        </div>

                        <div>
                            Update:
                            {{ $merchandise->updated_at->diffForHumans() }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection


@push('scripts')

<script>

const dropzone = document.getElementById('dropzone');
const input = document.getElementById('gambar');
const previewContainer = document.getElementById('preview-container');
const placeholder = document.getElementById('placeholder');

dropzone.addEventListener('click', function () {
    input.click();
});

input.addEventListener('change', function () {

    previewContainer.innerHTML = '';

    if (this.files.length > 0) {
        placeholder.classList.add('hidden');
    } else {
        placeholder.classList.remove('hidden');
    }

    Array.from(this.files).forEach(file => {

        const reader = new FileReader();

        reader.onload = function(e){

            previewContainer.innerHTML += `
                <div class="relative group">
                    <img src="${e.target.result}"
                         class="w-40 h-40 object-cover rounded-2xl shadow-md">

                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition rounded-2xl flex items-center justify-center">
                        <span class="text-white text-sm">
                            Preview
                        </span>
                    </div>
                </div>
            `;

        }

        reader.readAsDataURL(file);

    });

});

</script>

@endpush
