@extends('layouts.admin',['activePage'=>'event'])

@section('content')

<style>

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:30px;
    margin-bottom:35px;
    padding:0 5px;
    flex-wrap:wrap;
}

.page-header-left{
    flex:1;
}

.page-tag{
    display:inline-block;
    font-size:13px;
    font-weight:700;
    letter-spacing:4px;
    color:var(--color-coklat);
    text-transform:uppercase;
    margin-bottom:8px;
}

.page-title{
    font-size:38px;
    font-weight:800;
    color:#0f172a;
    line-height:1.2;
    margin-bottom:8px;
}

.page-subtitle{
    color:#64748b;
    font-size:15px;
    max-width:650px;
    line-height:1.7;
    margin:0;
}

.btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;

    height:50px;
    padding:0 28px;

    border-radius:14px;

    color:#fff !important;
    text-decoration:none !important;
    font-weight:700;

    background:linear-gradient(
        135deg,
        var(--color-merah),
        var(--color-coklat)
    );

    box-shadow:0 12px 25px rgba(181,101,29,.25);
    transition:.25s;
}

.btn-back:hover{
    transform:translateY(-3px);
    color:#fff !important;
}

@media(max-width:768px){

.page-header{
    flex-direction:column;
    align-items:flex-start;
}

.btn-back{
    width:100%;
}

.page-title{
    font-size:30px;
}

}

.detail-card{
    background:#fff;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 20px 40px rgba(0,0,0,.08);
}

.detail-header{

    padding:40px;

    background:
        linear-gradient(
            135deg,
            rgba(220,38,38,.03),
            rgba(181,101,29,.08)
        );

    border-bottom:1px solid #ececec;

}

.avatar{

    width:90px;
    height:90px;

    border-radius:22px;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:34px;
    font-weight:800;

    color:#fff;

    background:
        linear-gradient(
            135deg,
            var(--color-merah),
            var(--color-coklat)
        );

    box-shadow:
        0 15px 30px rgba(181,101,29,.25);

}

.section-card{
    background:#fff;
    border-radius:18px;
    border:1px solid #eef2f7;
    box-shadow:0 10px 25px rgba(0,0,0,.04);
    padding:28px;
    height:100%;
}

.section-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:25px;
    color:#0f172a;
}

.info-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 0;
    border-bottom:1px dashed #e5e7eb;
}

.info-item:last-child{
    border:none;
}

.info-label{
    color:#64748b;
    font-size:14px;
}

.info-value{
    color:#0f172a;
    font-weight:700;
    text-align:right;
}

.status-badge{
    padding:8px 20px;
    border-radius:40px;
    font-weight:700;
    font-size:13px;
}

.status-daftar{
    background:#FEF3C7;
    color:#B45309;
}

.status-konfirmasi{
    background:#DBEAFE;
    color:#2563EB;
}

.status-hadir{
    background:#DCFCE7;
    color:#15803D;
}

.status-tidak{
    background:#FEE2E2;
    color:#DC2626;
}

.note-box{
    background:#fff7ed;
    border-left:5px solid var(--color-coklat);
    border-radius:14px;
    padding:20px;
    min-height:120px;
}

.timeline{
    background:#f8fafc;
    border-radius:18px;
    padding:25px;
    margin-top:30px;
}

.timeline-item{
    display:flex;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px solid #e5e7eb;
}

.timeline-item:last-child{
    border:none;
}

.profile-name{

    font-size:30px;
    font-weight:800;
    color:#0f172a;
    margin-bottom:4px;

}

.profile-email{

    color:#64748b;
    font-size:15px;

}

</style>

<div class="page-header">

    <div class="page-header-left">

        <div class="page-tag">
            EVENT CENTER
        </div>

        <h1 class="page-title">
            Detail Registrasi Event
        </h1>

        <p class="page-subtitle">
            Informasi lengkap mengenai peserta, data event, status registrasi,
            reward, dan histori aktivitas peserta.
        </p>

    </div>

    <a href="{{ url()->previous() }}"
       class="btn-back">

        <i class="fas fa-arrow-left"></i>
        Kembali

    </a>

</div>


