@extends('layouts.master')


@push('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<style>
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

    .selected{
        background-color: #CCC;
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

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ themes('js/jquery.validate.min.js') }}"></script>

<script>


    $("#frmRegister").validate({
        rules: {
            name: {
                required: true
            },
            nric_passport: {
                required: true
            },
            gender : { required: true },
            phone: {
                required: true
            },
            email_address: {
                required: true,
                email: true
            },
            fever:{ required: true} ,
            travelled_affected_country:{ required: true} ,
            terms:{ required: true} ,
        },
        messages: {
            name: "Please enter your full name.",
            nric_passport: "Please enter a valid IC / Passport number.",
            gender: "Please Select Gender",
            phone: "Please fill up your contact number",
            email_address: {
                required: "Please fill up your email address.",
                email: "Please enter a valid email address.",
            },
            fever: "Please answer survey",
            travelled_affected_country: "Please answer survey",
            terms: "Please accept terms and conditions",
        },
        submitHandler: function(form) {
            submitPersonalDetails();
        }
    });


            var currentTab = 0;
    $(function () {
        $("#tabs").tabs({
            active: 0
        });

        $(".tabs_hop").tabs({
            active: 0
        });
    });

    function selectCenter(centerID){
        $( "#divSelectedCenter" ).html($( "#center_"+centerID+"" ).html());
        $( "#divSelectedCenterConfirm" ).html($( "#center_"+centerID+"" ).html());
        $( "#selectedCenter").val(centerID);
        $( "#tabs" ).tabs({ active: 1 });
        $( ".center_hours_of_operation").hide();
        $( "#center_hours_of_operation_"+centerID).show();
    }

    function selectedDateTime(dattime,date,time){
        $( "#selectedTimeSlot" ).val(dattime);
        $( "#selectedDate" ).val(date);
        $( "#selectedTime" ).val(time);
        $( "#tabs" ).tabs({ active: 2 });
    }

    function submitPersonalDetails(){
        $( "#divDateConfirm" ).html($( "#selectedDate" ).val());
        $( "#divTimeConfirm" ).html($( "#selectedTime" ).val());

        $( "#divConfirmName" ).html($( "#name" ).val());
        $( "#divConfirmDob" ).html($( "#dob" ).val());
        $( "#divConfirmICPassportNumber" ).html($( "#nric_passport" ).val());
        $( "#divConfirmContactNumber" ).html($( "#phone" ).val());
        var gender_id = $('input[name="gender"]:checked').val();
        if(gender_id==1)
            var gender='male';
        else
            var gender='female';
        $( "#divConfirmGender" ).html(gender);
        $( "#divConfirmEmailAddress" ).html($( "#email_address" ).val());

        $( "#tabs" ).tabs({ active: 3 });
    }
</script>
@endpush


