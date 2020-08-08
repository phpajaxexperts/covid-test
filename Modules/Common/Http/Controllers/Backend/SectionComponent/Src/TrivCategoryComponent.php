<?php

namespace Modules\Common\Http\Controllers\Backend\SectionComponent\Src;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class TrivCategoryComponent
{
    public static function create($ID)
    {
        
    }

    public static function store($ID)
    {
        $requestData = request()->all();
        $arr_section_category = array(
            'section_rs' => $ID,
            'section' => $_POST['section'],
            'category' => $requestData['category'],
        );
        DB::table('core_section_category')->insert($arr_section_category);

        //echo "<prE>"; print_r($_POST); exit;
        $custom_fields = getCategoryCustomFields($requestData['category'],$requestData['module']);
        if(count($custom_fields)>0){
            foreach($custom_fields as $custom_field){
                if(isset($_POST['cf_'.$custom_field->ID])){
                    if($custom_field->type==5 ||  $custom_field->type==7){
                        $input_data = implode(',',$_POST['cf_'.$custom_field->ID]);
                    }else{
                        $input_data = $_POST['cf_'.$custom_field->ID];
                    }

                    $arr_custom_field_data = array(
                        'section_rs' => $ID,
                        'section' => $requestData['section'],
                        'custom_field' => $custom_field->ID,
                        'input_data' => $input_data,
                    );
                    DB::table('core_section_custom_field_data')->insert($arr_custom_field_data);
                }
            }
        }
    }

    public static function edit($ID)
    {
        $section = view()->shared('section');
        $selected_category = DB::table('core_section_category')
        ->where('core_section_category.section_rs','=',$ID)
        ->where('core_section_category.section','=',$section)
        ->first();
        $selected_category = isset($selected_category->category)?$selected_category->category:'';

        //dd($selected_category);
        view()->share('selected_category', $selected_category);
    }

    public static function update($ID)
    {
        $requestData = request()->all();
        $arr_section_category = array(
            'category' => $requestData['category'],
        );
        DB::table('core_section_category')
        ->where('section_rs','=',$ID)
        ->where('section','=',$requestData['section'])
        ->update($arr_section_category);


        //echo "<prE>"; print_r($_POST); exit;
        DB::table('core_section_custom_field_data')
        ->where('section_rs','=',$ID)
        ->where('section','=',$requestData['section'])
        ->delete();
        $custom_fields = getCategoryCustomFields($requestData['category'],$requestData['module']);
        if(count($custom_fields)>0){
            foreach($custom_fields as $custom_field){
                if(isset($_POST['cf_'.$custom_field->ID])){
                    if($custom_field->type==5 ||  $custom_field->type==7){
                        $input_data = implode(',',$_POST['cf_'.$custom_field->ID]);
                    }else{
                        $input_data = $_POST['cf_'.$custom_field->ID];
                    }

                    $arr_custom_field_data = array(
                        'section_rs' => $ID,
                        'section' => $requestData['section'],
                        'custom_field' => $custom_field->ID,
                        'input_data' => $input_data,
                    );
                    DB::table('core_section_custom_field_data')->insert($arr_custom_field_data);
                }
            }
        }
    }

    public static function destroy($ID)
    {
        $requestData = request()->all();
        DB::table('core_section_category')
        ->where('section_rs','=',$ID)
        ->where('section','=',$requestData['section'])
        ->delete();

        DB::table('core_section_custom_field_data')
        ->where('section_rs','=',$ID)
        ->where('section','=',$requestData['section'])
        ->delete();
    }

}
