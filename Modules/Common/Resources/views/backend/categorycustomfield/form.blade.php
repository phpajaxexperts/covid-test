<div class="form-group {{ $errors->has('custom_field') ? 'has-error' : ''}}">
    <label for="custom_field" class="col-md-4 control-label">{{ 'Custom Field' }}</label>
    <div class="col-md-6">
        <select name="custom_field" class="form-control" id="custom_field">
            <option value=""> - select custom field - </option>
            @foreach ($custom_fields as $optionKey => $optionValue)
                @php
                      $custom_field_element = generateInputElement($optionValue->typeName->ID,$optionValue->name,$optionValue->fieldValues);
                      //$custom_field_element = '';
                @endphp            
            <option value="{{ $optionValue->ID }}" data-field-element='{{$custom_field_element}}' data-field-type-id="{{$optionValue->typeName->ID}}" data-field-type="{{$optionValue->typeName->name}}" data-field-values="{{ HTML::ul(makeSingleDimArrByKey($optionValue->fieldValues,'field'))}}" {{ (isset($sectioncustomfield->custom_field) && $sectioncustomfield->custom_field == $optionValue->ID) ? 'selected' : ''}}>{{ ucwords($optionValue->name) }}</option>
            @endforeach
        </select>
        {!! $errors->first('custom_field', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="card-header"><h3>Preview</h3></div>
    <label id="custom_field_name_preview" for="custom_field" class="col-md-4 control-label"></label>
    <div class="col-md-12">
        <div id="custom_field_element_preview"></div>
    </div>
</div>



{{-- <div class="form-group">
    <label for="custom_field" class="col-md-4 control-label">{{ 'Custom Field Type' }}</label>
    <div class="col-md-6">
        <div id="custom_field_type_name"></div>
    </div>
</div>
<div class="form-group">
    <label for="custom_field" class="col-md-4 control-label">{{ 'Custom Field Values' }}</label>
    <div class="col-md-6">
        <div id="custom_field_values"></div>
    </div>
</div> --}}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ isset($submitButtonText) ?  $submitButtonText : 'Add Custom Field' }}">
        <input class="form-control" name="category" type="hidden" id="category" value="{{ isset($sectioncustomfield->category) ? $sectioncustomfield->catgory : ''}}" >
        <input class="form-control" name="module" type="hidden" id="module" value="{{ isset($sectioncustomfield->module) ? $sectioncustomfield->module : ''}}" >
    </div>
</div>
<script type="text/javascript">
    $('#custom_field').change(function(){
        //alert($(this).data('field-type'));
        //alert($(this).val());
       
        //$('#custom_field_type_name').html($(this).find(':selected').attr('data-field-type'));
        //$('#custom_field_values').html($(this).find(':selected').attr('data-field-values'));
        $('#custom_field_name_preview').html($(this).find(':selected').text());
        $('#custom_field_element_preview').html($(this).find(':selected').attr('data-field-element'));
        
        
    });
</script>