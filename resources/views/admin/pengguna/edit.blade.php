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

.edit-page{
    max-width:1450px;
    margin:auto;
}

/*==========================
HEADER
==========================*/

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:35px;
    gap:20px;
}

.page-label{
    letter-spacing:4px;
    font-size:12px;
    font-weight:700;
    text-transform:uppercase;
    color:var(--secondary);
    margin-bottom:8px;
}

.page-title{
    font-size:42px;
    font-weight:800;
    color:#111827;
    margin-bottom:10px;
}

.page-subtitle{
    color:#64748b;
    font-size:16px;
}

.btn-back{

    display:inline-flex;
    align-items:center;
    gap:10px;

    padding:14px 28px;

    border-radius:18px;

    color:#fff;
    text-decoration:none;
    font-weight:700;

    background:linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );

    box-shadow:
        0 20px 35px rgba(181,101,29,.28);

    transition:.3s;

}

.btn-back:hover{

    transform:translateY(-3px);

    color:white;

}

/*==========================
HERO CARD
==========================*/

.hero-card{

    background:#fff;

    border-radius:30px;

    overflow:hidden;

    border:1px solid rgba(212,160,23,.15);

    box-shadow:
        0 20px 45px rgba(15,23,42,.08);

    margin-bottom:35px;

}

.hero-top{

    padding:45px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    background:

    radial-gradient(
        circle at top right,
        rgba(212,160,23,.18),
        transparent 38%
    ),

    linear-gradient(
        135deg,
        #ffffff,
        #fff8ef
    );

}

.hero-left{

    display:flex;

    align-items:center;

    gap:24px;

}

.hero-icon{

    width:95px;

    height:95px;

    border-radius:26px;

    display:flex;

    align-items:center;

    justify-content:center;

    background:
    linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );

    color:white;

    font-size:40px;

    box-shadow:
        0 18px 35px rgba(181,101,29,.25);

}

.hero-title{

    font-size:34px;

    font-weight:800;

    color:#111827;

}

.hero-desc{

    margin-top:8px;

    color:#64748b;

}

.hero-illustration{

    font-size:95px;

    opacity:.15;

}

/*==========================
CONTENT
==========================*/

.content-wrapper{

    padding:35px;

}

.section-card{

    background:white;

    border-radius:22px;

    border:1px solid #eef2f7;

    box-shadow:
        0 10px 30px rgba(15,23,42,.05);

    padding:30px;

}

.section-title{

    font-size:24px;

    font-weight:700;

    color:#111827;

}

.section-subtitle{

    color:#64748b;

    margin-top:6px;

    margin-bottom:30px;

}

.profile-avatar{
    width:110px;
    height:110px;
    border-radius:28px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:42px;
    font-weight:800;
    color:#fff;
    background:linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );
    box-shadow:0 20px 40px rgba(181,101,29,.25);
}

.summary-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 0;
    border-bottom:1px dashed #e5e7eb;
}

.summary-item:last-child{
    border-bottom:none;
}

.summary-label{
    color:#64748b;
    font-size:14px;
}

.status-card{
    display:block;
    cursor:pointer;
}

.status-card input{
    display:none;
}

.status-content{
    display:flex;
    align-items:center;
    gap:16px;
    border:2px solid #ececec;
    border-radius:18px;
    padding:18px;
    transition:.25s;
}

.status-card input:checked + .status-content{
    border-color:var(--color-coklat);
    background:#fff8ef;
}

.status-icon{
    width:55px;
    height:55px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    background:#fff;
    box-shadow:0 8px 18px rgba(0,0,0,.08);
}
</style>

