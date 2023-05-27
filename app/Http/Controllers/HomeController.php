<?php

namespace App\Http\Controllers;

use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\Coupon;
use App\Models\Resources\FAQ;
use App\Models\Resources\Promotion;
use App\Models\Resources\Staff;
use App\Models\Resources\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Psy\Readline\Hoa\Console;


class HomeController extends Controller
{
    public function showHome()
    {
        if (Gate::allows('isStaff')){
         $staff=Auth::user()->staff;
            return view('home_staff')
                ->with('companies_count', count($staff->companies))
                ->with('promotions_count',Promotion::where('staff_id',$staff->id)->where('is_coupled',false)->count())
                ->with('promotions_coupled_count',Promotion::where('staff_id',$staff->id)->where('is_coupled',true)->count());
        }

        elseif (Gate::allows('isAdmin'))
            return view('home_admin')
                ->with('companies_count', Company::count())
                ->with('staffs_count',Staff::count())
                ->with('users_count',User::count())
                ->with('promotions_count',Promotion::count())
                ->with('faqs_count',Faq::count());

        $companies = Company::all();
        $promotions = Promotion::where('is_coupled', false)
            ->where('featured', true)
            ->take(20)
            ->get();
        $categories = Category::all();

        return view('home')
            ->with('companies', $companies)
            ->with('promotions', $promotions)
            ->with('categories', $categories);
    }
}
