@extends('layouts.master')

@section('js')
<script type="text/javascript">
function showHideCustomFieldValues(val){
    if(val==4 || val==5 || val==6 || val==7){
        $('#divCustomFieldValues').show();
    }else{
        $('#divCustomFieldValues').hide();
    }
}
</script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Customfield</div>
                    <div class="card-body">
                        <a href="{{ url('/administrator/view-customfield') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/administrator/store-customfield') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('common::backend.customfield.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
