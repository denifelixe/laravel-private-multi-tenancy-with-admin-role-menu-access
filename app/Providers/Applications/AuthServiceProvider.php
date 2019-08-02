<?php

namespace App\Providers\Applications;

use App\Repositories\Tenant\Admins\AdminInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
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

        //

        Gate::define('view-admin-dashboard', function($admin) {

            $admin_repository = resolve(AdminInterface::class);

            return $admin_repository->hasMenuWebAccessByAdminId($admin->id, 1/*Menu Dashboard*/);
        });

    }
}
