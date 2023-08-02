<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;
use App\Models\Coupon;

class StoreController extends Controller
{
    public function __invoke()
    {
        $coupon = Coupon::create(['coupon' => Coupon::make(),]);
        $coupon->refresh();

        return CouponResource::make($coupon);
    }
}
