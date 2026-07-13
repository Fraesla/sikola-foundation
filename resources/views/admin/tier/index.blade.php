@extends('layouts.admin',['activePage'=>'tier'])

@section('title','Master Tier')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div
        class="flex flex-col
               lg:flex-row
               lg:items-center
               lg:justify-between
               gap-5">

        <div>

            <h1
                class="text-3xl
                       font-bold
                       text-slate-800">

                🏅 Master Tier

            </h1>

            <p
                class="text-slate-500
                       mt-2">

                Kelola level tier berdasarkan
                total poin pengguna.

            </p>

        </div>

        <a
            href="{{ route('admin.tier.create') }}"

            class="inline-flex
                   items-center
                   justify-center
                   gap-2
                   px-6
                   py-3
                   rounded-2xl
                   text-white
                   font-semibold
                   shadow-lg
                   hover:scale-105
                   transition"

            style="
                background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );
            ">

            ➕ Tambah Tier

        </a>

    </div>


    {{-- STATISTIK --}}
    <div
        class="grid
               grid-cols-1
               md:grid-cols-2
               xl:grid-cols-4
               gap-6">

        {{-- TOTAL TIER --}}
        <div
            class="bg-white
                   rounded-3xl
                   border
                   p-6">

            <div
                class="flex
                       justify-between
                       items-center">

                <div>

                    <div
                        class="text-sm
                               text-slate-500">

                        Total Tier

                    </div>

                    <div
                        class="text-3xl
                               font-bold
                               mt-2">

                        {{ $statistik['totalTier'] }}

                    </div>

                </div>

                <div
                    class="w-14
                           h-14
                           rounded-2xl
                           bg-blue-100
                           flex
                           items-center
                           justify-center
                           text-2xl">

                    🏅

                </div>

            </div>

        </div>


        {{-- TOTAL USER --}}
        <div
            class="bg-white
                   rounded-3xl
                   border
                   p-6">

            <div
                class="flex
                       justify-between
                       items-center">

                <div>

                    <div
                        class="text-sm
                               text-slate-500">

                        Total User

                    </div>

                    <div
                        class="text-3xl
                               font-bold
                               mt-2">

                        {{ number_format($statistik['totalUser']) }}

                    </div>

                </div>

                <div
                    class="w-14
                           h-14
                           rounded-2xl
                           bg-green-100
                           flex
                           items-center
                           justify-center
                           text-2xl">

                    👥

                </div>

            </div>

        </div>


        {{-- TIER AWAL --}}
        <div
            class="bg-white
                   rounded-3xl
                   border
                   p-6">

            <div
                class="flex
                       justify-between
                       items-center">

                <div>

                    <div
                        class="text-sm
                               text-slate-500">

                        Tier Awal

                    </div>

                    <div
                        class="font-bold
                               text-xl
                               mt-2">

                        {{ $statistik['tierAwal']->nama ?? '-' }}

                    </div>

                </div>

                <div
                    class="w-14
                           h-14
                           rounded-2xl
                           bg-amber-100
                           flex
                           items-center
                           justify-center
                           text-2xl">

                    🥉

                </div>

            </div>

        </div>


        {{-- TIER TERTINGGI --}}
        <div
            class="bg-white
                   rounded-3xl
                   border
                   p-6">

            <div
                class="flex
                       justify-between
                       items-center">

                <div>

                    <div
                        class="text-sm
                               text-slate-500">

                        Tier Tertinggi

                    </div>

                    <div
                        class="font-bold
                               text-xl
                               mt-2">

                        {{ $statistik['tierAkhir']->nama ?? '-' }}

                    </div>

                </div>

                <div
                    class="w-14
                           h-14
                           rounded-2xl
                           bg-purple-100
                           flex
                           items-center
                           justify-center
                           text-2xl">

                    💎

                </div>

            </div>

        </div>

    </div>


    {{-- SEARCH --}}
    <div
        class="bg-white
               rounded-3xl
               border
               p-6">

        <form
            method="GET"
            class="flex flex-col lg:flex-row gap-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama tier..."

                class="flex-1
                       rounded-2xl
                       border
                       px-5
                       py-3">

            <button
                class="px-6
                       py-3
                       rounded-2xl
                       bg-blue-600
                       text-white">

                🔍 Cari

            </button>

        </form>

    </div>


    {{-- CARD LIST --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        @forelse($tier as $item)

            @php
                $totalPoin = $item->users->sum('total_poin');

                $persentase = $totalUser > 0
                    ? round(($item->users_count / $totalUser) * 100)
                    : 0;

                $benefits = collect(
                    preg_split('/\r\n|\r|\n/', $item->keuntungan)
                )->filter();
            @endphp

            <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition">

                {{-- HEADER --}}
                <div
                    class="p-6 text-white"
                    style="background: {{ $item->warna_hex }}">

                    <div class="flex justify-between items-start">

                        <div>

                            <div class="text-5xl">

                                {{ $item->badge_icon }}

                            </div>

                            <h2 class="text-3xl font-bold mt-4">

                                {{ $item->nama }}

                            </h2>

                            <p class="text-white/90 mt-1">

                                {{ $item->deskripsi }}

                            </p>

                        </div>

                        <span
                            class="px-4 py-2 rounded-full bg-white/20">

                            Level {{ $item->urutan }}

                        </span>

                    </div>

                </div>

                {{-- BODY --}}
                <div class="p-6">

                    <div class="grid grid-cols-2 gap-4">

                        <div class="rounded-xl bg-slate-100 p-4">

                            <small class="text-slate-500">

                                👥 Total User

                            </small>

                            <h3 class="text-3xl font-bold mt-1">

                                {{ $item->users_count }}

                            </h3>

                        </div>

                        <div class="rounded-xl bg-slate-100 p-4">

                            <small class="text-slate-500">

                                ⭐ Total Poin

                            </small>

                            <h3 class="text-3xl font-bold mt-1">

                                {{ number_format($totalPoin,0,',','.') }}

                            </h3>

                        </div>

                    </div>

                    {{-- Progress --}}
                    <div class="mt-6">

                        <div class="flex justify-between text-sm">

                            <span>

                                Distribusi User

                            </span>

                            <strong>

                                {{ $persentase }}%

                            </strong>

                        </div>

                        <div
                            class="mt-2 h-3 rounded-full bg-slate-200">

                            <div
                                class="h-3 rounded-full"
                                style="
                                    width:{{ $persentase }}%;
                                    background:{{ $item->warna_hex }};
                                ">

                            </div>

                        </div>

                    </div>

                    {{-- Benefit --}}
                    <div class="mt-6">

                        <h4 class="font-bold mb-3">

                            🎁 Benefit

                        </h4>

                        @if($benefits->count())

                            <ul class="space-y-2">

                                @foreach($benefits as $benefit)

                                    <li>

                                        ✔ {{ $benefit }}

                                    </li>

                                @endforeach

                            </ul>

                        @else

                            <p class="text-slate-400">

                                Belum ada benefit.

                            </p>

                        @endif

                    </div>

                    {{-- Action --}}
                    <div class="grid grid-cols-3 gap-3 mt-8">
                        <a
                            href="{{ route('admin.tier.show',$item) }}"
                            class="bg-indigo-600 text-white py-3 rounded-xl text-center">

                            👁 Detail

                        </a>

                        <a
                            href="{{ route('admin.tier.edit',$item) }}"
                            class="rounded-xl bg-yellow-500 py-3 text-center font-semibold text-white hover:bg-yellow-600">

                            ✏ Edit

                        </a>

                        <a
                            href="{{ route('admin.tier.users',$item) }}"
                            class="rounded-xl bg-blue-600 py-3 text-center font-semibold text-white hover:bg-blue-700">

                            👥 User

                        </a>

                        <form
                            action="{{ route('admin.tier.destroy',$item) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Hapus tier ini?')"
                                class="w-full rounded-xl bg-red-500 py-3 font-semibold text-white hover:bg-red-600">

                                🗑 Hapus

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            {{-- EMPTY --}}
            <div class="col-span-full">

                <div class="rounded-3xl border bg-white p-16 text-center shadow">

                    <div class="text-7xl">

                        🏆

                    </div>

                    <h2 class="mt-6 text-3xl font-bold">

                        Belum Ada Tier

                    </h2>

                    <p class="mx-auto mt-4 max-w-xl text-slate-500">

                        Tambahkan tier pertama agar sistem dapat
                        mengelompokkan pengguna berdasarkan total poin.

                    </p>

                    <a
                        href="{{ route('admin.tier.create') }}"
                        class="mt-8 inline-flex items-center rounded-2xl bg-blue-600 px-8 py-4 font-semibold text-white hover:bg-blue-700">

                        ➕ Tambah Tier

                    </a>

                </div>

            </div>

        @endforelse

    </div>
    {{-- PAGINATION --}}
    @if($tier->hasPages())
        <div class="mt-10">{{ $tier->links() }}</div>
    @endif
</div>


{{-- FORM DELETE --}}
<form
    id="deleteForm"
    method="POST"
    style="display:none">

    @csrf
    @method('DELETE')

</form>

@endsection


@push('scripts')

<script>

const deleteUrl =
"{{ route('admin.tier.destroy',':id') }}";


function hapusTier(id){

    Swal.fire({

        title:'Hapus Tier?',

        text:'Data tier yang dihapus tidak dapat dikembalikan.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonText:'Ya, Hapus',

        cancelButtonText:'Batal',

        confirmButtonColor:'#dc2626',

        cancelButtonColor:'#64748b'

    }).then((result)=>{

        if(result.isConfirmed){

            let form =
                document.getElementById('deleteForm');

            form.action =
                deleteUrl.replace(':id',id);

            form.submit();

        }

    });

}

</script>


@if(session('success'))

<script>

Swal.fire({

    icon:'success',

    title:'Berhasil',

    text:"{{ session('success') }}",

    timer:2500,

    showConfirmButton:false

});

</script>

@endif


@if(session('warning'))

<script>

Swal.fire({

    icon:'warning',

    title:'Perhatian',

    text:"{{ session('warning') }}"

});

</script>

@endif


@if(session('error'))

<script>

Swal.fire({

    icon:'error',

    title:'Gagal',

    text:"{{ session('error') }}"

});

</script>

@endif


@if($errors->any())

<script>

Swal.fire({

    icon:'error',

    title:'Validasi Gagal',

    html:`
        <div style="text-align:left">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    `

});

</script>

@endif

@endpush