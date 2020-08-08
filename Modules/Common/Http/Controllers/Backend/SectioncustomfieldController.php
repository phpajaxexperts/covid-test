<?php

namespace Modules\Common\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Modules\Common\Entities\Sectioncustomfield;
use Illuminate\Http\Request;

use Modules\Common\Entities\Customfield; 


class SectioncustomfieldController extends Controller
{
     public function __construct() {
         $this->middleware(['auth', 'clearance']); //clearance middleware lets only users with a //specific permission permission to access these resources
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $sectioncustomfield = Sectioncustomfield::where('section_rs', 'LIKE', "%$keyword%")
                ->orWhere('section', 'LIKE', "%$keyword%")
                ->orWhere('custom_field', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $sectioncustomfield = Sectioncustomfield::latest()->paginate($perPage);
        }

        return view('common::backend.sectioncustomfield.view', compact('sectioncustomfield'));
    }

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
        
        return view('common::backend.sectioncustomfield.create' , compact('custom_fields'));
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
        
        //Sectioncustomfield::create($requestData);
        if($requestData['section_rs']){
            $sectioncustomfield_exist = Sectioncustomfield::where('custom_field', $requestData['custom_field'])
            ->where('section_rs', $requestData['section_rs'])
            ->where('section', $requestData['section'])
            ->first();

            if(!isset($sectioncustomfield_exist->ID)){
                $arr = array(
                    'custom_field' => $requestData['custom_field'],
                    'section_rs' => $requestData['section_rs'],
                    'section' => $requestData['section']
                );
                Sectioncustomfield::create($arr);
    
                $response = array(
                    'status' => 'success',
                    'msg' => 'Section Custom Field added!',
                    'section_custom_fields' => session('section_custom_fields')
                );
            }else{
                $response = array(
                    'status' => 'warning',
                    'msg' => 'Section Custom Field already exist!',
                    'section_custom_fields' => session('section_custom_fields')
                );
            }

        }else{
            if(session('section_custom_fields'))
                $section_custom_fields = session('section_custom_fields');
            else
                $section_custom_fields = array();

            $arr_section_custom_fields = array(
                'section_rs'    =>  $requestData['section_rs'],
                'section'   =>  $requestData['section'],
                'custom_field'  =>  $requestData['custom_field'],
                'custom_field_element_label' => $requestData['custom_field_element_label'],
                'custom_field_element_preview' => $requestData['custom_field_element_preview']
            );
        
            if(!in_array($arr_section_custom_fields,$section_custom_fields)){
                $section_custom_fields[] = $arr_section_custom_fields;
                session(['section_custom_fields' => $section_custom_fields]);
                $response = array(
                    'status' => 'success',
                    'msg' => 'Section Custom Field added!',
                    'section_custom_fields' => session('section_custom_fields')
                );
            }else{
                $response = array(
                    'status' => 'warning',
                    'msg' => 'Section Custom Field already exist!',
                    'section_custom_fields' => session('section_custom_fields')
                );
            }

        }
        
        return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function detail($id)
    {
        $sectioncustomfield = Sectioncustomfield::findOrFail($id);

        return view('common::backend.sectioncustomfield.detail', compact('sectioncustomfield'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $sectioncustomfield = Sectioncustomfield::findOrFail($id);

        $custom_fields = Customfield::select('ID','name')->with('fieldValues')->get();

        return view('common::backend.sectioncustomfield.edit', compact('sectioncustomfield') , compact('custom_fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $sectioncustomfield = Sectioncustomfield::findOrFail($id);
        $sectioncustomfield->update($requestData);

        return redirect('administrator/view-sectioncustomfield')->with('flash_message', 'Sectioncustomfield updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Sectioncustomfield::destroy($id);

        return redirect('administrator/view-sectioncustomfield')->with('flash_message', 'Sectioncustomfield deleted!');
    }

    public function getSectionCustomFields(Request $request){
        $section = $request->section;
        $section_rs = $request->section_rs;
        $key = $request->key;
        if(isset($section_rs)){
            $section_custom_fields = Customfield::select(
                'core_custom_fields.ID',
                'core_custom_fields.name',
                'core_custom_fields.type',
                'section_custom_fields.section_rs',
                'section_custom_fields.ID as section_custom_field_id'
                )
            ->with('fieldValues')
            ->with('typeName')
            ->join('section_custom_fields','section_custom_fields.custom_field','=','core_custom_fields.ID')
            ->where('section_custom_fields.section_rs','=',$section_rs)
            ->where('section_custom_fields.section','=',$section)
            ->get();

            $str_preview = '';
            if(count($section_custom_fields)>0){
                foreach($section_custom_fields as $key => $section_custom_field){
                    $custom_field_element = generateInputElement($section_custom_field->typeName->ID,$section_custom_field->name,$section_custom_field->fieldValues);
                    $str_preview .= '<div class="form-group">
                    <label for="custom_field" class="col-md-4 control-label">'.$section_custom_field->name.' 
                    <button type="button" class="btn btn-danger btn-sm" title="Delete Sectioncustomfield" onclick="return deleteSectionCustomField(\''.$section.'\',\''.$section_custom_field->section_rs.'\',\''.$section_custom_field->section_custom_field_id.'\')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </label>
                    <div class="col-md-12">
                    '.$custom_field_element.'
                    </div>
                </div>';
                }
            }
            $response = array('preview' => $str_preview);
        }else{
            if(session('section_custom_fields'))
            $section_custom_fields = session('section_custom_fields');
            else
            $section_custom_fields = array();

            $str_preview = '';
            if(count($section_custom_fields)>0){
                foreach($section_custom_fields as $key => $section_custom_field){
                    $str_preview .= '<div class="form-group">
                    <label for="custom_field" class="col-md-4 control-label">'.$section_custom_field['custom_field_element_label'].' 
                    <button type="button" class="btn btn-danger btn-sm" title="Delete Sectioncustomfield" onclick="return deleteSectionCustomField(\''.$section.'\',\''.$section_rs.'\',\''.$key.'\')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </label>
                    <div class="col-md-12">
                    '.$section_custom_field['custom_field_element_preview'].'
                    </div>
                </div>';
                }
            }
            $response = array('preview' => $str_preview);
        }
        return response()->json($response,200);
    }

    public function deleteSectionCustomFields(Request $request){
        $section = $request->section;
        $section_rs = $request->section_rs;
        $key = $request->key;
        if($section_rs){
            Sectioncustomfield::destroy($key);
            //Sectioncustomfield::destroy(['section_rs' => $section_rs,'section' => $section]);
        }else{
            if(session('section_custom_fields'))
            $section_custom_fields = session('section_custom_fields');
            else
            $section_custom_fields = array();
            
            unset($section_custom_fields[$key]);

            session(['section_custom_fields' => $section_custom_fields]);
        }

        $response = array(
            'status' => 'warning',
            'msg' => 'Section Custom Field deleted successfully!',
            'section_custom_fields' => session('section_custom_fields')
        );
        return response()->json($response,200);        

    }
}
