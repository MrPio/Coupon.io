<?php

namespace Database\Seeders;

use App\Models\Resources\Category;
use App\Models\Resources\Composition;
use App\Models\Resources\Promotion;
use App\Models\Resources\User;
use Illuminate\Database\Seeder;

class CoupledSinglePromotionsSeeder extends Seeder
{
    public function run(): void
    {
        $coupled_promotions = Promotion::where('is_coupled', true)->get();
        foreach ($coupled_promotions as $promotion) {
            $single_promotions = Promotion::where('is_coupled', false)->where('company_id',$promotion->company_id)->get();
            for ($i = 0; $i < rand(2, 5); $i++) {
                $single_promotion = fake()->randomElement($single_promotions)->id;
                while ($promotion->coupled()->wherePivot('single', $single_promotion)->exists())
                    $single_promotion = fake()->randomElement($single_promotions)->id;
                $promotion->coupled()->attach($single_promotion);
            }
        }
    }
}
