<?php

namespace Database\Seeders;

use App\Models\Resources\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons = [
        ];
        foreach ($coupons as $coupon){
            Coupon::create($coupon);
        }
    }
}
