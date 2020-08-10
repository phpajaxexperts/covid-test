<?php
use Illuminate\Support\Facades\DB;
use Modules\Cooking\Entities\Recipe;

function getModuleSortTypes($type){
    $sort_types = DB::table('core_sort_type')
        ->select('ID','name', 'name_short_code')
        ->where([
            ['type', '=' , $type],
            ['active', '=' , 1],
        ])
        ->get();
    return $sort_types;
}


function getCategory($ID) {
    $category = DB::table('core_category')
        ->where('core_category.ID','=',$ID)
        ->get()->first();
    return $category;
}

function getAllCategories() {
    $categories = DB::table('core_category')->get();
    return $categories;
}

function getCategories($parentid=0,$typeid='') {
    $categories = DB::table('core_category')
        ->select('core_category.*')
        ->leftJoin('core_category_mapping','core_category_mapping.category','=','core_category.ID')
        ->where('core_category_mapping.parent','=',$parentid)
        ->where('core_category_mapping.module','=',$typeid)
        //->groupBy('core_category_mapping.category')
        //->toSql();
        ->get();
    //echo $categories; exit;
    //$categories = DB::table('core_category')->where('core_category.active','=',1)->get();
    return $categories;
}

function getLanguages()
{
    $languages = DB::table('core_languages')
        ->where('core_languages.active', 1)
        ->get();
    return $languages;
}

function getDays()
{
    $days = DB::table('core_days')
        ->where('core_days.active', 1)
        ->get();
    return $days;
}

function getCenter($ID)
{
    $center = DB::table('centers')
        ->where('centers.active', 1)
        ->where('centers.ID', $ID)
        ->first();
    return $center;
}

function getBookedPatientsCountInSlot($booking_time,$center)
{
    $booked_count = DB::table('patients_booking')
        //->where('patients_booking.paid', 1)
        ->where('patients_booking.booking_time', $booking_time)
        ->where('patients_booking.center', $center)
        ->get()
        ->count();
    return $booked_count;
}

function getSeletedTimeSlotByCenter($center)
{
    $bookings = DB::table('patients_booking')
        ->select('patients_booking.booking_time')
        ->where('patients_booking.center', $center)
        ->get();
    //echo "<pre>";print_r(json_decode($bookings->toJson()));
    //echo "<pre>";print_r(array_values($bookings->toArray())); exit;
    $resultArray = array();
    $arr = objToArray($bookings, $resultArray);

    //echo "<pre>";print_r(array_values($arr));

    return $arr;
}



function getCenters($testType)
{
    if($testType=='pre-screening')
        $testType = 1;
    elseif($testType=='point-of-entry-test')
        $testType = 2;

    $days = DB::table('centers')
        ->where('centers.active', 1)
        ->where('centers.process_type', $testType)
        ->get();
    return $days;
}

function getCountries()
{
    $countries = DB::table('core_country')
        ->where('core_country.active', 1)
        ->get();
    return $countries;
}

function getHoursOfOperation($centerID)
{
    $hours = DB::table('centers_hours_of_operation')
        ->select('centers_hours_of_operation.*','core_days.name as day_name')
        ->join('core_days','core_days.ID','=','centers_hours_of_operation.day')
        ->where('centers_hours_of_operation.center', $centerID)
        //->toSql();
        ->get();
//echo $hours; exit;
    //dd($hours);

    return $hours;
}


function getChildUsers($userid)
{
    $child_users = DB::table('cast_crews')
        ->where('cast_crews.parent', $userid)
        ->get();
    return $child_users;
}

global $res_count;
function getBinaryTree($userid)
{

    $user = getUser($userid);
    $arr_users_tree[$user->parent]['ID'] = $user->ID;
    $arr_users_tree[$user->parent]['first_name'] = $user->first_name;
    $arr_users_tree[$user->parent]['left_right'] = $user->left_right;

    //echo $user->first_name.'<br>';
    $width = 100;
    $res_count = 1;
    $float = '';
    if($user->left_right=='l')
        $float = 'left';
    elseif($user->left_right=='r')
        $float = 'right';

    $child_users = getChildUsers($userid);
    if(count($child_users)>0){
        $res_count = 2;
        if($userid!=3)
            $div_witdh =  $width/$res_count;
        else
            $div_witdh =  100;
    }else
        $div_witdh =  50;

    if($user->file_name)
        $img = '<img src="'.asset('media/cast/'.$user->file_name).'" height="50" width="50"><br><br>';
    else
        $img = '<img src="'.asset('media/no-image.jpg').'" height="50" width="50"><br><br>';

    //$ling_img = '<img src="'.asset('media/line_bg.gif').'">';

    //echo "<div style='color:#000;width:$div_witdh%;margin-top:10px;text-align:center;float:$float'><div style='border-bottom: 1px solid;margin:2px;'><br><br>$img <h1>$user->first_name</h1><br><br></div>";
    echo "<div style='color:#000;margin-top:10px;text-align:center;float:$float'><div style='border-bottom: 1px solid;margin:2px;'><br><br><a href='?ID=$user->ID'>$img <h1>$user->first_name</h1><br><br></div>";


    if(count($child_users)>0){

        $div_witdh =  $width/$res_count;
        foreach($child_users as $child_user){
//            $child_users_childs = getChildUsers($child_user->ID);
//            if(count($child_users_childs)>0){
//                getBinaryTree($userid);
//            }else{
//                $arr_users_tree[] = $child_user->first_name;
//            }
            getBinaryTree($child_user->ID);

        }
    }
    echo "</div>";
    //echo "<pre>"; print_r($arr_users_tree);
    return $arr_users_tree;
}


