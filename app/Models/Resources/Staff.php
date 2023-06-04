<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'privileged'
    ];

    public function account()
    {
        return $this->hasOne(Account::class, 'id', 'id');
    }

    public function promotions(){
        return $this->hasMany(Promotion::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
