@extends('layouts.theme_ui_student.master')
@section('title', 'Thông tin chi tiết Sinh Viên')
@section('ui-student')
<div id="wrapper">
    @include('layouts.theme_ui_student.navbar')

    <section class="section lb p120">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tagline-message page-title text-center">
                        <h3>Thông tin chi tiêt sinh viên</h3>
                        <ul class="breadcrumb">
                            <li class="active">AKKHOR</li>
                            <li><a href="{{ route('student.dashboard') }}">Home</a></li>
                        </ul>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end section -->

    <section class="section gb nopadtop">
        <div class="container">
            <div class="boxed boxedp4">
                <div class="shop-top" style="padding:0px">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h3>Thông tin sinh viên</h3>
                        </div>

                        <span>
                            @if (session('success'))
                                <div class="alert alert-success" role="alert" style="margin-top: 65px;">
                                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                                </div>
                            @endif   

                            @if (session('warning'))
                                 <div class="alert alert-warning" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                                </div>
                            @endif             
                        </span>
                </div>
            </div>
            <form action="{{ route('student.update_info_student', ['id' => Session::get('student_id')]) }}" method="post">
                @csrf
                <div class="row blog-grid shop-grid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-12 form-group" style="margin-left: 15px;">
                            <label>Họ và tên</label>
                            <input type="text" class="form-control" name="student_name" value="{{ $infostudent->student_name }}" style="height: 45px; font-size: 13px" readonly="" />
                        </div>
                        <div class="col-xl-3 col-lg-2 col-12 form-group">
                            <label>Giới tính</label>
                            <input type="text" class="form-control" name="gender" value="{{ $infostudent->gender }}" style="height: 45px; font-size: 13px" readonly="">
                        </div>
                        <div class="col-xl-3 col-lg-2 col-12 form-group">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" value="{{ $infostudent->birthday }}" style="height: 45px; font-size: 13px" autocomplete="off" name="birthday" autocomplete="off" required data-parsley-required-message="Hãy chọn ngày sinh">
                        </div>
                        <div class="col-xl-3 col-lg-4 col-12 form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Nhập E-Mail" class="form-control" name="email" autocomplete="off" required data-parsley-pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$"
                            data-parsley-trigger="keyup"
                            data-parsley-pattern-message="E-Mail không đúng định dạng"
                            data-parsley-required-message="E-Mail không được để trống" value="{{ $infostudent->email }}" style="height: 45px; font-size: 13px" >
                        </div>
                    </div>

                    <hr class="invis">
                </div>

                <div class="row blog-grid shop-grid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-2 col-12 form-group" style="margin-left: 15px;">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="{{ $infostudent->phone }}" style="height: 45px; font-size: 13px" />
                        </div>
                        <div class="col-xl-3 col-lg-2 col-12 form-group">
                            <label>Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ $infostudent->address }}" style="height: 45px; font-size: 13px" >
                        </div>
                        <div class="col-xl-3 col-lg-2 col-12 form-group">
                            <label>Lớp học</label>
                            <select name="classes_id" class="form-control" style="height: 45px">
                                <option value="{{ $infostudent->classes_id }}">
                                    {{ $infostudent->classes_name }}
                                </option>}
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-12 form-group">
                            <label>Ngành học</label>
                            <input type="text" class="form-control" value="{{ $infostudent->department_name }}" style="height: 45px; font-size: 13px" readonly="">
                        </div>
                        <div class="col-xl-3 col-lg-2 col-12 form-group">
                            <label>Khoá học</label>
                            <input type="text" class="form-control" value="{{ $infostudent->course_name }}" style="height: 45px; font-size: 13px" readonly="">
                        </div>
                    </div>

                    <hr class="invis">
                </div>

                <div class="row blog-grid shop-grid">
                    <div class="row">
                     <div class="col-xl-3 col-lg-2 col-12 form-group" style="margin-left: 15px;">
                        <button class="btn btn-primary" style="outline: none;">Cập nhật</button>
                    </div>
                </div>
            </div>
        </form>
    </div><!-- end container -->
</section>

@include('layouts.theme_ui_student.footer')
</div><!-- end wrapper -->
@endsection

@push('script')
<script>
   $(".alert").fadeTo(2000, 500).slideUp(500, function(){
       $(".alert").slideUp(500);
   });
</script>
@endpush