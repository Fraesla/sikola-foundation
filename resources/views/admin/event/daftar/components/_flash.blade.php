@if(session('success'))

<div
    class="alert-auto-close rounded-3xl border border-green-200 bg-green-50 p-5">

    <div class="flex gap-4">

        <div
            class="w-12 h-12 rounded-xl bg-green-600 text-white flex items-center justify-center">

            ✅

        </div>

        <div>

            <h3 class="font-bold text-green-700">

                Berhasil

            </h3>

            <p class="text-green-600">

                {{ session('success') }}

            </p>

        </div>

    </div>

</div>

@endif


@if(session('error'))

<div
    class="alert-auto-close rounded-3xl border border-red-200 bg-red-50 p-5">

    <div class="flex gap-4">

        <div
            class="w-12 h-12 rounded-xl bg-red-600 text-white flex items-center justify-center">

            ❌

        </div>

        <div>

            <h3 class="font-bold text-red-700">

                Terjadi Kesalahan

            </h3>

            <p class="text-red-600">

                {{ session('error') }}

            </p>

        </div>

    </div>

</div>

@endif