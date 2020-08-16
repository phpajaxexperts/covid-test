<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Theme;
use GuzzleHttp;
use Modules\Members\Entities\Patient;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Mail\BookingConfirm;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function bookPreScreeningTest(Request $request)
    {
        Session::regenerate(true);
        $testType = 'pre-screening';
        Theme::set('covid');
        return view('pre-screening-test', compact('testType'));
    }

    public function bookPointOfEntryTest(Request $request)
    {
        Session::regenerate(true);
        //$testType = $request->testType;
        $testType = 'point-of-entry';
        Theme::set('covid');
        return view('point-of-entry-test', compact('testType'));
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

        $fields = [
            'name' => 'required|max:255',
            'identity_type' => 'required',
            'nric_passport' => 'required',
            'phone' => 'required',
            'email_address' => 'required',
            'country' => 'required',
            'testType' => 'required',
            'selectedCenter' => 'required'
        ];

        if($requestData['testType']=='point-of-entry'){
            $fields['traveller_type'] = 'required';
            $fields['lane_type'] = 'required';

            $messages['traveller_type'] = 'Traveller type is required field';
            $messages['lane_type'] = 'Lane type is required field';
        }elseif($requestData['testType']=='pre-processing'){
            $fields['selectedTimeSlot'] = 'selectedTimeSlot.required';
            $messages['selectedTimeSlot'] = 'Date & Time is required field!';
        }


        $this->validate($request, $fields,$messages);
        
        $check_exist = checkActiveBookingValidation($nric_passport,$email_address,$phone);
        if(isset($check_exist)){    
            if(isset($check_exist->ID)){
                $response = array(
                    'status'   => 'failed',
                    'msg' => 'Given information booking is aready exist and active.'
                );
                return response()->json($response, 200);
            }else{
            
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
            elseif($requestData['testType']=='point-of-entry')
                $testType = 2;


            if(isset($requestData['offline_payment']))
                $offline_payment = $requestData['offline_payment'];
            else
                $offline_payment = '';



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

                if($requestData['testType']=='point-of-entry')
                {
                    $arr_payment['traveller_type']  = $requestData['traveller_type'];
                    $arr_payment['lane_type'] = $requestData['lane_type'];

                    if($offline_payment=='yes'){
                        $arr_payment['payment_mode'] = 'offline';
                    }
                }

                $bookingID = DB::table('patients_booking')->insertGetId($arr_payment);
            }else
                $bookingID = $booking_exist->ID;


            if($requestData['testType']=='pre-screening' && $requestData['country']=='132'){
                $title = 'Pre Screening Test';
                $amount = 200;
            }elseif($requestData['testType']=='pre-screening' && $requestData['country']!='132'){
                $title = 'Pre Screening Test';
                $amount = 250;
            }elseif($requestData['testType']=='point-of-entry' &&  $requestData['traveller_type']=='RGL' && $requestData['country']!='132'){
                $title = 'Point of Entry Test - RGL';
                $amount = 130;
            }elseif($requestData['testType']=='point-of-entry' &&  $requestData['traveller_type']=='PCA' && $requestData['country']=='132'){
                $title = 'Point of Entry Test - PCA';
                $amount = 200;
            }


            $amount = 2;
            if($offline_payment=='yes'){

                $booking = getBooking($bookingID);
                $patient = getPatient($booking->patient);
                $center = getCenter($booking->center);

                $data = array(
                    'patient' => $patient,
                    'booking' => $booking,
                    'center' => $center
                );
                //bookingConfirmMail($data);

                $clinic_address = '<strong>'.$data['center']->name.'</strong><br>'.$data['center']->doctor_name.'<br>'.$data['center']->street_address_1.',';
                if($data['center']->street_address_2)
                    $clinic_address .= '<br>'.$data['center']->street_address_2.',';
                $clinic_address .= '<br>'.$data['center']->city.', '.$data['center']->state.' '.$data['center']->zip_code.'.';
                $booking_time = date('d/m/Y',strtotime($data['booking']->booking_time)).' at '.date('h:i A',strtotime($data['booking']->booking_time));
                $data['clinic_address'] = $center;
                $data['booking_time'] = $booking_time;
                $data['booking_type'] = $data['booking']->booking_type;

                $data['to'] = $data['patient']->email_address;
                //$to = 'v.veerabharathi@gmail.com';
                $data['from'] = config('app.noreply_email_address');
                $data['subject'] = 'Covid-19 Test - Booking Confirmation';

                //echo "<pre>"; print_r($data); exit;
                Mail::to($data['to'])->send(new BookingConfirm($data));

                $response = array(
                    'status'   => 'offline_payment',
                    'bookingID' => $bookingID
                );
                return response()->json($response, 200);
            }else{
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
            }
        }else{
            $response = array(
                'status'   => 'slot_filled',
                'msg' => 'Selected time slot filled, so please try any other time slot to book. Thank you'
            );
            return response()->json($response, 200);
        }
    }

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
                ->update(['paid' => 1,'payment_mode' => 'online']);

            $data = array(
                'patient' => $patient,
                'booking' => $booking,
                'center' => $center
            );
            //bookingConfirmMail($data);

            $clinic_address = '<strong>'.$data['center']->name.'</strong><br>'.$data['center']->doctor_name.'<br>'.$data['center']->street_address_1.',';
            if($data['center']->street_address_2)
                $clinic_address .= '<br>'.$data['center']->street_address_2.',';
            $clinic_address .= '<br>'.$data['center']->city.', '.$data['center']->state.' '.$data['center']->zip_code.'.';
            $booking_time = date('d/m/Y',strtotime($data['booking']->booking_time)).' at '.date('h:i A',strtotime($data['booking']->booking_time));
            $data['clinic_address'] = $center;
            $data['booking_time'] = $booking_time;
            $data['booking_type'] = $data['booking']->booking_type;


            $data['to'] = $data['patient']->email_address;
            //$to = 'v.veerabharathi@gmail.com';
            $data['from'] = config('app.noreply_email_address');
            $data['subject'] = 'Covid-19 Test - Booking Confirmation';

            //echo "<pre>"; print_r($data); exit;
            Mail::to($data['to'])->send(new BookingConfirm($data));

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
            ->select('centers.*','patients_booking.booking_time','patients_booking.booking_type')
            ->join('patients_booking','patients_booking.ID','=','payments.booking')
            ->join('centers','centers.ID','=','patients_booking.center')
            ->where('payments.bill_id','=',$bill_id)
            ->first();

        return view('payment-success',compact('bill_id','booking'));
    }

    public function updateAmountPaid(Request $request)
    {
        $message = '';
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

    public function collectionLogin(Request $request)
    {
        $email_address = $request->email_address;
        $password = $request->password;
        //$credentials = $request->only('collection_email_address', 'collection_password');
        $user = DB::table('centers')
            ->where('centers.collection_email_address','=',$email_address)
            ->where('centers.collection_password','=',md5($password))
            ->first();
            //->toSql();

        //dd($user); exit;

        //if (Auth::guard('center')->attempt(['collection_email_address' => $email_address, 'collection_password' => $password])) {
        if(isset($user)){
            if(isset($user->ID)){
                $user = array(
                    'ID' => $user->ID,
                    'name' => $user->name,
                );

                session(['user' => $user]);
                session::save();

                //dd(session()->get('user'));
                return redirect('collection/manual-bookings');
            }else{
                return redirect('collection');
            }
        }else{
            return redirect('collection');
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
        if(isset($booking)){
            
            $result_expired = strtotime ( '+72 hour' , strtotime($booking->swab_taken) ) ;
            if(time()>$result_expired){
                $response = array(
                    'status' => 'expired',
                    'result' => 'Test result expired.'
                );
                return response()->json($response, 200);
            }else{
                $patient = getPatient($booking->patient);
                $center = getCenter($booking->center);

                if($booking->test_result==1)
                    $test_result = 'positive';
                elseif($booking->test_result==2)
                    $test_result = 'negative';
                elseif($booking->test_result==3)
                    $test_result = 'invalid';

                if($patient->identity_type==1)
                    $identity_type = 'NRIC';
                elseif($patient->identity_type==2)
                    $identity_type = 'Passport Number';

                if($booking->booking_type==1)
                $test_date = date('M d, Y',strtotime($booking->booking_time)).' at '.date('h:i A',strtotime($booking->booking_time));
                else
                $test_date = date('M d, Y',strtotime($booking->created_dt)).' at '.date('h:i A',strtotime($booking->created_dt));
                $result = array(
                    'test_result' => $test_result,
                    'name' => $patient->name,
                    'nationality' => $patient->country_name,
                    'identity_type' => $identity_type,
                    'identity_number' => $patient->nric_passport,
                    'test_date' => $test_date,
                    'issuer' => $center->name,
                );

                $response = array(
                    'status' => 'success',
                    'result' => $result
                );
                return response()->json($response, 200);
            }
        }else{
            $response = array(
                'status' => 'failed',
                'result' => 'Invalid, input data.'
            );
            return response()->json($response, 200);
        }
    }

    public function getTimeSlots(Request $request)
    {
        Theme::set('covid');
        $centerID = $request->centerID;
        $center = getCenter($centerID);
        $selected_time_slots = getSeletedTimeSlotByCenter($center->ID);
        return view('get-time-slots',compact('centerID','center','selected_time_slots'));
    }

    public function bookingConfirm(Request $request)
    {
        $bookingID = $request->bookingID;
        Theme::set('covid');

        $booking = DB::table('patients_booking')
            ->select('centers.*','patients_booking.booking_time','patients_booking.booking_type')
            ->join('centers','centers.ID','=','patients_booking.center')
            ->where('patients_booking.ID','=',$bookingID)
            ->first();

        return view('booking-confirm',compact('bookingID','booking'));
    }

    public function qrCodeGenerator(Request $request)
    {
        $ID = encrptString($request->ID);
        Theme::set('covid');
        return view('qr-code-generator',compact('ID'));
    }

    }
