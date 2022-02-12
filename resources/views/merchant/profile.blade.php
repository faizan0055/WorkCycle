@extends('layouts.app')

@section('profile_nav', 'active')
@section('title','Profile')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{auth()->user()->image ? url('/images/user_profile/' . auth()->user()->image) : url('/assets/images/user_profile')}}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{$admin->name}}</h3>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

                            <p class="text-muted">
                                {{$admin->phone}}
                            </p>
                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                            <p class="text-muted">
                                {{$admin->email}}
                            </p>

                            <hr>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <h4>Edit Profile</h4>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" method="post"
                                          action="{{ route('merchant.profile_update',$admin->id) }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" value="{{$admin->name}}"
                                                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} form-control-lg"
                                                           name="name" id="name" placeholder="Name"/>
                                                    @if($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" value="{{$admin->email}}" readonly
                                                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg"
                                                           name="email" id="email" placeholder="email"/>
                                                    @if($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                                    @endif
                                                </div>
                                                {{--                                                <div class="form-group">--}}
                                                {{--                                                    <label for="password">Password</label>--}}
                                                {{--                                                    <input type="password" value="{{$admin->password}}"--}}
                                                {{--                                                           class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg"--}}
                                                {{--                                                           name="password" id="password"/>--}}
                                                {{--                                                    @if($errors->has('password'))--}}
                                                {{--                                                        <span class="invalid-feedback" role="alert">--}}
                                                {{--                                                    <strong>{{ $errors->first('password') }}</strong>--}}
                                                {{--                                                    </span>--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                </div>--}}

                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="tel" value="{{$admin->phone}}"
                                                           class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }} form-control-lg"
                                                           name="phone" id="phone" minlength="13" maxlength="13" />
                                                    @if($errors->has('phone'))
                                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                                    @endif
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6" data-select2-id="40">
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <div class="qr-el qr-el-3"
                                                         style="min-height: auto;  box-shadow: 2px 0px 30px 5px rgba(0, 0, 0, 0.03); padding:25px; margin:0px 20px;">
                                                        <label for="file-input" class="hoviringdell uploadBox"
                                                               id="uploadTrigger"
                                                               style="height: 110px; text-align:center; width:100%; border:dotted 2px #cccccc;">
                                                            <img src="" style="width: 90px;" id="logo">
                                                            <div class="uploadText" style="font-size: 12px;">
                                                                <span style="color:#F69518;">Upload Image</span><br>
                                                            </div>
                                                        </label>
                                                        <input type="file" id="file-input" name="image"
                                                               onchange="logo1(this);">
                                                        @if($errors->has('image'))
                                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm"
                                                style="float:right;">Update
                                        </button>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function logo1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
