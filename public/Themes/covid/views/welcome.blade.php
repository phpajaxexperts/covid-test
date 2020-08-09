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
<section>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8"><img src="{{ themes('img/covid-logo.png')  }}"> </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5 col-sm-1 text-center pt-5 mr-2" style="background-color: #ffe0e3; min-height: 435px;">
            <img src="{{ themes('img/PreScreening.png')  }}"><br>
            <div style="width: 50%;margin: 0px auto;">Pre-Screening is for eligible travellers who are planning to travel from Malaysia to Singapore. Eligible travellers are required to undergo a COVID-19 PCR test 72 Hours before departure</div><br>
            <a href="{{ url('book-test/pre-screening')  }}"><img src="{{ themes('img/booktestbtn.png')  }}"></a>
            <br><br>
        </div>
        <div class="col-md-5 col-sm-1 text-center pt-5" style="background-color: #ffeebc; min-height: 435px;">
            <img src="{{ themes('img/Point-of-entry-test.png')  }}"><br>
            <div style="width: 50%;margin: 0px auto;">Point-of-Entry Testing will be conducted on all travellers entering Malaysia via Johor. Nasal swab samples will be tested at the point of care as travellers enter Malaysia</div><br>
            <a href="{{ url('book-test/point-of-entry-test')  }}"><img src="{{ themes('img/booktestbtn-yellow.png')  }}"></a>
            <br><br>
        </div>
        <div class="col-md-1"></div>
    </div>
</section>

<br><br>
    <section id="intro">

        <div class="row">

            <div class="text-center" style="min-height: 425px;padding-top: 130px; font-family: Helvetica; font-size: 28px;">
                <div style="width: 50%;margin: 0px auto; color: #a85258;"><strong>Malaysia</strong> and <strong>Singapore</strong> have agreed to special travel arrangements to facilitate essential travel while ensuring the safety of travellers and public health via the <strong>Reciprocal Green Lane (RGL)</strong> and <strong>Periodic Commuting Arrangement (PCA)</strong> schemes.</div>
            </div>

        </div>


    </section>

<section>
    <div class="row">

        <div class="text-center col-md-12" style="color: #a85258;min-height: 345px;padding-top: 130px;">
            <p style=" font-family: Helvetica; font-size: 28px;">A COLLABORATION BETWEEN</p>
            <div class="row col-md-12 text-center">
                <div class="col-md-3"></div>
                <div class="col-md-8 col-sm-1">
                    <div class="row text-center align-middle">
                    <div class="col-md-2 col-sm-1 text-center pointer bm-card">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/MalaysianGovernmentLogo.webp')  }}"><br>Ministry of Health
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-1 text-center pointer bm-card mr-2">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/MalaysianGovernmentLogo.webp')  }}"><br>Ministry of Foreign Affairs
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-1 text-center pointer bm-card">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/JohorStateGovernmentLogo.webp')  }}"><br>Johor State Government
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-1 text-center pointer bm-card">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/MalaysianGovernmentLogo.webp')  }}"><br>Johor State <br> Department of Health
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-1 text-center pointer bm-card">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/JabatanImigresenMalaysiaLogo.webp')  }}"><br>Immigration Department <br>of Malaysia
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="text-center col-md-12" style="color: #A85258;height: 100px;padding-top: 100px;">
            <p>Powered by Jengu © 2020</p>
        </div>
    </div>
</section>







@endsection