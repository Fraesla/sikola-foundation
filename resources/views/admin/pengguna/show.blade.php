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

/*=====================================
LAYOUT
======================================*/

.profile-page{
    max-width:1450px;
    margin:auto;
}

/*=====================================
HEADER
======================================*/

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:35px;
    gap:20px;
}

.page-label{
    letter-spacing:4px;
    font-size:13px;
    text-transform:uppercase;
    font-weight:700;
    color:var(--secondary);
    margin-bottom:8px;
}

.page-title{
    font-size:42px;
    font-weight:800;
    color:#111827;
    margin-bottom:8px;
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

    background:
    linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );

    box-shadow:
        0 18px 35px rgba(181,101,29,.25);

    transition:.25s;

}

.btn-back:hover{

    color:white;
    transform:translateY(-3px);

}

/*=====================================
PROFILE CARD
======================================*/

.profile-card{

    background:white;

    border-radius:30px;

    overflow:hidden;

    border:1px solid rgba(212,160,23,.15);

    box-shadow:
        0 20px 45px rgba(15,23,42,.08);

    margin-bottom:35px;

}

.profile-header{

    padding:45px;

    background:

    radial-gradient(
        circle at top right,
        rgba(212,160,23,.18),
        transparent 35%
    ),

    linear-gradient(
        135deg,
        #ffffff,
        #fff8ef
    );

}

.profile-wrapper{

    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:30px;

}

.profile-left{

    display:flex;
    align-items:center;
    gap:28px;

}

.avatar{

    width:110px;
    height:110px;

    border-radius:30px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:42px;
    font-weight:800;
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

.profile-name{

    font-size:34px;
    font-weight:800;
    color:#111827;

}

.profile-email{

    margin-top:5px;
    color:#64748b;

}

.badge-role{

    display:inline-block;

    margin-top:18px;

    padding:8px 18px;

    border-radius:30px;

    font-size:13px;
    font-weight:700;

    background:#eef2ff;
    color:#4338ca;

}

.badge-status{

    display:inline-block;

    margin-left:10px;

    padding:8px 18px;

    border-radius:30px;

    font-size:13px;
    font-weight:700;

}

.status-active{

    background:#DCFCE7;
    color:#15803D;

}

.status-inactive{

    background:#FEE2E2;
    color:#DC2626;

}

/*=====================================
INFO CARD
======================================*/

.section-card{

    background:white;

    border-radius:22px;

    border:1px solid #edf2f7;

    padding:30px;

    box-shadow:
        0 10px 30px rgba(15,23,42,.05);

}
.info-list{

    display:flex;
    flex-direction:column;
    gap:8px;

}

.info-item{

    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:15px 0;

    border-bottom:1px dashed #e5e7eb;

}

.info-item:last-child{

    border-bottom:none;

}

.info-label{

    color:#64748b;
    font-size:15px;

}

.info-value{

    font-weight:700;
    color:#111827;

}

.stat-box{

    background:linear-gradient(
        135deg,
        #ffffff,
        #fff8ef
    );

    border:1px solid rgba(212,160,23,.15);

    border-radius:20px;

    padding:20px;

    text-align:center;

    transition:.3s;

}

.stat-box:hover{

    transform:translateY(-5px);

    box-shadow:
        0 15px 30px rgba(181,101,29,.12);

}

.stat-icon{

    font-size:28px;

    margin-bottom:12px;

}

.stat-number{

    font-size:26px;

    font-weight:800;

    color:#111827;

}

.stat-text{

    margin-top:6px;

    color:#64748b;

    font-size:14px;

}
/* ==========================
TIMELINE
========================== */

.timeline{

    position:relative;

    margin-left:18px;

}

.timeline::before{

    content:"";

    position:absolute;

    left:18px;

    top:0;

    bottom:0;

    width:3px;

    background:#ececec;

}

.timeline-item{

    display:flex;

    gap:20px;

    margin-bottom:30px;

    position:relative;

}

.timeline-icon{

    width:38px;

    height:38px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    color:white;

    font-weight:700;

    z-index:2;

}

.timeline-content{

    background:#f8fafc;

    padding:18px 22px;

    border-radius:16px;

    width:100%;

    border:1px solid #edf2f7;

}

/* ==========================
ACTION CARD
========================== */

.action-card{

    background:linear-gradient(
        135deg,
        #ffffff,
        #fff8ef
    );

    border-radius:24px;

    padding:35px;

    text-align:center;

    border:1px solid rgba(212,160,23,.15);

    height:100%;

}

.action-icon{

    width:90px;

    height:90px;

    margin:auto;

    border-radius:24px;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:40px;

    color:white;

    background:linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );

    box-shadow:0 20px 40px rgba(181,101,29,.25);

}

