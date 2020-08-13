@extends('layouts.master')


@push('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="{{ themes('css/intlTelInput.min.css') }} ">
<link rel="stylesheet" href="{{ themes('sweetalert2/sweetalert2.css') }} ">
<style>
    .iti {
        width: 100%;
    }
    .iti__selected-flag{
        height: 35px !important;
    }
    body{
        font-size: 13px;
    }
    #intro p{
        font-size: 13px;
        color: black;
    }
    .form-control{
        border-radius:0px;
    }
    .tabs_hop .ui-widget-header{
        border: 0px;
        background: none;
    }

    .tabs_hop .ui-widget-content{
        border: 0px;
    }

    .tabs_hop.ui-widget.ui-widget-content {
        border: 0px;
    }

    a.centers_links{
        background-color: #FFF;
    }


    a.centers_links:hover{
        background-color: #CCC;
    }

    input.error{
        border: 1px solid #FF0000;
    }

    label.error{
        color: #FF0000;
    }

</style>
@endpush

@push('js')
<script>
    $(function () {

    });


    Pace.on("done", function(){
        $(".pageCover").fadeIn(2000);
    });
</script>


<script src="{{ themes('js/intlTelInput.min.js') }}"></script>
<script src="{{ themes('js/utils.js') }}"></script>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ themes('js/jquery.validate.min.js') }}"></script>
<script src="{{ themes('sweetalert2/sweetalert2.js')}}"></script>
<script src="{{ themes('js/moment.js')}}"></script>
<script src="{{ themes('js/jquery.mask.min.js')}}"></script>
<script>
    var input = document.querySelector("#phone");
    var iti = intlTelInput(input);
