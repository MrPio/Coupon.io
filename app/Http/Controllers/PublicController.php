<?php

namespace App\Http\Controllers;

use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\FAQ;
use App\Models\Resources\Promotion;
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

//    public function showCatalogWithName($name)
//    {
//        $promotions = Promotion::whereHas('product', function ($query) use ($name) {
//            $query->where('name', 'like', '%' . $name . '%');
//        })->paginate(14);
//        $companies = Company::all()->sortByDesc(function ($company) {
//            return count($company->promotions);
//        });
//
//        return view('catalogo')
//            ->with('promotions', $promotions)
//            ->with('search_input', $name)
//            ->with('companies', $companies);
//
//    }

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

//    public function showCatalogWithCompany($company_id)
//    {
//        $promotions = Promotion::whereHas('company', function ($query) use ($company_id) {
//            $query->where(compact('company_id'));
//        })->paginate(14);
//        $companies = Company::all()->sortByDesc(function ($company) {
//            return count($company->promotions);
//        });
//
//        return view('catalogo')
//            ->with('promotions', $promotions)
//            ->with('active_company', $company_id)
//            ->with('companies', $companies);
//
//    }

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
}
