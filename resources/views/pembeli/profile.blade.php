@extends('layouts.pembeli', [
    'activePage' => 'profile'
])

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="rounded-[30px] overflow-hidden"
         style="background:linear-gradient(135deg,var(--color-merah),var(--color-coklat));">

        <div class="p-10 flex flex-col lg:flex-row items-center justify-between">

            <div class="text-white">

                <div class="uppercase tracking-[4px] text-xs opacity-80">
                    Profile Saya
                </div>

                <h1 class="text-5xl font-bold mt-3">
                    {{ auth()->user()->name }}
                </h1>

                <p class="mt-4 opacity-90 text-lg">
                    Kelola informasi akun, foto profil, dan data pribadi Anda.
                </p>

            </div>

            <div class="mt-8 lg:mt-0">

                @if(auth()->user()->avatar)

                    @if(Str::startsWith(auth()->user()->avatar,'http'))

                        <img
                            src="{{ auth()->user()->avatar }}"
                            class="w-40 h-40 rounded-full object-cover border-[6px]"
                            style="border-color:rgba(255,255,255,.25);">

                    @else

                        <img
                            src="{{ asset('storage/'.auth()->user()->avatar) }}"
                            class="w-40 h-40 rounded-full object-cover border-[6px]"
                            style="border-color:rgba(255,255,255,.25);">

                    @endif

                @else

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=CC2222&color=fff"
                        class="w-40 h-40 rounded-full border-[6px]"
                        style="border-color:rgba(255,255,255,.25);">

                @endif

            </div>

        </div>

    </div>

    {{-- STATISTIK --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded-3xl p-6 shadow">

            <div class="text-4xl">📦</div>

            <div class="mt-4 text-slate-500">
                Total Order
            </div>

            <div class="text-3xl font-bold mt-2">
                {{ auth()->user()->orders()->count() }}
            </div>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow">

            <div class="text-4xl">💰</div>

            <div class="mt-4 text-slate-500">
                Total Belanja
            </div>

            <div class="text-3xl font-bold mt-2">

                Rp
                {{ number_format(
                    auth()->user()->orders()
                        ->where('status','selesai')
                        ->sum('total_harga'),
                    0,
                    ',',
                    '.'
                ) }}

            </div>

        </div>

        <div class="bg-white rounded-3xl p-6 shadow">

            <div class="text-4xl">⭐</div>

            <div class="mt-4 text-slate-500">
                Total Poin
            </div>

            <div class="text-3xl font-bold mt-2">

                {{ auth()->user()->total_poin }}

            </div>

        </div>

    </div>

    {{-- FORM --}}
    <form
        action="{{ route('pembeli.profile.update') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="bg-white rounded-3xl shadow p-8">

            <h2 class="text-2xl font-bold mb-8">

                Informasi Akun

            </h2>

            <div class="grid lg:grid-cols-2 gap-8">

                {{-- FOTO --}}
                <div>

                    <label class="font-semibold">

                        Foto Profil

                    </label>

                    <input
                        type="file"
                        name="avatar"
                        class="mt-3 w-full border rounded-xl p-3">

                </div>

                {{-- ROLE --}}
                <div>

                    <label class="font-semibold">

                        Role

                    </label>

                    <input
                        class="mt-3 w-full border rounded-xl p-3 bg-slate-100"

                        readonly

                        value="{{ ucfirst(auth()->user()->role) }}">

                </div>

                {{-- NAMA --}}
                <div>

                    <label class="font-semibold">

                        Nama Lengkap

                    </label>

                    <input

                        name="name"

                        value="{{ old('name',auth()->user()->name) }}"

                        class="mt-3 w-full border rounded-xl p-3">

                </div>

                {{-- EMAIL --}}
                <div>

                    <label class="font-semibold">

                        Email

                    </label>

                    <input

                        name="email"

                        value="{{ old('email',auth()->user()->email) }}"

                        class="mt-3 w-full border rounded-xl p-3">

                </div>

                {{-- MEMBERSHIP --}}
                <div>

                    <label class="font-semibold">

                        Membership

                    </label>

                    <input

                        readonly

                        value="{{ auth()->user()->tier->nama ?? 'Belum Ada' }}"

                        class="mt-3 w-full border rounded-xl p-3 bg-slate-100">

                </div>

                {{-- POIN --}}
                <div>

                    <label class="font-semibold">

                        Total Poin

                    </label>

                    <input

                        readonly

                        value="{{ auth()->user()->total_poin }}"

                        class="mt-3 w-full border rounded-xl p-3 bg-slate-100">

                </div>

                {{-- GOOGLE --}}
                <div>

                    <label class="font-semibold">

                        Google Account

                    </label>

                    <input

                        readonly

                        value="{{ auth()->user()->google_id ? 'Terhubung' : 'Tidak Terhubung' }}"

                        class="mt-3 w-full border rounded-xl p-3 bg-slate-100">

                </div>

                {{-- STATUS --}}
                <div>

                    <label class="font-semibold">

                        Status Akun

                    </label>

                    <input

                        readonly

                        value="{{ auth()->user()->is_active ? 'Aktif' : 'Non Aktif' }}"

                        class="mt-3 w-full border rounded-xl p-3 bg-slate-100">

                </div>

            </div>

            <div class="mt-10 flex justify-end gap-4">

                <a

                    href="{{ url('/pembeli') }}"

                    class="px-6 py-3 rounded-xl border">

                    Kembali

                </a>

                <button

                    class="px-8 py-3 rounded-xl text-white font-semibold"

                    style="background:linear-gradient(135deg,var(--color-merah),var(--color-coklat));">

                    💾 Simpan Perubahan

                </button>

            </div>

        </div>

    </form>

</div>

@endsection