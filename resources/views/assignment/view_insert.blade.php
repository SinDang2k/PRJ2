@extends('layouts.master')
@section('title', 'Add Assignment')
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
                <h3>Phân công</h3>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('assignment.view_all') }}">Danh sách lịch phân công</a>
                    </li>
                    <li>Thêm lịch phân công</li>
                </ul>
                <span>

                </span>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Admit Form Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                   {{--  <div class="heading-layout1">
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
                    </div> --}}
                    <form id="validate_form" enctype="multipart/form-data"
                        action="{{ route('assignment.process_insert') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Khóa</label>
                                <select id="course" class="select2" required>
                                    <option value="" disabled="" selected="">Chọn Khóa</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Ngành</label>
                                <select id="department" class="select2" required>
                                    <option value="" disabled="" selected="">Chọn Ngành</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Giáo Viên</label>
                                <select id="teacher" name="teacher_id" class="select2" required>
                                    <option value="" disabled="" selected="">Chọn Giáo Viên</option>
                                    @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">
                                        {{ $teacher->teacher_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Môn</label>
                                <select id="subject" name="subject_id" class="select2" required>
                                    <option value="" disabled="" selected="">Chọn giáo viên trước</option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Lớp</label>
                                <select multiple="multiple" name="classes[]" class="form-control controlWidth"
                                    id="classes" required data-parsley-required-message="Hãy chọn ít nhất 1 môn học">
                                    <option value="" disabled="" selected="">Chọn khóa và ngành trước</option>
                                </select>
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

        $('#classes').multiselect({
            includeSelectAllOption: true,
            buttonWidth: 250,
            enableFiltering: true
        });

        $('#teacher').change(function () {
            $.ajax({
                type: "GET",
                url: "{{route('assignment.get_subject')}}",
                data: {
                    teacher_id:$(this).val(),
                },
                dataType: "JSON",
                success: function (response) {
                    $('#subject').empty();
                    $('#subject').append("<option disabled='' selected>Chọn Môn</option>")
                    $.each(response, function (i, item) {
                        $('#subject').append("<option value='"+item.subject[0].id+"'>"+item.subject[0].subject_name+"</option>");
                    });
                }
            });
        });
        $('#department').change(function () {
            if($('#course').val()&&$('#department').val()&&$('#teacher').val()&&$('#subject').val())
            {
                getClass();
            }
        });

        $('#course').change(function () {
            if($('#course').val()&&$('#department').val()&&$('#teacher').val()&&$('#subject').val())
            {
                getClass();
            }
        });

        $('#subject').change(function () {
            if($('#course').val()&&$('#department').val()&&$('#teacher').val()&&$('#subject').val())
            {
                getClass();
            }
        });

        $('#teacher').change(function () {
            if($('#course').val()&&$('#department').val()&&$('#teacher').val()&&$('#subject').val())
            {
                getClass();
            }
        });

        function getClass()
        {
            $('#classes').multiselect('rebuild');
            $.ajax({
                type: "GET",
                url: "{{route('assignment.get_classes')}}",
                data: {
                    course_id:$('#course').val(),
                    department_id:$('#department').val(),
                    teacher_id:$('#teacher').val(),
                    subject_id:$('#subject').val(),
                },
                dataType: "JSON",
                success: function (response) {
                    $('#classes').empty();
                    $.each(response, function (i, item) {
                        $('#classes').append("<option value='"+item.id+"'>"+item.class_name+"</option>");
                    });
                    $('#classes').multiselect('rebuild');
                    $('#classes').multiselect('refresh');
                }
            });
        }
    });
</script>
@endpush
