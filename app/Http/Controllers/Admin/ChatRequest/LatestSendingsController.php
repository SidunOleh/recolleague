<?php

namespace App\Http\Controllers\Admin\ChatRequest;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatRequestUserResource;
use App\Models\ChatRequestUser;

class LatestSendingsController extends Controller
{
    public function __invoke()
    {
        return ChatRequestUserResource::collection(
            ChatRequestUser::latest()
        );
    }
}
