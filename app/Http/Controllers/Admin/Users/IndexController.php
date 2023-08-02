<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke($page = 1)
    {
        $users = User::orderBy('created_at', 'DESC')
            ->paginate(20, ['*'], 'page', $page);

        return UserResource::collection($users);    
    }
}
