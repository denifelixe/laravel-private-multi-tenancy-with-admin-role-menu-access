<?php

namespace App\Rules\Unique;

use App\Repositories\Tenant\SuperAdminRegistrationVerificationCodes\SuperAdminRegistrationVerificationCodeInterface;
use Illuminate\Contracts\Validation\Rule;

class TenantSuperAdminRegistrationVerificationCodesEmailApplicantUniqueRule implements Rule
{
    protected $resourceLocalizationFile;
    protected $superAdminRegistrationVerificationCodeRepository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(SuperAdminRegistrationVerificationCodeInterface $superadmin_registration_verification_code_repository)
    {
        //
        $this->resourceLocalizationFile = str_replace('\\', '/', static::class);
        $this->superAdminRegistrationVerificationCodeRepository = $superadmin_registration_verification_code_repository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        return $this->superAdminRegistrationVerificationCodeRepository->isEmailApplicantDoesNotExist($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __($this->resourceLocalizationFile . '.this_email_is_on_processing');
    }
}
