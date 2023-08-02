<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\ResetRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetController extends Controller
{
    public function __invoke(ResetRequest $request)
    {     
        $status = Password::reset(
            $request->only(
                'email', 
                'password', 
                'password_confirmation', 
                'token'
            ),
            function (User $user, string $password) {
                $user->password = Hash::make($password);
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
            ? response(['status' => __($status)])
            : response(['errors' => ['email' => [__($status)]]], 400);
    }
}
