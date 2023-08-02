<?php

namespace App\Listeners\ChatRequest;

use App\Events\ChatRequestSent;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CountListener
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

        $user->increment('requests_count', 1);
        $user->last_request = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();
    }
}
