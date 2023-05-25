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

    public function showHome()
    {
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

    public function showCompany($company_id)
    {
        $company = Company::find($company_id);
        if (!$company)
            abort(400);
        return view('azienda')
            ->with('company', $company);
    }

    public function showCatalog()
    {
        $promotions = Promotion::all()->toQuery();
        $companies = Company::all();
        $view = view('catalogo');

        if (key_exists('name', $_GET)) {
            $name = $_GET['name'];

            $promotions = $promotions
                ->where(function ($query) use ($name) {
                    $query->where(function ($query) use ($name) {
                        $query->where('is_coupled', true)
                            ->whereHas('coupled', function ($query) use ($name) {
                                $query->whereHas('product', function ($query) use ($name) {
                                    $query->where('name', 'like', '%' . $name . '%');
                                });
                            });
                    })
                        ->orWhereHas('product', function ($query) use ($name) {
                            $query->where('name', 'like', '%' . $name . '%');
                        });
                });
            $view->with('active_name', $name);
        }

        if (key_exists('category_id', $_GET) && $_GET['category_id'] != -1) {
            $category_id = $_GET['category_id'];
            $promotions = $promotions
                ->whereHas('category', function ($query) use ($category_id) {
                    $query->where('category_id', $category_id);
                });
            $view->with('active_category', $category_id);
        }

        if (key_exists('type', $_GET) && $_GET['type'] != 'all') {
            $type = $_GET['type'];
            $promotions = $promotions->get()->where('is_coupled', $type == 'coupled')->toQuery();
            $view->with('active_type', $type);
        }

//        $start = microtime(true);

        $promotions_list = $promotions->get();
        $promotions_ids = array_column($promotions_list->toArray(), 'id');
        foreach ($companies as $company) {
            $promotions_count = 0;
            foreach ($company->promotions as $promotion)
                if (in_array($promotion->id, $promotions_ids))
                    ++$promotions_count;
            $company->promotions_count = $promotions_count;
        };
        $companies = $companies->sortByDesc(function ($company) {
            return $company->promotions_count;
        });

//        dd((microtime(true) - $start) * 1000);

        if (key_exists('company_id', $_GET) && $_GET['company_id'] != -1) {
            $company_id = $_GET['company_id'];
            $promotions = $promotions->where('company_id', $company_id);
            $view->with('active_company', $company_id);
        }

        if (count($promotions->get()) > 0)
            $promotions = $promotions->get()->sortBy(function ($promotion) {
                return $promotion->ends_on;
            })->toQuery()->paginate(20);
        else
            $promotions = $promotions->paginate(20);

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
