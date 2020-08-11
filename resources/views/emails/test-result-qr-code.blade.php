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
        <td class="email-wrapper">
            <h2>Covid-19 Test Result</h2>
            You have received test result for Covid-19 Test Taken on $booking_time.<br />
            $test_result

            <img src="{!!$message->embedData(QrCode::format('png')->generate($data['qrcode_info']), 'QrCode.png', 'image/png')!!}">
                {{--First Name: {{$data['first_name']}}<br>--}}
                {{--Last Name: {{$data['last_name']}}<br>--}}
                {{--Email Address: <a href="mailto:{{$data['email_address']}}">{{$data['email_address']}}</a><br>--}}
                {{--Phone :{{$data['phone_number']}}<br>--}}
                {{--@if($data['comments'])--}}
                {{--Message :--}}
                {{--{{$data['comments']}}--}}
                {{--<br><br>--}}
                {{--@else--}}
                    {{--<br>--}}
                {{--@endif--}}
        </td>
    </tr>
</table>
</div>
</body>
</html>