<?php

namespace App\Http\Controllers;

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
        $patients = getPatientsByDate($dat);
        return view('patients', compact('patients','dat'));
    }

    public function updatePatient(Request $request)
    {
        Theme::set('centers');
        $bookingID = $request->bookingID;
        $booking = getBooking($bookingID);
        return view('update-patient', compact('booking'));
    }

}
