<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class core_video_type extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_video_type';

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
