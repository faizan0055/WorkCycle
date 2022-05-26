@extends('layouts.app')
@section('title','RealEstate Users')
@section('style')
        <!-- Internal Data table css -->
        <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
        <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
        <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('ASSET_URL') .'assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet">
@endsection
@section('content')
                <!-- container -->
                <div class="container-fluid">
                    <!-- breadcrumb -->
                    <div class="breadcrumb-header justify-content-between">
                        <div class="my-auto">
                            <div class="d-flex">
                                <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ All Users</span>
                            </div>
                        </div>
{{--                        <div class="d-flex my-xl-auto right-content">--}}
{{--                            <div class="mb-3 mb-xl-0">--}}
{{--                                <div class="btn-group dropdown">--}}
{{--                                    <a href="{{route('users.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New User</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <!-- breadcrumb -->
                    <!-- row opened -->
                    <div class="row row-sm">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title mg-b-0">View All Users List</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-md-nowrap" id="example1">
                                            <thead>
                                                <tr>
                                                    <th class="wd-5p border-bottom-0">#</th>
                                                    <th class="wd-10p border-bottom-0">NAME</th>
                                                    <th class="wd-15p border-bottom-0">PHONE</th>
                                                    <th class="wd-15p border-bottom-0">EMAIL</th>
                                                    <th class="wd-5p border-bottom-0">STATUS</th>
                                                    <th class="wd-5p border-bottom-0">TYPE</th>
{{--                                                    <th class="wd-5p border-bottom-0">DATE & TIME</th>--}}
                                                    <th class="wd-15p border-bottom-0">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $index => $user)
                                                <tr>
                                                    <td>{{++$index}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td><a href="#" onclick="confirmAccpect({{$user->id}})">@if($user->blocked==1)<span class="badge badge-success">Active</span>@else <span class="badge badge-danger">Block</span> @endif</a></td>
                                                    <td>@if($user->type=="admin") Admin @elseif($user->type=="client") Buyer @else Seller @endif</td>
{{--                                                    <td>{{$user->created_at}}</td>--}}
                                                    <td>
                                                        <a class="btn btn-sm btn-info" href="{{route('users.edit',$user->id)}}"><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-sm btn-warning"  href="javascript:void(0);" onclick="$(this).find('form').submit();"><i class="fa fa-trash"></i>
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                              method="post"
                                                              onsubmit="return confirm('Do you really want to delete this user?');">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/div-->

                    </div>
                    <!-- /row -->
                </div>
                <!-- Container closed -->

            <!-- main-content closed -->

@endsection
@section('script')
    <!-- Internal Data tables -->
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
       <script src="{{ asset(env('ASSET_URL') .'js/toastr.min.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>

        <!--Internal  Datatable js -->
        <script src="{{ asset(env('ASSET_URL') .'assets/js/table-data.js')}}"></script>

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
                    url: "{{route('user.status.update')}}",
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
