@extends('layouts.app')

@section('profile_nav', 'active')
@section('title','Profile')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'plugins/summernote/summernote-bs4.css')}}">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h3 class="m-0 text-dark">All Property</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Property</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
{{--                @foreach($props as $index => $prop)--}}
{{--                <div class="col-md-3">--}}
{{--                    <!-- Profile Image -->--}}

{{--                    <div class="card card-primary card-outline">--}}

{{--                        <div class="card-body box-profile">--}}

{{--                            <div class="text-center" >--}}
{{--                                <img class="profile-user-img img-fluid img-circle"--}}
{{--                                     src="{{url('images/properties',$prop->image)}}"--}}
{{--                                     alt="User profile picture">--}}
{{--                            </div>--}}
{{--                            <h5 class=" text-left"><b>Name: </b>{{$prop->name}}</h5>--}}
{{--                            <h5 class="profile-username text-left"><b>Price: </b>{{$prop->price}}</h5>--}}
{{--                            <h5 class="profile-username text-left"><b>Detail: </b>{{$prop->description}}</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card" >--}}
{{--                        <img class="card-img-top" src="{{url('images/properties',$prop->image)}}"--}}{{----}}{{-- alt="Card image cap">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">Name: <span class="text-muted">{{$prop->name}}</span></h5>--}}
{{--                            <h5 class="card-title">PRICE: <span class="text-muted">{{$prop->price}}</span></h5>--}}
{{--                            <h5 class="card-title">Detail</h5>--}}
{{--                            <h6 class="card-subtitle mb-2 text-muted">{{$prop->description}}</h6>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                @endforeach--}}
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
                                    <table class="table mg-b-0 text-md-nowrap myTable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>IMAGE</th>
                                            <th>Property Name</th>
                                            <th>Property Category</th>
                                            <th>Property Detail</th>
                                            <th>PRICE</th>
                                            <th>SHOW</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($props as $index => $prop)
                                            <tr>
                                                <th scope="row">{{++$index}}</th>
                                                <td><img src="{{url('images/properties',$prop->image)}}" width="50"></td>
                                                <td>{{$prop->name}}</td>
                                                <td>{{$prop->category->name}}</td>
                                                <td>{{$prop->description}}</td>
                                                <td>{{$prop->price}}</td>
                                                <td><a class="btn btn-sm btn-success" href="{{ route('property.show', $prop->id) }}"><i class="fa fa-eye"></i></a>
{{--                                                    <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>--}}
{{--                                                        <form action="{{ route('consults1.destroy', $con->id) }}"--}}
{{--                                                              method="post"--}}
{{--                                                              onsubmit="return confirm('Do you really want to delete this?');">--}}
{{--                                                            @csrf--}}
{{--                                                            @method('delete')--}}
{{--                                                        </form>--}}
{{--                                                    </a></td>--}}
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

    </section>
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
    <script>
        $(document).ready( function () {
            $('.myTable').DataTable();
        } );
    </script>
@endsection
