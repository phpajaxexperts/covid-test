@extends('layouts.master')

@section('title', '| Create Permission')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-key'></i> Add Permission</h1>
        <br>

        {{Form::open(['route' => 'Store Permission', 'method' => 'PUT'])}}

        <fieldset>
            <div class="form-group">
                <?php
                echo Form::label('module_section', 'Module Section',['class'=>'col-sm-2 control-label']); ?>
                <div class="col-sm-6">
                    <?php echo Form::select('module_section',$module_sections,null, ['placeholder' => '- select module section -','class' => 'selectpicker','id' => 'module_section','data-style'=>"btn btn-block",'data-size'=>"7",'required'=>'true']);
                    if($errors->has('module_section'))
                    {
                        echo Form::label($errors->first('module_section'), $errors->first('module_section'),array('class' => 'module_section','id'=>'required-error'));
                    }
                    ?>
                </div>
            </div>
        </fieldset>

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', array('class' => 'form-control')) }}
        </div><br>
        {{ Form::checkbox('menu_display',  1 ) }} Enable Permission to display on Menu Item
        <br>
        <br>

        <fieldset>
            <div class="form-group">
                <?php
                echo Form::label('module_section', 'Active',['class'=>'col-sm-2 control-label']); ?>
                <div class="col-sm-6">
                    <?php echo Form::select('active',array('no','yes'),null, ['id' => 'active','data-style'=>"btn btn-block",'data-size'=>"7",'required'=>'true']);
                    if($errors->has('active'))
                    {
                        echo Form::label($errors->first('active'), $errors->first('active'),array('class' => 'active','id'=>'required-error'));
                    }
                    ?>
                </div>
            </div>
        </fieldset>
        <br>
        <br>

        @if(!$roles->isEmpty()) //If no roles exist yet
        <h4>Assign Permission to Roles</h4>

        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
        @endif
        <br>
        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection