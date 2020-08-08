<?php

namespace Modules\Members\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Modules\Members\Entities\Patient;
use Illuminate\Http\Request;

class PatientsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
        
        $section_config = config('members.patients');
        $section = $section_config['section'];
        $perPage = $section_config['perpage'];

        $img_folder = $section_config['images'];
        $arr_img_opt = array('section' => $section, 'img_size_name' => 'standard');
        $img_optimize_params = getCdnImageOptimizeParams($arr_img_opt);

        $keyword = $request->get('search');
        $request_type = $request->get('request_type');  // Request Type is Paging or Not
        $sort_by = $request->get('sort_by');

        if($sort_by=='Recent'){
            $order_by = 'created_at';
            $order = 'DESC';
        }elseif($sort_by=='A-Z'){
            $order_by = 'title';
            $order = 'ASC';
        }elseif($sort_by=='Z-A'){
            $order_by = 'title';
            $order = 'DESC';
        }else{
            $order_by = 'created_at';
            $order = 'DESC';
        }

        if (!empty($keyword)) {
            $patients = Patient::with(['primaryimage' => function ($q) use ($section) {
                    $q->where('section', $section);
                }])->where('name', 'LIKE', "%$keyword%")
                ->orWhere('nric_passport', 'LIKE', "%$keyword%")
                ->orWhere('gender', 'LIKE', "%$keyword%")
                ->orWhere('dob', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('email_address', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->orderBy($order_by, $order)->paginate($perPage);
        } else {
            $patients = Patient::with(['primaryimage' => function ($q) use ($section) {
                    $q->where('section', $section);
                }])->orderBy($order_by, $order)->paginate($perPage);
        }

        if($request_type=='paging'){
            if(count($patients)>0){
                foreach($patients as $key => $item){
                    if(isset($item->primaryimage->image)){
                        $arr_params = array("img_folder" => $img_folder,'img_optimize_params' => $img_optimize_params,'ID' => $item->ID,'image' => isset($item->primaryimage->image)?$item->primaryimage->image:'');
                        $image_url = imageUrlGenerator($arr_params);
                    }else{
                        $image_url = asset('img-opt/images/noimage.jpg'.$img_optimize_params);
                    }
                    $patients[$key]['image_url'] = $image_url;
                }
            }

            return response()->json($patients,200);
        }else
        return view('members::frontend.patient.front-view', compact('patients','section','img_folder','img_optimize_params'));
    }

    public function detail($section_rs_ID)
    {
        $section_config = config('members.patients');
        $section = $section_config['section'];

        $img_folder = $section_config['images'];
        $arr_img_opt = array('section' => $section, 'img_size_name' => 'standard');
        $img_optimize_params = getCdnImageOptimizeParams($arr_img_opt);

        $patient = Patient::with(['images' => function ($q) use ($section) {
            $q->where('section', $section);
        }])
        ->with(['videos' => function ($q) use ($section) {
            $q->where('section', $section);
        }])
        ->with(['files' => function ($q) use ($section) {
            $q->where('section', $section);
        }])
        ->with(['metaDetails' => function ($q) use ($section) {
            $q->where('section', $section);
        }])
        ->with(['customFieldsData' => function ($q) use ($section) {
            $q->where('section', $section);
        }])
        ->findOrFail($section_rs_ID);

        $images = $patient->images;
        $files = $patient->files;
        $videos = $patient->videos;
        $customFieldsData = $patient->customFieldsData;

        return view('members::frontend.patient.front-detail', compact('patient','section','section_rs_ID','images','files','videos','customFieldsData','img_folder','img_optimize_params'));
    }

}