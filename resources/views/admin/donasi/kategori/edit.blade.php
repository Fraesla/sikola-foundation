@extends('layouts.admin', [
'activePage' => 'donasi'
])

@section('content')

<div class="max-w-6xl mx-auto">

<!-- Header -->
<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold"
            style="color: var(--color-hitam);">

            Edit Kategori Donasi

        </h1>

        <p class="mt-2"
           style="color: var(--color-coklat);">

            Ubah informasi kategori donasi.

        </p>
    </div>

    <a href="{{ url()->previous() }}"
       class="px-5 py-3 rounded-xl border hover:bg-slate-50 transition">

        ← Kembali

    </a>

</div>


<form action="{{ route('admin.donasiKategori.update', $donasiKategori->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="grid md:grid-cols-3 gap-8">

        <!-- FORM -->
        <div class="md:col-span-2">

            <div class="card-admin p-8 rounded-3xl">

                <h3 class="text-xl font-bold mb-6">
                    Informasi Kategori
                </h3>

                <!-- Nama -->
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama',$donasiKategori->nama) }}"
                        class="w-full rounded-xl border px-4 py-3">

                    @error('nama')
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
                        class="w-full rounded-xl border px-4 py-3">{{ old('deskripsi',$donasiKategori->deskripsi) }}</textarea>

                </div>


                <!-- Icon -->
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Icon (FontAwesome)
                    </label>

                    <input
                        type="text"
                        name="icon"
                        value="{{ old('icon',$donasiKategori->icon) }}"
                        placeholder="fa-solid fa-heart"
                        class="w-full rounded-xl border px-4 py-3">

                </div>


                <!-- Lokasi -->
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Lokasi
                    </label>

                    <input
                        type="text"
                        name="lokasi"
                        value="{{ old('lokasi',$donasiKategori->lokasi) }}"
                        placeholder="Contoh: Makassar"
                        class="w-full rounded-xl border px-4 py-3">

                </div>


                <div class="grid md:grid-cols-2 gap-5">

                    <!-- Minimal -->
                    <div>

                        <label class="block mb-2 font-medium">
                            Minimal Donasi
                        </label>

                        <input
                            type="number"
                            name="minimal_donasi"
                            value="{{ old('minimal_donasi',$donasiKategori->minimal_donasi) }}"
                            class="w-full rounded-xl border px-4 py-3">

                    </div>


                    <!-- Maksimal -->
                    <div>

                        <label class="block mb-2 font-medium">
                            Maksimal Donasi
                        </label>

                        <input
                            type="number"
                            name="maksimal_donasi"
                            value="{{ old('maksimal_donasi',$donasiKategori->maksimal_donasi) }}"
                            class="w-full rounded-xl border px-4 py-3">

                    </div>

                </div>


                <!-- Target -->
                <div class="mt-5">

                    <label class="block mb-2 font-medium">
                        Target Donasi
                    </label>

                    <input
                        type="number"
                        name="target_default"
                        value="{{ old('target_default',$donasiKategori->target_default) }}"
                        class="w-full rounded-xl border px-4 py-3">

                </div>

            </div>

        </div>


        <!-- SIDEBAR -->
        <div>

            <!-- Gambar -->
            <div class="card-admin p-6 rounded-3xl mb-6">

                <h3 class="font-bold mb-4">
                    Gambar Kategori
                </h3>

                @if($donasiKategori->gambar)
                    <img
                        src="{{ asset('storage/'.$donasiKategori->gambar) }}"
                        class="w-full h-52 object-cover rounded-2xl mb-4">
                @endif

                <input
                    type="file"
                    name="gambar"
                    id="gambar"
                    class="w-full border rounded-xl p-3">

                <div class="mt-4">

                    <img
                        id="preview"
                        class="hidden w-full rounded-xl border">

                </div>

            </div>


            <!-- Status -->
            <div class="card-admin p-6 rounded-3xl mb-6">

                <h3 class="font-bold mb-4">
                    Pengaturan
                </h3>

                <label class="flex items-center gap-3">

                    <input
                        type="checkbox"
                        name="is_aktif"
                        {{ $donasiKategori->is_aktif ? 'checked' : '' }}>

                    <span>
                        Kategori Aktif
                    </span>

                </label>

            </div>


            <!-- Tombol -->
            <button
                type="submit"
                class="w-full py-4 rounded-2xl text-white font-semibold shadow-lg hover:scale-105 transition"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

                Update Kategori

            </button>

        </div>

    </div>

</form>

</div>

<script>

document.getElementById('gambar')
.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(event){

            const preview =
                document.getElementById('preview');

            preview.src = event.target.result;

            preview.classList.remove('hidden');
        }

        reader.readAsDataURL(file);
    }

});

</script>

@endsection
