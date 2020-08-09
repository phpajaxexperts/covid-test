<?php

namespace Modules\Testcenters\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Modules\Testcenters\Entities\Center;
use Modules\Testcenters\Entities\CenterHoursOfOperation;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\Backend\SectionComponent\TrivComponent;
use Illuminate\Support\Facades\Hash;




class CentersController extends Controller
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
            $centers = Center::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email_addresss', 'LIKE', "%$keyword%")
                ->orWhere('street_address_1', 'LIKE', "%$keyword%")
                ->orWhere('street_address_2', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->orWhere('state', 'LIKE', "%$keyword%")
                ->orWhere('zip_code', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $centers = Center::latest()->paginate($perPage);
        }

        return view('testcenters::backend.center.view', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        

        TrivComponent::create();

        $hours_of_operations = [];

        return view('testcenters::backend.center.create' , compact('hours_of_operations'));
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
        if($requestData['password']!='')
            $requestData['password'] = Hash::make($requestData['password']);

        $ID = Center::create($requestData)->ID;


        $days = getDays();
        if(count($days)>0){
            foreach ($days as $day){
                if(isset($requestData['all_day_close_'.$day->ID]))
                    $all_day_close = $requestData['all_day_close_'.$day->ID];
                else
                    $all_day_close = 0;

                $arr_hours_of_operation = array(
                    'center' => $ID,
                    'day' => $day->ID,
                    'open' => $requestData['open_'.$day->ID],
                    'close' => $requestData['close_'.$day->ID],
                    'all_day_close' => $all_day_close,
                    'active' => 1
                );
                CenterHoursOfOperation::create($arr_hours_of_operation);
            }
        }

        TrivComponent::store($ID);




        return redirect('administrator/view-center')->with('flash_message', 'Center added!');
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
        $center = Center::findOrFail($id);

        return view('testcenters::backend.center.detail', compact('center'));
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

        $center = Center::findOrFail($id);


        TrivComponent::edit($id);

        $hours_of_operations = CenterHoursOfOperation::where('center',$id)->get();

        return view('testcenters::backend.center.edit', compact('center','section_rs','hours_of_operations') );
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
        
        $center = Center::findOrFail($id);

        if($requestData['password']!='')
            $requestData['password'] = Hash::make($requestData['password']);
        else
            unset($requestData['password']);

        $center->update($requestData);

        //dd($requestData);
        CenterHoursOfOperation::where('center',$id)->delete();
        $days = getDays();
        if(count($days)>0){
            foreach ($days as $day){
                if(isset($requestData['all_day_close_'.$day->ID]))
                    $all_day_close = $requestData['all_day_close_'.$day->ID];
                else
                    $all_day_close = 0;

                $arr_hours_of_operation = array(
                    'center' => $id,
                    'day' => $day->ID,
                    'open' => $requestData['open_'.$day->ID],
                    'close' => $requestData['close_'.$day->ID],
                    'all_day_close' => $all_day_close,
                    'active' => 1
                );
                CenterHoursOfOperation::create($arr_hours_of_operation);
            }
        }

        TrivComponent::update($id);

        return redirect('administrator/view-center')->with('flash_message', 'Center updated!');
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
        Center::destroy($id);

        TrivComponent::destroy($id);

        return redirect('administrator/view-center')->with('flash_message', 'Center deleted!');
    }
}
