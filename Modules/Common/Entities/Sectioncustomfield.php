<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class Sectioncustomfield extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'section_custom_fields';

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
    protected $fillable = ['section_rs', 'section', 'custom_field'];

    public function custom_field()
    {
        return $this->belongsTo('App\core_custom_fields');
    }
    
}
