<?php

namespace Database\Seeders;

use App\Models\Resources\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'admin' => true,
            'name' => 'admin',
            'surname' => 'admin',
            'username' => 'admin-admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  // password
            'gender' => 'male',
            'birth' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'last_access' => now(),  // TODO: randomize last_access; potrebbe servire così come potrebbe non servire
            'removed_at' => null
        ];
        Account::create($admin);
    }
}
