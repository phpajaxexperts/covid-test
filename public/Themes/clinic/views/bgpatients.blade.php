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
        if(!$('#payment_status_'+ID).val() ){
            Swal.fire(
                'Alert!',
                'Please select the Payment method to update.',
                'warning'
            );
            return false;
        }
        if(!$('#swab_status_'+ID).val() ){
            Swal.fire(
                'Alert!',
                'Please select the Swab status to update.',
                'warning'
            );
            return false;
        }
        
        
        
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    var param = 'ID='+ID+'&paymentstatus='+$('#payment_status_'+ID).val()+'&swabstatus='+$('#swab_status_'+ID).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/clinic/update-patient') }}",
                        data: param,
                        success: function(msg){
                            if(msg.status=='success'){
                                var paymentResult='';
                                var swabResult='';
                                var result_status = $('#payment_status_'+ID).val();
                                var swab_status = $('#swab_status_'+ID).val();

                                if(result_status==1)
                                    paymentResult = '<span class="text-green" >PAYMENT COLLECTED.</span>';
                                else if(result_status==2)
                                    paymentResult ='<span class="text-red" >PAYMENT NOT COLLECTED</span>';                              
                                

                                if(swab_status==1)
                                    swabResult = '<span class="text-green" >SWAB TAKEN.</span>';
                                else if(swab_status==2)
                                    swabResult ='<span class="text-red" >SWAB NOT TAKEN</span>';    

                                    var res = paymentResult.concat(swabResult);
                                $('#divTestResult_'+ID).html(res);
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
        
    }
</script>
@endpush

@section('content')
    <div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Patients on {{$dat}}</h3>
            <div class="text-right">
                <form name="frmDate" id="frmDate" action="{{ url('/clinic/patients')  }}" method="post">
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
                    <th>NRIC/Passport Number</th>
                    <th>Phone</th>
                    @if(Auth::id()!=4 && Auth::id()!=5)
                        <th>Booked On</th>
                    @endif
                    <th>Test Result</th>
                </tr>
                </thead>
                <tbody>
                @if(count($bookings)>0)
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{$booking->name}}</td>
                            <td>{{$booking->nric_passport}}</td>
                            <td>+{{$booking->phone}}</td>
                            
                            <td>
                                {{date('d/m/Y',strtotime($booking->booking_time))}} at {{date('h:i A',strtotime($booking->booking_time))}}
                            </td>
                            
                            <td>
                                <div id="divTestResult_{{$booking->ID}}">

                                
                                    @if($booking->payment_made==1)
                                        <span class="text-green">PAYMENT COLLECTED.</span>
                                    @elseif($booking->payment_made==2)
                                        <span class="text-red">PAYMENT NOT COLLECTED.</span>                                    
                                    @else
                                    <select name="payment_status_{{$booking->ID}}" id="payment_status_{{$booking->ID}}" style="width:150px;height: 45px;">
                                        <option value=""> - Payment Status - </option>
                                        <option value="1">Payment Collected</option>
                                        <option value="2">No</option>
                                    </select>
                                    @endif

                                    @if($booking->swab_taken==1)
                                        <span class="text-green">SWAB TAKEN</span>
                                    @elseif($booking->swab_taken==2)
                                        <span class="text-red">SWAB NOT TAKEN</span>                                    
                                    @else
                                    <select name="swab_status_{{$booking->ID}}" id="swab_status_{{$booking->ID}}" style="width:150px;height: 45px;">
                                            <option value=""> - Swab Status - </option>
                                            <option value="1">Taken</option>
                                            <option value="2">No</option>
                                    </select>
                                    @endif

                                    @if (empty($booking->swab_taken) && empty($booking->payment_made) )

                                    <a href="javascript:void(0);"  onclick="updateStatus('{{$booking->ID}}');" ><button type="button" class="btn btn-info">Update</button></a>
                                    @endif





                                    
                                </div>
                            </td>
                            {{--<td><a href="{{ url('/clinic/update-patient/'.$patient->ID)  }}"><button type="button" class="btn btn-info">Update</button></a></td>--}}
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
