<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class core_section_files extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_section_files';

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
    protected $fillable = ['section_rs', 'section', 'type', 'title', 'description', 'file'];

    public function typeName()
    {
        return $this->belongsTo('Modules\Common\Entities\core_file_type', 'type', 'ID');
    }
   
}
