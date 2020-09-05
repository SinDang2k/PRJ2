@extends('layouts.master')
@section('title', 'Student')
@section('master')
@include('sweetalert::alert')
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
                    <li>Danh sách sinh viên</li>
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
            <!-- Student Table Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <div align="right" style="margin-bottom: 15px">
                            @if (Auth::guard('admin')->check())
                            <a href="{{ route('student.view_insert') }}" class="btn btn-success btn-sm"
                                style="width: 85px; outline: none;"><i class="fas fa-plus"
                                    style="margin-right: 2px"></i>Thêm mới</a>
                            @else

                            @endif
                        </div>
                        <form action="{{ route('student.del') }}" method="post">
                            @csrf
                            <table class="table table-striped table-bordered" id="student_tables">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;"><input type="checkbox" name="select-all" id="select-all"></th>
                                        <th style="vertical-align: middle;">STT</th>
                                        <th style="vertical-align: middle;">Tên sinh viên</th>
                                        <th style="width: 60px; vertical-align: middle;">Giới tính</th>
                                        <th style="vertical-align: middle;">Lớp</th>
                                        <th style="vertical-align: middle;">Địa chỉ</th>
                                        <th style="width: 72px;vertical-align: middle;">Ngày sinh</th>
                                        <th style="vertical-align: middle;">Số điện thoại</th>
                                        <th style="vertical-align: middle;">E-mail</th>
                                        <th style="width: 47px;vertical-align: middle;">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-danger" id="delSelect" style="display: none">Delete
                                Selected</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="confirmModal" class="modal fade" role="dialog">
                <div class="modal-dialog" style="width: 585px !important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 class="modal-title" style="line-height: 1.1">꧁Xác☠nhận꧂</h2>
                        </div>
                        <div class="modal-body">
                            <h4 align="center" style="margin:0;">Bạn có chắc chắn muốn xóa dữ liệu này?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Đồng ý</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-wide" id="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" style="width: 1100px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Xem thông tin Sinh Viên</h4>
                        </div>
                        <div class="modal-promobody">
                            <div class="row ng-scope" ng-app="seat" ng-controller="layout">
                                <div class="col-md-12">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"></h3>
                                            <div class="box-tools pull-right">

                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-3"><strong>Mã: </strong></div>
                                                    <div class="col-md-3">
                                                        <h5 id="id" style="margin-top: 5px"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3"><strong>Tên: </strong></div>
                                                    <div class="col-md-3">
                                                        <h5 id="student_name" style="margin-top: 5px; width: 170px">
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3"><strong>E-Mail: </strong></div>
                                                    <div class="col-md-3">
                                                        <h5 id="email" style="margin-top: 5px"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3"><strong>Ngày sinh: </strong></div>
                                                    <div class="col-md-3">
                                                        <h5 id="birthday" style="margin-top: 5px"></h5>
                                                    </div>
                                                </div>
                                            </div><!-- /.box-body -->
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-3"><strong>Số điện thoại</strong></div>
                                                    <div class="col-md-3">
                                                        <h5 id="phone" style="margin-top: 5px"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3"><strong>Địa chỉ:</strong></div>
                                                    <div class="col-md-3">
                                                        <h5 id="address" style="margin-top: 5px"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3"><strong>Giới tính:</strong></div>
                                                    <div class="col-md-3">
                                                        <h5 id="gender" style="margin-top: 5px"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3"><strong>Lớp:</strong></div>
                                                    <div class="col-md-3">
                                                        <h5 id="classes_id" style="margin-top: 5px"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box -->
                                </div>
                            </div>
                        </div>
                        <div class="business_info">
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="students_id" id="students_id" value="" />
                            <input type="hidden" name="button_action" id="button_action" value="" />
                            {{-- <input type="submit" name="submit" id="action" value="" class="btn btn-info" /> --}}
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
                                style="float: right !important; outline: none;">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Student Table Area End Here -->
            @include('layouts.footer')
        </div>
    </div>
    <!-- Page Area End Here -->
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#student_tables').DataTable({
            "processing": true,
            "serverSide": true,
            "oLanguage":{
                "sSearch": '<i class="fas fa-search"></i>',
                "sZeroRecords": "Không có dữ liệu nào trong bảng",
                "sLengthMenu": 'Hiển thị <select>'+
                '<option value="10">10</option>'+
                '<option value="20">20</option>'+
                '<option value="30">30</option>'+
                '<option value="40">40</option>'+
                '<option value="50">50</option>'+
                '<option value="-1">Tất cả</option>'+
                '</select> bản ghi',
                "sInfo": "Hiển thị _START_ đến _END_ trong tổng số bản ghi là _TOTAL_",
                "sProcessing": 'Loading <i class="fas fa-spinner" style="transition: 2s;"></i>',

                "oPaginate":{
                    "sNext": "Trang sau",
                    "sPrevious": "Trang trước",
                }
            },
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 1, 2, 3, 4, 5, 7, 8 ]
                    },
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                }, 
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 1, 2, 3, 4, 5, 7, 8 ]
                    },
                    text: '<i class="fas fa-file-excel"></i> Excel',
                }, 
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 1, 2, 3, 4, 5, 7, 8 ]
                    },
                    text: '<i class="fas fa-print"></i> Print',
                }
            ],
            ajax: '{!! route('student.view_all') !!}',
            columns: [
            { data: 'id',
            'orderable':false,
            'render': function (data, type, full, meta){
               return '<input type="checkbox" name="delid[]" value="' + data + '">';
           }
       },
       { data: 'DT_RowIndex' },
       { data: 'student_name' },
       { data: 'gender' },
       { data: 'class_name' },
       { data: 'address' },
       { data: 'birthday' },
       { data: 'phone' },
       { data: 'email' },
       {
        data: 'action', name: 'action',
        orderable: true,
        searchable: true,
    },
    ]
});

        var student_id;

        $(document).on('click', '.delete', function(){
            student_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"student/delete/"+student_id,
                beforeSend:function(){
                    $('#ok_button').text('Deleting...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#student_tables').DataTable().ajax.reload();
                        swal("Xoá dữ liệu thành công!", "", "success")
                    }, 2000);
                }
            })
        });

        $(document).on('click', '.shows', function(){
          var id = $(this).attr("id");
          $('#show').modal('show');
          $.ajax({
            url:"{{route('student.show')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(response)
            {
              console.log(response)

              $('h5#id').text(response.id);
              $('h5#student_name').text(response.student_name);
              $('h5#email').text(response.email);
              $('h5#birthday').text(response.birthday);
              $('h5#phone').text(response.phone);
              $('h5#address').text(response.address);
              if(response.gender == 1){
                $('h5#gender').html(`Nam`);
              }else{
                $('h5#gender').html(`Nữ`);
              }
              $('h5#classes_id').text(response.classes_id);
              $('#students_id').val(id);
              $('#action').val('Show');
              $('.modal-title').text('Xem thông tin Sinh Viên');
              $('#button_action').val('show');
          }
      })
      });

        $('#select-all').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    document.getElementById("delSelect").style.display = "block";
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    document.getElementById("delSelect").style.display = "none";
                    this.checked = false;
                });
            }
        });

        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    });
</script>
@endpush
