@extends('layouts.master')

@section('content')
    <div class="card mt-5" style="width: 25rem;margin: 0px auto;">
        <img class="card-img-top" src="{{ themes('img/Test-kits-1-810x456.jpg')  }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Payment Transaction Failed</h5>
            <p class="card-text">Please try again to complete the transaction.</p>
            <a href="{{ url('/')  }}" class="btn btn-primary">Go Home</a>
        </div>
    </div>
@endsection