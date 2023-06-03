<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'place',
        'logo',
        'url',
        'type',
        'color',
        'description',
        'featured',
        'removed_at'
    ];

    public function promotions(){
        return $this->hasMany(Promotion::class);
    }

    public int $promotions_count=0;

    public function staffs()
    {
        return $this->belongsToMany(Staff::class);
    }
}
