@extends('layouts.admin', [
    'activePage' => 'pengguna'
])

@section('content')

<style>

:root{
    --primary: var(--color-merah);
    --secondary: var(--color-coklat);
    --gold: var(--color-kuning);
}

.create-page{
    max-width:1400px;
    margin:auto;
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:35px;
}

.page-title{
    font-size:42px;
    font-weight:800;
    color:#111827;
    margin-bottom:8px;
}

.page-subtitle{
    font-size:16px;
    color:#64748b;
}

.page-label{
    letter-spacing:4px;
    font-size:13px;
    font-weight:700;
    color:var(--secondary);
    text-transform:uppercase;
    margin-bottom:10px;
}

.btn-back{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:14px 26px;
    border-radius:16px;
    text-decoration:none;
    color:#fff;
    font-weight:700;
    background:linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );
    box-shadow:0 18px 35px rgba(181,101,29,.28);
    transition:.25s;
}

.btn-back:hover{
    transform:translateY(-3px);
    color:#fff;
}

.hero-card{

    background:#fff;
    border-radius:30px;
    overflow:hidden;
    box-shadow:
        0 15px 45px rgba(0,0,0,.08);

    border:1px solid rgba(212,160,23,.12);
}

.hero-top{

    padding:40px;

    background:

    radial-gradient(circle at top right,
    rgba(212,160,23,.15),
    transparent 35%),

    linear-gradient(
        135deg,
        #ffffff,
        #fff8ef
    );

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.hero-left{
    display:flex;
    align-items:center;
    gap:24px;
}

.hero-icon{

    width:92px;
    height:92px;

    border-radius:24px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:40px;
    color:white;

    background:
    linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );

    box-shadow:
        0 20px 40px rgba(181,101,29,.25);

}

.hero-title{

    font-size:34px;
    font-weight:800;
    color:#111827;

}

.hero-desc{

    color:#64748b;
    margin-top:8px;
    font-size:15px;

}

.hero-image{

    font-size:90px;
    opacity:.15;

}

</style>

