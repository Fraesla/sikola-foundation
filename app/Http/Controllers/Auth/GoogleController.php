<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->email],
                [
                    'name'      => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'avatar'    => $googleUser->avatar,
                    'password'  => null,
                ]
            );

            // Set role default jika baru, tambah poin welcome
            if (!$user->role) {
                $user->update(['role' => 'pembeli']);
                app(TierService::class)->tambahPoin($user, 10); // welcome bonus
            }

            Auth::login($user);
            return redirect()->intended('/dashboard');

        } catch (Exception $e) {
            return redirect('/')->with('error', 'Login Google gagal. Silakan coba lagi.');
        }
    }
}
