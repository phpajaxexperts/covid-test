<?php

namespace Modules\Testcenters\Entities;

use Illuminate\Database\Eloquent\Model;

class CenterHoursOfOperation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'centers_hours_of_operation';

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
    protected $fillable = ['center', 'day', 'open', 'close', 'all_day_close', 'active'];


}
