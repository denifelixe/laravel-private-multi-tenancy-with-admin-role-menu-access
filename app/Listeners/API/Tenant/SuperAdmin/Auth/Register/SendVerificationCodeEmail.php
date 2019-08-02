<?php

namespace App\Listeners\API\Tenant\SuperAdmin\Auth\Register;

use App\Events\API\Tenant\SuperAdmin\Auth\Register\VerificationCodeStoredEvent;
use App\Mail\API\Tenant\SuperAdmin\Auth\Register\VerificationCodeMailable;
use App\Repositories\Tenant\TenantMetaData\TenantMetaDataInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationCodeEmail
{
    protected $tenantMetaDataRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TenantMetaDataInterface $tenant_meta_data_repository)
    {
        //
        $this->tenantMetaDataRepository = $tenant_meta_data_repository;
    }

    /**
     * Handle the event.
     *
     * @param  SuperAdminRegistrationVerificationCodeStored  $event
     * @return void
     */
    public function handle(VerificationCodeStoredEvent $event)
    {
        //Send Email to Super Master
            try {

                Mail::to($this->tenantMetaDataRepository->getMasterEmail())->send(new VerificationCodeMailable($event->email, $event->email_verification_code));
                
            } catch (Exception $e) {

                return json_response([
                    'httpStatusCode' => 500,
                    'status' => 'failed',
                    'statusDetail' => 'Exception Thrown',
                    'data' => [
                        'exceptionMessage' => $e->getMessage()
                    ]
                ]);

            }
        //
    }
}
