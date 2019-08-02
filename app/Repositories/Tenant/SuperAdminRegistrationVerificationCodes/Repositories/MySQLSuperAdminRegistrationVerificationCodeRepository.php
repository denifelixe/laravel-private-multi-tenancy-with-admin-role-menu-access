<?php 

namespace App\Repositories\Tenant\SuperAdminRegistrationVerificationCodes\Repositories;

use App\Models\Tenant\SuperAdminRegistrationVerificationCodes\SuperAdminRegistrationVerificationCodeModel;
use App\Repositories\Tenant\SuperAdminRegistrationVerificationCodes\SuperAdminRegistrationVerificationCodeInterface;
use Illuminate\Support\Facades\DB;

class MySQLSuperAdminRegistrationVerificationCodeRepository implements SuperAdminRegistrationVerificationCodeInterface
{
	protected $superAdminRegistrationVerificationCodes;

	/**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(SuperAdminRegistrationVerificationCodeModel $superadmin_registration_verification_codes)
    {
        $this->superAdminRegistrationVerificationCodes = $superadmin_registration_verification_codes;
    }

    public function storeSuperAdminRegistrationVerificationCode($email)
    {
        //
        $verification_code;
    	
        DB::transaction(function() use ($email, &$verification_code) {
	    	$created_verification_code = $this->superAdminRegistrationVerificationCodes->create([
	    		'email_applicant' => $email,
	    		'sms_verification_code' => random_numbers_with_leading_zeros(config('services.nexmo.superadmin_registration_pin_length')),
                'email_verification_code' => random_numbers_with_leading_zeros(config('services.nexmo.superadmin_registration_pin_length')),
                'expired_at' => now()->addMinutes(config('services.nexmo.superadmin_registration_pin_expiry'))
	    	]);

            $verification_code = [
                'email' => $email,
                'sms_verification_code' => $created_verification_code->sms_verification_code,
                'email_verification_code' => $created_verification_code->email_verification_code
            ];
        });


        return $verification_code;
    }

    public function deleteExpiredSuperAdminRegistrationVerificationCodes()
    {
        DB::transaction(function() {

            $this->superAdminRegistrationVerificationCodes->where('expired_at', '<', now())->delete();

        });
    }

    public function getTableName()
    {
        return $this->superAdminRegistrationVerificationCodes->getTable();
    }

    public function verifyTheVerificationCode(array $verification_code)
    {
        return $this->superAdminRegistrationVerificationCodes
                    ->where('email_applicant', $verification_code['email'])
                    ->where('sms_verification_code', $verification_code['sms_verification_code'])
                    ->where('email_verification_code', $verification_code['email_verification_code'])
                    ->first()

                    ? true : false;

    }

    public function isEmailApplicantDoesNotExist($email)
    {
        return $this->superAdminRegistrationVerificationCodes
                    ->where('email_applicant', $email)
                    ->first()

                    ? false : true;
    }
}