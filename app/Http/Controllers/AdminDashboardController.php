<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donasi;
use App\Models\Order;
use App\Models\RiwayatLanggananPembayaran;
use App\Services\DonasiService;
use App\Models\EventRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{

    public function index(DonasiService $donasiService)
    {
        /*
        |--------------------------------------------------------------------------
        | TOTAL DONASI
        |--------------------------------------------------------------------------
        */

        $totalDonasi = $donasiService->totalDana();

        /*
        |--------------------------------------------------------------------------
        | GRAFIK DONASI
        |--------------------------------------------------------------------------
        */

        $chart = $donasiService->chartTahunan();

        $labels = $chart['labels'];

        $data = $chart['data'];

        /*
        |--------------------------------------------------------------------------
        | TOTAL ORDER
        |--------------------------------------------------------------------------
        */

        $totalOrder = Order::count();

        /*
        |--------------------------------------------------------------------------
        | TOTAL RELAWAN
        |--------------------------------------------------------------------------
        */

        $totalRelawan = User::where('role', 'relawan')->count();

        /*
        |--------------------------------------------------------------------------
        | TOTAL PENDING
        |--------------------------------------------------------------------------
        */

        $pendingDonasi = Donasi::where('status', 'menunggu')->count();

        $pendingOrder = Order::where('status', 'menunggu_konfirmasi')->count();

        $pendingRelawan = EventRegistrasi::where('status', 'mendaftar')->count();

        $pending =
            $pendingDonasi
            + $pendingOrder
            + $pendingRelawan;

        return view(
            'admin.dashboard.index',
            compact(
                'totalDonasi',
                'totalOrder',
                'totalRelawan',
                'pending',
                'labels',
                'data',
                'pendingDonasi',
                'pendingOrder',
                'pendingRelawan'
            )
        );
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
