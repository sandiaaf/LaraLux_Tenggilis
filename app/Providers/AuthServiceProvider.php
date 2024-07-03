<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;


// use Illuminate\Support\Facades\Gate;
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
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate::define('delete-permission', function($user){
        //     return ($user->role == 'owner');
        // });

        Gate::define('permission-owner','App\Policies\TypePolicy@permissionOwner');
        Gate::define('permission-staff','App\Policies\TypePolicy@permissionStaff');
        Gate::define('permission-customer','App\Policies\TypePolicy@permissionCustomer');
        Gate::define('permission-ownerstaff','App\Policies\TypePolicy@permissionOwnerStaff');

      
    }
}
