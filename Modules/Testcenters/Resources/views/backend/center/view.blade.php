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
                        <h3 class="box-title">Centers</h3>

                        <a href="{{ url('/administrator/create-center') }}" class="btn btn-success btn-sm" title="Add New Center">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add
                        </a>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th><th>Name</th><th>Street Address 1</th><th>Street Address 2</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($centers as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->ID }}</td>
                                    <td>{{ $item->name }}</td><td>{{ $item->street_address_1 }}</td><td>{{ $item->street_address_2 }}</td>
                                    <td>
                                        <a href="{{ url('/administrator/detail-center/' . $item->ID) }}" title="View Center"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/administrator/edit-center/' . $item->ID) }}" title="Edit Center"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/administrator/destroy-center' . '/' . $item->ID) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Center" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th><th>Name</th><th>Street Address 1</th><th>Street Address 2</th><th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        
    <div class="row">
        <div class="col-sm-12 text-center mt-4">
            <div class="col-sm-6 text-center">
            <?
            $links = $centers->links();
            $patterns = array();
            $patterns[] = '/'.$centers->currentPage().'\?page=/';
            $replacements = array();
            $replacements[] = '';
            echo preg_replace($patterns, $replacements, $links);
            ?>
            </div>
        </div>
    </div>
    </section>
@endsection
