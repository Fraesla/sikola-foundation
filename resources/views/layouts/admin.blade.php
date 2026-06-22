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
                <a href="{{ url('/admin/dashboard') }}"
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
                <a href="{{ url('/admin/events') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'event' ? 'menu-active' : 'hover:bg-white/10' }}">

                    📅 Event

                </a>

                <!-- Relawan -->
                <a href="{{ url('/admin/relawan') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'relawan' ? 'menu-active' : 'hover:bg-white/10' }}">

                    🤝 Relawan

                </a>

                <!-- Donasi -->
                <a href="{{ url('/admin/donasi') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'donasi' ? 'menu-active' : 'hover:bg-white/10' }}">

                    💰 Donasi

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
                <div class="pt-6 border-t border-slate-800 mt-6">

                    <a href="{{ url('/login') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl menu-logout">

                        🚪 Logout

                    </a>

                </div>

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

                        <button
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

                        </button>

                        <div class="flex items-center gap-3">

                            <img
                                src="https://i.pravatar.cc/100"
                                class="w-10 h-10 rounded-full">

                            <div>

                                <div
                                    class="font-semibold"
                                    style="color: var(--color-hitam);">

                                    Administrator

                                </div>

                                <div
                                    class="text-xs"
                                    style="color: var(--color-coklat);">

                                    Super Admin

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

</body>

</html>
