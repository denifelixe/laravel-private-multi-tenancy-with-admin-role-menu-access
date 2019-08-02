<?php 

namespace App\Repositories\Tenant\Admins\Repositories;

use App\Models\Tenant\Admins\AdminModel;
use App\Repositories\Tenant\Admins\AdminInterface;
use Illuminate\Support\Facades\DB;

class MySQLAdminRepository implements AdminInterface
{
	protected $admins;

	/**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(AdminModel $admins)
    {
        $this->admins = $admins;
    }

	public function getTableName()
    {
        return $this->admins->getTable();
    }

    public function getAllAdmins()
    {
        return $this->admins->all()->toArray();
    }

    public function getAllAdminsWithRole()
    {
        return $this->admins->with('role')->get()->toArray();
    }

    public function hasMenuWebAccessByAdminId($admin_id, $menu_web_id)
    {
        return DB::table('admins')
            ->join('admin_role_menus_web_access', 'admins.admin_role_id', 'admin_role_menus_web_access.admin_role_id')
            ->where('admin_role_menus_web_access.menu_web_id', $menu_web_id)
            ->where('status', 1)
        ->first()

        ? true : false;

    }
}