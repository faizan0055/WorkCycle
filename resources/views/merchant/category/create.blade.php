@extends('layouts.app')
@section('title','Sub Chapter')
=@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />

@endsection
@section('content')

    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Sub Category</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">ADD SUB CATEGORY</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal needs-validation" method="post" action="{{ isset($subCategory) ? route('sub_categories.update',$subCategory->id) : route('sub_categories.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($subCategory))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <p class="mg-b-10">Name</p>
                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($subCategory) ? $subCategory->name : '' }}" id="name" placeholder="Name">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-0 justify-content-end mt-2">
                                <p class="mg-b-10">Category</p>
                                <select class="form-control select2-no-search {{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id">
                                    <option label="Choose one"></option>
                                    @foreach($categories as $type)
                                        <option value="{{$type->id}}" @if($type->id == isset($subCategory) ? $subCategory->category_id : ''){{'selected'}}@endif>{{$type->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('category_id')}}</span>
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-danger">{{ isset($subCategory) ? 'Update Now' : 'Save Now' }}</button>
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
                                <h4 class="card-title mg-b-0">SUB CATEGORY LIST</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>CATEGORY</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sub_categories as $index => $char)
                                        <tr>
                                            <th scope="row">{{++$index}}</th>
                                            <td>{{$char->name}}</td>
                                            <td>{{$char->categories->name}}</td>
                                            <td>{{ucfirst($char->status)}}</td>
                                            <td><a class="btn btn-sm btn-info" href="{{route('sub_categories.edit',$char->id)}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>
                                                    <form action="{{ route('sub_categories.destroy', $char->id) }}"
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
