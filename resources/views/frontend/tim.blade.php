@extends('layouts.app')

@section('content')

<section class="py-20">
	<div class="container mx-auto px-6">
		<div class="text-center mb-16">
			<h1 class="text-5xl font-bold">Tim Kami</h1>
			<p class="mt-4 text-slate-500">Pengurus dan Team Member Sikola Foundation</p>
		</div>

		<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
			@for($i=1;$i<=8;$i++)
				<div class="bg-white rounded-3xl shadow p-6 text-center">
					<img src="https://i.pravatar.cc/300?img={{$i}}" class="w-32 h-32 rounded-full mx-auto">
					<h3 class="font-bold text-xl mt-5">Team Member {{$i}}</h3>
					<p class="text-slate-500">Koordinator Program</p>
					<div class="flex justify-center gap-4 mt-5">
						<a href="#">🌐</a>
						<a href="#">📘</a>
						<a href="#">📷</a>
						<a href="#">💼</a>
					</div>
				</div>
			@endfor
		</div>
	</div>
</section>

@endsection