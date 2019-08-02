<?php

namespace App\Models\Master\DBConnections;

use Illuminate\Database\Eloquent\Model;

class DBConnectionModel extends Model
{
    //

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'db_connections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'connection_name'
    ];
}
