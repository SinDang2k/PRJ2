@extends('layouts.master')
@section('title', 'Import Excel Student')
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
                <h3>Sinh Viên</h3>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('student.view_all') }}">Danh sách sinh viên</a>
                    </li>
                    <li>Thêm sinh viên Excel</li>
                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Admit Form Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">

                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Xoá</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i>Sửa</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Hoàn
                                    tác</a>
                            </div>
                        </div>
                    </div>
                    <form id="validate_form" action="{{ route('student.process_import_excel') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                            <div class="alert alert-warning">
                                <h3 class="text-danger">Hãy chọn file Excel</h3>
                            </div>

            <div class="row">
                <div class="col-lg-6 col-12 form-group mg-t-30">
                    <span>
                        Nếu bạn là người mới dùng thì vui lòng hãy xem bản excel mẫu ở
                        <a href="{{ route('student.get_excel_student_by_class') }}">
                            đây
                        </a>
                    </span><br>
                    <input type="file" class="form-control-file" name="file_excel" required data-parsley-required-message="Hãy chọn 1 file excel & csv" style="width: 50%; outline: none;">
                </div>
                <div class="col-12 form-group mg-t-8">
                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Lưu</button>
                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Đặt lại</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#validate_form').parsley();
        });
    </script>
@endpush


