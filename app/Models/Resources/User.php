<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'id'
    ];

    public function account()
    {
        return $this->hasOne(Account::class, 'id', 'id');
    }

    public function coupons(){
        return $this->hasMany(Coupon::class);
    }
}
