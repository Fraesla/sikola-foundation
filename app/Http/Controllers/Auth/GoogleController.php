<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {

            $googleUser = Socialite::driver('google')
                            ->stateless()
                            ->user();

            // Cari user berdasarkan email
            $user = User::where('email', $googleUser->email)->first();

            // Jika user belum ada
            if (!$user) {

                $user = User::create([
                    'name'      => $googleUser->name,
                    'email'     => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar'    => $googleUser->avatar,
                    'password'  => null,

                    // default pembeli
                    'role'      => 'pembeli'
                ]);

                // bonus poin user baru
                app(TierService::class)
                    ->tambahPoin($user, 10);
            }

            // Jika user sudah ada cukup update data google
            else {

                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar'    => $googleUser->avatar,
                    'name'      => $googleUser->name,
                ]);

                /*
                 JANGAN UPDATE ROLE DI SINI
                 supaya jika role = donatur
                 tetap menjadi donatur
                */
            }

            Auth::login($user);

            // Redirect berdasarkan role
            switch ($user->role) {

                case 'relawan':
                    return redirect('/relawan');

                case 'donatur':
                    return redirect('/donatur');

                default:
                    return redirect('/pembeli');
            }

        } catch (Exception $e) {

            return redirect('/')
                ->with(
                    'error',
                    'Login Google gagal. Silakan coba lagi.'
                );
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
