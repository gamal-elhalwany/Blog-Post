<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            // this provider_user is coming from the provider such like Google or Facebook with his information.

            $provided_user = Socialite::driver($provider)->user();
            $user = User::where([
                'provider' => $provider,
                'provider_id' => $provided_user->id,
                ])->first();

            if (!$user) {
                $createdUser = User::firstOrCreate([
                    'name' => $provided_user->name,
                    'email' => $provided_user->email,
                    'password' => Hash::make(Str::random(8)),
                    'provider' => $provider,
                    'provider_id' => $provided_user->id,
                    'provider_token' => $provided_user->token,
                ]);
                Auth::login($createdUser);
                return redirect()->route('home');
            }
            Auth::login($user);
            return redirect()->route('home');

        } catch (Exception $e) {
            throw $e;
        }
    }
}