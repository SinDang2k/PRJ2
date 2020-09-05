@extends('layouts.master')
@section('title', 'Add Student')
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
                    <li>Thêm sinh viên</li>
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
                        <form id="validate_form" action="{{ route('student.process_insert') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Tên sinh viên</label>
                                    <input type="text" placeholder="Nhập tên sinh viên" class="form-control"
                                    name="student_name" autocomplete="off" required data-parsley-pattern="^[A-Za-z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ]{5,20}$" data-parsley-trigger="keyup" data-parsley-pattern-message="Tên sinh viên có ít nhất là 5-20 kí tự" data-parsley-required-message="Tên sinh viên không được phép để trống" style="height: 45px; font-size: 12px">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Giới tính</label>
                                    <select class="select2" name="gender" required data-parsley-required-message="Hãy chọn lựa giới tính">
                                        <option value disabled="" selected="">Chọn giới tính</option>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Ngày sinh</label>
                                    <input type="text" class="form-control" name="birthday" id="datepicker"
                                    autocomplete="off" placeholder="yyyy-mm-dd" style="height: 45px; font-size: 13px" autocomplete="off" required data-parsley-required-message="Hãy chọn ngày sinh">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" placeholder="Nhập địa chỉ" class="form-control" name="address" autocomplete="off" required data-parsley-pattern="^[A-Za-z0-9\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ\,]{1,30}$" data-parsley-trigger="keyup" data-parsley-pattern-message="Địa chỉ được phép nhập tối đa 30 kí tự" data-parsley-required-message="Địa chỉ không được phép để trống" style="height: 45px; font-size: 12px">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" placeholder="Nhập số điện thoại" class="form-control" name="phone" autocomplete="off" required data-parsley-pattern="^0[0-9]{9}$" data-parsley-trigger="keyup"
                                    data-parsley-pattern-message="SĐT gồm 10 số và bắt đầu bằng số 0"
                                    data-parsley-required-message="SĐT không được để trống"
                                    style="height: 45px; font-size: 13px">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Lớp</label>
                                    <select name="classes_id" class="select2" required
                                    data-parsley-required-message="Hãy chọn ít nhất 1 lớp học">
                                    <option value disabled="" selected="">Tên lớp</option>
                                    @foreach ($array_classes as $classes)
                                        <option value="{{ $classes->id }}">
                                            {{ $classes->classes_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>E-Mail</label>
                                <input type="email" placeholder="Nhập E-Mail" class="form-control" name="email" autocomplete="off" required data-parsley-pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$"
                                data-parsley-trigger="keyup"
                                data-parsley-pattern-message="E-Mail không đúng định dạng"
                                data-parsley-required-message="E-Mail không được để trống"
                                style="height: 45px; font-size: 13px">
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Lưu</button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Đặt lại</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Admit Form Area End Here -->

        </div>
    </div>
    <!-- Page Area End Here -->
</div>

@endsection


@push('scripts')
<script>
    $(document).ready(function(){
        $('#validate_form').parsley();
    });

    $('#select2-gender-d3-container').change(function(){
       if(this.value=='') 
         $('#other_input_id').attr('data-parsley-required',false);
       else  
         $('#other_input_id').attr('data-parsley-required',true);
    });
</script>

<script>
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
</script>
@endpush