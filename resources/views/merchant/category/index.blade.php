@extends('layouts.app')
@section('title','Create User')
@section('user_nav', 'active')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />

@endsection
@section('content')

    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Business Type</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">ADD CATEGORY</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal needs-validation" method="post" action="{{ isset($category) ? route('chapters.update',$category->id) : route('chapters.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <p class="mg-b-10">Name</p>
                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($category) ? $category->name : '' }}" id="name" placeholder="Name">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if(isset($category))
                                <div class="form-group mb-0 justify-content-center mt-2">
                                    <p class="mg-b-10">Image</p>
                                    <div class="input-group">
                                        <img src="{{url('images/chapters',$category->image)}}" width="100">
                                    </div>
                                    <span class="text-danger">{{$errors->first('image')}}</span>
                                </div>
                            @endif
                            <div class="form-group mb-0 justify-content-end mt-2">
                                <p class="mg-b-10">Image</p>
                                <div class="input-group file-browser">
                                    <input type="file" name="image" class="form-control browse-file {{ $errors->has('image') ? ' is-invalid' : '' }}" placeholder="choose" readonly>
                                </div>
                                <span class="text-danger">{{$errors->first('image')}}</span>
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-danger">{{ isset($category) ? 'Update Now' : 'Save Now' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">BUSINESS TYPE LIST</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $index => $char)
                                        <tr>
                                            <th scope="row">{{++$index}}</th>
                                            <td><img src="{{url('images/chapters',$char->image)}}" width="100"></td>
                                            <td>{{$char->name}}</td>
                                            <td>Active</td>
                                            <td><a class="btn btn-sm btn-info" href="{{route('chapters.edit',$char->id)}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>
                                                    <form action="{{ route('chapters.destroy', $char->id) }}"
                                                          method="post"
                                                          onsubmit="return confirm('Do you really want to delete this?');">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <!-- Internal form-elements js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/form-elements.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @endif
    </script>
@endsection
