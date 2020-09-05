<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AKKHOR | @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/img/favicon.png')}}">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{asset('public/css/normalize.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('public/css/main.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('public/css/all.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('public/fonts/flaticon.css')}}">
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="{{asset('public/css/fullcalendar.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('public/css/select2.min.css') }}">
    <!-- Jqr datatables -->
    <link rel="stylesheet" href="{{asset('public/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('public/css/animate.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <!-- Modernize js -->
    <script src="{{asset('public/js/modernizr-3.6.0.min.js')}}"></script>
    {{-- CDN DataTable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap1.min.css') }}" />
    {{-- CDN Vuejs --}}
    <script src='https://cdn.jsdelivr.net/npm/vue'></script>
    {{-- CDN Axios --}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js'></script>
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{asset('public/css/jquery-ui.css')}}">
    {{-- Mutiple Select CSS --}}
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-multiselect.css')}}">
    {{-- Validate CSS --}}
    <link rel="stylesheet" href="{{ asset('public/css/parsley.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    @yield('master')
    <!-- jquery-->
    <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('public/js/plugins.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('public/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
    <!-- Counterup Js -->
    <script src="{{asset('public/js/jquery.counterup.min.js')}}"></script>
    <!-- Moment Js -->
    <script src="{{asset('public/js/moment.min.js')}}"></script>
    <!-- Waypoints Js -->
    <script src="{{asset('public/js/jquery.waypoints.min.js')}}"></script>
    <!-- Scroll Up Js -->
    <script src="{{asset('public/js/jquery.scrollUp.min.js')}}"></script>
    <!-- Full Calender Js -->
    <script src="{{asset('public/js/fullcalendar.min.js')}}"></script>
    <!-- Chart Js -->
    <script src="{{asset('public/js/Chart.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('public/js/main.js')}}"></script>
    <!-- Select 2 Js -->
    <script src="{{asset('public/js/select2.min.js')}}"></script>
    <!-- Modernize js -->
    <script src="{{asset('public/js/modernizr-3.6.0.min.js')}}"></script>
    <!-- Datepicker Js -->
    <script src="{{asset('public/js/jquery-ui.js')}}"></script>
    <script src="{{asset('public/js/getProfile.js')}}"></script>
    <script type="text/javascript">
        $( function(){
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeYear:true,
                changeMonth:true,
                showWeek:true,
                showOtherMonths:true
            });
            $("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',
                changeYear:true,
                changeMonth:true,
                showWeek:true,
                showOtherMonths:true
            });
        });
    </script>

    <!-- jQuery -->
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script src="{{asset('public/js/bootstrap-multiselect.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/4ca587dd72.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <!-- App scripts -->
    @stack('scripts')

    @if (Auth::guard('teacher')->check())
    <script>
        var id_teacher={{Auth::guard('teacher')->user()->id}}
        var pusher = new Pusher('576aec32d50bd84ba5f3', {
          cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('lock-teacher-account', function(data) {
            if(data['id_teacher']==id_teacher)
            {
                window.location.assign('{{route('teacher.getLogout')}}');
            }
        });
      </script>
    @endif
</body>

</html>
