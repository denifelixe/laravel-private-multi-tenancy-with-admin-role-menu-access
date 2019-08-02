<?php 

namespace App\Repositories\Master\DBConnections\Repositories;

use App\Models\Master\DBConnections\DBConnectionModel;
use App\Repositories\Master\DBConnections\DBConnectionInterface;

class MySQLDBConnectionRepository implements DBConnectionInterface 
{
	protected $db_connections;

	public function __construct(DBConnectionModel $db_connections)
	{
		$this->db_connections = $db_connections;
	}

	public function getAllConnectionsIdAndName(): array
	{
		return $this->db_connections->all()->pluck('connection_name', 'id')->all();
	}
}