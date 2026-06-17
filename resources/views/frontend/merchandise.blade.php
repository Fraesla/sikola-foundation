@extends('layouts.app')

@section('content')

<section class="py-20">
	<div class="container mx-auto px-6">

		<h1 class="text-5xl font-bold text-center mb-10">Merchandise</h1>

		<div class="flex justify-center gap-3 mb-10">
			<button class="px-5 py-2 bg-blue-600 text-white rounded-full">Semua</button>
			<button class="px-5 py-2 bg-slate-100 rounded-full">Kaos</button>
			<button class="px-5 py-2 bg-slate-100 rounded-full">Topi</button>
			<button class="px-5 py-2 bg-slate-100 rounded-full">Tumbler</button>
		</div>

		<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
			@for($i=1;$i<=8;$i++)
			<div class="bg-white rounded-3xl shadow overflow-hidden">

				<img src="https://picsum.photos/400/300?random={{$i}}">
				<div class="p-5">
					<h3 class="font-bold text-xl">Kaos Sikola Foundation</h3>
					<p class="text-blue-600 font-bold mt-2">Rp 150.000</p>
					<button class="w-full mt-4 bg-blue-600 text-white py-2 rounded-xl">Tambah ke Cart</button>
				</div>
			</div>
			@endfor
		</div>
	</div>
</section>
@endsection