<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if(View::hasSection('dynamicMetaTitle'))
        <title>@yield('dynamicMetaTitle')</title>
        @else
        <title>@yield('titlePrepend') Covid - 19 Test @yield('titleAppend')</title>
        @endif
    
        @if(View::hasSection('metaDescription'))
        <meta name="description" content="@yield('metaDescription')">
        @endif


        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ themes('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ themes('vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
        <link href="{{ themes('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ themes('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ themes('vendor/venobox/venobox.css') }}" rel="stylesheet">
        <link href="{{ themes('css/style.css') }}" rel="stylesheet">


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
        <!-- Vendor JS Files -->
        <script src="{{ themes('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ themes('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ themes('vendor/jquery.easing/jquery.easing.min.js') }}"></script>
        <script src="{{ themes('vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ themes('vendor/wow/wow.min.js') }}"></script>
        <script src="{{ themes('vendor/venobox/venobox.min.js') }}"></script>
        <script src="{{ themes('vendor/superfish/superfish.min.js') }}"></script>
        <script src="{{ themes('vendor/hoverIntent/hoverIntent.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ themes('js/main.js') }}"></script>



    @stack('js')
    @yield('js')
    </body>
</html>
