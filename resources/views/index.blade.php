@extends('layouts.master')
@section('title', 'Dashboard - Admin')
@section('master')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var analytics = <?php echo $gender; ?>

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

       function drawChart()
       {
            var data = google.visualization.arrayToDataTable(analytics);

            var options = {
                legend: 'none',
                title : '',
                chartArea:{width:'95%'},
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
       }
</script>
<div id="wrapper" class="wrapper bg-ash">
    <!-- Header Menu Area Start Here -->
    @include('layouts.navbar')
    <!-- Header Menu Area End Here -->
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        @include('layouts.sidebar')
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <h3>Admin Dashboard</h3>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li>Admin</li>
                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Dashboard summery Start Here -->
            <div class="row gutters-20">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="dashboard-summery-one mg-b-20">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-green ">
                                    <i class="flaticon-classmates text-green"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content">
                                    <div class="item-title"><a href="{{ url('admin/student') }}">Students</a></div>
                                    <div class="item-number"><span class="counter"
                                            data-num="{{$student}}">{{$student}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="dashboard-summery-one mg-b-20">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-blue">
                                    <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content">
                                    <div class="item-title"><a href="{{ url('admin/teacher') }}">Teachers</a></div>
                                    <div class="item-number"><span class="counter"
                                            data-num="{{ $teacher }}">{{ $teacher }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="dashboard-summery-one mg-b-20">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-yellow">
                                    <i
                                        class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler text-orange"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content">
                                    <div class="item-title"><a href="{{ url('admin/classes') }}">Classes</a></div>
                                    <div class="item-number"><span class="counter"
                                            data-num="{{$classes}}">{{$classes}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="dashboard-summery-one mg-b-20">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-red">
                                    <i class="flaticon-open-book text-red"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content">
                                    <div class="item-title"><a href="{{ url('admin/subject') }}">Subjects</a></div>
                                    <div class="item-number"><span class="counter"
                                            data-num="{{$subject}}">{{$subject}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard summery End Here -->
            <!-- Dashboard Content Start Here -->
            <div class="row gutters-20">
                <div class="col-12 col-xl-8 col-5-xxxl">
                    <div class="card dashboard-card-one pd-b-20">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Earnings</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">...</a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <div class="earning-report">
                                <div class="item-content">
                                    <div class="single-item pseudo-bg-blue">
                                        <h4>Total Collections</h4>
                                        <span>75,000</span>
                                    </div>
                                    <div class="single-item pseudo-bg-red">
                                        <h4>Fees Collection</h4>
                                        <span>15,000</span>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="date-dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">Jan 20, 2019</a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Jan 20, 2019</a>
                                        <a class="dropdown-item" href="#">Jan 20, 2021</a>
                                        <a class="dropdown-item" href="#">Jan 20, 2020</a>
                                    </div>
                                </div>
                            </div>
                            <div class="earning-chart-wrap">
                                <canvas id="earning-line-chart" width="660" height="320"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6 col-3-xxxl">
                    <div class="card dashboard-card-three pd-b-20">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Students</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">...</a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <div id="piechart"
                                style="width:287px; height:335px; position: relative; left: -30px; top: -20px">

                            </div>
                            <div class="student-report">
                                <div class="student-count pseudo-bg-red">
                                    <h4 class="item-title">Male Students</h4>
                                    <div class="item-number">{{ $male_student }}</div>
                                </div>
                                <div class="student-count pseudo-bg-blue">
                                    <h4 class="item-title">Female Students</h4>
                                    <div class="item-number">{{ $female_student }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 col-4-xxxl">
                    <div class="card dashboard-card-six pd-b-20">
                        <div class="card-body">
                            <div class="heading-layout1 mg-b-17">
                                <div class="item-title">
                                    <h3>Điểm danh</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">...</a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <div class="notice-box-wrap">
                                @foreach($rollCalls as $key=>$rollCall)

                                @if(($key+1)%3==0)
                                    @php $bg='bg-skyblue'; @endphp
                                @elseif(($key+1)%2==0)
                                    @php $bg='bg-yellow'; @endphp
                                @else
                                    @php $bg='bg-pink'; @endphp
                                @endif
                                    @php
                                    $unixtime=strtotime($rollCall->khoi_tao);
                                    $date=date("d, F Y H:i",$unixtime);
                                    @endphp
                                @php
                                if(strtotime($rollCall->khoi_tao) < strtotime($rollCall->sua))
                                {
                                    $unixtime=strtotime($rollCall->sua);
                                    $date=date("d, F Y H:i",$unixtime);
                                @endphp
                                    <div class="notice-list">
                                        <div class="post-date {{$bg}}">{{$date}}</div>
                                        <h6 class="notice-title"><a href="#">Update điểm danh lớp
                                                {{$rollCall->class_name}}</a></h6>
                                        <div class="entry-meta"> Giáo Viên / <span>{{$rollCall->teacher_name}}</span>
                                        </div>
                                    </div>
                                @php
                                }
                                    switch ($bg) {
                                        case 'bg-skyblue':
                                            $bg='bg-yellow';
                                        break;
                                        case 'bg-yellow':
                                            $bg='bg-pink';
                                        break;
                                        case 'bg-pink':
                                            $bg='bg-skyblue';
                                        break;
                                    }
                                @endphp
                                <div class="notice-list">
                                    <div class="post-date {{$bg}}">{{$date}}</div>
                                    <h6 class="notice-title"><a href="#">Điểm danh lớp {{$rollCall->class_name}}</a>
                                    </h6>
                                    <div class="entry-meta"> Giáo Viên / <span>{{$rollCall->teacher_name}}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6 col-4-xxxl">
                    <div class="card dashboard-card-four pd-b-20">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Event Calender</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">...</a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <div class="calender-wrap">
                                <div id="fc-calender" class="fc-calender"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 col-4-xxxl">
                    <div class="card dashboard-card-five pd-b-20">
                        <div class="card-body pd-b-14">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Website Traffic</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">...</a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <h6 class="traffic-title">Unique Visitors</h6>
                            <div class="traffic-number">2,590</div>
                            <div class="traffic-bar">
                                <div class="direct" data-toggle="tooltip" data-placement="top" title="Direct">
                                </div>
                                <div class="search" data-toggle="tooltip" data-placement="top" title="Search">
                                </div>
                                <div class="referrals" data-toggle="tooltip" data-placement="top" title="Referrals">
                                </div>
                                <div class="social" data-toggle="tooltip" data-placement="top" title="Social">
                                </div>
                            </div>
                            <div class="traffic-table table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="t-title pseudo-bg-Aquamarine">Direct</td>
                                            <td>12,890</td>
                                            <td>50%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-blue">Search</td>
                                            <td>7,245</td>
                                            <td>27%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-yellow">Referrals</td>
                                            <td>4,256</td>
                                            <td>8%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-red">Social</td>
                                            <td>500</td>
                                            <td>7%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 col-3-xxxl">
                    <div class="card dashboard-card-two pd-b-20" style="width: 385px">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Expenses</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">...</a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <div class="expense-report">
                                <div class="monthly-expense pseudo-bg-Aquamarine">
                                    <div class="expense-date">Jan 2019</div>
                                    <div class="expense-amount"><span>$</span> 15,000</div>
                                </div>
                                <div class="monthly-expense pseudo-bg-blue">
                                    <div class="expense-date">Feb 2019</div>
                                    <div class="expense-amount"><span>$</span> 10,000</div>
                                </div>
                                <div class="monthly-expense pseudo-bg-yellow">
                                    <div class="expense-date">Mar 2019</div>
                                    <div class="expense-amount"><span>$</span> 8,000</div>
                                </div>
                            </div>
                            <div class="expense-chart-wrap">
                                <canvas id="expense-bar-chart" width="100" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard Content End Here -->
            <!-- Social Media Start Here -->
            <div class="row gutters-20">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card dashboard-card-seven">
                        <div class="social-media bg-fb hover-fb">
                            <div class="media media-none--lg">
                                <div class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                                <div class="media-body space-sm">
                                    <h6 class="item-title">Like us on facebook</h6>
                                </div>
                            </div>
                            <div class="social-like">30,000</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card dashboard-card-seven">
                        <div class="social-media bg-twitter hover-twitter">
                            <div class="media media-none--lg">
                                <div class="social-icon">
                                    <i class="fab fa-twitter"></i>
                                </div>
                                <div class="media-body space-sm">
                                    <h6 class="item-title">Follow us on twitter</h6>
                                </div>
                            </div>
                            <div class="social-like">1,11,000</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card dashboard-card-seven">
                        <div class="social-media bg-gplus hover-gplus">
                            <div class="media media-none--lg">
                                <div class="social-icon">
                                    <i class="fab fa-google-plus-g"></i>
                                </div>
                                <div class="media-body space-sm">
                                    <h6 class="item-title">Follow us on googleplus</h6>
                                </div>
                            </div>
                            <div class="social-like">19,000</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card dashboard-card-seven">
                        <div class="social-media bg-linkedin hover-linked">
                            <div class="media media-none--lg">
                                <div class="social-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </div>
                                <div class="media-body space-sm">
                                    <h6 class="item-title">Follow us on linked</h6>
                                </div>
                            </div>
                            <div class="social-like">45,000</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Social Media End Here -->
            <!-- Footer Area Start Here -->
            @include('layouts.footer')
            <!-- Footer Area End Here -->
        </div>
    </div>
    <!-- Page Area End Here -->
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        console.log($(".notice-box-wrap .notice-list")[0]);
    });
    var pusher = new Pusher('576aec32d50bd84ba5f3', {
  cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    var class_children=$(".notice-list").children()[0].classList[1];
    switch (class_children) {
        case 'bg-skyblue':
            var bg='bg-pink';
        break;
        case 'bg-yellow':
            var bg='bg-skyblue';
        break;
        case 'bg-pink':
            var bg='bg-yellow';
        break;
    }
    $(".notice-box-wrap").prepend(`
    <div class="notice-list">
        <div class="post-date `+bg+`">`+data.time+`</div>
        <h6 class="notice-title"><a href="#">`+data.text+`</a></h6>
        <div class="entry-meta"> `+data.position+' / '+data.person_name+`</div>
    </div>
    `)
});
</script>
@endpush
