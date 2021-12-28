@extends('layouts.app')
@section('title','Products')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ News</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">ADD PRODUCT</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal needs-validation" method="post" action="{{ isset($product) ? route('products.update',$product->id) : route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($product))
                                @method('PUT')
                            @endif

                            <div class="form-group mb-0 justify-content-end mt-2">
                                <p class="mg-b-10">Category</p>
                                <select class="form-control select2-no-search {{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id">
                                    <option label="Choose one"></option>
                                    @foreach($categories as $type)
                                        <option value="{{$type->id}}" @if($type->id == isset($product) ? $product->category_id : ''){{'selected'}}@endif>{{$type->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('category_id')}}</span>
                            </div>
                            <div class="form-group mb-0 justify-content-end mt-2">
                                <p class="mg-b-10">Sub Category</p>
                                <select class="form-control select2-no-search {{ $errors->has('sub_category_id') ? ' is-invalid' : '' }}" name="sub_category_id">
                                    <option label="Choose one"></option>
                                    @foreach($subCategories as $cate)
                                        <option value="{{$cate->id}}" @if($cate->id == isset($product) ? $product->sub_category_id : ''){{'selected'}}@endif>{{$cate->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('sub_category_id')}}</span>
                            </div>
                            <div class="form-group">
                                <p class="mg-b-10">Name</p>
                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($product) ? $product->name : '' }}" id="name" placeholder="Name">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <p class="mg-b-10">Reference</p>
                                <input type="text" class="form-control {{ $errors->has('reference') ? ' is-invalid' : '' }}" name="reference" value="{{ isset($product) ? $product->reference : '' }}" id="reference" placeholder="Reference">
                                @if($errors->has('reference'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reference') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <p class="mg-b-10">Price</p>
                                <input type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ isset($product) ? $product->price : '' }}" id="price" placeholder="Price">
                                @if($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <p class="mg-b-10">Discount %</p>
                                <input type="text" class="form-control {{ $errors->has('discount') ? ' is-invalid' : '' }}" name="discount" value="{{ isset($product) ? $product->discount : '' }}" id="discount" placeholder="Discount">
                                @if($errors->has('discount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('discount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <p class="mg-b-10">Image</p>
                                <input type="file" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="image">
                                @if($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-danger">{{ isset($product) ? 'Update Now' : 'Save Now' }}</button>
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
                                <h4 class="card-title mg-b-0">PRODUCTS LIST</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table key-buttons text-md-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>REFERENCE</th>
                                        <th>PRICE</th>
                                        <th>CATEGORY</th>
                                        <th>SUB CATEGORY</th>
                                        <th>COUNT</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $index => $char)
                                        <tr>
                                            <th scope="row">{{++$index}}</th>
                                            <td><img src="{{url('images/products',$char->image)}}" alt="" width="150" class="img-thumbnail rounded"></td>
                                            <td>{{$char->name}}</td>
                                            <td>{{$char->reference}}</td>
                                            <td>{{$char->price}}</td>
                                            <td>@if($char->categories){{$char->categories->name}}@endif</td>
                                            <td>@if($char->sub_categories){{$char->sub_categories->name}}@endif</td>
                                            <td>{{$char->stocks->count()}}</td>
                                            <td><a href="#" onclick="confirmAccpect({{$char->id}})">@if($char->status=='1')<span class="badge badge-success">Active</span>@else <span class="badge badge-danger">Block</span> @endif</a></td>
                                            <td><a class="btn btn-sm btn-info" href="{{route('products.edit',$char->id)}}"><i class="fa fa-edit"></i></a>
{{--                                                <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>--}}
{{--                                                    <form action="{{ route('products.destroy', $char->id) }}"--}}
{{--                                                          method="post"--}}
{{--                                                          onsubmit="return confirm('Do you really want to delete this?');">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('delete')--}}
{{--                                                    </form>--}}
{{--                                                </a>--}}
                                            </td>
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
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/table-data.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @endif
    </script>
    <script type="text/javascript">

        function confirmAccpect(id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, approved it!",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: "{{route('product.status.update')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                    },
                    dataType: "html",
                    success: function (data) {
                        //console.log(data);
                        setTimeout(function () {
                            swal({
                                    title: "Done!",
                                    text: "User Status Updated!",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                function(isConfirm){
                                    if (isConfirm) {
                                        window.location.reload();
                                    }
                                }); }, 1000);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error updating!", "Please try again", "error");
                    }
                });
            });
        }
    </script>
@endsection
