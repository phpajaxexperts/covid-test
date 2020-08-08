@extends('layouts.master')

@section('title', '| Edit Permission')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        {{-- @include ('errors.list') --}}

        <h1><i class='fa fa-key'></i> Edit {{$permission->name}}</h1>
        <br>
        {{ Form::model($permission, array('route' => array('Update Permission', $permission->id), 'method' => 'PUT')) }}
        <fieldset>
            <div class="form-group">
                <?php
                echo Form::label('module_section', 'Module Section',['class'=>'col-sm-2 control-label']); ?>
                <div class="col-sm-6">
                    <?php echo Form::select('section',$module_sections,$permission->section, ['placeholder' => '- select module section -','class' => 'selectpicker','id' => 'section','data-style'=>"btn btn-block",'data-size'=>"7",'required'=>'true']);
                    if($errors->has('module_section'))
                    {
                        echo Form::label($errors->first('section'), $errors->first('section'),array('class' => 'section','id'=>'required-error'));
                    }
                    ?>
                </div>
            </div>
        </fieldset>
        <div class="form-group">
            {{ Form::label('name', 'Permission Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <br>
        {{ Form::checkbox('display',  1, $permission->display ) }} Enable Permission to display on Menu Item
        <br>
        <br>

        <fieldset>
            <div class="form-group">
                <?php
                echo Form::label('active', 'Active',['class'=>'col-sm-2 control-label']); ?>
                <div class="col-sm-6">
                    <?php echo Form::select('active',array('no','yes'),$permission->active, ['id' => 'active','data-style'=>"btn btn-block",'data-size'=>"7",'required'=>'true']);
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
        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection