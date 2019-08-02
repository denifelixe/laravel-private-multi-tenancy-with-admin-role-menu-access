<?php

namespace App\Models\Tenant\AdminRoles;

use Illuminate\Database\Eloquent\Model;

class AdminRoleModel extends Model
{
    //

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'admin_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
