@extends('layouts.master')


@push('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<style>
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


</style>
@endpush

@push('js')
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
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
        $( "#selectedCenter").val(centerID);
        $( "#tabs" ).tabs({ active: 1 });
        $( ".center_hours_of_operation").hide();
        $( "#center_hours_of_operation_"+centerID).show();
    }

    function selectedDateTime(dattime){
        $( "#selectedTimeSlot" ).val(dattime);
        $( "#tabs" ).tabs({ active: 2 });
    }

</script>
@endpush


@section('content')

    <input type="hidden" name="selectedCenter" id="selectedCenter" value="">
    <input type="hidden" name="selectedTimeSlot" id="selectedTimeSlot" value="">

    <section id="intro">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-9">
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
                                    <li class="list-group-item" id="center_{{$center->ID}}">
                                        <a href="javascript:void(0);" onclick='selectCenter("{{$center->ID}}");'>
                                            <strong>{{$center->name}}</strong></h5><br>
                                            {{$center->street_address_1}}, @if(isset($center->street_address_2)) {{$center->street_address_2}}, @endif {{$center->city}}, {{$center->state}} {{$center->zip_code}}
                                        </a>
                                    </li><br>
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
                                                                    @php( $time_slots = strtotime($start_time) + 600)
                                                                        <div class="card text-center pointer bm-card mr-2">
                                                                            <div class="card-body p-2" style="font-size: 13px;">
                                                                                <a href="javascript:void(0);" onclick="$('.card-body').removeClass('selected');$(this).parent().addClass('selected'); selectedDateTime('{{date('d/m/Y',$cur_date_timestamp).' '.$start_time}}')">{{$start_time}} - {{date('h:i a',$time_slots)}}</a>
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
                    <div class="">
                        <div class="">


                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="name" type="text" id="name" value="{{ isset($patient->name) ? $patient->name : ''}}" >
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div><div class="form-group {{ $errors->has('nric_passport') ? 'has-error' : ''}}">
                                <label for="nric_passport" class="col-md-4 control-label">{{ 'Nric Passport' }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="nric_passport" type="text" id="nric_passport" value="{{ isset($patient->nric_passport) ? $patient->nric_passport : ''}}" >
                                    {!! $errors->first('nric_passport', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div><div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
                                <label for="gender" class="col-md-4 control-label">{{ 'Gender' }}</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <label><input name="gender" type="radio" value="1" checked="checked" > Male</label>
                                    </div>
                                    <div class="radio">
                                        <label><input name="gender" type="radio" value="2" > Female</label>
                                    </div>
                                    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div><div class="form-group {{ $errors->has('dob') ? 'has-error' : ''}}">
                                <label for="dob" class="col-md-4 control-label">{{ 'Dob' }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="dob" type="date" id="dob" value="{{ isset($patient->dob) ? $patient->dob : ''}}" >
                                    {!! $errors->first('dob', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div><div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                <label for="phone" class="col-md-4 control-label">{{ 'Phone' }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($patient->phone) ? $patient->phone : ''}}" >
                                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div><div class="form-group {{ $errors->has('email_address') ? 'has-error' : ''}}">
                                <label for="email_address" class="col-md-4 control-label">{{ 'Email Address' }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="email_address" type="email" id="email_address" value="{{ isset($patient->email_address) ? $patient->email_address : ''}}" >
                                    {!! $errors->first('email_address', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
                                <label for="active" class="col-md-4 control-label">{{ 'Active' }}</label>
                                <div class="col-md-6">
                                    <select name="active" class="form-control" id="active" >
                                        @foreach (json_decode('{"1":"yes","0":"no"}', true) as $optionKey => $optionValue)
                                            <option value="{{ $optionKey }}" {{ (isset($patient->active) && $patient->active == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button onclick='$( "#tabs" ).tabs({ active: 3 });' >Submit</button>
                        </div>
                    </div>
                </div>
                <div id="fragment-4" style="height: 750px; overflow-y: auto;">
                    <h2 style="color: #000">Amount : RM 300</h2>
                    <div class="text-right">
                    <button >Proceed to Payment</button>
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