<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'username',
        'password'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id', 'id');
    }

    public function role()
    {
        if ($this->user())
            return 'user';
        if ($this->staff())
            return 'staff';
        if ($this->admin())
            return 'admin';
        else
            return null;
    }
}
