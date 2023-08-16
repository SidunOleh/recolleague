<?php

namespace App\Http\Controllers\Admin\ChatRequest;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatRequestUserResource;
use App\Models\ChatRequestUser;

class IndexSendingsController extends Controller
{
    public function __invoke($page = 1)
    {
        $requests = ChatRequestUser::orderBy('created_at', 'DESC')
            ->paginate(20, ['*'], 'page', $page);

        return ChatRequestUserResource::collection($requests);
    }
}
