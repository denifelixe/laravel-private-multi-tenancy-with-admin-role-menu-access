<?php

namespace App\Providers\Repositories\Tenant\TenantMetaData;

use App\Repositories\Tenant\TenantMetaData\Repositories\MySQLTenantMetaDataRepository;
use App\Repositories\Tenant\TenantMetaData\TenantMetaDataInterface;
use Illuminate\Support\ServiceProvider;

class TenantMetaDataServiceProvider extends ServiceProvider
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
                    TenantMetaDataInterface::class,
                    MySQLTenantMetaDataRepository::class
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
