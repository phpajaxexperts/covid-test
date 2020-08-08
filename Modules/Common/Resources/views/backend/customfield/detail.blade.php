@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Custom Field</div>
                    <div class="card-body">

                        <a href="{{ url('/administrator/view-customfield') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/administrator/edit-customfield/' . $customfield->ID) }}" title="Edit Customfield"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('administrator/destroy-customfield' . '/' . $customfield->ID) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Customfield" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        {{-- <th>ID</th><td>{{ $customfield->ID }}</td> --}}
                                    </tr>
                                    <tr>
                                        <th> Type </th>
                                        <td> {{ $customfield->typeName->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $customfield->name }} </td></tr>
                                        <tr><th> Active </th>
                                        <td> 
                                        @php
                                         if($customfield->active==1)   
                                            echo 'Yes';
                                         else
                                            echo 'No';
                                        @endphp    
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
