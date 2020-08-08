<?php

use Modules\Common\Entities\Category;
use Modules\Common\Entities\Categorymapping;
use Modules\Common\Entities\Customfield;
use Modules\Administrator\Entities\Permissions;
use Modules\Administrator\Entities\Section;

function getModulesForMenu(){
    $modules = DB::table('administrator_modules')
        ->select(
            'administrator_modules.id',
            'administrator_modules.name',
            'administrator_modules.category',
            DB::raw("(SELECT GROUP_CONCAT(permissions.name SEPARATOR ',') AS `permission_name` FROM permissions
                        WHERE administrator_modules.id =  permissions.module AND permissions.display=1 
                    ) as permission_name")
             )
        ->where('administrator_modules.active','=',1)
        ->orderBy('administrator_modules.ID', 'asc')
        ->get();//Get all modules
    //echo "<pre>"; print_r($modules); exit;
    return $modules;
}

function getModuleSectionsForMenu($module){
    //$module_sections = AdministratorModuleSections::all()->where('active','=',1);//Get all module sections
    $module_sections = DB::table('administrator_module_sections')
        ->select(
            'administrator_module_sections.id',
            'administrator_module_sections.name',
            'permissions.module',
            'permissions.display as permission_display',
            'permissions.name as permission_name'
        )
        ->join('permissions','permissions.section','=','administrator_module_sections.id')
        //->where('permissions.display','=',1)
        ->where('administrator_module_sections.active','=',1)
        ->where('administrator_module_sections.module','=',$module)
        ->orderBy('administrator_module_sections.sort', 'asc')
        ->get();//Get module sections
    //echo "<pre>";print_r($module_sections); exit;
    return $module_sections;
}


function categoryTreeView($module,$parent=0){
    $categories = Category::select('core_category.ID','core_category.name')
    ->join('core_category_mapping','core_category_mapping.category','=','core_category.ID')
    ->where('core_category_mapping.parent','=',$parent)
    ->where('core_category_mapping.module','=',$module)
    ->get();
    $str_menu_template = '';
    if(count($categories)>0){
        $str_menu_template .= '<ul>';
        foreach ($categories as $key => $category) {
            $sub_categories = categoryTreeView($module,$category->ID);
            //$str_view_btn = '<a href="'. url('/administrator/detail-category/' . $category->ID).'" title="View Category"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>';
            $str_view_btn = '<button onclick="window.location=\''.url('/administrator/detail-category/'.$module.'/'. $category->ID).'\'" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button>';
            $str_edit_btn = '<button onclick="window.location=\''.url('/administrator/edit-category/'.$module.'/'. $category->ID).'\'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';
            $str_delete_btn = '<form method="POST" action="'. url('/administrator/destroy-category/'.$module.'/'. $category->ID). '" accept-charset="UTF-8" style="display:block;">'. method_field('DELETE') .' ' .csrf_field() .'<button type="submit" class="btn btn-danger btn-sm" title="Delete Category" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></form>';
            $action_btns =  $str_view_btn.$str_edit_btn.$str_delete_btn; 
            if(isset($sub_categories)){
                $str_menu_template .= '<li><a href="">'.$category->name.'</a>'.$action_btns.$sub_categories.'</li>';
            }else{
                $str_menu_template .= '<li><a href="">'.$category->name.'</a>'.$action_btns;
                $str_menu_template .= '<ul><li><a href="'.url("administrator/create-category/".$module.'/'.$category->ID).'">+ add sub category</a></li></ul>';
                $str_menu_template .= '</li>';
            }

            // $arr_category[] = array(
            //     'ID' => $category->ID,
            //     'name' => $category->name,
            //     'sub_categories' => $sub_categories
            // );
        }
        if($parent==0)
        $str_menu_template .= '<li><a href="'.url("administrator/create-category/".$module.'/'.$parent).'">+ add  category</a></li>';
        else
        $str_menu_template .= '<li><a href="'.url("administrator/create-category/".$module.'/'.$parent).'">+ add sub category</a></li>';
        $str_menu_template .= '</ul>';
        return $str_menu_template;
        //return $arr_category;
    }else{
        return;
    }

}

