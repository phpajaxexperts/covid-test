<?php

namespace Modules\Members\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Modules\Members\Entities\Patient;
use Illuminate\Http\Request;

use Modules\Common\Http\Controllers\Backend\SectionComponent\TrivComponent;




class PatientsController extends Controller
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
            $patients = Patient::where('name', 'LIKE', "%$keyword%")
                ->orWhere('nric_passport', 'LIKE', "%$keyword%")
                ->orWhere('gender', 'LIKE', "%$keyword%")
                ->orWhere('dob', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('email_address', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $patients = Patient::latest()->paginate($perPage);
        }

        return view('members::backend.patient.view', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        

        TrivComponent::create();

        return view('members::backend.patient.create' );
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
        
        $ID = Patient::create($requestData)->ID;

        TrivComponent::store($ID);

        return redirect('administrator/view-patient')->with('flash_message', 'Patient added!');
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
        $patient = Patient::findOrFail($id);

        return view('members::backend.patient.detail', compact('patient'));
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
        $section_rs =  $id;

        $patient = Patient::findOrFail($id);

        

        TrivComponent::edit($id);

        return view('members::backend.patient.edit', compact('patient','section_rs') );
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
        
        $patient = Patient::findOrFail($id);
        $patient->update($requestData);

        TrivComponent::update($id);

        return redirect('administrator/view-patient')->with('flash_message', 'Patient updated!');
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
        Patient::destroy($id);

        TrivComponent::destroy($id);

        return redirect('administrator/view-patient')->with('flash_message', 'Patient deleted!');
    }
}
