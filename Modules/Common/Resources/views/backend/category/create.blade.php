@extends('layouts.master')

@section('js')
<script type="text/javascript">
$(document).ready(function(){
    // $.ajax({
    // method: "POST",
    // url: "{{ url('/administrator/store-sectioncustomfield') }}",
    // data: { custom_field: $('#custom_field').val() }
    // })
    // .done(function( msg ) {
    //     alert( "Data Saved: " + msg );
    // });    


});
</script>
@endsection

@section('content')
<form method="POST" action="{{ url('/administrator/store-category') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Category</div>
                    <div class="card-body">
                        <a href="{{ url('/administrator/view-category') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @include ('common::backend.category.form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Custom Fields</div>
                    <div class="card-body">
                        <a href="#" data-load-url="{{ url('administrator/create-categorycustomfield') }}" data-toggle="modal" data-target="#myModal">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> add a custom field</button>
                        </a>
                        <br />
                        <br />
                    <div id="categoryCustomFieldPreview">

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-4 col-md-4">
            <input class="btn btn-primary" type="submit" value="{{ isset($submitButtonText) ?  $submitButtonText : 'Create' }}">
            <input type="hidden" name="category" id="category" value="">
            <input type="hidden" name="module" id="module" value="{{ isset($module)?$module:'' }}">
            <input type="hidden" name="parent" id="parent" value="{{isset($parent)?$parent:''}}">
        </div>
    </div>
        
</form>
@endsection