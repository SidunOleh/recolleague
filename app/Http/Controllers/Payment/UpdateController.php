<?php

namespace App\Http\Controllers\Payment;

use App\Events\PaymentUpdated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        $paymentMethodId = $request->input('payment_method_id');

        Auth::user()->updateDefaultPaymentMethod($paymentMethodId);

        PaymentUpdated::dispatch(Auth::user());

        return response('OK');
    }
}
