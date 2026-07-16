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

                    Donatur Panel

                </h2>

            </div>

            <!-- Menu -->
            <nav class="p-4 space-y-2">

                <!-- Dashboard -->
                 <a href="{{ url('/donatur') }}"
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                   {{ ($activePage ?? '') == 'dashboard' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📊 Dashboard

                </a>

                <!-- Konten -->
                <a href="{{ url('/donatur/donasi') }}"
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                   {{ ($activePage ?? '') == 'donasi' ? 'menu-active' : 'hover:bg-white/10' }}">

                    💰 Donasi

                </a>

                {{-- Order --}}

                <a href="{{ url('/donatur/orders') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'order' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📦 Order Saya

                </a>

                {{-- Keranjang --}}
                <a href="{{ url('/donatur/keranjang') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'keranjang' ? 'menu-active' : 'hover:bg-white/10' }}">

                    🛒 Keranjang

                </a>

                <!-- Reward -->
                <a href="{{ url('/donatur/reward') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'reward' ? 'menu-active' : 'hover:bg-white/10' }}">

                    🎁 Reward

                </a>

                <!-- {{-- Profile --}}
                <a href="#"
                   class="flex items-center gap-3 px-5 py-4 rounded-2xl mb-3">

                    👤 Profil

                </a> -->

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
            use Illuminate\Support\Str;
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

                        <div class="relative">

                            <button
                                id="notifButton"
                                class="relative p-2 rounded-lg hover:bg-slate-100 transition">

                                🔔

                                @if($totalNotif)

                                <span
                                    class="absolute -top-1 -right-1 w-5 h-5 text-xs rounded-full flex items-center justify-center"
                                    style="
                                        background:var(--color-merah);
                                        color:white;
                                    ">

                                    {{ $totalNotif }}

                                </span>

                                @endif

                            </button>
                            <div
                                id="notifDropdown"
                                class="hidden absolute right-0 mt-3 w-[420px] bg-white rounded-3xl shadow-2xl border overflow-hidden z-50">

                                <div class="px-6 py-5 border-b">

                                    <div class="flex justify-between items-center">

                                        <div>

                                            <h3 class="font-bold text-lg">

                                                🔔 Aktivitas Terbaru

                                            </h3>

                                            <p class="text-sm text-slate-500">

                                                {{ $totalNotif }} aktivitas terbaru

                                            </p>

                                        </div>

                                    </div>

                                </div>

                                <div class="max-h-[420px] overflow-y-auto">

                                    @forelse($notifications as $item)

                                    <div
                                        class="flex gap-4 p-5 hover:bg-orange-50 transition border-b">

                                        <div
                                            class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl"

                                            style="background:rgba(204,34,34,.08);">

                                            {{ $item['icon'] }}

                                        </div>

                                        <div class="flex-1">

                                            <h4 class="font-semibold">

                                                {{ $item['title'] }}

                                            </h4>

                                            <p class="text-sm text-slate-500">

                                                {{ $item['status'] }}

                                            </p>

                                            <small class="text-xs text-slate-400">

                                                {{ $item['date']->diffForHumans() }}

                                            </small>

                                        </div>

                                    </div>

                                    @empty

                                    <div class="p-10 text-center text-slate-500">

                                        <div class="text-5xl mb-3">

                                            🔕

                                        </div>

                                        Belum ada aktivitas.

                                    </div>

                                    @endforelse

                                </div>

                                <div class="p-4 bg-slate-50">

                                    <a
                                        href="{{ route('donatur.dashboard') }}"
                                        class="block text-center py-2 rounded-xl font-semibold text-red-600 hover:bg-red-50">

                                        Lihat Semua Aktivitas →

                                    </a>

                                </div>

                            </div>

                        </div>
                        <div
                            x-data="{ open:false }"
                            class="relative">

                            <button
                                @click="open=!open"
                                class="flex items-center gap-3 hover:bg-slate-100 rounded-2xl px-2 py-1 transition">
                                 @if(auth()->user()->avatar)
                                <img
                                    src="{{ auth()->user()->avatar
                                            ? (Str::startsWith(auth()->user()->avatar,'http')
                                                ? auth()->user()->avatar
                                                : asset('storage/'.auth()->user()->avatar))
                                            : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=CC2222&color=fff' }}"

                                    class="w-11 h-11 rounded-full object-cover border-2"
                                    style="border-color:rgba(212,160,23,.35);">
                                @else
                                    <img src="https://i.pravatar.cc/100" class="w-10 h-10 rounded-full">
                                @endif
                                <div class="text-left">

                                    <div
                                        class="font-semibold"
                                        style="color:var(--color-hitam);">

                                        <?php if ($user->name==NULL): ?>
                                            Donatur
                                        <?php else: ?>
                                            {{ auth()->user()->name }}
                                        <?php endif ?>

                                    </div>

                                    <div
                                        class="text-xs"
                                        style="color:var(--color-coklat);">

                                        {{ ucfirst(auth()->user()->role) }}

                                    </div>

                                </div>

                                <svg
                                    class="w-4 h-4 text-slate-500"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19 9l-7 7-7-7"/>

                                </svg>

                            </button>
                            <div

                                x-show="open"

                                @click.outside="open=false"

                                x-transition

                                class="absolute right-0 mt-3 w-80 rounded-3xl overflow-hidden bg-white shadow-2xl border z-50"

                                style="border-color:rgba(212,160,23,.15);">

                                <!-- HEADER -->
                                <div class="p-8 text-center">

                                    <img

                                        src="{{ auth()->user()->avatar
                                                ? (Str::startsWith(auth()->user()->avatar,'http')
                                                    ? auth()->user()->avatar
                                                    : asset('storage/'.auth()->user()->avatar))
                                                : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=CC2222&color=fff' }}"

                                        class="w-24 h-24 rounded-full mx-auto object-cover border-4"

                                        style="border-color:rgba(212,160,23,.2);">

                                    <h3 class="text-2xl font-bold mt-5">

                                        {{ auth()->user()->name }}

                                    </h3>

                                    <p class="text-slate-500 mt-1">

                                        {{ auth()->user()->email }}

                                    </p>

                                    <span

                                        class="inline-block mt-4 px-4 py-1 rounded-full text-sm"

                                        style="

                                            background:rgba(204,34,34,.08);

                                            color:var(--color-merah);

                                        ">

                                        {{ ucfirst(auth()->user()->role) }}

                                    </span>

                                </div>

                                <div class="border-t">

                                    <a

                                        href="{{ route('donatur.profile') }}"

                                        class="flex items-center gap-3 px-6 py-4 hover:bg-slate-50 {{ ($activePage ?? '') == 'profile' ? 'menu-active' : 'hover:bg-white/10' }}">

                                        👤

                                        <span>Profile Saya</span>

                                    </a>

                                    <a

                                        href="#"

                                        class="flex items-center gap-3 px-6 py-4 hover:bg-slate-50">

                                        ⭐

                                        <span>Membership</span>

                                    </a>

                                </div>

                                <div class="border-t">

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button

                                            class="w-full text-left px-6 py-4 hover:bg-red-50 text-red-600 flex items-center gap-3">

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

    const notifButton = document.getElementById('notifButton');

    const notifDropdown = document.getElementById('notifDropdown');

    notifButton.addEventListener('click',function(e){

        e.stopPropagation();

        notifDropdown.classList.toggle('hidden');

    });

    document.addEventListener('click',function(e){

        if(!notifDropdown.contains(e.target) && !notifButton.contains(e.target)){

            notifDropdown.classList.add('hidden');

        }

    });

    </script>
</body>

</html>
