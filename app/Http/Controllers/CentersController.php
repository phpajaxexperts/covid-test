<?php

namespace App\Http\Controllers;

use App\Center;
use Illuminate\Http\Request;
use DB;
use Theme;
use GuzzleHttp;
use Modules\Members\Entities\Patient;
use Session;
use Illuminate\Support\Facades\Auth;

class CentersController extends Controller
{

    public function __construct() {
        $this->middleware(['auth:center', 'centerclearance']);
        //$this->middleware(['auth', 'clearance']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function dashboard(Request $request)
    {
        Theme::set('centers');
        return view('dashboard');
    }

    public function patients(Request $request)
    {
        Theme::set('centers');
        //$dat = date('Y-m-d',time() + 86400);
        $dat = date('Y-m-d');
        $bookings = getBookingsByDate($dat);
        return view('patients', compact('bookings','dat'));
    }

    public function updatePatient(Request $request)
    {
        Theme::set('centers');
        $bookingID = $request->ID;
        $status = $request->status;
        if($bookingID!='' && $status!=''){
            DB::table('patients_booking')
                ->where('ID', $bookingID)
                ->update(['test_result' => $status]);


            $booking = getBooking($bookingID);
            $patient = getPatient($booking->patient);
            $data = array(
                'patient' => $patient,
                'booking' => $booking,
                'test_result'=> $status
            );

            sendTestResulstUpdateMail($data);
            $response = array(
                'status'   => 'success'
            );
            return response()->json($response, 200);
        }else{
            $response = array(
                'status'   => 'failed'
            );
            return response()->json($response, 200);
        }

    }

}
