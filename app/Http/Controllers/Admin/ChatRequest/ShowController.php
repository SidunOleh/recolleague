<?php

namespace App\Http\Controllers\Admin\ChatRequest;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatRequestResource;
use App\Models\ChatRequest;

class ShowController extends Controller
{
    public function __invoke()
    {
        if (! $chatRequest = ChatRequest::first()) {
            $chatRequest = new ChatRequest;
        }
        
        return ChatRequestResource::make($chatRequest);
    }
}
