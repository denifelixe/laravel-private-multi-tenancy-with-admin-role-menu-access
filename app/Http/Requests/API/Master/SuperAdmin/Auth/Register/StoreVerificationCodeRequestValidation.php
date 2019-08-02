<?php

namespace App\Http\Requests\API\Master\SuperAdmin\Auth\Register;

use App\Repositories\Master\SuperAdmins\SuperAdminInterface;
use App\Rules\Unique\MasterSuperAdminRegistrationVerificationCodesEmailApplicantUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVerificationCodeRequestValidation extends FormRequest
{
    protected $superAdminRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SuperAdminInterface $superadmin_repository)
    {
        //
        $this->superAdminRepository = $superadmin_repository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $superadmins_table = $this->superAdminRepository->getTableName();
        return [
            'email' => [
                'bail',
                'required', 
                'string', 
                'email',
                "unique:{$superadmins_table},email",
                resolve(MasterSuperAdminRegistrationVerificationCodesEmailApplicantUniqueRule::class)
            ]
        ];
    }
}
