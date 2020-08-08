<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'administrator_module_sections';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'collection_name', 'active', 'module'];

    public function administrator_modules()
    {
        return $this->hasOne('Modules\Administrator\Entities\Module','id','module');
    }
    
}
