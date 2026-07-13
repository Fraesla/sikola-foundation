<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\PoinService;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request,PoinService $poinService)
    {
        try {

            $googleUser = Socialite::driver('google')
                            ->stateless()
                            ->user();

            $user = User::where('email', $googleUser->email)->first();

            /*
            |--------------------------------------------------------------------------
            | USER BARU
            |--------------------------------------------------------------------------
            */

            if (!$user) {

                $user = User::create([

                    'name'      => $googleUser->name,
                    'email'     => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar'    => $googleUser->avatar,
                    'password'  => null,

                    // default role
                    'role'      => 'pembeli',

                ]);

                /*
                |--------------------------------------------------------------------------
                | BONUS USER BARU
                |--------------------------------------------------------------------------
                */

                $this->poinService->tambahPoin(
                    $user,
                    config('poin.welcome_bonus'),
                    'registrasi',
                    null,
                    'Bonus registrasi'

                );

            }

            /*
            |--------------------------------------------------------------------------
            | USER SUDAH ADA
            |--------------------------------------------------------------------------
            */

            else {

                $user->update([

                    'google_id' => $googleUser->id,
                    'avatar'    => $googleUser->avatar,
                    'name'      => $googleUser->name,

                ]);

            }

            Auth::login($user);

            return match ($user->role) {

                'admin'    => redirect('/admin'),

                'relawan' => redirect('/relawan'),

                'donatur' => redirect('/donatur'),

                default   => redirect('/pembeli'),

            };

        } catch (\Exception $e) {

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
