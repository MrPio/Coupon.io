<?php

namespace Database\Seeders;

use App\Models\Resources\Account;
use App\Models\Resources\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account_info = [
            'name' => 'admin',
            'surname' => 'admin',
            'username' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  // password
            'gender' => 'male',
            'birth' => '2001-01-01',
            'phone' => '90-60-90',
            'email' => 'admin@admin.com',
            'last_access' => now()
        ];
        $account = Account::create($account_info);
        $admin = [
            'account_id' => $account->id
        ];
        Admin::create($admin);
    }
}
