<?php

namespace App\Http\Controllers;

use App\Clinic;
use Illuminate\Http\Request;
use DB;
use Theme;
use GuzzleHttp;
use Modules\Members\Entities\Patient;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Mail\SwabCollected;

class ClinicController extends Controller
{

    public function __construct() {
        $this->middleware(['auth:clinic']);
    }

    public function dashboard(Request $request)
    {        
        Theme::set('clinic');
        return view('dashboard');
    }

    public function patients(Request $request)
    {
        Theme::set('clinic');
        //echo Auth::getName(); exit;
        //$dat = date('Y-m-d',time() + 86400);
        if($_POST){
            $dates = explode('-',$_POST['date_duration']);
            //echo '"'.trim($dates[0]).'"<br>';

            $start_date = explode('/',$dates[0]);
            $start_date = trim($start_date[2]).'-'.$start_date[1].'-'.$start_date[0];

            $end_date = explode('/',$dates[1]);
            $end_date = $end_date[2].'-'.$end_date[1].'-'.trim($end_date[0]);

//            echo "date:".$start_date;
//            echo "enddate:".$end_date;exit;

        }
        if(!isset($start_date) && !isset($end_date)){
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d');
        }

        $dat = date('d/m/Y', strtotime($start_date)).' - '.date('d/m/Y', strtotime($end_date));
        $bookings = getBookingsByDate($start_date,$end_date,Auth::id());
        return view('patients', compact('bookings','dat'));
    }

    public function updatePatient(Request $request)
    {
        Theme::set('clinic');
        $bookingID    = $request->ID;
        $payment_made = $request->paymentstatus;
        $swabstatus   = $request->swabstatus;
        if($bookingID!='' && $payment_made!='' && $swabstatus!=''){
            DB::table('patients_booking')
                ->where('ID', $bookingID)
                ->update(['swab_taken' => $swabstatus,
                'paid' => $payment_made, 'payment_mode' =>'offline']);


            $booking = getBooking($bookingID);
            $patient = getPatient($booking->patient);
            $data = array(
                'patient'       => $patient,
                'booking'       => $booking,
                'swab_taken'    => $swabstatus
            );
            
            $data['to'] = $patient->email_address;
            $data['from'] = 'noreply@jengue.co';
            $data['subject'] = 'SWAB Collection Notification';

            $booking_time = date('d/m/Y',strtotime($data['booking']->booking_time)).' at '.date('h:i A',strtotime($data['booking']->booking_time));
            $data['booking_type'] = $data['booking']->booking_type;
            $data['booking_time'] = $booking_time;


            //please check this part im getting auth requ error
            //Mail::to($data['to'])->send(new SwabCollected($data));

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

    public function logout()
    {
        //Auth::logout();
        auth('clinic')->logout();
        return redirect('/clinic');
    }
}
