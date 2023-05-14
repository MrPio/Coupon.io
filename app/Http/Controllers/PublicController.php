<?php

namespace App\Http\Controllers;

use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\Promotion;


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

        return view('home')
            ->with('companies', $companies);
    }

    public function showCatalog()
    {
//        Promotion::all()
    }
    public function showCatalogWithCategory($category_id)
    {

    }
}
