@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-r from-green-600 to-emerald-500 py-20">

    <div class="container mx-auto px-6 text-center text-white">

        <h1 class="text-5xl font-bold">
            Donasi
        </h1>

        <p class="mt-4">
            Setiap donasi Anda membantu perubahan yang lebih baik.
        </p>

    </div>

</section>

<section class="py-20">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-10">

            <!-- FORM -->
            <div class="bg-white p-8 rounded-3xl shadow">

                <h2 class="text-2xl font-bold mb-6">
                    Form Donasi
                </h2>

                <form>

                    <input type="text"
                        placeholder="Nama Donatur"
                        class="w-full border rounded-xl p-3 mb-4">

                    <input type="email"
                        placeholder="Email"
                        class="w-full border rounded-xl p-3 mb-4">

                    <input type="number"
                        placeholder="Nominal Donasi"
                        class="w-full border rounded-xl p-3 mb-4">

                    <select class="w-full border rounded-xl p-3 mb-4">
                        <option>Donasi Sekali</option>
                        <option>Donasi Bulanan</option>
                    </select>

                    <button
                        class="w-full bg-green-600 text-white py-3 rounded-xl">

                        Donasi Sekarang

                    </button>

                </form>

            </div>

            <!-- REKENING -->
            <div class="bg-slate-50 p-8 rounded-3xl">

                <h2 class="text-2xl font-bold mb-6">
                    Informasi Rekening
                </h2>

                <div class="space-y-4">

                    <div>
                        <p class="font-bold">Bank BCA</p>
                        <p>1234567890</p>
                        <p>a.n Sikola Foundation</p>
                    </div>

                    <div>
                        <p class="font-bold">Bank Mandiri</p>
                        <p>9876543210</p>
                        <p>a.n Sikola Foundation</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection