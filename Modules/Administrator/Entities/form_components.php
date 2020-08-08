<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;

class form_components extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'form_components';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'ID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'active'];

   
    
}
