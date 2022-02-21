@extends('layouts.app')
@section('title','Edit User')
@section('user_nav', 'active')
@section('style')
    <!--- Internal Select2 css-->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <!---Internal Fileupload css-->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

    <!---Internal Fancy uploader css-->
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />

    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'assets/plugins/sumoselect/sumoselect.css')}}">

@endsection
@section('content')

    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">User</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Add User</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="mb-3 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a  href="{{route('users.index')}}" class="btn btn-danger"><i class="fa fa-eye"></i> View User</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        <!-- row -->
        <div class="row row-sm  justify-content-center align-items-center ">
            <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Add User</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal" action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row row-sm">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label>Name*</label>
                                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Name" value="{{ $user->name }}">
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="col-lg-6">--}}
{{--                                                <div class="form-group mb-3">--}}
{{--                                                    <label>Country*</label>--}}
{{--                                                    <select class="form-control select2" name="country_id">--}}
{{--                                                        @foreach($countries as $cate)--}}
{{--                                                            <option value="{{$cate->id}}" @if($user->country_id==$cate->id) selected @else @endif>{{$cate->name}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    @if($errors->has('username'))--}}
{{--                                                        <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $errors->first('username') }}</strong>--}}
{{--                                            </span>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <label>Password*</label>--}}
{{--                                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" value="{{ old('password') }}" placeholder="Password" >--}}
{{--                                        @if($errors->has('password'))--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $errors->first('password') }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label>Email*</label>
                                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ $user->email }}" placeholder="Email" >
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div></div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label>Phone*</label>
                                        <input type="tel" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" name="phone" value="{{ $user->phone }}" placeholder="Phone" >
                                        @if($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group mb-3">

                                        <label>Profile Image</label>
                                        <div class="col-sm-12">
                                            <input type="file" name="image" class="dropify {{ $errors->has('image') ? ' is-invalid' : '' }}" data-height="200" />

                                            @if($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6"><img src="{{url('images/user_profile',$user->image)}}"></div>
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-danger-gradient btn-block">Update Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Moment js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/moment/moment.js')}}"></script>

    <!-- Internal Select2 js-->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/fileuploads/js/file-upload.js')}}"></script>

    <!--Internal Fancy uploader js-->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @endif
    </script>
    <!--Internal  Form-elements js-->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/js/select2.js')}}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
@endsection
