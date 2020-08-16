<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <link href="{{ themes('css/pace/pace-theme-corner-indicator.css') }}" rel="stylesheet" />
        <link href="{{ themes('vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
        <link href="{{ themes('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ themes('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ themes('vendor/venobox/venobox.css') }}" rel="stylesheet">
        <link href="{{ themes('css/style.css') }}" rel="stylesheet">


        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ themes('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="{{ themes('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ themes('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ themes('plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ themes('dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ themes('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ themes('plugins/daterangepicker/daterangepicker.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ themes('plugins/summernote/summernote-bs4.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        @stack('css')
        @yield('css')        
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    @include('layouts.header')
            <div class="content">
                @yield('content')
            </div>
        @include('layouts.footer')

    </div>
    <!-- ./wrapper -->
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
        <!-- jQuery -->
        <script src="{{ themes('plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ themes('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ themes('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ themes('plugins/chart.js/Chart.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ themes('plugins/sparklines/sparkline.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ themes('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ themes('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ themes('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ themes('plugins/moment/moment.min.js') }}"></script>
        <script src="{{ themes('plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ themes('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <!-- Summernote -->
        <script src="{{ themes('plugins/summernote/summernote-bs4.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ themes('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ themes('dist/js/adminlte.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {{--<script src="{{ themes('dist/js/pages/dashboard.js') }}"></script>--}}
        <!-- AdminLTE for demo purposes -->
        <script src="{{ themes('dist/js/demo.js') }}"></script>



    @stack('js')
    @yield('js')
    </body>
</html>
