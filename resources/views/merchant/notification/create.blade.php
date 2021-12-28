@extends('layouts.app')
@section('title','Notification Management')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Quill css -->
    <link href="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- container -->
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Sent Notification</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row -->
        <div class="row row-sm  justify-content-center align-items-center ">
            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Add Notification</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal" method="post" action="{{route('merchant_notifications.store')}}">
                            @csrf
                            <div class="form-group">
                                <label>For</label>
                                <select class="form-control select2-no-search {{ $errors->has('notification_for') ? ' is-invalid' : '' }}" name="notification_for">
                                    <option value="all">All</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Notification</label>
                                <div class="mb-3">
                                    <textarea class="textarea form-control {{ $errors->has('notification') ? ' is-invalid' : '' }}" id="notification" placeholder="Place some text here" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="notification"></textarea>
                                </div>
                            </div>

                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->

    </div>
    <!-- Container closed -->


@endsection
@section('script')
    <script src="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <script>
        $(function () {
            // Summernote
            $('.textarea').summernote()
        })
    </script>
    <script type="text/javascript">
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @endif
    </script>
@endsection
