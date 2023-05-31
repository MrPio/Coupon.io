<?php

namespace App\Http\Controllers;

use App\Models\Resources\Account;
use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\Coupon;
use App\Models\Resources\Promotion;
use App\Models\Resources\Staff;
use App\Models\Resources\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class ManagementController extends Controller
{
    public function showCompanies()
    {
        $companies = Company::paginate(5);

        return view('management.companies')
            ->with('companies', $companies);
    }

    public function showStaff()
    {
        $staff = Staff::paginate(5);

        return view('management.staff')
            ->with('staff', $staff);
    }

    public function showUsers()
    {
        $users = User::paginate(10);

        return view('management.users')
            ->with('users', $users);
    }

    public function showCoupons()
    {

        $dataCorrente = Carbon::now()->copy()->subMonth();

        $coupons = Coupon::all();
        $promotion_id = [];
        $number = 0;

        foreach ($coupons as $coupon) {
            if ($coupon->created_at > $dataCorrente) {
                $number += 1;
                $promotion= Promotion::find($coupon->promotion_id);
                if(!in_array($promotion->id, $promotion_id)) {
                    $promotion_id[] = $promotion->id;
                }
            }
        }
        $records = Promotion::whereIn('id', $promotion_id )->orderBy('ends_on', 'desc')->paginate(12);

        return view('management.stats')
            ->with('number_of_coupons', $number)
            ->with('number_of_promotions', count($promotion_id))
            ->with('promotions', $records);

    }

    public function deleteCompany($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect(URL::previous());
    }

    public function deleteStaff($id) {
        $staff = Account::findOrFail($id);  // TODO: va bene cancellarlo in questo modo?
        $staff->delete();
        return redirect(URL::previous());
    }

    public function deleteUser($id) {
        $user = Account::findOrFail($id);  // TODO: va bene cancellarlo in questo modo?
        $user->delete();
        return redirect(URL::previous());
    }

    public function showPromotion($category_id)
    {
        $promotion = Promotion::find($category_id);


        $coupons = Coupon::where('promotion_id', $category_id)->get();

        $dataCorrente = Carbon::now()->day;
        $couponsPerDay=[0,0,0,0,0,0,0,0];

        foreach ($coupons as $coupon) {

            if ($dataCorrente - $coupon->created_at->day < 7) $couponsPerDay[$dataCorrente - $coupon->created_at->day]+=1;
            else $couponsPerDay[7]+=1;


        }

        return view("management.promotion_stats")
            ->with('promotion', $promotion)
            ->with('coupons', '[' . implode(', ', $couponsPerDay) . ']');
    }

//    public function showCompanyStaff(){
//
//        $categories = Category::all();
//        $companies = Company::all();
//
//        $company_staff = $companies[1]->name;
//        $categories_name = $categories[1]->title;
//
//        return view("add_and_edit_promotion")
//            ->with('companies', $company_staff)
//            ->with('categories', $categories_name);
//    }

    public function showFaq()
    {

    }
}
