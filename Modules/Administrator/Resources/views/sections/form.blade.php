@section('js')
<script language="JavaScript" type="text/javascript">
    function addElement(){
        var element_count = Number($('#element_count').val())+Number(1);
        $('#element_count').val(element_count);
        var template = $('#elementTemplate').html();
        template = template.replace('containerID', 'containerID'+element_count);
        template = template.replace("required_field_0", "required_field_"+element_count);
        //template = template.replace(new RegExp('showHideDBOptions(0,this.value)', 'g'), "showHideDBOptions("+element_count+",this.value)");
        template = template.replace("showHideDBOptions(0,this.value)", "showHideDBOptions("+element_count+",this.value)");
        template = template.replace("divDBOptions_0", "divDBOptions_"+element_count);
        template = template.replace(new RegExp('db_options_0', 'g'), "db_options_"+element_count);
        template = template.replace('showHideOptions(0,this.value)', "showHideOptions("+element_count+",this.value)");
        template = template.replace('showHideOptions(0,this.value)', "showHideOptions("+element_count+",this.value)");

        template = template.replace(new RegExp('tables_0', 'g'), "tables_"+element_count);
        //template = template.replace("tables_0", "tables_"+element_count);

        template = template.replace(new RegExp('table_field_0', 'g'), "table_field_"+element_count);

        template = template.replace("getTableFields(0,this.value)", "getTableFields("+element_count+",this.value)");

        template = template.replace("divOptions_0", "divOptions_"+element_count);
        template = template.replace("options_0", "options_"+element_count);


        template = template.replace("divTableOptions_0", "divTableOptions_"+element_count);



        var removeBtn = '<button type="button" class="btn btn-primary btn-sm" onclick="removeElement('+element_count+');"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
        $('#additionalElement').append(template);
        $(removeBtn).appendTo($('#containerID'+element_count+' .btnContainer'));
    }

    function removeElement(val){
        $('#containerID'+val).remove();
    }

    function showHideDBOptions(id,val){
        if(val=='select' || val=='radio' || val=='enum'){
            $('#divDBOptions_'+id).show();
        }else{
            $('#divDBOptions_'+id).hide();
        }
    }

    function showHideOptions(id,val){
        if(val==1){
            $('#divTableOptions_'+id).show();
            $('#divOptions_'+id).hide();
        }else{
            $('#divOptions_'+id).show();
            $('#divTableOptions_'+id).hide();
        }
        /*
        if(val=='select' || val=='radio' || val=='enum'){
            $('#divOptions_'+id).show();
        }else{
            $('#divOptions_'+id).hide();
        }
        */
    }

    function getTableFields(id,val){
        var param = "table_name=" + val;
        jQuery.ajax({
            type: "POST",
            url: '{{ url("/administrator/get-table-fields") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: param,
            success: function(fields) {
                $('#table_field_' + id).html('');
                $('#table_field_' + id).html('<option value=""> - select field - </option>');
                $.each(fields, function (i, value) {
                    $('#table_field_' + id).append('<option v+alue="' + value+ '">' + value + '</option>');
                });
            }
        });
    }
</script>
@endsection

<div class="form-group {{ $errors->has('module') ? 'has-error' : ''}}">
    <label for="module" class="col-md-4 control-label">{{ 'Module' }}</label>
    <div class="col-md-6">
        @if(count($modules)>0)
            <select name="module" id="module" class="form-control">
            @foreach($modules as $module)
                <option value="{{$module->id}}" {{ (isset($section->module) && $section->module==$module->id) ? 'selected' : ''}} >{{$module->name}}</option>
            @endforeach
            </select>
        @endif
        {!! $errors->first('module', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ isset($section) ? $section->name : ''}} " required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    <label for="active" class="col-md-4 control-label">{{ 'Active' }}</label>
    <div class="col-md-6">
        <select name="active" class="form-control" id="active" >
    @foreach (json_decode('{"1":"Yes","0":"No"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($section->active) && $section->active == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Table Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="table_name" type="text" id="table_name" value="">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('front_end_needed') ? 'has-error' : ''}}">
    <div class="col-md-6">
        <label for="name" class="control-label">{{ 'Front End Needed' }}</label>
        {!! $errors->first('front_end_needed', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-1">
        <input class="form-control" name="front_end_needed" type="checkbox" id="front_end_needed" value="yes">
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <label for="name" class="control-label">{{ 'Field Name' }}</label>
        </div>
        <div class="col-sm">
            <label for="name" class="control-label">{{ 'Field Type' }}</label>
        </div>
        <div class="col-sm" style="display: none;">
        </div>

        <div class="col-sm" style="display: none;">
        </div>

        <div class="col-sm" style="display: none;">
        </div>
        <div class="col-sm btnContainer">
        </div>
    </div>
</div>

<div class="container" id="elementTemplate">
    <div class="row mt-2" id="containerID">
        <div class="col-sm">
            <input class="form-control" name="field_name[]" type="text" id="field_name[]" value="">
            <input type="checkbox" name="required_field_0" id="required_field_0" value="1"> Required
        </div>
        <div class="col-sm">
            <select name="field_type[]" id="field_type[]" class="form-control" onchange="showHideDBOptions(0,this.value)">
                <option value="string">Text</option>
                <option value="text">Text Area</option>
                <option value="password">Password</option>
                <option value="email">Email</option>
                <option value="number">Number</option>
                <option value="date">Date</option>
                <option value="datetime">Datetime</option>
                <option value="time">Time</option>
                <option value="radio">Radio</option>
                <option value="enum">Checkbox</option>
                <option value="select">Select</option>
                <option value="file">File</option>
            </select>
        </div>
        <div class="col-sm" style="display: none;" id="divDBOptions_0">
            <input type="radio" name="db_options_0" id="db_options_0" value="1" onclick="showHideOptions(0,this.value);"> DB table <br>
            <input type="radio" name="db_options_0" id="db_options_0" value="2" onclick="showHideOptions(0,this.value);"> Values <br>
        </div>

        <div class="col-sm" style="display: none;" id="divTableOptions_0">
            <select id="tables_0" name="tables_0" onchange="getTableFields(0,this.value);">
                @if(count($tables)>0)
                    @foreach($tables as $table)
                        @foreach ($table as $key => $value)
                            <option value="{{$value}}">{{$value}}</option>
                        @endforeach
                    @endforeach
                @endif
            </select>
            <select id="table_field_0" name="table_field_0">
                <option value=""> - table fields - </option>
            </select>
        </div>


        <div class="col-sm" style="display: none;" id="divOptions_0">
            <input type="text" name="options_0" id="options_0" value=""> <br>(Ex:  options=1:yes,0:no)
        </div>
        <div class="col-sm btnContainer">
            <button type="button" class="btn btn-primary btn-sm" onclick="addElement();"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
    </div>
</div>
<input type="hidden" name="element_count" id="element_count">
<div class="container" id="additionalElement">

</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ isset($submitButtonText) ? $submitButtonText : 'Create'}}">
    </div>
</div>
