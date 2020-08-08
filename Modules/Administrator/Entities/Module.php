<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'administrator_modules';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'module_config_name','category','active'];

    
}
