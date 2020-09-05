@extends('layouts.master')
@section('title', 'Add Subject')
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
                <h3>Môn học</h3>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('subject.view_all') }}">Danh sách môn học</a>
                    </li>
                    <li>Thêm môn học</li>
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
                    <form id="validate_form" action="{{ route('subject.process_insert') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Tên môn học</label>
                                <input type="text" name="subject_name" id="subject_name" class="form-control"
                                    placeholder="Nhập tên môn học" required
                                    data-parsley-pattern="^[A-Za-z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ\ +#]{2,20}$"
                                    data-parsley-trigger="keyup"
                                    data-parsley-pattern-message="Tên môn ít nhất có 2 chữ đến 30 chữ"
                                    data-parsley-required-message="Tên môn không được để trống"
                                    style="height: 45px; font-size: 13px" autocomplete="off" />
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Tên ngành</label><br>
                                <select name="department_id[]" multiple="multiple" class="form-control controlWidth"
                                    id="select_department" required
                                    data-parsley-required-message="Hãy chọn ít nhất 1 ngành học">
                                    @foreach ($array_department as $department)
                                    <option value="{{ $department->id }}">
                                        {{ $department->department_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Số buổi học</label>
                                <input type="text" name="sessions" id="subject_name" class="form-control"
                                    placeholder="Nhập số buổi học" required data-parsley-pattern="^[0-9]{1,20}$"
                                    data-parsley-trigger="keyup"
                                    data-parsley-pattern-message="Số buổi phải lớn hơn không"
                                    data-parsley-required-message="Không được để trống buổi học"
                                    style="height: 45px; font-size: 13px" autocomplete="off" />
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
    $(document).ready(function() {
            $('#select_department').multiselect({
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
@endsection
