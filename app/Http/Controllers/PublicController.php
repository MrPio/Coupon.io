<?php

namespace App\Http\Controllers;

use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\Coupon;
use App\Models\Resources\FAQ;
use App\Models\Resources\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

    public function showHome()
    {
        $companies = Company::all();
        $promotions = Promotion::all();
        $categories = Category::all();

        return view('home')
            ->with('companies', $companies)
            ->with('promotions', $promotions)
            ->with('categories', $categories);
    }

    public function showCatalog()
    {
        $promotions = Promotion::all()->toQuery()->paginate(14);
        $companies = Company::all()->sortByDesc(function ($company) {
            return count($company->promotions);
        });

        return view('catalogo')
            ->with('promotions', $promotions)
            ->with('companies', $companies);
    }

    public function showCompany($company_id)
    {
        $company = Company::find($company_id);
        if(!$company)
            abort(400);
        return view('azienda')
            ->with('company', $company);
    }

    public function showCatalogWithCategory($category_id)
    {
        $promotions = Promotion::whereHas('category', function ($query) use ($category_id) {
            $query->where(compact('category_id'));
        })->paginate(14);
        $companies = Company::all()->sortByDesc(function ($company) {
            return count($company->promotions);
        });

        return view('catalogo')
            ->with('promotions', $promotions)
            ->with('companies', $companies);

    }

    public function showCatalogFiltered()
    {
        $promotions = Promotion::all()->toQuery();
        $view = view('catalogo');

        if (key_exists('company_id', $_GET)) {
            $company_id = $_GET['company_id'];
            $promotions = $promotions->whereHas('company', function ($query) use ($company_id,) {
                $query->where(compact('company_id'));
            });
            $view->with('active_company', $company_id);
        }
        if (key_exists('name', $_GET)) {
            $name = $_GET['name'];
            $promotions = $promotions->whereHas('product', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
            $view->with('search_input', $name);
        }
        $promotions = $promotions->paginate(14);

        $companies = Company::all()->sortByDesc(function ($company) {
            return count($company->promotions);
        });

        return $view
            ->with('promotions', $promotions)
            ->with('companies', $companies);

    }

    public function showFaq()
    {
        $faqs = FAQ::all();

        return view('faq')
            ->with('faqs', $faqs);
    }

    public function showPromotion($category_id)
    {
        $promotion = Promotion::find($category_id);
        return view("promotion")
            ->with('promotion', $promotion);
    }

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
            ]);
            $promotion->acquired += 1;
            $promotion->save();
            return response()->json($promotion);
        }
    }

    public function showCoupon($promotion_id)
    {
        $coupon =Coupon::where('user_id', Auth::user()->id)->where('promotion_id', $promotion_id)->first();
        if (!$coupon)
            abort(400);

        return view("coupon")
            ->with('coupon', $coupon);
    }
}
