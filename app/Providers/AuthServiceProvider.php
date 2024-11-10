<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

 Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['admin']);
        });

        Gate::define('add-users', function($user){
            return $user->hasAnyRoles(['admin','penyelaras']);
        });
        Gate::define('edit-users', function($user){
            return $user->hasAnyRoles(['admin','penyelaras']);
        });

        Gate::define('delete-users', function($user){
            return $user->hasRoles('admin');
        });

         Gate::define('for-admin', function($user){
            return $user->hasRoles('admin');
        });

         Gate::define('for-admin-koordinator', function($user){
            return $user->hasAnyRoles(['admin','koordinator']);
        });

         Gate::define('for-pengguna', function($user){
            return $user->hasRoles('penyelaras');
        });

         Gate::define('for-koordinator', function($user){
            return $user->hasRoles('koordinator');
        });
    }
}
