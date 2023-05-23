<?php

namespace Database\Factories\Resources;

use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\composition;
use App\Models\Resources\Product;
use App\Models\Resources\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $is_coupled=rand(0,100) < 10;
        $is_flat_discount = rand(0, 1) < 0.5;
        $amount = mt_rand(20, 50);
        $starting_from = $this->faker->dateTimeBetween('now', '+1 year')->modify('-4 month');

        // NOTA: per ora non tengo conto di nessun vincolo (quindi potrebbe capitare che
        // la promozione abbia uno staff e un azienda non compatibili)
        $categories = Category::all();
        $staff = Staff::all();
        $products = Product::all();
        $companies = Company::all();
        $product=fake()->randomElement($products);
        return [
            'flat_discount' => !$is_coupled && $is_flat_discount ? mt_rand(100, $product->price/0.02)/100 : null,
            'percentage_discount' => !$is_coupled && !$is_flat_discount ? mt_rand(2, 50) : null,
            'extra_percentage_discount' => $is_coupled ? fake()->randomElement([5,10,15,20,25,30]) : null,
            'is_coupled'=>$is_coupled,
            'amount' => $amount,
            'acquired' => mt_rand(0, $amount),
            'starting_from' => $starting_from->format('Y-m-d'),
            'ends_on' => $this->faker->dateTimeBetween($starting_from, $starting_from->modify('+1 month'))->format('Y-m-d'),
            'removed_at' => null,
            'featured'=>rand(0, 1) < 0.5,
            'category_id' => fake()->randomElement($categories),
            'staff_id' => fake()->randomElement($staff),
            'product_id' =>!$is_coupled? $product: null,
            'company_id' => fake()->randomElement($companies)
        ];
    }
}
