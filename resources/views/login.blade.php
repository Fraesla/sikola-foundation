@extends('layouts.app')

@section('content')

<section
    class="min-h-screen bg-gradient-to-br from-blue-600 via-cyan-500 to-blue-800 flex items-center justify-center px-6">

    <div class="max-w-6xl w-full">

        <div
            class="grid lg:grid-cols-2 bg-white rounded-3xl overflow-hidden shadow-2xl">

            <!-- LEFT -->
            <div
                class="hidden lg:flex flex-col justify-center p-16 bg-gradient-to-br from-blue-700 to-cyan-600 text-white">

                <h1 class="text-5xl font-bold">
                    Sikola Foundation
                </h1>

                <p class="mt-6 text-lg text-blue-100">

                    Bersama membangun pendidikan, sosial,
                    dan kemanusiaan untuk masa depan yang lebih baik.

                </p>

                <div class="mt-10 space-y-4">

                    <div>✓ Event Sosial</div>
                    <div>✓ Program Donasi</div>
                    <div>✓ Volunteer & Membership</div>
                    <div>✓ Pendidikan Masyarakat</div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="p-10 lg:p-14">

                <div class="text-center">

                    <h2 class="text-4xl font-bold">
                        Login
                    </h2>

                    <p class="text-slate-500 mt-3">
                        Masuk ke akun Anda
                    </p>

                </div>

                <!-- GOOGLE LOGIN -->
                <a href="#"
                    class="mt-8 flex items-center justify-center gap-3 border rounded-xl py-3 hover:bg-slate-50 transition">

                    <svg width="22" height="22" viewBox="0 0 48 48">
                        <path fill="#FFC107"
                            d="M43.6 20.5H42V20H24v8h11.3C33.7 32.7 29.3 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3 0 5.7 1.1 7.8 2.9l5.7-5.7C34.1 6.1 29.3 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.4-.4-3.5z" />
                        <path fill="#FF3D00"
                            d="M6.3 14.7l6.6 4.8C14.7 15 19 12 24 12c3 0 5.7 1.1 7.8 2.9l5.7-5.7C34.1 6.1 29.3 4 24 4 16.3 4 9.7 8.3 6.3 14.7z" />
                        <path fill="#4CAF50"
                            d="M24 44c5.2 0 10-2 13.6-5.2l-6.3-5.3c-2.1 1.6-4.7 2.5-7.3 2.5-5.2 0-9.7-3.3-11.2-8l-6.5 5C9.6 39.4 16.2 44 24 44z" />
                        <path fill="#1976D2"
                            d="M43.6 20.5H42V20H24v8h11.3c-1.1 3.2-3.3 5.8-6 7.5l6.3 5.3C39.5 37.3 44 31.2 44 24c0-1.3-.1-2.4-.4-3.5z" />
                    </svg>

                    Login dengan Google

                </a>

                <div class="relative my-8">

                    <div class="border-t"></div>

                    <span
                        class="absolute left-1/2 -translate-x-1/2 -top-3 bg-white px-4 text-slate-500">

                        atau

                    </span>

                </div>

                <!-- LOGIN FORM -->
                <form method="POST" action="{{ url('/dashboard') }}">

                    @csrf

                    <div class="mb-5">

                        <label class="block mb-2 font-medium">
                            Email
                        </label>

                        <input
                            type="email"
                            class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <div class="mb-5">

                        <label class="block mb-2 font-medium">
                            Password
                        </label>

                        <input
                            type="password"
                            class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                    <div
                        class="flex justify-between items-center mb-6">

                        <label class="flex items-center gap-2">

                            <input type="checkbox">

                            <span class="text-sm">
                                Ingat Saya
                            </span>

                        </label>

                        <a href="#"
                            class="text-blue-600 text-sm">

                            Lupa Password?

                        </a>

                    </div>

                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold">

                        Login

                    </button>

                </form>

                <!-- REGISTER -->
                <div class="text-center mt-8">

                    <span class="text-slate-500">
                        Belum punya akun?
                    </span>

                    <a href="#"
                        class="text-blue-600 font-semibold">

                        Daftar Sekarang

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection