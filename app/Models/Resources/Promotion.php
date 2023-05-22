<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

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
}
