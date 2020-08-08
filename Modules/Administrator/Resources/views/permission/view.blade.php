@extends('layouts.master')

@section('title', '| Permissions')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-key"></i>Available Permissions

            <a href="{{ route('View Administrator') }}" class="btn btn-default pull-right">Users</a>
            <a href="{{ route('View Role') }}" class="btn btn-default pull-right">Roles</a></h1>


        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <a href="{{ URL::to('administrator/edit-permission/'.$permission->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                            <a href="{{ URL::to('administrator/destroy-permission/'.$permission->id) }}" class="btn btn-danger pull-left" style="margin-right: 3px;">Delete</a>

                           <!--
                            {!! Form::open(['method' => 'DELETE', 'route' => ['Destroy Permission', $permission->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            -->

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ URL::to('administrator/create-permission') }}" class="btn btn-success">Add Permission</a>

    </div>

@endsection