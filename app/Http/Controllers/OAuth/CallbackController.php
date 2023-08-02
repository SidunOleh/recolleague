<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class CallbackController extends Controller
{
    public function __invoke($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();

        $user = User::where('email', $socialiteUser->email)
            ->firstOr(function () use($socialiteUser) {
                $newUser = User::create([
                    'name' => $socialiteUser->name,
                    'email' => $socialiteUser->email,
                ]);

                event(new Registered($newUser));

                return $newUser;
            });

        $user->refresh();
        
        if (! $user->is_active) {
            return redirect()->route('pages.home');
        }
        
        Auth::login($user);

        return redirect()->route('pages.chat');
    }
}
