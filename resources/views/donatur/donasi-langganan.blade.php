@extends('layouts.donatur', ['activePage' => 'donasi'])

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4">


    {{-- HEADER --}}
    <div class="bg-white rounded-[35px] shadow-xl p-10 mb-8 flex flex-col md:flex-row justify-between items-center gap-6">
        <a href="{{ url()->previous() }}"
            class="px-6 py-3 rounded-2xl border">

            ← Kembali

        </a>
        <div>
            <h1 class="text-4xl md:text-5xl font-black">💳 Pembayaran Donasi</h1>
            <p class="text-slate-500 mt-3 font-medium">Lakukan pembayaran donasi bulanan Anda dengan mudah.</p>
        </div>
        <div class="text-right bg-red-50 px-8 py-4 rounded-3xl border border-red-100">
            <small class="uppercase text-red-500 font-bold tracking-widest text-xs">Tagihan Bulan Ini</small>
            <h1 class="text-4xl font-black mt-1" style="color:var(--color-merah);">
                Rp {{ number_format($langganan->jumlah_bulanan, 0, ',', '.') }}
            </h1>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        
        {{-- KIRI (INFORMASI & RIWAYAT) --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- INFO LANGGANAN --}}
            <div class="bg-white rounded-[35px] shadow-lg p-8">
                <h2 class="text-2xl font-black mb-8">📋 Informasi Langganan</h2>
                <div class="grid grid-cols-2 gap-6">
                    @foreach(['Program' => $donasi->kategori->nama ?? '-', 'Donasi Sebelumnya' => 'Rp '.number_format($langganan->jumlah_bulanan,0,',','.'), 'Mulai' => $langganan->tanggal_mulai->format('d M Y'), 'Berakhir' => optional($langganan->tanggal_akhir)->format('d M Y') ?? 'Aktif Selamanya'] as $label => $val)
                    <div class="bg-slate-50 p-5 rounded-2xl">
                        <small class="text-slate-400 font-bold uppercase tracking-wider text-[10px]">{{ $label }}</small>
                        <h3 class="font-bold text-lg text-slate-800 mt-1">{{ $val }}</h3>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- REKENING --}}
            <div class="bg-white rounded-[35px] shadow-lg p-8">
                <h2 class="text-2xl font-black mb-6">🏦 Transfer Ke</h2>
                <div class="rounded-3xl bg-slate-50 p-6 flex justify-between items-center border border-slate-100">
                    <div>
                        <h4 class="font-bold text-lg">Bank BCA</h4>
                        <p class="text-slate-600 font-mono text-xl tracking-wide mt-1">1234567890</p>
                        <small class="text-slate-400 font-semibold">a.n Yayasan Sikola</small>
                    </div>
                    <button onclick="copyRekening()" class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold transition">Copy</button>
                </div>
            </div>

            {{-- RIWAYAT --}}
            <div class="bg-white rounded-[35px] shadow-lg p-8">
                <h2 class="text-2xl font-black mb-6">📜 Riwayat Pembayaran</h2>
                <div class="space-y-4">
                    @forelse($riwayat as $item)
                        <div class="flex justify-between items-center py-4 border-b last:border-0">
                            <div>
                                <h4 class="font-bold">{{ $item->created_at->format('F Y') }}</h4>
                                <small class="text-slate-500 font-medium">Rp {{ number_format($item->jumlah,0,',','.') }}</small>
                            </div>
                            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase {{ $item->status=='dikonfirmasi' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-10 text-slate-400 font-medium">Belum ada pembayaran.</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- KANAN (FORM UPLOAD) --}}
        <div class="lg:col-span-1">
            <form action="{{ route('donatur.langganan.bayar',$donasi->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="sticky top-10">

                @csrf

                <div class="bg-white rounded-[35px] shadow-xl p-8">

                    <h2 class="text-2xl font-black mb-8">
                        💳 Pembayaran Langganan
                    </h2>

                    {{-- Nominal --}}
                    <label class="font-bold">
                        Nominal Donasi
                    </label>

                    <input
                        type="number"
                        id="jumlah"
                        name="jumlah"
                        min="{{ $donasi->kategori->minimal_donasi }}"
                        max="{{ $donasi->kategori->maksimal_donasi }}"
                        class="w-full mt-3 rounded-2xl border p-4 bg-slate-50"
                        placeholder="Masukkan nominal">

                    <p class="mt-2 text-sm text-slate-500">
                        Minimal :
                        <b>
                            Rp {{ number_format($donasi->kategori->minimal_donasi,0,',','.') }}
                        </b>

                        <br>

                        Maksimal :
                        <b>
                            Rp {{ number_format($donasi->kategori->maksimal_donasi,0,',','.') }}
                        </b>
                    </p>

                    <button
                        type="button"
                        onclick="konfirmasiNominal()"
                        class="w-full mt-6 py-4 rounded-2xl text-white font-bold"
                        style="background:linear-gradient(135deg,var(--color-merah),var(--color-coklat));">

                        Lanjutkan

                    </button>

                    {{-- Upload disembunyikan --}}
                    <div
                        id="uploadArea"
                        class="hidden mt-8">

                        <hr class="mb-6">

                        <h3 class="font-bold text-lg mb-5">

                            Upload Bukti Transfer

                        </h3>

                        <input
                            type="file"
                            id="fileInput"
                            name="bukti_transfer"
                            accept="image/*"
                            class="hidden">

                        <label
                            for="fileInput"
                            class="cursor-pointer">

                            <div class="h-44 rounded-3xl border-2 border-dashed border-slate-300 flex flex-col justify-center items-center">

                                <div class="text-5xl">

                                    📷

                                </div>

                                <p class="mt-3">

                                    Klik untuk Upload Bukti

                                </p>

                            </div>

                        </label>

                        <img
                            id="preview"
                            class="hidden w-full h-48 rounded-3xl mt-5 object-cover">

                        <button
                            type="submit"
                            id="submitBtn"
                            disabled
                            class="w-full mt-6 py-4 rounded-2xl bg-gray-300 text-white font-bold">

                            💳 Kirim Pembayaran

                        </button>

                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function copyRekening(){
        navigator.clipboard.writeText("1234567890");
        alert("Nomor rekening berhasil disalin!");
    }

    // const fileInput = document.getElementById('fileInput');
    // const preview = document.getElementById('preview');
    // fileInput.onchange = () => {
    //     if(fileInput.files[0]) {
    //         preview.src = URL.createObjectURL(fileInput.files[0]);
    //         preview.classList.remove('hidden');
    //     }
    // }
    function rupiah(x)
    {
        return new Intl.NumberFormat('id-ID').format(x);

    }

    function konfirmasiNominal(){

        let nominal=document.getElementById("jumlah").value;

        let min={{ $donasi->kategori->minimal_donasi }};

        let max={{ $donasi->kategori->maksimal_donasi ?? 999999999 }};

        if(nominal==""){

            Swal.fire({

                icon:'warning',

                title:'Nominal belum diisi',

                text:'Silakan isi nominal donasi.'

            });

            return;

        }

        if(parseInt(nominal)<min){

            Swal.fire({

                icon:'error',

                title:'Nominal terlalu kecil',

                html:'Minimal donasi adalah <b>Rp '+rupiah(min)+'</b>'

            });

            return;

        }

        if(parseInt(nominal)>max){

            Swal.fire({

                icon:'error',

                title:'Nominal terlalu besar',

                html:'Maksimal donasi adalah <b>Rp '+rupiah(max)+'</b>'

            });

            return;

        }

        Swal.fire({

            icon:'question',

            title:'Konfirmasi Donasi',

            html:`

                <div style="font-size:16px">

                    Anda akan melakukan donasi sebesar

                    <h2 style="margin-top:15px;color:#dc2626">

                        Rp ${rupiah(nominal)}

                    </h2>

                </div>

            `,

            showCancelButton:true,

            confirmButtonText:'Ya, Lanjutkan',

            cancelButtonText:'Ubah Nominal',

            confirmButtonColor:'#16a34a',

            cancelButtonColor:'#dc2626'

        }).then((result)=>{

            if(result.isConfirmed){

                document
                .getElementById("uploadArea")
                .classList
                .remove("hidden");

                document
                .getElementById("jumlah")
                .readOnly=true;

                Swal.fire({

                    icon:'success',

                    title:'Silakan Upload Bukti',

                    text:'Langkah berikutnya adalah mengunggah bukti transfer.',

                    timer:1800,

                    showConfirmButton:false

                });

            }

        });

    }

    const file=document.getElementById("fileInput");

    const preview=document.getElementById("preview");

    const submit=document.getElementById("submitBtn");

    file.onchange=function(){

        if(this.files.length){

            preview.src=URL.createObjectURL(this.files[0]);

            preview.classList.remove("hidden");

            submit.disabled=false;

            submit.classList.remove("bg-gray-300");

            submit.classList.add("bg-green-600");

            Swal.fire({

                icon:'success',

                title:'Bukti Transfer Dipilih',

                text:'Silakan tekan tombol Kirim Pembayaran.',

                timer:1500,

                showConfirmButton:false

            });

        }

    };
</script>
@endsection
