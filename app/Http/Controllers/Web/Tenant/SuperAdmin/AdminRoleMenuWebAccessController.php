<?php

namespace App\Http\Controllers\Web\Tenant\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Tenant\SuperAdmin\AdminRoleMenuWebAccess\UpdateRequestValidation;
use App\Repositories\Tenant\AdminRoles\AdminRoleInterface;
use App\Repositories\Tenant\MenusWeb\MenuWebInterface;

class AdminRoleMenuWebAccessController extends Controller
{
    //

    protected $adminRoleRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminRoleInterface $admin_role_repository, MenuWebInterface $menu_web_repository)
    {
        //
        $this->adminRoleRepository = $admin_role_repository;
        $this->menuWebRepository = $menu_web_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminRoleMenuWebAccessByAdminRoleId($tenant_subdomain, $admin_role_id)
    {
        $admin_role = $this->adminRoleRepository->getAdminRoleById($admin_role_id);

        $menus_web = $this->menuWebRepository->getAllMenusWeb();

        $menus_web_access = $this->adminRoleRepository->getMenusWebAccessByAdminRoleId($admin_role_id);

        return view('tenant.superadmin.admin_role_menu_web_access.index', compact('admin_role', 'menus_web', 'menus_web_access'));
    }

    public function showAdminRoleMenuWebAccessByAdminRoleIdEditForm($tenant_subdomain, $admin_role_id)
    {
        $admin_role = $this->adminRoleRepository->getAdminRoleById($admin_role_id);

        $menus_web = $this->menuWebRepository->getAllMenusWeb();

        $menus_web_access = $this->adminRoleRepository->getMenusWebAccessByAdminRoleId($admin_role_id);

        return view('tenant.superadmin.admin_role_menu_web_access.edit', compact('admin_role', 'menus_web', 'menus_web_access'));
    }

    public function updateAdminRoleMenuWebAccessByAdminRoleId($tenant_subdomain, UpdateRequestValidation $request, $admin_role_id)
    {
        $this->adminRoleRepository->updateAdminRoleMenuWebAccessByAdminRoleId($admin_role_id, $request);

        return redirect()->route('web.tenant.superadmin.admin_role_menu_web_access', ['tenant' => subdomain(), 'admin_role_id' => $admin_role_id]);
    }
}
