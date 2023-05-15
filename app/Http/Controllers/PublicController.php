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
        $promotions=Promotion::all();
        return view('catalogo')
            ->with('promotions',$promotions);
    }

    public function showCatalogWithName($name)
    {
        $promotions=Promotion::whereHas('product', function($query) use ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        })->get();

        return view('catalogo')
            ->with('promotions',$promotions)
            ->with('search_input',$name);
    }

    public function showCatalogWithCategory($category_id)
    {
        $promotions=Promotion::whereHas('category', function($query) use ($category_id) {
            $query->where(compact('category_id'));
        })->get();

        return view('catalogo')
            ->with('promotions',$promotions);
    }
}
