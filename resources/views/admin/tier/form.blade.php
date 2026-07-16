{{-- resources/views/admin/tiers/form.blade.php --}}

@csrf

@if(isset($tier))
    @method('PUT')
@endif

<div class="grid lg:grid-cols-3 gap-8">

    {{-- =========================
         FORM
    ========================== --}}
    <div class="lg:col-span-2">

        <div class="bg-white rounded-3xl shadow p-8">

            <h2 class="text-2xl font-bold text-slate-800 mb-8">

                Informasi Tier

            </h2>

            {{-- Nama --}}
            <div class="mb-6">

                <label class="block mb-2 font-semibold">

                    Nama Tier

                </label>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama',$tier->nama ?? '') }}"
                    class="w-full rounded-2xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh : Platinum">

                @error('nama')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

            </div>

            {{-- Icon --}}
            <div class="mb-6">

                <label class="block mb-2 font-semibold">

                    Badge Icon

                </label>

                <input
                    type="text"
                    name="badge_icon"
                    value="{{ old('badge_icon',$tier->badge_icon ?? '') }}"
                    class="w-full rounded-2xl border-slate-300"
                    placeholder="🥇">

                @error('badge_icon')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

            </div>

            {{-- Warna --}}
            <div class="mb-6">

                <label class="block mb-2 font-semibold">

                    Warna Tier

                </label>

                <input
                    type="color"
                    name="warna_hex"
                    value="{{ old('warna_hex',$tier->warna_hex ?? '#2563eb') }}"
                    class="h-14 w-28 rounded-xl border">

                @error('warna_hex')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                {{-- Minimal --}}
                <div>

                    <label class="block mb-2 font-semibold">

                        Minimal Exp

                    </label>

                    <input
                        type="number"
                        name="min_poin"
                        value="{{ old('min_poin',$tier->min_poin ?? 0) }}"
                        class="w-full rounded-2xl border-slate-300">

                    @error('min_poin')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror

                </div>

                {{-- Maksimal --}}
                <div>

                    <label class="block mb-2 font-semibold">

                        Maksimal Exp

                    </label>

                    <input
                        type="number"
                        name="max_poin"
                        value="{{ old('max_poin',$tier->max_poin ?? '') }}"
                        class="w-full rounded-2xl border-slate-300">

                    <small class="text-slate-400">

                        Kosongkan jika tier terakhir.

                    </small>

                    @error('max_poin')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror

                </div>

            </div>

            {{-- Urutan --}}
            <div class="mt-6">

                <label class="block mb-2 font-semibold">

                    Urutan

                </label>

                <input
                    type="number"
                    name="urutan"
                    value="{{ old('urutan',$tier->urutan ?? 1) }}"
                    class="w-full rounded-2xl border-slate-300">

                @error('urutan')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

            </div>

            {{-- Deskripsi --}}
            <div class="mt-6">

                <label class="block mb-2 font-semibold">

                    Deskripsi

                </label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    class="w-full rounded-2xl border-slate-300">{{ old('deskripsi',$tier->deskripsi ?? '') }}</textarea>

                @error('deskripsi')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

            </div>

            {{-- Benefit --}}
            <div class="mt-6">

                <label class="block mb-2 font-semibold">

                    Benefit Tier

                </label>

                <textarea
                    name="keuntungan"
                    rows="8"
                    class="w-full rounded-2xl border-slate-300"
                    placeholder="Merchandise Gratis&#10;Prioritas Event&#10;Voucher Belanja">{{ old('keuntungan',$tier->keuntungan ?? '') }}</textarea>

                <small class="text-slate-500">

                    Satu benefit setiap satu baris.

                </small>

            </div>

        </div>

    </div>

    {{-- =========================
        PREVIEW
    ========================== --}}
    <div>

        <div class="bg-white rounded-3xl shadow p-8 sticky top-8">

            <h3 class="font-bold text-xl mb-6">

                Preview Tier

            </h3>

            <div
                id="previewCard"
                class="rounded-3xl p-8 text-white text-center"
                style="background:{{ old('warna_hex',$tier->warna_hex ?? '#2563eb') }}">

                <div
                    id="previewIcon"
                    class="text-6xl">

                    {{ old('badge_icon',$tier->badge_icon ?? '🏅') }}

                </div>

                <h2
                    id="previewNama"
                    class="text-3xl font-bold mt-5">

                    {{ old('nama',$tier->nama ?? 'Nama Tier') }}

                </h2>

                <p
                    id="previewDeskripsi"
                    class="mt-2">

                    {{ old('deskripsi',$tier->deskripsi ?? 'Deskripsi Tier') }}

                </p>

            </div>

            <button
                type="submit"
                class="w-full mt-8 rounded-2xl py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold">

                💾 Simpan Tier

            </button>

            <a
                href="{{ route('admin.tier.index') }}"
                class="block text-center mt-4 rounded-2xl py-4 bg-slate-200 hover:bg-slate-300">

                Kembali

            </a>

        </div>

    </div>

</div>

<script>

const nama = document.querySelector('[name=nama]');
const icon = document.querySelector('[name=badge_icon]');
const warna = document.querySelector('[name=warna_hex]');
const deskripsi = document.querySelector('[name=deskripsi]');

nama.addEventListener('keyup',()=>{

    document.getElementById('previewNama').innerHTML =
        nama.value || 'Nama Tier';

});

icon.addEventListener('keyup',()=>{

    document.getElementById('previewIcon').innerHTML =
        icon.value || '🏅';

});

deskripsi.addEventListener('keyup',()=>{

    document.getElementById('previewDeskripsi').innerHTML =
        deskripsi.value || 'Deskripsi Tier';

});

warna.addEventListener('input',()=>{

    document.getElementById('previewCard').style.background =
        warna.value;

});

</script>