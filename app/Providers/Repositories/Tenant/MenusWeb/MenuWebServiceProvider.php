<?php

namespace App\Providers\Repositories\Tenant\MenusWeb;

use App\Repositories\Tenant\MenusWeb\Repositories\MySQLMenuWebRepository;
use App\Repositories\Tenant\MenusWeb\MenuWebInterface;
use Illuminate\Support\ServiceProvider;

class MenuWebServiceProvider extends ServiceProvider
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
                    MenuWebInterface::class,
                    MySQLMenuWebRepository::class
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
