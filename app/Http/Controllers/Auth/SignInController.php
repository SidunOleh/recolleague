<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function __invoke(SignInRequest $request)
    {
        $data = $request->validated();

        $attemp = Auth::attempt([
            'email' => $data['email'], 
            'password' => $data['password'],
            'is_active' => true,
        ]);
        if (! $attemp) {
            abort(401);
        }

        return response('OK');
    }
}
