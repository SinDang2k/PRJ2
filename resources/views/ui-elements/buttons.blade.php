@extends('layouts.master')
@section('master')
@section('title', 'Button')
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
        <h3>Giao diện</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">Trang chủ</a>
            </li>
            <li>Nút</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Button Area Start Here -->
    <div class="card" style="height:auto !important">
        <div class="card-body">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Filled Button</h3>
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
            <div class="ui-btn-wrap">
                <ul>
                    <li><button type="button" class="btn-fill-md text-light bg-dodger-blue">Primary</button></li>
                    <li><button type="button" class="btn-fill-md text-light bg-mauvelous">Secondary</button></li>
                    <li><button type="button" class="btn-fill-md text-light bg-orange-peel">Info</button></li>
                    <li><button type="button" class="btn-fill-md text-light bg-dark-pastel-green">Success</button></li>
                    <li><button type="button" class="btn-fill-xl text-light bg-red">Warning</button></li>
                    <li><button type="button" class="btn-fill-lmd radius-4 text-light bg-true-v">Awesome</button></li>
                    <li><button type="button" class="btn-fill-lmd radius-4 text-light bg-violet-blue">Disabled</button></li>
                    <li><button type="button" class="btn-fill-md radius-4 text-light bg-light-sea-green">Reload</button></li>
                    <li><button type="button" class="btn-fill-md radius-4 text-light bg-martini">Stories</button></li>
                    <li><button type="button" class="btn-fill-sm radius-4 text-light bg-yellow">Sure</button></li>
                    <li><button type="button" class="btn-fill-md radius-4 text-light bg-orange-red">Close</button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="height:auto !important">
        <div class="card-body">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Outline Button</h3>
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
            <div class="ui-btn-wrap">
                <ul>
                    <li><button type="button" class="btn-fill-md text-dodger-blue border-dodger-blue">Primary</button></li>
                    <li><button type="button" class="btn-fill-md text-mauvelous border-mauvelous">Secondary</button></li>
                    <li><button type="button" class="btn-fill-md text-orange-peel border-orange-peel">Info</button></li>
                    <li><button type="button" class="btn-fill-md text-dark-pastel-green border-dark-pastel-green">Success</button></li>
                    <li><button type="button" class="btn-fill-xl text-red border-red">Warning</button></li>
                    <li><button type="button" class="btn-fill-lmd radius-4 text-true-v border-true-v">Awesome</button></li>
                    <li><button type="button" class="btn-fill-lmd radius-4 text-violet-blue border-violet-blue">Disabled</button></li>
                    <li><button type="button" class="btn-fill-md radius-4 text-light-sea-green border-light-sea-green">Reload</button></li>
                    <li><button type="button" class="btn-fill-md radius-4 text-martini border-martini">Stories</button></li>
                    <li><button type="button" class="btn-fill-sm radius-4 text-yellow border-yellow">Sure</button></li>
                    <li><button type="button" class="btn-fill-md radius-4 text-orange-red border-orange-red">Close</button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="height:auto !important">
        <div class="card-body">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Shadow Button</h3>
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
            <div class="ui-btn-wrap">
                <ul>
                    <li><button type="button" class="btn-fill-lmd radius-30 text-light shadow-dodger-blue bg-dodger-blue">Primary</button></li>
                    <li><button type="button" class="btn-fill-lmd radius-30 text-light shadow-dark-pastel-green bg-dark-pastel-green">Success</button></li>
                    <li><button type="button" class="btn-fill-lmd radius-30 text-light shadow-true-v bg-true-v">Awesome</button></li>
                    <li><button type="button" class="btn-fill-lmd radius-30 text-light shadow-red bg-red">Warning</button></li>
                    <li><button type="button" class="btn-fill-md radius-30 text-light bg-martini shadow-martini">Stories</button></li>
                    <li><button type="button" class="btn-fill-xl radius-30 text-light shadow-violet-blue bg-violet-blue">Disabled</button></li>
                    <li><button type="button" class="btn-fill-xl radius-30 text-light shadow-light-sea-green bg-light-sea-green">Reload</button></li>
                    <li><button type="button" class="btn-fill-xl radius-30 text-light shadow-orange-peel bg-orange-peel">Info</button></li>
                    <li><button type="button" class="btn-fill-xl radius-30 text-light shadow-orange-red bg-orange-red">Close</button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="height:auto !important">
        <div class="card-body">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Gradient Button</h3>
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
            <div class="ui-btn-wrap">
                <ul>
                    <li><button type="button" class="btn-fill-lmd text-light gradient-dodger-blue">Primary</button></li>
                    <li><button type="button" class="btn-fill-lg font-normal no-radius text-light gradient-orange-peel">Awesome</button></li>
                    <li><button type="button" class="btn-fill-lmd text-light bg-gradient-gplus">Warning</button></li>
                    <li><button type="button" class="btn-fill-lg font-normal no-radius text-light gradient-pastel-green">Success</button></li>
                    <li><button type="button" class="btn-fill-lg font-normal text-light btn-gradient-yellow">Info</button></li>
                    <li><button type="button" class="btn-fill-lg font-normal text-light gradient-orange-peel">Awesome</button></li>
                    <li><button type="button" class="btn-fill-lmd text-light radius-4 bg-gradient-gplus">Warning</button></li>
                    <li><button type="button" class="btn-fill-lg font-normal text-light gradient-pastel-green">Success</button></li>
                    <li><button type="button" class="btn-fill-lg font-normal radius-4 text-light btn-gradient-yellow">Info</button></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="height:auto !important">
        <div class="card-body">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Icon Button</h3>
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
            <div class="ui-btn-wrap">
                <ul>
                    <li><button type="button" class="btn-fill-lmd radius-30 text-light bg-dodger-blue">Primary<i class="fas fa-caret-down mg-l-10"></i></button></li>
                    <li><button type="button" class="btn-fill-lmd radius-30 text-light bg-violet-blue">Select Area<i class="fas fa-caret-down mg-l-10"></i></button></li>
                    <li><button type="button" class="btn-fill-md radius-30 text-light bg-dark-pastel-green">Success<i class="fas fa-check mg-l-15"></i></button></li>
                    <li><button type="button" class="btn-fill-lmd radius-30 text-light bg-true-v">Upload Image<i class="fas fa-cloud-upload-alt mg-l-10"></i></button></li>
                    <li><button type="button" class="btn-fill-md radius-30 text-light bg-red">Warning<i class="fas fa-exclamation-circle mg-l-10"></i></button></li>
                    <li><button type="button" class="btn-fill-md radius-30 text-light bg-orange-peel">Settings<i class="fas fa-cog mg-l-10"></i></button></li>
                    <li><button type="button" class="btn-fill-md radius-30 text-light bg-light-sea-green">Calender<i class="fas fa-calendar-alt mg-l-10"></i></button></li>
                    <li><button type="button" class="btn-fill-md radius-30 text-light bg-martini">Web Link<i class="fas fa-link mg-l-10"></i></button></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Button Area End Here -->
    <footer class="footer-wrap-layout1">
        <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
    </footer>
</div>
</div>
<!-- Page Area End Here -->
</div>
@endsection
