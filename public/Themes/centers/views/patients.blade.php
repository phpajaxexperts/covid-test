@extends('layouts.master')

@push('js')
<script src="{{ themes('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ themes('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ themes('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ themes('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
    $(function () {

        $("#frmDate").validate({
            rules: {
                dat: {
                    required: true
                }
            }
        });

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

    function updateStatus(ID,status){
        $('#loading_'+ID).show();
        var param = 'ID='+ID+'&status='+status;

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
                if(msg.status=='success')
                    $('#loading_'+ID).hide();
                else if(msg.status=='failed')
                    alert('Rrequest failed, please try again');



            },
            beforeSend: function(){
                //$("div.paceDiv").show();
            },
            complete: function(){
                //$("div.paceDiv").hide();
            }
        });
    }
</script>
@endpush


@section('content')
    <div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Patients on {{date('d/m/Y',strtotime($dat))}}</h3>
            <div class="text-right">
                <form name="frmDate" id="frmDate" action="{{ url('/center/patients')  }}" method="post">
                    @csrf
                <input type="date" name="dat" id="dat" placeholder="{{date('d-m-Y',strtotime($dat))}}" value="{{date('d-m-Y',strtotime($dat))}}"><button type="submit">Go</button>
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
                                <table cellpadding="0" cellspacing="0" border="0" style="border: 0px; background: none;" width="100%">
                                    <tr>
                                        <td style="border: 0px; background: none;">
                                            <!-- radio -->
                                            <div class="form-group clearfix">
                                                <div class="icheck-success d-inline pr-4">
                                                    <input type="radio" name="test_result_{{$booking->ID}}" id="test_result_{{$booking->ID}}_1" onclick="updateStatus('{{$booking->ID}}',2);" @if($booking->test_result==2) checked="checked" @endif>
                                                    <label for="test_result_{{$booking->ID}}_1"><span class="text-green">Negative</span></label>
                                                </div>

                                                <div class="icheck-danger d-inline pr-4">
                                                    <input type="radio" name="test_result_{{$booking->ID}}" id="test_result_{{$booking->ID}}_2" onclick="updateStatus('{{$booking->ID}}',1);" @if($booking->test_result==1) checked="checked" @endif>
                                                    <label for="test_result_{{$booking->ID}}_2"><span class="text-red">Positive</span></label>
                                                </div>

                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="test_result_{{$booking->ID}}_3" name="test_result_{{$booking->ID}}" onclick="updateStatus('{{$booking->ID}}',3);" @if($booking->test_result==3) checked="checked" @endif>
                                                    <label for="test_result_{{$booking->ID}}_3"><span class="text-grey">Invalid</span></label>
                                                </div>
                                            </div>

                                            {{--<input type="radio" onclick="updateStatus('{{$booking->ID}}',1);" @if($booking->test_result==1) checked="checked" @endif class="form-check-inline" name="test_result_{{$booking->ID}}" id="test_result_{{$booking->ID}}" value="1"> <span class="text-red">Positive</span><br>--}}
                                            {{--<input type="radio" onclick="updateStatus('{{$booking->ID}}',2);" @if($booking->test_result==2) checked="checked" @endif class="form-check-inline" name="test_result_{{$booking->ID}}" id="test_result_{{$booking->ID}}" value="2"> <span class="text-green">Negative</span><br>--}}
                                            {{--<input type="radio" onclick="updateStatus('{{$booking->ID}}',3);" @if($booking->test_result==3) checked="checked" @endif class="form-check-inline" name="test_result_{{$booking->ID}}" id="test_result_{{$booking->ID}}" value="3"> <span class="text-grey">Invalid Results</span><br>--}}
                                        </td>
                                        <td  style="border: 0px; background: none;">
                                            <i id="loading_{{$booking->ID}}" class="hourglass-32x32" style="display: none;" />
                                        </td>
                                    </tr>
                                </table>
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
