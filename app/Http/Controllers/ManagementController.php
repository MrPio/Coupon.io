<?php

namespace App\Http\Controllers;

use App\Models\Resources\Company;
use App\Models\Resources\Coupon;
use App\Models\Resources\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ManagementController extends Controller
{
    public function showCompanies(){
        $companies = Company::paginate(5);

        return view('management.companies')
            ->with('companies', $companies);
    }

    public function showCoupons(){

        $dataCorrente = Carbon::now()->copy()->subMonth();


        $coupons = Coupon::all();

        $number=0;

        foreach($coupons as $coupon){
            if ($coupon->created_at > $dataCorrente) $number+=1;
        }




        return view('management.stats')
            ->with('number', $number);

    }

}
