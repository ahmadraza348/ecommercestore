<?php

namespace App\Services\Admin;

use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class CouponService
{
    public function create(array $data): Coupon
    {
        return DB::transaction(function () use ($data) {
            $coupon = Coupon::create($data);
            return $coupon;
        });
    }
}
