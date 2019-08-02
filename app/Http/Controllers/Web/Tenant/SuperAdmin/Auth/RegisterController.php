<?php

namespace App\Http\Controllers\Web\Tenant\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Tenant\SuperAdmin\Auth\Register\RegisterRequestValidation;
use App\Models\Tenant\SuperAdmins\SuperAdminModel;
use App\Repositories\Tenant\SuperAdminRegistrationVerificationCodes\SuperAdminRegistrationVerificationCodeInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Nexmo;

class RegisterController extends Controller
{
    //
    protected $resourceLocalizationFile;
    protected $superAdminRegistrationVerificationCodeRepository;

    /**
     * Create a new controller instance.
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSuperAdminRegistrationForm()
    {
        return view('tenant.superadmin.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SuperAdminRegister(RegisterRequestValidation $request)
    {
        if (!$this->superAdminRegistrationVerificationCodeRepository->verifyTheVerificationCode($request->only('email', 'sms_verification_code', 'email_verification_code'))) {

            throw ValidationException::withMessages([
                'sms_verification_code' => [__($this->resourceLocalizationFile . '.verifying_sms_failed')],
                'email_verification_code' => [__($this->resourceLocalizationFile . '.verifying_email_failed')],
            ]);

        }

        $superadmin_created = SuperAdminModel::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::guard('web_tenant_superadmin')->login($superadmin_created);

        return redirect()->route('web.tenant.superadmin.dashboard', ['tenant' => subdomain()]);
    }
}
