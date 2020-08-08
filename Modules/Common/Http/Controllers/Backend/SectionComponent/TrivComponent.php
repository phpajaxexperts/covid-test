<?php

namespace Modules\Common\Http\Controllers\Backend\SectionComponent;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
//use Modules\Common\Component\Category\TrivCategoryComponent;

class TrivComponent
{
    public static function commonFuncInit($ID,$func_name)
    {
        //dd(view());
        $section_components = view()->shared('form_components');

        if(count($section_components)>0) { 
            foreach ($section_components as $key => $section_component) {
                $className = __NAMESPACE__ . '\\Src\\' . 'Triv'.$section_component->component_name.'Component';
                $component_obj =  new $className;
                $component_obj->$func_name($ID);  //$component_obj->store($ID);
            }
        }
    }

    public static function create()
    {
        self::commonFuncInit('','create');
    }

    public static function store($ID)
    {
        self::commonFuncInit($ID,'store');
        //$className = __NAMESPACE__ . '\\src\\' . 'Triv'.$permission->component_name.'Component';
        //$controller =  new $className;
        //TrivCategoryComponent::store($ID);
    }

    public static function edit($ID)
    {
        // $permission = getModuleBySlug();
        // $section =  $permission->section;
        // TrivCategoryComponent::edit($ID,$section);

        self::commonFuncInit($ID,'edit');
    }

    public static function update($ID)
    {
        //TrivCategoryComponent::update($ID,$section);
        self::commonFuncInit($ID,'update');
    }

    public static function destroy($ID)
    {
        //TrivCategoryComponent::destroy($ID,$section);
        self::commonFuncInit($ID,'destroy');
    }

}
