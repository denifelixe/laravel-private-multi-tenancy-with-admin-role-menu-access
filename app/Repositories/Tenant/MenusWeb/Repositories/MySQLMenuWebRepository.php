<?php 

namespace App\Repositories\Tenant\MenusWeb\Repositories;

use App\Models\Tenant\MenusWeb\MenuWebModel;
use App\Repositories\Tenant\MenusWeb\MenuWebInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MySQLMenuWebRepository implements MenuWebInterface
{
	protected $menusWeb;

	/**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(MenuWebModel $menus_web)
    {
        $this->menusWeb = $menus_web;
    }

	public function getTableName()
    {
        return $this->menusWeb->getTable();
    }

    public function getAllMenusWeb()
    {
        return $this->menusWeb->all()->toArray();
    }

}