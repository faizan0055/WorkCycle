@extends('layouts.app')
@section('title','Add Properties')
@section('user_nav', 'active')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.css')}}">
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
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">ADD CHAPTER</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal needs-validation" method="post" action="{{ isset($property) ? route('properties.update',$property->id) : route('properties.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($property))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <p class="mg-b-10">Name</p>
                                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($property) ? $property->name : '' }}" id="name" placeholder="Name">
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <p class="mg-b-10">Category</p>
                                        <select class="form-control select2 {{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id">
                                            <option label="Choose one"></option>
                                            @foreach(\App\Category::get() as $index => $ch)
                                                <option value="{{$ch->id}}" @if(isset($property) && $ch->id == $property->category_id){{'selected'}}@endif>{{$ch->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('category_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <p class="mg-b-10">Price</p>
                                        <input type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ isset($property) ? $property->price : '' }}"  placeholder="Price">
                                        @if($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <p class="mg-b-10">Type</p>
                                        <input type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ isset($property) ? $property->type : '' }}"  placeholder="Sell Or Rent">
                                        @if($errors->has('type'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-0 justify-content-end">
                                        <p class="mg-b-10">Image</p>
                                        <div class="input-group file-browser">
                                            <input type="file" name="image" class="form-control browse-file {{ $errors->has('image') ? ' is-invalid' : '' }}" placeholder="choose" readonly>
                                        </div>
                                        <span class="text-danger">{{$errors->first('image')}}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    @if(isset($property))
                                        <div class="form-group mb-0 justify-content-center mt-2">
                                            <p class="mg-b-10">Image</p>
                                            <div class="input-group">
                                                <img src="{{url('images/properties',$property->image)}}" width="100">
                                            </div>
                                            <span class="text-danger">{{$errors->first('image')}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end mt-2">
                                <p class="mg-b-10">Description</p>
                                <textarea class="form-control textarea1 {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ isset($property) ? $property->description : '' }}</textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-danger">{{ isset($property) ? 'Update Now' : 'Save Now' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">CHAPTERS TYPE LIST</h4>
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
                                        <th>PRICE</th>
                                        <th>Type</th>
                                        <th>DESCRIPTION</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($properties as $index => $pro)
                                        <tr>
                                            <th scope="row">{{++$index}}</th>
                                            <td><img src="{{url('images/properties',$pro->image)}}" width="50"></td>
                                            <td>{{$pro->name}}</td>
                                            <td>{{$pro->price}}</td>
                                            <td>{{$pro->type}}</td>
                                            <td>{{$pro->description}}</td>
                                            <td><a class="btn btn-sm btn-info" href="{{route('properties.edit',$pro->id)}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>
                                                    <form action="{{ route('properties.destroy', $pro->id) }}"
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
    <script src="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            // Summernote
            $('.textarea1').summernote({
                placeholder: 'Description',
                tabsize: 4,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
            $('.textarea2').summernote({
                placeholder: 'CONTACT US',
                tabsize: 4,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
            $('.textarea3').summernote({
                placeholder: 'PRIVACY POLICY ',
                tabsize: 4,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
@endsection
