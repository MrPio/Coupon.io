<?php

namespace App\Http\Controllers;

use App\Models\Resources\Category;
use Illuminate\Routing\Controller;


class PublicController extends Controller
{
    public function showCategories()
    {
        $categories = Category::all();

        return view('categories')
            ->with('categories', $categories);
    }
}
