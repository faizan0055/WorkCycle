@extends('layouts.app')
@section('title','Add Properties')
@section('user_nav', 'active')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.css')}}">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Property</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">ADD PROPERTY</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal needs-validation" method="post" action="{{ isset($propertys) ? route('propertiess.update',$propertys->id) : route('propertiess.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($propertys))
                                @method('PUT')
                            @endif
{{--                            {{$propertys}}--}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <p class="mg-b-10">Name</p>
                                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($propertys) ? $propertys->name : '' }}" id="name" placeholder="Name">
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
                                                <option value="{{$ch->id}}" @if(isset($propertys) && $ch->id == $propertys->category_id){{'selected'}}@endif>{{$ch->name}}</option>
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
                                        <input type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ isset($propertys) ? $propertys->price : '' }}"  placeholder="Price">
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
                                        <input type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ isset($propertys) ? $propertys->type : '' }}"  placeholder="Sell Or Rent">
                                        @if($errors->has('type'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <p class="mg-b-10">Size</p>
                                        <input type="text" class="form-control {{ $errors->has('size') ? ' is-invalid' : '' }}" name="size" value="{{ isset($propertys) ? $propertys->size : '' }}"  placeholder="125 x 125">
                                        @if($errors->has('size'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <p class="mg-b-10">Number of Beds</p>
                                        <input type="text" class="form-control {{ $errors->has('bed') ? ' is-invalid' : '' }}" name="bed" value="{{ isset($propertys) ? $propertys->bed : '' }}"  placeholder="Beds">
                                        @if($errors->has('bed'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bed') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <p class="mg-b-10">Number of Washrooms</p>
                                        <input type="text" class="form-control {{ $errors->has('washroom') ? ' is-invalid' : '' }}" name="washroom" value="{{ isset($propertys) ? $propertys->washroom : '' }}"  placeholder="Washrooms">
                                        @if($errors->has('washroom'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('washroom') }}</strong>
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
                                    @if(isset($propertys))
                                        <div class="form-group mb-0 justify-content-center mt-2">
                                            <p class="mg-b-10">Image</p>
                                            <div class="input-group">
                                                <img src="{{url('images/properties',$propertys->image)}}" width="100">
                                            </div>
                                            <span class="text-danger">{{$errors->first('image')}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end mt-2">
                                <p class="mg-b-10">Description</p>
                                <textarea class="form-control textarea1 {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ isset($propertys) ? $propertys->description : '' }}</textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-danger">{{ isset($propertys) ? 'Update Now' : 'Save Now' }}</button>
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
                                <h4 class="card-title mg-b-0">PROPERTY LIST</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap myTable " >
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>CATEGORY</th>
                                        <th>PRICE</th>
                                        <th>TYPE</th>
                                        <th>SIZE</th>
                                        <th>BEDS</th>
                                        <th>WASHROOMS</th>
                                        <th>DESCRIPTION</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($propertiess as $index => $pro)

                                        <tr>
                                            <th scope="row">{{++$index}}</th>
                                            <td><img src="{{url('images/properties',$pro->image)}}" width="50"></td>
                                            <td>{{$pro->name}}</td>
                                            <td>{{$pro->category->name}}</td>
                                            <td>{{$pro->price}}</td>
                                            <td>{{$pro->type}}</td>
                                            <td>{{$pro->size}}</td>
                                            <td>{{$pro->bed}}</td>
                                            <td>{{$pro->washroom}}</td>
                                            <td>{{$pro->description}}</td>
                                            <td><a class="btn btn-sm btn-info" href="{{route('propertiess.edit',$pro->id)}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>
                                                    <form action="{{ route('propertiess.destroy', $pro->id) }}"
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
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
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
    <script>
        $(document).ready( function () {
            $('.myTable').DataTable();
        } );
    </script>
@endsection
