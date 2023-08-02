<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\SendResetLinkRequest;
use Illuminate\Support\Facades\Password;

class SendResetLinkController extends Controller
{
    public function __invoke(SendResetLinkRequest $request)
    {
        $data = $request->validated();
 
        $status = Password::sendResetLink([
            'email' => $data['email'],
        ]);
    
        return $status === Password::RESET_LINK_SENT
                    ? response(['status' => __($status)])
                    : response(['errors' => ['email' => [__($status)]]], 400);
    }
}