function getModuleBySlug(){
    $slug = request()->segment(2);
    $permission = Permissions::with('sectionComponentName')
    ->with('sectionComponentPosition')
    ->where('permissions.slug','=',$slug)
    ->first();
    
    return $permission;
}

function getCategoriesDropDown($module,$parent=0,$level=0,$selected_category){
    $categories = Category::select('core_category.ID','core_category.name','core_category_mapping.parent')
    ->join('core_category_mapping','core_category_mapping.category','=','core_category.ID')
    ->where('core_category_mapping.parent','=',$parent)
    ->where('core_category_mapping.module','=',$module)
    ->get();

    //dd($categories);

    $str_dropdown_template = '';
    $indent = str_repeat('-----', $level);
    if(count($categories)>0){
        foreach ($categories as $key => $category) {

            $sub_categories = getCategoriesDropDown($module,$category->ID,$level+1,$selected_category);

            if($selected_category==$category->ID)
                $selected = "selected='selected'";
            else
                $selected = "";

            if(isset($sub_categories) && $sub_categories!=''){
                if($category->parent==0)
                $str_dropdown_template .= '<option '.$selected.' value="'.$category->ID.'">'.$indent.' '.$category->name.'</option>'.$sub_categories;
                else
                $str_dropdown_template .= '<option '.$selected.' value="'.$category->ID.'">&#9495;'.$indent.' '.$category->name.'</option>'.$sub_categories;
            }else{
                $str_dropdown_template .= '<option '.$selected.' value="'.$category->ID.'">'.$category->name.'</option>';
            }
        }

    }

    return $str_dropdown_template;
}

function getCfSelectedValues($custom_field_type_id,$custom_field_id,$section,$section_rs){
    $cf_selected_values = DB::table('core_section_custom_field_data')
    ->where('core_section_custom_field_data.custom_field','=',$custom_field_id)
    ->where('core_section_custom_field_data.section_rs','=',$section_rs)
    ->where('core_section_custom_field_data.section','=',$section)
    ->first();


    if(isset($cf_selected_values->input_data)){
        if($custom_field_type_id==5 || $custom_field_type_id==7)
        $cf_selected_values = explode(',',$cf_selected_values->input_data);
        else
        $cf_selected_values = isset($cf_selected_values->input_data)?$cf_selected_values->input_data:'';
    }

    return $cf_selected_values;
}

function generateInputElement($element_type_id,$element_name,$element_values='',$element_id='',$cf_selected_values=''){
    $str_element = '';
    if($element_type_id==1)  // Text Box
        $str_element = Form::text('cf_'.$element_id, $cf_selected_values ,['class' => 'form-control']);
    elseif($element_type_id==2) // Text Area
        $str_element = Form::textarea('cf_'.$element_id, $cf_selected_values ,['class' => 'form-control']);
    elseif($element_type_id==3) // File Upload
        $str_element = Form::file('cf_'.$element_id, $cf_selected_values ,['class' => 'form-control']);
    elseif($element_type_id==4){   // Drop down
        $arr_element_data = [];
        $element_values = json_decode($element_values);
        //dd($element_values);
        if(count($element_values)>0){
            foreach($element_values as $element_value){
                if(isset($element_value->ID))
                $arr_element_data[$element_value->ID] = $element_value->value;
                else
                $arr_element_data[] = $element_value->value;
            }
        }
        $str_element = Form::select('cf_'.$element_id,$arr_element_data, $cf_selected_values, ['class' => 'form-control']);
    }elseif($element_type_id==5){ //Checkbox
        if(count($element_values)>0){
            foreach($element_values as $element_value){
                $element_data = json_decode($element_value);
                //$str_element .= Form::checkbox('cf_'.$element_id.'[]', $cf_selected_values, ['class' => 'form-control']).' '.ucwords($element_data->value).'<br>';
                if(isset($element_data->ID) && is_array($cf_selected_values)){
                    if(in_array($element_data->ID,$cf_selected_values)){
                        $checked = true;
                    }else{
                        $checked = false;
                    }
                }else{
                    $checked = false;
                }
                $str_element .= Form::checkbox('cf_'.$element_id.'[]', isset($element_data->ID)?$element_data->ID:'', $checked,['class' => '']).' '.ucwords($element_data->value).'<br>';
            }
        }
    }
    elseif($element_type_id==6){ //Radio Button
        if(count($element_values)>0){
            $selected = '';
            foreach($element_values as $element_value){
                $element_data = json_decode($element_value);
                //echo $cf_selected_values.'='.$element_value->ID."<br>";
                if($cf_selected_values==$element_value->ID)
                $selected = "true";
                else
                $selected = "";

                $str_element .= Form::radio('cf_'.$element_id, isset($element_data->ID)?$element_data->ID:'',$selected, ['class' => '',$selected]).' '.ucwords($element_data->value.'<br>');
            }
        }

    }
    elseif($element_type_id==7){ //Multi Select Drop Down
        $arr_element_data = [];
        $element_values = json_decode($element_values);
        if(count($element_values)>0){
            foreach($element_values as $element_value){
                if(isset($element_value->ID))
                $arr_element_data[$element_value->ID] = $element_value->value;
                else
                $arr_element_data[] = $element_value->value;
            }
        }
        $str_element = Form::select('cf_'.$element_id.'[]',$arr_element_data, $cf_selected_values, ['class' => 'form-control','multiple' => true]);
    }
    

    return $str_element;
}


