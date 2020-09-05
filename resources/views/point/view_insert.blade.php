@extends('layouts.master')
@section('title', 'Add Point')
@section('master')
{{-- <style type="text/css">
    input:invalid+span:after {
      content: '✖';
      padding-left: 5px;
    }

    input:valid+span:after {
      content: '✓';
      padding-left: 5px;
}
</style> --}}
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
                <h3>Điểm</h3>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang chủ</a>
                    </li>
                    <li>Thêm điểm</li>
                </ul>
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
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Admit Form Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                             <div class="dropdown" style="right:5px">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('point.view_update') }}"><i class="fas fa-cogs text-dark-pastel-green"></i>Cập nhật điểm</a>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-9 form-group pointcs">
                            <label>Khóa</label>
                            <select id="course" class="select2" required>
                                <option value="" disabled="" selected="">Chọn Khóa</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">
                                        {{ $course->course_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-9 form-group pointcs">
                            <label>Ngành</label>
                            <select id="department" class="select2" required>
                                <option value="" disabled="" selected="">Chọn Ngành</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">
                                        {{ $department->department_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-9 form-group pointcs">
                            <label>Môn</label>
                            <select id="subject" name="subject_id" class="select2" required>
                                <option value="" disabled="" selected="">Chọn Môn</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-9 form-group pointcs">
                            <label>Lớp</label>
                            <select id="classes" name="classes_id" class="select2" required>
                                <option value="" disabled="" selected="">Chọn Khóa, ngành trước</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive" style="display: none;" id="data_record">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sinh viên</th>
                                    <th>Điểm lý thuyết</th>
                                    <th>Điểm thực hành</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        @csrf
                    </div>
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

        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    });

    $('#department').change(function () {
        if($('#course').val()&&$('#department').val()&&$('#subject').val())
        {
            get_classes();
            $('#data_record').attr("style", "display: none !important;");
        }
    });

    $('#course').change(function () {
        if($('#course').val()&&$('#department').val()&&$('#subject').val())
        {
           get_classes();
           $('#data_record').attr("style", "display: none !important;");
       }
   });

    $('#subject').change(function () {
        if($('#course').val()&&$('#department').val()&&$('#subject').val())
        {
           get_classes();
           $('#data_record').attr("style", "display: none !important;");
       }
   });

    function get_classes() {
        $.ajax({
            type: "GET",
            url: "{{route('point.get_classes')}}",
            data: {
                course_id:$('#course').val(),
                department_id:$('#department').val(),
                subject_id:$('#subject').val(),
            },
            dataType: "JSON",
            success: function (response) {
                $('#classes').empty();
                if(response.length==0)
                {
                    $('#classes').append("<option>Chưa có lớp</option>");
                }
                else{
                    $('#classes').append("<option disabled='' selected=''>"+'Chọn Lớp'+"</option")
                    $.each(response, function(i, item) {
                        $('#classes').append("<option value='"+item.id+"'>"+item.class_name+"</option>");
                    });
                }
            }
        });
    }

    jQuery(document).ready(function() {
        jQuery('select[name="classes_id"]').on('change', function(){
            if ($(this).val()) {
                jQuery.ajax({
                  url: '{{ route('point.get_student') }}',
                  type: 'GET',
                  dataType: 'json',
                  data: {
                    classes_id: jQuery('select[name="classes_id"]').val(),
                    subject_id: jQuery('select[name="subject_id"]').val()
                    },
                  success: function(data) {
                    $('#data_record').attr("style", "display: block !important; border-top: 1px solid #ddd; margin-top: 30px;");
                    $('tbody').empty();
                    jQuery.each(data, function() {
                        value_final = '';
                        value_skill = '';
                        for(i = 0; i < this.points.length; i++){
                            if(this.points[i].type_exam==0){
                                value_final = this.points[i].point;
                            }
                            else{
                                value_skill = this.points[i].point;
                            }
                        }
                        $('tbody').append(`
                            <tr>
                            <td data-student_id='${this.id}'>${this.id}</td>
                            <td data-student_id='${this.id}'>${this.student_name}</td>
                            <td>
                            <input class='input_diem' data-student_id='${this.id}' value='${value_final}' data-type='0' type="number" min="0" max="10" required>
                            <span class="validity" display="none"></span>
                            </td>
                            <td>
                            <input class='input_diem' data-student_id='${this.id}' value='${value_skill}' data-type='1' type="number" min="0" max="10" required>
                            <span class="validity"></span>
                            </td>
                            </tr>
                            `);
                    });
                }
            });
            } else {
               $('tbody').empty();
               $('#data_record').attr("style", "display: none !important;");
           }
       });
        jQuery(document).on('change','.input_diem', function(){
            var point = jQuery(this).val();
            var min = 0;
            var max = 10;
            if (point >= min && point <= max) {
                $.ajax({
                    url: '{{ route('point.update') }}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        student_id: $(this).data('student_id'),
                        subject_id:$('#subject').val(),
                        type: $(this).data('type'),
                        point: $(this).val(),
                    },
                }).done(function(){
                    console.log(1);
                });
            } else {
                alert('Hãy nhập đúng điểm đã định dạng');
            }
        });
    });


</script>
@endpush
