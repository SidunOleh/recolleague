<?php

namespace App\Http\Controllers\ChatRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatRequest\SendRequest;
use App\Models\ChatRequest;
use Illuminate\Support\Facades\Auth;

class SendController extends Controller
{
    public function __invoke(SendRequest $request)
    {
        $data = $request->validated();
        
        $request = ChatRequest::first();
        $response = $request->send(
            $data['uri'],
            $data['style'] ?? '',
        );

        // Auth::user()->deactivateCoupon();

        return response([
            'response' => $response,
        ]);
    }
}
