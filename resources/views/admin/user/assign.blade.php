@extends('layouts.app')
@section('title','Assigned Clients')
@section('style')
    <link href="{{ asset(env('ASSET_URL') .'css/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">

    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ asset(env('ASSET_URL') .'assets/plugins/sumoselect/sumoselect.css')}}">
    <link href="{{ asset(env('ASSET_URL') .'assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0"> / Assign Clients</span>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">ASSIGN CLIENTS</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal needs-validation" method="post" action="{{route('clients.merchants.store')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Request()->user}}">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group mb-3">
                                        <p class="mg-b-10">Select Users</p>
                                        <select multiple="multiple" class="testselect2 form-control {{ $errors->has('assigned_id') ? ' is-invalid' : '' }}" name="assigned_id[]">
                                            @foreach($users as $cate)
                                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('assigned_id'))
                                            <span class="text-danger text-sm" role="alert">
                                                <strong>{{ $errors->first('assigned_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-0 mt-3 justify-content-end">
                                        <div class="pt-3">
                                            <button type="submit" class="btn btn-danger">{{'Assign Now'}}</button>
                                        </div>
                                    </div>
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
                                <h4 class="card-title mg-b-0">STOCKS LIST</h4>
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
                                        <th>PRICE</th>
                                        <th>LICENCE</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assignedUsers as $index => $user)
                                        <tr>
                                            <td>{{++$index}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->countries->name}}</td>
                                            <td>@if($user->merchants){{$user->merchants->users->name}} @else @endif</td>
                                            <td>{{$user->credit}}</td>
                                            <td><button class="btn btn-success btn-sm" data-target="#modaldemo2" data-toggle="modal" onclick="giveOrTake({{$user->id}});">Give / Take balance</button></td>
                                            <td><a class="btn btn-sm btn-success" href="{{route('orders.users',$user->id)}}"><i class="fa fa-shopping-basket"></i></a></td>
                                            <td><a class="btn btn-sm btn-success" href="{{route('users.show',$user->id)}}"><i class="fa fa-eye"></i></a></td>
                                            <td><a href="#" onclick="confirmAccpect({{$user->id}})">@if($user->blocked==1)<span class="badge badge-success">Active</span>@else <span class="badge badge-danger">Block</span> @endif</a></td>
                                            <td>
                                                <a class="btn btn-sm btn-info-gradient" href="{{route('users.edit',$user->id)}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-danger-gradient"  href="{{route('expel.users',['user'=>$user->id,'merchant'=>$user->merchants->user_id])}}"><i class="fa fa-trash"></i></a>
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
    <!-- Moment js -->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/moment/moment.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <!--Internal  Form-elements js-->
    <script src="{{ asset(env('ASSET_URL') .'assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{ asset(env('ASSET_URL') .'assets/js/select2.js')}}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ asset(env('ASSET_URL') .'assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @endif
    </script>
@endsection
