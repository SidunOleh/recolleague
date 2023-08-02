<?php

namespace App\Providers;

use App\Events\ChatRequestSent;
use App\Listeners\ChatRequest\CountListener;
use App\Listeners\ChatRequest\LogListener;
use App\Listeners\ChatRequest\SaveListener;
use App\Listeners\UserSubscriber;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        ChatRequestSent::class => [
            CountListener::class,
            LogListener::class,
            SaveListener::class,
        ],
    ];

    protected $subscribe = [
        UserSubscriber::class,
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
