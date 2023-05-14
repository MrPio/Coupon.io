<?php

namespace Database\Seeders;

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
        $users = [
            ['account_id'=>1],
            ['account_id'=>2],
            ['account_id'=>3],
            ['account_id'=>4],
            ['account_id'=>5],
            ['account_id'=>6],
        ];
        foreach ($users as $user){
            User::create($user);
        }
    }
}
