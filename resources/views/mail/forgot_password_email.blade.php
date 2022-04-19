
<!--<!doctype html>-->
<!--<html lang="en-US">-->

<!--<head>-->
<!--    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />-->
<!--    <title>Reset Password Email Template</title>-->
<!--    <meta name="description" content="Reset Password Email Template.">-->
<!--    <style type="text/css">-->
<!--        a:hover {text-decoration: underline !important;}-->
<!--    </style>-->
<!--</head>-->

<!--<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">-->
<!--100% body table-->
<!--<main class="login-form">-->
<!--    <div class="cotainer">-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-md-8">-->
<!--                <div class="card">-->
<!--                    <div class="card-header">Reset Password</div>-->
<!--                    <div class="card-body">-->

<!--                        <form action="{{ route('reset.password.post') }}" method="POST">-->
<!--                            @csrf-->
<!--                            <input type="hidden" name="token" value="{{ $token }}">-->

<!--                            <div class="form-group row">-->
<!--                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>-->
<!--                                <div class="col-md-6">-->
<!--                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>-->
<!--                                    @if ($errors->has('email'))-->
<!--                                        <span class="text-danger">{{ $errors->first('email') }}</span>-->
<!--                                    @endif-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="form-group row">-->
<!--                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>-->
<!--                                <div class="col-md-6">-->
<!--                                    <input type="password" id="password" class="form-control" name="password" required autofocus>-->
<!--                                    @if ($errors->has('password'))-->
<!--                                        <span class="text-danger">{{ $errors->first('password') }}</span>-->
<!--                                    @endif-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="form-group row">-->
<!--                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>-->
<!--                                <div class="col-md-6">-->
<!--                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>-->
<!--                                    @if ($errors->has('password_confirmation'))-->
<!--                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>-->
<!--                                    @endif-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <div class="col-md-6 offset-md-4">-->
<!--                                <button type="submit" class="btn btn-primary">-->
<!--                                    Reset Password-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </form>-->

<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</main>-->
<!--/100% body table-->
<!--</body>-->

<!--</html>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Title -->
    <title> Login | Real Estate </title>
    <meta name="Author" content="Boat Brain">
    <meta name="Keywords" content="Boat Brain,"/>

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
                                    <div class="mb-5 d-flex"><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28"><span>Forgot</span></h1></div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>Forgot Password!</h2>
                                            <h5 class="font-weight-semibold mb-4">Please forgot password to continue.</h5>
                                            <form action="{{ route('reset.password.post') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="token" value="{{ $token }}">

                                                <div class="form-group">
                                                    <label>Email</label> <input class="form-control {{ $errors->has('email') ? ' is-invalid' : ''}}" placeholder="Enter your email" type="text" name="email" id="email_address">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label> <input class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Enter your password" type="password" name="password" id="password">
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label> <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : ''}}" placeholder="Enter your password" type="password" name="password_confirmation" id="password-confirm">
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                    @endif
                                                </div>

                                                <button class="btn btn-main-primary btn-block">Forgot Password</button>

                                                <div class="row row-xs">
                                                    <div class="col-sm-12">
                                                    </div>
                                                </div>
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

<!-- eva-icons js -->
<script src="{{asset('assets/js/eva-icons.min.js')}}"></script>

<!-- Rating js-->
<script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

<!-- custom js -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

</body>
</html>

