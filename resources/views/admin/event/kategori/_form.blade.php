<form
    id="form-event"
    action="{{ $action }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    @if($method !== 'POST')
        @method($method)
    @endif

    {{-- ================= VALIDATION ================= --}}
    @if ($errors->any())

        <div
            class="mb-8 rounded-3xl border border-red-200 bg-red-50 p-6">

            <h4
                class="font-bold text-red-700 mb-4">

                Terdapat kesalahan pada form.

            </h4>

            <ul class="list-disc ml-5 text-red-600 space-y-1">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">

        {{-- ================= KONTEN KIRI ================= --}}
        <div class="xl:col-span-8 space-y-8">

            {{-- ================= INFORMASI EVENT ================= --}}
            <div class="admin-card rounded-3xl p-8">

                <h2
                    class="text-2xl font-bold mb-8"
                    style="color:var(--color-hitam);">

                    Informasi Event

                </h2>

                {{-- Judul --}}
                <div class="mb-6">

                    <label class="font-semibold mb-2 block">

                        Judul Event

                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        value="{{ old('judul', optional($event)->judul) }}"
                        class="w-full rounded-2xl border px-5 py-4"
                        placeholder="Contoh : Volunteer Bersih Pantai">

                </div>

                {{-- Slug --}}
                <div class="mb-6">

                    <label class="font-semibold mb-2 block">

                        Slug

                    </label>

                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        value="{{ old('slug', optional($event)->slug) }}"
                        class="w-full rounded-2xl border px-5 py-4"
                        placeholder="volunteer-bersih-pantai">

                    <small class="text-slate-500">

                        Slug akan dibuat otomatis dari judul.

                    </small>

                </div>

                {{-- Lokasi --}}
                <div class="mb-6">

                    <label class="font-semibold mb-2 block">

                        Lokasi Event

                    </label>

                    <input
                        type="text"
                        name="lokasi"
                        value="{{ old('lokasi', optional($event)->lokasi) }}"
                        class="w-full rounded-2xl border px-5 py-4"
                        placeholder="Masukkan lokasi event">

                </div>

                {{-- Deskripsi --}}
                <div>

                    <label class="font-semibold mb-2 block">

                        Deskripsi Event

                    </label>

                    <textarea
                        rows="10"
                        name="deskripsi"
                        class="w-full rounded-2xl border px-5 py-4"
                        placeholder="Tuliskan deskripsi lengkap event...">{{ old('deskripsi', optional($event)->deskripsi) }}</textarea>

                </div>

            </div>

            {{-- ================= PENGATURAN EVENT ================= --}}
            <div class="admin-card rounded-3xl p-8">

                <h2
                    class="text-2xl font-bold mb-8"
                    style="color:var(--color-hitam);">

                    Jadwal & Pengaturan

                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Tanggal Mulai --}}
                    <div>

                        <label class="font-semibold mb-2 block">

                            Tanggal Mulai

                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="datetime-local"
                            name="tanggal_mulai"
                            value="{{ old(
                                'tanggal_mulai',
                                optional(optional($event)->tanggal_mulai)->format('Y-m-d\TH:i')
                            ) }}"
                            class="w-full rounded-2xl border px-5 py-4">

                    </div>

                    {{-- Tanggal Selesai --}}
                    <div>

                        <label class="font-semibold mb-2 block">

                            Tanggal Selesai

                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="datetime-local"
                            name="tanggal_selesai"
                            value="{{ old(
                                'tanggal_selesai',
                                optional(optional($event)->tanggal_selesai)->format('Y-m-d\TH:i')
                            ) }}"
                            class="w-full rounded-2xl border px-5 py-4">

                    </div>

                </div>

                <div class="grid md:grid-cols-3 gap-6 mt-6">

                    {{-- Kuota --}}
                    <div>

                        <label class="font-semibold mb-2 block">

                            Kuota Peserta

                        </label>

                        <input
                            type="number"
                            min="1"
                            name="kuota"
                            value="{{ old('kuota', optional($event)->kuota) }}"
                            class="w-full rounded-2xl border px-5 py-4">

                    </div>

                    {{-- Interval Scan --}}
                    <div>

                        <label class="font-semibold mb-2 block">

                            Interval Scan (menit)

                        </label>

                        <input
                            type="number"
                            min="1"
                            name="interval_scan"
                            value="{{ old('interval_scan', optional($event)->interval_scan ?? 60) }}"
                            class="w-full rounded-2xl border px-5 py-4">

                    </div>

                    {{-- Toleransi --}}
                    <div>

                        <label class="font-semibold mb-2 block">

                            Toleransi Scan (menit)

                        </label>

                        <input
                            type="number"
                            min="0"
                            name="toleransi_scan"
                            value="{{ old('toleransi_scan', optional($event)->toleransi_scan ?? 15) }}"
                            class="w-full rounded-2xl border px-5 py-4">

                    </div>

                </div>

            </div>

             {{-- ================= TIPS ================= --}}
            <div
                class="rounded-3xl p-7 text-white"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        var(--color-merah),
                        var(--color-coklat)
                    );
                ">

                <h3 class="font-bold text-xl mb-4">

                    💡 Tips

                </h3>

                <ul class="space-y-3 text-sm leading-7">

                    <li>• Gunakan banner dengan rasio 16:9.</li>

                    <li>• Pastikan tanggal selesai lebih besar dari tanggal mulai.</li>

                    <li>• Tentukan interval scan sesuai kebutuhan absensi.</li>

                    <li>• Reward point akan diberikan kepada peserta yang lulus.</li>

                    <li>• Penalty point digunakan apabila peserta tidak memenuhi syarat kelulusan.</li>

                </ul>

            </div>

        </div>

        {{-- ================= SIDEBAR ================= --}}
        <div class="xl:col-span-4 space-y-8">

            {{-- Banner Event --}}
            <div class="admin-card rounded-3xl p-8">

                <h2
                    class="text-2xl font-bold mb-6"
                    style="color:var(--color-hitam);">

                    Banner Event

                </h2>

                <div
                    id="dropzone"
                    class="border-2 border-dashed rounded-3xl p-6 cursor-pointer text-center hover:border-red-400 transition">

                    <img
                        id="preview"
                        src="{{ isset($event) && $event?->gambar ? asset('storage/'.$event->gambar) : '' }}"
                        class="{{ isset($event) && $event?->gambar ? '' : 'hidden' }} w-full h-60 object-cover rounded-2xl mb-4">

                    <div
                        id="placeholder"
                        class="{{ isset($event) && $event?->gambar ? 'hidden' : '' }}">

                        <div class="text-7xl">

                            🖼️

                        </div>

                        <p class="mt-4 text-slate-500">

                            Klik untuk memilih banner

                        </p>

                    </div>

                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        class="hidden"
                        accept="image/*">

                </div>

            </div>
                        {{-- ================= PENGATURAN ================= --}}
            <div class="admin-card rounded-3xl p-8">

                <h2
                    class="text-2xl font-bold mb-6"
                    style="color:var(--color-hitam);">

                    Pengaturan Event

                </h2>

                {{-- Status --}}
                <div class="mb-6">

                    <label class="font-semibold block mb-2">

                        Status Event

                    </label>

                    <select
                        name="status"
                        class="w-full rounded-2xl border px-5 py-4">

                        <option
                            value="draft"
                            @selected(old('status', optional($event)->status)=='draft')>

                            Draft

                        </option>

                        <option
                            value="terbuka"
                            @selected(old('status', optional($event)->status)=='terbuka')>

                            Terbuka

                        </option>

                        <option
                            value="selesai"
                            @selected(old('status', optional($event)->status)=='selesai')>

                            Selesai

                        </option>

                        <option
                            value="ditutup"
                            @selected(old('status', optional($event)->status)=='ditutup')>

                            Ditutup

                        </option>

                    </select>

                </div>

                {{-- Reward --}}
                <div class="mb-6">

                    <label class="font-semibold block mb-2">

                        Poin Reward

                    </label>

                    <input
                        type="number"
                        min="0"
                        name="poin_reward"
                        value="{{ old('poin_reward', optional($event)->poin_reward ?? 0) }}"
                        class="w-full rounded-2xl border px-5 py-4">

                    <small class="text-slate-500">

                        Poin diberikan kepada peserta yang lulus.

                    </small>

                </div>

                {{-- Penalty --}}
                <div>

                    <label class="font-semibold block mb-2">

                        Poin Penalty

                    </label>

                    <input
                        type="number"
                        min="0"
                        name="poin_penalty"
                        value="{{ old('poin_penalty', optional($event)->poin_penalty ?? 0) }}"
                        class="w-full rounded-2xl border px-5 py-4">

                    <small class="text-slate-500">

                        Pengurangan poin apabila peserta tidak lulus.

                    </small>

                </div>

            </div>


            {{-- ================= RINGKASAN ================= --}}
            <div class="admin-card rounded-3xl p-8">

                <h2
                    class="text-xl font-bold mb-5"
                    style="color:var(--color-hitam);">

                    Ringkasan Pengaturan

                </h2>

                <div class="space-y-4 text-sm">

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Reward

                        </span>

                        <strong>

                            {{ old('poin_reward', optional($event)->poin_reward ?? 0) }}
                            Point

                        </strong>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Penalty

                        </span>

                        <strong>

                            {{ old('poin_penalty', optional($event)->poin_penalty ?? 0) }}
                            Point

                        </strong>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Interval Scan

                        </span>

                        <strong>

                            {{ old('interval_scan', optional($event)->interval_scan ?? 60) }}
                            Menit

                        </strong>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-500">

                            Toleransi

                        </span>

                        <strong>

                            {{ old('toleransi_scan', optional($event)->toleransi_scan ?? 15) }}
                            Menit

                        </strong>

                    </div>

                </div>

            </div>

            {{-- ================= ACTION BUTTON ================= --}}
            <div class="admin-card rounded-3xl p-6">

                <div class="flex flex-col gap-3">

                    <button
                        type="submit"
                        class="w-full py-4 rounded-2xl text-white font-bold text-lg shadow-lg hover:scale-[1.02] transition"
                        style="
                            background:
                            linear-gradient(
                                135deg,
                                var(--color-merah),
                                var(--color-coklat)
                            );
                        ">

                        {{ $method == 'POST' ? '💾 Simpan Event' : '💾 Update Event' }}

                    </button>

                    <a
                        href="{{ route('admin.events.index') }}"
                        class="w-full py-4 rounded-2xl border text-center font-semibold hover:bg-slate-50 transition">

                        ← Kembali ke Daftar Event

                    </a>

                    @if($method == 'PUT')

                        <a
                            href="{{ route('admin.events.create') }}"
                            class="w-full py-4 rounded-2xl bg-slate-100 text-center font-semibold hover:bg-slate-200 transition">

                            ➕ Tambah Event Baru

                        </a>

                    @endif

                </div>

            </div>

        </div>
        {{-- END SIDEBAR --}}

    </div>
    {{-- END GRID --}}

</form>