<div class="create-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div>

            <div class="page-label">
                MANAGEMENT CENTER
            </div>

            <div class="page-title">
                Tambah Pengguna
            </div>

            <div class="page-subtitle">
                Tambahkan akun Admin, Relawan, Donatur maupun Pembeli.
            </div>

        </div>

        <a href="{{ route('admin.pengguna.index') }}"
           class="btn-back">

            ← Kembali

        </a>

    </div>
    {{-- HERO CARD --}}
    <div class="hero-card mb-4">

        <div class="hero-top">

            <div class="hero-left">

                <div class="hero-icon">
                    👤
                </div>

                <div>

                    <div class="hero-title">
                        Pengguna Baru
                    </div>

                    <div class="hero-desc">
                        Lengkapi seluruh informasi pengguna sebelum akun disimpan ke sistem.
                    </div>

                </div>

            </div>

            <div class="hero-image">
                🛡️
            </div>

        </div>


        <form action="{{ route('admin.pengguna.store') }}"
              method="POST">

            @csrf

            <div class="p-5">

                {{-- INFORMASI PENGGUNA --}}

                <div class="section-card mb-4">

                    <div class="section-header">

                        <div>

                            <h3 class="section-title">
                                👤 Informasi Pengguna
                            </h3>

                            <p class="section-subtitle">
                                Masukkan data akun dengan benar.
                            </p>

                        </div>

                    </div>

                    <div class="row g-4">

                        {{-- Nama --}}

                        <div class="col-lg-6">

                            <label class="form-label">

                                Nama Lengkap
                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group input-premium">

                                <span class="input-group-text">
                                    👤
                                </span>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Masukkan nama lengkap"
                                    value="{{ old('name') }}">

                            </div>

                            @error('name')

                                <small class="text-danger">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                        {{-- Email --}}

                        <div class="col-lg-6">

                            <label class="form-label">

                                Email
                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group input-premium">

                                <span class="input-group-text">
                                    ✉️
                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="contoh@email.com"
                                    value="{{ old('email') }}">

                            </div>

                            @error('email')

                                <small class="text-danger">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                        {{-- Password --}}

                        <div class="col-lg-6">

                            <label class="form-label">

                                Password
                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group input-premium">

                                <span class="input-group-text">
                                    🔒
                                </span>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Minimal 6 karakter">

                                <button
                                    type="button"
                                    class="btn btn-light"
                                    onclick="togglePassword('password',this)">

                                    👁

                                </button>

                            </div>

                            @error('password')

                                <small class="text-danger">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                        {{-- Konfirmasi Password --}}

                        <div class="col-lg-6">

                            <label class="form-label">

                                Konfirmasi Password
                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group input-premium">

                                <span class="input-group-text">
                                    🔑
                                </span>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Ulangi password">

                                <button
                                    type="button"
                                    class="btn btn-light"
                                    onclick="togglePassword('password_confirmation',this)">

                                    👁

                                </button>

                            </div>

                        </div>

                        {{-- Role --}}

                        <div class="col-lg-6">

                            <label class="form-label">

                                Role
                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group input-premium">

                                <span class="input-group-text">
                                    🛡️
                                </span>

                                <select
                                    name="role"
                                    class="form-select">

                                    <option value="">
                                        Pilih Role
                                    </option>

                                    <option value="admin">
                                        Admin
                                    </option>

                                    <option value="relawan">
                                        Relawan
                                    </option>

                                    <option value="donatur">
                                        Donatur
                                    </option>

                                    <option value="pembeli">
                                        Pembeli
                                    </option>

                                </select>

                            </div>

                        </div>

                        {{-- Tier --}}

                        <div class="col-lg-6">

                            <label class="form-label">

                                Tier

                            </label>

                            <div class="input-group input-premium">

                                <span class="input-group-text">
                                    👑
                                </span>

                                <select
                                    name="tier_id"
                                    class="form-select">

                                    <option value="">
                                        Belum Memiliki Tier
                                    </option>

                                    @foreach($tiers as $tier)

                                        <option value="{{ $tier->id }}">

                                            {{ $tier->nama }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                </div>
                                {{-- STATUS AKUN --}}
                <div class="section-card">

                    <div class="section-header">

                        <div>

                            <h3 class="section-title">
                                🔐 Status Akun
                            </h3>

                            <p class="section-subtitle">
                                Tentukan apakah akun dapat langsung digunakan.
                            </p>

                        </div>

                    </div>

                    <div class="row g-4">

                        <div class="col-md-6">

                            <label class="status-card active-card">

                                <input
                                    type="radio"
                                    name="is_active"
                                    value="1"
                                    checked>

                                <div class="status-content">

                                    <div class="status-icon">
                                        ✅
                                    </div>

                                    <div>

                                        <h5>Aktif</h5>

                                        <p>
                                            Pengguna dapat login dan menggunakan sistem.
                                        </p>

                                    </div>

                                </div>

                            </label>

                        </div>

                        <div class="col-md-6">

                            <label class="status-card inactive-card">

                                <input
                                    type="radio"
                                    name="is_active"
                                    value="0">

                                <div class="status-content">

                                    <div class="status-icon">
                                        🔒
                                    </div>

                                    <div>

                                        <h5>Nonaktif</h5>

                                        <p>
                                            Pengguna tidak dapat login sampai diaktifkan.
                                        </p>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>

                </div>


                {{-- FOOTER BUTTON --}}

                <div class="d-flex justify-content-end gap-3 mt-5">

                    <button
                        type="reset"
                        class="btn btn-light btn-lg px-4 rounded-4 shadow-sm">

                        🔄 Reset

                    </button>

                    <button
                        type="submit"
                        class="btn-save">

                        💾 Simpan Pengguna

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<style>

.section-card{

    background:#fff;

    border-radius:22px;

    padding:35px;

    border:1px solid #edf2f7;

    box-shadow:
        0 10px 25px rgba(15,23,42,.05);

}

.section-header{

    margin-bottom:30px;

}

.section-title{

    font-size:24px;

    font-weight:700;

    color:#111827;

    margin-bottom:5px;

}

.section-subtitle{

    color:#64748b;

}

.form-label{

    font-weight:700;

    margin-bottom:10px;

}

.input-premium{

    border-radius:14px;

    overflow:hidden;

}

.input-premium .form-control,

.input-premium .form-select{

    border-left:none;

    height:56px;

}

.input-premium .input-group-text{

    background:white;

    border-right:none;

}

.input-premium .form-control:focus,

.input-premium .form-select:focus{

    box-shadow:none;

}

.status-card{

    display:block;

    cursor:pointer;

}

.status-card input{

    display:none;

}

.status-content{

    border-radius:18px;

    padding:25px;

    display:flex;

    align-items:center;

    gap:18px;

    border:2px solid #e5e7eb;

    transition:.3s;

}

.status-card input:checked + .status-content{

    border-color:var(--color-coklat);

    background:#fff8ef;

}

.status-icon{

    width:60px;

    height:60px;

    border-radius:16px;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:26px;

    background:#fff;

    box-shadow:0 5px 18px rgba(0,0,0,.08);

}

.status-content h5{

    margin-bottom:5px;

    font-weight:700;

}

.status-content p{

    margin:0;

    color:#64748b;

}

.btn-save{

    border:none;

    padding:15px 40px;

    border-radius:16px;

    font-weight:700;

    color:white;

    font-size:16px;

    background:

    linear-gradient(

        135deg,

        var(--color-merah),

        var(--color-coklat)

    );

    box-shadow:

        0 12px 25px rgba(181,101,29,.28);

    transition:.3s;

}

.btn-save:hover{

    transform:translateY(-3px);

}

</style>


<script>

function togglePassword(id){

    let input=document.getElementById(id);

    input.type=input.type==="password"

    ? "text"

    : "password";

}

</script>

@endsection