<?php

namespace App\Http\Controllers\Payment;

use App\Events\Subscribed;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function __invoke(Request $request)
    {
        $paymentMethodId = $request->input('payment_method_id');

        $user = $request->user();
        $subscription = $user->newSubscription('default', 'price_1NRjiOJD6zVsEplV6p2xSVKp');
        $subscription->create($paymentMethodId);

        Subscribed::dispatch(Auth::user());

        return response('OK');
    }
}
