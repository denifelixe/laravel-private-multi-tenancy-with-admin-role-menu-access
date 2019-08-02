<?php

namespace App\Http\Controllers\Web\Tenant\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Tenant\SuperAdmin\AdminRole\CreateRequestValidation;
use App\Repositories\Tenant\AdminRoles\AdminRoleInterface;

class AdminRoleController extends Controller
{
    //

    protected $adminRoleRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminRoleInterface $admin_role_repository)
    {
        //
        $this->adminRoleRepository = $admin_role_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateRoleForm()
    {
        return view('tenant.superadmin.admin_role.create');
    }

    public function createRole(CreateRequestValidation $request)
    {
        $this->adminRoleRepository->createNewRole($request);

        return redirect()->route('web.tenant.superadmin.dashboard', ['tenant' => subdomain()]);
    }
}
