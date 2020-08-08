<?php

namespace Modules\Members\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Administrator\Entities\Section;
use Modules\Administrator\Entities\Module;
use Modules\Administrator\Entities\Permissions;


class MembersModuleDataBaseSeeder extends Seeder
{
    public function run()
    {
        Module::insert(array('name'=>'Members','active'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
    }
}
