@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-dark mb-3">Edit Patient #{{ $patient->ID }}</h3>
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ url('/administrator/update-patient/' . $patient->ID) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    @include ('members::backend.patient.form', ['submitButtonText' => 'Update'])
                </form>
            </div>
        </div>
    </div>
@endsection
