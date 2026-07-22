<div class="border-t mt-8 pt-6">

    {{-- Detail --}}
    <a
        href="{{ route('admin.event.show',$item->id) }}"
        class="w-full flex items-center justify-center gap-2 py-3 rounded-2xl bg-blue-50 text-blue-700 font-semibold hover:bg-blue-100 transition">

        👁 Detail Registrasi

    </a>

    @if($item->status=='mendaftar')

        <div class="grid grid-cols-2 gap-3 mt-4">

            {{-- Konfirmasi --}}
            <form
                action="{{ route('admin.event.konfirmasi',$item) }}"
                method="POST">

                @csrf
                @method('PATCH')

                <button
                    class="btn-confirm w-full py-3 rounded-2xl bg-green-600 text-white font-semibold hover:bg-green-700 transition"
                    data-message="Konfirmasi peserta ini?">

                    ✅ Konfirmasi

                </button>

            </form>

            {{-- Tolak --}}
            <form
                action="{{ route('admin.event.tolak',$item) }}"
                method="POST">

                @csrf
                @method('PATCH')

                <button
                    class="btn-confirm w-full py-3 rounded-2xl bg-red-600 text-white font-semibold hover:bg-red-700 transition"
                    data-message="Tolak registrasi ini?">

                    ❌ Tolak

                </button>

            </form>

        </div>

    @elseif($item->status=='dikonfirmasi')

        <div
            class="mt-4 rounded-2xl bg-green-50 border border-green-200 p-5 text-center">

            <div class="text-4xl">

                🎉

            </div>

            <h3
                class="mt-2 font-bold text-green-700">

                Peserta Sudah Dikonfirmasi

            </h3>

            <p
                class="mt-2 text-sm text-green-600">

                Peserta telah berhasil masuk
                ke daftar peserta event.

            </p>

        </div>

    @else

        <div
            class="mt-4 rounded-2xl bg-red-50 border border-red-200 p-5 text-center">

            <div class="text-4xl">

                ❌

            </div>

            <h3
                class="mt-2 font-bold text-red-700">

                Registrasi Ditolak

            </h3>

            <p
                class="mt-2 text-sm text-red-600">

                Registrasi peserta telah ditolak.

            </p>

        </div>

    @endif

</div>