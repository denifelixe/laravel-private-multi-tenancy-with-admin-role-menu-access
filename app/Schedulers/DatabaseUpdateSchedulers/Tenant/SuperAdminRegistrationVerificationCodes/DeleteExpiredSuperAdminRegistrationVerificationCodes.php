<?php 

namespace App\Schedulers\DatabaseUpdateSchedulers\Tenant\SuperAdminRegistrationVerificationCodes;

use App\Repositories\Master\Tenants\TenantInterface;
use App\Configurations\DatabaseConfiguration;
use App\Repositories\Tenant\SuperAdminRegistrationVerificationCodes\SuperAdminRegistrationVerificationCodeInterface;

class DeleteExpiredSuperAdminRegistrationVerificationCodes
{
    protected $tenantRepository;
    protected $superAdminRegistrationVerificationCodeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TenantInterface $tenant_repository, SuperAdminRegistrationVerificationCodeInterface $superadmin_registration_verification_code_repository)
    {
        //
        $this->tenantRepository = $tenant_repository;
        $this->superAdminRegistrationVerificationCodeRepository = $superadmin_registration_verification_code_repository;
    }
    
    function __invoke()
    {
        foreach ($this->tenantRepository->getAllTenants() as $tenant) {
            
            DatabaseConfiguration::resetConnectionToTenantDatabase($tenant['subdomain']);

            $this->superAdminRegistrationVerificationCodeRepository->deleteExpiredSuperAdminRegistrationVerificationCodes();

        }
    }

}