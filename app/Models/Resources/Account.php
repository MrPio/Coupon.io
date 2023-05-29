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
        'password',
        'email',
        'gender',
        'birth',
        'phone',
        'last_access',
        'remember_token'
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
        if ($this->user)
            return 'user';
        if ($this->staff)
            return 'staff';
        if ($this->admin)
            return 'admin';
        return null;
    }

    protected static function booted()
    {
        static::retrieved(function ($model) {
            $model->last_access = now(); // Update 'last_access' field with the current timestamp
            $model->save(); // Save the model with the updated 'last_access' value
        });
    }
}
