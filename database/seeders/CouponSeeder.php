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
            [
                'expiration' => 'Dell Chromebook 11.6"',
                'quantity' => 80,
                'bought' => 5,
                'promotion_id'=>1
            ],
            [
                'expiration' => 'Dell Chromebook 11.6"',
                'quantity' => 120,
                'bought' => 23,
                'promotion_id'=>2,
            ],
            [
                'expiration' => 'Dell Chromebook 11.6"',
                'quantity' => 150,
                'bought' => 50,
                'promotion_id'=>3
            ],
            [
                'expiration' => 'Dell Chromebook 11.6"',
                'quantity' => 100,
                'bought' => 30,
                'promotion_id'=>4
            ],
        ];
        foreach ($coupons as $coupon){
            Coupon::create($coupon);
        }
    }
}
