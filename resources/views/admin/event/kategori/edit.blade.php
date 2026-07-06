@extends('layouts.admin',['activePage'=>'event'])

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

        <div>
            <h1 class="text-4xl font-bold text-[var(--color-coklat)]">
                ✏️ Edit Event
            </h1>

            <p class="text-slate-500 mt-2">
                Perbarui informasi event organisasi.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ url()->previous() }}"
               class="px-6 py-3 rounded-xl border bg-white hover:shadow-md">

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

            💾 Update Event

            </button>

        </div>

    </div>

    <form id="form-event"
          action="{{ route('admin.events.update',$event) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- KIRI --}}
            <div class="lg:col-span-2 space-y-6">

                <div class="card-admin p-8">

                    <h3 class="text-xl font-bold mb-6">
                        Informasi Event
                    </h3>

                    <div class="space-y-5">

                        <div>
                            <label class="font-semibold block mb-2">
                                Judul Event
                            </label>

                            <input type="text"
                                   name="judul"
                                   value="{{ old('judul',$event->judul) }}"
                                   class="w-full rounded-xl border px-4 py-3">
                        </div>

                        <div>
                            <label class="font-semibold block mb-2">
                                Deskripsi
                            </label>

                            <textarea
                                rows="8"
                                name="deskripsi"
                                class="w-full rounded-xl border px-4 py-3">{{ old('deskripsi',$event->deskripsi) }}</textarea>
                        </div>

                        <div>
                            <label class="font-semibold block mb-2">
                                Lokasi
                            </label>

                            <input type="text"
                                   name="lokasi"
                                   value="{{ old('lokasi',$event->lokasi) }}"
                                   class="w-full rounded-xl border px-4 py-3">
                        </div>

                    </div>

                </div>

            </div>

            {{-- SIDEBAR --}}
            <div class="space-y-6">

                {{-- FOTO --}}
                <div class="card-admin p-8">

                    <h3 class="font-bold text-xl mb-5">
                        Poster Event
                    </h3>

                    <div id="dropzone"
                         class="border-2 border-dashed rounded-2xl p-5 text-center cursor-pointer">

                        <img id="preview"
                             src="{{ $event->gambar ? asset('storage/'.$event->gambar) : '' }}"
                             class="{{ $event->gambar ? '' : 'hidden' }} w-full h-56 object-cover rounded-xl mb-4">

                        <div id="placeholder"
                             class="{{ $event->gambar ? 'hidden' : '' }}">

                            <div class="text-6xl">
                                🖼️
                            </div>

                            <p class="mt-3 text-slate-500">
                                Klik untuk upload poster
                            </p>

                        </div>

                        <input type="file"
                               name="gambar"
                               id="gambar"
                               class="hidden"
                               accept="image/*">

                    </div>

                </div>

                {{-- PENGATURAN --}}
                <div class="card-admin p-8">

                    <h3 class="font-bold text-xl mb-5">
                        Pengaturan
                    </h3>

                    <div class="space-y-5">

                        <div>
                            <label>Tanggal Mulai</label>

                            <input type="datetime-local"
                                   name="tanggal_mulai"
                                   value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($event->tanggal_mulai)->format('Y-m-d\TH:i')) }}"
                                   class="w-full rounded-xl border px-4 py-3">
                        </div>

                        <div>
                            <label>Tanggal Selesai</label>

                            <input type="datetime-local"
                                   name="tanggal_selesai"
                                   value="{{ old('tanggal_selesai', optional($event->tanggal_selesai)->format('Y-m-d\TH:i')) }}"
                                   class="w-full rounded-xl border px-4 py-3">
                        </div>

                        <div>
                            <label>Kuota</label>

                            <input type="number"
                                   name="kuota"
                                   value="{{ old('kuota',$event->kuota) }}"
                                   class="w-full rounded-xl border px-4 py-3">
                        </div>

                        <div>
                            <label>Poin Reward</label>

                            <input type="number"
                                   name="poin_reward"
                                   value="{{ old('poin_reward',$event->poin_reward) }}"
                                   class="w-full rounded-xl border px-4 py-3">
                        </div>

                        <div>
                            <label>Status</label>

                            <select name="status"
                                    class="w-full rounded-xl border px-4 py-3">

                                <option value="draft"
                                    {{ $event->status=='draft' ? 'selected' : '' }}>
                                    Draft
                                </option>

                                <option value="terbuka"
                                    {{ $event->status=='terbuka' ? 'selected' : '' }}>
                                    Terbuka
                                </option>

                                <option value="ditutup"
                                    {{ $event->status=='ditutup' ? 'selected' : '' }}>
                                    Ditutup
                                </option>

                                <option value="selesai"
                                    {{ $event->status=='selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                            </select>

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

const input = document.getElementById('gambar');
const preview = document.getElementById('preview');
const placeholder = document.getElementById('placeholder');
const dropzone = document.getElementById('dropzone');

dropzone.addEventListener('click', () => input.click());

input.addEventListener('change', function(){

    const file = this.files[0];

    if(!file) return;

    preview.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');

    if(placeholder){
        placeholder.classList.add('hidden');
    }

});

</script>

@endpush