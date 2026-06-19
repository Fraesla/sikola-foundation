<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikola Foundation</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body
    class="min-h-screen"
    style="
        background-color: var(--color-putih);
        color: var(--color-hitam);
        font-family: var(--font-body);
    ">
     @if(!Request::is('login'))
    <!-- Navbar -->
    <nav
    class="shadow-lg border-b-4"
    style="
        background-color: var(--color-merah);
        border-color: var(--color-kuning);
    ">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center h-16">

                <a href="/"
                   class="text-2xl font-bold"
                   style="
                      color: var(--color-putih);
                      font-family: var(--font-display);
                   ">
                    Sikola Foundation
                </a>

                <div class="hidden md:flex gap-8">
                    <a href="/" class="nav-link">Beranda</a>
                    <a href="{{ url('/tentang') }}" class="nav-link">Tentang</a>
                    <a href="{{ url('/berita') }}" class="nav-link">Berita</a>
                    <a href="{{ url('/merchandise') }}" class="nav-link">Merchandise</a>
                    <a href="{{ url('/tim') }}" class="nav-link">Tim</a>
                    <a href="{{ url('/kontak') }}" class="nav-link">Kontak</a>
                    <a href="{{ url('/login') }}" class="nav-link">Login</a>
                </div>

            </div>
        </div>
    </nav>
     @endif

    <main>
        @yield('content')
    </main>
    @if(!Request::is('login'))
    <footer class="py-10 mt-20 border-t-4"
        style="
            background-color: var(--color-hitam);
            border-color: var(--color-kuning);
            color: var(--color-putih);
        ">
        <div class="container mx-auto px-6 text-center">
            <h3
                class="text-2xl font-bold mb-2"
                style="font-family: var(--font-display);">
                    Sikola Foundation
            </h3>
            <p style="color: #d6d6d6;">
                Pendidikan • Sosial • Kemanusiaan
            </p>
            <div class="mt-4 text-sm">
                © {{ date('Y') }} Sikola Foundation
            </div>

        </div>
    </footer>
    @endif

</body>
</html>
