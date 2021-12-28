@extends('layouts.app')
@section('title','Settings')
@section('setting_nav', 'active')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Setting</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                          
                            <form role="form" method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="name">Name:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="name" name="name" value="@if($setting){{$setting->name}}@endif" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="logo">Logo:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <label for="file-input" class="hoviringdell uploadBox" id="uploadTrigger" style="height: 110px; width:100%; ">
                                            <img src="@if($setting){{asset('images').'/'.$setting->logo}}@else{{asset('images/default.jpg')}}@endif" width="150" style="max-height: 150px;" id="logo">
                                        </label>
                                        <input type="file" class="d-none" id="file-input" name="logo" onchange="logo1(this);">
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="favicon">Favicon:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <label for="file-input1" class="hoviringdell uploadBox" id="uploadTrigger" style="height: 110px; width:100%; ">
                                            <img src="@if($setting){{asset('images').'/'.$setting->favicon}}@else{{asset('images/default.jpg')}}@endif" width="100" style="max-height: 100px;" id="favicon">
                                        </label>
                                        <input type="file" class="d-none" id="file-input1" name="favicon" onchange="favicon1(this);">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="firebase_api_key">Firebase Api Key:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="firebase_api_key" name="firebase_api_key" value="@if($setting){{$setting->firebase_api_key}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="firebase_server_key">Firebase Server Key:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="firebase_server_key" name="firebase_server_key" value="@if($setting){{$setting->firebase_server_key}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="google_api_key">Google Api Key:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="google_api_key" name="google_api_key" value="@if($setting){{$setting->google_api_key}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="google_store_link">Google Store Link:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="google_store_link" name="google_store_link" value="@if($setting){{$setting->google_store_link}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="apple_store_link">Apple Store Link:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="apple_store_link" name="apple_store_link" value="@if($setting){{$setting->apple_store_link}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="order_prefix">Order Prefix:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="order_prefix" name="order_prefix" value="@if($setting){{$setting->order_prefix}}@endif" >
                                    </div>
                                </div><hr class="border-dark">
                                <h4><b>Social Media Links</b></h4>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="facebook_link">Facebook Link:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="facebook_link" name="facebook_link" value="@if($setting){{$setting->facebook_link}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="twitter_link">Twitter Link:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="@if($setting){{$setting->twitter_link}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="youtube_link">Youtube Link:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="@if($setting){{$setting->youtube_link}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="instagram_link">Instagram Link:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="text" class="form-control" id="instagram_link" name="instagram_link" value="@if($setting){{$setting->instagram_link}}@endif" >
                                    </div>
                                </div>
                                <hr class="border-dark">
                                <h4><b>Theme Settings</b></h4>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="top_nav_color">Top Navbar color:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="color" class="form-control" id="top_nav_color" name="top_nav_color" value="@if($setting){{$setting->top_nav_color}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="side_nav_color">Side Navbar color:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="color" class="form-control" id="side_nav_color" name="side_nav_color" value="@if($setting){{$setting->side_nav_color}}@endif" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="active_tab_color">Active Tabs color:</label>
                                    </div>
                                    <div class="form-group col-10">
                                        <input type="color" class="form-control" id="active_tab_color" name="active_tab_color" value="@if($setting){{$setting->active_tab_color}}@endif" >
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-warning float-right">Update</button>
                            </form>

                        </div>
                    </div>
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
        function favicon1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#favicon')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
