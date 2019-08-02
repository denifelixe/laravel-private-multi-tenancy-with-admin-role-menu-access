<?php

namespace App\Providers\Repositories\Tenant\Admins;

use App\Repositories\Tenant\Admins\Repositories\MySQLAdminRepository;
use App\Repositories\Tenant\Admins\AdminInterface;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
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
                    AdminInterface::class,
                    MySQLAdminRepository::class
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
