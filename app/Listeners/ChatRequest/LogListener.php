<?php

namespace App\Listeners\ChatRequest;

use App\Events\ChatRequestSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogListener
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
        
        Log::channel('requests')->info('', [
            'user_id' => $user->id,
            'ip' => request()->ip(),
            'uri' => $event->uri,
            'style' => $event->style,
        ]);
    }
}
