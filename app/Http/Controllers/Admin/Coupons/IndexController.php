<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;
use App\Models\Coupon;

class IndexController extends Controller
{
    public function __invoke($page = 1)
    {
        $coupons = Coupon::orderBy('created_at', 'DESC')
            ->paginate(20, ['*'], 'page', $page);

        return CouponResource::collection($coupons);
    }
}
