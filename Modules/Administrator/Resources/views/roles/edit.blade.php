@extends('layouts.master')

@section('title', '| Edit Role')

@section('content')
<div class='row'>
    <div class='col-lg-4 col-lg-offset-4'>
        <h1><i class='fa fa-key'></i> Edit Role: {{$role->name}}</h1>
        <hr>

        {{ Form::model($role, array('route' => array('Update Role', $role->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Role Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <h5><b>Assign Permissions</b></h5>
        <div class='form-group'>
            @foreach ($modules as $module)
                <strong>{{ $module->name  }}</strong><br><br>
                <div class='col-lg-12'>
                    @foreach ($module_sections as $module_section)
                        @if($module_section->module==$module->id)
                            {{ Form::label($module_section->name, ucfirst($module_section->name)) }}<br>
                            <div class='row col-lg-12'>
                                @foreach ($permissions as $permission)
                                    @if($permission->section==$module_section->id)
                                        {{ Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                                        {{ $permission->name }}<br>
                                    @endif
                                @endforeach
                                <br>
                            </div>
                            <br>
                        @endif
                    @endforeach
                </div>
            @endforeach
            <br><br>
        </div>
        <br>
        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
</div>

@endsection