<?php

namespace Database\Seeders;

use App\Models\Resources\Account;
use App\Models\Resources\Admin;
use App\Models\Resources\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account_info = [
            'name' => 'user',
            'surname' => 'user',
            'username' => 'user',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  // password
            'gender' => 'male',
            'birth' => '2001-01-01',
            'phone' => '90-60-90',
            'email' => 'user@user.com',
            'last_access' => now(),
            'image_path' => null
        ];
        $account = Account::create($account_info);
        $user = [
            'id' => $account->id
        ];
        User::create($user);
    }
}
