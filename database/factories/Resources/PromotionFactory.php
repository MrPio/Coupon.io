<?php

namespace Database\Factories\Resources;

use App\Models\Resources\Category;
use App\Models\Resources\Company;
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
        $is_flat_discount = rand(0, 1) < 0.5;
        $amount = mt_rand(1, 100);
        $starting_from = fake()->date();

        // NOTA: per ora non tengo conto di nessun vincolo (quindi potrebbe capitare che la promozione ha uno staff e un azienda non compatibili)
        $categories = Category::all();
        $staff = Staff::all();
        $products = Product::all();
        $companies = Company::all();
        return [
            'flat_discount' => $is_flat_discount ? mt_rand(100, 10000) / 100 : null,
            'percentage_discount' => $is_flat_discount ? null : mt_rand(100, 10000) / 100,
            'amount' => $amount,
            'acquired' => mt_rand(0, $amount),
            'starting_from' => $starting_from,
            'ends_on' => fake()->date(),  // TODO: inserire una data sicuramente > della data di inizio
            'removed_at' => null,

            'category_id' => fake()->randomElement($categories),
            'staff_id' => fake()->randomElement($staff),
            'product_id' => fake()->randomElement($products),
            'company_id' => fake()->randomElement($companies)
        ];
    }
}
