<?php

namespace Database\Factories\Resources;

use App\Models\Resources\Coupon;
use App\Models\Resources\Promotion;
use App\Models\Resources\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resources\Account>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $promotions = Promotion::all();
        $users = User::all();
        $promotion = fake()->randomElement($promotions);

        $promotion->acquired++;
        $promotion->save();

        return ['user_id' => fake()->randomElement($users)->id,
            'promotion_id' => $promotion->id,
            'uuid' => ''];

    }
}
