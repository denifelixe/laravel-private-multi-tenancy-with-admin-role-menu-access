<?php 

namespace App\Repositories\Master\Tenants\Repositories;

use App\Exceptions\Tenant\NoTenantFoundException;
use App\Models\Master\Tenants\TenantModel;
use App\Repositories\Master\Tenants\TenantInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MySQLTenantRepository implements TenantInterface
{

	protected $tenants;

	/**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(TenantModel $tenants)
    {
        $this->tenants = $tenants;
    }

    public function getAllTenants()
    {
        return $this->tenants->all()->toArray();
    }

    public function getDatabaseConnectionDriverBySubdomain(string $subdomain): string
    {
        $tenant = $this->tenants->where('subdomain', $subdomain)->first();

        if (!$tenant) {
            throw new NoTenantFoundException;
        }

        return $tenant->db_connection_model->connection_name;
    }

    public function getDatabaseConnectionBySubdomain(string $subdomain): array
    {
        $connection = $this->tenants->where('subdomain', $subdomain)->first();

        if (!$connection) {
            throw new NoTenantFoundException;
        }

        return [
            'connection' => $connection->db_connection_model->connection_name,
            'url' => $connection->db_url,
            'host' => $connection->db_host,
            'port' => $connection->db_port,
            'database' => $connection->db_name,
            'username' => $connection->db_username,
            'password' => $connection->db_password,
            'socket' => $connection->db_socket,
            'foreign_keys' => $connection->db_foreign_keys
        ];
    }

    public function getTenantIdBySubdomain(string $subdomain): string
    {
        $tenant = $this->tenants->where('subdomain', $subdomain)->first();

        return $tenant->id;
    }

    public function createNewTenant(Request $request): void
    {
        DB::transaction(function() use ($request) {
            $this->tenants->create([
                'subdomain' => $request->input('subdomain'),
                'db_connection' => $request->input('db_connection'),
                'db_url' => $request->input('db_url'),
                'db_host' => $request->input('db_host'),
                'db_port' => $request->input('db_port'),
                'db_name' => $request->input('db_name'),
                'db_username' => $request->input('db_username'),
                'db_password' => encrypt($request->input('db_password')),
                'db_socket' => $request->input('db_socket'),
                'db_foreign_keys' =>$request->input('db_foreign_keys') 
            ]);
        });
    }
}