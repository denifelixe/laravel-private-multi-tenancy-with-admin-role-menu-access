<?php

namespace App\Models\Master\SuperAdminRegistrationVerificationCodes;

use Illuminate\Database\Eloquent\Model;

class SuperAdminRegistrationVerificationCodeModel extends Model
{
    //

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'superadmin_registration_verification_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_applicant', 'sms_verification_code', 'email_verification_code', 'expired_at'
    ];
}
