<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class core_section_custom_field_data extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_section_custom_field_data';

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
    protected $fillable = ['section_rs', 'section', 'custom_field', 'input_data'];

    public function customField()
    {
        return $this->belongsTo('Modules\Common\Entities\Customfield', 'custom_field', 'ID')->with('fieldValues');
    }
   
}
