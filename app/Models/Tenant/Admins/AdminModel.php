<?php

namespace App\Models\Tenant\Admins;

use App\Models\Tenant\AdminRoles\AdminRoleModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Authenticatable
{
    //

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role_id', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    //

    public function role()
    {
        return $this->hasOne(AdminRoleModel::class, 'id', 'admin_role_id');
    }
}
