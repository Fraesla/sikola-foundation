<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<style>

body{

font-family:DejaVu Sans;

}

table{

width:100%;

border-collapse:collapse;

}

th,td{

border:1px solid #ddd;

padding:8px;

}

th{

background:#CC2222;

color:white;

}

</style>

</head>

<body>

<h2>Laporan Donasi</h2>

<table>

<thead>

<tr>

<th>Nama</th>

<th>Nominal</th>

<th>Status</th>

<th>Tanggal</th>

</tr>

</thead>

<tbody>

@foreach($donasi as $item)

<tr>

<td>{{ $item->user?->name ?? '-' }}</td>
<td>Rp {{ number_format($item->jumlah) }}</td>

<td>{{ $item->status }}</td>

<td>{{ $item->created_at->format('d-m-Y') }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>