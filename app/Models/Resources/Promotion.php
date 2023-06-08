<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function coupled()
    {
        return $this->belongsToMany(Promotion::class,
            'coupled_single_promotions', 'coupled', 'single');
    }

    public function is_expired()
    {
        return strtotime($this->ends_on) < time();
    }

    public function is_deleted()
    {
        return $this->removed_at!==null;
    }

    public static function selectablePromotions($company_id) {
        $promotions_array = [];
        $promotions = Promotion::whereNull('removed_at')
            ->where('is_coupled', false)
            ->where('company_id', $company_id)
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
