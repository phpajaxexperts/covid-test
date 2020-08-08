<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if(View::hasSection('dynamicMetaTitle'))
        <title>@yield('dynamicMetaTitle')</title>
        @else
        <title>@yield('titlePrepend') | Sameera Maya Kitchen @yield('titleAppend')</title>
        @endif
    
        @if(View::hasSection('metaDescription'))
        <meta name="description" content="@yield('metaDescription')">
        @endif
    

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ themes('bootstrap-4.4.1-dist/css/bootstrap.min.css') }}">
        <link href="{{ themes('css/pace/pace-theme-corner-indicator.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ themes('css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
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
    <script src="{{ themes('js/jquery-3.5.0.min.js') }}"></script>    
    <script src="{{ themes('bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ themes('js/pace.min.js') }}"></script>    
    <script src="{{ themes('js/custom.js') }}"></script>    
    @stack('js')
    @yield('js')
    </body>
</html>
