<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donasi;
use App\Models\Order;
use App\Models\EventRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{

    public function index()
    {
        // Total Donasi Berhasil
        $totalDonasi = Donasi::where('status', 'dikonfirmasi')
            ->sum('jumlah');

        // Total Order
        $totalOrder = Order::count();

        // Total Relawan
        $totalRelawan = User::where('role', 'relawan')->count();

        // Pending
        $pending =
            Donasi::where('status','menunggu')->count()
            + Order::where('status','menunggu_konfirmasi')->count()
            + EventRegistrasi::where('status','mendaftar')->count();

        /*
        |--------------------------------------------------------------------------
        | Grafik Donasi Bulanan
        |--------------------------------------------------------------------------
        */

        $chart = Donasi::selectRaw("
                    MONTH(created_at) as bulan,
                    SUM(jumlah) as total
                ")
                ->where('status','dikonfirmasi')
                ->whereYear('created_at', now()->year)
                ->groupBy('bulan')
                ->pluck('total','bulan');

        $labels = [];
        $data = [];

        for($i=1;$i<=12;$i++){

            $labels[] = date('M', mktime(0,0,0,$i,1));

            $data[] = $chart[$i] ?? 0;
        }

        /*
        |--------------------------------------------------------------------------
        | Pending Notification
        |--------------------------------------------------------------------------
        */

        $pendingDonasi = Donasi::where('status','menunggu')->count();

        $pendingOrder = Order::where('status','menunggu_konfirmasi')->count();

        $pendingRelawan = EventRegistrasi::where('status','mendaftar')->count();

        return view('admin.dashboard.index', compact(
            'totalDonasi',
            'totalOrder',
            'totalRelawan',
            'pending',
            'labels',
            'data',
            'pendingDonasi',
            'pendingOrder',
            'pendingRelawan'
        ));
    }

    public function profile()
    {
         return view('admin.dashboard.profile', [
            'user' => Auth::user()
        ]);
    }

     /*
    |--------------------------------------------------------------------------
    | Update Profil
    |--------------------------------------------------------------------------
    */

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('avatar')) {

            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {

                Storage::disk('public')->delete($user->avatar);

            }

            $user->avatar = $request
                ->file('avatar')
                ->store('profile', 'public');

        }

        $user->update([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'avatar' => $user->avatar,

        ]);

        return redirect()->route('admin.dashboard')->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }

    public function password()
    {
        return view('admin.dashboard.password');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {

            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai.'
            ]);

        }

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.dashboard')->with('success','Password berhasil diperbarui.');
    }
}
