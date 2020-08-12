<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Theme;
use GuzzleHttp;
use Modules\Members\Entities\Patient;
use Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function bookTest(Request $request)
    {
        Session::regenerate(true);
        $testType = $request->testType;
        Theme::set('covid');
        return view('book-test', compact('testType'));
    }

    public function paymentProcessInit(Request $request)
    {

        $requestData = $request->all();

        $messages = [
            'name.required' => 'Name is required field!',
            'identity_type.required' => 'Identity Type is required field!',
            'nric_passport.required' => 'NRIC/Passport is required field!',
            'phone.required' => 'Phone is required field!',
            'email_address.required' => 'Email Address is required field!',
            'country.required' => 'Country is required field!',
            'testType.required' => 'Pre Procession or Point of entry selection is required field!',
            'selectedCenter.required' => 'Center is required field!',
            'selectedTimeSlot.required' => 'Date & Time is required field!',

        ];

        $this->validate($request, [
            'name' => 'required|max:255',
            'identity_type' => 'required',
            'nric_passport' => 'required',
            'phone' => 'required',
            'email_address' => 'required',
            'country' => 'required',
            'testType' => 'required',
            'selectedCenter' => 'required',
            'selectedTimeSlot' => 'required',
        ],$messages);


        //echo "<pre>";print_r($requestData); exit;
        $requestData['active'] = 1;
        $requestData['phone'] = $requestData['phone_country_code'].$requestData['phone'];
        $session_id = Session::getId();
        $requestData['sessionid'] = $session_id;
        $booking_time = date('Y-m-d H:i',strtotime($requestData['selectedTimeSlot']));
        $booking_date = date('Y-m-d',strtotime($requestData['selectedTimeSlot']));

        $center = getCenter($requestData['selectedCenter']);
        $patients_per_slot = $center->patients_per_slot;


        $booking_exist = checkSessionIDExist($session_id);

        if(!isset($booking_exist))
            $booked_patients_count_in_slot = getBookedPatientsCountInSlot($booking_time,$center->ID);
        else
            $booked_patients_count_in_slot = 0;
        if($patients_per_slot>$booked_patients_count_in_slot || isset($booking_exist)){
            if(!isset($booking_exist))
            $ID = Patient::create($requestData)->ID;
            else
            $ID = $booking_exist->patient;

            //echo date('Y-m-d H:ia',strtotime($requestData['selectedTimeSlot'])); exit;
            //$booked_times = explode(' ',$requestData['selectedTimeSlot']);
            //$booked_time = $booked_times[0].' '.$booked_times[1].$booked_times[2];

            if($requestData['testType']=='pre-screening')
                $testType = 1;
            elseif($requestData['testType']=='point-of-entry-test')
                $testType = 2;

            if(!isset($booking_exist)){
                $arr_payment = array(
                    'patient' => $ID,
                    'center' => $center->ID,
                    'booking_type' => $testType,
                    'booking_date' => $booking_date,
                    'booking_time' => $booking_time,
                    'sessionid' => $session_id,
                    'commute_by' => $requestData['commute_by'],
                );

                $bookingID = DB::table('patients_booking')->insertGetId($arr_payment);
            }else
                $bookingID = $booking_exist->ID;


            if($requestData['testType']=='pre-screening' && $requestData['country']=='132'){
                $title = 'Pre Screening Test';
                $amount = 200;
            }elseif($requestData['testType']=='pre-screening' && $requestData['country']!='132'){
                $title = 'Pre Screening Test';
                $amount = 250;
            }elseif($requestData['testType']=='point-of-entry-test'){
                $title = 'Point of Entry Test';
                $amount = 130;
            }


            if(config('app.raudhapay_payment_gateway_status')=='live'){
                $api_url = config('app.raudhapay_live.api_url');
                $collection_code = config('app.raudhapay_live.collection_code');
                $access_token = config('app.raudhapay_live.api_token');
            }else{
                $api_url = config('app.raudhapay_sandbox.api_url');
                $collection_code = config('app.raudhapay_sandbox.collection_code');
                $access_token = config('app.raudhapay_sandbox.api_token');
            }


            $url = $api_url.'/collections/'.$collection_code.'/bills?include=product-collections.product';
            $product[] = array(
                'title' => $title,
                'price' => $amount,
                'quantity' => '1',
            );
            $data = array(
                'due' => date('Y-m-d'),
                'currency' => 'MYR',
                'ref1' => $session_id,
                'ref2' => $bookingID,
                'customer' => array(
                    'first_name' => $requestData['name'],
                    "last_name"=> $requestData['name'],
                    "address" => $requestData['name'],
                    "email" => $requestData['email_address'],
                    "mobile"=> str_replace('+','',$requestData['phone'])
                    ),
                'product' => $product
            );


            $res = curlPost($url,$data,$access_token);

            //echo "<pre>";print_r($res); exit;

            if(isset($res->status)){
                if($res->status == 2){
                    $response = array(
                        'payment_url' => $res->payment_url,
                        'status'   => 'success'
                    );
                }else{
                    $response = array(
                        'status'   => 'failed'
                    );
                }
            }else{
                $response = array(
                    'status'   => 'failed',
                    'payment_err_msg'   => $res,
                );
            }

            return response()->json($response, 200);
        }else{
            $response = array(
                'status'   => 'slot_filled',
                'msg' => 'Selected time slot filled, so please try any other time slot to book. Thank you'
            );
            return response()->json($response, 200);
        }
//        if($res->status==2){
//            return redirect($res->payment_url);
//        }

        //return view('payment-process-init');
    }

    public function paymentConfirm(Request $request)
    {
        //echo "<pre>";print_r($_REQUEST);

        if($_REQUEST['paid']=='1'){
            $sessionid = $_REQUEST['ref1'];
            $bookingID = $_REQUEST['ref2'];
            $booking = getBooking($bookingID);
            $center = getCenter($booking->center);
            //echo $sessionid; exit;
            $patient = DB::table('patients')
                ->where('patients.sessionid', $sessionid)
                ->first();

            //print_r($patient); exit;
            $arr_payment = array(
                'patient' => $patient->ID,
                'booking' => $bookingID,
                'amount' => $_REQUEST['amount'],
                'bill_id' => $_REQUEST['bill_id'],
                'bill_no' => $_REQUEST['bill_no'],
                'currency' => $_REQUEST['currency'],
                'paid' => $_REQUEST['paid'],
                'payment_method' => $_REQUEST['payment_method'],
                'ref_id' => $_REQUEST['ref_id'],
                'status' => $_REQUEST['status'],
                'signature' => $_REQUEST['signature'],
            );
            $ID = DB::table('payments')->insertGetId($arr_payment);

            DB::table('patients_booking')
                ->where('ID', $bookingID)
                ->update(['paid' => 1]);

            $data = array(
                'patient' => $patient,
                'booking' => $booking,
                'center' => $center
            );
            bookingConfirmMail($data);
            Session::regenerate(true);
            return redirect('/payment-receipt/'.$arr_payment['bill_id']);
        }else{
            return view('payment-failed',compact('bill_id'));
        }
    }

    public function paymentReceipt(Request $request)
    {
        $bill_id = $request->bill_id;
        Theme::set('covid');

        $booking = DB::table('payments')
            ->select('centers.*','patients_booking.booking_time')
            ->join('patients_booking','patients_booking.ID','=','payments.booking')
            ->join('centers','centers.ID','=','patients_booking.center')
            ->where('payments.bill_id','=',$bill_id)
            ->first();

        return view('payment-success',compact('bill_id','booking'));
    }

    public function updateAmountPaid(Request $request)
    {
        foreach ($_POST as $key => $value)
            $message .= "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

        mail('noreply@jengu.co','this web hook update test for ', $message );
    }


    public function centerLogin(Request $request)
    {
        $email_address = $request->email_address;
        $password = $request->password;
        $credentials = $request->only('email_address', 'password');
        if (Auth::guard('center')->attempt($credentials)) {
            return redirect('center/dashboard');
        }else{
            return redirect('center');
        }
    }

    public function qrcodeDecrypt(Request $request)
    {
        $arr = $request->json()->all();
//        print_r($request->json()->all()); exit;
//        echo "<pre>";print_r($qrdata);
//        $from = 'v.veerabharathi@gmail.com';
//        $headers  = 'MIME-Version: 1.0' . "\r\n";
//        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//        $headers .= "From: Jengu.co<" . $from.">";
//        mail('noreply@jengu.co','API REQUEST', 'THIS is api request'.$arr['qrdata'],$headers);

        $bookingID = decryptString($arr['qrdata']);
        $booking = getBooking($bookingID);
        $patient = getPatient($booking->patient);
        $center = getCenter($booking->center);

        if($booking->test_result==1)
            $test_result = 'positive';
        elseif($booking->test_result==2)
            $test_result = 'negative';
        elseif($booking->test_result==3)
            $test_result = 'invalid';

        $result = array(
            'test_result' => $test_result,
            'name' => $patient->name,
            'test_date' => date('M d, Y',strtotime($booking->booking_time)).' at '.date('h:s A',strtotime($booking->booking_time)),
            'issuer' => $center->name,
        );

        $response = array(
            'status' => 'success',
            'result' => $result
        );
        return response()->json($response, 200);
    }


    }