function getCategoryCustomFields($category,$module){
    $category_custom_fields = Customfield::select(
        'core_custom_fields.ID',
        'core_custom_fields.name',
        'core_custom_fields.type',
        'core_category_custom_fields.category',
        'core_category_custom_fields.ID as category_custom_field_id'
        )
    ->with('fieldValues')
    ->with('typeName')
    ->join('core_category_custom_fields','core_category_custom_fields.custom_field','=','core_custom_fields.ID')
    ->where('core_category_custom_fields.category','=',$category)
    ->where('core_category_custom_fields.module','=',$module)
    ->get();

    return $category_custom_fields;
}

function getCoreVideoType(){
    $video_types = DB::table('core_video_type')
    ->where('active','=',1)
    ->get()
    ->pluck('name','ID');
    return $video_types;
}

// function getSelectedModule($url_section){
//     //$module_sections = AdministratorModuleSections::all()->where('active','=',1);//Get all module sections
//     $permissions = DB::table('permissions')
//         ->select(
//             'permissions.module',
//             'permissions.section',
//             'permissions.name as permission_name'
//         )
//         ->where('permissions.active','=',1)
//         ->orderBy('permissions.id', 'asc')
//         ->get();//Get module sections
//     //echo "<pre>";print_r($module_sections); exit;


//     return $module_sections;
// }

function getFileTypeUsingName($file){
    $ext = $file->getClientOriginalExtension();
    if($ext=='doc' or $ext=='docx' )
    $ID = 1;
    elseif($ext=='pdf')
    $ID = 2;
    elseif($ext=='csv' or $ext=='xls' or $ext=='xlsx' or $ext=='xlsm' or $ext=='xltm' or $ext=='xltx')
    $ID = 3;

    $file_type = DB::table('core_file_type')
    ->where('ID','=',$ID)
    ->first();    
    return $file_type;
}

function getSection($ID){
    $section = Section::with('administrator_modules')
    ->where('ID','=',$ID)
    ->first();    
    return $section;
}


function imagePathComposeBySectionID($section){
    $section_detail = getSection($section);
    //$section_collection_name = str_replace(['#', '/', '\\', ' '], '', $section_detail->collection_name);
    $section_collection_name = $section_detail->collection_name;
    $img_folder = config('app.media_folder').'/'.config($section_detail->administrator_modules->module_config_name.".".strtolower($section_collection_name).".images");
    $img_folder_tmp = config('app.media_folder').'/'.config($section_detail->administrator_modules->module_config_name.".".strtolower($section_collection_name).".images_tmp");

    $img_path = config('app.image_crop_url').'/'.$img_folder;
    $img_path_tmp = config('app.image_crop_url').'/'.$img_folder_tmp;
    $arr_img_path_detail = array(
        'img_path' => url($img_path),
        'img_path_tmp' => url($img_path_tmp),
        'img_folder' => $img_folder,
        'img_folder_tmp' => $img_folder_tmp,
    );

    return $arr_img_path_detail;    
}


