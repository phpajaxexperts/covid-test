@extends('layouts.master')

@section('content')
    <div class="card mt-5" style="width: 25rem;margin: 0px auto;">
        <img class="card-img-top" src="{{ themes('img/Test-kits-1-810x456.jpg')  }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Payment Success</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="{{ url('/')  }}" class="btn btn-primary">Go Home</a>
        </div>
    </div>
@endsection