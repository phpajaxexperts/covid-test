@include('common::backend.component.top-common-components')

<div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">Patient Detail</h3>
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
    <label><input name="gender" type="radio" value="1" {{ (isset($patient) && 1 == $patient->gender) ? 'checked' : '' }}> Male</label>
</div>
<div class="radio">
    <label><input name="gender" type="radio" value="2" @if (isset($patient)) {{ (2 == $patient->gender) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Female</label>
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
</div><div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
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

        @include('common::backend.component.bottom-common-components')

        <div class="card">
            <div class="card-footer align-right">
                <a href="{{ url('/administrator/view-patient') }}" title="Back"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancel</button></a>
                <input class="btn btn-primary" type="submit" value="{{ isset($submitButtonText) ?  $submitButtonText : 'Submit' }}">
                <input type="hidden" name="module" id="module" value="{{$module}}" >
                <input type="hidden" name="section" id="section" value="{{$section}}" >
                <input type="hidden" name="section_rs" id="section_rs" value="{{ isset($section_rs)?$section_rs:''}}" >
            </div>
            <!-- /.card-footer -->
        </div>