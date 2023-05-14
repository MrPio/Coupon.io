<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Resources\Account;
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
        Account::factory()->count(10)->create();
        $this->call([
            CategorySeeder::class,
            AccountSeeder::class,
            ProductSeeder::class,
            CompanySeeder::class,
            StaffSeeder::class,
            UserSeeder::class,
        ]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
