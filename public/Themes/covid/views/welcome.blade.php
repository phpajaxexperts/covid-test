@extends('layouts.master')


@push('css')

@endpush

@push('js')
{{--<script src="{{ themes('blueimp-gallery-lightbox/js/blueimp-gallery.min.js') }}"></script>--}}
{{--<script>--}}
    {{--blueimp.Gallery(document.getElementById('links').getElementsByTagName('a'), {--}}
        {{--container: '#blueimp-gallery-carousel',--}}
        {{--carousel: true,--}}
        {{--fullScreen: false--}}
    {{--})--}}
{{--</script>--}}
@endpush


@section('content')

    <section id="intro">



        <div class="intro-text">
            <br><br><br><br><br><br><br><br><br><br><br>
            <h2>COVID-19 Drive-Thru Testing</h2>
            <p>By Appointment Only<br><br>
                Price: <strong>RM 300 Nett</strong><br><br>
            </p>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <p class="text-left">-- MoH accredited rt-PCR test<br>
                        -- Aim to have the results ready within 48 hours **<br><br>

                        <i>** May be subjected to delays if surge in demand</i><br><br>

                        <strong>IMPORTANT MESSAGE :</strong> If you display any symptoms such as fever, cough and sore throat AND have been in contact with a CONFIRMED case of COVID-19, please proceed to the nearest public healthcare facility for screening and management.

                        For more information please refer to FAQ
                        <br><br>
                    </p>
                </div>
            </div>


            <a href="{{ url('book-test')  }}" class="btn-get-started" onclick="window.location={{ url('book-test')  }}">Book Test</a>



        </div>


        {{--<div class="product-screens">--}}
            {{--<div class="product-screen-1 wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="0.6s">--}}
                {{--<img src="assets/img/product-screen-1.png" alt="">--}}
            {{--</div>--}}

            {{--<div class="product-screen-2 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.6s">--}}
                {{--<img src="assets/img/product-screen-2.png" alt="">--}}
            {{--</div>--}}

            {{--<div class="product-screen-3 wow fadeInUp" data-wow-duration="0.6s">--}}
                {{--<img src="assets/img/product-screen-3.png" alt="">--}}
            {{--</div>--}}

        {{--</div>--}}

    </section><!-- End Intro Section -->




@endsection