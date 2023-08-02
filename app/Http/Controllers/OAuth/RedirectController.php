<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class RedirectController extends Controller
{
    public function __invoke($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
}
