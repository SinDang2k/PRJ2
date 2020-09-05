@extends('layouts.master')
@section('title', 'Edit Department')
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
                <h3>Ngành học</h3>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('department.view_all') }}">Danh sách ngành học</a>
                    </li>
                    <li>Cập nhật ngành học</li>
                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Add Class Area Start Here -->
            <div id="department" class="card height-auto">
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
                        <form id="validate_form" action="{{ route('department.process_update',['id'=>$department->id]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Mã ngành</label>
                                    <input type="text" name="prefix" id="prefix" value="{{ $department->prefix }}" class="form-control" placeholder="Mã ngành học" required data-parsley-pattern="^[A-Za-z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ]{2,5}$" data-parsley-trigger="keyup" data-parsley-pattern-message="Mã ngành ít nhất có 2 chữ đến 5 chữ" data-parsley-required-message="Mã ngành không được để trống" style="height: 45px; font-size: 12px" autocomplete="off"/>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Tên ngành</label>
                                    <input type="text" name="department_name" id="department_name" value="{{ $department->department_name }}" class="form-control" placeholder="Tên ngành học" required data-parsley-pattern="^(?:[A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪ][a-zàáâãèéêếìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ\ ]{1,30}\s?)+$" data-parsley-trigger="keyup" data-parsley-pattern-message="Tên ngành ít nhất có 2 chữ đến 30 chữ" data-parsley-required-message="Tên ngành không được để trống" style="height: 45px; font-size: 12px" autocomplete="off"/>
                                </div>
                                <div class="col-md-6 form-group"></div>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit"
                                    class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Lưu</button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Đặt lại</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Add Class Area End Here -->
                @include('layouts.footer')
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>

    @push('scripts')
    <script>
        $(document).ready(function(){
            $('#validate_form').parsley();
        });
    </script>

    <script>
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    </script>
    @endpush
    @endsection
