@if($registrasi->hasPages())

<div class="mt-10">

    <div
        class="admin-card rounded-3xl p-6">

        <div
            class="flex flex-col lg:flex-row justify-between items-center gap-5">

            <div class="text-sm text-slate-500">

                Menampilkan

                <strong>

                    {{ $registrasi->firstItem() }}

                </strong>

                -

                <strong>

                    {{ $registrasi->lastItem() }}

                </strong>

                dari

                <strong>

                    {{ $registrasi->total() }}

                </strong>

                data.

            </div>

            {{ $registrasi->links() }}

        </div>

    </div>

</div>

@endif