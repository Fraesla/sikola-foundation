@extends('layouts.relawan',[
    'activePage' => 'keranjang'
])

@section('content')

<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
    
    /* Modifikasi Checkbox menyesuaikan tema */
    .marawa-checkbox {
        accent-color: var(--color-merah);
        cursor: pointer;
    }
</style>

@foreach($cartItems as $item)
<form id="delete-form-{{ $item->id }}" action="{{ route('relawan.keranjang.destroy', $item->id) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endforeach

<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8 font-sans" style="background-color: var(--color-putih);">
    <form id="checkoutForm" action="{{ route('relawan.orders.checkout') }}" method="POST" class="max-w-7xl mx-auto">
        @csrf
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight" style="color: var(--color-hitam); font-family: var(--font-display);">
                    Keranjang Saya
                </h1>
                <p class="mt-2" style="color: var(--color-coklat);">
                    Pastikan barang pesananmu sudah benar sebelum checkout.
                </p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('relawan.keranjang.create') }}" class="px-5 py-2.5 rounded-xl bg-white font-medium shadow-sm transition-all duration-200 flex items-center gap-2 hover:-translate-y-1" style="border: 1px solid var(--color-kuning); color: var(--color-coklat);">
                    <svg class="w-5 h-5" style="color: var(--color-kuning);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Tambah Barang
                </a>
            </div>
        </div>

        @if($cartItems->count())
        <div class="grid lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 space-y-5">
                
                <div class="card-admin p-5 flex justify-between items-center">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" id="checkAll" class="marawa-checkbox w-5 h-5 rounded transition duration-150">
                        <span class="font-semibold" style="color: var(--color-hitam);">Pilih Semua</span>
                    </label>
                    <button type="button" id="deleteSelected" class="text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-red-50" style="color: var(--color-merah);">
                        Hapus Terpilih
                    </button>
                </div>

                <div class="space-y-4">
                    @foreach($cartItems as $item)
                    <div class="card-admin p-6 transition-all">
                        <div class="flex gap-6 items-start">
                            <div class="pt-2">
                                <input type="checkbox" name="cart_ids[]" value="{{ $item->id }}" class="cart-check marawa-checkbox w-5 h-5 rounded transition duration-150" checked>
                            </div>
                            
                            <img src="{{ asset('storage/'.($item->product->gambar[0] ?? 'default.png')) }}" class="w-28 h-28 rounded-xl object-cover shadow-sm" style="border: 1px solid rgba(212,160,23,.15);" alt="{{ $item->product->nama }}">
                            
                            <div class="flex-1 flex flex-col justify-between h-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h2 class="font-bold text-lg line-clamp-2" style="color: var(--color-hitam);">{{ $item->product->nama }}</h2>
                                        <div class="font-extrabold text-xl mt-1" style="color: var(--color-merah);">
                                            Rp {{ number_format($item->product->harga,0,',','.') }}
                                        </div>
                                    </div>
                                    
                                    <button form="delete-form-{{ $item->id }}" onclick="return confirm('Hapus barang ini dari keranjang?')" class="transition-colors p-2 rounded-lg hover:bg-red-50" style="color: var(--color-merah);" title="Hapus Barang">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>

                                <div class="flex justify-between items-end mt-6">
                                    <div class="flex items-center rounded-lg bg-white p-1 shadow-sm" style="border: 1px solid rgba(212,160,23,.25);">
                                        <button type="button" class="minus w-8 h-8 flex items-center justify-center rounded-md hover:bg-gray-50 transition-all font-bold" style="color: var(--color-coklat);" data-id="{{ $item->id }}">-</button>
                                        <input type="number" min="1" max="{{ $item->product->stok }}" value="{{ $item->qty }}" class="qty-input w-12 text-center bg-transparent border-none focus:ring-0 text-sm font-bold p-0" style="color: var(--color-hitam);" data-id="{{ $item->id }}">
                                        <button type="button" class="plus w-8 h-8 flex items-center justify-center rounded-md hover:bg-gray-50 transition-all font-bold" style="color: var(--color-coklat);" data-id="{{ $item->id }}">+</button>
                                    </div>

                                    <div class="text-right hidden sm:block">
                                        <p class="text-xs font-semibold uppercase tracking-wider mb-1" style="color: var(--color-coklat);">Subtotal</p>
                                        <h3 class="font-bold text-lg subtotal" data-id="{{ $item->id }}" data-price="{{ $item->product->harga }}" style="color: var(--color-hitam);">
                                            Rp {{ number_format($item->qty * $item->product->harga, 0, ',', '.') }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="card-admin p-6 sticky top-8">
                    <h2 class="text-xl font-extrabold mb-6" style="color: var(--color-hitam); font-family: var(--font-display);">Ringkasan Belanja</h2>
                    
                    <div class="space-y-4 font-medium" style="color: var(--color-coklat);">
                        <div class="flex justify-between">
                            <span>Total Barang</span>
                            <span id="selectedItem" class="font-bold" style="color: var(--color-hitam);">{{ $cartItems->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Kuantitas</span>
                            <span id="selectedQty" class="font-bold" style="color: var(--color-hitam);">{{ $cartItems->sum('qty') }}</span>
                        </div>
                    </div>

                    <div class="my-6 border-t border-dashed" style="border-color: rgba(212,160,23,.3);"></div>

                    <div class="flex justify-between items-center mb-8">
                        <span class="font-bold" style="color: var(--color-hitam);">Total Harga</span>
                        <span id="grandTotal" class="text-2xl font-extrabold" style="color: var(--color-merah);">
                            Rp {{ number_format($cartItems->sum(fn($i) => $i->qty * $i->product->harga), 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" id="checkoutBtn" class="btn-primary w-full flex justify-center items-center gap-2 text-lg">
                        Checkout (<span id="btnQty">0</span>)
                    </button>
                    
                    <p class="text-xs text-center mt-4 flex items-center justify-center gap-1" style="color: var(--color-coklat);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Transaksi Aman & Terlindungi
                    </p>
                </div>
            </div>
        </div>

        @else
        <div class="card-admin p-16 text-center max-w-2xl mx-auto mt-10">
            <div class="w-32 h-32 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner" style="background-color: var(--color-putih);">
                <svg class="w-16 h-16" style="color: var(--color-kuning);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold mt-5" style="color: var(--color-hitam); font-family: var(--font-display);">Keranjangmu masih kosong, nih.</h2>
            <p class="mt-3 mb-8" style="color: var(--color-coklat);">Yuk, cari barang menarik dan penuhi keranjangmu sekarang!</p>
            <a href="{{ route('relawan.keranjang.create') }}" class="btn-primary inline-flex items-center px-8 py-3.5">
                Mulai Belanja
            </a>
        </div>
        @endif
    </form>
</div>

<script>
    const token = "{{ csrf_token() }}";
    const checkAll = document.getElementById("checkAll");
    const checks = document.querySelectorAll(".cart-check");

    function syncCheckAll() {
        if (!checkAll || checks.length === 0) return;
        const checkedCount = [...checks].filter(c => c.checked).length;
        if (checkedCount === 0) {
            checkAll.checked = false;
            checkAll.indeterminate = false;
        } else if (checkedCount === checks.length) {
            checkAll.checked = true;
            checkAll.indeterminate = false;
        } else {
            checkAll.checked = false;
            checkAll.indeterminate = true;
        }
    }

    if (checkAll) {
        checkAll.onchange = function() {
            checks.forEach(c => c.checked = this.checked);
            calculate();
        };
    }

    checks.forEach(c => {
        c.onchange = function() {
            syncCheckAll();
            calculate();
        };
    });

    syncCheckAll();

    function calculate() {
        let total = 0;
        let qty = 0;
        let item = 0;

        document.querySelectorAll(".cart-check").forEach(function(check, index) {
            if (check.checked) {
                item++;
                const subtotalElement = document.querySelectorAll(".subtotal")[index];
                const harga = parseInt(subtotalElement.dataset.price);
                const jumlah = parseInt(document.querySelectorAll(".qty-input")[index].value) || 1;

                qty += jumlah;
                total += harga * jumlah;
            }
        });

        document.getElementById("selectedItem").innerHTML = item;
        document.getElementById("selectedQty").innerHTML = qty;
        document.getElementById("grandTotal").innerHTML = "Rp " + total.toLocaleString("id-ID");
        
        const btnQty = document.getElementById("btnQty");
        if(btnQty) btnQty.innerHTML = item;
    }

    calculate();

    document.querySelectorAll(".qty-input").forEach(function(input) {
        input.addEventListener("change", function() {
            let qty = parseInt(this.value);
            let max = parseInt(this.max);
            
            if (qty < 1 || isNaN(qty)) qty = 1;
            if (qty > max) qty = max;
            
            this.value = qty;
            updateQty(this.dataset.id, "manual", qty);
        });
    });

    document.querySelectorAll(".plus").forEach(btn => {
        btn.onclick = function() { updateQty(this.dataset.id, "plus"); };
    });

    document.querySelectorAll(".minus").forEach(btn => {
        btn.onclick = function() { updateQty(this.dataset.id, "minus"); };
    });

    function updateQty(id, action, manualQty = null) {
        let bodyData = { action: action };
        if (action === "manual") bodyData.qty = manualQty;

        fetch("/relawan/keranjang/" + id + "/ajax", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
                "Accept": "application/json"
            },
            body: JSON.stringify(bodyData)
        })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                const inputElement = document.querySelector('.qty-input[data-id="'+id+'"]');
                inputElement.value = res.qty;

                const subtotal = document.querySelector('.subtotal[data-id="'+id+'"]');
                subtotal.innerHTML = "Rp " + Number(res.subtotal).toLocaleString("id-ID");
                subtotal.dataset.qty = res.qty;

                calculate();
            } else {
                alert(res.message || "Gagal mengubah jumlah barang.");
                location.reload(); 
            }
        })
        .catch(err => console.error(err));
    }

    const deleteBtn = document.getElementById("deleteSelected");
    if (deleteBtn) {
        deleteBtn.onclick = function() {
            const ids = [...checks].filter(c => c.checked).map(c => c.value);
            if (ids.length === 0) return alert("Pilih barang yang ingin dihapus terlebih dahulu.");
            
            if(confirm("Yakin ingin menghapus barang yang dipilih?")) {
                fetch("/relawan/keranjang/delete-selected", {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({ ids: ids })
                })
                .then(r => r.json())
                .then(res => location.reload())
                .catch(err => console.error(err));
            }
        };
    }
</script>

@endsection