<div class="edit-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div>

            <div class="page-label">
                MANAGEMENT CENTER
            </div>

            <div class="page-title">
                Edit Pengguna
            </div>

            <div class="page-subtitle">
                Perbarui informasi akun pengguna yang telah terdaftar.
            </div>

        </div>

        <a href="{{ route('admin.pengguna.index') }}"
           class="btn-back">

            ← Kembali

        </a>

    </div>

    {{-- HERO --}}
    <div class="hero-card">

        <div class="hero-top">

            <div class="hero-left">

                <div class="hero-icon">

                    👤

                </div>

                <div>

                    <div class="hero-title">

                        {{ $user->name }}

                    </div>

                    <div class="hero-desc">

                        Edit informasi akun, role, tier, password dan status pengguna.

                    </div>

                </div>

            </div>

            <div class="hero-illustration">

                🛡️

            </div>

        </div>

        <form
            action="{{ route('admin.pengguna.update',$user->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="content-wrapper">

                <div class="row g-4">

                    {{-- FORM KIRI --}}
                    <div class="col-lg-8">

                        <div class="section-card">

                            <div class="section-title">

                                👤 Informasi Pengguna

                            </div>

                            <div class="section-subtitle">

                                Perbarui informasi akun pengguna.

                            </div>

                            <div class="row g-4">
                                {{-- =========================
                                NAMA
                                ========================= --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">

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
                                            value="{{ old('name',$user->name) }}"
                                            placeholder="Masukkan nama lengkap">

                                    </div>

                                    @error('name')

                                        <small class="text-danger">

                                            {{ $message }}

                                        </small>

                                    @enderror

                                </div>


                                {{-- =========================
                                EMAIL
                                ========================= --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">

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
                                            value="{{ old('email',$user->email) }}"
                                            placeholder="contoh@email.com">

                                    </div>

                                    @error('email')

                                        <small class="text-danger">

                                            {{ $message }}

                                        </small>

                                    @enderror

                                </div>


                                {{-- =========================
                                PASSWORD BARU
                                ========================= --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">

                                        Password Baru

                                    </label>

                                    <div class="input-group input-premium">

                                        <span class="input-group-text">

                                            🔒

                                        </span>

                                        <input
                                            id="password"
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            placeholder="Kosongkan jika tidak diganti">

                                        <button
                                            type="button"
                                            class="btn btn-light"
                                            onclick="togglePassword('password')">

                                            👁

                                        </button>

                                    </div>

                                    <small class="text-muted">

                                        Kosongkan apabila password tidak ingin diubah.

                                    </small>

                                    @error('password')

                                        <small class="text-danger d-block">

                                            {{ $message }}

                                        </small>

                                    @enderror

                                </div>


                                {{-- =========================
                                KONFIRMASI PASSWORD
                                ========================= --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">

                                        Konfirmasi Password

                                    </label>

                                    <div class="input-group input-premium">

                                        <span class="input-group-text">

                                            🔑

                                        </span>

                                        <input
                                            id="password_confirmation"
                                            type="password"
                                            name="password_confirmation"
                                            class="form-control"
                                            placeholder="Ulangi password baru">

                                        <button
                                            type="button"
                                            class="btn btn-light"
                                            onclick="togglePassword('password_confirmation')">

                                            👁

                                        </button>

                                    </div>

                                </div>


                                {{-- =========================
                                ROLE
                                ========================= --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">

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

                                            <option value="">Pilih Role</option>

                                            <!-- <option
                                                value="admin"
                                                {{ old('role',$user->role)=='admin'?'selected':'' }}>

                                                Admin

                                            </option> -->

                                            <option
                                                value="relawan"
                                                {{ old('role',$user->role)=='relawan'?'selected':'' }}>

                                                Relawan

                                            </option>

                                            <option
                                                value="donatur"
                                                {{ old('role',$user->role)=='donatur'?'selected':'' }}>

                                                Donatur

                                            </option>

                                            <option
                                                value="pembeli"
                                                {{ old('role',$user->role)=='pembeli'?'selected':'' }}>

                                                Pembeli

                                            </option>

                                        </select>

                                    </div>

                                </div>


                                {{-- =========================
                                TIER
                                ========================= --}}

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">

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

                                                <option
                                                    value="{{ $tier->id }}"
                                                    {{ old('tier_id',$user->tier_id)==$tier->id?'selected':'' }}>

                                                    {{ $tier->nama }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                            </div> {{-- row --}}
                        </div> {{-- section-card --}}
                    </div> {{-- col-lg-8 --}}
                    {{-- ==========================================
                    SIDEBAR INFORMASI AKUN
                    ========================================== --}}
                    <div class="col-lg-4">

                        {{-- Ringkasan Akun --}}
                        <div class="section-card mb-4">

                            <div class="text-center">

                                <div class="profile-avatar mx-auto mb-3"
                                     id="avatarPreview">

                                    {{ strtoupper(substr($user->name,0,1)) }}

                                </div>

                                <h4 class="fw-bold mb-1" id="previewName">

                                    {{ $user->name }}

                                </h4>

                                <div class="text-muted">

                                    {{ ucfirst($user->role) }}

                                </div>

                            </div>

                            <hr>

                            <div class="summary-item">

                                <span class="summary-label">
                                    ID Pengguna
                                </span>

                                <strong>
                                    #{{ $user->id }}
                                </strong>

                            </div>

                            <div class="summary-item">

                                <span class="summary-label">
                                    Total Poin
                                </span>

                                <strong class="text-success">

                                    {{ number_format($user->total_poin) }}

                                </strong>

                            </div>

                            <div class="summary-item">

                                <span class="summary-label">
                                    Role
                                </span>

                                <span class="badge bg-primary">

                                    {{ ucfirst($user->role) }}

                                </span>

                            </div>

                            <div class="summary-item">

                                <span class="summary-label">
                                    Tier
                                </span>

                                @if($user->tier)

                                    <span
                                        class="badge rounded-pill"
                                        style="
                                            background:rgba(212,160,23,.15);
                                            color:var(--color-kuning);
                                        ">

                                        {{ $user->tier->nama }}

                                    </span>

                                @else

                                    <span class="text-muted">

                                        Belum Ada

                                    </span>

                                @endif

                            </div>

                            <div class="summary-item">

                                <span class="summary-label">

                                    Bergabung

                                </span>

                                <strong>

                                    {{ $user->created_at->format('d M Y') }}

                                </strong>

                            </div>

                            <div class="summary-item">

                                <span class="summary-label">

                                    Terakhir Update

                                </span>

                                <strong>

                                    {{ $user->updated_at->format('d M Y') }}

                                </strong>

                            </div>

                        </div>

                        {{-- STATUS AKUN --}}
                        <div class="section-card">

                            <h5 class="fw-bold mb-4">

                                🔐 Status Akun

                            </h5>

                            <label class="status-card mb-3">

                                <input
                                    type="radio"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active',$user->is_active)==1 ? 'checked' : '' }}>

                                <div class="status-content">

                                    <div class="status-icon">

                                        ✅

                                    </div>

                                    <div>

                                        <h6 class="mb-1 fw-bold">

                                            Aktif

                                        </h6>

                                        <small class="text-muted">

                                            Pengguna dapat login ke sistem.

                                        </small>

                                    </div>

                                </div>

                            </label>

                            <label class="status-card">

                                <input
                                    type="radio"
                                    name="is_active"
                                    value="0"
                                    {{ old('is_active',$user->is_active)==0 ? 'checked' : '' }}>

                                <div class="status-content">

                                    <div class="status-icon">

                                        🔒

                                    </div>

                                    <div>

                                        <h6 class="mb-1 fw-bold">

                                            Nonaktif

                                        </h6>

                                        <small class="text-muted">

                                            Pengguna tidak dapat login.

                                        </small>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>{{-- col-lg-4 --}}

                </div>{{-- row --}}
                {{-- ==========================================
                FOOTER ACTION
                ========================================== --}}
                <div class="col-12">
                    <div class="section-card">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>

                                <h5 class="fw-bold mb-1">

                                    💾 Simpan Perubahan

                                </h5>

                                <p class="text-muted mb-0">

                                    Pastikan seluruh data sudah benar sebelum memperbarui pengguna.

                                </p>

                            </div>

                            <div class="d-flex gap-3">

                                <a
                                    href="{{ route('admin.pengguna.index') }}"
                                    class="btn btn-light btn-lg rounded-4 px-4">

                                    ← Kembali

                                </a>

                                <button
                                    type="reset"
                                    class="btn btn-warning btn-lg rounded-4 px-4">

                                    🔄 Reset

                                </button>

                                <button
                                    type="submit"
                                    class="btn-save">

                                    💾 Update Pengguna

                                </button>

                            </div>

                        </div>

                    </div>
                </div>
            </div>{{-- row --}}
        </form>
    </div>{{-- hero-card --}}
</div>{{-- create-page --}}


{{-- ==========================================
JAVASCRIPT
========================================== --}}

<script>

function togglePassword(id){

    const input = document.getElementById(id);

    if(input.type === "password"){

        input.type = "text";

    }else{

        input.type = "password";

    }

}


/* Preview Nama */

document.addEventListener("DOMContentLoaded",function(){

    const nameInput=document.querySelector("input[name='name']");

    const preview=document.getElementById("previewName");

    const avatar=document.getElementById("avatarPreview");

    if(nameInput){

        nameInput.addEventListener("keyup",function(){

            preview.innerHTML=this.value || "Pengguna";

            avatar.innerHTML=(this.value.charAt(0) || "P").toUpperCase();

        });

    }

});


/* Konfirmasi sebelum update */

document.querySelector("form").addEventListener("submit",function(e){

    if(!confirm("Apakah Anda yakin ingin memperbarui data pengguna ini?")){

        e.preventDefault();

    }

});

</script>

@endsection