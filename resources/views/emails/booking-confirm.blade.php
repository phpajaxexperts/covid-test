<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="http://sandbox.kronopedia.com/css/style.css">

</head>

<body style="margin: 0;padding: 0;">

<style>
    .email-wrapper {
        font-size: 16px;
        font-family: Avenir-Medium;
        color: #185476;
    }
</style>

<table width="620" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" style="min-width: 320px;margin: auto;padding: 8px; background-color:#fff;">
    <tr>
        <td align="center">
            <br>
            <img src="{{ url('/Themes/covid/assets/img/covid-logo.png') }}">
            <br>
            <br>
        </td>
    </tr>
    <tr>
        <td class="email-wrapper" style="font: 14px/20px Verdana,Arial,sans-serif;">
            <h2>Booking Confirmed</h2>
            Thanks for booking with us.<br /><br />

            <h3>Clinic Address</h3>
            <strong>{{$data['clinic_address']->name}}</strong>
            <br>{{$data['clinic_address']->doctor_name}}
            @if(isset($data['clinic_address']->street_address_1))
                <br>{{$data['clinic_address']->street_address_1}},
            @endif
            @if(isset($data['clinic_address']->street_address_2))
            <br>{{$data['clinic_address']->street_address_2}},
            @endif
            @if(isset($data['clinic_address']->city))
            <br>{{$data['clinic_address']->city}},
            @endif
            @if(isset($data['clinic_address']->state))
            <br>{{$data['clinic_address']->state}},
            @endif
            @if(isset($data['clinic_address']->zip_code))
             {{$data['clinic_address']->zip_code}},
            @endif

            @if($data['booking_type']==1)
            <br /><br />
            <strong>Date & Time</strong>: {{$data['booking_time']}}
            @endif

            <br /><br />
            Thank You
        </td>
    </tr>
</table>
</div>
</body>
</html>