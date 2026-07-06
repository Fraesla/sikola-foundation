<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikola Foundation Admin</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        .menu-active{
            background: linear-gradient(
                135deg,
                var(--color-merah),
                var(--color-coklat)
            );
            color: white;
            border-left: 4px solid var(--color-kuning);
            transform: translateX(4px);
        }

        .menu-active::before{
            content:'';
            position:absolute;
            left:0;
            top:0;
            width:4px;
            height:100%;
            background: var(--color-kuning);
        }
    </style>
    @stack('styles')
</head>

<body
    style="
        background-color:
        rgba(212,160,23,.06);
    ">

    <div class="flex min-h-screen">

        <aside
            class="w-72 min-h-screen border-r"
            style="
                background-color: var(--color-hitam);
                color: var(--color-putih);
                border-color: rgba(212,160,23,.2);
            ">

            <!-- Logo -->
            <div
                class="p-6 border-b"
                style="border-color: rgba(212,160,23,.15);">

                <h1
                    class="text-2xl font-bold"
                    style="color: var(--color-putih);">

                    Sikola Foundation

                </h1>

                <div
                    class="w-20 h-1 rounded-full mt-3"
                    style="background-color: var(--color-kuning);">
                </div>

                <h2
                    class="text-xl mt-4"
                    style="
                        color: var(--color-kuning);
                        font-family: var(--font-display);
                    ">

                    Admin Panel

                </h2>

            </div>

            <!-- Menu -->
            <nav class="p-4 space-y-2">

                <!-- Dashboard -->
                <a href="{{ url('/admin') }}"
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                   {{ ($activePage ?? '') == 'dashboard' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📊 Dashboard

                </a>

                <!-- Konten -->
                <a href="{{ url('/admin/konten') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'konten' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📰 Konten

                </a>

                <!-- Event -->
                <a href="{{ url('/admin/events/show') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'event' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📅 Event & Peserta

                </a>

                <!-- Relawan -->
                <a href="{{ url('/admin/relawans') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'relawan' ? 'menu-active' : 'hover:bg-white/10' }}">

                    🤝 Relawan

                </a>

                <!-- Donasi -->
                <a href="{{ url('/admin/donasi') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'donasi' ? 'menu-active' : 'hover:bg-white/10' }}">

                    💰 Donasi & Donatur

                </a>

                <!-- Merchandise -->
                <a href="{{ url('/admin/produk') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'merchandise' ? 'menu-active' : 'hover:bg-white/10' }}">

                    🛍 Merchandise & Orders

                </a>

                <!-- Pengguna -->
                <a href="{{ url('/admin/pengguna') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'pengguna' ? 'menu-active' : 'hover:bg-white/10' }}">

                    👥 Pengguna

                </a>

                <!-- Laporan -->
                <a href="{{ url('/admin/laporan') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'laporan' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📈 Laporan

                </a>

                <!-- Logout -->
                <!-- <div class="pt-6 border-t border-slate-800 mt-6">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl menu-logout text-left">

                            🚪 Logout

                        </button>
                    </form>

                </div> -->

            </nav>

        </aside>
        @php
            $user = auth()->user();
        @endphp

        <div class="flex-1 flex flex-col">

            <header
                class="border-b"
                style="
                    background-color: white;
                    border-color: rgba(212,160,23,.15);
                ">

                <div class="px-6 py-4 flex items-center justify-between">

                    <div>

                        <h2
                            class="text-xl font-bold"
                            style="color: var(--color-hitam);">
                            {{ ucfirst($activePage ?? 'Dashboard') }}
                        </h2>

                    </div>

                    <div class="flex items-center gap-4">
                        {{-- NOTIF --}}
                        <div class="relative">

                            <button id="notifButton"
                                class="relative p-2 rounded-lg hover:bg-slate-100">

                                🔔

                                @if($totalNotif)

                                <span
                                    class="absolute -top-1 -right-1
                                           w-5 h-5 rounded-full
                                           flex items-center justify-center
                                           text-xs
                                           bg-red-600 text-white">

                                    {{ $totalNotif }}

                                </span>

                                @endif

                            </button>

                            {{-- Dropdown --}}
                            <div id="notifDropdown" class="hidden absolute right-0 mt-3 w-96 bg-white rounded-2xl shadow-2xl border z-50">
                                    <div class="p-5 border-b">
                                        <h5 class="font-bold text-lg">Notifikasi</h5>
                                        <div class="max-h-[420px] overflow-y-auto">
                                            @if($pendingDonasi)
                                                <a href="{{ route('admin.donasi.index') }}" class="flex p-4 hover:bg-orange-50">
                                                    <div class="text-2xl me-3">💰</div>
                                                    <div>
                                                        <div class="font-semibold">{{ $pendingDonasi }} Donasi Pending</div>
                                                        <div class="text-sm text-gray-500">Menunggu verifikasi pembayaran</div>
                                                    </div>
                                                </a>
                                            @endif

                                            @if($pendingOrder)
                                                <a href="{{ route('admin.order.index') }}"class="flex p-4 hover:bg-blue-50">
                                                    <div class="text-2xl me-3">🛒</div>
                                                    <div>
                                                        <div class="font-semibold">{{ $pendingOrder }} Order Baru</div>
                                                        <div class="text-sm text-gray-500">Segera diproses</div>
                                                    </div>
                                                </a>
                                            @endif

                                            @if($pendingRegistrasi)
                                                <a href="{{ route('admin.event-registrasi.index') }}"class="flex p-4 hover:bg-green-50">
                                                    <div class="text-2xl me-3">🙋</div>
                                                    <div>
                                                        <div class="font-semibold">{{ $pendingRegistrasi }} Registrasi Event</div>
                                                        <div class="text-sm text-gray-500">Menunggu persetujuan admin</div>
                                                    </div>
                                                </a>
                                            @endif

                                            @if($totalNotif==0)
                                                <div class="text-center py-5 text-gray-400"> Tidak ada notifikasi</div>
                                            @endif
                                        </div>
                                    </div>
                            </div>

                        </div>
                        <div class="relative">

                            <button
                                id="profileButton"
                                class="flex items-center gap-3">
                                <?php if ($user->avatar == NULL): ?>
                                    <img src="https://i.pravatar.cc/100" class="w-10 h-10 rounded-full">
                                <?php else: ?>
                                    <img
                                    src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-user.png') }}"
                                    class="w-11 h-11 rounded-full object-cover">
                                <?php endif ?>
                                

                                <div class="text-left">

                                    <div class="font-semibold">
                                        <?php if ($user->name==NULL): ?>
                                            Administrator
                                        <?php else: ?>
                                            {{ $user->name }}
                                        <?php endif ?>
                                    </div>

                                    <div class="text-xs text-slate-500">

                                        {{ ucfirst($user->role) }}

                                    </div>

                                </div>

                            </button>

                            <div
                                id="profileMenu"
                                class="hidden absolute right-0 mt-3 w-72 bg-white rounded-2xl shadow-xl border z-50">

                                <!-- Header -->

                                <div class="p-5 border-b">

                                    <div class="flex items-center gap-3">

                                        <?php if ($user->avatar == NULL): ?>
                                            <img src="https://i.pravatar.cc/100" class="w-10 h-10 rounded-full">
                                        <?php else: ?>
                                            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-user.png') }}" class="w-11 h-11 rounded-full object-cover">
                                        <?php endif ?>
                                        <div>

                                            <div class="font-semibold">
                                                <?php if ($user->name==NULL): ?>
                                                    Administrator
                                                <?php else: ?>
                                                    {{ $user->name }}
                                                <?php endif ?>
                                            </div>

                                            <div class="text-sm text-slate-500">

                                                {{ $user->email }}

                                            </div>

                                            <div class="text-xs text-orange-600">

                                                {{ ucfirst($user->role) }}

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-- Menu -->

                                <a href="{{ route('admin.profile') }}"
                                   class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50 {{ ($activePage ?? '') == 'profile' ? 'menu-active' : 'hover:bg-white/10' }}">

                                    👤 Profil Saya

                                </a>

                                <a href="{{ route('admin.password') }}"
                                   class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50 {{ ($activePage ?? '') == 'password' ? 'menu-active' : 'hover:bg-white/10' }}">

                                    🔒 Ubah Password

                                </a>

                                <hr>

                                <form action="{{ route('logout') }}"
                                      method="POST">

                                    @csrf

                                    <button
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl menu-logout text-red-500 text-left hover:text-blue-600">

                                        🚪 Logout

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>
                    
                </div>

            </header>

            <main
    class="p-6"
    style="
        background-color:
        rgba(212,160,23,.04);
    ">

                @yield('content')

            </main>

        </div>

    </div>

    @stack('scripts')

<script>

const profileBtn = document.getElementById('profileButton');
const profileMenu = document.getElementById('profileMenu');

profileBtn.addEventListener('click', function (e) {

    e.stopPropagation();

    profileMenu.classList.toggle('hidden');

});

document.addEventListener('click', function () {

    profileMenu.classList.add('hidden');

});

const notifButton =
document.getElementById('notifButton');

const notifDropdown =
document.getElementById('notifDropdown');

notifButton.addEventListener('click',function(){

notifDropdown.classList.toggle('hidden');

});

document.addEventListener('click',function(e){

if(!notifButton.contains(e.target) &&!notifDropdown.contains(e.target))
{

notifDropdown.classList.add('hidden');

}

});

</script>
</body>

</html>
