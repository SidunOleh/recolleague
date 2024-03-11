<?php

namespace App\Http\Controllers\Coupons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupons\ApplyRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyController extends Controller
{
    public function __invoke(ApplyRequest $request)
    {
        $coupon = Coupon::firstWhere('coupon', $request->input('coupon'));
        $user = $request->user();

        $coupon->use($user);
        
        $user->createTrialPeriod();

        return response('OK');
    }
}
