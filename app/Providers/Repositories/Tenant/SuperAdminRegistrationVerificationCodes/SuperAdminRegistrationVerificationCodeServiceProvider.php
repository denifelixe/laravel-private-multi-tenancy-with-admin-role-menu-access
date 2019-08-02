<?php

namespace App\Providers\Repositories\Tenant\SuperAdminRegistrationVerificationCodes;

use App\Repositories\Tenant\SuperAdminRegistrationVerificationCodes\Repositories\MySQLSuperAdminRegistrationVerificationCodeRepository;
use App\Repositories\Tenant\SuperAdminRegistrationVerificationCodes\SuperAdminRegistrationVerificationCodeInterface;
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
