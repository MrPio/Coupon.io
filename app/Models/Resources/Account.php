<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'username',
        'password'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id', 'account_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'id', 'account_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'id', 'account_id');
    }
}
