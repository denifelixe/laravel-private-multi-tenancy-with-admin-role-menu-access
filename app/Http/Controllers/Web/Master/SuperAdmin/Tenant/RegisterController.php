<?php

namespace App\Http\Controllers\Web\Master\SuperAdmin\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Master\SuperAdmin\Tenant\Register\RegisterRequestValidation;
use App\Repositories\Master\DBConnections\DBConnectionInterface;
use App\Repositories\Master\Tenants\TenantInterface;

class RegisterController extends Controller
{
	protected $dbConnectionRepository;
	
	protected $tenantsRepository;

    //
	public function __construct(DBConnectionInterface $db_connection_repository, TenantInterface $tenant_repository)
	{
		$this->dbConnectionRepository = $db_connection_repository;
		$this->tenantsRepository = $tenant_repository;
	}


    public function showTenantRegistrationForm()
    {
    	$db_connections = $this->dbConnectionRepository->getAllConnectionsIdAndName();

    	return view('master.superadmin.tenant.register', compact('db_connections'));
    }

    public function tenantRegister(RegisterRequestValidation $request)
    {
        $this->tenantsRepository->createNewTenant($request);

        return redirect(env('APP_PROTOCOL') . $request->input('subdomain') . '.' . env('APP_ROOT_DOMAIN'));
    }
}
