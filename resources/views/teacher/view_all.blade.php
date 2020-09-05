@extends('layouts.master')
@section('title', 'Teacher')
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
                <h3>Giáo Viên</h3>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang chủ</a>
                    </li>
                    <li>Danh sách giáo viên</li>
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
                        <a href="{{ route('teacher.view_insert') }}" class="btn btn-success btn-sm"
                        style="width: 85px; outline: none;"><i class="fas fa-plus"
                        style="margin-right: 2px"></i>Thêm mới</a>
                    </div>
                    <form action="{{ route('teacher.del') }}" method="post">
                        @csrf
                        <table class="table table-striped table-bordered" id="teacher_tables">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select-all" id="select-all"></th>
                                    <th style="vertical-align: middle;">STT</th>
                                    <th style="vertical-align: middle; width: 50px !important">Ảnh</th>
                                    <th style="vertical-align: middle; width: 97px !important">Tên giáo viên</th>
                                    <th style="vertical-align: middle; width: 60px !important">Giới tính</th>
                                    <th style="vertical-align: middle; width: 50px !important">Địa chỉ</th>
                                    <th style="vertical-align: middle; width: 72px !important">Ngày sinh</th>
                                    <th style="vertical-align: middle; width: 95px !important">Số điện thoại</th>
                                    <th style="vertical-align: middle; ">E-mail</th>
                                    <th style="vertical-align: middle; ">Tình trạng</th>
                                    <th style="vertical-align: middle; width: 47px !important">Tác vụ</th>
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
            <div class="modal-dialog">
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

        <div class="modal fade modal-wide" id="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 1100px">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Xem thông tin Giáo Viên</h4>
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
                              <div class="col-md-3"><h5 id="id" style="margin-top: 5px"></h5></div>
                          </div>
                          <div class="row">
                              <div class="col-md-3"><strong>Hình ảnh: </strong></div>
                              <div class="col-md-3"><h5 id="images" style="margin-top: 5px; width: 128px"></h5></div>
                          </div>
                          <div class="row">
                              <div class="col-md-3"><strong>Tên: </strong></div>
                              <div class="col-md-3"><h5 id="teacher_name" style="margin-top: 5px; width: 205px"></h5></div>
                          </div>
                          <div class="row">
                              <div class="col-md-3"><strong>Ngày sinh: </strong></div>
                              <div class="col-md-3"><h5 id="birthday" style="margin-top: 5px"></h5></div>
                          </div>
                      </div><!-- /.box-body -->
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-3"><strong>Số điện thoại:</strong></div>
                          <div class="col-md-3"><h5 id="phone" style="margin-top: 5px"></h5></div>
                      </div>
                      <div class="row">
                          <div class="col-md-3"><strong>Địa chỉ:</strong></div>
                          <div class="col-md-3"><h5 id="address" style="margin-top: 5px"></h5></div>
                      </div>
                      <div class="row">
                          <div class="col-md-3"><strong>Giới tính:</strong></div>
                          <div class="col-md-3"><h5 id="gender" style="margin-top: 5px"></h5></div>
                      </div>
                      <div class="row">
                          <div class="col-md-3"><strong>E-Mail:</strong></div>
                          <div class="col-md-3"><h5 id="email" style="margin-top: 5px"></h5></div>
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
  <input type="hidden" name="teacher_id" id="teacher_id" value="" />
  <input type="hidden" name="button_action" id="button_action" value="" />
  {{-- <input type="submit" name="submit" id="action" value="" class="btn btn-info" /> --}}
  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="float: right !important; outline: none;">Close</button>
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
        $('#teacher_tables').DataTable({
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
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    },
                    text: '<i class="fas fa-print"></i> Print',
                },
            ],
            ajax: '{!! route('teacher.view_all') !!}',
            columns: [
            { data: 'id',
            'orderable':false,
            'render': function (data, type, full, meta){
             return '<input type="checkbox" name="delid[]" value="' + data + '">';
         }
     },
     { data: 'DT_RowIndex' },
     { data: 'images',
     "render": function (data) {
        return '<img src="'+data+'" alt="error" style="width:60px; height:50px">';
    }
},
{ data: 'teacher_name' },
{ data: 'gender',
"render": function(data, type, row) {
    if(data == 1){
        return 'Nam';
    }else{
        return 'Nữ';
    }
}
},
{ data: 'address' },
{ data: 'birthday' },
{ data: 'phone' },
{ data: 'email' },
{ data: 'status',
"render": function(data) {
    if(data == 1){
        return 'Khóa';
    }else{
        return 'Mở';
    }
}
},
{
    data: 'action', name: 'action',
    orderable: false,
    searchable: false,
},
]
});

        var teacher_id;

        $(document).on('click', '.delete', function(){
            teacher_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"teacher/delete/"+teacher_id,
                beforeSend:function(){
                    $('#ok_button').text('Deleting...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#teacher_tables').DataTable().ajax.reload();
                        swal("Xoá dữ liệu thành công!", "", "success")
                    }, 2000);
                }
            })
        });

        $(document).on('click', '.shows', function(){
          var id = $(this).attr("id");
          $('#show').modal('show');
          $.ajax({
            url:"{{route('teacher.show')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(response)
            {
              console.log(response)

              $('h5#id').text(response.id);
              $('h5#images').html(`
                  <img src="${response.images}" width="50px" alt="error">
                  `)
              $('h5#teacher_name').text(response.teacher_name);
              $('h5#birthday').text(response.birthday);
              $('h5#phone').text(response.phone);
              $('h5#address').text(response.address);
              if(response.gender == 1){
                $('h5#gender').html(`Nam`);
            }else{
                $('h5#gender').html(`Nữ`);
            }
            $('h5#email').text(response.email);
            $('#teacher_id').val(id);
            $('#action').val('Show');
            $('.modal-title').text('Xem thông tin Giáo Viên');
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
