@extends('layouts.master')
@section('title', 'Add Teacher')
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
                    <li>Thêm giáo viên</li>
                </ul>
                <span>
                    @if (session('error'))
                    <div class="alert alert-error" role="alert">
                        <i class="fas fa-question"></i> {{ session('error') }}
                    </div>
                    @endif

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
                        <form id="validate_form" enctype="multipart/form-data"
                        action="{{ route('teacher.process_insert') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Tên giáo viên</label>
                                <input type="text" name="teacher_name" id="teacher_name" class="form-control"
                                placeholder="Nhập tên giáo viên" required
                                data-parsley-pattern="^[A-Za-z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ]{1,30}$"
                                data-parsley-trigger="keyup" data-parsley-pattern-message="Tên không quá 30 kí tự"
                                data-parsley-required-message="Tên không được để trống"
                                style="height: 45px; font-size: 13px" autocomplete="off" />
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Giới tính</label>
                                <select class="select2" name="gender" required
                                data-parsley-required-message="Giới tính không được để trống">
                                <option value="" disabled="" selected="">Chọn giới tính</option>
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Ngày sinh</label>
                            <input type="text" class="form-control" name="birthday" id="datepicker"
                            autocomplete="off" placeholder="Nhập ngày sinh" required
                            data-parsley-required-message="Hãy chọn ngày sinh"
                            style="height: 45px; font-size: 13px">
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control"
                            placeholder="Nhập địa chỉ" required
                            data-parsley-pattern="^[A-Za-z\.\,\\\_\-àáâãèéêếìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ\s]{5,50}$"
                            data-parsley-trigger="keyup"
                            data-parsley-pattern-message="Địa chỉ ít nhất là 5 đến 50 kí tự"
                            data-parsley-required-message="Địa chỉ không được để trống"
                            style="height: 45px; font-size: 13px" autocomplete="off" />
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                            placeholder="Nhập số điện thoại" required data-parsley-pattern="^0[0-9]{9}$"
                            data-parsley-trigger="keyup"
                            data-parsley-pattern-message="SĐT gồm 10 số và bắt đầu bằng số 0"
                            data-parsley-required-message="SĐT không được để trống"
                            style="height: 45px; font-size: 13px" autocomplete="off" />
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>E-Mail</label>
                            <input type="text" name="email" id="email" class="form-control"
                            placeholder="Nhập E-Mail" required
                            data-parsley-pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$"
                            data-parsley-trigger="keyup"
                            data-parsley-pattern-message="E-Mail không đúng định dạng"
                            data-parsley-required-message="E-Mail không được để trống"
                            style="height: 45px; font-size: 13px" autocomplete="off" />
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Môn dạy</label>
                            <select multiple="multiple" name="subjects[]" class="form-control controlWidth" id="select_subject" required
                            data-parsley-required-message="Hãy chọn ít nhất 1 môn học">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" id="password" class="form-control"
                        placeholder="Nhập mật khẩu" required
                        data-parsley-pattern="^(?=.*?[a-z])(?=.*?[A-Z])[a-zA-Z0-9]{8,30}$"
                        data-parsley-trigger="keyup"
                        data-parsley-pattern-message="Mật khẩu chưa đủ tiêu chuẩn"
                        data-parsley-required-message="Mật khẩu không được để trống"
                        style="height: 45px; font-size: 13px" autocomplete="off" />
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Ảnh</label>
                        <input type="file" class="form-control-file" name="avatar" required data-parsley-required-message="Hãy chọn tệp ảnh" style="width: 50%">
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
</script>

<script>
    $(document).ready(function() {
        $('#select_subject').multiselect({
            includeSelectAllOption: true,
            buttonWidth: 250,
            enableFiltering: true
        });
    });

    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
</script>
@endpush