@section('content')

    <input type="hidden" name="selectedCenter" id="selectedCenter" value="">
    <input type="hidden" name="selectedTimeSlot" id="selectedTimeSlot" value="">
    <input type="hidden" name="selectedDate" id="selectedDate" value="">
    <input type="hidden" name="selectedTime" id="selectedTime" value="">

    <section id="intro">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div id="tabs" class="mt-5">
                    <ul>
                        <li><a href="#fragment-1"><span>Centers</span></a></li>
                        <li><a href="#fragment-2"><span>Time Slots</span></a></li>
                        <li><a href="#fragment-3"><span>Personal Details</span></a></li>
                        <li><a href="#fragment-4"><span>Payment</span></a></li>
                    </ul>
                    <div id="fragment-1" style="height: 750px; overflow-y: auto;">
                        @php( $centers = getCenters())
                        @if(count($centers)>0)
                            <ul class="list-group">
                                @foreach($centers as $center)
                                    <a class="centers_links" href="javascript:void(0);" onclick='selectCenter("{{$center->ID}}");'>
                                        <li class="list-group-item" id="center_{{$center->ID}}">
                                            <strong>{{$center->name}}</strong></h5><br>
                                            {{$center->street_address_1}}, @if(isset($center->street_address_2)) {{$center->street_address_2}}, @endif {{$center->city}}, {{$center->state}} {{$center->zip_code}}
                                        </li>
                                    </a><br>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div id="fragment-2"  style="height: 750px; overflow-y: auto;">
                        <div id="divSelectedCenter" class="mb-3">

                        </div>
                        @if(count($centers)>0)
                            @foreach($centers as $center)
                                <div class="center_hours_of_operation" id="center_hours_of_operation_{{$center->ID}}" style="display: none;">
                                    <div class="tabs_hop">
                                        <ul>
                                        @php( $hours_of_operations = getHoursOfOperation($center->ID) )
                                        @for ($i = 1; $i <= 5; $i++)
                                            @php( $cur_date_timestamp = time() + 86400 * $i )
                                            @if(count($hours_of_operations)>0)
                                                @foreach($hours_of_operations as $hours_of_operation)
                                                    @if($hours_of_operation->all_day_close!=1 && strtolower(date('l',$cur_date_timestamp))==strtolower($hours_of_operation->day_name) && $hours_of_operation->open!='' && $hours_of_operation->close!='')
                                                        <li style="font-size: 13px;"><a href="#tab_hoo_{{$center->ID}}_{{$i}}"><span>{{date("d/m/Y", $cur_date_timestamp)}}</span></a></li>
                                                        @break
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endfor
                                        </ul>

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
                                                                <div class="row mb-3">
                                                                @for ($k = 1; $k <= 6; $k++)
                                                                    @php( $time_slots = strtotime($start_time) + 240)
                                                                        <div class="card text-center pointer bm-card mr-2">
                                                                            <div class="card-body p-2" style="font-size: 13px;">
                                                                                <a href="javascript:void(0);" onclick="$('.card-body').removeClass('selected');$(this).parent().addClass('selected'); selectedDateTime('{{date('d/m/Y',$cur_date_timestamp).' '.$start_time}}','{{date('d/m/Y',$cur_date_timestamp)}}','{{date('h:i A',strtotime($start_time)).' - '.date('h:i A',$time_slots)}}')">{{$start_time}} - {{date('h:i a',$time_slots)}}</a>
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
                        @endforeach
                    @endif
                </div>
                <div id="fragment-3"  style="height: 750px; overflow-y: auto;">
                    <form method="post" name="frmRegister" id="frmRegister">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="control-label">{{ 'Full Name* : (As in NRIC or Pass)' }}</label>
                                    <div>
                                        <input class="form-control" name="name" type="text" id="name" value="{{ isset($patient->name) ? $patient->name : ''}}" >
                                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div><div class="form-group {{ $errors->has('nric_passport') ? 'has-error' : ''}}">
                                    <label for="nric_passport" class="control-label">{{ 'NRIC or Passport Number ' }}</label>
                                    <div>
                                        <input class="form-control" name="nric_passport" type="text" id="nric_passport" value="{{ isset($patient->nric_passport) ? $patient->nric_passport : ''}}" >
                                        {!! $errors->first('nric_passport', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div><div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
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
                                </div><div class="form-group {{ $errors->has('dob') ? 'has-error' : ''}}">
                                    <label for="dob" class="control-label">{{ 'Date of Birth' }}</label>
                                    <div>
                                        <input class="form-control" name="dob" type="date" id="dob" value="{{ isset($patient->dob) ? $patient->dob : ''}}" >
                                        {!! $errors->first('dob', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div><div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                    <label for="phone" class="control-label">{{ 'Phone' }}</label>
                                    <div>
                                        <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($patient->phone) ? $patient->phone : ''}}" >
                                        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div><div class="form-group {{ $errors->has('email_address') ? 'has-error' : ''}}">
                                    <label for="email_address" class="control-label">{{ 'Email Address' }}</label>
                                    <div>
                                        <input class="form-control" name="email_address" type="email" id="email_address" value="{{ isset($patient->email_address) ? $patient->email_address : ''}}" >
                                        {!! $errors->first('email_address', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <p>Do you have fever OR any of these symptoms - shortness of breath, cough or sore throat?</p>
                                <p>Fever = More than 37.5 ℃</p>
                                <p>
                                <input type="radio" name="fever" id="fever" value="1"> Yes<br>
                                <input type="radio" name="fever" id="fever" value="2"> No
                                </p>
                                <p>Have you traveled to affected countries in the past 14 days OR had close contact with a confirmed case of COVID-19?</p>
                                <p>Affected countries: e.g. USA, UK, China, South Korea, Iran, Japan or Italy. Note: Transit in the airport is not considered as travel in those countries</p>
                                <p>
                                <input type="radio" name="travelled_affected_country" id="travelled_affected_country" value="1"> Yes<br>
                                <input type="radio" name="travelled_affected_country" id="travelled_affected_country" value="2"> No
                                </p>
                                <p>
                                    <input type="checkbox" name="terms" id="terms" value="1"> Gribbles Pathology (M) Sdn Bhd, Quantum Diagnostics Sdn Bhd and Clinipath (M) Sdn Bhd respects and is committed to the protection of your personal information and your privacy. All personal data is collected and handled in accordance with the Malaysian Personal Data Protection Act 2010 (“PDPA”). Our Personal Data Protection Notice can be viewed at this link here.
                                    <br><br>
                                    By submitting this form, I hereby give consent to Gribbles Pathology (M) Sdn Bhd, Quantum Diagnostics Sdn Bhd and Clinipath (M) Sdn Bhd to collect or process the Patient’s personal data in accordance with the Personal Data Protection Notice. I hereby undertake that the information provided here is true and correct.
                                </p>
                                <p>
                                    <input type="checkbox" name="clinic_booking" id="clinic_booking" value="1"> I am a clinic booking on behalf of a patient.
                                </p>
                            </div>
                        </div>


                        <div class="row col-md-12 mt-4">
                            <div class="text-right col-md-12">
                                <button type="submit" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="fragment-4" style="height: 750px; overflow-y: auto;">
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

                    <h2 style="color: #000">Amount : RM 300</h2>

                    <p><input type="checkbox" name="confirm_terms" id="confirm_terms" value="1"> Gribbles Pathology (M) Sdn Bhd, Quantum Diagnostics Sdn Bhd and Clinipath (M) Sdn Bhd respects and is committed to the protection of your personal information and your privacy. All personal data is collected and handled in accordance with the Malaysian Personal Data Protection Act 2010 (“PDPA”). Our Personal Data Protection Notice can be viewed at this link here.</p>

                    <p>By submitting this form, I hereby give consent to Gribbles Pathology (M) Sdn Bhd, Quantum Diagnostics Sdn Bhd and Clinipath (M) Sdn Bhd to collect or process the Patient’s personal data in accordance with the Personal Data Protection Notice. I hereby undertake that the information provided here is true and correct.</p>

                    <div class="text-right">
                    <button type="submit">Proceed to Payment</button>
                    </div>
                </div>
            </div>


            {{--<br />--}}
            {{--<input type="button" id="btnPrevious" value="Previous" style = "display:none"/>--}}
            {{--<input type="button" id="btnNext" value="Next" />--}}

        </div>
        <div class="col-md-2">

        </div>
    </div>




    {{--<div class="product-screens">--}}
        {{--<div class="product-screen-1 wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="0.6s">--}}
            {{--<img src="assets/img/product-screen-1.png" alt="">--}}
        {{--</div>--}}

        {{--<div class="product-screen-2 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.6s">--}}
            {{--<img src="assets/img/product-screen-2.png" alt="">--}}
        {{--</div>--}}

        {{--<div class="product-screen-3 wow fadeInUp" data-wow-duration="0.6s">--}}
            {{--<img src="assets/img/product-screen-3.png" alt="">--}}
        {{--</div>--}}

    {{--</div>--}}

</section><!-- End Intro Section -->




@endsection