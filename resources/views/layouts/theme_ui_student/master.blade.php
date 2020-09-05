<!doctype html>
<!--[if IE 9]> <html class="no-js ie9 fixed-layout" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js " lang="en"> <!--<![endif]-->
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- Site Meta -->
    <title>AKKHOR | @yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/img/favicon.png')}}">
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i" rel="stylesheet"> 

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4ca587dd72.js" crossorigin="anonymous"></script>
    
    <!-- Custom & Default Styles -->
    <link rel="stylesheet" href="{{ asset('public/ui-student/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/ui-student/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/ui-student/css/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('public/ui-student/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('public/ui-student/style.css') }}">
</head>
<body>  

    <!-- LOADER -->
    <div id="preloader">
        <img class="preloader" src="{{ asset('public/ui-student/images/loader.gif') }}" alt="">
    </div><!-- end loader -->
    <!-- END LOADER -->
    @yield('ui-student')
    <!-- jQuery Files -->
    <script src="{{ asset('public/ui-student/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/ui-student/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/ui-student/js/carousel.js') }}"></script>
    <script src="{{ asset('public/ui-student/js/animate.js') }}"></script>
    <script src="{{ asset('public/ui-student/js/custom.js') }}"></script>
    <!-- VIDEO BG PLUGINS -->
    <script src="{{ asset('public/js/videobg.js') }}"></script>

    @stack('script')
</body>
</html>