function objToArray($obj, &$arr){

    if(!is_object($obj) && !is_array($obj)){
        $arr = $obj;
        return $arr;
    }

    foreach ($obj as $key => $value)
    {
        if (!empty($value))
        {
            $arr[$key] = array();
            objToArray($value, $arr[$key]);
        }
        else
        {
            $arr[$key] = $value;
        }
    }
    return $arr;
}

function getBooking($ID){
    $booking = DB::table('patients_booking')
        ->where('patients_booking.ID', $ID)
        ->first();
    return $booking;
}

function getPatient($ID){
    $patient = DB::table('patients')
        ->where('patients.ID', $ID)
        ->first();
    return $patient;
}

function searchForBookingTime($booking_time, $array) {
    foreach ($array as $key => $val) {
        if ($val['booking_time'] === $booking_time) {
            return 1;
        }
    }
    return 0;
}


function bookingConfirmMail($data){
    //echo "<pre>";print_r($data); exit;
    $to = $data['patient']->email_address;
    //$to = 'v.veerabharathi@gmail.com';
    $from = config('app.noreply_email_address');
    $subject = 'Covid-19 Test - Booking Confirmation';

    $hostname = request()->getSchemeAndHttpHost();
    $host = asset('/');

    $clinic_address = '<strong>'.$data['center']->name.'</strong><br>'.$data['center']->doctor_name.'<br>'.$data['center']->street_address_1.',';
    if($data['center']->street_address_2)
        $clinic_address .= '<br>'.$data['center']->street_address_2.',';
    $clinic_address .= '<br>'.$data['center']->city.', '.$data['center']->state.' '.$data['center']->zip_code.'.';

    $booking_time = date('d/m/Y h:i A',strtotime($data['booking']->booking_time));

    $mssg = <<< EOM
<html>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="center"><img src="$host/Themes/covid/assets/img/covid-logo.png" alt="logo" /></td>
</tr>
<tr>
<td valign="top" style="font: 14px/20px Cambria;"><br />
<h2>Booking Confirmed</h2>
Thanks for booking with us.<br /><br />

<h3>Clinic Address</h3>
$clinic_address
<br /><br />

<h3>Date & Time</h3>
$booking_time

<br /><br />
Thank You
EOM;


    $mssg .= <<< EOM
</td>
</tr>
</table>
</body>
</html>
EOM;

//print_r($mssg); exit;

// echo "Your request has been added successfully.";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: Jengu.co<" . $from.">";
    $stat = mail($to,$subject,$mssg,$headers);
    if($stat){
        echo "mail sent".$stat;
    }else{
        echo "mail not sent".$stat;
    }
}

function getBookingsByDate($dat){
    $bookings = DB::table('patients_booking')
        ->select('patients_booking.*','patients.name','patients.phone')
        ->join('patients','patients.ID','=','patients_booking.patient')
        ->where('patients_booking.booking_date', $dat)
        ->where('patients_booking.paid', 1)
        ->orderBy('patients.name','asc')
        ->get();
        //->toSql();
    //echo $dat; exit;
    //echo $bookings; exit;
    //dd($bookings);
    return $bookings;
}

function sendTestResulstUpdateMail($data){
    //$to = $data['patient']->email_address;
    $to = 'veerabharathi2020@gmail.com';
    $from = config('app.noreply_email_address');
    $subject = 'Covid-19 Test - Result';

    $hostname = request()->getSchemeAndHttpHost();
    $host = asset('/');

    $booking_time = date('d/m/Y h:i A',strtotime($data['booking']->booking_time));
    if($data['test_result']==1)
        $test_result = '<span style="color:#FF0000"><h3>'.$data['test_result'].'</h3></span><br> Note: Necessary actions need to be taken!';
    elseif($data['test_result']==2)
        $test_result = '<span style="color:#00FF00"><h3>'.$data['test_result'].'</h3></span>';
    elseif($data['test_result']==3)
        $test_result = '<span style="color:#EEEEEE"><h3>'.$data['test_result'].'</h3></span><br> Note: Invalid Result, so you have to take re-test!';
    $qrcode = QrCode::format('svg')->generate('This is test QR code by Veera!');
    $mssg = <<< EOM
<html>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="center"><img src="$host/Themes/covid/assets/img/covid-logo.png" alt="logo" /></td>
</tr>
<tr>
<td valign="top" style="font: 14px/20px Cambria;"><br />
<h2>Test Result</h2>
Covid-19 Test Taken on $booking_time.<br /><br />

<strong>Result :</strong> <br>
$test_result
<br>
$qrcode
<br /><br />
Thank You
EOM;


    $mssg .= <<< EOM
</td>
</tr>
</table>
</body>
</html>
EOM;

//print_r($mssg); exit;

// echo "Your request has been added successfully.";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: Jengu.co<" . $from.">";
    $stat = mail($to,$subject,$mssg,$headers);
//    if($stat){
//        echo "mail sent".$stat;
//    }else{
//        echo "mail not sent".$stat;
//    }
}
?>
