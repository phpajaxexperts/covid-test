<?php

namespace Modules\Common\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Modules\Common\Entities\Customfield;
use Modules\Common\Entities\Customfieldvalues;
use Illuminate\Http\Request;

use Modules\Common\Entities\Core_custom_field_type; 


class CustomfieldsController extends Controller
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
            $customfields = Customfield::with('typeName')->where('type', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customfields = Customfield::with('typeName')->latest()->paginate($perPage);
        }

        //dd($customfields);
        //echo "<pre>"; print_r($customfields[0]->typeName->name); exit;

        return view('common::backend.customfield.view', compact('customfields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = Core_custom_field_type::select('ID','name')->get();


        return view('common::backend.customfield.create' , compact('types'));
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
        
        $ID = Customfield::create($requestData)->ID;

        if(isset($request->values)){
            $values = explode(',',$request->values);
            foreach($values as $value){
                $arr = array(
                    'field' => $ID,
                    'value' => $value
                );
                Customfieldvalues::create($arr);
            }
        }
       return redirect('administrator/view-customfield')->with('flash_message', 'Customfield added!');
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
        $customfield = Customfield::with('typeName')->findOrFail($id);

        return view('common::backend.customfield.detail', compact('customfield'));
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
        $customfield = Customfield::findOrFail($id);

        $types = Core_custom_field_type::select('ID','name')->get();


        return view('common::backend.customfield.edit', compact('customfield') , compact('types'));
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
        
        $customfield = Customfield::findOrFail($id);
        $customfield->update($requestData);

        return redirect('administrator/view-customfield')->with('flash_message', 'Customfield updated!');
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
        Customfield::destroy($id);

        return redirect('administrator/view-customfield')->with('flash_message', 'Customfield deleted!');
    }
}
