@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-r from-blue-600 to-cyan-500 py-20">

    <div class="container mx-auto px-6 text-center text-white">

        <h1 class="text-5xl font-bold">
            Event Sikola Foundation
        </h1>

        <p class="mt-4 text-blue-100">
            Kegiatan mendatang dan arsip event yang telah diselenggarakan.
        </p>

    </div>

</section>

<section class="py-12 bg-white">

    <div class="container mx-auto px-6">

        <div class="flex justify-center gap-3">

            <button
                class="px-5 py-2 bg-blue-600 text-white rounded-full">
                Semua
            </button>

            <button
                class="px-5 py-2 bg-slate-100 rounded-full">
                Mendatang
            </button>

            <button
                class="px-5 py-2 bg-slate-100 rounded-full">
                Arsip
            </button>

        </div>

    </div>

</section>

<section class="py-20 bg-slate-50">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($events as $event)

            <div
                class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                <img
                    src="{{ $event['image'] }}"
                    class="h-56 w-full object-cover">

                <div class="p-6">

                    <span
                        class="inline-flex px-3 py-1 rounded-full text-sm
                        {{ $event['status'] == 'upcoming'
                            ? 'bg-green-100 text-green-600'
                            : 'bg-gray-100 text-gray-600' }}">

                        {{ $event['status'] == 'upcoming'
                            ? 'Mendatang'
                            : 'Arsip' }}

                    </span>

                    <h3 class="text-xl font-bold mt-4">
                        {{ $event['title'] }}
                    </h3>

                    <p class="text-slate-500 mt-2">
                        📅 {{ $event['date'] }}
                    </p>

                    <p class="text-slate-500">
                        📍 {{ $event['location'] }}
                    </p>

                    <a href="{{ route('event.show', $event['slug']) }}"
                       class="inline-flex mt-5 text-blue-600 font-semibold">

                        Detail Event →

                    </a>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endsection