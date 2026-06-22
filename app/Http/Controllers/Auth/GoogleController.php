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
            $googleUser = Socialite::driver('google')->stateless()->user();

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
            return redirect()->intended('/admin/dashboard');

        } catch (Exception $e) {
            return redirect('/')->with('error', 'Login Google gagal. Silakan coba lagi.');
        }
    }
}
