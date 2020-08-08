<?php

namespace Modules\Common\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Modules\Common\Entities\core_category_custom_fields;
use Illuminate\Http\Request;

use Modules\Common\Entities\Customfield; 


class CategorycustomfieldController extends Controller
{
     public function __construct() {
         $this->middleware(['auth', 'clearance']); //clearance middleware lets only users with a //specific permission permission to access these resources
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //$custom_fields = Customfield::with('typeName')->with('fieldValues')->get();
        $custom_fields = Customfield::with(array('fieldValues'=>function($query){
            $query->select('value','field');
        }))
        ->with('typeName')
        ->get();

        //dd($custom_fields);
        
        return view('common::backend.categorycustomfield.create' , compact('custom_fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        //categorycustomfield::create($requestData);
        if($requestData['category']){
            $categorycustomfield_exist = core_category_custom_fields::where('custom_field', $requestData['custom_field'])
            ->where('category', $requestData['category'])
            ->where('module', $requestData['module'])
            ->first();

            if(!isset($categorycustomfield_exist->ID)){
                $arr = array(
                    'custom_field' => $requestData['custom_field'],
                    'category' => $requestData['category'],
                    'module' => $requestData['module']
                );
                core_category_custom_fields::create($arr);
    
                $response = array(
                    'status' => 'success',
                    'msg' => 'Category Custom Field added!',
                    'category_custom_fields' => session('category_custom_fields')
                );
            }else{
                $response = array(
                    'status' => 'warning',
                    'msg' => 'Category Custom Field already exist!',
                    'category_custom_fields' => session('category_custom_fields')
                );
            }

        }else{
            if(session('category_custom_fields'))
                $category_custom_fields = session('category_custom_fields');
            else
                $category_custom_fields = array();

            $arr_category_custom_fields = array(
                'category'    =>  $requestData['category'],
                'module'   =>  $requestData['module'],
                'custom_field'  =>  $requestData['custom_field'],
                'custom_field_element_label' => $requestData['custom_field_element_label'],
                'custom_field_element_preview' => $requestData['custom_field_element_preview']
            );
        
            if(!in_array($arr_category_custom_fields,$category_custom_fields)){
                $category_custom_fields[] = $arr_category_custom_fields;
                session(['category_custom_fields' => $category_custom_fields]);
                $response = array(
                    'status' => 'success',
                    'msg' => 'Category Custom Field added!',
                    'category_custom_fields' => session('category_custom_fields')
                );
            }else{
                $response = array(
                    'status' => 'warning',
                    'msg' => 'Category Custom Field already exist!',
                    'category_custom_fields' => session('category_custom_fields')
                );
            }

        }
        
        return response()->json($response,200);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    
    public function getcategorycustomfields(Request $request){
        $module = $request->module;
        $category = $request->category;
        $preview_live = $request->preview_live;
        $section_rs = $request->section_rs;
        $section = $request->section;

        $key = $request->key;
        if(isset($category)){
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

            //dd($category_custom_fields);
            //echo "<pre>"; print_r($category_custom_fields); exit;

            $str_preview = '';
            if(count($category_custom_fields)>0){
                foreach($category_custom_fields as $key => $category_custom_field){
                    if($preview_live = 'preview_live'){
                        if(isset($section_rs))
                        $cf_selected_values = getCfSelectedValues($category_custom_field->typeName->ID,$category_custom_field->ID,$section,$section_rs);
                        else
                        $cf_selected_values = '';
                        $custom_field_element = generateInputElement($category_custom_field->typeName->ID,$category_custom_field->name,$category_custom_field->fieldValues,$category_custom_field->ID,$cf_selected_values);
                        $str_preview .= '<div class="form-group">
                        <label for="custom_field" class="col-md-4 control-label">'.$category_custom_field->name.' </label>
                        <div class="col-md-12">
                        '.$custom_field_element.'
                        </div>
                        </div>';
                    }else{
                        $custom_field_element = generateInputElement($category_custom_field->typeName->ID,$category_custom_field->name,$category_custom_field->fieldValues,$category_custom_field->ID);
                        $str_preview .= '<div class="form-group">
                        <label for="custom_field" class="col-md-4 control-label">'.$category_custom_field->name.' 
                        <button type="button" class="btn btn-danger btn-sm" title="Delete categorycustomfield" onclick="return deleteCategoryCustomField(\''.$module.'\',\''.$category_custom_field->category.'\',\''.$category_custom_field->category_custom_field_id.'\')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </label>
                        <div class="col-md-12">
                        '.$custom_field_element.'
                        </div>
                        </div>';
                    }
                }
                //exit;
            }
            $response = array('preview' => $str_preview);
        }else{
            if(session('category_custom_fields'))
            $category_custom_fields = session('category_custom_fields');
            else
            $category_custom_fields = array();

            $str_preview = '';
            if(count($category_custom_fields)>0){
                foreach($category_custom_fields as $key => $category_custom_field){
                    $str_preview .= '<div class="form-group">
                    <label for="custom_field" class="col-md-4 control-label">'.$category_custom_field['custom_field_element_label'].' 
                    <button type="button" class="btn btn-danger btn-sm" title="Delete categorycustomfield" onclick="return deleteCategoryCustomField(\''.$module.'\',\''.$category.'\',\''.$key.'\')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </label>
                    <div class="col-md-12">
                    '.$category_custom_field['custom_field_element_preview'].'
                    </div>
                </div>';
                }
            }
            $response = array('preview' => $str_preview);
        }
        return response()->json($response,200);
    }

    public function deleteCategoryCustomFields(Request $request){
        $module = $request->module;
        $category = $request->category;
        $key = $request->key;
        if($category){
            core_category_custom_fields::destroy($key);
            //categorycustomfield::destroy(['section_rs' => $section_rs,'section' => $section]);
        }else{
            if(session('category_custom_fields'))
            $category_custom_fields = session('category_custom_fields');
            else
            $category_custom_fields = array();
            
            unset($category_custom_fields[$key]);

            session(['category_custom_fields' => $category_custom_fields]);
        }

        $response = array(
            'status' => 'warning',
            'msg' => 'Category Custom Field deleted successfully!',
            'category_custom_fields' => session('category_custom_fields')
        );
        return response()->json($response,200);        

    }
}
