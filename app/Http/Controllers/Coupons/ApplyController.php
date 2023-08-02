<?php

namespace App\Http\Controllers\Coupons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupons\ApplyRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyController extends Controller
{
    public function __invoke(ApplyRequest $requets)
    {
        $coupon = Coupon::firstWhere(
            'coupon',
            $requets->validated()['coupon']
        );

        if (! $coupon) {
            abort(400);
        }

        $coupon->user()->associate(Auth::user());
        $coupon->save();

        return response('OK');
    }
}
