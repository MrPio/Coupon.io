<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Resources\Categoria;
use App\Models\Resources\Category;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;


class PublicController extends Controller
{
    public function showCategorie()
    {
        $categorie = Categoria::all();

        return view('categorie')
            ->with('categorie', $categorie);
    }
}
