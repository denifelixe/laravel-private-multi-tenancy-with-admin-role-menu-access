<?php

namespace App\Models\Tenant\TenantMetaData;

use Illuminate\Database\Eloquent\Model;

class TenantMetaDataModel extends Model
{
    //

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'tenant_meta_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_email', 'master_phone_number', 'master_country_phone_code'
    ];
}
