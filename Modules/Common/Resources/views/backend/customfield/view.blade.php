@extends('layouts.master')

@section('scripts')
<script>
    $(document).ready(function () {
        $('#data').DataTable({     
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "iDisplayLength": 5
       })
    })
</script>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Custom Fields</h3>

                        <a href="{{ url('/administrator/create-customfield') }}" class="btn btn-success btn-sm" title="Add New Customfield">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add
                        </a>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th><th>Name</th><th>Type</th><th>Active</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($customfields as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->ID }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->typeName->name }}</td>
                                    <td>
                                        @if($item->active==1)
                                        Yes
                                        @else
                                        No
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/administrator/detail-customfield/' . $item->ID) }}" title="View Customfield"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/administrator/edit-customfield/' . $item->ID) }}" title="Edit Customfield"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/administrator/destroy-customfield' . '/' . $item->ID) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Customfield" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th><th>Type</th><th>Name</th><th>Active</th><th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
