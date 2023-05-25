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
        $coupon_list=[];
        $number=0;

        foreach($coupons as $coupon){
            if ($coupon->created_at > $dataCorrente){
                $number+=1;
                $coupon_list[] = Promotion::find($coupon->promotion_id);

            }
        }




        return view('management.stats')
            ->with('number', $number)
            ->with('coupons', $coupon_list );

    }

}
