<?php

namespace App\Providers\Repositories\Master\SuperAdminRegistrationVerificationCodes;

use App\Repositories\Master\SuperAdminRegistrationVerificationCodes\Repositories\MySQLSuperAdminRegistrationVerificationCodeRepository;
use App\Repositories\Master\SuperAdminRegistrationVerificationCodes\SuperAdminRegistrationVerificationCodeInterface;
use Illuminate\Support\ServiceProvider;

class SuperAdminRegistrationVerificationCodeServiceProvider extends ServiceProvider
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
                    SuperAdminRegistrationVerificationCodeInterface::class,
                    MySQLSuperAdminRegistrationVerificationCodeRepository::class
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
