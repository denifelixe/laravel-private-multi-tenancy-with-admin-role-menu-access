<?php

namespace App\Providers\Repositories\Tenant\SuperAdmins;

use App\Repositories\Tenant\SuperAdmins\Repositories\MySQLSuperAdminRepository;
use App\Repositories\Tenant\SuperAdmins\SuperAdminInterface;
use Illuminate\Support\ServiceProvider;

class SuperAdminServiceProvider extends ServiceProvider
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
                    SuperAdminInterface::class,
                    MySQLSuperAdminRepository::class
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
