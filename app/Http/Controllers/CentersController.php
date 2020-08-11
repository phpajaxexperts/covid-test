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
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Mail\TestResultQrCode;

class CentersController extends Controller
{

    public function __construct() {
        $this->middleware(['auth:center', 'centerclearance']);
        //$this->middleware(['auth', 'clearance']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function dashboard(Request $request)
    {
//        $encrypt = encrptString('Madhan how it it Welcome to chennai ithu enga ooru');
//        echo $encrypt.'<br>';
//        echo $decrypt = decryptString($encrypt);
//        exit;
       //echo Auth::guard('center')['user']->ID; exit;
        //dd(Auth::guard('center'));
        Theme::set('centers');
        return view('dashboard');
    }

    public function patients(Request $request)
    {
        Theme::set('centers');
        //$dat = date('Y-m-d',time() + 86400);
        if(isset($_POST['dat']) && $_POST['dat']!='dd-mm-yyyy')
        $dat = date('Y-m-d',strtotime($_POST['dat']));

        if(!isset($dat))
        $dat = date('Y-m-d');
        $bookings = getBookingsByDate($dat,Auth::id());
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

            //sendTestResulstUpdateMail($data);
            $data['to'] = $patient->email_address;
            $data['from'] = 'noreply@jengue.co';
            $data['subject'] = 'Covid-19 Test - Result';
            //$to = 'v.veerabharathi@gmail.com';
            //$from = 'noreply@jengue.co';
            //$subject = 'Covid-19 Test - Result';

            $booking_time = date('d/m/Y',strtotime($data['booking']->booking_time)).' at '.date('h:i A',strtotime($data['booking']->booking_time));

            if($data['test_result']==1){
                $result_type = 'POSITIVE';
                $result_note = 'Necessary actions need to be taken!';
            }elseif($data['test_result']==2){
                $result_type = 'NEGATIVE';
                $result_note = 'No action required!';
            }elseif($data['test_result']==3){
                $result_type = 'INVALID';
                $result_note = 'Invalid Result, so you have to take re-test!';
            }

            $data['result_type'] = $result_type;
            $data['result_note'] = $result_note;

            $qrcode_info = 'Name : '.$data['patient']->name.'\n';
            $qrcode_info .= 'NRIC/Passport : '.$data['patient']->nric_passport.'\n';
            $qrcode_info .= 'Email Address : '.$data['patient']->email_address.'\n';
            $qrcode_info .= 'Phone : '.$data['patient']->phone.'\n';
            $qrcode_info .= 'Test Taken on : '.$booking_time.'\n';
            $qrcode_info .= 'Test Result : '.$result_type.'\n';
            $qrcode_info .= 'Note : '.$result_note;

            //echo encrptString($qrcode_info); exit;
            $qrcode_info = encrptString($qrcode_info);
            //$qrcode = QrCode::size(300)->format('svg')->generate($qrcode_info);
            //$qrcode = QrCode::size(300)->format('png')->generate($qrcode_info);

            $data['qrcode_info'] = $qrcode_info;

            //echo "<pre>"; print_r($data); exit;
            Mail::to($data['to'])->send(new TestResultQrCode($data));

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
