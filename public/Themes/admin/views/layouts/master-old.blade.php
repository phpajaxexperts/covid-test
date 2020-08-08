
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Google Font -->
    <?php
    echo Theme::get('theme-name')['themepath']; exit;
    //echo "<pre>"; print_r(Theme::get('theme-name')); exit;
    //echo Theme::get('theme-name')['themepath']; exit; 
    ?>

    @if(App::environment()=='live')
        <link rel="stylesheet" href="{{ mix('/assets/css/app.css', Theme::get('theme-name')['themepath']) }}">
    @elseif(App::environment()=='local')
        <link rel="stylesheet" href="{{ mix('/assets/css/app.css', Theme::get('theme-name')['themepath']) }}">
    @endif
    @yield('style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    @include('layouts.header')

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    @include('layouts.sidebar')

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pace page
                <small>Loading example</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Pace page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.footer')

    @include('layouts.rightsidebar')

</div>
<!-- ./wrapper -->

<script>
    var baseurl = "{{ url('/') }}";
</script>
@if(App::environment()=='live')
    <script src="{{ mix('/assets/js/app.js', Theme::get('theme-name')['themepath']) }}" type="text/javascript"></script>
@elseif(App::environment()=='local')
    <script src="{{ mix('/assets/js/app.js', Theme::get('theme-name')['themepath']) }}" type="text/javascript"></script>
@endif
@yield('scripts')
</body>
</html>