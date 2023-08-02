<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;

class ResetFormController extends Controller
{
    public function __invoke(string $token)
    {
        return view('pages.reset-password', compact('token'));
    }
}
