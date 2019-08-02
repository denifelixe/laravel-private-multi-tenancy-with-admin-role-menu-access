<?php

namespace App\Providers\Applications;

use App\Events\API\Master\SuperAdmin\Auth\Register\VerificationCodeStoredEvent as MasterSuperAdminRegistrationVerificationCodeStoredEvent;
use App\Listeners\API\Master\SuperAdmin\Auth\Register\SendVerificationCodeEmail as MasterSuperAdminRegistrationSendVerificationCodeEmail;
use App\Listeners\API\Master\SuperAdmin\Auth\Register\SendVerificationCodeSMS as MasterSuperAdminRegistrationSendVerificationCodeSMS;

use App\Events\API\Tenant\SuperAdmin\Auth\Register\VerificationCodeStoredEvent as TenantSuperAdminRegistrationVerificationCodeStoredEvent;
use App\Listeners\API\Tenant\SuperAdmin\Auth\Register\SendVerificationCodeEmail as TenantSuperAdminRegistrationSendVerificationCodeEmail;
use App\Listeners\API\Tenant\SuperAdmin\Auth\Register\SendVerificationCodeSMS as TenantSuperAdminRegistrationSendVerificationCodeSMS;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MasterSuperAdminRegistrationVerificationCodeStoredEvent::class => [
            MasterSuperAdminRegistrationSendVerificationCodeEmail::class,
            MasterSuperAdminRegistrationSendVerificationCodeSMS::class,
        ],
        TenantSuperAdminRegistrationVerificationCodeStoredEvent::class => [
            TenantSuperAdminRegistrationSendVerificationCodeEmail::class,
            TenantSuperAdminRegistrationSendVerificationCodeSMS::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
