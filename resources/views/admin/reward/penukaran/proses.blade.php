@extends('layouts.admin', [
    'activePage' => 'reward'
])

@section('title','Proses Reward')

@section('content')

<div class="max-w-3xl mx-auto">

<div class="card-admin p-8">

<h2 class="text-2xl font-bold mb-6">

Proses Reward

</h2>

<form
action="{{ route('admin.redeem.kirim',$redeem) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="space-y-6">
	<div>

	<label class="font-semibold">

	User

	</label>

	<input
	class="w-full border rounded-xl p-3 bg-slate-100"
	value="{{ $redeem->user->name }}"
	readonly>

	</div>
	<div>

	<label class="font-semibold">

	Reward

	</label>

	<input
	class="w-full border rounded-xl p-3 bg-slate-100"
	value="{{ $redeem->reward->nama }}"
	readonly>

	</div>
		@if($redeem->reward->kategori=='Saldo')

			<div>

			<label class="font-semibold">

			Upload Bukti Transfer

			</label>

			<input
			type="file"
			name="bukti_penyerahan"
			class="w-full mt-2 border rounded-xl p-3">

			</div>

		@else
			<div>

			<label class="font-semibold">

			Ekspedisi

			</label>

			<select
			name="ekspedisi"
			class="w-full mt-2 border rounded-xl p-3">

			<option>JNE</option>

			<option>J&T</option>

			<option>SiCepat</option>

			<option>AnterAja</option>

			<option>POS Indonesia</option>

			</select>

			</div>

			<div>

			<label class="font-semibold">

			Nomor Resi

			</label>

			<input
			type="text"
			name="nomor_resi"
			class="w-full mt-2 border rounded-xl p-3">

			</div>

		@endif
		<div>

		<label class="font-semibold">

		Catatan

		</label>

		<textarea
		name="catatan_admin"
		rows="4"
		class="w-full mt-2 border rounded-xl p-3"></textarea>

		</div>
		<div class="flex justify-end gap-3">

		<a
		href="{{ route('admin.redeem.index') }}"
		class="px-5 py-3 rounded-xl bg-gray-200">

		Kembali

		</a>

		<button
		class="px-6 py-3 rounded-xl bg-orange-600 text-white">

		Proses Reward

		</button>

		</div>

		</div>

		</form>

		</div>

	</div>

@endsection