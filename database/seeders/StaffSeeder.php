<?php

namespace Database\Seeders;

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
        $account = AccountFactory::new()->create();
        $privileged_staff = [
            'privileged' => true,
            'account_id' => $account->id
        ];
        Staff::create($privileged_staff);
    }
}
