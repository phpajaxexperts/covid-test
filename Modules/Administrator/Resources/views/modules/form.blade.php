<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ isset($module) ? $module->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="col-md-4 control-label">{{ 'Module having category' }}</label>
    <div class="col-md-6">
        <select name="category" class="form-control" id="category" >
        @foreach (json_decode('{"1": "yes","0": "no"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($module->category) && $module->category == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
        </select>
        {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    <label for="active" class="col-md-4 control-label">{{ 'Active' }}</label>
    <div class="col-md-6">
        <select name="active" class="form-control" id="active" >
        @foreach (json_decode('{"1": "yes","0": "no"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($module->active) && $module->active == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
        </select>
        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ isset($submitButtonText) ? $submitButtonText : 'Create'}}">
    </div>
</div>
