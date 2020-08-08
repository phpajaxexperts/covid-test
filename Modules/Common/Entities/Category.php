<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_category';

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
    protected $fillable = ['name', 'caption', 'description', 'image', 'video_url', 'gallery_url', 'meta_title', 'meta_description', 'meta_keywords', 'active'];

    
}
