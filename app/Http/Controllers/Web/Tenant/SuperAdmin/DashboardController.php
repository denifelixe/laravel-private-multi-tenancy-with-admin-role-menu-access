<?php

namespace App\Http\Controllers\Web\Tenant\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Repositories\Tenant\Admins\AdminInterface;
use App\Repositories\Tenant\AdminRoles\AdminRoleInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $adminRepository;
    protected $adminRoleRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminInterface $admin_repository, AdminRoleInterface $admin_role_repository)
    {
        //
        $this->adminRepository = $admin_repository;

        $this->adminRoleRepository = $admin_role_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->adminRepository->getAllAdminsWithRole();

        $admin_roles = $this->adminRoleRepository->getAllAdminRoles();

        return view('tenant.superadmin.dashboard', compact('admins', 'admin_roles'));
    }
}
