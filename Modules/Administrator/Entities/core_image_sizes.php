<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;

class core_image_sizes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_image_sizes';

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
    protected $fillable = ['name', 'width', 'height', 'section', 'collection_name'];

   
    
}
