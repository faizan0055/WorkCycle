<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="Description" content="Boatbrain">
    <meta name="Author" content="Boatbrain">
    <meta name="Keywords" content=""/>
    <title> @yield('title') </title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset(env('ASSET_URL') .'images/logo1.png')}}" type="image/x-icon"/>
    <!-- Icons css -->
    <link href="{{ asset(env('ASSET_URL') .'assets/css/icons.css')}}" rel="stylesheet">
    <!--  Owl-carousel css-->
    <link href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
    <!--  Custom Scroll bar-->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
    <!--  Right-sidemenu css -->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'assets/css/closed-sidemenu.css')}}">
    <!-- Maps css -->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
    <!-- style css -->
    <link href="{{ asset(env('ASSET_URL') .'assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/css/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{ asset(env('ASSET_URL') .'assets/css/skin-modes.css')}}" rel="stylesheet" />
    @yield('style')

</head>

<body class="main-body app sidebar-mini">

<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- Page -->
<div class="page">

    <!-- main-sidebar -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            @if(auth()->user()->type=='admin')
            <a class="desktop-logo logo-light active" href="{{url('/admin')}}"><img src="{{asset('images/logo1.png')}}" class="main-logo" alt="logo"></a>
                <a class="desktop-logo logo-dark active" href="{{url('/admin')}}"><img src="{{asset('images/logo1.png')}}" class="main-logo dark-theme" alt="logo"></a>
                <a class="logo-icon mobile-logo icon-light active" href="{{url('/admin')}}"><img src="{{asset('images/logo1.png')}}" class="logo-icon" alt="logo"></a>
                <a class="logo-icon mobile-logo icon-dark active" href="{{url('/admin')}}"><img src="{{asset('images/logo1.png')}}" class="logo-icon dark-theme" alt="logo"></a>
            @else
            <a class="desktop-logo logo-light active" href="{{url('/client')}}"><img src="{{asset('images/logo1.png')}}" class="main-logo" alt="logo"></a>
                <a class="desktop-logo logo-dark active" href="{{url('/client')}}"><img src="{{asset('images/logo1.png')}}" class="main-logo dark-theme" alt="logo"></a>
                <a class="logo-icon mobile-logo icon-light active" href="{{url('/client')}}"><img src="{{asset('images/logo1.png')}}" class="logo-icon" alt="logo"></a>
                <a class="logo-icon mobile-logo icon-dark active" href="{{url('/client')}}"><img src="{{asset('images/logo1.png')}}" class="logo-icon dark-theme" alt="logo"></a>
            @endif
        </div>
        <div class="main-sidemenu">
            <div class="app-sidebar__user clearfix">
                <div class="dropdown user-pro-body">
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround" src="@if(auth()->user()->type === 'admin') {{url('images/user_profile',auth()->user()->image)}} @else {{url('images/user_profile',auth()->user()->image)}} @endif"><span class="avatar-status profile-status bg-green"></span>
                    </div>
                    <div class="user-info">
                        <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>
                        @if(auth()->user()->type=='admin')
                        <span class="mb-0 text-muted">Admin Panel</span>
                        @elseif(auth()->user()->type=='client')
                            <span class="mb-0 @if(auth()->user()->credit>0) text-success @else text-danger @endif">Buyer</span>
                            @elseif(auth()->user()->type=='merchant')
                            <span class="mb-0 @if(auth()->user()->credit>0) text-success @else text-danger @endif">Seller</span>
                            @endif
                    </div>
                </div>
            </div>
            <ul class="side-menu">
                @if(auth()->check() and auth()->user()->type === 'admin')
                <li class="slide">
                    <a class="side-menu__item" href="{{url('/admin')}}"><i class="fas fa-tachometer-alt side-menu__icon"></i> <span class="side-menu__label pt-3">Dashboard</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('users.index')}}"><i class="fas fa-users side-menu__icon"></i> <span class="side-menu__label pt-3">All Users</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('categories.index')}}"><i class="fas fa-cubes side-menu__icon"></i> <span class="side-menu__label pt-3">Cetegory</span></a>
                </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{route('propertiess.index')}}"><i class="fas fa-building side-menu__icon"></i> <span class="side-menu__label pt-3">Property</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{route('advertisements.index')}}"><i class="fas fa-ad side-menu__icon"></i> <span class="side-menu__label pt-3">Advertisements</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{route('consults1.index')}}"><i class="fab fa-rocketchat  side-menu__icon"></i> <span class="side-menu__label pt-3">Consults</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{route('reports.index')}}"><i class="fab fa-rocketchat  side-menu__icon"></i> <span class="side-menu__label pt-3">Reports</span></a>
                    </li>
                @endif
                @if(auth()->check() and auth()->user()->type === 'client')
                <li class="slide">
                    <a class="side-menu__item" href="{{url('/client')}}"><i class="fas fa-tachometer-alt side-menu__icon"></i> <span class="side-menu__label pt-3">Dashboard</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{route('property.index')}}"><i class="fas fa-building side-menu__icon"></i> <span class="side-menu__label pt-3">Show Property</span></a>
                </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{route('consults.index')}}"><i class="fab fa-rocketchat side-menu__icon" ></i> <span class="side-menu__label pt-3">Consults</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{route('c-reports.index')}}"><i class="fab fa-rocketchat side-menu__icon" ></i> <span class="side-menu__label pt-3">Reports</span></a>
                        </li>
                @endif
                @if(auth()->check() and auth()->user()->type === 'merchant')
                <li class="slide">
                    <a class="side-menu__item" href="{{url('/merchant')}}"><i class="fas fa-tachometer-alt side-menu__icon"></i> <span class="side-menu__label pt-3">Dashboard</span></a>
                </li>
                 <li class="slide">
                      <a class="side-menu__item" href="{{route('properties.index')}}"><i class="fas fa-building side-menu__icon"></i> <span class="side-menu__label pt-3">Property</span></a>
                 </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{route('consults2.index')}}"><i class="fab fa-rocketchat side-menu__icon"></i> <span class="side-menu__label pt-3">Consults</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{route('seller-reports.index')}}"><i class="fab fa-rocketchat side-menu__icon" ></i> <span class="side-menu__label pt-3">Reports</span></a>
                        </li>
                @endif
            </ul>
        </div>
    </aside>
    <!-- main-sidebar -->
    <div class="main-content app-content">
                <!-- main-header -->
                <div class="main-header sticky side-header nav nav-item">
                    <div class="container-fluid">
                        <div class="main-header-left ">
                            <div class="responsive-logo">
                                @if(auth()->user()->type=='admin')
                                <a href="{{url('/admin')}}"><img src="{{asset('images/logoforappstores.png')}}" class="logo-1" alt="logo"></a>
                                <a href="{{url('/admin')}}"><img src="{{asset('images/logoforappstores.png')}}" class="dark-logo-1" alt="logo"></a>
                                <a href="{{url('/admin')}}"><img src="{{asset('images/logoforappstores.png')}}" class="logo-2" alt="logo"></a>
                                <a href="{{url('/admin')}}"><img src="{{asset('images/logoforappstores.png')}}" class="dark-logo-2" alt="logo"></a>

                                @endif
                            </div>
                            <div class="app-sidebar__toggle" data-toggle="sidebar">
                                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
                                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
                            </div>

                        </div>
                        <div class="main-header-right">
                            <div class="nav nav-item  navbar-nav-right ml-auto">
                                <div class="nav-item full-screen fullscreen-button">
                                    <a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
                                </div>
                                <div class="dropdown main-profile-menu nav nav-item nav-link">
                                    <a class="profile-user d-flex" href=""><img alt="" src="@if(auth()->user()->type === 'admin') {{url('images/user_profile',auth()->user()->image)}} @else {{url('images/user_profile',auth()->user()->image)}} @endif"></a>
                                    <div class="dropdown-menu">
                                        <div class="main-header-profile bg-primary p-3">
                                            <div class="d-flex wd-100p">
                                                <div class="main-img-user"><img alt="" src="@if(auth()->user()->type === 'admin') {{url('images/user_profile',auth()->user()->image)}} @else {{url('images/user_profile',auth()->user()->image)}} @endif" class=""></div>
                                                <div class="ml-3 my-auto">
                                                    <h6>{{auth()->user()->name}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        @if(auth()->user()->type=='admin')
{{--                                            <a class="dropdown-item" href="{{ route('change.passa') }}"><i class="bx bx-cog"></i> Change Password</a>--}}
{{--                                        <a class="dropdown-item" href="{{ route('show.profile1') }}"><i class="bx bx-cog"></i> Show Profile</a>--}}

                                        @endif
                                        @if(auth()->user()->type=='client')
{{--                                         <a class="dropdown-item" href="{{ route('show.profile12') }}"><i class="bx bx-cog"></i> Show Profile</a>--}}
{{--                                            <a class="dropdown-item" href="{{ route('change.pass') }}"><i class="bx bx-cog"></i> Change Password</a>--}}
                                         @endif
                                        @if(auth()->user()->type=='merchant')
{{--                                            <a class="dropdown-item" href="{{ route('change.passm') }}"><i class="bx bx-cog"></i> Change Password</a>--}}
{{--                                        <a class="dropdown-item" href="{{ route('show.profile') }}"><i class="bx bx-cog"></i> Show Profile</a>--}}
                                        @endif
                                        <!-- <a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a> -->
                                        <a class="dropdown-item" href="{{ route('change.pass') }}"><i class="las la-key"></i> Change Password</a>
                                        <a class="dropdown-item" href="{{ route('show.profile') }}"><i class="bx bx-cog"></i> Show Profile</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="bx bx-log-out"></i> Sign Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /main-header -->

@yield('content')

  </div>
    <!-- Footer opened -->
    <div class="main-footer ht-40">
        <div class="container-fluid pd-t-0-f ht-100p">
            <span>Copyright © {{date('Y')}} <a href="#">RealEstateAgency</a>. All rights reserved.</span>
        </div>
    </div>
    <!-- Footer closed -->

</div>
<!-- End Page -->
<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/moment/moment.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Moment js -->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/raphael/raphael.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Rating js-->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/rating/jquery.barrating.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{ asset(env('ASSET_URL') .'assets/js/eva-icons.min.js')}}"></script>
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Sticky js -->
<script src="{{ asset(env('ASSET_URL') .'assets/js/sticky.js')}}"></script>
<script src="{{ asset(env('ASSET_URL') .'assets/js/modal-popup.js')}}"></script>
<!-- Left-menu js-->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/side-menu/sidemenu.js')}}"></script>

@yield('script')

<!-- custom js -->
<script src="{{ asset(env('ASSET_URL') .'assets/js/custom.js')}}"></script>
{{--<script src="{{ asset(env('ASSET_URL') .'assets/js/main.js')}}"></script>--}}

</body>
</html>
