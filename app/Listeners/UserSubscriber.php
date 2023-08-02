<?php

namespace App\Listeners;

use App\Events\PaymentUpdated;
use App\Events\Subscribed;
use App\Mail\PaymentUpdated as MailPaymentUpdated;
use App\Mail\SignUpToAdmin;
use App\Mail\SignUpToUser;
use App\Mail\SubscriptionToAdmin;
use App\Mail\SubscriptionToUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class UserSubscriber
{
    public function signUp(Registered $event)
    {
        $user = $event->user;

        dispatch(function () use($user) {
            Mail::to($user)
                ->send(new SignUpToUser($user));
            Mail::to(env('MAIL_FROM_ADDRESS'))
                ->send(new SignUpToAdmin($user));
        })->afterResponse();
    }

    public function subscribed(Subscribed $event)
    {
        $user = $event->user;

        dispatch(function () use($user) {
            Mail::to($user)
                ->send(new SubscriptionToUser($user));
            Mail::to(env('MAIL_FROM_ADDRESS'))
                ->send(new SubscriptionToAdmin($user));
        })->afterResponse();
    }

    public function paymentUpdated(PaymentUpdated $event)
    {
        $user = $event->user;

        dispatch(function () use($user) {
            Mail::to($user)
                ->send(new MailPaymentUpdated($user));
        })->afterResponse();
    }

    public function subscribe()
    {
        return [
            Registered::class => 'signUp',
            Subscribed::class => 'subscribed',
            PaymentUpdated::class => 'paymentUpdated',
        ];
    }
}