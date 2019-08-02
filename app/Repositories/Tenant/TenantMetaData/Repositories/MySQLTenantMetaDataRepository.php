<?php 

namespace App\Repositories\Tenant\TenantMetaData\Repositories;

use App\Models\Tenant\TenantMetaData\TenantMetaDataModel;
use App\Repositories\Tenant\TenantMetaData\TenantMetaDataInterface;

class MySQLTenantMetaDataRepository implements TenantMetaDataInterface
{
	protected $tenantMetaData;

	/**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(TenantMetaDataModel $tenant_meta_data)
    {
        $this->tenantMetaData = $tenant_meta_data;
    }

	public function getTableName()
    {
        return $this->tenantMetaData->getTable();
    }

    public function getTenantMetaData()
    {
        return $this->tenantMetaData->first();
    }

    public function getMasterEmail()
    {
        return $this->getTenantMetaData()->master_email;
    }

    public function getMasterPhoneNumber($plus_sign = true)
    {
        $master_country_phone_code = $plus_sign ? $this->getMasterCountryPhoneCode() : str_replace('+', '', $this->getMasterCountryPhoneCode());

        $master_phone_number = substr($this->getTenantMetaData()->master_phone_number, 1);

        return $master_country_phone_code . $master_phone_number;
    }

    public function getMasterCountryPhoneCode()
    {
        return $this->getTenantMetaData()->master_country_phone_code;
    }
}