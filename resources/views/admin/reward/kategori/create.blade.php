@extends('layouts.admin',[
    'activePage' => 'reward'
])

@section('title','Tambah Reward')

@section('content')

<form
    action="{{ route('admin.rewards.store') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-black">
                🎁 Tambah Reward
            </h1>

            <p class="text-slate-500 mt-2">
                Tambahkan reward baru yang dapat ditukarkan menggunakan poin.
            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('admin.rewards.index') }}"
               class="px-6 py-3 rounded-xl bg-slate-200 font-semibold">

                Kembali

            </a>

            <button
                class="px-8 py-3 rounded-xl bg-gradient-to-r
                       from-red-600 to-yellow-500
                       text-white font-bold">

                Simpan Reward

            </button>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- FORM --}}
        <div class="lg:col-span-2">

            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-6">

                    Informasi Reward

                </h3>

                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Nama --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">
                            Nama Reward
                        </label>

                        <input
                            id="nama"
                            name="nama"
                            type="text"
                            required
                            value="{{ old('nama') }}"
                            class="w-full mt-2 rounded-xl border p-3">

                        @error('nama')

                            <small class="text-red-500">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>

                    {{-- Slug --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">

                            Slug

                        </label>

                        <input
                            id="slug"
                            readonly
                            class="w-full mt-2 rounded-xl
                                   bg-slate-100 border p-3">

                    </div>

                    {{-- Kategori --}}
                    <div>

                        <label class="font-semibold">
                            Kategori
                        </label>

                        <select
                            name="kategori"
                            class="w-full mt-2 rounded-xl border p-3"
                            required>

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <option value="Merchandise"
                                @selected(old('kategori') == 'Merchandise')>
                                🎁 Merchandise
                            </option>

                            <option value="Saldo"
                                @selected(old('kategori') == 'Saldo')>
                                💰 Saldo
                            </option>


                            <option value="Penghargaan"
                                @selected(old('kategori') == 'Penghargaan')>
                                🏅 Penghargaan
                            </option>


                            <option value="lainnya"
                                @selected(old('kategori') == 'lainnya')>
                                📦 Lainnya
                            </option>

                        </select>

                        @error('kategori')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Poin --}}
                    <div>

                        <label class="font-semibold">

                            Poin Dibutuhkan

                        </label>

                        <input
                            type="number"
                            name="poin"
                            min="1"
                            value="{{ old('poin',100) }}"
                            class="w-full mt-2 rounded-xl border p-3">

                    </div>

                    {{-- Nilai Reward --}}
                    <!-- <div>

                        <label class="font-semibold">

                            Nilai Reward (Opsional)

                        </label>

                        <input
                            type="number"
                            name="nilai_reward"
                            min="0"
                            value="{{ old('nilai_reward') }}"
                            class="w-full mt-2 rounded-xl border p-3">

                        <small class="text-slate-500">
                            Untuk saldo tunai / DANA.
                        </small>

                    </div> -->

                    {{-- Stok --}}
                    <div>

                        <label class="font-semibold">

                            Stok

                        </label>

                        <input
                            type="number"
                            name="stok"
                            min="0"
                            value="{{ old('stok',0) }}"
                            class="w-full mt-2 rounded-xl border p-3">

                    </div>

                    {{-- Urutan --}}
                    <div>

                        <label class="font-semibold">

                            Urutan

                        </label>

                        <input
                            type="number"
                            name="urutan"
                            value="{{ old('urutan',1) }}"
                            class="w-full mt-2 rounded-xl border p-3">

                    </div>

                    {{-- Deskripsi --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">

                            Deskripsi

                        </label>

                        <textarea
                            rows="6"
                            name="deskripsi"
                            class="w-full mt-2 rounded-xl border p-3">{{ old('deskripsi') }}</textarea>

                    </div>

                </div>

            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- Upload --}}
            <div class="card-admin p-8">

                <h3 class="font-bold mb-5">

                    Gambar Reward

                </h3>

                <div
                    onclick="document.getElementById('gambar').click()"
                    class="border-2 border-dashed
                           rounded-3xl p-6 cursor-pointer
                           hover:border-red-500">

                    <img
                        id="preview"
                        class="hidden w-full rounded-2xl mb-4">

                    <div id="placeholder"
                         class="text-center">

                        <div class="text-6xl">

                            🎁

                        </div>

                        <p class="text-slate-500 mt-3">

                            Klik untuk upload gambar

                        </p>

                    </div>

                    <input
                        id="gambar"
                        type="file"
                        name="gambar"
                        accept="image/*"
                        class="hidden">

                </div>

            </div>

            {{-- Status --}}
            <div class="card-admin p-8">

                <h3 class="font-bold mb-4">

                    Status

                </h3>

                <label class="flex gap-3 items-center">

                    <input
                        type="checkbox"
                        checked
                        name="is_aktif"
                        class="w-5 h-5">

                    Reward Aktif

                </label>

            </div>

        </div>

    </div>

</div>

</form>

@endsection

@push('scripts')

<script>

document.getElementById('nama').addEventListener('keyup',function(){

    document.getElementById('slug').value =
        this.value
        .toLowerCase()
        .replace(/[^a-z0-9]+/g,'-')
        .replace(/^-|-$/g,'');

});

document.getElementById('gambar').addEventListener('change',function(){

    if(!this.files.length) return;

    const reader = new FileReader();

    reader.onload = function(e){

        preview.src = e.target.result;

        preview.classList.remove('hidden');

        placeholder.classList.add('hidden');

    }

    reader.readAsDataURL(this.files[0]);

});

</script>

@endpush