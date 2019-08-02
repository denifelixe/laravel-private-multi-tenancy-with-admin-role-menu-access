<?php

namespace App\Models\Tenant\MenusWeb;

use Illuminate\Database\Eloquent\Model;

class MenuWebModel extends Model
{
    //

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'menus_web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'sort', 'name', 'url', 'icon', 'description', 'status'
    ];
}
