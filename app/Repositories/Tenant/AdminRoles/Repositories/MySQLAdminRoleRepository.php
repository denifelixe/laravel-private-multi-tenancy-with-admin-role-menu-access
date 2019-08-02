<?php 

namespace App\Repositories\Tenant\AdminRoles\Repositories;

use App\Models\Tenant\AdminRoles\AdminRoleModel;
use App\Repositories\Tenant\AdminRoles\AdminRoleInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MySQLAdminRoleRepository implements AdminRoleInterface
{
	protected $adminRoles;

	/**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(AdminRoleModel $admin_roles)
    {
        $this->adminRoles = $admin_roles;
    }

	public function getTableName()
    {
        return $this->adminRoles->getTable();
    }

    public function getAllAdminRoles()
    {
        return $this->adminRoles->all()->toArray();
    }

    public function createNewRole(Request $request)
    {
        DB::transaction(function() use ($request) {
            $this->adminRoles->create([
                'name' => $request->input('name')
            ]);
        });
    }

    public function getAdminRoleById($admin_role_id)
    {
        return $this->adminRoles->find($admin_role_id)->toArray();
    }

    public function getMenusWebAccessByAdminRoleId($admin_role_id)
    {
        return DB::table('admin_role_menus_web_access')
            ->select('menus_web.*')
            ->join('menus_web', 'admin_role_menus_web_access.menu_web_id', 'menus_web.id')
            ->where('admin_role_id', $admin_role_id)
            ->where('admin_role_menus_web_access.status', 1)
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->id => $item];
        })
        ->toArray();
    }

    public function updateAdminRoleMenuWebAccessByAdminRoleId($admin_role_id, Request $request)
    {
        DB::table('admin_role_menus_web_access')
            ->where('admin_role_id', $admin_role_id)
        ->delete();

        foreach ($request->input('menu_web_ids') as $menu_web_id => $checked) {
            $checked = (int)$checked;

            DB::transaction(function() use ($admin_role_id, $menu_web_id, $checked) {
                DB::table('admin_role_menus_web_access')->insert([
                    'admin_role_id' => $admin_role_id,
                    'menu_web_id' => $menu_web_id,
                    'status' => $checked
                ]);
            });
        }
    }
}