.btn-edit{

    display:block;

    padding:14px;

    border-radius:14px;

    text-decoration:none;

    color:white;

    font-weight:700;

    background:linear-gradient(
        135deg,
        #2563eb,
        #1d4ed8
    );

    transition:.25s;

}

.btn-edit:hover{

    color:white;

    transform:translateY(-3px);

}

.btn-back2{

    display:block;

    padding:14px;

    border-radius:14px;

    text-decoration:none;

    color:white;

    font-weight:700;

    background:linear-gradient(
        135deg,
        var(--primary),
        var(--secondary)
    );

    transition:.25s;

}

.btn-back2:hover{

    color:white;

    transform:translateY(-3px);

}
</style>

<div class="profile-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div>

            <div class="page-label">

                MANAGEMENT CENTER

            </div>

            <div class="page-title">

                Detail Pengguna

            </div>

            <div class="page-subtitle">

                Informasi lengkap akun pengguna beserta statistik aktivitas.

            </div>

        </div>

        <a
            href="{{ route('admin.pengguna.index') }}"
            class="btn-back">

            ← Kembali

        </a>

    </div>


    {{-- HERO PROFILE --}}
    <div class="profile-card">

        <div class="profile-header">

            <div class="profile-wrapper">

                <div class="profile-left">

                    <div class="avatar">

                        {{ strtoupper(substr($user->name,0,1)) }}

                    </div>

                    <div>

                        <div class="profile-name">

                            {{ $user->name }}

                        </div>

                        <div class="profile-email">

                            {{ $user->email }}

                        </div>

                        <div>

                            <span class="badge-role">

                                {{ ucfirst($user->role) }}

                            </span>

                            @if($user->is_active)

                                <span class="badge-status status-active">

                                    Aktif

                                </span>

                            @else

                                <span class="badge-status status-inactive">

                                    Nonaktif

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

                <div style="font-size:90px;opacity:.12;">

                    👤

                </div>

            </div>

        </div>

        <div class="p-4">

            <div class="row g-4">
                {{-- =========================================
                INFORMASI PENGGUNA
                ========================================= --}}
                <div class="col-lg-7">

                    <div class="section-card h-100">

                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <div>

                                <h3 class="fw-bold mb-1">

                                    👤 Informasi Pengguna

                                </h3>

                                <small class="text-muted">

                                    Detail lengkap akun pengguna.

                                </small>

                            </div>

                        </div>

                        <div class="info-list">

                            <div class="info-item">

                                <span class="info-label">

                                    Nama Lengkap

                                </span>

                                <span class="info-value">

                                    {{ $user->name }}

                                </span>

                            </div>

                            <div class="info-item">

                                <span class="info-label">

                                    Email

                                </span>

                                <span class="info-value">

                                    {{ $user->email }}

                                </span>

                            </div>

                            <div class="info-item">

                                <span class="info-label">

                                    Role

                                </span>

                                <span class="badge bg-primary rounded-pill">

                                    {{ ucfirst($user->role) }}

                                </span>

                            </div>

                            <div class="info-item">

                                <span class="info-label">

                                    Status Akun

                                </span>

                                @if($user->is_active)

                                    <span class="badge bg-success rounded-pill">

                                        Aktif

                                    </span>

                                @else

                                    <span class="badge bg-danger rounded-pill">

                                        Nonaktif

                                    </span>

                                @endif

                            </div>

                            <div class="info-item">

                                <span class="info-label">

                                    Tier Membership

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

                                        Belum Memiliki Tier

                                    </span>

                                @endif

                            </div>

                            <div class="info-item">

                                <span class="info-label">

                                    Total Poin

                                </span>

                                <span
                                    class="fw-bold"
                                    style="color:#16a34a;font-size:18px;">

                                    {{ number_format($user->total_poin) }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =========================================
                STATISTIK AKUN
                ========================================= --}}
                <div class="col-lg-5">

                    <div class="section-card h-100">

                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <div>

                                <h3 class="fw-bold mb-1">

                                    📊 Statistik

                                </h3>

                                <small class="text-muted">

                                    Ringkasan aktivitas pengguna.

                                </small>

                            </div>

                        </div>

                        <div class="row g-3">

                            <div class="col-6">

                                <div class="stat-box">

                                    <div class="stat-icon">

                                        ⭐

                                    </div>

                                    <div class="stat-number">

                                        {{ number_format($user->total_poin) }}

                                    </div>

                                    <div class="stat-text">

                                        Total Poin

                                    </div>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="stat-box">

                                    <div class="stat-icon">

                                        🏅

                                    </div>

                                    <div class="stat-number">

                                        {{ $user->tier->nama ?? '-' }}

                                    </div>

                                    <div class="stat-text">

                                        Tier

                                    </div>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="stat-box">

                                    <div class="stat-icon">

                                        🎉

                                    </div>

                                    <div class="stat-number">

                                        {{ $user->eventRegistrasi->count() ?? 0 }}

                                    </div>

                                    <div class="stat-text">

                                        Event

                                    </div>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="stat-box">

                                    <div class="stat-icon">

                                        ❤️

                                    </div>

                                    <div class="stat-number">

                                        {{ $user->donasis->count() ?? 0 }}

                                    </div>

                                    <div class="stat-text">

                                        Donasi

                                    </div>

                                </div>

                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="info-item">

                            <span class="info-label">

                                Bergabung

                            </span>

                            <strong>

                                {{ $user->created_at->format('d M Y') }}

                            </strong>

                        </div>

                        <div class="info-item">

                            <span class="info-label">

                                Terakhir Diubah

                            </span>

                            <strong>

                                {{ $user->updated_at->format('d M Y') }}

                            </strong>

                        </div>

                    </div>

                </div>
                {{-- =========================================
                TIMELINE & ACTION
                ========================================= --}}

                <div class="col-12">

                    <div class="section-card">

                        <div class="row">

                            {{-- Timeline --}}
                            <div class="col-lg-8">

                                <h3 class="fw-bold mb-4">

                                    📜 Riwayat Akun

                                </h3>

                                <div class="timeline">

                                    <div class="timeline-item">

                                        <div class="timeline-icon bg-success">

                                            ✓

                                        </div>

                                        <div class="timeline-content">

                                            <h6 class="fw-bold mb-1">

                                                Akun Dibuat

                                            </h6>

                                            <small class="text-muted">

                                                {{ $user->created_at->format('d F Y H:i') }}

                                            </small>

                                        </div>

                                    </div>

                                    <div class="timeline-item">

                                        <div class="timeline-icon bg-warning">

                                            ✎

                                        </div>

                                        <div class="timeline-content">

                                            <h6 class="fw-bold mb-1">

                                                Terakhir Diupdate

                                            </h6>

                                            <small class="text-muted">

                                                {{ $user->updated_at->format('d F Y H:i') }}

                                            </small>

                                        </div>

                                    </div>

                                    @if($user->eventRegistrasi && $user->eventRegistrasi->count())

                                    <div class="timeline-item">

                                        <div class="timeline-icon bg-primary">

                                            🎉

                                        </div>

                                        <div class="timeline-content">

                                            <h6 class="fw-bold mb-1">

                                                Mengikuti Event

                                            </h6>

                                            <small class="text-muted">

                                                Total {{ $user->eventRegistrasi->count() }} Event

                                            </small>

                                        </div>

                                    </div>

                                    @endif

                                    @if($user->donasi && $user->donasi->count())

                                    <div class="timeline-item">

                                        <div class="timeline-icon bg-danger">

                                            ❤

                                        </div>

                                        <div class="timeline-content">

                                            <h6 class="fw-bold mb-1">

                                                Riwayat Donasi

                                            </h6>

                                            <small class="text-muted">

                                                {{ $user->donasi->count() }} Kali Donasi

                                            </small>

                                        </div>

                                    </div>

                                    @endif

                                </div>

                            </div>

                            {{-- Action --}}
                            <div class="col-lg-4">

                                <div class="action-card">

                                    <div class="action-icon">

                                        👤

                                    </div>

                                    <h4 class="fw-bold mt-3">

                                        Kelola Pengguna

                                    </h4>

                                    <p class="text-muted">

                                        Anda dapat memperbarui informasi akun,
                                        mengubah role, status maupun tier pengguna.

                                    </p>

                                    <div class="d-grid gap-3 mt-4">

                                        <a
                                            href="{{ route('admin.pengguna.edit',$user->id) }}"
                                            class="btn-edit">

                                            ✏ Edit Pengguna

                                        </a>

                                        <a
                                            href="{{ route('admin.pengguna.index') }}"
                                            class="btn-back2">

                                            ← Kembali

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>{{-- row --}}
        </div>{{-- profile-card --}}
</div>{{-- profile-page --}}
@endsection