<?php 

namespace App\Repositories\Master\Tenants;

use App\Http\Requests\Web\Master\Auth\TenantRegisterController\TenantRegisterRequestValidation;
use Illuminate\Http\Request;

interface TenantInterface 
{
	public function getDatabaseConnectionDriverBySubdomain(string $subdomain): string;

	public function getDatabaseConnectionBySubdomain(string $subdomain): array;

	public function getTenantIdBySubdomain(string $subdomain): string;

	public function createNewTenant(Request $request): void;
}