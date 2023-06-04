<?php

namespace App\Models;

use App\Models\Resources\Category;
use App\Models\Resources\Company;
use App\Models\Resources\Product;
use App\Models\Resources\Promotion;
use Illuminate\Database\Eloquent\Collection;

class Catalog
{
    /**
     * Filter the promotions by their name
     */
    public function byName($query, $name)
    {
        return $query
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
    }

    /**
     * Filter the promotions by their category
     */
    public function byCategory($query, $category_id)
    {
        return $query->whereHas('category', function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        });
    }

    /**
     * Filter the promotions by their type (single, coupled)
     */
    public function byType($query, $type)
    {
        return $query->where('is_coupled', $type == 'coupled');
    }

    /**
     * Retrieve the list of companies ordered by the number of their promotions
     */
    public function companiesWithCount($promotions): Collection
    {
        $companies=Company::where('removed_at', null)->get();
        $promotions_ids = $promotions->pluck('id')->toArray();
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
        return $companies;
    }

    public function getSingleIdName(): array
    {
        $promotions_array = [];
        $promotions = Promotion::where('is_coupled', false)
            ->join('products', 'promotions.product_id', '=', 'products.id')
            ->select('promotions.id', 'products.name')
            ->get();
        foreach ($promotions->toArray() as $item) {
            $key = $item['id'];
            $value = $item['name'];
            $promotions_array[$key] = $value;
        }
        return $promotions_array;
    }
}
