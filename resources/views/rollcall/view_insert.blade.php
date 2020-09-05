@extends('layouts.master')
@section('title', 'Roll Call')
@section('master')
<style>
    .xanh {
        color: #00a1ff;
    }

    .do {
        color: red;
    }

    .vang {
        color: #df982c;
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
                <h3>Điểm danh</h3>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Điêm danh</li>
                </ul>
            </div>
            <span>
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
                @endif

                @if (session('warning'))
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                </div>
                @endif
            </span>
            <div class="row">
                <div class="col-12" style="min-height: 547px">
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Điểm danh</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">...</a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <form class="new-added-form" action="{{ route('teacher.rollcall.process_insert') }}"
                                method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Lớp</label>
                                        <select name="class" id="class" class="select2">
                                            <option selected='' disabled="" value="">Chọn Lớp</option>
                                            @foreach ($classes as $class)
                                            <option value="{{ $class->classes_id }}">
                                                {{ $class->full_class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Môn</label>
                                        <select name="subject" id="subject" class="select2">
                                            <option selected='' disabled=''>Chọn Lớp</option>
                                        </select>
                                    </div>
                                    <div style="display:none" class="table-responsive">
                                        <table class="table display text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Họ và tên</th>
                                                    <th>Tình trạng</th>
                                                </tr>
                                            </thead>
                                            <tbody id="form-data">
                                            </tbody>
                                        </table>
                                        <div class="col-12 form-group mg-t-8">
                                            <select id="times" name="rollcall_id" class="select2">
                                                <option selected='' disabled=''>Chọn thời gian</option>
                                            </select>
                                            <div style="margin-top:20px">
                                                <button type="submit"
                                                    class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Area End Here -->
</div>

@endsection
@push('scripts')
<script>
    var nghi='';
    var muon='';
    $(document).ready(function () {
        $('#class').change(function () {
            if($('#subject').val())
            {
                getStudent($(this).val(),$('#subject').val());
            }
            $.ajax({
                type: "GET",
                url: "{{route('teacher.rollcall.get_subject')}}",
                data:{
                    class_id:$(this).val(),
                },
                dataType: "JSON",
                success: function (response) {
                    $("#subject").empty();
                    $("#subject").append(`<option selected='' disabled=''>Chọn Lớp</option>`)
                    $.each(response, function (i, item) {
                        $("#subject").append(`<option value="`+item.subject.id+`">`+item.subject.subject_name+`</option>`);
                    });
                }
            });
        });

        $('#subject').change(function () {
            if($('#class').val())
            {
                getStudent($('#class').val(),$(this).val());
            }
        });

        function getStudent(classes,subject) {
            $.ajax({
                type: "GET",
                url: "{{route('teacher.rollcall.get_student')}}",
                data: {
                    class:classes,
                    subject:subject,
                },
                dataType: "JSON",
                success: function (response) {
                    $(".table-responsive").css("display","block");
                    $("#form-data").empty();
                    let mau='xanh';
                    $("#times").empty();
                    $("#times").append(`<option selected='' disabled=''>Chọn thời gian</option>`);
                    $.each(response[0], function (i, item) {
                        if(item.dem>=0)
                        {
                            let phan_tram_nghi=(item.dem/response[1][0].sessions*100).toFixed(3);
                            if(item.dem>=1)
                            {
                                if(phan_tram_nghi>=8 && phan_tram_nghi <=18){
                                    mau='vang';
                                }
                                else if(phan_tram_nghi>18 && item.dem>=1){
                                    mau='do';
                                    nghi='checked';
                                    muon='';
                                }
                            }
                            if(response[3])
                            {
                                if(response[3][i].status==2)
                                {
                                    muon='checked';
                                }
                                else if(response[3][i].status==0)
                                {
                                    nghi='checked';
                                }
                                else{
                                    nghi='';
                                    muon='';
                                }
                            }
                            $("#form-data").append(`<tr>
                                                    <td class='`+mau+`'>`+item.student_name+` (`+item.birthday+`)<br>`+item.dem+`/`+response[1][0].sessions+`</td>
                                                    <td>
                                                        <input type="radio" name="`+item.student_id+`" id="di`+i+`" value="1" checked>
                                                        <label for="di`+i+`">
                                                            Đi học
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="`+item.student_id+`" id="nghi`+i+`" value="0" `+nghi+`>
                                                        <label for="nghi`+i+`">
                                                            Nghỉ học
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="`+item.student_id+`" id="muon`+i+`" value="2" `+muon+`>
                                                        <label for="muon`+i+`">
                                                            Muộn học
                                                        </label>
                                                    </td>
                                                </tr>`);
                            mau='xanh';
                            nghi=''
                            muon='';
                        }
                        else{
                            $("#form-data").append(`<tr>
                                                    <td class='xanh'>`+item.student_name+` (`+item.birthday+`)<br>0/`+response[1][0].sessions+`</td>
                                                    <td>
                                                        <input type="radio" name="`+item.id+`" id="di`+i+`" value="1" checked>
                                                        <label for="di`+i+`">
                                                            Đi học
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="`+item.id+`" id="nghi`+i+`" value="0">
                                                        <label for="nghi`+i+`">
                                                            Nghỉ học
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="`+item.id+`" id="muon`+i+`" value="2">
                                                        <label for="muon`+i+`">
                                                            Muộn học
                                                        </label>
                                                    </td>
                                                </tr>`);
                        }

                    });

                    $.each(response[2], function () {
                        $('#times').append(`<option value='`+$(this)[0].id+`'>Update ngày `+$(this)[0].khoi_tao+`</option>`);
                    });
                    $('#times').append(`<option value='-1'>Thêm mới hiện tại</option>`);
                }
            });
        }
    });
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
</script>
@endpush
