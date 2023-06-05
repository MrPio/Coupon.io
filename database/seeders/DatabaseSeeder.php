<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Resources\Composition;
use App\Models\Resources\Coupon;
use App\Models\Resources\Promotion;
use App\Models\Resources\Staff;
use App\Models\Resources\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(100)->create();
        Staff::factory()->count(10)->create();

        $this->call([
            UserSeeder::class,
            StaffSeeder::class,
            AdminSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CompanySeeder::class,
            FaqSeeder::class,
        ]);
        $this->call(CompanyStaffSeeder::class);

        Promotion::factory()->count(170)->create();

        $this->call(CoupledSinglePromotionsSeeder::class);

        Coupon::factory()->count(100)->create();
    }
}
