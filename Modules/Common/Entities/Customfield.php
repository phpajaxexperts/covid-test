<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class Customfield extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_custom_fields';

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
    protected $fillable = ['type', 'name', 'active'];

    public function typeName()
    {
        return $this->belongsTo('Modules\Common\Entities\core_custom_field_type','type','ID');
    }

    public function fieldValues()
    {
        return $this->hasMany('Modules\Common\Entities\Customfieldvalues','field','ID');
    }

    
}
