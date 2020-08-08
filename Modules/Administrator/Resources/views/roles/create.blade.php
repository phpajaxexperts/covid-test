@extends('layouts.master')

@section('title', '| Add Role')

@section('content')

    <div class='col-lg-11 col-lg-offset-1'>

        <h1><i class='fa fa-key'></i> Add Role</h1>
        <hr>

        {{Form::open(['route' => 'Store Role', 'method' => 'PUT'])}}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
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
                                    {{ Form::checkbox('permissions[]',  $permission->id ) }}
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
            {{--
            <div class='form-group'>
                @foreach ($permissions as $permission)
                    {{ Form::checkbox('permissions[]',  $permission->id ) }}
                    {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                @endforeach
            </div>
            --}}

            {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>

    @endsection