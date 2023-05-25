<?php

namespace App\Http\Controllers;

use App\Models\Resources\Company;
use App\Models\Resources\Coupon;
use App\Models\Resources\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ManagementController extends Controller
{
    public function showCompanies()
    {
        $companies = Company::paginate(5);

        return view('management.companies')
            ->with('companies', $companies);
    }

    public function showCoupons()
    {

        $dataCorrente = Carbon::now()->copy()->subMonth();

        $coupons = Coupon::all();
        $promotion_list = [];
        $number = 0;

        foreach ($coupons as $coupon) {
            if ($coupon->created_at > $dataCorrente) {
                $number += 1;
                $promotion_list[] = Promotion::find($coupon->promotion_id);
            }
        }

        return view('management.stats')
            ->with('number', $number)
            ->with('promotions', $promotion_list);

    }

    public function deleteCompany($id){
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect('/admin/aziende');
    public function showPromotion($category_id)
    {
        $promotion = Promotion::find($category_id);


        $coupons = Coupon::where('promotion_id', $category_id)->get();



        $dataCorrente = Carbon::now()->day;
        $couponsPerDay=[0,0,0,0,0,0,0,0];

        foreach ($coupons as $coupon) {


            switch ($dataCorrente - $coupon->created_at->day) {
                case '0':
                    $couponsPerDay[0]+=1;
                    break;
                case '1':
                    $couponsPerDay[1]+=1;
                    break;
                case '2':
                    $couponsPerDay[2]+=1;
                    break;
                case '3':
                    $couponsPerDay[3]+=1;
                    break;
                case '4':
                    $couponsPerDay[4]+=1;
                    break;
                case '5':
                    $couponsPerDay[5]+=1;
                    break;
                case '6':
                    $couponsPerDay[6]+=1;
                    break;
                default:
                    $couponsPerDay[7]+=1;
                    break;
            }
        }

        return view("management.promotion_stats")
            ->with('promotion', $promotion)
            ->with('coupons', '[' . implode(', ', $couponsPerDay) . ']');
    }

}
