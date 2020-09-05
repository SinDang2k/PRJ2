@extends('layouts.theme_ui_student.master')
@section('title', 'Thông tin chi tiết Sinh Viên')
@section('ui-student')
<div id="wrapper">
    @include('layouts.theme_ui_student.navbar')

    <section class="section lb p120">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tagline-message page-title text-center">
                        <h3>Điểm sinh viên theo môn</h3>
                        <ul class="breadcrumb">
                            <li class="active">AKKHOR</li>
                            <li><a href="{{ route('student.dashboard') }}">Home</a></li>
                        </ul>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end section -->

    <section class="section gb nopadtop">
        <div class="container">
            <div class="boxed boxedp4">
                <div class="shop-top" style="padding:0px">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h3>Chi tiết điểm Sinh Viên</h3>
                        </div>
                    </div>
                </div>
    
                <div class="panel panel-primary" id="data_record" style="display: block">
                    <div class="panel-healding">
                        <h2 class="text-center">Bảng điểm</h2>
                    </div>
                    <div class="panel-body"> 
                        <table class="table table-bordered" >
                            <thead>
                                <th>Môn</th>
                                <th>Điểm lý thuyết</th>
                                <th>Điểm thực hành</th>
                            </thead>
                            <tbody>
                                @foreach ($arr as $point)
                                    <tr>
                                        <td>
                                            {{ $point->ten_mon }}
                                        </td>
                                        <td>
                                            {{ $point->diem_ly_thuyet }}
                                        </td>
                                        <td>
                                            {{ $point->diem_thuc_hanh }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- end container -->
    </section>

    @include('layouts.theme_ui_student.footer')
</div><!-- end wrapper -->
@endsection
