<?php

namespace App\Events\API\Tenant\SuperAdmin\Auth\Register;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VerificationCodeStoredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;

    public $sms_verification_code;

    public $email_verification_code;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($verification_code)
    {
        //
        $this->email = $verification_code['email'];
        $this->sms_verification_code = $verification_code['sms_verification_code'];
        $this->email_verification_code = $verification_code['email_verification_code'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }
}
