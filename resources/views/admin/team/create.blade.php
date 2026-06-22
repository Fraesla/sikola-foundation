@extends('layouts.admin',['activePage'=>'konten'])

@section('content')

<div class="max-w-7xl mx-auto">


{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

    <div>
        <h1 class="text-4xl font-bold text-[var(--color-coklat)]">
            👥 Tambah Team Member
        </h1>

        <p class="text-slate-500 mt-2">
            Tambahkan anggota atau pengurus organisasi.
        </p>
    </div>

    <div class="flex gap-3">

        <a href="{{ route('admin.team.index') }}"
           class="px-6 py-3 rounded-xl border bg-white hover:shadow-md transition">

            ← Kembali

        </a>

        <button form="form-team"
                class="px-6 py-3 rounded-xl text-white font-semibold shadow-lg hover:scale-105 transition"
                style="
                    background:linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

            💾 Simpan Team

        </button>

    </div>

</div>


<form id="form-team"
      action="{{ route('admin.team.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- KIRI --}}
        <div class="lg:col-span-2 space-y-6">

            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-6">
                    Informasi Utama
                </h3>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="font-semibold mb-2 block">
                            👤 Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama') }}"
                            class="w-full rounded-xl border px-4 py-3">

                        @error('nama')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div>
                        <label class="font-semibold mb-2 block">
                            💼 Jabatan
                        </label>

                        <input
                            type="text"
                            name="jabatan"
                            value="{{ old('jabatan') }}"
                            class="w-full rounded-xl border px-4 py-3">
                    </div>

                </div>

                <div class="mt-6">

                    <label class="font-semibold mb-2 block">
                        📝 Bio / Deskripsi
                    </label>

                    <textarea
                        rows="8"
                        name="bio"
                        class="w-full rounded-xl border px-4 py-3">{{ old('bio') }}</textarea>

                </div>

            </div>


            {{-- SOSIAL MEDIA --}}
            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-6">
                    🌐 Sosial Media
                </h3>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>
                        <label>📷 Instagram</label>

                        <input
                            type="text"
                            name="instagram"
                            placeholder="https://instagram.com/username"
                            class="w-full rounded-xl border px-4 py-3">
                    </div>

                    <div>
                        <label>📘 Facebook</label>

                        <input
                            type="text"
                            name="facebook"
                            placeholder="https://facebook.com/username"
                            class="w-full rounded-xl border px-4 py-3">
                    </div>

                    <div>
                        <label>🎵 TikTok</label>

                        <input
                            type="text"
                            name="tiktok"
                            placeholder="https://tiktok.com/@username"
                            class="w-full rounded-xl border px-4 py-3">
                    </div>

                    <div>
                        <label>❌ X / Twitter</label>

                        <input
                            type="text"
                            name="twitter"
                            placeholder="https://x.com/username"
                            class="w-full rounded-xl border px-4 py-3">
                    </div>

                    <div>
                        <label>💼 LinkedIn</label>

                        <input
                            type="text"
                            name="linkedin"
                            placeholder="https://linkedin.com/in/username"
                            class="w-full rounded-xl border px-4 py-3">
                    </div>

                    <div>
                        <label>▶️ YouTube</label>

                        <input
                            type="text"
                            name="youtube"
                            placeholder="https://youtube.com/@channel"
                            class="w-full rounded-xl border px-4 py-3">
                    </div>

                    <div class="md:col-span-2">
                        <label>🌍 Website</label>

                        <input
                            type="text"
                            name="website"
                            placeholder="https://website.com"
                            class="w-full rounded-xl border px-4 py-3">
                    </div>

                </div>

            </div>

        </div>


        {{-- SIDEBAR --}}
        <div class="space-y-6">

            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-5">
                    Foto Profil
                </h3>

                <div id="dropzone"
                     class="border-2 border-dashed rounded-2xl p-6 text-center cursor-pointer">

                    <img id="preview"
                         class="hidden w-full h-64 rounded-xl object-cover mb-4">

                    <div id="placeholder">

                        <div class="text-7xl">
                            🖼️
                        </div>

                        <p class="mt-4 text-slate-500">
                            Klik atau Drag Foto
                        </p>

                    </div>

                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        class="hidden"
                        accept="image/*">

                </div>

            </div>


            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-5">
                    Pengaturan
                </h3>

                <div class="mb-5">

                    <label>🔢 Urutan</label>

                    <input
                        type="number"
                        name="urutan"
                        value="1"
                        class="w-full rounded-xl border px-4 py-3">

                </div>

                <div>

                    <label>📌 Status</label>

                    <select
                        name="is_aktif"
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

        </div>

    </div>

</form>


</div>

@endsection

@push('scripts')

<script>

const input = document.getElementById('foto');
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

</script>

@endpush
