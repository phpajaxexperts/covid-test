<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class core_section_meta_detail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_section_meta_detail';

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
    protected $fillable = ['section_rs', 'section', 'meta_title', 'meta_keywords', 'meta_description'];

   
}
