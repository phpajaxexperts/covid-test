<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if(View::hasSection('dynamicMetaTitle'))
        <title>@yield('dynamicMetaTitle')</title>
        @else
        <title>@yield('titlePrepend') Sameera Maya Kitchen @yield('titleAppend')</title>
        @endif
    
        @if(View::hasSection('metaDescription'))
        <meta name="description" content="@yield('metaDescription')">
        @endif
    

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="//fonts.googleapis.com/css?family=Skranji" rel="stylesheet" type="text/css">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ themes('bootstrap-4.4.1-dist/css/bootstrap.min.css') }}">
        <link href="{{ themes('css/pace/pace-theme-corner-indicator.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ themes('css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">



        <link href="{{ themes('css/template/media_query.css') }}" rel="stylesheet" type="text/css"/>

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="{{ themes('css/template/animate.css') }}" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link href="{{ themes('css/template/owl.carousel.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ themes('css/template/owl.theme.default.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap CSS -->
        <link href="{{ themes('css/template/style_1.css') }}" rel="stylesheet" type="text/css"/>

        <script src="{{ themes('js/template/modernizr-3.5.0.min.js') }}"></script>

        @stack('css')
        @yield('css')        
    </head>
    <body>
        @include('layouts.header')    
            <div class="content">
                @yield('content')
            </div>
        @include('layouts.footer')

    @stack('additionalContent')

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
          <div class="overlay" id="modal_loading">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
          </div>
        </div>
    </div>
    <!-- Modal HTML -->
    {{--<script src="{{ themes('js/jquery-3.5.0.min.js') }}"></script>--}}
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="{{ themes('bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>


    <script src="{{ themes('js/template/owl.carousel.min.js') }}"></script>
    <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"  crossorigin="anonymous"></script>
    <!-- Waypoints -->
    <script src="{{ themes('js/template/jquery.waypoints.min.js') }}"></script>
    <!-- Main -->
    <script src="{{ themes('js/template/main.js') }}"></script>
<script>
    $(function () {
        $(window).on('scroll', function () {
            if ( $(window).scrollTop() > 10 ) {
                $('.navbar').addClass('active');
            } else {
                $('.navbar').removeClass('active');
            }
        });
    });
</script>
    @stack('js')
    @yield('js')
    </body>
</html>
