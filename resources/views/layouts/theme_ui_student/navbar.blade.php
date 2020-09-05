<header class="header">
    <div class="topbar clearfix">
        <div class="container">
            <div class="row-fluid">
                <div class="col-md-6 col-sm-6 text-left">
                    <p>
                        <strong><i class="fa fa-phone"></i></strong> +90 543 123 45 67 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <strong><i class="fa fa-envelope"></i></strong> <a href="mailto:akkhortm9@gmail.com">akkhortm9@gmail.com</a>
                    </p>
                </div><!-- end left -->
                <div class="col-md-6 col-sm-6 hidden-xs text-right">
                    <div class="social">
                        <a class="facebook" href="#" data-tooltip="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>              
                        <a class="twitter" href="#" data-tooltip="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                    </div><!-- end social -->
                </div><!-- end left -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end topbar -->

    <div class="container">
        <nav class="navbar navbar-default yamm">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="logo-normal">
                    <a class="navbar-brand" href="{{ route('student.dashboard') }}"><img src="{{ asset('public/img/logo.png') }}" alt=""></a>
                </div>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('student.dashboard') }}">Home</a></li>
                    <li class="dropdown hassubmenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Display <span class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('student.info_student', ['id' => Session::get('student_id')]) }}">Detail Student</a></li>
                            <li><a href="{{ route('student.info_point_student', ['id' => Session::get('student_id')]) }}">Point Student</a></li>
                            <li><a href="{{ route('student.getLogout') }}">Logout</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </nav><!-- end navbar -->
    </div><!-- end container -->
</header>
