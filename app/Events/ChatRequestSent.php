<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatRequestSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $uri;

    public $style;

    public $houseType;

    /**
     * Create a new event instance.
     */
    public function __construct(User|null $user, string $uri, string $style, string $houseType)
    {
        $this->user = $user;
        $this->uri = $uri;
        $this->style = $style;
        $this->houseType = $houseType;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
