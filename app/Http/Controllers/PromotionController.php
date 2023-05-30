<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionStoreRequest;
use App\Models\Catalog;
use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\Product;
use App\Models\Resources\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class PromotionController extends Controller
{
    protected $_catalogModel;

    public function __construct()
    {
        $this->_catalogModel = new Catalog;
    }


    public function index()
    {
        $promotions = Promotion::where('removed_at', null);
        $view = view('resources.promozioni.index');
        $is_public = Gate::allows('isPublic');

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
            $promotions = $promotions->orderBy('created_at', 'desc');

        return $view
            ->with('promotions', $promotions->paginate(20))
            ->with('companies', $companies);
    }

    public function create()
    {
        $is_coupled = key_exists('coupled', $_GET) && $_GET['coupled'];
        $promotions_array = $is_coupled ? $this->_catalogModel->getSingleIdName() : [];

        return view('resources.promozioni.create_edit')
            ->with('companies', Auth::user()->staff->companies)
            ->with('categories', Category::all())
            ->with('is_coupled', $is_coupled)
            ->with('promotions', $promotions_array);
    }

    public function store(PromotionStoreRequest $request)
    {
        $request = $request->validated();

        if ($request['is_coupled']) {
            $promotion = Promotion::create($request);

            $coupled = array_intersect_key($request, ['promotion_1' => '', 'promotion_2' => '', 'promotion_3' => '', 'promotion_4' => '']);
            foreach ($coupled as $item)
                if (!$promotion->coupled()->wherePivot('single', $item)->exists())
                    $promotion->coupled()->attach($item);
        } else {
            $discount = $request['discount'];
            if ($request['discount_type'] == 'percentage')
                $discount = min(100, $discount);
            $promotion = Promotion::create([
                ($request['discount_type'] == 'flat' ? 'flat' : 'percentage') . '_discount' => $discount,
                ($request['discount_type'] == 'flat' ? 'percentage' : 'flat') . '_discount' => null,
                'company_id' => $request['company_id'],
                'category_id' => $request['category_id'],
                'starting_from' => $request['starting_from'],
                'ends_on' => $request['ends_on'],
                'amount' => $request['amount'],
            ]);
            $product = Product::create([
                'name' => $request['product_name'],
                'price' => $request['product_price'],
                'url' => $request['product_url'],
                'image_path' => $request['product_image_path'],
                'description' => $request['product_description'],
            ]);
            $promotion->update([
                'product_id' => $product->id,
                'staff_id' => Auth::user()->id
            ]);
        }

        return response()->json([
            'redirect' => route('promozioni.show', $promotion->id),
        ]);
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
        $promotions_array = $promotion->is_coupled ? $this->_catalogModel->getSingleIdName() : [];

        return view('resources.promozioni.create_edit')
            ->with('companies', Auth::user()->staff->companies)
            ->with('categories', Category::all())
            ->with('promotion', $promotion)
            ->with('is_coupled', $promotion->is_coupled)
            ->with('promotions', $promotions_array);
    }

    public function update(PromotionStoreRequest $request, $id)
    {
        $request = $request->validated();
        $promotion = Promotion::find($id);

        if ($request['is_coupled']) {
            $promotion->update($request);

            $coupled = array_intersect_key($request, ['promotion_1' => '', 'promotion_2' => '', 'promotion_3' => '', 'promotion_4' => '']);
            $promotion->coupled()->detach();

            foreach ($coupled as $item)
                if ($item!=0 and !$promotion->coupled()->wherePivot('single', $item)->exists())
                    $promotion->coupled()->attach($item);
        } else {
            $discount = $request['discount'];
            if ($request['discount_type'] == 'percentage')
                $discount = min(100, $discount);

            $promotion->update([
                ($request['discount_type'] == 'flat' ? 'flat' : 'percentage') . '_discount' => $discount,
                ($request['discount_type'] == 'flat' ? 'percentage' : 'flat') . '_discount' => null,
                'company_id' => $request['company_id'],
                'category_id' => $request['category_id'],
                'starting_from' => $request['starting_from'],
                'ends_on' => $request['ends_on'],
                'amount' => $request['amount'],
            ]);
            $promotion->product->update([
                'name' => $request['product_name'],
                'price' => $request['product_price'],
                'url' => $request['product_url'],
                'image_path' => $request['product_image_path'],
                'description' => $request['product_description'],
            ]);
        }

        return response()->json([
            'redirect' => route('promozioni.show', $id),
        ]);
    }

    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        $promotion->removed_at = date('Y-m-d', time());
        $promotion->save();
    }
}
