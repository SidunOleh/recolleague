<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class UpdateStatusController extends Controller
{
    public function __invoke(User $user)
    {
        $user->is_active = ! $user->is_active;
        $user->save();

        return response('OK');
    }
}
