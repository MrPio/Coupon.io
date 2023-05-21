<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($account) {
            return $account->admin;
        });

        Gate::define('isPrivilegedStaff', function ($account) {
           return  $account->staff->privileged;
        });

        Gate::define('isStaff', function ($account) {
            return $account->staff;
        });

        Gate::define('isUser', function ($account) {
            return $account->user;
        });
    }
}
