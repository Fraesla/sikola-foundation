<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikola Foundation Admin</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        .menu-active {
            background: rgb(37 99 235);
            color: white;
        }
    </style>

</head>

<body class="bg-slate-100">

    <div class="flex min-h-screen">

        <aside
            class="w-72 bg-slate-900 text-white min-h-screen">

            <!-- Logo -->
            <div
                class="p-6 border-b border-slate-800">

                <h1 class="text-2xl font-bold">
                    Sikola Foundation
                </h1>

                <p class="text-slate-400 text-sm">
                    Admin Panel
                </p>

            </div>

            <!-- Menu -->
            <nav class="p-4 space-y-2">

                <!-- Dashboard -->
                <a href="{{ url('/admin/dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'dashboard' ? 'menu-active' : 'hover:bg-slate-800' }}">

                    📊 Dashboard

                </a>

                <!-- Konten -->
                <a href="{{ url('/admin/konten') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'konten' ? 'menu-active' : 'hover:bg-slate-800' }}">

                    📰 Konten

                </a>

                <!-- Event -->
                <a href="{{ url('/admin/event') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'event' ? 'menu-active' : 'hover:bg-slate-800' }}">

                    📅 Event

                </a>

                <!-- Relawan -->
                <a href="{{ url('/admin/relawan') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'relawan' ? 'menu-active' : 'hover:bg-slate-800' }}">

                    🤝 Relawan

                </a>

                <!-- Donasi -->
                <a href="{{ url('/admin/donasi') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'donasi' ? 'menu-active' : 'hover:bg-slate-800' }}">

                    💰 Donasi

                </a>

                <!-- Merchandise -->
                <a href="{{ url('/admin/merchandise') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'merchandise' ? 'menu-active' : 'hover:bg-slate-800' }}">

                    🛍 Merchandise

                </a>

                <!-- Pengguna -->
                <a href="{{ url('/admin/pengguna') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'pengguna' ? 'menu-active' : 'hover:bg-slate-800' }}">

                    👥 Pengguna

                </a>

                <!-- Laporan -->
                <a href="{{ url('/admin/laporan') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                    {{ ($activePage ?? '') == 'laporan' ? 'menu-active' : 'hover:bg-slate-800' }}">

                    📈 Laporan

                </a>

                <!-- Logout -->
                <div class="pt-6 border-t border-slate-800 mt-6">

                    <a href="{{ url('/login') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-600">

                        🚪 Logout

                    </a>

                </div>

            </nav>

        </aside>

        <div class="flex-1 flex flex-col">

            <header class="bg-white border-b shadow-sm">

                <div class="px-6 py-4 flex items-center justify-between">

                    <div>

                        <h2 class="text-xl font-bold text-slate-800">
                            {{ ucfirst($activePage ?? 'Dashboard') }}
                        </h2>

                    </div>

                    <div class="flex items-center gap-4">

                        <button
                            class="relative p-2 rounded-lg hover:bg-slate-100">

                            🔔

                            <span
                                class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">

                                3

                            </span>

                        </button>

                        <div class="flex items-center gap-3">

                            <img
                                src="https://i.pravatar.cc/100"
                                class="w-10 h-10 rounded-full">

                            <div>

                                <div class="font-semibold">
                                    Administrator
                                </div>

                                <div class="text-xs text-slate-500">
                                    Admin
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </header>

            <main class="p-6">

                @yield('content')

            </main>

        </div>

    </div>

    @stack('scripts')

</body>

</html>