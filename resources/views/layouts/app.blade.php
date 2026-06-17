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

<body class="bg-slate-50">
     @if(!Request::is('login'))
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center h-16">

                <a href="/" class="font-bold text-2xl text-blue-600">
                    Sikola Foundation
                </a>

                <div class="hidden md:flex gap-8">
                    <a href="/">Beranda</a>
                    <a href="{{ url('/tentang') }}" class="hover:text-blue-600 transition">Tentang</a>
                    <a href="{{ url('/berita') }}" class="hover:text-blue-600 transition">Berita</a>
                    <a href="{{ url('/merchandise') }}" class="hover:text-blue-600 transition">Merchandise</a>
                    <a href="{{ url('/tim') }}" class="hover:text-blue-600 transition">Tim</a>
                    <a href="{{ url('/kontak') }}" class="hover:text-blue-600 transition">Kontak</a>
                    <a href="{{ url('/login') }}" class="hover:text-blue-600 transition">Login</a>
                </div>

            </div>
        </div>
    </nav>
     @endif

    <main>
        @yield('content')
    </main>
    @if(!Request::is('login'))
    <footer class="bg-slate-900 text-white py-10 mt-20">
        <div class="container mx-auto px-6 text-center">
            © {{ date('Y') }} Sikola Foundation
        </div>
    </footer>
    @endif

</body>
</html>