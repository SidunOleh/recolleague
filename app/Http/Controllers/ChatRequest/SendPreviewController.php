<?php

namespace App\Http\Controllers\ChatRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatRequest\SendPreviewRequest;
use App\Models\ChatRequest;

class SendPreviewController extends Controller
{
    public function __invoke(SendPreviewRequest $request)
    {
        $data = $request->validated();

        $request = ChatRequest::first();
        $response = $request->send(
            $data['uri']
        );

        session([
            'chat_request' => [
                'uri' => $data['uri'],
                'request_text' => $response,
            ],
        ]);

        $response = mb_substr($response, 0, 1000) . '...';
        
        $status = 200;
        if (
            $user = auth()->user() and
            (
                $user->subscribed('default') 
                // or $user->coupons()->where('status', true)->count()
            )
        ) {
            $status = 302;
        }

        return response([
            'status' => $status,
            'response' => $response,
        ]);
    }
}
