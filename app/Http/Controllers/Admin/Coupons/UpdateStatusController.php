<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Http\Controllers\Controller;
use App\Models\Coupon;

class UpdateStatusController extends Controller
{
    public function __invoke(Coupon $coupon)
    {
        $coupon->status = ! $coupon->status;
        $coupon->save();

        return response('OK');
    }
}
