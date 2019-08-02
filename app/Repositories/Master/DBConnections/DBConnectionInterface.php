<?php 

namespace App\Repositories\Master\DBConnections;

interface DBConnectionInterface 
{
	public function getAllConnectionsIdAndName(): array;
}