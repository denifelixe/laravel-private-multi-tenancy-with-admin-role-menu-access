<?php

namespace App\Listeners\API\Master\SuperAdmin\Auth\Register;

use App\Events\API\Master\SuperAdmin\Auth\Register\VerificationCodeStoredEvent;
use App\Mail\API\Master\SuperAdmin\Auth\Register\VerificationCodeMailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationCodeEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

                Mail::to(env('SUPERMASTER_EMAIL'))->send(new VerificationCodeMailable($event->email, $event->email_verification_code));

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
