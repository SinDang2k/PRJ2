@extends('layouts.theme_ui_student.master')
@section('title', 'Sinh - Viên')
@section('ui-student')
<div id="wrapper">
    @include('layouts.theme_ui_student.navbar')
    <section id="home" class="video-section js-height-full">
        <div class="overlay"></div>
        <div class="home-text-wrapper relative container">
            <div class="home-message">
                <p>Management System</p>
                <small>The website provides full information about students and will always update test scores as soon as possible. If you have any questions, please send feedback by mail.</small>
            </div>
        </div>
        <div class="slider-bottom">
            <span>Explore <i class="fa fa-angle-down"></i></span>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 hidden-sm hidden-xs">
                    <div class="custom-module">
                        <img src="{{ asset('public/img/cover/bia-1.png') }}" alt="" class="img-responsive wow slideInLeft">
                    </div><!-- end module -->
                </div><!-- end col -->
                <div class="col-md-8">
                    <div class="custom-module p40l">
                        <h2>We are a passionate <mark>learning system</mark> from<br>
                        Vietnam.</h2>

                        <p>The 3-year training school system includes the following subjects:</p>

                        <hr class="invis">

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 first">
                                <ul class="check">
                                    <li>HTML - CSS - JS</li>
                                    <li>Bootstrap</li>
                                    <li>Sever Side</li>
                                    <li>PHP</li>
                                    <li>Laravel</li>
                                </ul><!-- end check -->
                            </div><!-- end col-lg-4 -->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <ul class="check">
                                    <li>JAVA</li>
                                    <li>C++</li>
                                    <li>C#</li>
                                    <li>XML</li>
                                    <li>Algorithms</li>
                                </ul><!-- end check -->    
                            </div><!-- end col-lg-4 -->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 last">
                                <ul class="check">
                                    <li>Image Processing</li>
                                    <li>Technical English</li>
                                </ul><!-- end check -->
                            </div><!-- end col-lg-4 --> 
                        </div><!-- end row -->   

                        <hr class="invis">

                        <div class="btn-wrapper">
                            <a href="#" class="btn btn-primary">Learn More About us</a>
                        </div>

                    </div><!-- end module -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <section class="section gb" style="background: #ffffff; padding-top: unset;"></section>

    <section class="section db p120">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tagline-message text-center">
                        <h3>Howdy, we are AKKHOR, we have brought great experiences through each subject.</h3>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end section -->

    <section class="section gb nopadtop">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="box m30">
                        <i class="flaticon-computer-tool-for-education"></i>
                        <h4>Learning system</h4>
                        <p>All sections required for online training are included to Edulogy.</p>
                        <a href="#" class="readmore">Read more</a>
                    </div>
                </div><!-- end col -->

                <div class="col-md-6">
                    <div class="box m30">
                        <i class="flaticon-monitor-tablet-and-smartohone"></i>
                        <h4>Works all mobile devices</h4>
                        <p>The most important feature of this template is that it is compatible with all mobile devices. Your customers can also visit your site easily from tablets and phones.</p>
                        <a href="#" class="readmore">Read more</a>
                    </div>
                </div><!-- end col -->

                <div class="col-md-3">
                    <div class="box m30">
                        <i class="flaticon-download-business-statistics-symbol-of-a-graphic"></i>
                        <h4>User Dashboard</h4>
                        <p>We designed the design of all the sub-pages needed for the users.</p>
                        <a href="https://dribbble.com/tags/user_dashboard" class="readmore">Read more</a>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

            <hr class="invis">

            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <i class="flaticon-html5"></i> <i class="flaticon-css-3"></i>
                        <h4>Compatible HTML5 & CSS3</h4>
                        <p>HTML5 is a markup language used for structuring and presenting content on the World Wide Web. It is the fifth and current version of the HTML standard.</p>
                        <a href="https://www.w3schools.com/html/default.asp" class="readmore">Read more</a>
                    </div>
                </div><!-- end col -->

                <div class="col-md-6">
                    <div class="box">
                        <i class="flaticon-html-coding"></i>
                        <h4>Bootstrap Framework</h4>
                        <p>Bootstrap is a technique of loading a program into a computer by means of a few initial instructions which enable the introduction of the rest of the program from an input device.</p>
                        <a href="https://www.w3schools.com/bootstrap4/default.asp" class="readmore">Read more</a>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <section class="section db">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="stat-count">
                        <h4 class="stat-timer">1230</h4>
                        <h3><i class="flaticon-black-graduation-cap-tool-of-university-student-for-head"></i> Happy Students</h3>
                        <p>Quisque porttitor eros quis leo pulvinar, at hendrerit sapien iaculis. </p>
                    </div><!-- stat-count -->
                </div><!-- end col -->

                <div class="col-lg-4 col-md-4">
                    <div class="stat-count">
                        <h4 class="stat-timer">331</h4>
                        <h3><i class="flaticon-online-course"></i> Course Done</h3>
                        <p>Quisque porttitor eros quis leo pulvinar, at hendrerit sapien iaculis. </p>
                    </div><!-- stat-count -->
                </div><!-- end col -->

                <div class="col-lg-4 col-md-4">
                    <div class="stat-count">
                        <h4 class="stat-timer">8901</h4>
                        <h3><i class="flaticon-coffee-cup"></i> Ordered Coffe's</h3>
                        <p>Quisque porttitor eros quis leo pulvinar, at hendrerit sapien iaculis. </p>
                    </div><!-- stat-count -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <section class="section">
        <div class="container">
            <div class="section-title text-center">
                <h3>Testimonials</h3>
                <p>Maecenas sit amet tristique turpis. Quisque porttitor eros quis leo pulvinar, at hendrerit sapien iaculis. Donec consectetur accumsan arcu, sit amet fringilla ex ultricies.</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-4">
                    <div class="box testimonial">
                        <p class="testiname"><strong><img src="" alt="" class="img-circle"> Jenny LUXURY</strong></p>
                        <p>Quisque porttitor eros quis leo pulvinar, at hendrerit sapien iaculis. Donec consectetur accumsan arcu, sit amet fringilla ex ultricies.</p>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div><!-- end testimonial -->
                </div><!-- end col -->

                <div class="col-md-4">
                    <div class="box testimonial">
                        <p class="testiname"><strong><img src="" alt="" class="img-circle"> Martin LEO</strong></p>
                        <p>Quisque porttitor eros quis leo pulvinar, at hendrerit sapien iaculis. Donec consectetur accumsan arcu, sit amet fringilla ex ultricies.</p>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                    </div><!-- end testimonial -->
                </div><!-- end col -->

                <div class="col-md-4">
                    <div class="box testimonial">
                        <p class="testiname"><strong><img src="" alt="" class="img-circle"> John DOE</strong></p>
                        <p>Quisque porttitor eros quis leo pulvinar, at hendrerit sapien iaculis. Donec consectetur accumsan arcu, sit amet fringilla ex ultricies.</p>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div><!-- end testimonial -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <section class="section gb" style="background: #ffff; padding:unset;"></section>

    <section class="section bgcolor1" style="background: #ffff; padding-top: unset;"></section>

    @include('layouts.theme_ui_student.footer')
</div><!-- end wrapper -->
@endsection