function imagePathFilenameCompose($image,$section){
    $section_detail = getSection($section);

    //dd($section_detail);

    $token = md5(uniqid(rand(),1));
    $un = substr($token, 0, 10);
    $extension = $image->getClientOriginalExtension();
    //$section_collection_name = str_replace(['#', '/', '\\', ' '], '-', $section_detail->collection_name);
    $section_collection_name = $section_detail->collection_name;
    $fileName = strtolower($section_collection_name). '_' . $un . '.' . $extension;
    
    $img_path = config('app.media_folder').'/'.config($section_detail->administrator_modules->module_config_name.".".strtolower($section_collection_name).".images");
    $img_path_tmp = config('app.media_folder').'/'.config($section_detail->administrator_modules->module_config_name.".".strtolower($section_collection_name).".images_tmp");

    // $img_path = config('app.media_folder').'/'.strtolower($section_collection_name).config(strtolower($section_detail->administrator_modules->module_config_name).'.img_path');
    // $img_path_tmp = config('app.media_folder').'/'.strtolower($section_collection_name).config(strtolower($section_detail->administrator_modules->module_config_name).'.img_path').'_tmp';
    if (!is_dir($img_path)) {
        mkdir($img_path, 0755, true);
    }
    if (!is_dir($img_path_tmp)) {
        mkdir($img_path_tmp, 0755, true);
    }

    $arr_img_path_detail = array(
        'img_path' => $img_path,
        'img_path_tmp' => $img_path_tmp,
        'file_name' => $fileName
    );

    return $arr_img_path_detail;
}


function filePathComposeBySectionID($section){
    $section_detail = getSection($section);
    //$section_collection_name = str_replace(['#', '/', '\\', ' '], '-', $section_detail->collection_name);
    $section_collection_name = $section_detail->collection_name;
    $file_folder = config('app.media_folder').'/'.config($section_detail->administrator_modules->module_config_name.".".strtolower($section_collection_name).".files");
    $file_folder_tmp = config('app.media_folder').'/'.config($section_detail->administrator_modules->module_config_name.".".strtolower($section_collection_name).".files_tmp");

    $arr_file_path_detail = array(
        'file_folder' => $file_folder,
        'file_folder_tmp' => $file_folder_tmp,
    );

    return $arr_file_path_detail;    
}

function filePathFilenameCompose($file,$section){
    $section_detail = getSection($section);

    //dd($section_detail);

    $token = md5(uniqid(rand(),1));
    $un = substr($token, 0, 10);
    $extension = $file->getClientOriginalExtension();
    //$section_collection_name = str_replace(['#', '/', '\\', ' '], '-', $section_detail->collection_name);
    $section_collection_name = $section_detail->collection_name;
    $fileName = strtolower($section_collection_name). '_' . $un . '.' . $extension;

    $file_path = config('app.media_folder').'/'.config($section_detail->administrator_modules->module_config_name.".".strtolower($section_collection_name).".files");
    $file_path_tmp = config('app.media_folder').'/'.config($section_detail->administrator_modules->module_config_name.".".strtolower($section_collection_name).".files_tmp");
    if (!is_dir($file_path)) {
        mkdir($file_path, 0755, true);
    }
    if (!is_dir($file_path_tmp)) {
        mkdir($file_path_tmp, 0755, true);
    }

    $arr_file_path_detail = array(
        'file_path' => $file_path,
        'file_path_tmp' => $file_path_tmp,
        'file_name' => $fileName
    );

    return $arr_file_path_detail;
}

function rrmdir($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (filetype($dir."/".$object) == "dir") 
             rrmdir($dir."/".$object); 
          else unlink   ($dir."/".$object);
        }
      }
      reset($objects);
      rmdir($dir);
    }
   }
?>