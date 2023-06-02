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

        foreach ($users as $user){
            $numberOfCoupon=Coupon::where('user_id' , $user->id)->count();
            $user->numberOfCoupon=$numberOfCoupon;

        }
        return view('management.users')
            ->with('users', $users);
    }

    public function showCoupons()
    {
        $view = view('management.stats');

        if (key_exists('time', $_GET) && $_GET['time'] == 'day') {
            $type = $_GET['time'];
            $coupons = Coupon::whereDate('created_at', Carbon::now())->get();
            $view->with('active_type', $type);
        } elseif (key_exists('time', $_GET) && $_GET['time'] == 'week') {
            $type = $_GET['time'];
            $coupons = Coupon::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $view->with('active_type', $type);
        } elseif (key_exists('time', $_GET) && $_GET['time'] == 'month') {
            $type = $_GET['time'];
            $coupons = Coupon::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
            $view->with('active_type', $type);
        } elseif (key_exists('time', $_GET) && $_GET['time'] == 'year') {
            $type = $_GET['time'];
            $coupons = Coupon::whereYear('created_at', Carbon::now()->year)->get();
            $view->with('active_type', $type);
        } else {
            $coupons = Coupon::all();
            $view->with('active_type', 'all');
        }

        $promotion_id = [];

        foreach ($coupons as $coupon) {
            $promotion = Promotion::find($coupon->promotion_id);
            if (!in_array($promotion->id, $promotion_id)) {
                $promotion_id[] = $promotion->id;
            }
        }
        $records = Promotion::whereIn('id', $promotion_id)->orderBy('ends_on', 'desc')->paginate(12);

        return $view
            ->with('number_of_coupons', count($coupons))
            ->with('number_of_promotions', count($promotion_id))
            ->with('promotions', $records);

    }

    public function deleteCompany($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect(URL::previous());
    }

    public function deleteStaff($id)
    {
        $staff = Account::findOrFail($id);  // TODO: va bene cancellarlo in questo modo?
        $staff->delete();
        return redirect(URL::previous());
    }

    public function deleteUser($id)
    {
        $user = Account::findOrFail($id);  // TODO: va bene cancellarlo in questo modo?
        $user->delete();
        return redirect(URL::previous());
    }

    public function showPromotion($category_id)
    {
        $promotion = Promotion::find($category_id);

        $coupons = Coupon::where('promotion_id', $category_id)->get();

        $couponsPerTime = [0, 0, 0, 0, 0];
        // 0-Più di un anno
        // 1-Quest'anno anno
        // 2-Questo mese
        // 3-Questa settimana
        // 4-Oggi

        foreach ($coupons as $coupon) {

            if ($coupon->created_at->isToday()) {
                $couponsPerTime[4]++;
            } elseif ($coupon->created_at->isCurrentWeek()) {
                $couponsPerTime[3]++;
            } elseif ($coupon->created_at->isCurrentMonth()) {
                $couponsPerTime[2]++;
            } elseif ($coupon->created_at->isCurrentYear()) {
                $couponsPerTime[1]++;
            } else $couponsPerTime[0]++;
        }

        return view("management.promotion_stats")
            ->with('promotion', $promotion)
            ->with('coupons', '[' . implode(', ', $couponsPerTime) . ']');
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
