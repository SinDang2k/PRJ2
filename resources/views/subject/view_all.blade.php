@extends('layouts.master')
@section('title', 'Subject')
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
                <h3>Môn học</h3>
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang chủ</a>
                    </li>
                    <li>Danh sách môn học</li>
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
            <!-- Class Table Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <div align="right" style="margin-bottom: 15px">
                            <a href="{{ route('subject.view_insert') }}" class="btn btn-success btn-sm"
                                style="width: 85px; outline: none;"><i class="fas fa-plus"
                                    style="margin-right: 2px"></i>Thêm mới</a>
                        </div>
                        <form action="{{ route('subject.del') }}" method="post">
                            @csrf
                            <table class="table table-striped table-bordered" id="subject_tables">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="select-all" id="select-all"></th>
                                        <th>STT</th>
                                        <th>Tên môn</th>
                                        <th>Ngành học </th>
                                        <th>Số buổi học</th>
                                        <th>Tác vụ</th>
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
            <!-- Class Table Area End Here -->
            @include('layouts.footer')
        </div>
    </div>
    <!-- Page Area End Here -->
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#subject_tables').DataTable({
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
            // dom: 'Blfrtip',
            // buttons: [
            //     'csv', 'excel'
            // ],
            ajax: '{!! route('subject.view_all') !!}',
            columns: [
            { data: 'subject.id',
                'orderable':false,
                'render': function (data, type, full, meta){
                     return '<input type="checkbox" name="delid[]" value="' + data + '">';
                }
            },
            { data: 'DT_RowIndex' },
            { data: 'subject.subject_name' },
            { data: 'department.department_name' },
            { data: 'subject.sessions' },
            {
                data: 'action', name: 'action',
                orderable: true,
                searchable: true,
            },
            ]
        });

        var subject_id;

        $(document).on('click', '.delete', function(){
            subject_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url:"subject/delete/"+subject_id,
                beforeSend:function(){
                    $('#ok_button').text('Deleting...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#subject_tables').DataTable().ajax.reload();
                        swal("Xoá dữ liệu thành công!", "", "success")
                    }, 2000);
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
