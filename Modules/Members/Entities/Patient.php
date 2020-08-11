<?php

namespace Modules\Members\Entities;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patients';

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
    protected $fillable = ['name','identity_type', 'nric_passport', 'gender', 'dob', 'phone', 'email_address', 'country', 'symtoms', 'travelled_infected_country', 'test_result', 'sessionid', 'active'];

    


    public function primaryimage()
    {
        return $this->hasOne("Modules\Common\Entities\core_section_images", 'section_rs','ID')
        ->select('core_section_images.*','administrator_module_sections.collection_name','administrator_modules.module_config_name')
        ->join('administrator_module_sections','administrator_module_sections.ID','=','core_section_images.section')
        ->join('administrator_modules','administrator_modules.ID','=','administrator_module_sections.module')
        ->orderBy("ID", "asc");
    }

    public function images()
    {
        return $this->hasMany("Modules\Common\Entities\core_section_images", 'section_rs','ID')
        ->select('core_section_images.*','administrator_module_sections.collection_name','administrator_modules.module_config_name')
        ->join('administrator_module_sections','administrator_module_sections.ID','=','core_section_images.section')
        ->join('administrator_modules','administrator_modules.ID','=','administrator_module_sections.module')
        ->orderBy("ID", "asc");
    }

    public function videos()
    {
        return $this->hasMany("Modules\Common\Entities\core_section_videos", 'section_rs','ID')->orderBy("ID", "asc");
    }

    public function files()
    {
        return $this->hasMany("Modules\Common\Entities\core_section_files", 'section_rs','ID')
        ->select('core_section_files.*','administrator_module_sections.collection_name','administrator_modules.module_config_name')
        ->join('administrator_module_sections','administrator_module_sections.ID','=','core_section_files.section')
        ->join('administrator_modules','administrator_modules.ID','=','administrator_module_sections.module')
        ->orderBy("ID", "asc");
    }

    public function metaDetails()
    {
        return $this->hasOne("Modules\Common\Entities\core_section_meta_detail", 'section_rs','ID')->orderBy("ID", "asc");
    }

    public function customFieldsData()
    {
        return $this->hasMany("Modules\Common\Entities\core_section_custom_field_data", 'section_rs','ID')
        ->with('customField')
        ->orderBy("ID", "asc");
    }
}
