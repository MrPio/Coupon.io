<?php

namespace App\Http\Controllers;

use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\Coupon;
use App\Models\Resources\FAQ;
use App\Models\Resources\Promotion;
use App\Models\Resources\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Psy\Readline\Hoa\Console;


class PublicController extends Controller
{
    public function showCategories()
    {
        $categories = Category::all();

        return view('categories')
            ->with('categories', $categories);
    }

    public function showCompanies()
    {
        $companies = Company::all();

        return view('aziende')
            ->with('companies', $companies);
    }



    public function showCompany($company_id)
    {
        $company = Company::find($company_id);
        if (!$company)
            abort(400);
        return view('azienda')
            ->with('company', $company);
    }

    public function showFaq()
    {
        $faqs = FAQ::all();

        return view('faq')
            ->with('faqs', $faqs);
    }

    /*    public function showPromotion($category_id)
        {
            $promotion = Promotion::find($category_id);
            return view("promotion")
                ->with('promotion', $promotion);
        }*/

    public function storeCoupon(Request $request)
    {
        $id = $request['promotion_id'];
        $promotion = Promotion::find($id);
        if (Coupon::where('user_id', Auth::user()->id)->where('promotion_id', $id)->exists())
            return response()->json(['error' => 'user already has that coupon'], 400);
        if ($promotion->amount > $promotion->acquired) {
            Coupon::create([
                'user_id' => Auth::user()->id,
                'promotion_id' => $id,
                'uuid' => ''
            ]);
            $promotion->acquired += 1;
            $promotion->save();
            return response()->json($promotion);
        }
    }

    public function showCoupon($promotion_id)
    {
        $coupon = Coupon::where('user_id', Auth::user()->id)->where('promotion_id', $promotion_id)->first();
        if (!$coupon)
            abort(400);

        return view("coupon")
            ->with('coupon', $coupon);
    }
}
