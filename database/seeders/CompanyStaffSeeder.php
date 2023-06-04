<?php

namespace Database\Seeders;

use App\Models\Resources\Company;
use App\Models\Resources\Composition;
use App\Models\Resources\Staff;
use Illuminate\Database\Seeder;

class CompanyStaffSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::where('removed_at', null)->get();
        $staffs=Staff::all();
        foreach ($staffs as $staff) {
            for ($i = 0; $i < rand(2, 5); $i++) {
                $company = fake()->randomElement($companies)->id;
                while ($staff->companies()->wherePivot('company_id', $company)->exists())
                    $company = fake()->randomElement($companies)->id;
                $staff->companies()->attach($company);
            }
        }
    }
}
