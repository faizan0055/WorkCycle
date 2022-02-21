<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="GamsKeys">
    <meta name="Author" content="GamsKeys">
    <meta name="Keywords" content="GamsKeys"/>

    <!-- Title -->
    <title> Registeration </title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/logo1.png')}}" type="image/x-icon"/>

    <!-- Icons css -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">

    <!--  Right-sidemenu css -->
    <link href="{{asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

    <!--  Custom Scroll bar-->
    <link href="{{asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>

    <!--  Left-Sidebar css -->
    <link rel="stylesheet" href="{{asset('assets/css/sidemenu.css')}}">

    <!--- Style css --->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <!--- Dark-mode css --->
    <link href="{{asset('assets/css/style-dark.css')}}" rel="stylesheet">

    <!---Skinmodes css-->
    <link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

    <!--- Animations css-->
    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'assets/plugins/sumoselect/sumoselect.css')}}">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet">

</head>
<body class="main-body bg-light">

<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- Page -->
<div class="page">

    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{asset('images/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">

                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>User Registeration!</h2>
                                            <h5 class="font-weight-semibold mb-4">Please sign Up to continue.</h5>
                                            <form action="{{ route('register.store',Request()->code) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @if(session()->has('alert'))
                                                    <div class="alert alert-{{ session()->get('alert.type') }}">
                                                        <strong>{{ session()->get('alert.message') }}</strong>
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <label>Name</label> <input class="form-control {{ $errors->has('name') ? ' is-invalid' : ''}}" placeholder="Enter your name" value="{{old('name')}}" type="text" name="name">
                                                    @if($errors->has('name') || session()->has('alert'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label> <input class="form-control {{ $errors->has('email') ? ' is-invalid' : ''}}" value="{{old('email')}}" placeholder="Enter your email" type="text" name="email">
                                                    @if($errors->has('email') || session()->has('alert'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone</label> <input class="form-control {{ $errors->has('phone') ? ' is-invalid' : ''}}" value="{{old('phone')}}" placeholder="Enter your phone" type="text" name="phone">
                                                    @if($errors->has('phone') || session()->has('alert'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Image</label> <input type="file" name="image" class="form-control browse-file {{ $errors->has('image') ? ' is-invalid' : '' }}" placeholder="choose" readonly>
                                                    @if($errors->has('image') || session()->has('alert'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                        </span>
                                                    @endif

                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label> <input class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Enter your password" type="password" name="password">
                                                    @if($errors->has('password') || session()->has('alert'))
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                <div class="row mg-t-10">
                                                    <div class="col-lg-3">
                                                        <label class="rdiobox"><input name="type" type="radio" value="client" checked> <span>Buyer</span></label>
                                                    </div>

                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox"><input name="type" type="radio" value="merchant"> <span>Seller</span></label>
                                                    </div>
                                                    @if($errors->has('type') || session()->has('alert'))
                                                        <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $errors->first('type') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                </div>
                                                <button class="btn btn-main-primary btn-block">Register</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>

</div>
<!-- End Page -->

<!-- JQuery min js -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Bundle js -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Ionicons js -->
<script src="{{asset('assets/plugins/ionicons/ionicons.js')}}"></script>

<!-- Moment js -->
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/select2/js/select2.min.js')}}"></script>

<script src="{{ asset(env('ASSET_URL') .'assets/js/select2.js')}}"></script>
<!--Internal Sumoselect js-->
<script src="{{ asset(env('ASSET_URL') .'assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
<!-- custom js -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{ asset(env('ASSET_URL') .'assets/js/main.js')}}"></script>

<!-- eva-icons js -->
<script src="{{asset('assets/js/eva-icons.min.js')}}"></script>

<!-- Rating js-->
<script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{asset('assets/plugins/rating/jquery.barrating.js')}}"></script>
<script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
<script type="text/javascript">
    @if (Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @endif
</script>
</body>
</html>
