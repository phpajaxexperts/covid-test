<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;

class form_section_components extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'form_section_components';

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
    protected $fillable = ['section', 'form_component','position'];

    public function componentName()
    {
        return $this->belongsTo('Modules\Administrator\Entities\form_components', 'form_component', 'ID');
    }
    
}
