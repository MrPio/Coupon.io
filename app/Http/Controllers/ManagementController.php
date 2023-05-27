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

    public function showCompanyStaff(){

        $categories = Category::all();
        $companies = Company::all();

        $company_staff = $companies[1]->name;
        $categories_name = $categories[1]->title;

        return view("add_and_edit_promotion")
            ->with('companies', $company_staff)
            ->with('categories', $categories_name);
    }

    public function showFaq()
    {
        
    }
}
