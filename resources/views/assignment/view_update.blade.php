@extends('layouts.master')
@section('title', 'Edit Assignment')
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
                <h3>Phân Công</h3>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('assignment.view_all') }}">Danh sách lịch phân công</a>
                    </li>
                    <li>Cập nhật lịch phân công</li>
                </ul>
                <span>
                    @if (session('warning'))
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                    </div>
                    @endif 
                </span>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Add Class Area Start Here -->
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
                        <form id="validate_form" action="{{ route('assignment.process_update' ,['id' => $assignments[0]->classes_id ]) }}" method="post">
                            @csrf
                            
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Tên lớp</label>
                                    <select name="classes_id" class="select2" required data-parsley-required-message="Tên lớp không được để trống">
                                        <option disabled="" value="">Tên lớp</option>
                                        @foreach ($classes as $classe)
                                            @if ($classe->id == $assignments[0]->classes_id)
                                                <option value="{{ $classe->id }}" selected>
                                                    {{ $classe->classes_name }}
                                                </option>
                                            @else
                                                <option value="{{ $classe->id }}">
                                                    {{ $classe->classes_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>                         
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Tên giáo viên</label> 
                                    <select name="teacher_id" class="select2">
                                        <option value="{{ $assignments[0]->teacher_id }}">
                                             {{ $assignments[0]->teacher_name }}
                                        </option>
                                    </select>
                                </div>
                                 <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Tên môn học</label>
                                    <select name="subject_id" class="select2">
                                        <option value="{{ $assignments[0]->subject_id }}">
                                             {{ $assignments[0]->subject_name }}
                                        </option>
                                    </select>
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


            // $('select[name="classes_id"]').on('change', function () {
            //     $abc = $(this).val();
            //     alert($abc);
            // })
        });
    </script>

    <script>
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    </script>
    @endpush
    @endsection
