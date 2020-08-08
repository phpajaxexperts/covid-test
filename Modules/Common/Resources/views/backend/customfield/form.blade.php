<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="col-md-4 control-label">{{ 'Type' }}</label>
    <div class="col-md-6">
        <select name="type" class="form-control" id="type" onchange="showHideCustomFieldValues(this.value);" >
    @foreach ($types as $optionKey => $optionValue)
        <option value="{{ $optionValue->ID }}" {{ (isset($customfield->type) && $customfield->type == $optionValue->ID) ? 'selected' : ''}}>{{ $optionValue->name }}</option>
    @endforeach
</select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ isset($customfield->name) ? $customfield->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div style="display: none;" id="divCustomFieldValues" class="form-group {{ $errors->has('values') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Values (Comma separated values)' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="values" type="textarea" id="values" >{{ isset($customfield->values) ? $customfield->values : ''}}</textarea>
        {!! $errors->first('values', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    <label for="active" class="col-md-4 control-label">{{ 'Active' }}</label>
    <div class="col-md-6">
        <select name="active" class="form-control" id="active" >
    @foreach (json_decode('{"1":"yes","0":"no"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($customfield->active) && $customfield->active == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ isset($submitButtonText) ?  $submitButtonText : 'Create' }}">
    </div>
</div>
