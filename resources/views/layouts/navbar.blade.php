<div class="navbar navbar-expand-md header-menu-one bg-light">
    <div class="nav-bar-header-one">
        <div class="header-logo">
            @if (Auth::guard('admin')->check())
            <a href="{{ route('dashboard') }}">
                <img src="{{asset('public/img/logo.png')}}" alt="logo">
            </a>
            @else
            <a href="{{ route('teacher.dashboard') }}">
                <img src="{{asset('public/img/logo.png')}}" alt="logo">
            </a>
            @endif

        </div>
        <div class="toggle-button sidebar-toggle">
            <button type="button" class="item-link">
                <span class="btn-icon-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>
    </div>
    <div class="d-md-none mobile-nav-bar">
        <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar"
            aria-expanded="false">
            <i class="far fa-arrow-alt-circle-down"></i>
        </button>
        <button type="button" class="navbar-toggler sidebar-toggle-mobile">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
        <ul class="navbar-nav"></ul>
        <ul class="navbar-nav">
            <li id="myProfile" class="navbar-item dropdown header-admin">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <div class="admin-title">
                        <h5 ref=myName class="item-title">
                            @if (Auth::guard('admin')->check())
                            {{ Auth::guard('admin')->user()->full_name }}
                            @else
                            {{ Auth::guard('teacher')->user()->teacher_name }}
                            @endif
                        </h5>
                        <span>
                            @if (Auth::guard('admin')->check())
                            Admin
                            @else
                            Giáo viên
                            @endif
                        </span>
                    </div>
                    @if (Auth::guard('admin')->check())
                    <div class="admin-img">
                        <img ref="myPicture" src="{{ asset('public/upload/'.Auth::guard('admin')->user()->avatar) }}"
                            alt="Admin" width="40px">
                    </div>
                    @else
                    <div class="admin-img">
                        <img ref="myPicture" src="{{ asset('public/upload/'.Session::get('avatar')) }}" alt="Teacher"
                            width="40px">
                    </div>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="item-header">
                        <h6 class="item-title">
                            @if (Auth::guard('admin')->check())
                            {{ Auth::guard('admin')->user()->full_name }}
                            @else
                            {{ Auth::guard('teacher')->user()->teacher_name }}
                            @endif
                        </h6>
                    </div>
                    <div class="item-content">
                        <ul class="settings-list">
                            <li><a href="{{ route('profile.my_profile') }}"><i class="flaticon-user"></i>Thông tin cá
                                    nhân</a></li>
                            <li><a href="#"><i class="flaticon-list"></i>Task</a></li>
                            <li><a href="#"><i
                                        class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>Message</a>
                            </li>
                            <li><a href="#"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                            <li>
                                @if (Auth::guard('admin')->check())
                                <a href="{{ route('admin.getLogout') }}"><i class="flaticon-turn-off"></i>
                                    Đăng xuất
                                </a>
                                @else
                                <a href="{{ route('teacher.getLogout') }}"><i class="flaticon-turn-off"></i>
                                    Đăng xuất
                                </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="navbar-item dropdown header-message">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="far fa-envelope"></i>
                    <div class="item-title d-md-none text-16 mg-l-10">Message</div>
                    <span>5</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="item-header">
                        <h6 class="item-title">05 Message</h6>
                    </div>
                    <div class="item-content">
                        <div class="media">
                            <div class="item-img bg-skyblue author-online">
                                <img src="" alt="img">
                            </div>
                            <div class="media-body space-sm">
                                <div class="item-title">
                                    <a href="#">
                                        <span class="item-name">Maria Zaman</span>
                                        <span class="item-time">18:30</span>
                                    </a>
                                </div>
                                <p>What is the reason of buy this item.
                                    Is it usefull for me.....</p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-img bg-yellow author-online">
                                <img src="" alt="img">
                            </div>
                            <div class="media-body space-sm">
                                <div class="item-title">
                                    <a href="#">
                                        <span class="item-name">Benny Roy</span>
                                        <span class="item-time">10:35</span>
                                    </a>
                                </div>
                                <p>What is the reason of buy this item.
                                    Is it usefull for me.....</p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-img bg-pink">
                                <img src="" alt="img">
                            </div>
                            <div class="media-body space-sm">
                                <div class="item-title">
                                    <a href="#">
                                        <span class="item-name">Steven</span>
                                        <span class="item-time">02:35</span>
                                    </a>
                                </div>
                                <p>What is the reason of buy this item.
                                    Is it usefull for me.....</p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-img bg-violet-blue">
                                <img src="" alt="img">
                            </div>
                            <div class="media-body space-sm">
                                <div class="item-title">
                                    <a href="#">
                                        <span class="item-name">Joshep Joe</span>
                                        <span class="item-time">12:35</span>
                                    </a>
                                </div>
                                <p>What is the reason of buy this item.
                                    Is it usefull for me.....</p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="navbar-item dropdown header-notification">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <div class="item-title d-md-none text-16 mg-l-10">Notification</div>
                    <span>8</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="item-header">
                        <h6 class="item-title">03 Notifiacations</h6>
                    </div>
                    <div class="item-content">
                        <div class="media">
                            <div class="item-icon bg-skyblue">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="media-body space-sm">
                                <div class="post-title">Complete Today Task</div>
                                <span>1 Mins ago</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-icon bg-orange">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="media-body space-sm">
                                <div class="post-title">Director Metting</div>
                                <span>20 Mins ago</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-icon bg-violet-blue">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="media-body space-sm">
                                <div class="post-title">Update Password</div>
                                <span>45 Mins ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
