@extends('layouts.master')
@section('title', 'Add Assignment')
@section('master')
<style>
    th{
        font-size:13px
    }
</style>
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
                <h3>Lịch sử điểm danh</h3>
                <ul>
                    <li>
                        <a href="">Home</a>
                    </li>
                    <li>Lịch sử điểm danh</li>
                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <div class="row">
                <!-- Student Attendence Search Area Start Here -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Lịch sử điểm danh</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-expanded="false">...</a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <form class="new-added-form">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Lớp</label>
                                        <select id="class" class="select2">
                                            <option value="" disabled="" selected="">Chọn lớp</option>
                                            @if (Auth::guard('admin')->check())
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->full_name_class }}</option>
                                                @endforeach
                                            @elseif(Auth::guard('teacher')->check())
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->class->id }}">{{ $class->class->full_name_class }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Môn</label>
                                        <select id="subject" class="select2">
                                            <option disabled="" selected="">Chọn môn trước</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <h1 id="k_co" style="display: none;margin:auto">Chưa có lịch sử điểm danh</h1>
                <div class="col-12" id="data" style="display: none">
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3 id="title"></h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-expanded="false">...</a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table bs-table table-striped table-bordered text-nowrap">
                                    <thead>
                                        <tr id="date">
                                        </tr>
                                    </thead>
                                    <tbody id="students">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Student Attendence Area End Here -->
            <footer class="footer-wrap-layout1">
                <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
            </footer>
        </div>
    </div>
    <!-- Page Area End Here -->
</div>
@endsection
@push('scripts')
<script>
    @if(Auth::guard('admin')->check())
    var url_get_subject='{{route('rollcall.get_subject_by_class')}}';
    var url_get_student='{{route('rollcall.get_student_attendance_history')}}';
    @elseif(Auth::guard('teacher')->check())
    var url_get_subject='{{route('rollcall.get_subject_by_class_for_teacher')}}';
    var url_get_student='{{route('rollcall.get_student_attendance_history_for_teacher')}}';
    @endif
    $(document).ready(function () {
        $("#class").change(function () {
            $.ajax({
                type: "GET",
                url: url_get_subject,
                data: {
                    class_id:$(this).val()
                },
                dataType: "JSON",
                success: function (response) {
                    $("#subject").empty();
                    $("#subject").append(`<option disabled="" selected="">Chọn Môn</option>`);
                    $.each(response, function () {
                        $("#subject").append(`
                            <option value="`+$(this)[0].subject_id+`">`+$(this)[0].subject_name+`</option>
                        `);
                    });
                }
            });
        });

        $("#subject").change(function () {
            $.ajax({
                type: "GET",
                url: url_get_student,
                data: {
                    subject_id:$(this).val(),
                    class_id:$("#class").val(),
                },
                dataType: "JSON",
                success: function (response) {
                    if(response.length>0)
                    {
                        $("#date").empty();
                        $("#students").empty();
                        $("#title").empty();
                        $("#data").css("display", "block");
                        $.each($("#class").children(), function () {
                            if($(this)[0].selected==true)
                            {
                                let class_name=$(this)[0].text;
                                $.each($("#subject").children(),function () {
                                    if($(this)[0].selected==true)
                                    {
                                        $("#title").append(`
                                            Danh sách điểm danh môn `+$(this)[0].text+` của lớp `+class_name+`
                                        `);
                                    }
                                });
                            }
                        });

                        $("#date").append(`<th class="text-left">Students</th>`);
                        $.each(response, function () {
                            var d=new Date($(this)[0].created_at);
                            var date=d.getDate();
                            var month=d.getMonth()+1;
                            var year=d.getFullYear();
                            $("#date").append(`<th>`+date+'/'+month+'/'+year+`</th>`);
                        });
                        $("#date").append(`<th>Tổng kết</th>`);
                        for(var i=0;i<response[0].rollcall_detail.length;i++)
                        {
                            var warring=0;
                            var success=0;
                            var danger=0;
                            for (var j=-1;j<response.length;j++)
                            {
                                if(j==-1)
                                {
                                    $("#students").append(`
                                        <tr>
                                            <td class="text-left">`+response[0].rollcall_detail[i].student.student_name+`</td>
                                        </tr>
                                    `);
                                }
                                else{
                                    switch (response[j].rollcall_detail[i].status) {
                                        case 0:
                                            $($("#students").children()[i]).append(`
                                                <td><i title="Nghỉ" class="fas fa-times text-danger"></i></td>
                                            `);
                                            danger++;
                                            break;
                                        case 1:
                                            $($("#students").children()[i]).append(`
                                                <td><i title="Đi học" class="fas fa-check text-success"></i></td>
                                            `);
                                            success++;
                                            break;
                                        case 2:
                                            $($("#students").children()[i]).append(`
                                                <td><i title="Muộn" class="fas fa-exclamation-triangle" style="color:yellow"></i></td>
                                            `);
                                            warring++;
                                            break;
                                    }
                                }
                                if(j==response.length-1)
                                {
                                    $($("#students").children()[i]).append(`
                                        <td>`+success+` <i title="Đi học" class="fas fa-check text-success"></i>
                                        `+warring+` <i title="Muộn" class="fas fa-exclamation-triangle" style="color:yellow"></i>
                                        `+danger+` <i title="Nghỉ" class="fas fa-times text-danger"></i></td>
                                    `);
                                }
                            }
                        }
                    }
                    else{
                        $("#k_co").css('display', 'block');
                        $("#data").css('display', 'none');
                    }
                }
            });
        });
    });
</script>
@endpush
