<div class="admin-card rounded-3xl p-8">

    <h3
        class="text-2xl font-black mb-8"
        style="color:var(--color-hitam);">

        Timeline Registrasi

    </h3>

    <div class="space-y-8">

        <div class="flex gap-5">

            <div
                class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center">

                1

            </div>

            <div>

                <h4 class="font-bold">

                    Registrasi Dibuat

                </h4>

                <p class="text-slate-500">

                    {{ $registrasi->created_at->translatedFormat('d F Y H:i') }}

                </p>

            </div>

        </div>

        @if($registrasi->status=='dikonfirmasi')

            <div class="flex gap-5">

                <div
                    class="w-12 h-12 rounded-full bg-green-600 text-white flex items-center justify-center">

                    ✓

                </div>

                <div>

                    <h4 class="font-bold">

                        Registrasi Dikonfirmasi

                    </h4>

                    <p class="text-green-600">

                        Peserta telah diterima mengikuti event.

                    </p>

                </div>

            </div>

        @elseif($registrasi->status=='ditolak')

            <div class="flex gap-5">

                <div
                    class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center">

                    ✕

                </div>

                <div>

                    <h4 class="font-bold">

                        Registrasi Ditolak

                    </h4>

                    <p class="text-red-600">

                        Peserta tidak diterima pada event ini.

                    </p>

                </div>

            </div>

        @else

            <div class="flex gap-5">

                <div
                    class="w-12 h-12 rounded-full bg-yellow-500 text-white flex items-center justify-center">

                    …

                </div>

                <div>

                    <h4 class="font-bold">

                        Menunggu Konfirmasi Admin

                    </h4>

                    <p class="text-yellow-600">

                        Registrasi sedang menunggu proses verifikasi.

                    </p>

                </div>

            </div>

        @endif

    </div>

</div>