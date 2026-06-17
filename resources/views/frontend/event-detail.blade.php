@extends('layouts.app')

@section('content')

<section class="relative">

    <img
        src="{{ $event->image }}"
        class="w-full h-[500px] object-cover">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="absolute inset-0 flex items-center">

        <div class="container mx-auto px-6">

            <h1
                class="text-5xl font-bold text-white max-w-4xl">

                {{ $event->title }}

            </h1>

        </div>

    </div>

</section>

<section class="py-20">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-4 gap-12">

            <!-- CONTENT -->
            <div class="lg:col-span-3">

                <div class="prose prose-lg max-w-none">

                    {!! $event->description !!}

                </div>

            </div>

            <!-- SIDEBAR -->
            <div>

                <div
                    class="bg-slate-50 rounded-3xl p-6 sticky top-24">

                    <h3 class="font-bold text-xl mb-5">
                        Informasi Event
                    </h3>

                    <div class="space-y-4">

                        <p>
                            📅 {{ $event->date }}
                        </p>

                        <p>
                            📍 {{ $event->location }}
                        </p>

                        <p>
                            👥 Kuota:
                            {{ $event->quota }}
                        </p>

                        <p>
                            ✅ Terdaftar:
                            {{ $event->registered }}
                        </p>

                        <p class="font-bold text-green-600">

                            Sisa Kuota:
                            {{ $event->quota - $event->registered }}

                        </p>

                    </div>

                    <a href="#"
                       class="block mt-8 text-center bg-blue-600 text-white py-3 rounded-xl font-semibold">

                        Daftar Sebagai Relawan

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection