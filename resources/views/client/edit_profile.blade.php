@extends('layouts.app')
@section('title','Edit Profile')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
@endsection
@section('content')


    <!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Password reset</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="mb-3 mb-xl-0">
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row opened -->

        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Password Reset</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="main-card-signin d-md-flex">
                                    <div class="wd-100p">
                                        <div class="main-signin-header">
                                            <div class="">
                                                <h2>Reset Your Password</h2>
                                                <form method="post" action="{{route('update.password')}}">
                                                    @csrf
                                                    <div class="form-group text-left">
                                                        <label>Current password</label>
                                                        <input class="form-control  {{ $errors->has('current_password') ? ' is-invalid' : '' }}" placeholder="Enter your current password" name="current_password" type="password">
                                                        @if($errors->has('current_password'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('current_password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group text-left">
                                                        <label>New Password</label>
                                                        <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter your password"  name="password" type="password">
                                                        @if($errors->has('password'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group text-left">
                                                        <label>Confirm Password</label>
                                                        <input class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Confirm Password" name="password_confirmation" type="password">
                                                        @if($errors->has('password_confirmation'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <button class="btn ripple btn-main-primary btn-block">Reset Password</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->

        </div>
        <!-- /row -->

    </div>

@endsection
@section('script')
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @elseif(Session::has('error'))
        toastr.error("{{Session::get('error')}}");
        @endif
    </script>
@endsection
