<?php

namespace App\Listeners\ChatRequest;

use App\Events\ChatRequestSent;
use App\Models\ChatRequest;
use App\Models\ChatRequestUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChatRequestSent $event): void
    {
        if (! $user = $event->user) {
            return;
        }

        $chatRequest = ChatRequest::first();

        ChatRequestUser::create([
            'user_id' => $user->id,
            'chat_request_id' => $chatRequest->id,
            'uri' => $event->uri,
            'style' => $event->style,
        ]);
    }
}
