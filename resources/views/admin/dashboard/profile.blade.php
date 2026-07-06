@extends('layouts.admin',[
    'activePage'=>'profile'
])

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>

            <p class="uppercase tracking-[5px] text-xs font-semibold text-amber-600">
                ACCOUNT CENTER
            </p>

            <h1 class="text-4xl font-black mt-2">
                Profil Saya
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola informasi akun administrator.
            </p>

        </div>

        <a href="{{ url()->previous() }}"
           class="btn-premium-secondary">

            ← Kembali

        </a>

    </div>
    <div class="profile-hero">

        <div class="profile-left">

            <div class="profile-avatar">

                @if(Auth::user()->avatar)

                    <img
                        src="{{ asset('storage/'.Auth::user()->avatar) }}"
                        alt="">

                @else

                    <img
                        src="https://ui-avatars.com/api/?background=CC2222&color=fff&name={{ urlencode(Auth::user()->name) }}"
                        alt="">

                @endif

            </div>

            <div>

                <h2>

                    {{ Auth::user()->name }}

                </h2>

                <p>

                    {{ Auth::user()->email }}

                </p>

                <div class="mt-4">

                    <span class="badge-role">

                        {{ ucfirst(Auth::user()->role) }}

                    </span>

                </div>

            </div>

        </div>

        <div class="profile-right">

            <div class="profile-circle">

                👤

            </div>

        </div>

    </div>
    <div class="profile-card mt-8">

    <form
    action="{{ route('admin.profile.update') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="grid lg:grid-cols-2 gap-8">
        <div class="lg:col-span-2">

            <label class="form-label">

                Foto Profil

            </label>

            <div class="upload-box">

                <img

                    id="preview"

                    src="{{ Auth::user()->avatar
                        ? asset('storage/'.Auth::user()->avatar)
                        : 'https://ui-avatars.com/api/?background=CC2222&color=fff&name='.urlencode(Auth::user()->name)
                    }}">

                <div>

                    <input
                        type="file"
                        name="avatar"
                        id="foto"
                        class="form-control">

                    <small class="text-slate-500">

                        JPG, PNG maksimal 2MB.

                    </small>

                </div>

            </div>

        </div>
        <div>

            <label class="form-label">

            Nama Lengkap

            </label>

            <input
            type="text"
            name="name"
            class="form-control premium-input"
            value="{{ old('name',Auth::user()->name) }}">

        </div>

        <div>

            <label class="form-label">

            Email

            </label>

            <input
            type="email"
            name="email"
            class="form-control premium-input"
            value="{{ old('email',Auth::user()->email) }}">

        </div>

        <div>

            <label class="form-label">

            Role

            </label>

            <input
            readonly
            class="form-control premium-input bg-slate-100"
            value="{{ ucfirst(Auth::user()->role) }}">

        </div>
        <div>

            <label class="form-label">

            Terdaftar

            </label>

           <!--  -->

        </div>
        <div class="lg:col-span-2">

        <div class="flex justify-end gap-3 mt-6">

        <button
        type="reset"
        class="btn-premium-light">

        Reset

        </button>

        <button
        type="submit"
        class="btn-premium">

        💾 Simpan Perubahan

        </button>

        </div>

        </div>

        </div>

        </form>

</div>

<script>

foto.onchange = evt => {

const [file] = foto.files;

if(file){

preview.src = URL.createObjectURL(file);

}

}

</script>

@endsection