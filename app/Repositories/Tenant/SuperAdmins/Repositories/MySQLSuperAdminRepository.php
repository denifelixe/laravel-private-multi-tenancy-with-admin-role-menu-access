<?php 

namespace App\Repositories\Tenant\SuperAdmins\Repositories;

use App\Models\Tenant\SuperAdmins\SuperAdminModel;
use App\Repositories\Tenant\SuperAdmins\SuperAdminInterface;

class MySQLSuperAdminRepository implements SuperAdminInterface
{
	protected $superAdmins;

	/**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(SuperAdminModel $superadmins)
    {
        $this->superAdmins = $superadmins;
    }

	public function getTableName()
    {
        return $this->superAdmins->getTable();
    }
}