//    window.intlTelInput(input, {
//        // any initialisation options go here
//    });

    frmRegisterInit();

    $("#frmPaymentConfirm").validate({
//        rules: {
//            confirm_terms:{ required: true} ,
//        },
//        messages: {
//            confirm_terms: "Please accept terms and conditions",
//        },
        submitHandler: function(form) {

            var testType = $('#testType').val();
            var selectedCenter = $('#selectedCenter').val();
            var selectedDate = $('#selectedDate').val();
            var selectedTime = $('#selectedTime').val();
            var selectedTimeSlot = $('#selectedTimeSlot').val();

            if($('#commute_by').length>0){
                var commute_by = $('#commute_by').val();
            }else{
                var commute_by = '';
            }


            var data = $( '#frmRegister' ).serialize()
            console.log("country data"+iti.getSelectedCountryData());
            var countryData = iti.getSelectedCountryData();
            //var phone_country_code = $("#phone").intlTelInput("getSelectedCountryData").dialCode;
            var phone_country_code = countryData.dialCode;
            var param = data+'&testType='+testType+'&selectedCenter='+selectedCenter+'&selectedDate='+selectedDate+'&selectedTime='+selectedTime+'&selectedTimeSlot='+selectedTimeSlot+'&phone_country_code='+phone_country_code+'&commute_by='+commute_by;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ url('/payment-process-init') }}",
                data: param,
                //async: false,
                success: function(msg){
                    $("#loadingPayment").hide();
                    if(msg.status=='success')
                        window.location = msg.payment_url;
                    else
                        if(msg.status=='slot_filled'){
                            swal.close();
                            Swal.fire({
                                title: 'Request failed, please correct the following details!',
                                html: msg.msg,// add html attribute if you want or remove
                            });
                        }else{
                            if(msg.payment_err_msg!=''){
                                var errMsg = '';
                                var data = msg.payment_err_msg;
                                $.each(data, function(i, item) {
                                    errMsg += data[i][0]+'<br>';
                                });
                                //alert('Request failed, please try again\n'+errMsg);
                                swal.close();
                                Swal.fire({
                                    title: 'Request failed, please correct the following details!',
                                    html: errMsg,// add html attribute if you want or remove
                                });
                            }else{
                                swal.close();
                                Swal.fire({
                                    title: 'Request failed, please try again!',
                                    html: '',// add html attribute if you want or remove
                                });
                            }
                        }
                },
                statusCode: {
                    422: function(xhr) {
                        //if(window.console) console.log(xhr.responseText);
                        var data = jQuery.parseJSON( xhr.responseText );
                        var errors = data.errors;
                        var errMsg = '';
                        $.each(errors, function(i, item) {
                            errMsg += errors[i][0]+'<br>';
                        });
                        //alert(data.message+'\n'+errMsg);
                        Swal.fire({
                            title: 'Please Wait !',
                            html: data.message+'<br>'+errMsg,// add html attribute if you want or remove
                        });
                        //alert(data.message);
                    }
                },
                beforeSend: function(){
                    //Loading....
                    Swal.fire({
                        title: 'Please Wait !',
                        html: '',// add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                complete: function(){

                }
            });

        }
    });

    var currentTab = 0;
    $(function () {
        $("#tabs").tabs({
            active: 0,
            disabled: [1, 2, 3]
    });

        $(".tabs_hop").tabs({
            active: 0
        });

        //MaxDate = DateTime.Now;
    });

    function selectCenter(centerID){
        $( "#divSelectedCenter" ).html($( "#center_"+centerID+"" ).html());
        $( "#divSelectedCenterConfirm" ).html($( "#center_"+centerID+"" ).html());
        $( "#selectedCenter").val(centerID);
        $ ("#tabs" ).tabs("enable", 2);
        $( "#tabs" ).tabs({ active: 2 });
        $( ".center_hours_of_operation").hide();
        $( "#center_hours_of_operation_"+centerID).show();
    }

    function selectedDateTime(dattime,date,time){
        $( "#selectedTimeSlot" ).val(dattime);
        $( "#selectedDate" ).val(date);
        $( "#selectedTime" ).val(time);

        submitPersonalDetails();
    }

    function submitPersonalDetails(){
        $( "#divDateConfirm" ).html($( "#selectedDate" ).val());
        $( "#divTimeConfirm" ).html($( "#selectedTime" ).val());

        $( "#divConfirmName" ).html($( "#name" ).val());
        $( "#divConfirmDob" ).html( moment($( "#dob" ).val()).format('DD-MM-YYYY') );
        if($( "#identity_type" ).val()==1){
            $( "#divConfirmICPassportNumber" ).html($( "#nric_number" ).val());
            $( "#spanConfirmICPassportNumber" ).html('NRIC Number');
        }else if($( "#identity_type" ).val()==2){
            $( "#divConfirmICPassportNumber" ).html($( "#passport_number" ).val());
            $( "#spanConfirmICPassportNumber" ).html('Passport Number');
        }
        //var phone_country_code = $("#phone").intlTelInput("getSelectedCountryData").dialCode;
        //$( "#divConfirmContactNumber" ).html(phone_country_code+$( "#phone" ).val());
        var countryData = iti.getSelectedCountryData();
        var phone_country_code = countryData.dialCode;
        $( "#divConfirmContactNumber" ).html('+'+phone_country_code+$( "#phone" ).val());
        var gender_id = $('input[name="gender"]:checked').val();
        if(gender_id==1)
            var gender='Male';
        else
            var gender='Female';
        $( "#divConfirmGender" ).html(gender);
        $( "#divConfirmEmailAddress" ).html($( "#email_address" ).val());
        $( "#divConfirmNationality" ).html($( "#country option:selected" ).text());

        testAmountCalc();
        $ ("#tabs" ).tabs("enable", 3);
        $( "#tabs" ).tabs({ active: 3 });
    }

    function testAmountCalc(){
        if($( "#testType" ).val()=='pre-screening' && $( "#country" ).val()=='132')
            $( "#divConfirmAmount" ).html('200');
        else if($( "#testType" ).val()=='pre-screening' && $( "#country" ).val()!='132')
            $( "#divConfirmAmount" ).html('250');
        else if($( "#testType" ).val()=='point-of-entry-test')
            $( "#divConfirmAmount" ).html('130');
    }

    function commuteBySelected(val){
        if(val==1){
            $('#center_4').show();
            $('#center_5').hide();
        }else if(val==2){
            $('#center_4').hide();
            $('#center_5').show();
        }else if(val==3){
            alert('Test not required');
        }
    }

    function showHideIdentityType(val) {
        $('#div_nric_passport').show();
        if(val==1){
            var identity_template = '<div class="form-group"><label for="nric_passport" class="control-label">ID Number</label><div><input class="form-control" name="nric_passport" type="text" id="nric_number"" placeholder="000000-00-0000" ></div></div>';
            $( "#spanConfirmICPassportNumber" ).html('NRIC Number');
        }else{
            var identity_template = '<div class="form-group"><label for="nric_passport" class="control-label">Passport Number</label><div><input class="form-control" name="nric_passport" type="text" id="passport_number"" ></div></div>';
            $( "#spanConfirmICPassportNumber" ).html('Passport Number');
        }
        $('#divNricPassport').html(identity_template);
        $( "#passport_number" ).keyup(function() {
            $( "#divConfirmICPassportNumber" ).html($( "#passport_number" ).val());
        });

        $( "#nric_number" ).keyup(function() {
            $( "#divConfirmICPassportNumber" ).html($( "#nric_number" ).val());
        });
        $('#nric_number').mask('000000-00-0000');
        frmRegisterInit();
    }

    function frmRegisterInit(){
        $("#frmRegister").validate({
            rules: {
                name: {
                    required: true
                },
                nric_number: {
                    required: true
                },
                passport_number: {
                    required: true
                },
                dob : { required: true },
                gender : { required: true },
                phone: {
                    required: true,
                    maxlength: 15
                },
                email_address: {
                    required: true,
                    email: true
                },
                symtoms:{ required: true, requiredRadioValue: "0"} ,
                symtoms2:{
                    required: true,
                    requiredRadioValue: "0"
                } ,
                travelled_infected_country:{ required: true, requiredRadioValue: "0"} ,
                terms:{ required: true} ,
                country:{ required: true},
                commute_by:{ required: true},
            },
            messages: {
                name: "Please enter your full name.",
                nric_number: "Please enter a valid IC number.",
                passport_number: "Please enter a valid Passport number.",
                dob: "Please Select the Date of Birth",
                gender: "Please Select Gender",
                phone: {
                    required: "Please fill up your contact number",
                    maxlength: "Phone number can not be more than 15 characters."
                },
                email_address: {
                    required: "Please fill up your email address.",
                    email: "Please enter a valid email address.",
                },
                symtoms: {
                    required : "Please answer survey",
                    requiredRadioValue : "This is the test for asymptomatic only."
                },
                symtoms2: {
                    required : "Please answer survey",
                    requiredRadioValue : "This is the test for asymptomatic only."
                },
                travelled_infected_country: {
                    required : "Please answer survey",
                    requiredRadioValue : "This is the test for asymptomatic only."
                },
                terms: "Please accept terms and conditions",
                country: "Please select your nationality.",
                commute_by: "Please select your mode of transport.",
            },
            errorPlacement: function(error, element) {
                if (element.attr("type") == "radio") {
                    error.insertBefore(element);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $ ("#tabs" ).tabs("enable", 1);
                $( "#tabs" ).tabs({ active: 1 });
            }
        });
    }

</script>
@endpush


@section('content')
    <input type="hidden" name="testType" id="testType" value="{{$testType}}">
    <input type="hidden" name="selectedCenter" id="selectedCenter" value="">
    <input type="hidden" name="selectedTimeSlot" id="selectedTimeSlot" value="">
    <input type="hidden" name="selectedDate" id="selectedDate" value="">
    <input type="hidden" name="selectedTime" id="selectedTime" value="">
    <div class="pageCover" style="display:none;">
    <section>
        <div class="row">
            <div class="col-md-12 text-center pt-5" style="background-color: #c07275; height: 185px; color: #ffe0e3;">
                <br>
                <h1>
                    @if($testType=='pre-screening')
                        Pre Screening
                    @else
                        Point of Entry Test
                    @endif
                </h1>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div id="tabs">
                    <ul>
                        <li><a href="#fragment-1"><span>Personal Details</span></a></li>
                        <li><a href="#fragment-2"><span>Centers</span></a></li>
                        <li><a href="#fragment-3"><span>Time Slots</span></a></li>
                        <li><a href="#fragment-4"><span>Payment</span></a></li>
                    </ul>
                    <div class="fragment-container">
                        <div id="fragment-1" style="overflow-y: auto;">
                            <form method="post" name="frmRegister" id="frmRegister" action="{{ url('payment-process-init')  }}">
                                <div class="row">
                                    <div class="col-md-6 left-col">
                                        <h3 class="text-uppercase">Health Assessment</h3>
                                        <p>Information about COVID-19 is constantly changing and the level of COVID-19 activity varies by community. For current updates on COVID-19 and details on testing and other health measures, visit MOH website at <strong><a href="https://www.moh.gov.my" target="_blank">https://www.moh.gov.my</a></strong></p>
                                        <p>To your best knowledge, have you been exposed to a person with a confirmed case of COVID-19 in the past 14 days?</p>
                                        <p>
                                            <label id="symtoms-error" class="cus-error error" for="symtoms" style="display: none;">Please answer survey</label>
                                            <input type="radio" name="symtoms" id="symtoms" value="1"> Yes &nbsp;&nbsp;<input type="radio" name="symtoms" id="symtoms" value="0"> No
                                        </p>
                                        <p>Have you travelled overseas in the past 14 days?</p>
                                        <p>
                                            <label id="travelled_infected_country-error" class="cus-error error" for="travelled_infected_country" style="display: none;">Please answer survey</label>
                                            <input type="radio" name="travelled_infected_country" id="travelled_infected_country" value="1"> Yes &nbsp;&nbsp;<input type="radio" name="travelled_infected_country" id="travelled_infected_country" value="0"> No
                                        </p>
                                        <p>In the last 48 hours, have you had any of the following symptoms:</p>
                                        <ul>
                                            <li>a fever of 37.8 C (100 F) or above,</li>
                                            <li>Cough or sore throat,</li>
                                            <li>shortness of breath or trouble breathing.</li>
                                        </ul>
                                        <p>
                                            <label id="symtoms2-error" class="cus-error error" for="symtoms2" style="display: none;">Please answer survey</label>
                                            <input type="radio" name="symtoms2" id="symtoms2" value="1"> Yes &nbsp;&nbsp;<input type="radio" name="symtoms2" id="symtoms2" value="0"> No
                                        </p>
                                        <p>I hereby give consent to Jengu to collect or process the Travellers personal data and sensitive data (including health information) in accordance with the written notice. Please click <strong><a href="{{ url('pdf/JenguPersonalDataProtectionNotice.pdf')  }}">here</a></strong> to be redirected to Jengu’s Personal Data Protection Notice. </p>
                                        <p>I hereby undertake that the information provided here is true and correct. I hereby acknowledge, agree and consent to the terms as stated in Jengu’s Personal Data Protection Notice.
                                        <br><br><input type="checkbox" name="terms" id="terms" value="1"> Agree<br><label id="terms-error"  class="error" for="terms" style="display: none;">Please accept terms and conditions</label></p>
                                    </div>
                                    <div class="col-md-6 right-col">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                            <label for="name" class="control-label">{{ 'Full Name* : (As per NRIC or Passport)' }}</label>
                                            <div>
                                                <input class="form-control" name="name" type="text" id="name" value="{{ isset($patient->name) ? $patient->name : ''}}" >
                                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('identity_type') ? 'has-error' : ''}}">
                                            <label for="identity_type" class=" control-label">{{ 'Identity Type' }}</label>
                                            <div>
                                                <select name="identity_type" class="form-control" id="identity_type" onchange="showHideIdentityType(this.value)" >
                                                    <option value=""> - select ID Type - </option>
                                                    @foreach (json_decode('{"1":"NRIC","2":"Passport Number"}', true) as $optionKey => $optionValue)
                                                        <option value="{{ $optionKey }}" {{ (isset($patient->active) && $patient->active == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('identity_type', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div id="divNricPassport" ></div>
                                        <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
                                            <label for="gender" class="control-label">{{ 'Gender' }}</label>
                                            <div>
                                                <div class="radio">
                                                    <label><input name="gender" type="radio" value="1" checked="checked" > Male</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input name="gender" type="radio" value="2" > Female</label>
                                                </div>
                                                {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('dob') ? 'has-error' : ''}}">
                                            <label for="dob" class="control-label">{{ 'Date of Birth' }}</label>
                                            <div>
                                                <input class="form-control" name="dob" type="date" id="dob" max="{{ date('Y-m-d')  }}" value="{{ isset($patient->dob) ? $patient->dob : ''}}" >
                                                {!! $errors->first('dob', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                            <label for="phone" class="control-label">{{ 'Phone' }}</label>
                                            <div>
                                                <input class="form-control" name="phone" type="number" id="phone" maxlength="15" value="{{ isset($patient->phone) ? $patient->phone : ''}}" ><div style="font-size: 12px">Ex: Mobile number must contain country code without + sign. Example 6013xxxxxxx (Malaysia) or 658xxxxxxx (Singapore).</div>
                                                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('email_address') ? 'has-error' : ''}}">
                                            <label for="email_address" class="control-label">{{ 'Email Address' }}</label>
                                            <div>
                                                <input class="form-control" name="email_address" type="email" id="email_address" value="{{ isset($patient->email_address) ? $patient->email_address : ''}}" >
                                                {!! $errors->first('email_address', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
                                            <label for="country" class="control-label">{{ 'Nationality' }}</label>
                                            <div>
                                                <select class="form-control"  name="country" id="country" onchange="testAmountCalc();">
                                                    <option value=""> - select country - </option>
                                                    @php( $countries = getCountries())
                                                    @if(count($countries)>0)
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->ID}}">{{$country->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                {!! $errors->first('email_address', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        @if($testType == 'point-of-entry-test')
                                            <div class="form-group {{ $errors->has('commute_by') ? 'has-error' : ''}}">
                                                <label for="commute_by" class="control-label">{{ 'Mode of travel or transport' }}</label>
                                                <div>
                                                    <select class="form-control"  name="commute_by" id="commute_by" onchange="commuteBySelected(this.value);">
                                                        <option value=""> - select - </option>
                                                        <option value="1">Motorcycle, Private Cars, Vans, Taxis, Buses</option>
                                                        <option value="2">Walking/Cycling</option>
                                                        <option value="">Large Trucks</option>
                                                    </select>
                                                    {!! $errors->first('email_address', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        @endif
                                        <div class="text-center pt-3">
                                            <button class="btn btn-blue" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row col-md-12 mt-2">
                                    <div class="text-right col-md-12">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="fragment-2" class="centers-list"  style="height: 750px; overflow-y: auto;">
                            @php( $centers = getCenters($testType))
                            <? /* ?>
                            @if(count($centers)>0)
                                <ul class="list-group">
                                    @foreach($centers as $center)
                                        <a class="centers_links" href="javascript:void(0);" onclick='selectCenter("{{$center->ID}}");'>
                                            <li class="list-group-item" id="center_{{$center->ID}}">
                                                <strong>{{$center->name}}</strong></h5><br>
                                                {{$center->street_address_1}}, @if(isset($center->street_address_2)) {{$center->street_address_2}}, @endif {{$center->city}}, {{$center->state}} {{$center->zip_code}}
                                            </li>
                                        </a>
                                    @endforeach
                                </ul>
                            @endif
                            <? */ ?>

                            @if(count($centers)>0)
                                <div class="row">
                                    @foreach($centers as $center)
                                        <div class="col-sm-4 mb-4"  id="center_{{$center->ID}}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$center->name}}</h5>
                                                    <p class="card-text">@if(isset($center->street_address_1)){{$center->street_address_1}},@endif @if(isset($center->street_address_2)){{$center->street_address_2}},@endif @if(isset($center->city)){{$center->city}},@endif {{$center->state}} {{$center->zip_code}}</p>
                                                    <a href="javascript:void(0);" class="centers_links btn btn-blue" onclick='selectCenter("{{$center->ID}}");'>select</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div id="fragment-3"  style="height: 750px; overflow-y: auto;">
                            <div id="divSelectedCenter" class="mb-3"></div>
                            @if(count($centers)>0)
                                @foreach($centers as $center)
                                    @php( $selected_time_slots = getSeletedTimeSlotByCenter($center->ID) )
                                    {{--@if(searchForBookingTime('2020-08-11 07:08:00',$selected_time_slots))--}}
                                        {{--yes exist--}}
                                    {{--@else--}}
                                        {{--not exist--}}
                                    {{--@endif--}}
                                    {{--@php( exit )--}}
                                    <div class="center_hours_of_operation" id="center_hours_of_operation_{{$center->ID}}" style="display: none;">
                                        <div class="tabs_hop">
                                            <ul>
                                                @php( $hours_of_operations = getHoursOfOperation($center->ID) )
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @php( $cur_date_timestamp = time() + 86400 * $i )
                                                    @if(count($hours_of_operations)>0)
                                                        @foreach($hours_of_operations as $hours_of_operation)
                                                            @if($hours_of_operation->all_day_close!=1 && strtolower(date('l',$cur_date_timestamp))==strtolower($hours_of_operation->day_name) && $hours_of_operation->open!='' && $hours_of_operation->close!='')
                                                                <li style="font-size: 13px;"><a href="#tab_hoo_{{$center->ID}}_{{$i}}"><span>{{date("M d, Y", $cur_date_timestamp)}}</span></a></li>
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endfor
                                            </ul>
                                            <div id="tab_hop_container">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @php( $cur_date_timestamp = time() + 86400 * $i )
                                                @if(count($hours_of_operations)>0)
                                                    @foreach($hours_of_operations as $hours_of_operation)
                                                        @if($hours_of_operation->all_day_close!=1 && strtolower(date('l',$cur_date_timestamp))==strtolower($hours_of_operation->day_name) && $hours_of_operation->open!='' && $hours_of_operation->close!='')
                                                            <div id="tab_hoo_{{$center->ID}}_{{$i}}" style="overflow-y: auto;">
                                                                {{--{{$hours_of_operation->open}} - {{$hours_of_operation->close}}--}}
                                                                @php( $difference = round(abs(strtotime($hours_of_operation->open) - strtotime($hours_of_operation->close)) / 3600,2) )
                                                                @php( $start_time = date('h:i a',strtotime($hours_of_operation->open)))
                                                                @for ($j = 1; $j <= $difference; $j++)
                                                                    <div class="row mb-2">
                                                                        @for ($k = 1; $k <= $center->slots_per_hour; $k++)
                                                                            @php( $time_slots = strtotime($start_time) + ((60/$center->slots_per_hour)*60))
                                                                            @php( $cur_time_slot = date('Y-m-d H:i',strtotime(date('Y-m-d',$cur_date_timestamp).' '.$start_time)) )
                                                                            {{--@php( $booked_patients_count_in_slot = getBookedPatientsCountInSlot($cur_time_slot,$center->ID) )--}}
                                                                            @php( $res = searchForBookingTime($cur_time_slot, $selected_time_slots) )
                                                                            @if($res['status']=='yes')
                                                                                @if($selected_time_slots[$res['key']]['booking_count']>=$center->patients_per_slot)
                                                                                    @php( $booked = 'yes' )
                                                                                @else
                                                                                    @php( $booked = 'no' )
                                                                                @endif
                                                                            @else
                                                                                @php( $booked = 'no' )
                                                                            @endif
                                                                            <div class="card text-center pointer bm-card timeslot @if($booked=='yes') slot_booked @endif">
                                                                                <div class="card-body p-2">
                                                                                    <a href="javascript:void(0);" @if($booked=='no') onclick="$('.card').removeClass('selected');$(this).parents('.card').addClass('selected'); selectedDateTime('{{date('Y-m-d',$cur_date_timestamp).' '.$start_time}}','{{date('d/m/Y',$cur_date_timestamp)}}','{{date('h:i A',strtotime($start_time)).' - '.date('h:i A',$time_slots)}}')" @endif >{{$start_time}} - {{date('h:i a',$time_slots)}}</a>
                                                                                </div>
                                                                            </div>
                                                                            @php( $start_time = date('h:i a',$time_slots))
                                                                        @endfor
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endfor

                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="fragment-4" style="height: 750px; overflow-y: auto;">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="payment-card">
                                            <h4>Payment Details</h4>
                                            <div id="divSelectedCenterConfirm">
                                                <p class="locate">Test Location</p>
                                            </div>
                                            <div class="total-Amt">Amount : RM <span id="divConfirmAmount">0.00</span></div>
                                            {{--<a href="javascript:void(0);" class="previous-step">Previous Step</a>--}}
                                            <div class="text-center mt-auto">
                                                <button class="btn btn-blue" type="submit">Proceed to Payment</button>
                                                <div id="loadingPayment" style="display: none;" class="spinner-border text-primary mt-3" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="payment-card-details">
                                            <form name="frmPaymentConfirm" id="frmPaymentConfirm">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><span>Name</span><span id="divConfirmName"></span></li>
                                                    <li class="list-group-item"><span>Email Address</span><span id="divConfirmEmailAddress"></span></li>
                                                    <li class="list-group-item"><span>Date of Birth</span><span id="divConfirmDob"></span></li>
                                                    <li class="list-group-item"><span>Gender</span><span id="divConfirmGender"></span></li>
                                                    <li class="list-group-item"><span>IC/Passport Number</span><span id="divConfirmICPassportNumber"></span></li>
                                                    <li class="list-group-item"><span>Contact Number</span><span id="divConfirmContactNumber"></span></li>
                                                    <li class="list-group-item"><span>Date & Time</span><span id="divDateConfirm"></span> - <span id="divTimeConfirm"></span></li>
                                                    <li class="list-group-item"><span>Nationality</span><span id="divConfirmNationality"></span></li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <? /* ?>
                            <form name="frmPaymentConfirm" id="frmPaymentConfirm">
                                <strong>Test Location:</strong><br>
                                <div id="divSelectedCenterConfirm" class="mb-3"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Date :</strong> <br><span id="divDateConfirm"></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Time :</strong> <br><span id="divTimeConfirm"></span>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Name :</strong> <br><span id="divConfirmName"></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Date of Birth :</strong> <br><span id="divConfirmDob"></span>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong><span id="spanConfirmICPassportNumber">IC/Passport Number :</span></strong> <br><span id="divConfirmICPassportNumber"></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Contact Number :</strong> <br><span id="divConfirmContactNumber"></span>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Gender :</strong> <br><span id="divConfirmGender"></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Email Address :</strong> <br><span id="divConfirmEmailAddress"></span>
                                </div>
                            </div>
                            <br><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Date :</strong> <br><span id="divDateConfirm"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Time :</strong> <br><span id="divTimeConfirm"></span>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Name :</strong> <br><span id="divConfirmName"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Date of Birth :</strong> <br><span id="divConfirmDob"></span>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>IC/Passport Number :</strong> <br><span id="divConfirmICPassportNumber"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Contact Number :</strong> <br><span id="divConfirmContactNumber"></span>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Gender :</strong> <br><span id="divConfirmGender"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Email Address :</strong> <br><span id="divConfirmEmailAddress"></span>
                                    </div>
                                </div>
                                <br><br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Nationality :</strong> <br><span id="divConfirmNationality"></span>
                                    </div>
                                </div>
                                <br><br>
                                <h2 style="color: #000">Amount : RM <span id="divConfirmAmount">0.00</span></h2>
                                <div class="text-center pt-3">
                                    <button class="btn btn-blue" type="submit">Proceed to Payment</button>
                                    <div id="loadingPayment" style="display: none;" class="spinner-border text-primary mt-3" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </form>
                            <? */ ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- End Intro Section -->
</div>

@endsection