<div class="detail-card">

    <div class="detail-header">

        <div class="d-flex align-items-center">

            <div class="avatar">

                {{ strtoupper(substr($registrasi->user->name,0,1)) }}

            </div>

            <div class="ms-4">

                 <div class="profile-name">
                    {{ $registrasi->user->name }}
                </div>

                <div class="profile-email">
                    {{ $registrasi->user->email }}
                </div>


                <div class="mt-3">

                    @if($registrasi->status=='mendaftar')

                        <span class="status-badge status-daftar">

                            Menunggu Konfirmasi

                        </span>

                    @elseif($registrasi->status=='dikonfirmasi')

                        <span class="status-badge status-konfirmasi">

                            Sudah Dikonfirmasi

                        </span>

                    @elseif($registrasi->status=='hadir')

                        <span class="status-badge status-hadir">

                            Hadir

                        </span>

                    @elseif($registrasi->status=='tolak')

                        <span class="status-badge status-tidak">

                            Tolak

                        </span>

                    @else

                        <span class="status-badge status-tidak">

                            Tidak Hadir

                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <div class="p-4">

    <div class="row g-4">

        {{-- DATA PESERTA --}}
        <div class="col-lg-6">

            <div class="section-card">

                <div class="section-title">
                    👤 Data Peserta
                </div>

                <div class="info-item">
                    <span class="info-label">Nama</span>
                    <span class="info-value">{{ $registrasi->user->name }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $registrasi->user->email }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">User ID</span>
                    <span class="info-value">#{{ $registrasi->user->id }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Status</span>

                    <span>

                        @if($registrasi->status=='mendaftar')
                            <span class="status-badge status-daftar">Menunggu</span>

                        @elseif($registrasi->status=='dikonfirmasi')
                            <span class="status-badge status-konfirmasi">Dikonfirmasi</span>

                        @elseif($registrasi->status=='tolak')
                            <span class="status-badge status-tidak">Tolak</span>

                        @elseif($registrasi->status=='hadir')
                            <span class="status-badge status-hadir">Hadir</span>

                        @else
                            <span class="status-badge status-tidak">Tidak Hadir</span>
                        @endif

                    </span>

                </div>

            </div>

        </div>

        {{-- DATA EVENT --}}
        <div class="col-lg-6">

            <div class="section-card">

                <div class="section-title">
                    🎉 Informasi Event
                </div>

                <div class="info-item">
                    <span class="info-label">Judul Event</span>
                    <span class="info-value">{{ $registrasi->event->judul }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Lokasi</span>
                    <span class="info-value">{{ $registrasi->event->lokasi }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Tanggal</span>

                    <span class="info-value">

                        {{ $registrasi->event->tanggal_mulai->format('d M Y') }}

                        -

                        {{ $registrasi->event->tanggal_selesai->format('d M Y') }}

                    </span>

                </div>

                <div class="info-item">
                    <span class="info-label">Kuota</span>
                    <span class="info-value">{{ $registrasi->event->kuota }}</span>
                </div>

            </div>

        </div>

        {{-- REWARD --}}
        <div class="col-lg-6">

            <div class="section-card">

                <div class="section-title">
                    🎁 Reward
                </div>

                <div class="info-item">
                    <span class="info-label">Poin Diberikan</span>
                    <span class="info-value">{{ $registrasi->poin_diberikan }} Poin</span>
                </div>

            </div>

        </div>

        {{-- CATATAN --}}
        <div class="col-lg-6">

            <div class="section-card">

                <div class="section-title">
                    📝 Catatan
                </div>

                <div class="note-box">

                    {{ $registrasi->catatan ?: 'Belum ada catatan.' }}

                </div>

            </div>

        </div>

    </div>

    {{-- Timeline --}}

    <div class="timeline">

        <h5 class="fw-bold mb-3">
            📅 Riwayat Registrasi
        </h5>

        <div class="timeline-item">
            <span>Dibuat</span>
            <strong>{{ $registrasi->created_at->format('d M Y H:i') }}</strong>
        </div>

        <div class="timeline-item">
            <span>Terakhir Update</span>
            <strong>{{ $registrasi->updated_at->format('d M Y H:i') }}</strong>
        </div>

    </div>

</div>

</div>

@endsection
