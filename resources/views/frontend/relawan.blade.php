@extends('layouts.app')

@section('content')

<section class="py-20">
    
<div class="container mx-auto px-6">

<div class="grid lg:grid-cols-2 gap-12">

<div>

<h1 class="text-5xl font-bold">
Program Relawan
</h1>

<p class="mt-6 text-slate-600 leading-8">

Bergabung bersama kami dalam kegiatan sosial,
pendidikan, donasi dan kemanusiaan.

</p>

<ul class="mt-6 space-y-3">

<li>✅ Event Sosial</li>
<li>✅ Program Pendidikan</li>
<li>✅ Donasi</li>
<li>✅ Pengabdian Masyarakat</li>

</ul>

</div>

<div class="bg-white shadow rounded-3xl p-8">

<h2 class="text-2xl font-bold mb-6">
Pendaftaran Relawan
</h2>

<form>

<input type="text"
placeholder="Nama Lengkap"
class="w-full border rounded-xl p-3 mb-4">

<input type="email"
placeholder="Email"
class="w-full border rounded-xl p-3 mb-4">

<input type="text"
placeholder="No HP"
class="w-full border rounded-xl p-3 mb-4">

<textarea
rows="4"
placeholder="Motivasi Bergabung"
class="w-full border rounded-xl p-3 mb-4"></textarea>

<button
class="w-full bg-blue-600 text-white py-3 rounded-xl">

Daftar Sekarang

</button>

</form>

</div>

</div>

</div>

</section>

@endsection