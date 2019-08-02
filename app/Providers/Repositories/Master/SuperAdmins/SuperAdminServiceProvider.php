<?php

namespace App\Providers\Repositories\Master\SuperAdmins;

use App\Repositories\Master\SuperAdmins\Repositories\MySQLSuperAdminRepository;
use App\Repositories\Master\SuperAdmins\SuperAdminInterface;
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
