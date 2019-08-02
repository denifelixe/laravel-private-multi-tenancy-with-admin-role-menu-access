<?php

namespace App\Http\Controllers\API\Tenant\SuperAdmin\Auth;

use App\Events\API\Tenant\SuperAdmin\Auth\Register\VerificationCodeStoredEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Tenant\SuperAdmin\Auth\Register\StoreVerificationCodeRequestValidation;
use App\Repositories\Tenant\SuperAdminRegistrationVerificationCodes\SuperAdminRegistrationVerificationCodeInterface;
use Exception;

class RegisterController extends Controller
{
    protected $superAdminRegistrationVerificationCodeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SuperAdminRegistrationVerificationCodeInterface $superadmin_registration_verification_code_repository)
    {
        //
        $this->superAdminRegistrationVerificationCodeRepository = $superadmin_registration_verification_code_repository;
    }

    public function storeVerificationCode(StoreVerificationCodeRequestValidation $request)
    {
        //put into database
            try {
                
                $verification_code = $this->superAdminRegistrationVerificationCodeRepository->storeSuperAdminRegistrationVerificationCode($request->input('email'));

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

        //send the sms and email
        event(new VerificationCodeStoredEvent($verification_code));

        return json_response([
            'httpStatusCode' => 200,
            'status' => 'success',
            'statusDetail' => 'Store Applicant Verification Code Success',
            'data' => []
        ]);
    }
}
