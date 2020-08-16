@extends('layouts.master')

@push('js')

@endpush


@section('content')
    <div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Patient Details</h3>
        </div>

        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{ themes('dist/img/user1-128x128.jpg') }}" alt="user image">
                            <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like. Some people hate it and argue for
                            its demise, but others ignore the hate as they create awesome
                            tools to help create filler text for everyone from bacon lovers
                            to Charlie Sheen fans.
                        </p>

                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    </div>
    </div>
@stop
