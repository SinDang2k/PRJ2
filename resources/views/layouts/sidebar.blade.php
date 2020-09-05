<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none">
        <div class="header-logo">
            <a href="index.html"><img src="{{asset('public/img/logo1.png')}}" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-menu-content" style="min-height:688px">
        <ul class="nav nav-sidebar-menu sidebar-toggle-view">
            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="flaticon-dashboard"></i><span>Bảng điều khiển</span></a>
                <ul class="nav sub-group-menu">
                    @if (Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-angle-right"></i>Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link"><i class="fas fa-angle-right"></i>
                            Giảng viên
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link"><i class="fas fa-angle-right"></i>
                            Giảng viên
                        </a>
                    </li>
                    @endif
                </ul>
            </li>

            @if (Auth::guard('admin')->check())
            <li class="nav-item">
                <a href="{{ route('department.view_all') }}" class="nav-link"><i
                        class="fas fa-graduation-cap"></i><span>Ngành học</span></a>
            </li>
            @else

            @endif

            @if (Auth::guard('admin')->check())
            <li class="nav-item">
                <a href="{{ route('subject.view_all') }}" class="nav-link"><i class="flaticon-open-book"></i><span>Môn
                        học</span></a>
            </li>
            @else

            @endif

            @if (Auth::guard('admin')->check())
            <li class="nav-item">
                <a href="{{ route('classes.view_all') }}" class="nav-link"><i
                        class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Lớp</span></a>
            </li>
            @else

            @endif

            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Sinh Viên</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('student.view_all') }}" class="nav-link"><i
                                class="fas fa-angle-right"></i>Danh sách sinh viên</a>
                    </li>
                    @if (Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a href="{{ route('student.view_import_excel') }}" class="nav-link"><i
                                class="fas fa-angle-right"></i>Thêm sinh viên Excel</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.view_import_excel_year_begin') }}" class="nav-link"><i
                                class="fas fa-angle-right"></i>Thêm sinh viên đầu khoá Excel</a>
                    </li>
                    @else

                    @endif
                </ul>
            </li>

            @if (Auth::guard('admin')->check())
            <li class="nav-item">
                <a href="{{ route('teacher.view_all') }}" class="nav-link"><i
                        class="flaticon-multiple-users-silhouette"></i><span>Giáo
                        Viên</span></a>
            </li>
            @else

            @endif

            @if (Auth::guard('admin')->check())
            <li class="nav-item">
                <a href="{{ route('course.view_all') }}" class="nav-link"><i
                        class="flaticon-books"></i><span>Khoá</span></a>
            </li>
            @else

            @endif

            @if (Auth::guard('admin')->check())
            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="flaticon-calendar"></i><span>Phân công</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('assignment.view_all') }}" class="nav-link"><i
                                class="fas fa-angle-right"></i>Phân
                            công</a>
                    </li>
                </ul>
            </li>
            @endif
            @if (Auth::guard('teacher')->check())
            <li class="nav-item">
                <a href="{{ route('teacher.rollcall.view_insert') }}" class="nav-link"><i
                        class="flaticon-checklist"></i><span>Điểm
                        danh</span></a>
            </li>
            @endif
            @if (Auth::guard('admin')->check())
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-shopping-list"></i><span>Điểm</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="{{ route('point.view_insert') }}" class="nav-link"><i class="fas fa-angle-right"></i>Điểm</a>
                            {{-- <a href="{{ route('point.view_update') }}" class="nav-link"><i class="fas fa-angle-right"></i>Sửa điểm</a> --}}
                        </li>
                    </ul>
                </li>
            @endif
            <li class="nav-item">
                <a href="@if (Auth::guard('admin')->check())
                    {{ route('rollcall.view_history') }}
                    @elseif(Auth::guard('teacher')->check())
                    {{ route('teacher.rollcall.view_history_for_teacher') }}
                    @endif" class="nav-link"><i class="flaticon-script"></i><span>Lịch sử điểm danh</span></a>
            </li>
            <li class="nav-item">
                <a href="messaging.html" class="nav-link"><i class="flaticon-chat"></i><span>Messeage</span></a>
            </li>
            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="flaticon-menu-1"></i><span>Giao diện</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('ui-elements.buttons') }}" class="nav-link"><i class="fas fa-angle-right"></i>Mẫu nút</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ui-elements.grids') }}" class="nav-link"><i class="fas fa-angle-right"></i>Mẫu ô input</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ui-elements.tabs') }}" class="nav-link"><i class="fas fa-angle-right"></i>Mẫu gõ</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('ui-elements.maps') }}" class="nav-link"><i class="flaticon-planet-earth"></i><span>Map</span></a>
            </li>
            <li class="nav-item">
                <a href="account-settings.html" class="nav-link"><i
                        class="flaticon-settings"></i><span>Account</span></a>
            </li>
        </ul>
    </div>
</div>
