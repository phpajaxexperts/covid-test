@extends('layouts.master')

@section('scripts')
<script>
    $(document).ready(function () {
        $('#data').DataTable()
    })
</script>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Sectioncustomfield</h3>

                        <a href="{{ url('/administrator/create-sectioncustomfield') }}" class="btn btn-success btn-sm" title="Add New Sectioncustomfield">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add
                        </a>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th><th>Section Rs</th><th>Section</th><th>Custom Field</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($sectioncustomfield as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->ID }}</td>
                                    <td>{{ $item->section_rs }}</td><td>{{ $item->section }}</td><td>{{ $item->custom_field }}</td>
                                    <td>
                                        <a href="{{ url('/administrator/detail-sectioncustomfield/' . $item->ID) }}" title="View Sectioncustomfield"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/administrator/edit-sectioncustomfield/' . $item->ID) }}" title="Edit Sectioncustomfield"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/administrator/destroy-sectioncustomfield' . '/' . $item->ID) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Sectioncustomfield" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th><th>Section Rs</th><th>Section</th><th>Custom Field</th><th>Actions</th>
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
