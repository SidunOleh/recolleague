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
        $couponStr = $request->input('coupon');
        $coupon = Coupon::where([
            'coupon' => $couponStr,
            'status' => true,
        ])->first();
        if ( $couponStr and ! $coupon ) {
            return response([
                'error' => 'Error. Coupon is invalid.',
            ], 400);
        }

        $paymentMethodId = $request->input('payment_method_id');

        $subscription = Auth::user()->newSubscription(
            'default', 'price_1NRjiOJD6zVsEplV6p2xSVKp'
        );
        if ($coupon) {
            $subscription->trialDays(30)->create($paymentMethodId);
            $coupon->user()->associate(Auth::user());
            $coupon->save();
        } else {
            $subscription->create($paymentMethodId);
        }

        Subscribed::dispatch(Auth::user());

        return response('OK');
    }
}
