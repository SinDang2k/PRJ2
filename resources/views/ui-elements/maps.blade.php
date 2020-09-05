@extends('layouts.master')
@section('master')
@section('title', 'Map')
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
            <h3>Google Map</h3>
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}">Trang chủ</a>
                </li>
                <li>Map</li>
            </ul>
        </div>
        <!-- Breadcubs Area End Here -->
        <!-- Google Map Area Start Here -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card google-map-area">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Marker Map</h3>
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
                        <div class="default-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7388033783386!2d105.84517151476275!3d21.00310478601222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac7438144741%3A0x8533f852a77bda2c!2zTmfDtSAxNyBU4bqhIFF1YW5nIELhu611LCBCw6FjaCBLaG9hLCBIYWkgQsOgIFRyxrBuZywgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1598284620444!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Google Map Area End Here -->
        <footer class="footer-wrap-layout1">
            <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
        </footer>
    </div>
</div>
<!-- Page Area End Here -->
</div>
@endsection