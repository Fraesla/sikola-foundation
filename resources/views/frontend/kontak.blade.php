@extends('layouts.app')

@section('content')

<section class="py-20">

<div class="container mx-auto px-6">

<h1 class="text-5xl font-bold text-center mb-16">
Kontak Kami
</h1>

<div class="grid lg:grid-cols-2 gap-10">

<div>

<div class="space-y-6">

<div>
<h3 class="font-bold">Alamat</h3>
<p>Jl. Sikola Foundation No. 1</p>
</div>

<div>
<h3 class="font-bold">Telepon</h3>
<p>+62 812-3456-7890</p>
</div>

<div>
<h3 class="font-bold">Email</h3>
<p>info@sikolafoundation.org</p>
</div>

</div>

</div>

<div>

<iframe
src="https://www.google.com/maps?q=Padang&output=embed"
class="w-full h-[400px] rounded-3xl"
loading="lazy">
</iframe>

</div>

</div>

</div>

</section>

@endsection