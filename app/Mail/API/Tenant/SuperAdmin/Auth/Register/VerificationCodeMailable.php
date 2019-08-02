<?php

namespace App\Mail\API\Tenant\SuperAdmin\Auth\Register;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationCodeMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $email_verification_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $email_verification_code)
    {
        //
        $this->email = $email;
        $this->email_verification_code = $email_verification_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.api.tenant.superadmin.auth.register.verification_code_mailable')->with('email', $this->email)->with('email_verification_code', $this->email_verification_code);
    }
}
