<?php

namespace Database\Seeders;

use App\Models\Resources\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $staffs = [
            ['account_id'=>7],
            ['account_id'=>8,'privileged'=>true],
            ['account_id'=>9],
            ['account_id'=>10],
        ];
        foreach ($staffs as $staff){
            Staff::create($staff);
        }
    }
}
