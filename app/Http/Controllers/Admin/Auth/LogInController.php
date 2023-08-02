<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LogInRequest;
use Illuminate\Support\Facades\Auth;

class LogInController extends Controller
{
    public function __invoke(LogInRequest $request)
    {
        $data = $request->validated();

        $attemp = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
            'is_active' => true,
            'is_admin' => true,
        ]);
        if (! $attemp) {
            abort(401);
        }

        return response('OK');
    }
}
