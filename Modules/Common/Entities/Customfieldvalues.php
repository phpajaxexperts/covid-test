<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class Customfieldvalues extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_custom_field_values';

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
    protected $fillable = ['field', 'value'];

   
}
