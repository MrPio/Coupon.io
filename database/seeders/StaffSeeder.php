<?php

namespace Database\Seeders;

use App\Models\Resources\Account;
use App\Models\Resources\Staff;
use Database\Factories\Resources\AccountFactory;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create privileged staff
        $account_info = [
            'name' => 'staff',
            'surname' => 'staff',
            'username' => 'staff',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  // password
            'gender' => 'male',
            'birth' => '2001-01-01',
            'phone' => '90-60-90',
            'email' => 'staff@staff.com',
            'last_access' => now()
        ];
        $account = Account::create($account_info);
        $privileged_staff = [
            'privileged' => true,
            'id' => $account->id
        ];
        Staff::create($privileged_staff);
    }
}
