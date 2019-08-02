<?php

namespace App\Providers\Repositories\Master\Tenants;

use App\Repositories\Master\Tenants\TenantInterface;
use App\Repositories\Master\Tenants\Repositories\MySQLTenantRepository;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
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
                    TenantInterface::class,
                    MySQLTenantRepository::class
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
