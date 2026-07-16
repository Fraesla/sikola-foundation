<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tier;

class TierController extends Controller
{
     /**
     * List Tier
     */
    public function index(Request $request)
    {
        $tier = Tier::withCount('users')
            ->when($request->search, function ($query) use ($request) {

                $query->where(
                    'nama',
                    'like',
                    '%' . $request->search . '%'
                );

            })
            ->orderBy('urutan')
            ->paginate(9)
            ->withQueryString();

        $totalUser = \App\Models\User::count();

        $statistik = [

            'totalTier' => Tier::count(),

            'totalUser' => \App\Models\User::where('role', '!=', 'admin')->count(),

            'tierAwal' => Tier::orderBy('urutan')->first(),

            'tierAkhir' => Tier::orderByDesc('urutan')->first(),

        ];

        return view(
            'admin.tier.index',
            compact(
                'tier',
                'totalUser',
                'statistik'
            )
        );
    }

    public function users(Request $request, Tier $tier)
    {
        $users = User::with([
                'tier'
            ])
            ->where('tier_id', $tier->id)
            ->when($request->search, function ($query) use ($request) {

                $query->where(function ($q) use ($request) {

                    $q->where('name', 'like', "%{$request->search}%")
                      ->orWhere('email', 'like', "%{$request->search}%");

                });

            })
            ->orderByDesc('total_poin')
            ->paginate(15)
            ->withQueryString();

        $statistik = [

            'totalUser' => $users->total(),

            'totalPoin' => User::where('tier_id',$tier->id)
                                ->sum('total_poin'),

            'rataPoin' => User::where('tier_id',$tier->id)
                                ->avg('exp'),

        ];

        return view(
            'admin.tier.users',
            compact(
                'tier',
                'users',
                'statistik'
            )
        );
    }

    public function show(Tier $tier)
    {
        $tier->loadCount('users');

        $tier->load([
            'users' => function ($query) {
                $query->latest()
                      ->take(10);
            }
        ]);

        $benefit = collect(
            preg_split('/\r\n|\r|\n/', $tier->keuntungan)
        )->filter();

        $statistik = [

            'totalPoin' => $tier->users()->sum('total_poin'),

            'rataPoin' => round(
                $tier->users()->avg('exp')
            ),

            'totalBenefit' => $benefit->count(),

            'persentase' => User::count()
                ? round(
                    ($tier->users_count / User::count()) * 100
                )
                : 0,

        ];

        $topUsers = $tier->users()
            ->orderByDesc('total_poin')
            ->take(10)
            ->get();

        $chartLabels = Tier::orderBy('urutan')
            ->pluck('nama');

        $chartData = Tier::withCount('users')
            ->orderBy('urutan')
            ->pluck('users_count');

        $chartColors = Tier::orderBy('urutan')
            ->pluck('warna_hex');

        return view(
            'admin.tier.show',
            compact(
                'tier',
                'benefit',
                'topUsers',
                'chartLabels',
                'chartData',
                'chartColors',
                'statistik'
            )
        );
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        return view('admin.tier.create');
    }

    /**
     * Simpan
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama' => 'required|max:100',

            'min_poin' => 'required|integer|min:0',

            'max_poin' => 'nullable|integer|gte:min_poin',

            'badge_icon' => 'nullable|max:100',

            'warna_hex' => 'required|max:20',

            'deskripsi' => 'nullable',

            'keuntungan' => 'nullable',

            'urutan' => 'required|integer|min:1',

        ]);

        Tier::create($request->all());

        return redirect()
            ->route('admin.tier.index')
            ->with(
                'success',
                'Tier berhasil ditambahkan.'
            );
    }

    /**
     * Form Edit
     */
    public function edit(Tier $tier)
    {
        return view(
            'admin.tier.edit',
            compact('tier')
        );
    }

    /**
     * Update
     */
    public function update(Request $request, Tier $tier)
    {
        $request->validate([

            'nama' => 'required|max:100',

            'min_poin' => 'required|integer|min:0',

            'max_poin' => 'nullable|integer|gte:min_poin',

            'badge_icon' => 'nullable|max:100',

            'warna_hex' => 'required|max:20',

            'deskripsi' => 'nullable',

            'keuntungan' => 'nullable',

            'urutan' => 'required|integer|min:1',

        ]);

        $tier->update($request->all());

        return redirect()
            ->route('admin.tier.index')
            ->with(
                'success',
                'Tier berhasil diperbarui.'
            );
    }

    /**
     * Hapus
     */
    public function destroy(Tier $tier)
    {
        if ($tier->users()->exists()) {

            return back()->with(
                'warning',
                'Tier sedang digunakan oleh user.'
            );

        }

        $tier->delete();

        return back()->with(
            'success',
            'Tier berhasil dihapus.'
        );
    }
}
