@extends('layouts.admin',['activePage'=>'tier'])

@section('content')

<div class="space-y-8">

<div class="bg-white rounded-3xl shadow p-8">

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold">

                👥 User Tier {{ $tier->nama }}

            </h1>

            <p class="text-slate-500 mt-2">

                Daftar seluruh pengguna dengan tier
                <b>{{ $tier->nama }}</b>

            </p>

        </div>

        <a href="{{ route('admin.tier.index') }}"
           class="px-5 py-3 rounded-xl bg-slate-200">

            ← Kembali

        </a>

    </div>

</div>

<div class="grid md:grid-cols-3 gap-6">

    <div class="bg-white rounded-3xl shadow p-6">

        <div class="text-slate-500">

            Total User

        </div>

        <div class="text-4xl font-bold mt-2">

            {{ number_format($statistik['totalUser']) }}

        </div>

    </div>

    <div class="bg-white rounded-3xl shadow p-6">

        <div class="text-slate-500">

            Total Poin

        </div>

        <div class="text-4xl font-bold mt-2">

            {{ number_format($statistik['totalPoin']) }}

        </div>

    </div>

    <div class="bg-white rounded-3xl shadow p-6">

        <div class="text-slate-500">

            Rata-rata EXP

        </div>

        <div class="text-4xl font-bold mt-2">

            {{ number_format($statistik['rataPoin']) }}

        </div>

    </div>

</div>
<div class="bg-white rounded-3xl shadow p-6">

    <form>

        <div class="flex gap-4">

            <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari user..."
            class="flex-1 rounded-xl border px-4 py-3">

            <button
            class="px-6 rounded-xl bg-blue-600 text-white">

            Cari

            </button>

        </div>

    </form>

</div>
<div class="bg-white rounded-3xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-slate-100">

            <tr>

                <th class="p-4 text-left">User</th>

                <th>Total Poin</th>

                <th>Email</th>

                <th>Status</th>

                <th></th>

            </tr>

        </thead>

        <tbody>

            @forelse($users as $user)

                <tr class="border-t">

                    <td class="p-4">

                        <div class="flex items-center gap-4">

                            <img
                            src="{{ $user->avatar
                            ? asset('storage/'.$user->avatar)
                            : asset('images/default-avatar.png') }}"
                            class="w-12 h-12 rounded-full object-cover">

                            <div>

                                <div class="font-bold">

                                {{ $user->name }}

                                </div>

                                <div class="text-sm text-slate-500">

                                {{ $user->tier->nama }}

                                </div>

                            </div>

                        </div>

                    </td>

                    <td class="font-bold">{{ number_format($user->total_poin) }}</td>

                    <td>{{ $user->email }}</td>

                    <td>
                        @if($user->is_active)
                            <span class="text-green-600">Aktif</span>
                        @else
                            <span class="text-red-600">Nonaktif</span>
                        @endif

                    </td>
                    <td>
                        <a href="{{ route('admin.pengguna.show',$user) }}" class="px-4 py-2 rounded-xl bg-blue-600 text-white">Detail</a>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-12">Belum ada user pada tier ini.</td>
                </tr>
            @endforelse

        </tbody>

    </table>

</div>
<div>

{{ $users->links() }}

</div>

@endsection