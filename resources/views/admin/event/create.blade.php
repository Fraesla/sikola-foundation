@extends('layouts.admin',['activePage'=>'event'])

@section('content')

<div class="max-w-7xl mx-auto">

```
{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">

    <div>
        <h1 class="text-4xl font-bold text-[var(--color-coklat)]">
            📅 Tambah Event Baru
        </h1>

        <p class="text-slate-500 mt-2">
            Buat event baru untuk kegiatan organisasi.
        </p>
    </div>

    <div class="flex gap-3">

        <a href="{{ route('admin.events.index') }}"
           class="px-6 py-3 rounded-2xl border bg-white hover:shadow-md transition">

            ← Kembali

        </a>

        <button form="form-event"
                class="px-6 py-3 rounded-2xl text-white font-semibold shadow-lg hover:scale-105 transition"
                style="
                    background: linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

            💾 Simpan Event

        </button>

    </div>

</div>


<form id="form-event"
      action="{{ route('admin.events.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- KONTEN KIRI --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- INFORMASI EVENT --}}
            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-6">
                    Informasi Event
                </h3>

                <div class="mb-5">

                    <label class="font-semibold mb-2 block">
                        Judul Event
                    </label>

                    <input type="text"
                           name="judul"
                           value="{{ old('judul') }}"
                           class="w-full rounded-xl border px-4 py-3">

                </div>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <label class="font-semibold mb-2 block">
                            Lokasi
                        </label>

                        <input type="text"
                               name="lokasi"
                               value="{{ old('lokasi') }}"
                               class="w-full rounded-xl border px-4 py-3">

                    </div>

                    <div>

                        <label class="font-semibold mb-2 block">
                            Kuota Peserta
                        </label>

                        <input type="number"
                               name="kuota"
                               class="w-full rounded-xl border px-4 py-3">

                    </div>

                </div>

                <div class="grid md:grid-cols-2 gap-5 mt-5">

                    <div>

                        <label class="font-semibold mb-2 block">
                            Tanggal Mulai
                        </label>

                        <input type="datetime-local"
                               name="tanggal_mulai"
                               class="w-full rounded-xl border px-4 py-3">

                    </div>

                    <div>

                        <label class="font-semibold mb-2 block">
                            Tanggal Selesai
                        </label>

                        <input type="datetime-local"
                               name="tanggal_selesai"
                               class="w-full rounded-xl border px-4 py-3">

                    </div>

                </div>

            </div>


            {{-- DESKRIPSI --}}
            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-6">
                    Deskripsi Event
                </h3>

                <textarea name="deskripsi"
                          rows="10"
                          class="w-full rounded-xl border px-4 py-3"
                          placeholder="Tuliskan detail event...">{{ old('deskripsi') }}</textarea>

            </div>

        </div>



        {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- BANNER --}}
            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-5">
                    Banner Event
                </h3>

                <div id="dropzone"
                     class="border-2 border-dashed rounded-2xl p-6 text-center cursor-pointer">

                    <img id="preview"
                         class="hidden w-full h-52 object-cover rounded-xl mb-4">

                    <div id="placeholder">

                        <div class="text-7xl">
                            🖼️
                        </div>

                        <p class="mt-4 text-slate-500">
                            Klik atau Drag Banner
                        </p>

                    </div>

                    <input type="file"
                           id="gambar"
                           name="gambar"
                           class="hidden"
                           accept="image/*">

                </div>

            </div>


            {{-- PENGATURAN --}}
            <div class="card-admin p-8">

                <h3 class="text-xl font-bold mb-5">
                    Pengaturan Event
                </h3>

                <div class="mb-5">

                    <label class="font-semibold block mb-2">
                        Status Event
                    </label>

                    <select name="status"
                            class="w-full rounded-xl border px-4 py-3">

                        <option value="draft">
                            Draft
                        </option>

                        <option value="terbuka">
                            Terbuka
                        </option>

                        <option value="ditutup">
                            Ditutup
                        </option>

                        <option value="selesai">
                            Selesai
                        </option>

                    </select>

                </div>

                <div>

                    <label class="font-semibold block mb-2">
                        Poin Reward Volunteer
                    </label>

                    <input type="number"
                           name="poin_reward"
                           value="50"
                           class="w-full rounded-xl border px-4 py-3">

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

                <h4 class="font-bold text-lg mb-3">
                    💡 Tips
                </h4>

                <ul class="space-y-2 text-sm">

                    <li>• Gunakan banner dengan rasio 16:9.</li>
                    <li>• Isi deskripsi dengan lengkap.</li>
                    <li>• Tentukan kuota peserta.</li>
                    <li>• Atur status sebelum dipublikasikan.</li>

                </ul>

            </div>

        </div>

    </div>

</form>
```

</div>

@endsection

@push('scripts')

<script>

const input = document.getElementById('gambar');
const preview = document.getElementById('preview');
const placeholder = document.getElementById('placeholder');
const dropzone = document.getElementById('dropzone');

dropzone.addEventListener('click', () => input.click());

input.addEventListener('change', function () {

    const file = this.files[0];

    if(!file) return;

    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');

    placeholder.classList.add('hidden');
});

</script>

@endpush
