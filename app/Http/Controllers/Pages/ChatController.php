<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\ChatRequest;
use App\Models\Content;

class ChatController extends Controller
{
    public function __invoke()
    {
        $chatRequest = ChatRequest::first();
        $content = Content::getFormatted();

        return view('pages.chat', compact('chatRequest', 'content'));
    }
}
