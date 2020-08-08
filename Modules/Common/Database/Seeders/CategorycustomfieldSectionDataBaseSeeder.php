<?php

namespace Modules\Common\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Administrator\Entities\Section;
use Modules\Administrator\Entities\Module;
use Modules\Administrator\Entities\Permissions;


class CategorycustomfieldSectionDataBaseSeeder extends Seeder
{
    public function run()
    {
                $sec_id = Section::insertGetId(array('module'=>1,'name'=>'Categorycustomfield','active'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));

        Permissions::create(['module'=>1,'section'=>$sec_id,'name' => 'View '.ucfirst("categorycustomfield"),'guard_name' => 'administrator','display' => 1,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>$sec_id,'name' => 'Detail '.ucfirst("categorycustomfield"),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>$sec_id,'name' => 'Create '.ucfirst("categorycustomfield"),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>$sec_id,'name' => 'Store '.ucfirst("categorycustomfield"),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>$sec_id,'name' => 'Edit '.ucfirst("categorycustomfield"),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>$sec_id,'name' => 'Update '.ucfirst("categorycustomfield"),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>$sec_id,'name' => 'Destroy '.ucfirst("categorycustomfield"),'guard_name' => 'administrator','display' => 0,'active' => 1]);
    }
}
