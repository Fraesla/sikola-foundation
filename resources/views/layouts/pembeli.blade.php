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

                    Pembeli Panel

                </h2>

            </div>

            <!-- Menu -->
            <nav class="p-4 space-y-2">

                <!-- Dashboard -->
                 <a href="{{ url('/pembeli') }}"
                   class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300
                   {{ ($activePage ?? '') == 'dashboard' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📊 Dashboard

                </a>

                <!-- Konten -->
                {{-- Order --}}

                <a href="{{ url('/pembeli/orders') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'order' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📦 Order Saya

                </a>

                {{-- Keranjang --}}
                <a href="{{ url('/pembeli/keranjang') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'keranjang' ? 'menu-active' : 'hover:bg-white/10' }}">

                    🛒 Keranjang

                </a>
                <!-- Reward -->
                <a href="{{ url('/pembeli/reward') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'reward' ? 'menu-active' : 'hover:bg-white/10' }}">

                    🎁 Reward

                </a>

               <!--  {{-- Profile --}}
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

                       <!--  <button
                            class="relative p-2 rounded-lg hover:bg-slate-100">

                            🔔

                            <span
                                class="absolute -top-1 -right-1 w-5 h-5 text-xs rounded-full flex items-center justify-center"
                                style="
                                    background-color: var(--color-merah);
                                    color: var(--color-putih);
                                ">

                                3

                            </span>

                        </button> -->

                        <div
                        x-data="{open:false}"
                        class="relative">

                            <button
                                @click="open=!open"
                                class="relative p-2 rounded-xl hover:bg-slate-100">

                                🔔

                                @if($totalNotif)

                                    <span
                                        class="absolute -top-1 -right-1
                                               w-5 h-5 rounded-full
                                               text-xs flex items-center justify-center"

                                        style="
                                            background:var(--color-merah);
                                            color:white;
                                        ">

                                        {{ $totalNotif }}

                                    </span>

                                @endif

                            </button>
                            <div

                                x-show="open"

                                @click.away="open=false"

                                x-transition

                                class="absolute right-0 mt-3 w-96 bg-white rounded-3xl shadow-2xl overflow-hidden z-50">

                                <div class="p-5 border-b">

                                    <h3 class="font-bold text-lg">

                                        🔔 Notifikasi

                                    </h3>

                                    <p class="text-sm text-slate-500">

                                        Aktivitas terbaru akun Anda

                                    </p>

                                </div>

                                <div class="max-h-96 overflow-y-auto">
                                    @forelse($notifications as $item)

                                        <div
                                            class="flex gap-4 p-4 hover:bg-slate-50 transition">

                                            <div
                                                class="w-12 h-12 rounded-2xl
                                                       flex items-center justify-center text-xl"

                                                style="background:rgba(204,34,34,.08);">

                                                {{ $item['icon'] }}

                                            </div>

                                            <div class="flex-1">

                                                <div class="font-semibold">

                                                    {{ $item['title'] }}

                                                </div>

                                                <div class="text-sm text-slate-500">

                                                    {{ $item['date']->diffForHumans() }}

                                                </div>

                                            </div>

                                            <span

                                                class="px-3 py-1 rounded-full text-xs font-semibold"

                                                @class([
                                                    'bg-green-100 text-green-700'=>$item['color']=='green',
                                                    'bg-blue-100 text-blue-700'=>$item['color']=='blue',
                                                    'bg-yellow-100 text-yellow-700'=>$item['color']=='yellow',
                                                ])>

                                                {{ $item['status'] }}

                                            </span>

                                        </div>

                                        @empty

                                        <div class="p-8 text-center text-slate-500">

                                            Belum ada notifikasi.

                                        </div>

                                    @endforelse
                                </div>
                                <div class="border-t p-4 text-center">

                                    <a

                                        href="#aktivitas"

                                        class="font-semibold"

                                        style="color:var(--color-merah);">

                                        Lihat Semua Aktivitas →

                                    </a>

                                </div>

                            </div>
                        </div>
                        <div x-data="{ open:false }" class="relative">

                            <button @click="open=!open"
                                class="flex items-center gap-3 rounded-xl p-2 hover:bg-slate-100">
                                 @if(auth()->user()->avatar)
                                    <img
                                        src="{{ \Illuminate\Support\Str::startsWith(auth()->user()->avatar,'http')
                                            ? auth()->user()->avatar
                                            : asset('storage/'.auth()->user()->avatar) }}"
                                        class="w-11 h-11 rounded-full object-cover border-2"

                                        style="border-color:rgba(212,160,23,.35);">

                                @else
                                    <img src="https://i.pravatar.cc/100" class="w-10 h-10 rounded-full">
                                @endif
                                <div class="text-left">

                                    <div class="font-semibold">
                                        <?php if ($user->name==NULL): ?>
                                            Pembeli
                                        <?php else: ?>
                                            {{ auth()->user()->name }}
                                        <?php endif ?>
                                    </div>

                                    <div
                                        class="text-xs"
                                        style="color:var(--color-coklat)">

                                        {{ ucfirst(auth()->user()->role) }}

                                    </div>

                                </div>

                                <svg
                                    class="w-4 h-4 text-slate-500"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <path d="M19 9l-7 7-7-7"/>

                                </svg>

                            </button>
                            <div

                            x-show="open"

                            @click.away="open=false"

                            x-transition

                            class="absolute right-0 mt-3 w-72 bg-white rounded-3xl shadow-2xl border overflow-hidden z-50">

                            <div class="p-6 text-center border-b">
                                @if(auth()->user()->avatar)
                                    <img
                                        src="{{ \Illuminate\Support\Str::startsWith(auth()->user()->avatar,'http')
                                            ? auth()->user()->avatar
                                            : asset('storage/'.auth()->user()->avatar) }}"
                                        class="w-20 h-20 rounded-full mx-auto object-cover">

                                @else
                                    <img src="https://i.pravatar.cc/100" class="w-10 h-10 rounded-full">
                                @endif 
                                <h3 class="font-bold text-lg mt-3">
                                    <?php if ($user->name==NULL): ?>
                                        Pembeli
                                    <?php else: ?>
                                        {{ auth()->user()->name }}
                                    <?php endif ?>

                                </h3>

                                <p class="text-slate-500">

                                    {{ auth()->user()->email }}

                                </p>

                                <span

                                    class="inline-block mt-3 px-4 py-1 rounded-full text-sm"

                                    style="
                                        background:rgba(204,34,34,.08);
                                        color:var(--color-merah);
                                    ">

                                    {{ ucfirst(auth()->user()->role) }}

                                </span>

                            </div>
                            <div class="p-3">

                                <a href="{{ route('pembeli.profile') }}"  class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-100 {{ ($activePage ?? '') == 'profile' ? 'menu-active' : 'hover:bg-white/10' }}">
                                    👤 Profile Saya
                                </a>

                               <!--  <a

                                    href="#"

                                    class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-100">

                                    🔒

                                    Ubah Password

                                </a> -->

                                <a

                                    href="#"

                                    class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-100">

                                    ⭐

                                    Membership

                                </a>

                            </div>
                            <div class="border-t p-3">

                                <form

                                    action="{{ route('logout') }}"

                                    method="POST">

                                    @csrf

                                    <button

                                        class="w-full flex items-center gap-3 rounded-xl p-3 hover:bg-red-50 text-red-600">

                                        🚪

                                        Logout

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

</body>

</html>
