@extends('layouts.admin', [
    'activePage' => 'donasi'
])

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold"
                style="color: var(--color-hitam)">
                Tambah Kategori Donasi
            </h1>

            <p class="mt-2"
               style="color: var(--color-coklat)">
                Tambahkan kategori program donasi baru.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ url()->previous() }}"
               class="px-5 py-3 rounded-xl border hover:bg-slate-50 transition">

                ← Kembali Donasi

            </a>

            <a href="{{ url('/donasi') }}"
               class="px-5 py-3 rounded-xl border hover:bg-slate-50 transition">

                Daftar Kategori

            </a>

        </div>

    </div>


    <form action="{{ route('admin.donasiKategori.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- FORM UTAMA -->
            <div class="lg:col-span-2">

                <div class="admin-card p-8 rounded-3xl">

                    <h3 class="text-xl font-bold mb-8">
                        Informasi Kategori
                    </h3>

                    <!-- Nama -->
                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Nama Kategori
                        </label>

                        <input type="text"
                               name="nama"
                               value="{{ old('nama') }}"
                               placeholder="Contoh : Donasi Pendidikan"

                               class="w-full rounded-xl border px-4 py-3">

                        @error('nama')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <!-- Deskripsi -->
                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  rows="5"
                                  class="w-full rounded-xl border px-4 py-3"
                                  placeholder="Deskripsi program donasi...">{{ old('deskripsi') }}</textarea>

                    </div>


                    <!-- Lokasi -->
                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Lokasi Program
                        </label>

                        <input type="text"
                               name="lokasi"
                               value="{{ old('lokasi') }}"
                               placeholder="Contoh : Makassar, Sulawesi Selatan"

                               class="w-full rounded-xl border px-4 py-3">

                    </div>


                    <!-- Icon -->
                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Icon (Opsional)
                        </label>

                        <input type="text"
                               name="icon"
                               value="{{ old('icon') }}"
                               placeholder="Contoh : fas fa-graduation-cap"

                               class="w-full rounded-xl border px-4 py-3">

                        <small class="text-slate-500">
                            Gunakan class icon FontAwesome.
                        </small>

                    </div>


                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- Minimal -->
                        <div>

                            <label class="block mb-2 font-semibold">
                                Minimal Donasi
                            </label>

                            <input type="number"
                                   name="minimal_donasi"
                                   value="{{ old('minimal_donasi') }}"
                                   placeholder="10000"

                                   class="w-full rounded-xl border px-4 py-3">

                        </div>

                        <!-- Maksimal -->
                        <div>

                            <label class="block mb-2 font-semibold">
                                Maksimal Donasi
                            </label>

                            <input type="number"
                                   name="maksimal_donasi"
                                   value="{{ old('maksimal_donasi') }}"
                                   placeholder="Kosongkan jika tidak dibatasi"

                                   class="w-full rounded-xl border px-4 py-3">

                        </div>

                    </div>


                    <!-- Target -->
                    <div class="mt-6">

                        <label class="block mb-2 font-semibold">
                            Target Donasi
                        </label>

                        <input type="number"
                               name="target_default"
                               value="{{ old('target_default') }}"
                               placeholder="100000000"

                               class="w-full rounded-xl border px-4 py-3">

                    </div>

                </div>

            </div>


            <!-- SIDEBAR -->
            <div>

                <!-- Upload -->
                <div class="admin-card p-6 rounded-3xl mb-6">

                    <h3 class="font-bold mb-4">
                        Gambar Kategori
                    </h3>

                    <input type="file"
                           name="gambar"
                           id="gambar"
                           accept="image/*"
                           class="w-full rounded-xl border p-3">

                    @error('gambar')
                        <small class="text-red-500">
                            {{ $message }}
                        </small>
                    @enderror

                    <img id="preview"
                         class="hidden mt-4 rounded-2xl w-full border">

                </div>


                <!-- Pengaturan -->
                <div class="admin-card p-6 rounded-3xl mb-6">

                    <h3 class="font-bold mb-4">
                        Pengaturan
                    </h3>

                    <label class="flex items-center gap-3">

                        <input type="checkbox"
                               name="is_aktif"
                               checked>

                        <span>
                            Aktifkan Kategori
                        </span>

                    </label>

                </div>


                <!-- Submit -->
                <button type="submit"
                        class="w-full py-4 rounded-2xl text-white font-semibold shadow-lg hover:scale-105 transition"

                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                    Simpan Kategori

                </button>

            </div>

        </div>

    </form>

</div>


<script>

document
.getElementById('gambar')
.addEventListener('change', function(e){

    let file = e.target.files[0];

    if(file){

        let reader = new FileReader();

        reader.onload = function(ev){

            let preview =
                document.getElementById('preview');

            preview.src = ev.target.result;
            preview.classList.remove('hidden');

        }

        reader.readAsDataURL(file);

    }

});

</script>

@endsection