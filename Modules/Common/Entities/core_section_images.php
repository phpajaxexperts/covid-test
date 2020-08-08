<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class core_section_images extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_section_images';

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
    protected $fillable = ['section_rs', 'section', 'title', 'description', 'image', 'mime'];

   
}
