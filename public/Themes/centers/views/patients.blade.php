@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="{{ themes('plugins/sweetalert2/sweetalert2.css') }} ">
<link rel="stylesheet" href="{{ themes('plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@push('js')
<script src="{{ themes('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ themes('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ themes('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ themes('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ themes('plugins/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{ themes('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(function () {
        $('#date_duration').daterangepicker({
            timePicker: false,
            //startDate: moment().startOf('hour'),
            //endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
//        $("#frmDate").validate({
//            rules: {
//                dat: {
//                    required: true
//                }
//            }
//        });

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

    function updateStatus(ID){
        if($('#test_result_'+ID).val()){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    var param = 'ID='+ID+'&status='+$('#test_result_'+ID).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/center/update-patient') }}",
                        data: param,
                        success: function(msg){
                            if(msg.status=='success'){
                                var testResult='';
                                var result_status = $('#test_result_'+ID).val();

                                if(result_status==1)
                                    testResult = '<span class="text-red" >POSITIVE</span>';
                                else if(result_status==2)
                                    testResult ='<span class="text-green" >NEGATIVE</span>';
                                else if(result_status==3)
                                    testResult ='<span class="text-grey" >INVALID</span>';

                                $('#divTestResult_'+ID).html(testResult);
                            }
                            else if(msg.status=='failed')
                                alert('Rrequest failed, please try again');
                        },
                        beforeSend: function(){
                            Swal.fire({
                                title: 'Please Wait !',
                                html: '',// add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        complete: function(){
                            //$("div.paceDiv").hide();\
                            swal.close();
                        }
                    });
                }
            })
        }else{
            Swal.fire(
                'Alert!',
                'Please select the test result to update.',
                'warning'
            )
        }
    }
</script>
@endpush


@section('content')
    <div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Patients on {{$dat}}</h3>
            <div class="text-right">
                <form name="frmDate" id="frmDate" action="{{ url('/center/patients')  }}" method="post">
                    @csrf
                Date <input type="text" style="width: 200px;" name="date_duration" id="date_duration"><button type="submit">Go</button>
                </form>
            </div>
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
                    {{--<th>Actions</th>--}}
                </tr>
                </thead>
                <tbody>
                @if(count($bookings)>0)
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{$booking->name}}</td>
                            <td>{{$booking->phone}}</td>
                            <td>{{date('d/m/Y',strtotime($booking->booking_time))}} at {{date('h:i A',strtotime($booking->booking_time))}}</td>
                            <td>
                                <div id="divTestResult_{{$booking->ID}}">
                                    @if($booking->test_result)
                                        @if($booking->test_result==1)
                                            <span class="text-red">POSITIVE</span>
                                        @elseif($booking->test_result==2)
                                            <span class="text-green">NEGATIVE</span>
                                        @elseif($booking->test_result==3)
                                            <span class="text-grey">INVALID</span>
                                        @endif
                                    @else
                                        <select class="form-control inline col-md-6" name="test_result_{{$booking->ID}}" id="test_result_{{$booking->ID}}">
                                            <option value=""> - select result - </option>
                                            <option value="1">Positive</option>
                                            <option value="2">Negative</option>
                                            <option value="3">Invalid</option>
                                        </select>
                                        <a href="javascript:void(0);"  onclick="updateStatus('{{$booking->ID}}');" ><button type="button" class="btn btn-info">Update</button></a>
                                    @endif
                                </div>
                            </td>
                            {{--<td><a href="{{ url('/center/update-patient/'.$patient->ID)  }}"><button type="button" class="btn btn-info">Update</button></a></td>--}}
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
