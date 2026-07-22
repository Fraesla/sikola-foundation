@props([
    'name',
    'title' => '',
    'maxWidth' => '2xl',
])

<div

    x-data="{ show:false }"

    x-on:open-modal.window="

        if($event.detail === '{{ $name }}'){

            show = true

            document.body.classList.add('overflow-hidden')

        }

    "

    x-on:close-modal.window="

        show = false

        document.body.classList.remove('overflow-hidden')

    "

    x-show="show"

    x-transition.opacity

    class="fixed inset-0 z-50"

    style="display:none;"

>

    {{-- Overlay --}}

    <div

        class="absolute inset-0 bg-black/50"

        @click="

            show=false

            document.body.classList.remove('overflow-hidden')

        "

    ></div>

    {{-- Modal --}}

    <div

        class="relative flex items-center justify-center min-h-screen p-6"

    >

        <div

            x-transition

            @click.stop

            class="bg-white rounded-3xl shadow-2xl w-full max-w-{{ $maxWidth }}"

        >

            {{-- Header --}}

            <div class="px-6 py-5 border-b flex justify-between items-center">

                <h3 class="text-xl font-bold">

                    {{ $title }}

                </h3>

                <button

                    @click="

                        show=false

                        document.body.classList.remove('overflow-hidden')

                    "

                    class="w-10 h-10 rounded-xl hover:bg-slate-100"

                >

                    <i class="fas fa-times"></i>

                </button>

            </div>

            {{-- Body --}}

            <div class="p-6">

                {{ $slot }}

            </div>

            {{-- Footer (optional) --}}

            @isset($footer)

                <div class="border-t p-5">

                    {{ $footer }}

                </div>

            @endisset

        </div>

    </div>

</div>