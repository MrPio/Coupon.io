<?php

namespace App\Http\Controllers;

use App\Models\Resources\Company;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function showCompanies(){
        $companies = Company::all();

        return view('management.companies')
            ->with('companies', $companies);
    }
}
