@extends('layouts.admin', ['activePage' => 'donasi'])

@section('content')

@php

$langganan = $donasi->langganan;

@endphp

<div class="space-y-8">

    {{-- ====================================== --}}
    {{-- HEADER --}}
    {{-- ====================================== --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-4xl font-bold">

                🔄 Langganan Donasi

            </h1>

            <p class="text-slate-500 mt-2">

                Kelola pembayaran donasi bulanan.

            </p>

        </div>

        <a href="{{ route('admin.donasis.index') }}"
           class="px-6 py-3 rounded-2xl border hover:bg-slate-50">

            ← Kembali

        </a>

    </div>



    {{-- ====================================== --}}
    {{-- INFO LANGGANAN --}}
    {{-- ====================================== --}}
    <div
        class="bg-white
               rounded-3xl
               shadow-sm
               border
               overflow-hidden">

        <div
            class="px-8 py-7
                   border-b
                   flex
                   justify-between
                   items-center">

            <div>

                <div class="text-3xl font-bold">

                    {{ $donasi->user->name }}

                </div>

                <div class="text-slate-500 mt-2">

                    {{ $donasi->kategori->nama }}

                </div>

            </div>

            <div>

                @if($langganan->is_aktif)

                    <span
                        class="px-5 py-3
                               rounded-full
                               bg-green-100
                               text-green-700
                               font-bold">

                        ✔ Langganan Aktif

                    </span>

                @else

                    <span
                        class="px-5 py-3
                               rounded-full
                               bg-red-100
                               text-red-700
                               font-bold">

                        ✖ Tidak Aktif

                    </span>

                @endif

            </div>

        </div>



        <div
            class="grid
                   lg:grid-cols-4
                   gap-8
                   p-8">

            {{-- TARGET --}}
            <div>

                <div class="text-sm text-slate-500">

                    Target Bulan

                </div>

                <div
                    class="text-3xl
                           font-bold
                           text-blue-600
                           mt-2">

                    Rp{{ number_format($target,0,',','.') }}

                </div>

            </div>



            {{-- TOTAL --}}
            <div>

                <div class="text-sm text-slate-500">

                    Total Donasi

                </div>

                <div
                    class="text-3xl
                           font-bold
                           text-green-600
                           mt-2">

                    Rp{{ number_format($totalDonasi,0,',','.') }}

                </div>

            </div>



            {{-- POINT --}}
            <div>

                <div class="text-sm text-slate-500">

                    Total Point

                </div>

                <div
                    class="text-3xl
                           font-bold
                           text-yellow-500
                           mt-2">

                    {{ $totalPoin + $totalBonus }}

                </div>

            </div>



            {{-- PERIODE --}}
            <div>

                <div class="text-sm text-slate-500">

                    Periode

                </div>

                <div
                    class="text-2xl
                           font-bold
                           mt-2">

                    {{ \Carbon\Carbon::parse($langganan->tanggal_mulai)->translatedFormat('F Y') }}

                </div>

            </div>

        </div>



        {{-- ====================================== --}}
        {{-- PROGRESS --}}
        {{-- ====================================== --}}
        <div class="px-8 pb-8">

            <div
                class="flex
                       justify-between
                       mb-3">

                <span
                    class="font-semibold">

                    Progress Target

                </span>

                <span
                    class="font-bold">

                    {{ number_format($progress,0) }}%

                </span>

            </div>

            <div
                class="w-full
                       h-5
                       rounded-full
                       bg-slate-200
                       overflow-hidden">

                <div
                    class="h-full
                           rounded-full"

                    style="
                        width:{{ $progress }}%;
                        background:
                        linear-gradient(
                            90deg,
                            #16a34a,
                            #22c55e
                        );
                    ">

                </div>

            </div>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-6">

	    {{-- TOTAL DONASI --}}
	    <div class="bg-white rounded-3xl border shadow-sm p-7">

	        <div class="text-slate-500 text-sm">

	            Total Donasi Dikonfirmasi

	        </div>

	        <div class="mt-4 text-4xl font-bold text-green-600">

	            Rp{{ number_format($totalDonasi,0,',','.') }}

	        </div>

	    </div>


	    {{-- TOTAL POINT --}}
	    <div class="bg-white rounded-3xl border shadow-sm p-7">

	        <div class="text-slate-500 text-sm">

	            Total Poin Didapat

	        </div>

	        <div class="mt-4 text-4xl font-bold text-yellow-500">

	            {{ $totalPoin + $totalBonus }}

	        </div>

	    </div>


	    {{-- STATUS TARGET --}}
	    <div class="bg-white rounded-3xl border shadow-sm p-7">

	        <div class="text-slate-500 text-sm">

	            Status Target

	        </div>

	        <div class="mt-6">

	            @if($totalDonasi >= $target)

	                <span
	                    class="px-5 py-3 rounded-full
	                           bg-green-100
	                           text-green-700
	                           font-bold">

	                    🎉 Target Tercapai

	                </span>

	            @else

	                <span
	                    class="px-5 py-3 rounded-full
	                           bg-yellow-100
	                           text-yellow-700
	                           font-bold">

	                    ⏳ Belum Tercapai

	                </span>

	            @endif

	        </div>

	    </div>

	</div>


    {{-- ====================================== --}}
    {{-- SEARCH & FILTER --}}
    {{-- ====================================== --}}
    <div
        class="bg-white
               rounded-3xl
               border
               shadow-sm
               p-6">

        <form
            method="GET"
            class="grid lg:grid-cols-12 gap-4">

            {{-- SEARCH --}}
            <div class="lg:col-span-7">

                <input
                    type="text"

                    name="search"

                    value="{{ request('search') }}"

                    placeholder="🔍 Cari nama donatur..."

                    class="w-full
                           rounded-2xl
                           border
                           px-5
                           py-4">

            </div>



            {{-- STATUS --}}
            <div class="lg:col-span-3">

                <select
                    name="status"

                    class="w-full
                           rounded-2xl
                           border
                           px-5
                           py-4">

                    <option value="">

                        Semua Status

                    </option>

                    <option
                        value="menunggu"

                        @selected(request('status')=='menunggu')>

                        Menunggu

                    </option>

                    <option
                        value="dikonfirmasi"

                        @selected(request('status')=='dikonfirmasi')>

                        Dikonfirmasi

                    </option>

                    <option
                        value="ditolak"

                        @selected(request('status')=='ditolak')>

                        Ditolak

                    </option>

                </select>

            </div>



            {{-- BUTTON --}}
            <div class="lg:col-span-2">

                <button
                    class="w-full
                           rounded-2xl
                           py-4
                           text-white
                           font-bold"

                    style="
                        background:
                        linear-gradient(
                            135deg,
                            #2563eb,
                            #1d4ed8
                        );
                    ">

                    🔍 Cari

                </button>

            </div>

        </form>

    </div>
    {{-- ====================================== --}}
	{{-- RIWAYAT PEMBAYARAN --}}
	{{-- ====================================== --}}

	<div class="space-y-6">

		@forelse($riwayat as $item)

			<div
			    class="bg-white
			           rounded-3xl
			           border
			           shadow-sm
			           overflow-hidden">

			    {{-- HEADER --}}
			    <div
			        class="px-8
			               py-6
			               border-b
			               flex
			               justify-between
			               items-center">

			        <div>

			            <h2
			                class="text-2xl
			                       font-bold">

			                {{ $item->donasi->user->name }}

			            </h2>

			            <div
			                class="text-slate-500
			                       mt-1">

			                Periode

			                <b>

			                    {{ \Carbon\Carbon::parse($item->periode)->translatedFormat('F Y') }}

			                </b>

			            </div>

			        </div>


			        {{-- STATUS --}}
			        <div>

			            @if($item->status=='menunggu')

			                <span
			                    class="px-5
			                           py-2
			                           rounded-full
			                           bg-yellow-100
			                           text-yellow-700
			                           font-semibold">

			                    🟡 Menunggu

			                </span>

			            @elseif($item->status=='dikonfirmasi')

			                <span
			                    class="px-5
			                           py-2
			                           rounded-full
			                           bg-green-100
			                           text-green-700
			                           font-semibold">

			                    🟢 Dikonfirmasi

			                </span>

			            @else

			                <span
			                    class="px-5
			                           py-2
			                           rounded-full
			                           bg-red-100
			                           text-red-700
			                           font-semibold">

			                    🔴 Ditolak

			                </span>

			            @endif

			        </div>

			    </div>



			    {{-- BODY --}}
			    <div
			        class="grid
			               lg:grid-cols-5">

			        {{-- ================================= --}}
			        {{-- FOTO BUKTI --}}
			        {{-- ================================= --}}

			        <div
			            class="lg:col-span-2
			                   p-7">

			            <a
			                href="{{ asset('storage/'.$item->bukti_transfer) }}"
			                target="_blank">

			                <img

							    onclick="previewImage('{{ asset('storage/'.$item->bukti_transfer) }}')"

							    src="{{ asset('storage/'.$item->bukti_transfer) }}"

							    class="rounded-2xl
							           border
							           w-full
							           h-72
							           object-cover
							           cursor-pointer
							           hover:scale-[1.02]
							           transition">

			            </a>

			        </div>



			        {{-- ================================= --}}
			        {{-- DETAIL --}}
			        {{-- ================================= --}}

			        <div
			            class="lg:col-span-3
			                   p-8">

			            <div
			                class="grid
			                       lg:grid-cols-2
			                       gap-6">

			                {{-- Nominal --}}
			                <div>

			                    <div class="text-slate-500">

			                        Nominal Donasi

			                    </div>

			                    <div
			                        class="mt-2
			                               text-3xl
			                               font-bold
			                               text-green-600">

			                        Rp{{ number_format($item->jumlah,0,',','.') }}

			                    </div>

			                </div>



			                {{-- Dibayar --}}
			                <div>

			                    <div class="text-slate-500">

			                        Tanggal Upload

			                    </div>

			                    <div
			                        class="mt-2
			                               font-semibold">

			                        {{ $item->created_at->translatedFormat('d F Y H:i') }}

			                    </div>

			                </div>



			                {{-- Point --}}
			                <div>

			                    <div class="text-slate-500">

			                        Point

			                    </div>

			                    <div
			                        class="mt-2
			                               text-2xl
			                               font-bold
			                               text-yellow-500">

			                        ⭐ {{ $item->poin }}

			                    </div>

			                </div>



			                {{-- Bonus --}}
			                <div>

			                    <div class="text-slate-500">

			                        Bonus

			                    </div>

			                    <div
			                        class="mt-2
			                               text-2xl
			                               font-bold
			                               text-indigo-600">

			                        🎁 {{ $item->bonus }}

			                    </div>

			                </div>



			                {{-- Admin --}}
			                <div>

			                    <div class="text-slate-500">

			                        Dikonfirmasi Oleh

			                    </div>

			                    <div
			                        class="mt-2
			                               font-semibold">

			                        {{ optional($item->admin)->name ?? '-' }}

			                    </div>

			                </div>



			                {{-- Konfirmasi --}}
			                <div>

			                    <div class="text-slate-500">

			                        Tanggal Konfirmasi

			                    </div>

			                    <div
			                        class="mt-2
			                               font-semibold">

			                        {{ $item->dikonfirmasi_at
			                            ? \Carbon\Carbon::parse($item->dikonfirmasi_at)->translatedFormat('d F Y H:i')
			                            : '-'
			                        }}

			                    </div>

			                </div>

			            </div>



			            {{-- ================================= --}}
			            {{-- ALASAN DITOLAK --}}
			            {{-- ================================= --}}

			            @if($item->status=='ditolak')

			            <div
			                class="mt-8
			                       rounded-2xl
			                       border
			                       border-red-200
			                       bg-red-50
			                       p-5">

			                <div
			                    class="font-bold
			                           text-red-600">

			                    Alasan Penolakan

			                </div>

			                <div
			                    class="mt-2
			                           text-slate-600">

			                    {{ $item->alasan_tolak }}

			                </div>

			            </div>

			            @endif



			            {{-- ================================= --}}
			            {{-- BUTTON --}}
			            {{-- ================================= --}}

			            @if($item->status=='menunggu')

			            <div
			                class="flex
			                       gap-4
			                       mt-8">

			                {{-- KONFIRMASI --}}
			                <form
			                    method="POST"
			                    action="{{ route('admin.langganan.konfirmasi',$item->id) }}"
			                    class="flex-1">

			                    @csrf

			                    <button
			                        onclick="return confirm('Konfirmasi pembayaran ini?')"

			                        class="w-full
			                               py-4
			                               rounded-2xl
			                               text-white
			                               font-bold"

			                        style="background:linear-gradient(135deg,#16a34a,#15803d);">

			                        ✔ Konfirmasi Pembayaran

			                    </button>

			                </form>



			                {{-- TOLAK --}}
				                <button
								    type="button"
								    onclick="rejectLangganan({{ $item->id }})"
								    class="flex-1
								           py-4
								           rounded-2xl
								           bg-red-100
								           text-red-600
								           font-bold
								           hover:bg-red-200">

								    ✖ Tolak Pembayaran

								</button>

							<form id="rejectForm" method="POST" style="display:none">
							    @csrf
							    @method('PATCH')

							    <input
							        type="hidden"
							        id="alasan_tolak"
							        name="alasan_tolak">
							</form>

			            </div>

			            @endif

			        </div>

			    </div>

			</div>

			@empty

			<div
			    class="bg-white
			           rounded-3xl
			           border
			           p-20
			           text-center">

			    <div class="text-7xl">

			        📭

			    </div>

			    <div
			        class="text-2xl
			               font-bold
			               mt-5">

			        Belum Ada Riwayat Pembayaran

			    </div>

			    <div
			        class="text-slate-500
			               mt-2">

			        Riwayat pembayaran langganan akan muncul di sini.

			    </div>

			</div>

		@endforelse

	</div>
	{{-- ====================================== --}}
	{{-- MODAL PREVIEW BUKTI --}}
	{{-- ====================================== --}}

	<div
	    id="previewModal"
	    class="fixed inset-0
	           bg-black/80
	           hidden
	           z-50
	           flex
	           items-center
	           justify-center
	           p-10">

	    <div class="relative">

	        <button

	            onclick="closePreview()"

	            class="absolute
	                   -top-5
	                   -right-5
	                   w-12
	                   h-12
	                   rounded-full
	                   bg-white
	                   shadow
	                   text-2xl">

	            ✕

	        </button>

	        <img

	            id="previewImage"

	            src=""

	            class="max-h-[85vh]
	                   rounded-3xl
	                   shadow-2xl">

	    </div>

	</div>
	{{-- ====================================== --}}
	{{-- MODAL TOLAK --}}
	{{-- ====================================== --}}

	<div

	    id="rejectModal"

	    class="fixed
	           inset-0
	           bg-black/60
	           hidden
	           z-50
	           items-center
	           justify-center">

	    <div

	        class="bg-white
	               rounded-3xl
	               w-full
	               max-w-xl
	               p-8">

	        <h2

	            class="text-2xl
	                   font-bold">

	            Tolak Pembayaran

	        </h2>

	        <p

	            class="text-slate-500
	                   mt-2">

	            Masukkan alasan penolakan pembayaran.

	        </p>

	        <form

	            id="rejectForm"

	            method="POST">

	            @csrf

	            <div class="mt-6">

	                <textarea

	                    name="alasan_tolak"

	                    rows="5"

	                    required

	                    class="w-full
	                           rounded-2xl
	                           border
	                           p-4"

	                    placeholder="Masukkan alasan..."></textarea>

	            </div>

	            <div

	                class="flex
	                       justify-end
	                       gap-3
	                       mt-7">

	                <button

	                    type="button"

	                    onclick="closeReject()"

	                    class="px-6
	                           py-3
	                           rounded-2xl
	                           border">

	                    Batal

	                </button>

	                <button

	                    class="px-7
	                           py-3
	                           rounded-2xl
	                           text-white
	                           font-bold"

	                    style="background:#dc2626;">

	                    Tolak Pembayaran

	                </button>

	            </div>

	        </form>

	    </div>

	</div>
	{{-- ====================================== --}}
	{{-- PAGINATION --}}
	{{-- ====================================== --}}

	@if($riwayat->hasPages())

	<div

	    class="mt-10
	           flex
	           justify-center">

	    {{ $riwayat->links() }}

	</div>

	@endif

	<div class="grid lg:grid-cols-2 gap-6 mt-6">

	    {{-- SISA TARGET --}}
	    <div class="bg-white rounded-3xl border shadow-sm p-7">

	        <div class="text-slate-500 text-sm">

	            Sisa Target

	        </div>

	        <div class="mt-4 text-4xl font-bold text-red-500">

	            Rp{{ number_format(max($target-$totalDonasi,0),0,',','.') }}

	        </div>

	    </div>

	    {{-- JUMLAH TRANSAKSI --}}
	    <div class="bg-white rounded-3xl border shadow-sm p-7">

	        <div class="text-slate-500 text-sm">

	            Jumlah Transaksi

	        </div>

	        <div class="mt-4 text-4xl font-bold text-blue-600">

	            {{ $riwayat->total() }}

	        </div>

	    </div>

	</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

function previewImage(image){

    document
        .getElementById('previewImage')
        .src=image;

    document
        .getElementById('previewModal')
        .classList.remove('hidden');

}

function closePreview(){

    document
        .getElementById('previewModal')
        .classList.add('hidden');

}

function rejectLangganan(id){

    document
        .getElementById('rejectForm')
        .action='/admin/donasis/'+id+'/bulanan/tolak';

    document
        .getElementById('rejectModal')
        .classList.remove('hidden');

    document
        .getElementById('rejectModal')
        .classList.add('flex');

}

function closeReject(){

    document
        .getElementById('rejectModal')
        .classList.remove('flex');

    document
        .getElementById('rejectModal')
        .classList.add('hidden');

}

window.onclick=function(e){

    let preview=document.getElementById('previewModal');

    let reject=document.getElementById('rejectModal');

    if(e.target===preview){

        closePreview();

    }

    if(e.target===reject){

        closeReject();

    }

}


let rejectUrl = "{{ route('admin.langganan.tolak', ':id') }}";

function rejectLangganan(id){

    Swal.fire({

        title:'Tolak Pembayaran',

        input:'textarea',

        inputPlaceholder:'Masukkan alasan penolakan...',

        showCancelButton:true,

        confirmButtonText:'Tolak',

        cancelButtonText:'Batal',

        confirmButtonColor:'#dc2626',

        preConfirm:(value)=>{

            if(value.trim()==''){

                Swal.showValidationMessage(
                    'Alasan wajib diisi'
                );

                return false;

            }

            return value;

        }

    }).then((result)=>{

        if(result.isConfirmed){

            let form = document.getElementById('rejectForm');

            form.action = rejectUrl.replace(':id',id);

            document.getElementById('alasan_tolak').value = result.value;

            form.submit();

        }

    });

}


</script>

@endpush