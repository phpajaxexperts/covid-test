@extends('layouts.master')

@section('title', '| Roles')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-key"></i> Roles

            <a href="{{ route('View Administrator') }}" class="btn btn-default pull-right">Users</a>
            <a href="{{ route('View Permission') }}" class="btn btn-default pull-right">Permissions</a></h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($roles as $role)
                    <tr>

                        <td>{{ $role->name }}</td>

                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                        <td>
                            <a href="{{ URL::to('administrator/edit-role/'.$role->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                            <a href="{{ URL::to('administrator/destroy-role/'.$role->id) }}" class="btn btn-danger pull-left" style="margin-right: 3px;">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <a href="{{ URL::to('administrator/create-role') }}" class="btn btn-success">Add Role</a>

    </div>

@endsection