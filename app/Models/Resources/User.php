<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id'
    ];

    public function account()
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
}
