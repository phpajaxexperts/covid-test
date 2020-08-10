@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4"><a href="{{ url('/')  }}"><img src="{{ themes('img/covid-logo.png')  }}"></a></div>
        <div class="col-md-6 mt-5">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">FAQs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Resources</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="card mt-5" style="width: 25rem;margin: 0px auto;">
        <img class="card-img-top" src="{{ themes('img/Test-kits-1-810x456.jpg')  }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Payment Transaction Failed</h5>
            <p class="card-text">Please try again to complete the transaction.</p>
            <a href="{{ url('/')  }}" class="btn btn-primary">Go Home</a>
        </div>
    </div>
@endsection