<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

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
    protected $fillable = ['module','section','name','slug', 'guard_name', 'display', 'active'];


    public function sectionComponents()
    {
        return $this->hasMany('Modules\Administrator\Entities\form_section_components', 'section', 'section');
    }

    public function sectionComponentName()
    {
        return $this->hasManyThrough(
            'Modules\Administrator\Entities\form_components',
            'Modules\Administrator\Entities\form_section_components',
            'section', // Foreign key on users table...
            'ID', // Foreign key on posts table...
            'section', // Local key on countries table...
            'form_component' // Local key on users table...
        )->orderBy('form_section_components.ID','asc');
   }

   public function sectionComponentPosition()
   {
       return $this->hasManyThrough(
           'Modules\Administrator\Entities\core_position',
           'Modules\Administrator\Entities\form_section_components',
           'section', // Foreign key on users table...
           'ID', // Foreign key on posts table...
           'section', // Local key on countries table...
           'position' // Local key on users table...
       )->orderBy('form_section_components.ID','asc');
  }
}
