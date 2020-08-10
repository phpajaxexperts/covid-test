@extends('layouts.master')

@push('js')
<script src="{{ themes('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ themes('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ themes('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ themes('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
    $(function () {
        $('#dataTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endpush


@section('content')
    <div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Patients on {{date('d/m/Y',strtotime($dat))}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Booked On</th>
                    <th>Test Result</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(count($patients)>0)
                    @foreach($patients as $patient)
                        <tr>
                            <td>{{$patient->name}}</td>
                            <td>{{$patient->phone}}</td>
                            <td>{{date('d/m/Y',strtotime($patient->booking_time))}} at {{date('h:i A',strtotime($patient->booking_time))}}</td>
                            <td>{{$patient->test_result}}</td>
                            <td><a href="{{ url('/center/update-patient/'.$patient->ID)  }}"><button type="button" class="btn btn-info">Update</button></a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    </div>
@stop
