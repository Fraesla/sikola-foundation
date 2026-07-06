@extends('layouts.relawan',[
    'activePage'=>'profile'
])

@section('content')

<div class="grid lg:grid-cols-3 gap-8">

    {{-- CARD PROFILE --}}
    <div
        class="rounded-3xl bg-white shadow-lg p-8 text-center">

        @if(auth()->user()->avatar)

            @if(Str::startsWith(auth()->user()->avatar,'http'))

                <img
                    src="{{ auth()->user()->avatar }}"
                    class="w-36 h-36 rounded-full mx-auto object-cover border-4 border-orange-100">

            @else

                <img
                    src="{{ asset('storage/'.auth()->user()->avatar) }}"
                    class="w-36 h-36 rounded-full mx-auto object-cover border-4 border-orange-100">

            @endif

        @else

            <div
                class="w-36 h-36 rounded-full mx-auto flex items-center justify-center text-6xl text-white"

                style="background:var(--color-merah)">

                {{ strtoupper(substr(auth()->user()->name,0,1)) }}

            </div>

        @endif

        <h2 class="text-3xl font-bold mt-6">

            {{ $user->name }}

        </h2>

        <p class="text-slate-500">

            {{ $user->email }}

        </p>

        <span
            class="inline-block mt-4 px-5 py-2 rounded-full bg-red-100 text-red-600">

            {{ ucfirst($user->role) }}

        </span>

    </div>

    {{-- FORM --}}
    <div class="lg:col-span-2">

        <div class="bg-white rounded-3xl shadow-lg p-8">

            <h3 class="text-2xl font-bold mb-6">

                Edit Profil

            </h3>

            <form
                method="POST"
                action="{{ route('relawan.profile.update') }}"
                enctype="multipart/form-data">

                @csrf

                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label>Nama</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name',$user->name) }}"
                            class="w-full mt-2 rounded-xl border p-3">

                    </div>

                    <div>

                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email',$user->email) }}"
                            class="w-full mt-2 rounded-xl border p-3">

                    </div>

                </div>

                <div class="mt-6">

                    <label>Foto Profil</label>

                    <input
                        type="file"
                        name="avatar"
                        class="w-full mt-2">

                </div>

                <button
                    class="mt-8 px-8 py-3 rounded-2xl text-white font-semibold"

                    style="
                        background:
                        linear-gradient(
                            135deg,
                            var(--color-merah),
                            var(--color-coklat)
                        );
                    ">

                    Simpan Perubahan

                </button>

            </form>

        </div>

        <div
            class="grid md:grid-cols-4 gap-5 mt-8">

            <div class="bg-white rounded-2xl p-5 text-center shadow">

                <div class="text-4xl">

                    ❤️

                </div>

                <h4 class="font-bold mt-3">

                    {{ $totalDonasi }}

                </h4>

                <small>Total Donasi</small>

            </div>

            <div class="bg-white rounded-2xl p-5 text-center shadow">

                <div class="text-4xl">

                    💰

                </div>

                <h4 class="font-bold mt-3">

                    Rp {{ number_format($totalDonasi,0,',','.') }}

                </h4>

                <small>Nominal</small>

            </div>

            <div class="bg-white rounded-2xl p-5 text-center shadow">

                <div class="text-4xl">

                    📦

                </div>

                <h4 class="font-bold mt-3">

                    {{ $totalOrder }}

                </h4>

                <small>Order</small>

            </div>

            <div class="bg-white rounded-2xl p-5 text-center shadow">

                <div class="text-4xl">

                    🛒

                </div>

                <h4 class="font-bold mt-3">

                    {{ $totalKeranjang }}

                </h4>

                <small>Keranjang</small>

            </div>

        </div>

    </div>

</div>

@endsection