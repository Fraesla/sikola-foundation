@extends('layouts.admin',[
    'activePage' => 'reward'
])

@section('title','Edit Reward')

@section('content')

<form
    action="{{ route('admin.rewards.update',$reward) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-black">
                🎁 Edit Reward
            </h1>

            <p class="text-slate-500 mt-2">
                Perbarui informasi reward yang dapat ditukarkan menggunakan poin.
            </p>

        </div>

        <div class="flex gap-3">

            <a
                href="{{ route('admin.rewards.index') }}"
                class="px-6 py-3 rounded-xl bg-slate-200 font-semibold">

                Kembali

            </a>

            <button
                class="px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-yellow-500 text-white font-bold">

                Simpan Perubahan

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
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama',$reward->nama) }}"
                            class="w-full mt-2 rounded-xl border p-3"
                            required>

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
                            type="text"
                            id="slug"
                            value="{{ old('slug',$reward->slug) }}"
                            readonly
                            class="w-full mt-2 rounded-xl bg-slate-100 border p-3">

                    </div>

                    {{-- Kategori --}}
                    <div>

                        <label class="font-semibold">

                            Kategori

                        </label>

                        <select
                            name="kategori"
                            class="w-full mt-2 rounded-xl border p-3">

                            <option value="">-- Pilih Kategori --</option>

                            <option
                                value="Merchandise"
                                @selected(old('kategori', $reward->kategori) == 'Merchandise')>

                                🎁 Merchandise

                            </option>

                            <option
                                value="Saldo"
                                @selected(old('kategori', $reward->kategori) == 'Saldo')>

                                💰 Saldo

                            </option>

                            <option
                                value="Penghargaan"
                                @selected(old('kategori', $reward->kategori) == 'Penghargaan')>

                                🏅 Penghargaan

                            </option>

                            <option
                                value="Lainnya"
                                @selected(old('kategori', $reward->kategori) == 'Lainnya')>

                                📦 Lainnya

                            </option>

                        </select>

                        @error('kategori')

                            <small class="text-red-500">

                                {{ $message }}

                            </small>

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
                            value="{{ old('poin',$reward->poin) }}"
                            class="w-full mt-2 rounded-xl border p-3">

                        @error('poin')

                            <small class="text-red-500">

                                {{ $message }}

                            </small>

                        @enderror

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
                            value="{{ old('nilai_reward',$reward->nilai_reward) }}"
                            class="w-full mt-2 rounded-xl border p-3">

                        <small class="text-slate-500">

                            Isi jika reward berupa saldo atau uang tunai.

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
                            value="{{ old('stok',$reward->stok) }}"
                            class="w-full mt-2 rounded-xl border p-3">

                    </div>

                    {{-- Urutan --}}
                    <div>

                        <label class="font-semibold">

                            Urutan Tampil

                        </label>

                        <input
                            type="number"
                            name="urutan"
                            value="{{ old('urutan',$reward->urutan) }}"
                            class="w-full mt-2 rounded-xl border p-3">

                    </div>

                    {{-- Deskripsi --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">

                            Deskripsi

                        </label>

                        <textarea
                            name="deskripsi"
                            rows="6"
                            class="w-full mt-2 rounded-xl border p-3">{{ old('deskripsi',$reward->deskripsi) }}</textarea>

                    </div>

                </div>

            </div>

        </div>
                {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- GAMBAR REWARD --}}
            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-5">

                    Gambar Reward

                </h3>

                <div
                    onclick="document.getElementById('gambar').click()"
                    class="border-2 border-dashed border-slate-300 rounded-3xl p-6 cursor-pointer hover:border-[var(--color-merah)] transition">

                    {{-- Preview --}}
                    <img
                        id="preview"
                        src="{{ $reward->gambar ? asset('storage/'.$reward->gambar) : '' }}"
                        class="{{ $reward->gambar ? '' : 'hidden' }} w-full rounded-2xl shadow-lg mb-4">

                    {{-- Placeholder --}}
                    <div
                        id="placeholder"
                        class="{{ $reward->gambar ? 'hidden' : '' }} text-center py-8">

                        <div class="text-6xl">

                            🖼️

                        </div>

                        <p class="mt-4 text-slate-500">

                            Klik untuk memilih gambar

                        </p>

                        <small class="text-slate-400">

                            JPG, PNG, WEBP (Maks 2MB)

                        </small>

                    </div>

                    <input
                        id="gambar"
                        type="file"
                        name="gambar"
                        accept="image/*"
                        class="hidden">

                </div>

                @error('gambar')

                    <p class="text-red-500 text-sm mt-3">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            {{-- STATUS --}}
            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-5">

                    Status Reward

                </h3>

                <label class="flex items-center gap-3">

                    <input
                        type="checkbox"
                        name="is_aktif"
                        value="1"
                        class="w-5 h-5 rounded"
                        @checked(old('is_aktif',$reward->is_aktif))>

                    <span class="font-medium">

                        Reward Aktif

                    </span>

                </label>

                <p class="text-sm text-slate-500 mt-3">

                    Jika dinonaktifkan maka reward tidak akan tampil
                    pada halaman penukaran poin.

                </p>

            </div>

            {{-- INFO --}}
            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-5">

                    Informasi

                </h3>

                <div class="space-y-4 text-sm">

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Dibuat Oleh

                        </span>

                        <span class="font-semibold">

                            {{ $reward->creator->name ?? '-' }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Dibuat

                        </span>

                        <span>

                            {{ $reward->created_at->format('d M Y H:i') }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Terakhir Update

                        </span>

                        <span>

                            {{ $reward->updated_at->diffForHumans() }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</form>

@endsection
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const nama = document.getElementById('nama');
    const slug = document.getElementById('slug');
    const gambar = document.getElementById('gambar');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');

    /*
    |--------------------------------------------------------------------------
    | Auto Slug
    |--------------------------------------------------------------------------
    */

    nama.addEventListener('keyup', function () {

        slug.value = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');

    });

    /*
    |--------------------------------------------------------------------------
    | Preview Gambar
    |--------------------------------------------------------------------------
    */

    gambar.addEventListener('change', function () {

        if (!this.files.length) {

            if (preview.getAttribute('src') == '') {

                preview.classList.add('hidden');

                placeholder.classList.remove('hidden');

            }

            return;

        }

        const file = this.files[0];

        const reader = new FileReader();

        reader.onload = function (e) {

            preview.src = e.target.result;

            preview.classList.remove('hidden');

            placeholder.classList.add('hidden');

        };

        reader.readAsDataURL(file);

    });

});

</script>

@endpush