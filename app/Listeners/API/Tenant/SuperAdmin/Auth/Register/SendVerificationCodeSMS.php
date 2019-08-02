<?php

namespace App\Listeners\API\Tenant\SuperAdmin\Auth\Register;

use App\Events\API\Tenant\SuperAdmin\Auth\Register\VerificationCodeStoredEvent;
use App\Repositories\Tenant\TenantMetaData\TenantMetaDataInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationCodeSMS
{
    protected $resourceLocalizationFile;
    protected $tenantMetaDataRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TenantMetaDataInterface $tenant_meta_data_repository)
    {
        //
        $this->resourceLocalizationFile = str_replace('\\', '/', static::class);
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
        //Send SMS to Super Master
            try {

                nexmo()->message()->send([
                    'to' => $this->tenantMetaDataRepository->getMasterPhoneNumber($plus_sign = false),
                    'from' => characters_limit(remove_all_special_characters(subdomain()), 11),
                    'text' => __($this->resourceLocalizationFile . '.message', ['email' => $event->email, 'sms_verification_code' => $event->sms_verification_code])
                ]);

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
