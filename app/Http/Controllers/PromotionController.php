<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionStoreRequest;
use App\Models\Catalog;
use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    protected $_catalogModel;

    public function __construct()
    {
        $this->_catalogModel = new Catalog;
    }


    public function index()
    {
        $promotions = Promotion::all()->toQuery();
        $companies = Company::all();
        $view = view('resources.promozioni.index');

        if (key_exists('name', $_GET)) {
            $name = $_GET['name'];
            $promotions = $this->_catalogModel->byName($promotions, $name);
            $view->with('active_name', $name);
        }

        if (key_exists('category_id', $_GET) && $_GET['category_id'] != -1) {
            $category_id = $_GET['category_id'];
            $promotions = $this->_catalogModel->byCategory($promotions, $category_id);
            $view->with('active_category', $category_id);
        }

        if (key_exists('type', $_GET) && $_GET['type'] != 'all') {
            $type = $_GET['type'];
            $promotions = $this->_catalogModel->byType($promotions, $type);
            $view->with('active_type', $type);
        }

        $companies = $this->_catalogModel->companiesWithCount($promotions->get());

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

    public function create()
    {
        return view('resources.promozioni.create_edit')
            ->with('companies',Auth::user()->staff->companies)
            ->with('categories',Category::all());
    }

    public function store(PromotionStoreRequest $request)
    {
        dd($request);
    }

    public function show($id)
    {
        $promotion = Promotion::find($id);
        if ($promotion == null)
            abort(400);
        return view("resources.promozioni.show")
            ->with('promotion', $promotion);
    }

    public function edit($id)
    {
        $promotion = Promotion::find($id);
        if ($promotion == null)
            abort(400);
        return view('resources.promozioni.create_edit')
            ->with('companies',Auth::user()->staff->companies)
            ->with('categories',Category::all())
            ->with('promotion',$promotion);
    }

    /*   public function update(Request $request, $id)
      {
          //
      }

      public function destroy($id)
      {
          //
      }*/
}
