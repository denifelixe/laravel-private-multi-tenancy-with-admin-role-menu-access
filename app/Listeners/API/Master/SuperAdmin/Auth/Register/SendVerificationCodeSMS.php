<?php

namespace App\Listeners\API\Master\SuperAdmin\Auth\Register;

use App\Events\API\Master\SuperAdmin\Auth\Register\VerificationCodeStoredEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationCodeSMS
{
    protected $resourceLocalizationFile;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->resourceLocalizationFile = str_replace('\\', '/', static::class);
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
                    'to' => supermaster_phone_number($plus_sign = false),
                    'from' => characters_limit(remove_all_special_characters(env('APP_NAME')), 11),
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
