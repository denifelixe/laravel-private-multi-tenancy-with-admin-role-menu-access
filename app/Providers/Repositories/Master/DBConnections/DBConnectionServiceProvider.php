<?php

namespace App\Providers\Repositories\Master\DBConnections;

use App\Repositories\Master\DBConnections\DBConnectionInterface;
use App\Repositories\Master\DBConnections\Repositories\MySQLDBConnectionRepository;
use Illuminate\Support\ServiceProvider;

class DBConnectionServiceProvider extends ServiceProvider
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
                    DBConnectionInterface::class,
                    MySQLDBConnectionRepository::class
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
