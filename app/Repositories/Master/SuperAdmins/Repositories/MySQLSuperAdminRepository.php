<?php 

namespace App\Repositories\Master\SuperAdmins\Repositories;

use App\Models\Master\SuperAdmins\SuperAdminModel;
use App\Repositories\Master\SuperAdmins\SuperAdminInterface;

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