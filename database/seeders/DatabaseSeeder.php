<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            StaffSeeder::class,
            AdminSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CompanySeeder::class
        ]);

        Promotion::factory()->count(100)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
