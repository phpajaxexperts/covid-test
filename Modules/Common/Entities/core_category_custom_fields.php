<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class core_category_custom_fields extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'core_category_custom_fields';

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
    protected $fillable = ['module', 'category', 'custom_field'];

    public function custom_field()
    {
        return $this->belongsTo('App\core_custom_fields');
    }
    
}
