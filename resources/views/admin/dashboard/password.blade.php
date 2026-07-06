@extends('layouts.admin',[
    'activePage'=>'password'
])

@section('content')

<style>

.password-page{

    max-width:900px;
    margin:auto;

}

.password-card{

    background:white;
    border-radius:30px;
    overflow:hidden;
    box-shadow:0 25px 60px rgba(0,0,0,.08);

}

.password-header{

    padding:40px;
    display:flex;
    align-items:center;
    justify-content:space-between;

    background:
    linear-gradient(135deg,#fff,#fff9ef);

    border-bottom:1px solid rgba(0,0,0,.05);

}

.password-icon{

    width:90px;
    height:90px;

    border-radius:25px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:
    linear-gradient(
        135deg,
        var(--color-merah),
        var(--color-coklat)
    );

    color:white;
    font-size:38px;

    box-shadow:0 20px 40px rgba(181,101,29,.3);

}

.input-modern{

    height:58px;
    border-radius:16px;

}

.password-strength{

    height:8px;
    border-radius:999px;
    overflow:hidden;
    background:#e5e7eb;

}

.password-strength span{

    display:block;
    height:100%;
    width:0%;

    transition:.3s;

}

</style>

<div class="password-page">

    <div class="password-card">

        <div class="password-header">

        <div class="d-flex align-items-center gap-4">

        <div class="password-icon">
        🔒
        </div>

        <div>

        <h2 class="fw-bold mb-2">

        Ubah Password

        </h2>

        <p class="text-muted">

        Gunakan password yang kuat agar akun tetap aman.

        </p>

        </div>

        </div>

        </div>

        <form method="POST"
        action="{{ route('admin.password.update') }}">

        @csrf

        <div class="p-5">

        @if(session('success'))

        <div class="alert alert-success">

        {{ session('success') }}

        </div>

        @endif

        <div class="mb-4">

        <label class="fw-semibold">

        Password Lama

        </label>

        <div class="input-group">

        <input
        type="password"
        name="current_password"
        id="current_password"
        class="form-control input-modern">

        <button
        class="btn btn-light"
        type="button"
        onclick="togglePassword('current_password')">

        👁

        </button>

        </div>

        @error('current_password')

        <div class="text-danger small">

        {{ $message }}

        </div>

        @enderror

        </div>

        <div class="mb-4">

        <label class="fw-semibold">

        Password Baru

        </label>

        <div class="input-group">

        <input
        type="password"
        name="password"
        id="password"
        class="form-control input-modern"
        onkeyup="checkStrength(this.value)">

        <button
        class="btn btn-light"
        type="button"
        onclick="togglePassword('password')">

        👁

        </button>

        </div>

        <div class="password-strength mt-3">

        <span id="strengthBar"></span>

        </div>

        <small id="strengthText" class="text-muted">

        Minimal 8 karakter.

        </small>

        </div>

        <div class="mb-5">

        <label class="fw-semibold">

        Konfirmasi Password

        </label>

        <div class="input-group">

        <input
        type="password"
        name="password_confirmation"
        id="password_confirmation"
        class="form-control input-modern">

        <button
        class="btn btn-light"
        type="button"
        onclick="togglePassword('password_confirmation')">

        👁

        </button>

        </div>

        </div>

        <div class="text-end">

        <button
        class="btn btn-lg text-white px-5"

        style="

        background:

        linear-gradient(
        135deg,
        var(--color-merah),
        var(--color-coklat)
        );

        border-radius:16px;

        ">

        💾 Simpan Password

        </button>

        </div>

        </div>

        </form>

    </div>

</div>

<script>

function togglePassword(id){

let input=document.getElementById(id);

input.type=input.type==='password'
?'text'
:'password';

}

function checkStrength(password){

let bar=document.getElementById('strengthBar');
let text=document.getElementById('strengthText');

let score=0;

if(password.length>=8) score++;
if(/[A-Z]/.test(password)) score++;
if(/[0-9]/.test(password)) score++;
if(/[!@#$%^&*]/.test(password)) score++;

let width=score*25;

bar.style.width=width+'%';

if(score<=1){

bar.style.background='#ef4444';
text.innerHTML='Password lemah';

}

else if(score==2){

bar.style.background='#f59e0b';
text.innerHTML='Password cukup';

}

else if(score==3){

bar.style.background='#3b82f6';
text.innerHTML='Password baik';

}

else{

bar.style.background='#22c55e';
text.innerHTML='Password sangat kuat';

}

}

</script>

@endsection