@include('common::backend.component.top-common-components')

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap-timepicker.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('vendor/bootstrap/js/bootstrap-timepicker.min.js')  }}"></script>
<script type="text/javascript">
    $('.timepicker').timepicker({
        defaultTime: false
    });
</script>
@endpush


<div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">Center Detail</h3>
      <div class="card-tools">
        <!-- Buttons, labels, and many other things can be placed here! -->
        <!-- Here is a label for example -->
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">


<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control required" name="name" type="text" id="name" value="{{ isset($center->name) ? $center->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email_address') ? 'has-error' : ''}}">
    <label for="email_address" class="col-md-4 control-label">{{ 'Email Address' }}</label>
    <div class="col-md-6">
        <input class="form-control required" name="email_address" type="text" id="email_address" value="{{ isset($center->email_address) ? $center->email_address : ''}}" >
        {!! $errors->first('email_address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="col-md-4 control-label">{{ 'Password' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="password" type="password" id="password" value="" >
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('street_address_1') ? 'has-error' : ''}}">
    <label for="street_address_1" class="col-md-4 control-label">{{ 'Street Address 1' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="street_address_1" type="text" id="street_address_1" value="{{ isset($center->street_address_1) ? $center->street_address_1 : ''}}" >
        {!! $errors->first('street_address_1', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('street_address_2') ? 'has-error' : ''}}">
    <label for="street_address_2" class="col-md-4 control-label">{{ 'Street Address 2' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="street_address_2" type="text" id="street_address_2" value="{{ isset($center->street_address_2) ? $center->street_address_2 : ''}}" >
        {!! $errors->first('street_address_2', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    <label for="city" class="col-md-4 control-label">{{ 'City' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="city" type="text" id="city" value="{{ isset($center->city) ? $center->city : ''}}" >
        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
    <label for="state" class="col-md-4 control-label">{{ 'State' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="state" type="text" id="state" value="{{ isset($center->state) ? $center->state : ''}}" >
        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('zip_code') ? 'has-error' : ''}}">
    <label for="zip_code" class="col-md-4 control-label">{{ 'Zip Code' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="zip_code" type="text" id="zip_code" value="{{ isset($center->zip_code) ? $center->zip_code : ''}}" >
        {!! $errors->first('zip_code', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    <label for="active" class="col-md-4 control-label">{{ 'Active' }}</label>
    <div class="col-md-6">
        <select name="active" class="form-control" id="active" >
    @foreach (json_decode('{"1":"yes","0":"no"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($center->active) && $center->active == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>
</div>


<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Hours of Operation</h3>
        <div class="card-tools">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @php( $days = getDays() )
        @if(count($days)>0)
            <div class="row col-md-12">
                <div class="col-md-3">

                </div>
                <div class="col-md-1 text-center">
                    Open
                </div>
                <div class="col-md-1 text-center">
                    Close
                </div>
                <div class="col-md-2 text-center">
                    All Day Close
                </div>
            </div>
        @foreach($days as $day)

                @php($open = '')
                @php($close = '')
                @php($all_day_close = '')

            @if(count($hours_of_operations)>0)
                    @foreach ($hours_of_operations as $hours_of_operation)
                        @if($hours_of_operation->day==$day->ID)
                            @php($open = $hours_of_operation->open)
                            @php($close = $hours_of_operation->close)
                            @php($all_day_close = $hours_of_operation->all_day_close)
                        @endif
                    @endforeach
                @endif
                <div class="row col-md-12 mt-2">
                <div class="col-md-3">
                    {{ $day->name  }}
                </div>
                <div class="col-md-1 text-center">
                    <input class="form-control timepicker" type="text" size="5" name="open_{{$day->ID}}" id="open_{{$day->ID}}" value="{{$open}}">
                </div>
                <div class="col-md-1 text-center">
                    <input class="form-control timepicker" type="text" size="5" name="close_{{$day->ID}}" id="close_{{$day->ID}}" value="{{$close}}">
                </div>
                <div class="col-md-2 text-center">
                    <input class="form-control" type="checkbox" name="all_day_close_{{$day->ID}}" id="all_day_close_{{$day->ID}}" value="1" @if($all_day_close==1) checked="checked" @endif >
                </div>
                </div>
             @endforeach
        @endif

    </div>
</div>


        @include('common::backend.component.bottom-common-components')

        <div class="card">
            <div class="card-footer align-right">
                <a href="{{ url('/administrator/view-center') }}" title="Back"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancel</button></a>
                <input class="btn btn-primary" type="submit" value="{{ isset($submitButtonText) ?  $submitButtonText : 'Submit' }}">
                <input type="hidden" name="module" id="module" value="{{$module}}" >
                <input type="hidden" name="section" id="section" value="{{$section}}" >
                <input type="hidden" name="section_rs" id="section_rs" value="{{ isset($section_rs)?$section_rs:''}}" >
            </div>
            <!-- /.card-footer -->
        </div>