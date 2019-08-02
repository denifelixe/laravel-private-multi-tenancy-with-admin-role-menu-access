<?php

namespace App\Http\Controllers\Web\Tenant\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Tenant\SuperAdmin\Admin\Register\RegisterRequestValidation;
use App\Models\Tenant\Admins\AdminModel;
use App\Repositories\Tenant\AdminRoles\AdminRoleInterface;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{	
    //

    protected $roleRepository;

	public function __construct(AdminRoleInterface $role_repository)
	{
		//
        $this->roleRepository = $role_repository;
	}

    public function showAdminRegistrationForm()
    {
        $roles = $this->roleRepository->getAllAdminRoles();

    	return view('tenant.admin.auth.register', compact('roles'));
    }

    public function adminRegister(RegisterRequestValidation $request)
    {
        $admin_created = AdminModel::create([
            'name' => $request->input('name'),
            'role_id' => $request->input('role_id') ?: null,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('web.tenant.superadmin.dashboard', ['tenant' => subdomain()]);
    }
}
