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

                    Relawan Panel

                </h2>

            </div>

            <!-- Menu -->
            <nav class="p-4 space-y-2">

                <!-- Dashboard -->
                 <a href="{{ url('/relawan') }}"
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                   {{ ($activePage ?? '') == 'dashboard' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📊 Dashboard

                </a>

                <!-- Event -->
                 <a href="{{ url('/relawan/events') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'event' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📅 Event

                </a>

                <!-- Donasi -->
                <a href="{{ url('/relawan/donasi') }}"
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                   {{ ($activePage ?? '') == 'donasi' ? 'menu-active' : 'hover:bg-white/10' }}">

                    💰 Donasi

                </a>

                {{-- Order --}}

                <a href="{{ url('/relawan/orders') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'order' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📦 Order Saya

                </a>

                {{-- Keranjang --}}
                <a href="{{ url('/relawan/keranjang') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'keranjang' ? 'menu-active' : 'hover:bg-white/10' }}">

                    🛒 Keranjang

                </a>
                
                <!-- Reward -->
                <a href="{{ url('/relawan/reward') }}"
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
                                id="notifBtn"
                                class="relative p-2 rounded-lg hover:bg-slate-100">

                                🔔

                                @if($totalNotif > 0)
                                <span
                                    class="absolute -top-1 -right-1 w-5 h-5 rounded-full text-xs flex items-center justify-center"
                                    style="background:var(--color-merah);color:white;">

                                    {{ $totalNotif }}

                                </span>
                                @endif

                            </button>

                            <div
                                id="notifMenu"
                                class="hidden absolute right-0 mt-4 w-96 bg-white rounded-3xl shadow-2xl border overflow-hidden z-50">

                                <div class="p-5 border-b">

                                    <h3 class="font-bold text-lg">

                                        Aktivitas Relawan

                                    </h3>

                                    <p class="text-sm text-gray-500">

                                        {{ $totalNotif }} aktivitas terbaru

                                    </p>

                                </div>

                                <div class="max-h-96 overflow-y-auto">

                                    @forelse($notifications as $item)

                                        <div class="flex gap-4 p-4 hover:bg-gray-50 border-b">

                                            <div class="text-2xl">

                                                {{ $item['icon'] }}

                                            </div>

                                            <div class="flex-1">

                                                <div class="font-semibold">

                                                    {{ $item['title'] }}

                                                </div>

                                                <div class="text-sm text-gray-500">

                                                    {{ $item['status'] }}

                                                </div>

                                                <div class="text-xs text-gray-400 mt-1">

                                                    {{ $item['date']->diffForHumans() }}

                                                </div>

                                            </div>

                                        </div>

                                    @empty

                                        <div class="p-8 text-center text-gray-500">

                                            Belum ada aktivitas.

                                        </div>

                                    @endforelse

                                </div>

                            </div>

                        </div>

                        <div class="relative" x-data="{ open:false }">

                            <button
                                @click="open=!open"
                                class="flex items-center gap-3 hover:bg-gray-100 rounded-xl px-2 py-1 transition">

                                @if(auth()->user()->avatar)

                                    @if(Str::startsWith(auth()->user()->avatar,'http'))

                                        <img
                                            src="{{ auth()->user()->avatar }}"
                                            class="w-11 h-11 rounded-full object-cover border-2"
                                            style="border-color:rgba(212,160,23,.35);">

                                    @else

                                        <img src="https://i.pravatar.cc/100" class="w-10 h-10 rounded-full">>

                                    @endif

                                @else

                                    <img
                                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=CC2222&color=fff"
                                        class="w-11 h-11 rounded-full border-2"
                                        style="border-color:rgba(212,160,23,.35);">

                                @endif

                                <div class="text-left">

                                    <div class="font-semibold"
                                         style="color:var(--color-hitam)">

                                        {{ auth()->user()->name }}

                                    </div>

                                    <div class="text-xs"
                                         style="color:var(--color-coklat)">

                                        Relawan

                                    </div>

                                </div>

                                <svg class="w-4 h-4 text-gray-500"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>

                                </svg>

                            </button>
                            <div
                                x-show="open"
                                @click.outside="open=false"
                                x-transition
                                class="absolute right-0 mt-3 w-80 bg-white rounded-3xl shadow-2xl overflow-hidden z-50">

                                <div class="p-8 text-center">

                                    @if(auth()->user()->avatar)

                                        @if(Str::startsWith(auth()->user()->avatar,'http'))

                                            <img
                                                src="{{ auth()->user()->avatar }}"
                                                class="w-24 h-24 rounded-full mx-auto object-cover border-4"
                                                style="border-color:#d4a01733;">

                                        @else

                                            <img src="https://i.pravatar.cc/100" class="w-10 h-10 rounded-full">

                                        @endif

                                    @else

                                        <img
                                            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=CC2222&color=fff&size=200"
                                            class="w-24 h-24 rounded-full mx-auto border-4"
                                            style="border-color:#d4a01733;">

                                    @endif

                                    <h3 class="text-2xl font-bold mt-4">

                                        {{ auth()->user()->name }}

                                    </h3>

                                    <p class="text-gray-500">

                                        {{ auth()->user()->email }}

                                    </p>

                                    <span
                                        class="inline-block mt-3 px-5 py-1 rounded-full text-sm"
                                        style="background:#FDECEC;color:#CC2222;">

                                        Relawan

                                    </span>

                                </div>

                                <div class="border-t">

                                    <a href="{{ route('relawan.profile') }}"
                                       class="flex items-center gap-3 px-6 py-4 hover:bg-gray-100 {{ ($activePage ?? '') == 'profile' ? 'menu-active' : 'hover:bg-white/10' }}">

                                        👤 Profile Saya

                                    </a>

                                    <a href="#"
                                       class="flex items-center gap-3 px-6 py-4 hover:bg-gray-100">

                                        ⭐ Membership

                                    </a>

                                </div>

                                <div class="border-t">

                                    <form action="{{ route('logout') }}"
                                          method="POST">

                                        @csrf

                                        <button
                                            class="w-full text-left px-6 py-4 text-red-600 hover:bg-red-50">

                                            🚪 Logout

                                        </button>

                                    </form>

                                </div>

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
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
const notifBtn = document.getElementById('notifBtn');
const notifMenu = document.getElementById('notifMenu');

notifBtn.addEventListener('click', function(e){
    e.stopPropagation();
    notifMenu.classList.toggle('hidden');
});

document.addEventListener('click', function(e){
    if(!notifMenu.contains(e.target)){
        notifMenu.classList.add('hidden');
    }
});
</script>
</body>

</html>