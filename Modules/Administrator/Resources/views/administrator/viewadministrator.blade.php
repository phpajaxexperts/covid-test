@extends('layouts.master')

@section('scripts')
<script>
    $(document).ready(function () {
        $('#data').DataTable()
    })
</script>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Administrators</h3>
                        <a href="{{ route('Create Administrator') }}" class="btn btn-info pull-left" style="margin-right: 3px;">+ Add</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                <td>{{ucfirst($admin->name)}}</td>
                                <td>{{$admin->email}}</td>
                                <td>
                                    <a href="{{ route('Edit Administrator', ['id' => $admin->id]) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                    <a href="{{ route('Destroy Administrator', ['id' => $admin->id]) }}" class="btn btn-danger pull-left" style="margin-right: 3px;">Delete</a>

                                    <!--
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['Destroy Administrator', $admin->id] ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-trash"></i>
                                    -->
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@stop
