<?php 

namespace App\Schedulers\DatabaseUpdateSchedulers\Master\SuperAdminRegistrationVerificationCodes;

use App\Repositories\Master\SuperAdminRegistrationVerificationCodes\SuperAdminRegistrationVerificationCodeInterface;

class DeleteExpiredSuperAdminRegistrationVerificationCodes
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
	
	function __invoke()
	{
		$this->superAdminRegistrationVerificationCodeRepository->deleteExpiredSuperAdminRegistrationVerificationCodes();
	}

}