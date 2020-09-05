@extends('layouts.master')
@section('master')
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
            <h3>Giáo Viên</h3>
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}">Trang chủ</a>
                </li>
                <li>
                    <a href="{{ route('teacher.view_all') }}">Danh sách giáo viên</a>
                </li>
                <li>
                    Thông tin giáo viên
                </li>
            </ul>
        </div>
        <!-- Breadcubs Area End Here -->
        <!-- Student Details Area Start Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" 
                        data-toggle="dropdown" aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Xoá</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Sửa</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Hoàn tác</a>
                        </div>
                    </div>
                </div>
                <div class="single-info-details">
                    <div class="item-img">
                        <img src="{{ $teacher->images }}" alt="teacher" style="width: 250px; height:250px; ">
                    </div>
                    <div class="item-content">
                        <div class="header-inline item-header">
                            <h3 class="text-dark-medium font-medium">{{ $teacher->teacher_name }}</h3>
                            <div class="header-elements">
                                <ul>
                                    <li><a href="{{ route('teacher.view_update',['id'=>$teacher->id]) }}"><i class="far fa-edit"></i></a></li>
                                    <li><a href="#" download><i class="fas fa-download"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <p></p>
                        <div class="info-table table-responsive">
                            <table class="table text-nowrap">
                                <tbody>
                                    <tr>
                                        <td>Giới tính:</td>
                                        <td class="font-medium text-dark-medium">
                                            @if ($teacher->gender == 1)
                                                Nam
                                            @else
                                                Nữ
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ngày sinh:</td>
                                        <td class="font-medium text-dark-medium">{{ $teacher->birthday }}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail:</td>
                                        <td class="font-medium text-dark-medium">{{ $teacher->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ:</td>
                                        <td class="font-medium text-dark-medium">{{ $teacher->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại:</td>
                                        <td class="font-medium text-dark-medium">{{ $teacher->phone }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Student Details Area End Here -->
        @include('layouts.footer')
    </div>
</div>
<!-- Page Area End Here -->
</div>
@endsection