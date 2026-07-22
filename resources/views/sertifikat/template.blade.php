<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Sertifikat Event</title>

<style>

@page{

    size:A4 landscape;

    margin:5mm;

}

*{

    margin:0;

    padding:0;

    box-sizing:border-box;

}

body{

    font-family: DejaVu Sans, sans-serif;

    color:#222;

    font-size:13px;

}


/*==================================================
=            CERTIFICATE BORDER
==================================================*/

.certificate{

    width:100%;

    border:4px solid #C89D22;

    padding:7px;

}

.certificate-inner{

    border:1.5px solid #D9BA5A;

    padding:20px;

}


/*==================================================
=            TABLE
==================================================*/

.main-table{

    width:100%;

    border-collapse:collapse;

}

.main-table td{

    vertical-align:top;

}


/*==================================================
=            HEADER
==================================================*/

.logo{

    width:90px;

    height:auto;

}

.foundation{

    margin-top:8px;

    font-size:10px;

    letter-spacing:4px;

    color:#7a7a7a;

}

.title{

    margin-top:15px;

    font-size:31px;

    font-weight:bold;

    letter-spacing:7px;

    color:#C89D22;

}

.subtitle{

    margin-top:4px;

    font-size:11px;

    color:#8b8b8b;

}


/*==================================================
=            CONTENT
==================================================*/

.present{

    margin-top:30px;

    font-size:16px;

    color:#666;

}

.participant{

    margin-top:18px;

    font-size:34px;

    font-weight:bold;

    text-transform:uppercase;

    color:#111827;

}

.line{

    width:220px;

    margin:14px auto;

    border-top:2px solid #C89D22;

}

.complete{

    font-size:15px;

    color:#666;

}

.event{

    margin-top:14px;

    font-size:28px;

    font-weight:bold;

}

.description{

    margin-top:30px;

    line-height:23px;

    font-size:13px;

    color:#555;

}


/*==================================================
=            INFO
==================================================*/

.info{

    margin-top:35px;

    width:100%;

    border-collapse:collapse;

}

.info td{

    width:33%;

    text-align:center;

}

.info-label{

    font-size:10px;

    color:#777;

    letter-spacing:1px;

}

.info-value{

    margin-top:8px;

    font-size:16px;

    font-weight:bold;

}


/*==================================================
=            FOOTER
==================================================*/

.footer{

    margin-top:40px;

    width:100%;

    border-collapse:collapse;

}

.footer td{

    vertical-align:bottom;

}

.small{

    font-size:10px;

    color:#777;

}

.bold{

    margin-top:5px;

    font-size:13px;

    font-weight:bold;

}

.signature{

    text-align:center;

}

.signature img{

    width:140px;

    height:auto;

}

.signature hr{

    width:190px;

    margin:6px auto;

    border:none;

    border-top:1px solid #333;

}

.note{

    margin-top:20px;

    text-align:center;

    font-size:10px;

    color:#888;

}

</style>

</head>

<body>

<div class="certificate">

<div class="certificate-inner">

<table class="main-table">

<tr>

<td align="center">

{{-- =======================================
LOGO
======================================= --}}

<img src="{{ public_path('images/logo3.jpg') }}"
width="90" class="logo">

<div class="foundation">

SIKOLA FOUNDATION

</div>

<div class="title">

CERTIFICATE

</div>

<div class="subtitle">

Certificate of Completion

</div>

<div class="present">

This certificate is proudly presented to

</div>

<div class="participant">

{{ strtoupper($peserta->user->name) }}

</div>

<div class="line"></div>

<div class="complete">

For successfully completing the event

</div>

<div class="event">

{{ strtoupper($event->judul) }}

</div>

<div class="description">
    This certificate is proudly awarded to

<strong>{{ strtoupper($peserta->user->name) }}</strong>

for successfully participating in the event

<strong>{{ strtoupper($event->judul) }}</strong>

organized by

<strong>Sikola Foundation</strong>.

The participant has fulfilled all attendance requirements
and achieved an attendance percentage of

<strong style="color:#C89D22;">

{{ number_format($peserta->persentase_kehadiran,2) }}%

</strong>

during the event period from

<strong>

{{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y') }}

</strong>

until

<strong>

{{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d F Y') }}

</strong>.

This certificate is officially issued as proof of participation
and appreciation for the contribution and commitment shown
throughout the entire event.

</div>

{{-- ==========================================================
INFO EVENT
========================================================== --}}

<table class="info">

<tr>

<td>

<div class="info-label">

EVENT

</div>

<div class="info-value">

{{ strtoupper($event->judul) }}

</div>

</td>

<td>

<div class="info-label">

ATTENDANCE

</div>

<div
class="info-value"
style="color:#C89D22;">

{{ number_format($peserta->persentase_kehadiran,2) }}%

</div>

</td>

<td>

<div class="info-label">

EVENT PERIOD

</div>

<div class="info-value"
style="
font-size:13px;
">

{{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d M Y') }}

-

{{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d M Y') }}

</div>

</td>

</tr>

</table>

{{-- ==========================================================
GARIS PEMBATAS
========================================================== --}}

<div style="
margin-top:30px;
margin-bottom:25px;
border-top:1px solid #D8D8D8;
"></div>

{{-- ==========================================================
FOOTER DIMULAI DI PART 3
========================================================== --}}
{{-- ==========================================================
FOOTER
========================================================== --}}

<table class="footer">

<tr>

<td width="35%">

<div class="small">

Certificate Number

</div>

<div class="bold">

{{ $peserta->nomor_sertifikat }}

</div>

<div style="height:18px;"></div>

<div class="small">

Issue Date

</div>

<div class="bold">

{{ \Carbon\Carbon::parse($peserta->sertifikat_diterbitkan)->translatedFormat('d F Y') }}

</div>

</td>

<td width="30%" align="center">

@if(!empty($peserta->kode_verifikasi))

<div class="small">

Verification Code

</div>

<div
style="
margin-top:8px;
font-size:18px;
font-weight:bold;
letter-spacing:2px;
color:#C89D22;
">

{{ strtoupper($peserta->kode_verifikasi) }}

</div>

@endif

</td>

<td width="35%" align="center">

<div class="signature">

<img src="{{ public_path('images/ttd3.jpg') }}"
width="90" class="TTD">

<hr>

<div
style="
font-size:14px;
font-weight:bold;
">

Direktur Sikola Foundation

</div>

<div
style="
font-size:11px;
color:#666;
margin-top:2px;
">

Sikola Foundation

</div>

</div>

</td>

</tr>

</table>

<div class="note">

This certificate has been generated automatically by

<strong>

Sikola Foundation Event Management System

</strong>

</div>

</td>

</tr>

</table>

</div>

</div>

</body>

</html>
