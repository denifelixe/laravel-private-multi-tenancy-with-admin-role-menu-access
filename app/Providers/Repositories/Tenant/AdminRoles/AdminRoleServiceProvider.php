<?php

namespace App\Providers\Repositories\Tenant\AdminRoles;

use App\Repositories\Tenant\AdminRoles\Repositories\MySQLAdminRoleRepository;
use App\Repositories\Tenant\AdminRoles\AdminRoleInterface;
use Illuminate\Support\ServiceProvider;

class AdminRoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        switch (env('DB_CONNECTION')) {
            case 'mysql':
                
                $this->app->bind(
                    AdminRoleInterface::class,
                    MySQLAdminRoleRepository::class
                );

                break;
            
            default:
                break;
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
