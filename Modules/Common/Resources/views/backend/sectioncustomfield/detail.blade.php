@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Sectioncustomfield {{ $sectioncustomfield->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/administrator/view-sectioncustomfield') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/administrator/edit-sectioncustomfield/' . $sectioncustomfield->ID) }}" title="Edit Sectioncustomfield"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('administrator/destroy-sectioncustomfield' . '/' . $sectioncustomfield->ID) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Sectioncustomfield" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $sectioncustomfield->ID }}</td>
                                    </tr>
                                    <tr><th> Section Rs </th><td> {{ $sectioncustomfield->section_rs }} </td></tr><tr><th> Section </th><td> {{ $sectioncustomfield->section }} </td></tr><tr><th> Custom Field </th><td> {{ $sectioncustomfield->custom_field }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
