<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public int $promotions_count = 0;

    public function staffs()
    {
        return $this->belongsToMany(Staff::class);
    }

    public static function getNamesAssignableToStaff(): array
    {
        $companies = Company::whereNull('removed_at')->get();
        $companies_name = [];
        foreach ($companies as $company) {
            $companies_name[$company->id] = $company->name;
        }
        return $companies_name;
    }

    public static function getIdsAssignableToStaff(): array
    {
        $companies = Company::whereNull('removed_at')->get();
        $companies_ids = [];
        foreach ($companies as $company) {
            $companies_ids[] = $company->id;
        }
        return $companies_ids;
    }

    public static function getNumber()
    {
        return Company::whereNull('removed_at')->count();
    }

    public function check()
    {
        $is_staff = Auth::check() && Gate::allows('isStaff');
        return !$is_staff || Auth::user()->staff->companies()->wherePivot('company_id', $this->id)->exists();
    }
}
