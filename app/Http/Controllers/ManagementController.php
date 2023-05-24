<?php

namespace App\Http\Controllers;

use App\Models\Resources\Company;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function showCompanies(){
        $companies = Company::paginate(5);

        return view('management.companies')
            ->with('companies', $companies);
    }
}
