@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center pt-5" style="background-color: #c07275; height: 185px; color: #ffe0e3;">
            <br>
            <h1>
                Payment Success
            </h1>
        </div>
    </div>
    <div class="card mt-5" style="width: 25rem;margin: 0px auto;">
        <img class="card-img-top" src="{{ themes('img/Test-kits-1-810x456.jpg')  }}" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">
                <strong>Follow Prevention Measures</strong>
                Such as social distancing, washing your hands and wearing a mask to minimise your risk of infections.<br><br>

                <strong>{{$booking->name}}</strong>
                @if($booking->doctor_name)
                    <strong>{{$booking->doctor_name}}</strong><br>
                @endif
                @if($booking->street_address_1){{$booking->street_address_1}},@endif @if($booking->street_address_2)<br>{{$booking->street_address_2}},@endif @if($booking->city)<br>{{$booking->city}},@endif @if($booking->state)<br>{{$booking->state}}@endif @if($booking->city) {{$booking->zip_code}},@endif
                <br><br>
                {{ date('d/m/Y', strtotime($booking->booking_time))  }} at {{ date('h:i A', strtotime($booking->booking_time))  }}
            </p>
            <a href="{{ url('/')  }}" class="btn btn-primary">Go Home</a>
        </div>
    </div>
@endsection