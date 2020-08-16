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
{{--<img src="{!!QrCode::format('png')->generate('Embed me into an e-mail!')!!}">--}}
<section>
    <div class="container-fluid">
        <div class="row intro-wrapper">
            <div class="col-md-1"></div>
            <div class="col-md-5 col-sm-6 text-center pt-5 mr-md-2 intro-left">
                <img class="intro-icon" src="{{ themes('img/earth-globe.svg')  }}"><br>
                <div style="width: 52%;margin: 0px auto;"><p>Pre-Screening is for eligible travellers who are planning to travel from Malaysia to Singapore. Eligible travellers are required to undergo a COVID-19 PCR test 72 Hours before departure</p></div>
                <a class="btn" href="{{ url('book-test/pre-screening')  }}">Book Test</a>
            </div>
            <div class="col-md-5 col-sm-6 text-center pt-5 intro-right" style="background-color: #1a2b56; min-height: 435px;">
                <img class="intro-icon" src="{{ themes('img/map.svg')  }}"><br>
                <div style="width: 52%;margin: 0px auto;"><p>Point-of-Entry Testing will be conducted on all travellers entering Malaysia via Johor. Nasal swab samples will be tested at the point of care as travellers enter Malaysia</p></div>
                <a class="btn" href="{{ url('book-test/point-of-entry')  }}">Book Test</a>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>

<br><br>
<section id="intro">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="intro-content-area">
                    <div class="intro-content">
                        <strong>Malaysia</strong> and <strong>Singapore</strong> have agreed to special travel arrangements to facilitate essential travel while ensuring the safety of travellers and public health via the <strong>Reciprocal Green Lane (RGL)</strong> and <strong>Periodic Commuting Arrangement (PCA)</strong> schemes.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid container-xl">
        <div class="row" style="color: #a85258;min-height: 345px;padding-top: 130px;">
            <div class="col-12">
                <div class="row justify-content-center">
                    <p style=" font-family: Helvetica; font-size: 28px;text-align: center;">A COLLABORATION BETWEEN</p>
                </div>
                <div class="row text-center align-middle justify-content-between">
                    <div class="col-lg-2 col-md-4 col-12 text-center pointer bm-card">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/MalaysianGovernmentLogo.webp')  }}"><br>Ministry of Health
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12 text-center pointer bm-card">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/MalaysianGovernmentLogo.webp')  }}"><br>Ministry of Foreign Affairs
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12 text-center pointer bm-card">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/JohorStateGovernmentLogo.webp')  }}"><br>Johor State Government
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12 text-center pointer bm-card">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/MalaysianGovernmentLogo.webp')  }}"><br>Johor State <br> Department of Health
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12 text-center pointer bm-card">
                        <div class="card-body p-2">
                            <img src="{{ themes('img/JabatanImigresenMalaysiaLogo.webp')  }}"><br>Immigration Department <br>of Malaysia
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p style="color: #A85258;padding-top: 60px;padding-bottom: 60px;margin-bottom: 0;text-align: center;">Powered by Jengu © 2020</p>
            </div>
        </div>
    </div>
</section>







@endsection