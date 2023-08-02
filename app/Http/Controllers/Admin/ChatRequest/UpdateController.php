<?php

namespace App\Http\Controllers\Admin\ChatRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChatRequest\UpdateRequest;
use App\Models\ChatRequest;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();

        if ($chatRequest = ChatRequest::first()) {
            $chatRequest->update($data);
        } else {
            ChatRequest::create($data);
        }
        
        return response([
            'message' => 'Request was updated successfully.',
        ]);
    }
}
